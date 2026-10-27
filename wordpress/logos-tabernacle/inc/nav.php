<?php
/**
 * Menus : rendu fidèle au site d'origine, sous-menus compris.
 *
 * @package Logos_Tabernacle
 */

defined( 'ABSPATH' ) || exit;

/** Rendu du menu principal (classes du site d'origine, sous-menus accessibles). */
class LT_Nav_Walker extends Walker_Nav_Menu {

	public function start_lvl( &$output, $depth = 0, $args = null ) {
		$output .= '<ul class="sub-menu">';
	}

	public function end_lvl( &$output, $depth = 0, $args = null ) {
		$output .= '</ul>';
	}

	public function start_el( &$output, $data_object, $depth = 0, $args = null, $current_object_id = 0 ) {
		$item     = $data_object;
		$classes  = empty( $item->classes ) ? array() : (array) $item->classes;
		$current  = array_intersect( $classes, array( 'current-menu-item', 'current-menu-ancestor', 'current_page_item', 'current_page_parent', 'current-page-ancestor' ) );
		$has_kids = in_array( 'menu-item-has-children', $classes, true );

		$li_classes = array( 'menu-item' );
		if ( $has_kids ) {
			$li_classes[] = 'menu-item-has-children';
		}
		$link_class = 'main-nav__link' . ( $current ? ' active' : '' );

		$atts = array(
			'href'   => ! empty( $item->url ) ? $item->url : '',
			'class'  => $link_class,
			'target' => ! empty( $item->target ) ? $item->target : '',
			'rel'    => ! empty( $item->xfn ) ? $item->xfn : ( '_blank' === $item->target ? 'noopener noreferrer' : '' ),
			'title'  => ! empty( $item->attr_title ) ? $item->attr_title : '',
		);
		if ( in_array( 'current-menu-item', $classes, true ) ) {
			$atts['aria-current'] = 'page';
		}

		$attr_html = '';
		foreach ( $atts as $name => $value ) {
			if ( '' !== $value ) {
				$attr_html .= ' ' . $name . '="' . ( 'href' === $name ? esc_url( $value ) : esc_attr( $value ) ) . '"';
			}
		}

		$title   = apply_filters( 'nav_menu_item_title', $item->title, $item, $args, $depth ); // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedHooknameFound -- filtre du noyau.
		$output .= '<li class="' . esc_attr( implode( ' ', $li_classes ) ) . '"><a' . $attr_html . '>' . esc_html( $title ) . '</a>';
		if ( $has_kids ) {
			$output .= '<button type="button" class="sub-menu__toggle" aria-expanded="false"><span class="visually-hidden">' . esc_html( sprintf( /* translators: %s: élément de menu. */ __( 'Afficher le sous-menu %s', 'logos-tabernacle' ), $title ) ) . '</span>' . lt_icon( 'chevron', 16 ) . '</button>';
		}
	}

	public function end_el( &$output, $data_object, $depth = 0, $args = null ) {
		$output .= '</li>';
	}
}

/** Liens par défaut quand aucun menu n'est encore attribué. */
function lt_default_links() {
	return array(
		array( home_url( '/' ), __( 'Accueil', 'logos-tabernacle' ) ),
		array( lt_template_page_url( 'a-propos', '/a-propos/' ), __( 'À propos', 'logos-tabernacle' ) ),
		array( lt_template_page_url( 'pasteur', '/pasteur/' ), __( 'Pasteur', 'logos-tabernacle' ) ),
		array( lt_template_page_url( 'programmes', '/programmes/' ), __( 'Programmes', 'logos-tabernacle' ) ),
		array( lt_template_page_url( 'enseignements', '/enseignements/' ), __( 'Enseignements', 'logos-tabernacle' ) ),
		array( lt_template_page_url( 'evenements', '/evenements/' ), __( 'Événements', 'logos-tabernacle' ) ),
		array( lt_template_page_url( 'contact', '/contact/' ), __( 'Contact', 'logos-tabernacle' ) ),
	);
}

/** Menu principal de secours. */
function lt_nav_fallback() {
	$current = home_url( add_query_arg( array() ) );
	echo '<ul class="main-nav__list">';
	foreach ( lt_default_links() as $link ) {
		$active = untrailingslashit( $link[0] ) === untrailingslashit( strtok( $current, '?' ) );
		echo '<li class="menu-item"><a class="main-nav__link' . ( $active ? ' active' : '' ) . '" href="' . esc_url( $link[0] ) . '"' . ( $active ? ' aria-current="page"' : '' ) . '>' . esc_html( $link[1] ) . '</a></li>';
	}
	echo '</ul>';
}

/** Colonne « Navigation » du pied de page : menu « footer », sinon menu principal, sinon liens par défaut. */
function lt_footer_nav() {
	foreach ( array( 'footer', 'primary' ) as $location ) {
		if ( has_nav_menu( $location ) ) {
			wp_nav_menu(
				array(
					'theme_location' => $location,
					'container'      => false,
					'menu_class'     => 'site-footer__list',
					'depth'          => 1,
				)
			);
			return;
		}
	}
	echo '<ul class="site-footer__list">';
	foreach ( lt_default_links() as $link ) {
		echo '<li><a href="' . esc_url( $link[0] ) . '">' . esc_html( $link[1] ) . '</a></li>';
	}
	echo '</ul>';
}
