<?php
/**
 * Administration : menu « Église », colonnes des listes, tri par glisser-déposer.
 *
 * @package Logos_Contenus
 */

defined( 'ABSPATH' ) || exit;

add_action(
	'admin_menu',
	static function () {
		add_menu_page(
			__( 'Contenus de l’église', 'logos-tabernacle' ),
			__( 'Église', 'logos-tabernacle' ),
			'edit_posts',
			LOGOS_CONTENUS_MENU,
			'',
			'dashicons-groups',
			21
		);
	},
	9
);

// Le premier sous-menu remplace l'entrée parente (sinon WordPress crée une page vide).
add_action(
	'admin_menu',
	static function () {
		remove_submenu_page( LOGOS_CONTENUS_MENU, LOGOS_CONTENUS_MENU );
	},
	99
);

// Nombre de messages non lus à côté de « Messages reçus ».
add_action(
	'admin_menu',
	static function () {
		global $submenu;
		$unread = logos_contenus_unread_count();
		if ( ! $unread || empty( $submenu[ LOGOS_CONTENUS_MENU ] ) ) {
			return;
		}
		foreach ( $submenu[ LOGOS_CONTENUS_MENU ] as &$item ) {
			if ( 'edit.php?post_type=lt_message' === $item[2] ) {
				$item[0] .= ' <span class="awaiting-mod"><span class="pending-count">' . (int) $unread . '</span></span>';
			}
		}
	},
	100
);

/** Nombre de messages non lus. */
function logos_contenus_unread_count() {
	$query = new WP_Query(
		array(
			'post_type'      => 'lt_message',
			'post_status'    => 'private',
			'meta_key'       => '_lt_unread', // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_key
			'meta_value'     => '1', // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_value
			'fields'         => 'ids',
			'posts_per_page' => 99,
			'no_found_rows'  => true,
		)
	);
	return count( $query->posts );
}

// Un message ouvert est considéré comme lu.
add_action(
	'load-post.php',
	static function () {
		$post_id = isset( $_GET['post'] ) ? absint( $_GET['post'] ) : 0; // phpcs:ignore WordPress.Security.NonceVerification.Recommended
		if ( $post_id && 'lt_message' === get_post_type( $post_id ) && current_user_can( 'edit_post', $post_id ) ) {
			delete_post_meta( $post_id, '_lt_unread' );
		}
	}
);

add_action(
	'admin_enqueue_scripts',
	static function () {
		$screen = get_current_screen();
		if ( ! $screen || ! in_array( $screen->post_type, array_merge( logos_contenus_types(), array( 'lt_message' ) ), true ) ) {
			return;
		}
		Logos_Fields::enqueue( LOGOS_CONTENUS_URL . 'assets/admin/' );
		if ( 'edit' === $screen->base && in_array( $screen->post_type, logos_contenus_sortable_types(), true ) ) {
			wp_enqueue_script( 'logos-reorder', LOGOS_CONTENUS_URL . 'assets/admin/reorder.js', array( 'jquery', 'jquery-ui-sortable' ), LOGOS_CONTENUS_VERSION, true );
			wp_localize_script(
				'logos-reorder',
				'logosReorder',
				array(
					'nonce' => wp_create_nonce( 'logos_reorder' ),
					'saved' => __( 'Ordre enregistré.', 'logos-tabernacle' ),
					'error' => __( 'L’ordre n’a pas pu être enregistré.', 'logos-tabernacle' ),
				)
			);
		}
	}
);

// Listes triées par ordre manuel par défaut.
add_action(
	'pre_get_posts',
	static function ( $query ) {
		if ( ! is_admin() || ! $query->is_main_query() ) {
			return;
		}
		$type = $query->get( 'post_type' );
		if ( in_array( $type, logos_contenus_sortable_types(), true ) && ! $query->get( 'orderby' ) ) {
			$query->set( 'orderby', array( 'menu_order' => 'ASC', 'title' => 'ASC' ) );
		}
		if ( 'lt_evenement' === $type && ! $query->get( 'orderby' ) ) {
			$query->set( 'meta_key', '_lt_date' );
			$query->set( 'orderby', 'meta_value' );
			$query->set( 'order', 'DESC' );
		}
		if ( 'lt_message' === $type ) {
			$query->set( 'post_status', 'private' );
		}
	}
);

// Enregistrement de l'ordre après glisser-déposer.
add_action(
	'wp_ajax_logos_reorder',
	static function () {
		check_ajax_referer( 'logos_reorder', 'nonce' );
		$ids = isset( $_POST['ids'] ) ? array_map( 'absint', (array) wp_unslash( $_POST['ids'] ) ) : array();
		foreach ( $ids as $position => $id ) {
			if ( ! $id || ! in_array( get_post_type( $id ), logos_contenus_sortable_types(), true ) || ! current_user_can( 'edit_post', $id ) ) {
				wp_send_json_error( null, 403 );
			}
		}
		foreach ( $ids as $position => $id ) {
			wp_update_post( array( 'ID' => $id, 'menu_order' => $position ) );
		}
		wp_send_json_success();
	}
);

/** Colonnes des listes. */
function logos_contenus_columns( $columns, $extra ) {
	$out = array();
	foreach ( $columns as $key => $label ) {
		$out[ $key ] = $label;
		if ( 'cb' === $key && isset( $extra['logos_order'] ) ) {
			$out['logos_order'] = $extra['logos_order'];
			unset( $extra['logos_order'] );
		}
		if ( 'title' === $key ) {
			$out = array_merge( $out, $extra );
		}
	}
	return $out;
}

