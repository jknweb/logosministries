<?php
/**
 * À l'activation du thème : création des pages du site d'origine (mêmes adresses),
 * page d'accueil statique et menus. Rien n'est écrasé si les pages existent déjà.
 *
 * @package Logos_Tabernacle
 */

defined( 'ABSPATH' ) || exit;

/** Pages du site d'origine : slug => [titre, gabarit, contenu]. */
function lt_default_pages() {
	$about = '<!-- wp:paragraph --><p>L’histoire de Logos Tabernacle commence dans un contexte d’évangélisation intense. Après sa conversion, le pasteur Yves Kalombo prêche l’Évangile dans les rues, les bus, les marchés, puis parmi les étudiants de l’ISTA à Kinshasa. Très vite, de nombreuses personnes répondent à la prédication.</p><!-- /wp:paragraph -->'
		. "\n\n" . '<!-- wp:paragraph --><p>Il oriente d’abord ses convertis vers l’assemblée de Righini. Mais la distance, les difficultés de transport et le nombre croissant de personnes touchées rendent nécessaire l’ouverture d’une nouvelle assemblée à Ozone, dans la commune de Ngaliema, en réponse à une vision reçue du Seigneur.</p><!-- /wp:paragraph -->';

	return array(
		'accueil'       => array( __( 'Accueil', 'logos-tabernacle' ), '', '' ),
		'a-propos'      => array( __( 'À propos de nous', 'logos-tabernacle' ), 'a-propos', $about ),
		'pasteur'       => array( __( 'Le pasteur visionnaire', 'logos-tabernacle' ), 'pasteur', '' ),
		'programmes'    => array( __( 'Programmes et départements', 'logos-tabernacle' ), 'programmes', '' ),
		'enseignements' => array( __( 'Enseignements', 'logos-tabernacle' ), 'enseignements', '' ),
		'evenements'    => array( __( 'Événements', 'logos-tabernacle' ), 'evenements', '' ),
		'contact'       => array( __( 'Nous contacter', 'logos-tabernacle' ), 'contact', '' ),
		'actualites'    => array( __( 'Actualités', 'logos-tabernacle' ), '', '' ),
	);
}

/** Libellés courts du menu (comme le site d'origine). */
function lt_default_menu_labels() {
	return array(
		'accueil'       => __( 'Accueil', 'logos-tabernacle' ),
		'a-propos'      => __( 'À propos', 'logos-tabernacle' ),
		'pasteur'       => __( 'Pasteur', 'logos-tabernacle' ),
		'programmes'    => __( 'Programmes', 'logos-tabernacle' ),
		'enseignements' => __( 'Enseignements', 'logos-tabernacle' ),
		'evenements'    => __( 'Événements', 'logos-tabernacle' ),
		'contact'       => __( 'Contact', 'logos-tabernacle' ),
	);
}

/** Crée les pages, la page d'accueil statique et le menu principal. */
function lt_setup_site() {
	$ids = array();
	foreach ( lt_default_pages() as $slug => $page ) {
		$existing = get_page_by_path( $slug );
		if ( $existing ) {
			$ids[ $slug ] = $existing->ID;
			continue;
		}
		$id = wp_insert_post(
			array(
				'post_type'    => 'page',
				'post_status'  => 'publish',
				'post_title'   => $page[0],
				'post_name'    => $slug,
				'post_content' => $page[2],
			)
		);
		if ( $id && ! is_wp_error( $id ) ) {
			$ids[ $slug ] = $id;
			if ( $page[1] ) {
				update_post_meta( $id, '_wp_page_template', 'page-templates/' . $page[1] . '.php' );
			}
		}
	}

	if ( ! empty( $ids['accueil'] ) && 'page' !== get_option( 'show_on_front' ) ) {
		update_option( 'show_on_front', 'page' );
		update_option( 'page_on_front', $ids['accueil'] );
		if ( ! empty( $ids['actualites'] ) ) {
			update_option( 'page_for_posts', $ids['actualites'] );
		}
	}

	$locations = get_theme_mod( 'nav_menu_locations', array() );
	if ( empty( $locations['primary'] ) ) {
		$menu_name = __( 'Menu principal', 'logos-tabernacle' );
		$menu      = wp_get_nav_menu_object( $menu_name );
		$menu_id   = $menu ? $menu->term_id : wp_create_nav_menu( $menu_name );
		if ( $menu_id && ! is_wp_error( $menu_id ) && ! $menu ) {
			$position = 1;
			foreach ( lt_default_menu_labels() as $slug => $label ) {
				if ( empty( $ids[ $slug ] ) ) {
					continue;
				}
				wp_update_nav_menu_item(
					$menu_id,
					0,
					array(
						'menu-item-title'     => $label,
						'menu-item-object'    => 'page',
						'menu-item-object-id' => $ids[ $slug ],
						'menu-item-type'      => 'post_type',
						'menu-item-status'    => 'publish',
						'menu-item-position'  => $position++,
					)
				);
			}
		}
		if ( $menu_id && ! is_wp_error( $menu_id ) ) {
			$locations['primary'] = $menu_id;
			set_theme_mod( 'nav_menu_locations', $locations );
		}
	}

	update_option( 'lt_setup_done', LT_VERSION, false );
	flush_rewrite_rules();
}

add_action( 'after_switch_theme', 'lt_setup_site' );

// Rappel discret si l'extension de contenus n'est pas active.
add_action(
	'admin_notices',
	static function () {
		if ( function_exists( 'logos_get_schedule' ) || ! current_user_can( 'activate_plugins' ) ) {
			return;
		}
		echo '<div class="notice notice-warning"><p>' . wp_kses_post(
			sprintf(
				/* translators: %s: lien vers les extensions. */
				__( 'Thème Logos Tabernacle : installez et activez l’extension <strong>« Logos Tabernacle – Contenus »</strong> (fichier logos-tabernacle-contenus.zip) pour gérer les horaires, événements, enseignements, départements, l’équipe et le formulaire de contact. <a href="%s">Aller aux extensions</a>.', 'logos-tabernacle' ),
				esc_url( admin_url( 'plugin-install.php?tab=upload' ) )
			)
		) . '</p></div>';
	}
);
