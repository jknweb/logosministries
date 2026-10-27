<?php
/**
 * Fonctions publiques de lecture des contenus, utilisées par le thème.
 * Chaque fonction renvoie des tableaux simples, indépendants de la présentation.
 *
 * @package Logos_Contenus
 */

defined( 'ABSPATH' ) || exit;

/** Date du jour du site (fuseau WordPress), au format AAAA-MM-JJ. */
function logos_contenus_today() {
	return current_time( 'Y-m-d' );
}

/** Vrai si la date (AAAA-MM-JJ) est aujourd'hui ou plus tard. */
function logos_contenus_is_upcoming( $date ) {
	return $date >= logos_contenus_today();
}

/**
 * Formate une date en français, indépendamment de la langue installée.
 *
 * @param string $date   AAAA-MM-JJ.
 * @param string $format long (« Jeudi 31 décembre 2026 »), day (« 31 »), month (« déc »).
 */
function logos_contenus_format_date( $date, $format = 'long' ) {
	if ( ! preg_match( '/^(\d{4})-(\d{2})-(\d{2})$/', (string) $date, $m ) ) {
		return '';
	}
	$ts     = gmmktime( 12, 0, 0, (int) $m[2], (int) $m[3], (int) $m[1] );
	$days   = array( 'Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi' );
	$months = array( 'janvier', 'février', 'mars', 'avril', 'mai', 'juin', 'juillet', 'août', 'septembre', 'octobre', 'novembre', 'décembre' );
	$short  = array( 'janv', 'févr', 'mars', 'avr', 'mai', 'juin', 'juil', 'août', 'sept', 'oct', 'nov', 'déc' );
	switch ( $format ) {
		case 'day':
			return $m[3];
		case 'month':
			return $short[ (int) $m[2] - 1 ];
		default:
			return $days[ (int) gmdate( 'w', $ts ) ] . ' ' . (int) $m[3] . ' ' . $months[ (int) $m[2] - 1 ] . ' ' . $m[1];
	}
}

/** Identifiant YouTube extrait d'une adresse ou d'un identifiant brut. */
function logos_contenus_youtube_id( $value ) {
	$value = trim( (string) $value );
	if ( preg_match( '~(?:youtu\.be/|v=|/embed/|/shorts/|/live/)([A-Za-z0-9_-]{11})~', $value, $m ) ) {
		return $m[1];
	}
	return preg_match( '/^[A-Za-z0-9_-]{11}$/', $value ) ? $value : '';
}

/** Requête simple sur un type ordonné. */
function logos_contenus_query( $post_type, $args = array() ) {
	return get_posts(
		array_merge(
			array(
				'post_type'        => $post_type,
				'post_status'      => 'publish',
				'posts_per_page'   => 100,
				'orderby'          => array( 'menu_order' => 'ASC', 'title' => 'ASC' ),
				'suppress_filters' => false,
			),
			$args
		)
	);
}

/** Horaires des rendez-vous hebdomadaires. */
function logos_get_schedule() {
	$items = array();
	foreach ( logos_contenus_query( 'lt_horaire' ) as $post ) {
		$details = array_filter( array_map( 'trim', explode( "\n", (string) get_post_meta( $post->ID, '_lt_details', true ) ) ) );
		$items[] = array(
			'id'       => $post->ID,
			'title'    => get_the_title( $post ),
			'day'      => (string) get_post_meta( $post->ID, '_lt_day', true ),
			'time'     => (string) get_post_meta( $post->ID, '_lt_time', true ),
			'icon'     => get_post_meta( $post->ID, '_lt_icon', true ) ? get_post_meta( $post->ID, '_lt_icon', true ) : 'worship',
			'audience' => (string) get_post_meta( $post->ID, '_lt_audience', true ),
			'summary'  => (string) get_post_meta( $post->ID, '_lt_summary', true ),
			'details'  => array_values( $details ),
		);
	}
	return $items;
}

/** Départements. */
function logos_get_ministries() {
	$items = array();
	foreach ( logos_contenus_query( 'lt_departement' ) as $post ) {
		$items[] = array(
			'id'    => $post->ID,
			'title' => get_the_title( $post ),
			'icon'  => get_post_meta( $post->ID, '_lt_icon', true ) ? get_post_meta( $post->ID, '_lt_icon', true ) : 'heart',
			'text'  => (string) get_post_meta( $post->ID, '_lt_text', true ),
			'join'  => '0' !== get_post_meta( $post->ID, '_lt_join', true ),
		);
	}
	return $items;
}

/** Normalise un événement. */
function logos_contenus_event( $post ) {
	$date = (string) get_post_meta( $post->ID, '_lt_date', true );
	return array(
		'id'        => $post->ID,
		'title'     => get_the_title( $post ),
		'date'      => $date,
		'time'      => (string) get_post_meta( $post->ID, '_lt_time', true ),
		'location'  => (string) get_post_meta( $post->ID, '_lt_location', true ),
		'summary'   => has_excerpt( $post ) ? get_the_excerpt( $post ) : wp_trim_words( wp_strip_all_tags( $post->post_content ), 40 ),
		'image_id'  => (int) get_post_thumbnail_id( $post ),
		'url'       => get_permalink( $post ),
		'upcoming'  => logos_contenus_is_upcoming( $date ),
		'cta'       => '0' !== get_post_meta( $post->ID, '_lt_cta', true ),
		'long_date' => logos_contenus_format_date( $date ),
		'day'       => logos_contenus_format_date( $date, 'day' ),
		'month'     => logos_contenus_format_date( $date, 'month' ),
	);
}

/**
 * Événements datés.
 *
 * @param string $when  upcoming (du plus proche au plus lointain) ou past (du plus récent au plus ancien).
 * @param int    $limit Nombre maximum (-1 = tous).
 */
