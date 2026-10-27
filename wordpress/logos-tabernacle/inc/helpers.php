<?php
/**
 * Fonctions utilitaires du thème.
 *
 * @package Logos_Tabernacle
 */

defined( 'ABSPATH' ) || exit;

/** Jeu d'icônes SVG (style trait, 24 × 24), identique au site d'origine. */
function lt_icon_paths() {
	return array(
		'pin'        => '<path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/>',
		'phone'      => '<path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.13.96.36 1.9.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.91.34 1.85.57 2.81.7A2 2 0 0 1 22 16.92z"/>',
		'mail'       => '<rect x="2" y="4" width="20" height="16" rx="2"/><path d="m22 6-10 7L2 6"/>',
		'whatsapp'   => '<path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"/>',
		'user'       => '<path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/>',
		'clock'      => '<circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/>',
		'calendar'   => '<rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/>',
		'arrow'      => '<path d="M5 12h14M13 5l7 7-7 7"/>',
		'directions' => '<path d="m3 11 19-9-9 19-2-8-8-2z"/>',
		'play'       => '<path d="M8 5v14l11-7z" fill="currentColor" stroke="none"/>',
		'close'      => '<path d="M18 6 6 18M6 6l12 12"/>',
		'youtube'    => '<path d="M22.54 6.42a2.78 2.78 0 0 0-1.94-2C18.88 4 12 4 12 4s-6.88 0-8.6.46a2.78 2.78 0 0 0-1.94 2A29 29 0 0 0 1 11.75a29 29 0 0 0 .46 5.33A2.78 2.78 0 0 0 3.4 19c1.72.46 8.6.46 8.6.46s6.88 0 8.6-.46a2.78 2.78 0 0 0 1.94-2 29 29 0 0 0 .46-5.25 29 29 0 0 0-.46-5.33z"/><path d="m9.75 15.02 5.75-3.27-5.75-3.27v6.54z"/>',
		'facebook'   => '<path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/>',
		'instagram'  => '<rect x="2" y="2" width="20" height="20" rx="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37zM17.5 6.5h.01"/>',
		'tiktok'     => '<path d="M9 12a4 4 0 1 0 4 4V2a5 5 0 0 0 5 5"/>',
		'worship'    => '<path d="M12 2v6M9 5h6"/><path d="M5 22V12l7-4 7 4v10"/><path d="M10 22v-5h4v5"/>',
		'book'       => '<path d="M2 4h6a4 4 0 0 1 4 4v13a3 3 0 0 0-3-3H2z"/><path d="M22 4h-6a4 4 0 0 0-4 4v13a3 3 0 0 1 3-3h7z"/>',
		'children'   => '<path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75"/>',
		'music'      => '<path d="M9 18V5l12-2v13"/><circle cx="6" cy="18" r="3"/><circle cx="18" cy="16" r="3"/>',
		'heart'      => '<path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78L12 21.23l8.84-8.84a5.5 5.5 0 0 0 0-7.78z"/>',
		'prayer'     => '<path d="M12 3v4M12 17v4M3 12h4M17 12h4"/><circle cx="12" cy="12" r="4"/>',
		'hands'      => '<path d="M11 14h2a2 2 0 1 0 0-4h-3c-.6 0-1.1.2-1.4.6L3 16"/><path d="m7 20 1.6-1.4c.3-.4.8-.6 1.4-.6h4c1.1 0 2.1-.4 2.8-1.2l4.6-4.4a2 2 0 0 0-2.75-2.91l-4.2 3.9"/><path d="m2 15 6 6"/>',
		'download'   => '<path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4M7 10l5 5 5-5M12 15V3"/>',
		'search'     => '<circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/>',
		'chevron'    => '<path d="m6 9 6 6 6-6"/>',
	);
}

/**
 * Renvoie une icône SVG en ligne.
 *
 * @param string $name  Nom de l'icône.
 * @param int    $size  Taille en pixels.
 * @param string $class Classe CSS.
 */
