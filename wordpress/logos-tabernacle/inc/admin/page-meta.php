<?php
/**
 * Boîtes de champs des pages : en-tête commun et champs du gabarit choisi.
 *
 * @package Logos_Tabernacle
 */

defined( 'ABSPATH' ) || exit;

add_action(
	'add_meta_boxes_page',
	static function ( $post ) {
		add_meta_box( 'lt-page-header', __( 'En-tête et référencement', 'logos-tabernacle' ), 'lt_render_page_header_box', 'page', 'normal', 'high' );
		$template = lt_page_template_slug( $post->ID );
		if ( lt_page_template_fields( $template ) ) {
			add_meta_box( 'lt-page-template', __( 'Sections de la page', 'logos-tabernacle' ), 'lt_render_page_template_box', 'page', 'normal', 'high' );
		}
	}
);

add_action(
	'admin_enqueue_scripts',
	static function ( $hook ) {
		$screen = get_current_screen();
		if ( in_array( $hook, array( 'post.php', 'post-new.php' ), true ) && $screen && 'page' === $screen->post_type ) {
			lt_admin_assets();
		}
	}
);

/** Valeurs enregistrées d'une page. */
function lt_page_saved( $post_id ) {
	$saved = get_post_meta( $post_id, '_lt_page', true );
	return is_array( $saved ) ? $saved : array();
}

function lt_render_page_header_box( $post ) {
	wp_nonce_field( 'lt_page_save', 'lt_page_nonce' );
	echo '<p class="logos-admin-intro">' . esc_html__( 'Le titre de la page sert de grand titre du bandeau. Le gabarit (Attributs de la page › Modèle) détermine la mise en page ; après l’avoir changé, enregistrez puis rechargez pour voir ses champs.', 'logos-tabernacle' ) . '</p>';
	Logos_Fields::render_table( lt_page_header_fields( lt_page_template_slug( $post->ID ) ), lt_page_saved( $post->ID ), 'lt_page' );
}

function lt_render_page_template_box( $post ) {
	Logos_Fields::render_table( lt_page_template_fields( lt_page_template_slug( $post->ID ) ), lt_page_saved( $post->ID ), 'lt_page' );
}

add_action(
	'save_post_page',
	static function ( $post_id ) {
		if ( ! isset( $_POST['lt_page_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['lt_page_nonce'] ) ), 'lt_page_save' ) ) {
			return;
		}
		if ( ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) || wp_is_post_revision( $post_id ) || ! current_user_can( 'edit_page', $post_id ) ) {
			return;
		}
		$input  = isset( $_POST['lt_page'] ) ? wp_unslash( $_POST['lt_page'] ) : array(); // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized -- nettoyé champ par champ.
		$input  = is_array( $input ) ? $input : array();
		$fields = lt_page_header_fields( lt_page_template_slug( $post_id ) );
		// Les champs du gabarit ne sont enregistrés que s'ils étaient affichés (même gabarit).
		$template_fields = lt_page_template_fields( lt_page_template_slug( $post_id ) );
		$posted_keys     = array_keys( $input );
		foreach ( $template_fields as $field ) {
			if ( isset( $field['id'] ) && in_array( $field['id'], $posted_keys, true ) ) {
				$fields = array_merge( $fields, $template_fields );
				break;
			}
		}
		$clean = array_merge( lt_page_saved( $post_id ), Logos_Fields::sanitize_all( $fields, $input ) );
		update_post_meta( $post_id, '_lt_page', $clean );
	}
);