function logos_get_events( $when = 'upcoming', $limit = -1 ) {
	$upcoming = 'upcoming' === $when;
	$posts    = get_posts(
		array(
			'post_type'        => 'lt_evenement',
			'post_status'      => 'publish',
			'posts_per_page'   => $limit,
			'meta_key'         => '_lt_date', // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_key
			'orderby'          => 'meta_value',
			'order'            => $upcoming ? 'ASC' : 'DESC',
			'meta_query'       => array( // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_query
				array(
					'key'     => '_lt_date',
					'value'   => logos_contenus_today(),
					'compare' => $upcoming ? '>=' : '<',
					'type'    => 'CHAR',
				),
				array(
					'key'     => '_lt_date',
					'value'   => '',
					'compare' => '!=',
				),
			),
			'suppress_filters' => false,
		)
	);
	return array_map( 'logos_contenus_event', $posts );
}

/** Normalise un enseignement. */
function logos_contenus_sermon( $post ) {
	$date = (string) get_post_meta( $post->ID, '_lt_date', true );
	return array(
		'id'         => $post->ID,
		'title'      => get_the_title( $post ),
		'youtube_id' => logos_contenus_youtube_id( get_post_meta( $post->ID, '_lt_youtube', true ) ),
		'speaker'    => (string) get_post_meta( $post->ID, '_lt_speaker', true ),
		'date'       => $date,
		'long_date'  => logos_contenus_format_date( $date ),
		'summary'    => has_excerpt( $post ) ? get_the_excerpt( $post ) : '',
		'image_id'   => (int) get_post_thumbnail_id( $post ),
		'url'        => get_permalink( $post ),
	);
}

/** Derniers enseignements (vidéos YouTube). */
function logos_get_sermons( $limit = 3 ) {
	$posts = get_posts(
		array(
			'post_type'        => 'lt_enseignement',
			'post_status'      => 'publish',
			'posts_per_page'   => $limit,
			'orderby'          => array( 'date' => 'DESC' ),
			'suppress_filters' => false,
		)
	);
	return array_values( array_filter( array_map( 'logos_contenus_sermon', $posts ), static function ( $s ) {
		return '' !== $s['youtube_id'];
	} ) );
}

/** Enseignement « À la une » (coché), sinon le dernier publié. */
function logos_get_featured_sermon() {
	$posts = get_posts(
		array(
			'post_type'        => 'lt_enseignement',
			'post_status'      => 'publish',
			'posts_per_page'   => 1,
			'meta_key'         => '_lt_featured', // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_key
			'meta_value'       => '1', // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_value
			'suppress_filters' => false,
		)
	);
	if ( $posts ) {
		$sermon = logos_contenus_sermon( $posts[0] );
		if ( $sermon['youtube_id'] ) {
			return $sermon;
		}
	}
	$latest = logos_get_sermons( 1 );
	return $latest ? $latest[0] : null;
}

/** Ressources PDF ayant un fichier. */
function logos_get_resources() {
	$items = array();
	foreach ( logos_contenus_query( 'lt_ressource' ) as $post ) {
		$file = (int) get_post_meta( $post->ID, '_lt_file', true );
		$url  = $file ? wp_get_attachment_url( $file ) : '';
		if ( ! $url ) {
			continue;
		}
		$size = (string) get_post_meta( $post->ID, '_lt_size', true );
		if ( '' === $size ) {
			$path = get_attached_file( $file );
			$size = $path && file_exists( $path ) ? str_replace( '.', ',', size_format( filesize( $path ), 1 ) ) : '';
		}
		$items[] = array(
			'id'    => $post->ID,
			'title' => get_the_title( $post ),
			'url'   => $url,
			'size'  => $size,
		);
	}
	return $items;
}

/** Normalise un membre de l'équipe. */
function logos_contenus_member( $post ) {
	$facts = get_post_meta( $post->ID, '_lt_facts', true );
	return array(
		'id'       => $post->ID,
		'name'     => get_the_title( $post ),
		'role'     => (string) get_post_meta( $post->ID, '_lt_role', true ),
		'image_id' => (int) get_post_thumbnail_id( $post ),
		'excerpt'  => has_excerpt( $post ) ? get_the_excerpt( $post ) : '',
		'content'  => $post->post_content,
		'facts'    => is_array( $facts ) ? array_values( array_filter( $facts, static function ( $f ) {
			return ! empty( $f['label'] ) || ! empty( $f['value'] );
		} ) ) : array(),
		'socials'  => array_filter(
			array(
				'facebook'  => get_post_meta( $post->ID, '_lt_facebook', true ),
				'instagram' => get_post_meta( $post->ID, '_lt_instagram', true ),
				'youtube'   => get_post_meta( $post->ID, '_lt_youtube', true ),
			)
		),
		'email'    => (string) get_post_meta( $post->ID, '_lt_email', true ),
		'phone'    => (string) get_post_meta( $post->ID, '_lt_phone', true ),
	);
}

/**
 * Équipe pastorale visible.
 *
 * @return array{lead: array|null, associates: array}
 */
function logos_get_team() {
	$lead       = null;
	$associates = array();
	foreach ( logos_contenus_query( 'lt_equipe' ) as $post ) {
		if ( '0' === get_post_meta( $post->ID, '_lt_visible', true ) ) {
			continue;
		}
		$member = logos_contenus_member( $post );
		if ( ! $lead && get_post_meta( $post->ID, '_lt_lead', true ) ) {
			$lead = $member;
		} else {
			$associates[] = $member;
		}
	}
	return array( 'lead' => $lead, 'associates' => $associates );
}