function lt_icon( $name, $size = 24, $class = '' ) {
	$paths = lt_icon_paths();
	if ( ! isset( $paths[ $name ] ) ) {
		return '';
	}
	return sprintf(
		'<svg%1$s width="%2$d" height="%2$d" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false">%3$s</svg>',
		$class ? ' class="' . esc_attr( $class ) . '"' : '',
		(int) $size,
		$paths[ $name ]
	);
}

/** Les icônes sont des chaînes fixes du thème : sortie sûre. */
function lt_the_icon( $name, $size = 24, $class = '' ) {
	echo lt_icon( $name, $size, $class ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
}

/**
 * Transforme un lien saisi (chemin ou adresse complète) en URL.
 * « /contact/ » devient l'adresse du site + /contact/ ; « #visite » reste une ancre.
 */
function lt_url( $value ) {
	$value = trim( (string) $value );
	if ( '' === $value ) {
		return '';
	}
	if ( '#' === $value[0] ) {
		return $value;
	}
	if ( '/' === $value[0] && ( ! isset( $value[1] ) || '/' !== $value[1] ) ) {
		return home_url( $value );
	}
	return $value;
}

/** Vrai si l'URL sort du site (ouverture dans un nouvel onglet). */
function lt_is_external( $url ) {
	$host = wp_parse_url( $url, PHP_URL_HOST );
	return $host && wp_parse_url( home_url(), PHP_URL_HOST ) !== $host;
}

/** Attributs d'un lien externe. */
function lt_link_attrs( $url ) {
	return lt_is_external( $url ) ? ' target="_blank" rel="noopener noreferrer"' : '';
}

/** URL d'une image du thème. */
function lt_asset( $path ) {
	return LT_URI . '/assets/' . ltrim( $path, '/' );
}

/**
 * URL d'une image : fichier de la médiathèque, sinon image d'origine du thème.
 *
 * @param int    $attachment_id Fichier joint.
 * @param string $fallback      Chemin dans assets/images/.
 * @param string $size          Taille WordPress.
 */
function lt_image_url( $attachment_id, $fallback = '', $size = 'full' ) {
	if ( $attachment_id ) {
		$src = wp_get_attachment_image_url( (int) $attachment_id, $size );
		if ( $src ) {
			return $src;
		}
	}
	return $fallback ? lt_asset( 'images/' . $fallback ) : '';
}

/**
 * Balise <img> (avec srcset et texte alternatif de la médiathèque), sinon image d'origine.
 *
 * @param int    $attachment_id Fichier joint.
 * @param string $fallback      Chemin dans assets/images/.
 * @param array  $attrs         Attributs (class, alt, width, height, loading…).
 * @param string $size          Taille WordPress.
 */
function lt_image( $attachment_id, $fallback, $attrs = array(), $size = 'large' ) {
	$attrs = array_merge( array( 'loading' => 'lazy', 'decoding' => 'async' ), $attrs );
	if ( $attachment_id && wp_attachment_is_image( (int) $attachment_id ) ) {
		$alt = get_post_meta( (int) $attachment_id, '_wp_attachment_image_alt', true );
		if ( '' !== $alt ) {
			unset( $attrs['alt'] );
		}
		unset( $attrs['width'], $attrs['height'] );
		return wp_get_attachment_image( (int) $attachment_id, $size, false, $attrs );
	}
	if ( ! $fallback ) {
		return '';
	}
	$html = '<img src="' . esc_url( lt_asset( 'images/' . $fallback ) ) . '"';
	foreach ( array_merge( array( 'alt' => '' ), $attrs ) as $name => $value ) {
		$html .= ' ' . esc_attr( $name ) . '="' . esc_attr( $value ) . '"';
	}
	return $html . '>';
}

/** Numéro WhatsApp (chiffres seulement). */
function lt_whatsapp_number() {
	return preg_replace( '/\D+/', '', (string) lt_opt( 'site', 'whatsapp' ) );
}

/** Lien WhatsApp avec message prérempli. */
function lt_whatsapp_url( $text = null ) {
	if ( null === $text ) {
		$text = lt_opt( 'site', 'whatsapp_message' );
	}
	$url = 'https://wa.me/' . lt_whatsapp_number();
	return $text ? $url . '?text=' . rawurlencode( $text ) : $url;
}

/** Lien téléphone. */
function lt_phone_href() {
	return 'tel:' . preg_replace( '/[^0-9+]/', '', (string) lt_opt( 'site', 'phone' ) );
}

/** Cible de la carte : coordonnées GPS si renseignées, sinon adresse. */
function lt_maps_target() {
	$lat = trim( (string) lt_opt( 'site', 'latitude' ) );
	$lng = trim( (string) lt_opt( 'site', 'longitude' ) );
	if ( is_numeric( $lat ) && is_numeric( $lng ) ) {
		return $lat . ',' . $lng;
	}
	return (string) lt_opt( 'site', 'maps_query' );
}

function lt_maps_embed_url() {
	return 'https://www.google.com/maps?q=' . rawurlencode( lt_maps_target() ) . '&output=embed';
}

function lt_maps_directions_url() {
	return 'https://www.google.com/maps/dir/?api=1&destination=' . rawurlencode( lt_maps_target() );
}

/** Chaîne YouTube et lien des directs. */
function lt_youtube_channel() {
	return (string) lt_opt( 'site', 'youtube' );
}

function lt_live_url() {
	$live = (string) lt_opt( 'site', 'live_url' );
	return $live ? $live : rtrim( lt_youtube_channel(), '/' ) . '/streams';
}

/** Réseaux sociaux renseignés. */
function lt_socials() {
	$out = array();
	foreach ( array( 'youtube' => 'YouTube', 'facebook' => 'Facebook', 'instagram' => 'Instagram', 'tiktok' => 'TikTok' ) as $id => $label ) {
		$url = trim( (string) lt_opt( 'site', $id ) );
		if ( $url && '#' !== $url ) {
			$out[] = array( 'id' => $id, 'label' => $label, 'url' => $url );
		}
	}
	return $out;
}

/** Remplace les jetons ({fondation}, {annees}, {capacite}, {rendezvous}, {annee}, {site}). */
function lt_tokens( $text ) {
	$founded = (int) lt_opt( 'site', 'founded_year' );
	return strtr(
		(string) $text,
		array(
			'{fondation}'  => $founded,
			'{annees}'     => $founded ? (int) current_time( 'Y' ) - $founded : '',
			'{capacite}'   => number_format( (float) lt_opt( 'site', 'capacity' ), 0, ',', "\u{202F}" ),
			'{rendezvous}' => count( lt_data( 'schedule' ) ),
			'{annee}'      => current_time( 'Y' ),
			'{site}'       => lt_opt( 'site', 'name' ),
		)
	);
}

/**
 * Contenus fournis par l'extension « Logos Tabernacle – Contenus ».
 * Sans l'extension, renvoie une liste vide : les sections concernées se masquent.
 *
 * @param string $what schedule, ministries, events_upcoming, events_past, sermons, featured_sermon, resources, team.
 * @param mixed  $arg  Limite éventuelle.
 */
function lt_data( $what, $arg = null ) {
	static $cache = array();
	$key = $what . '|' . (string) $arg;
	if ( isset( $cache[ $key ] ) ) {
		return $cache[ $key ];
	}
	$result = array();
	switch ( $what ) {
		case 'schedule':
			$result = function_exists( 'logos_get_schedule' ) ? logos_get_schedule() : array();
			break;
		case 'ministries':
			$result = function_exists( 'logos_get_ministries' ) ? logos_get_ministries() : array();
			break;
		case 'events_upcoming':
			$result = function_exists( 'logos_get_events' ) ? logos_get_events( 'upcoming', null === $arg ? -1 : (int) $arg ) : array();
			break;
		case 'events_past':
			$result = function_exists( 'logos_get_events' ) ? logos_get_events( 'past', null === $arg ? -1 : (int) $arg ) : array();
			break;
		case 'sermons':
			$result = function_exists( 'logos_get_sermons' ) ? logos_get_sermons( null === $arg ? 3 : (int) $arg ) : array();
			break;
		case 'featured_sermon':
			$result = function_exists( 'logos_get_featured_sermon' ) ? logos_get_featured_sermon() : null;
			break;
		case 'resources':
			$result = function_exists( 'logos_get_resources' ) ? logos_get_resources() : array();
			break;
		case 'team':
			$result = function_exists( 'logos_get_team' ) ? logos_get_team() : array( 'lead' => null, 'associates' => array() );
			break;
	}
	$cache[ $key ] = $result;
	return $result;
}

/** Fournit le numéro WhatsApp au formulaire de l'extension. */
add_filter(
	'logos_whatsapp_number',
	static function ( $number ) {
		return $number ? $number : lt_whatsapp_number();
	}
);

/** Classe de fond d'une section. */
function lt_bg_class( $bg ) {
	return array_key_exists( $bg, lt_backgrounds() ) ? 'section--' . $bg : 'section--light';
}

/** Couleur CSS d'un fond de section. */
function lt_bg_var( $bg ) {
	$map = array( 'light' => '--c-paper', 'cream' => '--c-cream', 'dark' => '--c-ink', 'dark-2' => '--c-ink-2', 'graphite' => '--c-graphite' );
	return 'var(' . ( isset( $map[ $bg ] ) ? $map[ $bg ] : '--c-paper' ) . ')';
}

/**
 * Réglage d'une section de l'accueil.
 *
 * @param string $section Clé de la section.
 * @param string $key     Champ.
 */
function lt_home( $section, $key ) {
	return lt_opt( 'home', $section . '_' . $key );
}

/** Données d'une page intérieure (champs du gabarit + en-tête). */
function lt_page( $key, $post_id = null ) {
	$post_id = $post_id ? $post_id : get_queried_object_id();
	return function_exists( 'lt_page_value' ) ? lt_page_value( $post_id, $key ) : '';
}

/** Affiche un bouton/lien seulement si le texte et l'adresse existent. */
function lt_button( $label, $url, $class = 'btn btn--outline', $icon = 'arrow' ) {
	$url = lt_url( $url );
	if ( '' === trim( (string) $label ) || '' === $url ) {
		return '';
	}
	return '<a href="' . esc_url( $url ) . '" class="' . esc_attr( $class ) . '"' . lt_link_attrs( $url ) . '>' . esc_html( $label ) . ( $icon ? lt_icon( $icon ) : '' ) . '</a>';
}

/** Bouton LIVE. */
function lt_live_button( $label = 'Live', $size = '' ) {
	return sprintf(
		'<a href="%1$s" class="btn btn--live%2$s" target="_blank" rel="noopener noreferrer" aria-label="%3$s"><span class="btn--live__dot" aria-hidden="true"></span>%4$s</a>',
		esc_url( lt_live_url() ),
		$size ? ' btn--' . esc_attr( $size ) : '',
		esc_attr( sprintf( /* translators: %s: libellé du bouton. */ __( '%s sur YouTube', 'logos-tabernacle' ), $label ) ),
		esc_html( $label )
	);
}

/** URL d'une page créée par le thème (par son gabarit), sinon chemin d'origine. */
function lt_template_page_url( $template, $fallback ) {
	$pages = get_pages( array( 'meta_key' => '_wp_page_template', 'meta_value' => 'page-templates/' . $template . '.php', 'number' => 1 ) ); // phpcs:ignore WordPress.DB.SlowDBQuery
	return $pages ? get_permalink( $pages[0] ) : home_url( $fallback );
}

/** Bandeau d'en-tête de la page courante (si activé). */
function lt_the_page_header( $args = array() ) {
	$post_id = get_queried_object_id();
	if ( is_page() && ! lt_page( 'show_header', $post_id ) ) {
		return;
	}
	$images = array(
		'a-propos'      => 'assemblee.jpg',
		'programmes'    => 'louange.jpg',
		'enseignements' => 'ambiance-temple.jpg',
		'evenements'    => 'assemblee.jpg',
	);
	$template = is_page() ? lt_page_template_slug( $post_id ) : '';
	get_template_part(
		'template-parts/page-header',
		null,
		wp_parse_args(
			$args,
			array(
				'title'    => get_the_title( $post_id ),
				'eyebrow'  => is_page() ? lt_page( 'eyebrow', $post_id ) : '',
				'intro'    => is_page() ? lt_page( 'intro', $post_id ) : '',
				'image_id' => (int) get_post_thumbnail_id( $post_id ),
				'image'    => isset( $images[ $template ] ) ? $images[ $template ] : 'temple-interieur.jpg',
			)
		)
	);
}

/** Bandeau d'appel à l'action d'une page (selon ses réglages). */
function lt_the_page_cta() {
	if ( ! lt_page( 'cta_show' ) ) {
		return;
	}
	get_template_part( 'template-parts/cta-band', null, array( 'title' => lt_page( 'cta_title' ), 'text' => lt_page( 'cta_text' ) ) );
}

/** Contenu libre ajouté dans l'éditeur d'une page à gabarit (affiché seulement s'il existe). */
function lt_the_extra_content() {
	if ( '' === trim( (string) get_post_field( 'post_content', get_queried_object_id() ) ) ) {
		return;
	}
	echo '<section class="section section--light"><div class="container container--narrow entry-content">';
	the_content();
	echo '</div></section>';
}

/**
 * Découpe une biographie en chapitres : chaque intertitre de niveau 3 ouvre un chapitre.
 *
 * @return array<int, array{title: string, html: string}>
 */
function lt_split_chapters( $content ) {
	$html  = apply_filters( 'the_content', (string) $content ); // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedHooknameFound -- filtre du noyau.
	$parts = preg_split( '#<h3[^>]*>(.*?)</h3>#is', $html, -1, PREG_SPLIT_DELIM_CAPTURE );
	$out   = array();
	$intro = trim( (string) array_shift( $parts ) );
	if ( '' !== wp_strip_all_tags( $intro ) ) {
		$out[] = array( 'title' => '', 'html' => $intro );
	}
	for ( $i = 0; $i < count( $parts ); $i += 2 ) { // phpcs:ignore Squiz.PHP.DisallowSizeFunctionsInLoops.Found
		$out[] = array(
			'title' => wp_strip_all_tags( $parts[ $i ] ),
			'html'  => isset( $parts[ $i + 1 ] ) ? trim( $parts[ $i + 1 ] ) : '',
		);
	}
	return $out;
}

/** Pagination des listes d'articles. */
function lt_pagination() {
	the_posts_pagination(
		array(
			'mid_size'           => 1,
			'prev_text'          => __( 'Précédent', 'logos-tabernacle' ),
			'next_text'          => __( 'Suivant', 'logos-tabernacle' ),
			'screen_reader_text' => __( 'Navigation des pages', 'logos-tabernacle' ),
			'class'              => 'pagination',
		)
	);
}

/** Identifiant de la page utilisant un gabarit donné (0 si aucune). */
function lt_template_page_id( $template ) {
	$pages = get_pages( array( 'meta_key' => '_wp_page_template', 'meta_value' => 'page-templates/' . $template . '.php', 'number' => 1 ) ); // phpcs:ignore WordPress.DB.SlowDBQuery
	return $pages ? (int) $pages[0]->ID : 0;
}
