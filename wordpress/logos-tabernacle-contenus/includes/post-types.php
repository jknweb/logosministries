<?php
/**
 * Types de contenu de l'église.
 *
 * @package Logos_Contenus
 */

defined( 'ABSPATH' ) || exit;

/** Slug du menu « Église » qui regroupe les contenus. */
const LOGOS_CONTENUS_MENU = 'logos-contenus';

/**
 * Libellés français d'un type de contenu.
 *
 * @param string $singular  Nom au singulier.
 * @param string $plural    Nom au pluriel.
 * @param bool   $feminine  Accorde « nouveau / nouvelle ».
 */
function logos_contenus_labels( $singular, $plural, $feminine = false ) {
	$new = $feminine ? __( 'Nouvelle', 'logos-tabernacle' ) : __( 'Nouveau', 'logos-tabernacle' );
	$lc  = function_exists( 'mb_strtolower' ) ? mb_strtolower( $singular ) : strtolower( $singular );
	return array(
		'name'               => $plural,
		'singular_name'      => $singular,
		'menu_name'          => $plural,
		'all_items'          => $plural,
		'add_new'            => __( 'Ajouter', 'logos-tabernacle' ),
		'add_new_item'       => sprintf( '%s %s', $feminine ? __( 'Ajouter une', 'logos-tabernacle' ) : __( 'Ajouter un', 'logos-tabernacle' ), $lc ),
		'edit_item'          => sprintf( __( 'Modifier : %s', 'logos-tabernacle' ), $lc ),
		'new_item'           => sprintf( '%s %s', $new, $lc ),
		'view_item'          => __( 'Voir', 'logos-tabernacle' ),
		'search_items'       => __( 'Rechercher', 'logos-tabernacle' ),
		'not_found'          => __( 'Aucun élément trouvé.', 'logos-tabernacle' ),
		'not_found_in_trash' => __( 'Aucun élément dans la corbeille.', 'logos-tabernacle' ),
		'featured_image'     => __( 'Image', 'logos-tabernacle' ),
		'set_featured_image' => __( 'Choisir l’image', 'logos-tabernacle' ),
		'remove_featured_image' => __( 'Retirer l’image', 'logos-tabernacle' ),
		'use_featured_image' => __( 'Utiliser comme image', 'logos-tabernacle' ),
	);
}

/** Déclare les types de contenu. */
function logos_contenus_register_post_types() {
	$common = array(
		'show_ui'      => true,
		'show_in_menu' => LOGOS_CONTENUS_MENU,
		'show_in_rest' => true,
		'map_meta_cap' => true,
	);

	register_post_type(
		'lt_evenement',
		array_merge(
			$common,
			array(
				'labels'      => logos_contenus_labels( __( 'Événement', 'logos-tabernacle' ), __( 'Événements', 'logos-tabernacle' ) ),
				'public'      => true,
				'has_archive' => false,
				'rewrite'     => array( 'slug' => 'evenement', 'with_front' => false ),
				'supports'    => array( 'title', 'editor', 'excerpt', 'thumbnail' ),
				'menu_icon'   => 'dashicons-calendar-alt',
			)
		)
	);

	register_post_type(
		'lt_enseignement',
		array_merge(
			$common,
			array(
				'labels'      => logos_contenus_labels( __( 'Enseignement', 'logos-tabernacle' ), __( 'Enseignements', 'logos-tabernacle' ) ),
				'public'      => true,
				'has_archive' => false,
				'rewrite'     => array( 'slug' => 'enseignement', 'with_front' => false ),
				'supports'    => array( 'title', 'editor', 'excerpt', 'thumbnail' ),
			)
		)
	);

	register_post_type(
		'lt_ressource',
		array_merge(
			$common,
			array(
				'labels'   => logos_contenus_labels( __( 'Ressource PDF', 'logos-tabernacle' ), __( 'Ressources PDF', 'logos-tabernacle' ), true ),
				'public'   => false,
				'supports' => array( 'title', 'page-attributes' ),
			)
		)
	);

	register_post_type(
		'lt_horaire',
		array_merge(
			$common,
			array(
				'labels'   => logos_contenus_labels( __( 'Horaire', 'logos-tabernacle' ), __( 'Horaires', 'logos-tabernacle' ) ),
				'public'   => false,
				'supports' => array( 'title', 'page-attributes' ),
			)
		)
	);

	register_post_type(
		'lt_departement',
		array_merge(
			$common,
			array(
				'labels'   => logos_contenus_labels( __( 'Département', 'logos-tabernacle' ), __( 'Départements', 'logos-tabernacle' ) ),
				'public'   => false,
				'supports' => array( 'title', 'page-attributes' ),
			)
		)
	);

	register_post_type(
		'lt_equipe',
		array_merge(
			$common,
			array(
				'labels'   => logos_contenus_labels( __( 'Membre de l’équipe', 'logos-tabernacle' ), __( 'Équipe pastorale', 'logos-tabernacle' ) ),
				'public'   => false,
				'supports' => array( 'title', 'editor', 'excerpt', 'thumbnail', 'page-attributes' ),
			)
		)
	);

	register_post_type(
		'lt_message',
		array(
			'labels'       => logos_contenus_labels( __( 'Message reçu', 'logos-tabernacle' ), __( 'Messages reçus', 'logos-tabernacle' ) ),
			'public'       => false,
			'show_ui'      => true,
			'show_in_menu' => LOGOS_CONTENUS_MENU,
			'show_in_rest' => false,
			'supports'     => array( 'title' ),
			'map_meta_cap' => true,
			'capabilities' => array( 'create_posts' => 'do_not_allow' ),
		)
	);
}
add_action( 'init', 'logos_contenus_register_post_types' );

/** Types gérés par l'extension (hors messages). */
function logos_contenus_types() {
	return array( 'lt_evenement', 'lt_enseignement', 'lt_ressource', 'lt_horaire', 'lt_departement', 'lt_equipe' );
}

/** Types ordonnables à la main (glisser-déposer). */
function logos_contenus_sortable_types() {
	return array( 'lt_ressource', 'lt_horaire', 'lt_departement', 'lt_equipe' );
}

// Écran d'édition classique pour ces contenus : champs simples, plus lisibles qu'avec l'éditeur de blocs.
add_filter(
	'use_block_editor_for_post_type',
	static function ( $use, $post_type ) {
		return in_array( $post_type, logos_contenus_types(), true ) ? false : $use;
	},
	10,
	2
);
