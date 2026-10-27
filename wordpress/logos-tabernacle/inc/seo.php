<?php
/**
 * Référencement : description, Open Graph et données structurées.
 * Désactivé automatiquement si Yoast SEO, Rank Math, SEOPress ou All in One SEO est actif.
 *
 * @package Logos_Tabernacle
 */

defined( 'ABSPATH' ) || exit;

/** Vrai si une extension SEO gère déjà les métadonnées. */
function lt_seo_plugin_active() {
	return defined( 'WPSEO_VERSION' ) || defined( 'RANK_MATH_VERSION' ) || defined( 'SEOPRESS_VERSION' ) || defined( 'AIOSEO_VERSION' );
}

/** Description de la page courante. */
function lt_meta_description() {
	$description = '';
	if ( is_singular() ) {
		$post = get_queried_object();
		if ( 'page' === $post->post_type ) {
			$description = (string) lt_page( 'seo_description', $post->ID );
			if ( '' === $description ) {
				$description = (string) lt_page( 'intro', $post->ID );
			}
		}
		if ( '' === $description && has_excerpt( $post ) ) {
			$description = get_the_excerpt( $post );
		}
		if ( '' === $description && ! is_front_page() ) {
			$description = wp_trim_words( wp_strip_all_tags( strip_shortcodes( $post->post_content ) ), 30, '…' );
		}
	} elseif ( is_category() || is_tag() || is_tax() ) {
		$description = wp_strip_all_tags( term_description() );
	}
	if ( '' === trim( $description ) ) {
		$description = (string) lt_opt( 'site', 'description' );
	}
	return trim( preg_replace( '/\s+/', ' ', $description ) );
}

/** Image de partage de la page courante. */
function lt_share_image() {
	if ( is_singular() && has_post_thumbnail() ) {
		return get_the_post_thumbnail_url( null, 'large' );
	}
	return lt_image_url( (int) lt_opt( 'site', 'og_image' ), 'og-logos.jpg' );
}

add_action(
	'wp_head',
	static function () {
		if ( lt_seo_plugin_active() ) {
			return;
		}
		$description = lt_meta_description();
		$title       = wp_get_document_title();
		$url         = is_singular() ? get_permalink() : home_url( add_query_arg( array() ) );
		echo '<meta name="description" content="' . esc_attr( $description ) . '">' . "\n";
		echo '<meta property="og:type" content="' . ( is_singular( 'post' ) ? 'article' : 'website' ) . '">' . "\n";
		echo '<meta property="og:locale" content="fr_FR">' . "\n";
		echo '<meta property="og:site_name" content="' . esc_attr( lt_opt( 'site', 'name' ) ) . '">' . "\n";
		echo '<meta property="og:title" content="' . esc_attr( $title ) . '">' . "\n";
		echo '<meta property="og:description" content="' . esc_attr( $description ) . '">' . "\n";
		echo '<meta property="og:url" content="' . esc_url( $url ) . '">' . "\n";
		echo '<meta property="og:image" content="' . esc_url( lt_share_image() ) . '">' . "\n";
		echo '<meta name="twitter:card" content="summary_large_image">' . "\n";
	},
	4
);

/** Données structurées : l'église (accueil) et les événements. */
add_action(
	'wp_footer',
	static function () {
		$data = null;
		if ( is_front_page() ) {
			$data = array(
				'@context'    => 'https://schema.org',
				'@type'       => 'Church',
				'name'        => lt_opt( 'site', 'name' ),
				'url'         => home_url( '/' ),
				'logo'        => lt_image_url( (int) lt_opt( 'site', 'logo' ), 'logo-logos.png' ),
				'image'       => lt_image_url( (int) lt_opt( 'site', 'og_image' ), 'og-logos.jpg' ),
				'telephone'   => lt_opt( 'site', 'phone' ),
				'email'       => lt_opt( 'site', 'email' ),
				'foundingDate' => (string) lt_opt( 'site', 'founded_year' ),
				'address'     => array(
					'@type'           => 'PostalAddress',
					'streetAddress'   => lt_opt( 'site', 'address' ),
					'addressLocality' => lt_opt( 'site', 'city' ),
					'addressCountry'  => 'CD',
				),
				'sameAs'      => wp_list_pluck( lt_socials(), 'url' ),
			);
			$lat = lt_opt( 'site', 'latitude' );
			$lng = lt_opt( 'site', 'longitude' );
			if ( is_numeric( $lat ) && is_numeric( $lng ) ) {
				$data['geo'] = array( '@type' => 'GeoCoordinates', 'latitude' => (float) $lat, 'longitude' => (float) $lng );
			}
		} elseif ( is_singular( 'lt_evenement' ) && function_exists( 'logos_contenus_event' ) ) {
			$event = logos_contenus_event( get_queried_object() );
			if ( $event['date'] ) {
				$data = array(
					'@context'            => 'https://schema.org',
					'@type'               => 'Event',
					'name'                => $event['title'],
					'startDate'           => $event['date'],
					'description'         => $event['summary'],
					'eventAttendanceMode' => 'https://schema.org/OfflineEventAttendanceMode',
					'eventStatus'         => 'https://schema.org/EventScheduled',
					'location'            => array(
						'@type'   => 'Place',
						'name'    => $event['location'] ? $event['location'] : lt_opt( 'site', 'name' ),
						'address' => lt_opt( 'site', 'address' ) . ', ' . lt_opt( 'site', 'city' ),
					),
					'organizer'           => array( '@type' => 'Organization', 'name' => lt_opt( 'site', 'name' ), 'url' => home_url( '/' ) ),
				);
				if ( $event['image_id'] ) {
					$data['image'] = wp_get_attachment_image_url( $event['image_id'], 'large' );
				}
			}
		}
		if ( $data ) {
			echo '<script type="application/ld+json">' . wp_json_encode( $data, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE ) . '</script>' . "\n";
		}
	}
);
