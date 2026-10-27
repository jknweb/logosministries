<?php
/**
 * Fonctionnalités WordPress du thème.
 *
 * @package Logos_Tabernacle
 */

defined( 'ABSPATH' ) || exit;

add_action(
	'after_setup_theme',
	static function () {
		load_theme_textdomain( 'logos-tabernacle', LT_DIR . '/languages' );

		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script', 'navigation-widgets' ) );
		add_theme_support( 'responsive-embeds' );
		add_theme_support( 'align-wide' );
		add_theme_support( 'editor-styles' );
		add_editor_style( array( 'assets/css/editor.css' ) );

		register_nav_menus(
			array(
				'primary' => __( 'Menu principal (en-tête)', 'logos-tabernacle' ),
				'footer'  => __( 'Pied de page : colonne Navigation', 'logos-tabernacle' ),
				'legal'   => __( 'Pied de page : liens légaux', 'logos-tabernacle' ),
			)
		);

		add_image_size( 'lt-card', 800, 500, true );
		add_image_size( 'lt-portrait', 600, 750, true );

		$GLOBALS['content_width'] = 800;
	}
);

// Anciennes adresses du site React (en anglais) redirigées vers les nouvelles.
add_action(
	'template_redirect',
	static function () {
		if ( ! is_404() ) {
			return;
		}
		$path   = trim( (string) wp_parse_url( isset( $_SERVER['REQUEST_URI'] ) ? esc_url_raw( wp_unslash( $_SERVER['REQUEST_URI'] ) ) : '', PHP_URL_PATH ), '/' );
		$legacy = array(
			'about'     => 'a-propos',
			'pastor'    => 'pasteur',
			'programs'  => 'programmes',
			'teachings' => 'enseignements',
			'events'    => 'evenements',
		);
		if ( isset( $legacy[ $path ] ) ) {
			wp_safe_redirect( home_url( '/' . $legacy[ $path ] . '/' ), 301 );
			exit;
		}
	}
);

// Extraits courts, sans « [...] ».
add_filter(
	'excerpt_length',
	static function () {
		return 32;
	}
);
add_filter(
	'excerpt_more',
	static function () {
		return '…';
	}
);

// Favicon d'origine tant qu'aucune icône n'est définie dans le Personnaliseur.
add_action(
	'wp_head',
	static function () {
		if ( has_site_icon() ) {
			return;
		}
		echo '<link rel="icon" type="image/png" sizes="32x32" href="' . esc_url( lt_asset( 'images/favicon.png' ) ) . '">' . "\n";
		echo '<link rel="icon" type="image/png" sizes="48x48" href="' . esc_url( lt_asset( 'images/favicon-48.png' ) ) . '">' . "\n";
		echo '<link rel="apple-touch-icon" href="' . esc_url( lt_asset( 'images/apple-touch-icon.png' ) ) . '">' . "\n";
	},
	3
);

add_action(
	'wp_head',
	static function () {
		echo '<meta name="theme-color" content="' . esc_attr( lt_design( 'ink' ) ) . '">' . "\n";
	},
	2
);

// Titre de la page d'accueil comme sur le site d'origine.
add_filter(
	'document_title_parts',
	static function ( $parts ) {
		if ( is_front_page() ) {
			$parts['title']   = lt_opt( 'site', 'name' );
			$parts['tagline'] = __( 'Église à Kinshasa-Ngaliema', 'logos-tabernacle' );
		} elseif ( isset( $parts['site'] ) ) {
			$parts['site'] = lt_opt( 'site', 'name' );
		}
		return $parts;
	}
);
add_filter(
	'document_title_separator',
	static function () {
		return '·';
	}
);

// Classes du <body> utiles aux styles.
add_filter(
	'body_class',
	static function ( $classes ) {
		if ( 'solid' === lt_opt( 'header', 'behavior' ) ) {
			$classes[] = 'lt-header-solid';
		}
		return $classes;
	}
);

// Recherche : seulement les contenus publics utiles.
add_action(
	'pre_get_posts',
	static function ( $query ) {
		if ( ! is_admin() && $query->is_main_query() && $query->is_search() ) {
			$query->set( 'post_type', array( 'post', 'page', 'lt_evenement', 'lt_enseignement' ) );
		}
	}
);