// Colonnes des listes (déclarées après le chargement des traductions).
add_action(
	'admin_init',
	static function () {
		$columns_by_type = array(
			'lt_evenement'    => array( 'logos_date' => __( 'Date', 'logos-tabernacle' ), 'logos_when' => __( 'Statut', 'logos-tabernacle' ) ),
			'lt_enseignement' => array( 'logos_date' => __( 'Date du message', 'logos-tabernacle' ), 'logos_speaker' => __( 'Prédicateur', 'logos-tabernacle' ), 'logos_featured' => __( 'À la une', 'logos-tabernacle' ) ),
			'lt_horaire'      => array( 'logos_order' => __( 'Ordre', 'logos-tabernacle' ), 'logos_day' => __( 'Jour et heure', 'logos-tabernacle' ) ),
			'lt_departement'  => array( 'logos_order' => __( 'Ordre', 'logos-tabernacle' ) ),
			'lt_ressource'    => array( 'logos_order' => __( 'Ordre', 'logos-tabernacle' ), 'logos_file' => __( 'Fichier', 'logos-tabernacle' ) ),
			'lt_equipe'       => array( 'logos_order' => __( 'Ordre', 'logos-tabernacle' ), 'logos_thumb' => __( 'Photo', 'logos-tabernacle' ), 'logos_role' => __( 'Fonction', 'logos-tabernacle' ), 'logos_visible' => __( 'Visible', 'logos-tabernacle' ) ),
			'lt_message'      => array( 'logos_from' => __( 'De', 'logos-tabernacle' ), 'logos_subject' => __( 'Objet', 'logos-tabernacle' ) ),
		);

		foreach ( $columns_by_type as $type => $extra ) {
			add_filter(
				"manage_{$type}_posts_columns",
				static function ( $columns ) use ( $extra ) {
					return logos_contenus_columns( $columns, $extra );
				}
			);
			add_action( "manage_{$type}_posts_custom_column", 'logos_contenus_column_value', 10, 2 );
		}
	}
);

/** Valeur d'une colonne. */
function logos_contenus_column_value( $column, $post_id ) {
	switch ( $column ) {
		case 'logos_order':
			echo '<span class="dashicons dashicons-move logos-sort-handle" title="' . esc_attr__( 'Glisser pour réordonner', 'logos-tabernacle' ) . '"></span>';
			break;
		case 'logos_date':
			$date = get_post_meta( $post_id, '_lt_date', true );
			echo $date ? esc_html( logos_contenus_format_date( $date ) ) : '—';
			break;
		case 'logos_when':
			$date = get_post_meta( $post_id, '_lt_date', true );
			if ( ! $date ) {
				echo '<em>' . esc_html__( 'Sans date (non affiché)', 'logos-tabernacle' ) . '</em>';
			} else {
				echo esc_html( logos_contenus_is_upcoming( $date ) ? __( 'À venir', 'logos-tabernacle' ) : __( 'Passé', 'logos-tabernacle' ) );
			}
			break;
		case 'logos_speaker':
			echo esc_html( get_post_meta( $post_id, '_lt_speaker', true ) );
			break;
		case 'logos_featured':
			echo get_post_meta( $post_id, '_lt_featured', true ) ? '<span class="dashicons dashicons-star-filled" aria-label="' . esc_attr__( 'Oui', 'logos-tabernacle' ) . '"></span>' : '';
			break;
		case 'logos_day':
			echo esc_html( trim( get_post_meta( $post_id, '_lt_day', true ) . ' · ' . get_post_meta( $post_id, '_lt_time', true ), ' ·' ) );
			break;
		case 'logos_file':
			$file = (int) get_post_meta( $post_id, '_lt_file', true );
			echo $file ? esc_html( basename( (string) get_attached_file( $file ) ) ) : '<em>' . esc_html__( 'Aucun fichier (non affiché)', 'logos-tabernacle' ) . '</em>';
			break;
		case 'logos_thumb':
			echo get_the_post_thumbnail( $post_id, 'thumbnail' );
			break;
		case 'logos_role':
			$role = get_post_meta( $post_id, '_lt_role', true );
			if ( get_post_meta( $post_id, '_lt_lead', true ) ) {
				$role = trim( __( 'Pasteur principal', 'logos-tabernacle' ) . ( $role ? ' · ' . $role : '' ) );
			}
			echo esc_html( $role );
			break;
		case 'logos_visible':
			echo '0' === get_post_meta( $post_id, '_lt_visible', true ) ? esc_html__( 'Non', 'logos-tabernacle' ) : esc_html__( 'Oui', 'logos-tabernacle' );
			break;
		case 'logos_from':
			echo esc_html( get_post_meta( $post_id, '_lt_name', true ) );
			if ( get_post_meta( $post_id, '_lt_unread', true ) ) {
				echo ' <strong>(' . esc_html__( 'non lu', 'logos-tabernacle' ) . ')</strong>';
			}
			break;
		case 'logos_subject':
			echo esc_html( get_post_meta( $post_id, '_lt_subject', true ) );
			break;
	}
}

// Les messages n'ont pas d'écran de création ni d'édition de titre utile.
add_filter(
	'post_row_actions',
	static function ( $actions, $post ) {
		if ( 'lt_message' === $post->post_type ) {
			unset( $actions['inline hide-if-no-js'] );
			$actions['edit'] = '<a href="' . esc_url( get_edit_post_link( $post->ID ) ) . '">' . esc_html__( 'Lire', 'logos-tabernacle' ) . '</a>';
		}
		return $actions;
	},
	10,
	2
);

// Pas de bouton « Mettre à jour » trompeur sur un message : on garde seulement la corbeille.
add_action(
	'admin_head-post.php',
	static function () {
		if ( 'lt_message' === get_post_type() ) {
			echo '<style>#post-body-content,#minor-publishing,#publishing-action{display:none}</style>';
		}
	}
);
