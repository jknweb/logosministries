<?php
/**
 * Feuilles de style et scripts.
 *
 * @package Logos_Tabernacle
 */

defined( 'ABSPATH' ) || exit;

add_action(
	'wp_enqueue_scripts',
	static function () {
		$version = LT_VERSION;
		wp_enqueue_style( 'lt-fonts', lt_fonts_url(), array(), null ); // phpcs:ignore WordPress.WP.EnqueuedResourceParameters.MissingVersion -- version gérée par Google Fonts.
		wp_enqueue_style( 'lt-site', LT_URI . '/assets/css/site.css', array(), $version );
		wp_enqueue_style( 'lt-theme', LT_URI . '/assets/css/theme.css', array( 'lt-site' ), $version );

		$css = lt_design_css();
		$bp  = (int) lt_opt( 'header', 'mobile_breakpoint' );
		if ( $bp && 1200 !== $bp ) {
			$css .= lt_mobile_menu_css( $bp );
		}
		if ( $css ) {
			wp_add_inline_style( 'lt-theme', $css );
		}

		wp_enqueue_script( 'lt-main', LT_URI . '/assets/js/main.js', array(), $version, array( 'strategy' => 'defer', 'in_footer' => true ) );

		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
	}
);

// Connexion anticipée aux serveurs de polices.
add_filter(
	'wp_resource_hints',
	static function ( $urls, $relation ) {
		if ( 'preconnect' === $relation ) {
			$urls[] = 'https://fonts.googleapis.com';
			$urls[] = array( 'href' => 'https://fonts.gstatic.com', 'crossorigin' );
		}
		return $urls;
	},
	10,
	2
);

/**
 * Le site d'origine bascule en menu mobile sous 1200 px. Pour un autre seuil,
 * on rétablit le menu horizontal entre ce seuil et 1200 px.
 */
function lt_mobile_menu_css( $bp ) {
	$min = $bp + 1;
	return "@media (min-width:{$min}px) and (max-width:1200px){"
		. '.burger{display:none}'
		. '.main-nav{position:static;display:block;padding:0;background:none;overflow:visible;visibility:visible;opacity:1;transform:none;transition:none}'
		. '.main-nav__list{flex-direction:row;gap:1.1rem}'
		. '.main-nav__link{display:inline;padding:.4rem 0;font-family:inherit;font-size:var(--fs-sm);border-bottom:0}'
		. '.main-nav__link::after{display:block}'
		. '.main-nav__cta{display:none}'
		. '}';
}
