<?php
/**
 * Champs personnalisés des contenus (boîtes de saisie dans l'écran d'édition).
 *
 * @package Logos_Contenus
 */

defined( 'ABSPATH' ) || exit;

/**
 * Définition des champs par type de contenu.
 *
 * @return array<string, array{title: string, fields: array}>
 */
function logos_contenus_meta_boxes() {
	return array(
		'lt_evenement'    => array(
			'title'  => __( 'Détails de l’événement', 'logos-tabernacle' ),
			'intro'  => __( 'Le résumé affiché sur les cartes se saisit dans « Extrait », l’image dans « Image ». Les événements dont la date est passée passent automatiquement dans « Événements passés ».', 'logos-tabernacle' ),
			'fields' => array(
				array( 'id' => '_lt_date', 'label' => __( 'Date', 'logos-tabernacle' ), 'type' => 'date', 'desc' => __( 'Obligatoire pour apparaître dans l’agenda.', 'logos-tabernacle' ) ),
				array( 'id' => '_lt_time', 'label' => __( 'Heure', 'logos-tabernacle' ), 'type' => 'text', 'placeholder' => '20h00', 'desc' => __( 'Texte libre, ex. « 20h00 » ou « de 21h à l’aube ». Laisser vide si inconnue.', 'logos-tabernacle' ) ),
				array( 'id' => '_lt_location', 'label' => __( 'Lieu', 'logos-tabernacle' ), 'type' => 'text', 'default' => 'Temple Logos Tabernacle, Ozone-Ngaliema' ),
				array( 'id' => '_lt_cta', 'label' => __( 'Bouton « Je participe »', 'logos-tabernacle' ), 'type' => 'checkbox', 'default' => '1', 'text' => __( 'Afficher le bouton WhatsApp tant que l’événement est à venir', 'logos-tabernacle' ) ),
			),
		),
		'lt_enseignement' => array(
			'title'  => __( 'Vidéo et informations', 'logos-tabernacle' ),
			'intro'  => __( 'Le résumé se saisit dans « Extrait ». L’« Image » sert d’aperçu avant la lecture (sinon la miniature YouTube est utilisée).', 'logos-tabernacle' ),
			'fields' => array(
				array( 'id' => '_lt_youtube', 'label' => __( 'Lien YouTube', 'logos-tabernacle' ), 'type' => 'text', 'placeholder' => 'https://www.youtube.com/watch?v=…', 'desc' => __( 'Adresse de la vidéo ou son identifiant.', 'logos-tabernacle' ) ),
				array( 'id' => '_lt_speaker', 'label' => __( 'Prédicateur', 'logos-tabernacle' ), 'type' => 'text' ),
				array( 'id' => '_lt_date', 'label' => __( 'Date du message', 'logos-tabernacle' ), 'type' => 'date' ),
				array( 'id' => '_lt_featured', 'label' => __( 'À la une', 'logos-tabernacle' ), 'type' => 'checkbox', 'default' => '0', 'text' => __( 'Mettre cette vidéo dans la section « À la une » de l’accueil', 'logos-tabernacle' ), 'desc' => __( 'Sans vidéo cochée, le dernier enseignement publié est utilisé.', 'logos-tabernacle' ) ),
			),
		),
		'lt_ressource'    => array(
			'title'  => __( 'Fichier', 'logos-tabernacle' ),
			'fields' => array(
				array( 'id' => '_lt_file', 'label' => __( 'Fichier PDF', 'logos-tabernacle' ), 'type' => 'file' ),
				array( 'id' => '_lt_size', 'label' => __( 'Taille affichée', 'logos-tabernacle' ), 'type' => 'text', 'placeholder' => '2,4 Mo', 'desc' => __( 'Laisser vide pour la calculer automatiquement.', 'logos-tabernacle' ) ),
			),
		),
		'lt_horaire'      => array(
			'title'  => __( 'Rendez-vous', 'logos-tabernacle' ),
			'fields' => array(
				array( 'id' => '_lt_day', 'label' => __( 'Jour(s)', 'logos-tabernacle' ), 'type' => 'text', 'placeholder' => 'Dimanche' ),
				array( 'id' => '_lt_time', 'label' => __( 'Heure', 'logos-tabernacle' ), 'type' => 'text', 'placeholder' => '8h30' ),
				array( 'id' => '_lt_icon', 'label' => __( 'Icône', 'logos-tabernacle' ), 'type' => 'icon', 'default' => 'worship' ),
				array( 'id' => '_lt_audience', 'label' => __( 'Public', 'logos-tabernacle' ), 'type' => 'text', 'placeholder' => 'Tout public' ),
				array( 'id' => '_lt_summary', 'label' => __( 'Résumé', 'logos-tabernacle' ), 'type' => 'textarea', 'rows' => 3 ),
				array( 'id' => '_lt_details', 'label' => __( 'Points détaillés', 'logos-tabernacle' ), 'type' => 'textarea', 'rows' => 4, 'desc' => __( 'Un point par ligne (affichés sur la page Programmes).', 'logos-tabernacle' ) ),
			),
		),
		'lt_departement'  => array(
			'title'  => __( 'Département', 'logos-tabernacle' ),
			'fields' => array(
				array( 'id' => '_lt_icon', 'label' => __( 'Icône', 'logos-tabernacle' ), 'type' => 'icon', 'default' => 'heart' ),
				array( 'id' => '_lt_text', 'label' => __( 'Description', 'logos-tabernacle' ), 'type' => 'textarea', 'rows' => 3 ),
				array( 'id' => '_lt_join', 'label' => __( 'Lien « Rejoindre »', 'logos-tabernacle' ), 'type' => 'checkbox', 'default' => '1', 'text' => __( 'Afficher le lien WhatsApp « Rejoindre ce département »', 'logos-tabernacle' ) ),
			),
		),
		'lt_equipe'       => array(
			'title'  => __( 'Profil', 'logos-tabernacle' ),
			'intro'  => __( 'Le titre est le nom affiché, l’« Image » est la photo. Pour le pasteur principal : l’« Extrait » est la présentation courte et le contenu est la biographie (chaque intertitre de niveau 3 ouvre un chapitre).', 'logos-tabernacle' ),
			'fields' => array(
				array( 'id' => '_lt_role', 'label' => __( 'Fonction', 'logos-tabernacle' ), 'type' => 'text', 'desc' => __( 'Laisser vide pour ne rien afficher sous le nom.', 'logos-tabernacle' ) ),
				array( 'id' => '_lt_lead', 'label' => __( 'Pasteur principal', 'logos-tabernacle' ), 'type' => 'checkbox', 'default' => '0', 'text' => __( 'Présenté sur l’accueil et en tête de la page Pasteur', 'logos-tabernacle' ) ),
				array( 'id' => '_lt_visible', 'label' => __( 'Visible sur le site', 'logos-tabernacle' ), 'type' => 'checkbox', 'default' => '1', 'text' => __( 'Afficher ce membre', 'logos-tabernacle' ) ),
				array(
					'id'        => '_lt_facts',
					'label'     => __( 'Repères', 'logos-tabernacle' ),
					'type'      => 'repeater',
					'add_label' => __( 'Ajouter un repère', 'logos-tabernacle' ),
					'desc'      => __( 'Affichés sous la présentation du pasteur principal (ex. Naissance, Formation).', 'logos-tabernacle' ),
					'fields'    => array(
						array( 'id' => 'label', 'label' => __( 'Intitulé', 'logos-tabernacle' ), 'type' => 'text' ),
						array( 'id' => 'value', 'label' => __( 'Valeur', 'logos-tabernacle' ), 'type' => 'text' ),
					),
				),
				array( 'id' => '_lt_email', 'label' => __( 'E-mail', 'logos-tabernacle' ), 'type' => 'email' ),
				array( 'id' => '_lt_phone', 'label' => __( 'Téléphone', 'logos-tabernacle' ), 'type' => 'tel' ),
				array( 'id' => '_lt_facebook', 'label' => __( 'Facebook', 'logos-tabernacle' ), 'type' => 'url' ),
				array( 'id' => '_lt_instagram', 'label' => __( 'Instagram', 'logos-tabernacle' ), 'type' => 'url' ),
				array( 'id' => '_lt_youtube', 'label' => __( 'YouTube', 'logos-tabernacle' ), 'type' => 'url' ),
			),
		),
	);
}

/** Déclare les métadonnées (API REST incluse) pour qu'elles soient lisibles par d'autres outils. */
add_action(
	'init',
	static function () {
		foreach ( logos_contenus_meta_boxes() as $post_type => $box ) {
			foreach ( $box['fields'] as $field ) {
				$is_array = 'repeater' === $field['type'];
				register_post_meta(
					$post_type,
					$field['id'],
					array(
						'single'        => true,
						'type'          => $is_array ? 'array' : 'string',
						'show_in_rest'  => $is_array ? array( 'schema' => array( 'type' => 'array', 'items' => array( 'type' => 'object', 'additionalProperties' => array( 'type' => 'string' ) ) ) ) : true,
						'auth_callback' => static function ( $allowed, $meta_key, $post_id ) {
							return current_user_can( 'edit_post', $post_id );
						},
					)
				);
			}
		}
	},
	20
);

add_action(
	'add_meta_boxes',
	static function ( $post_type ) {
		$boxes = logos_contenus_meta_boxes();
		if ( isset( $boxes[ $post_type ] ) ) {
			add_meta_box( 'logos-meta', $boxes[ $post_type ]['title'], 'logos_contenus_render_meta_box', $post_type, 'normal', 'high' );
		}
		if ( 'lt_message' === $post_type ) {
			add_meta_box( 'logos-message', __( 'Message', 'logos-tabernacle' ), 'logos_contenus_render_message_box', $post_type, 'normal', 'high' );
		}
	}
);

/** Affiche la boîte de champs. */
function logos_contenus_render_meta_box( $post ) {
	$boxes = logos_contenus_meta_boxes();
	$box   = $boxes[ $post->post_type ];
	wp_nonce_field( 'logos_meta_save', 'logos_meta_nonce' );
	if ( ! empty( $box['intro'] ) ) {
		echo '<p class="logos-admin-intro">' . esc_html( $box['intro'] ) . '</p>';
	}
	$values = array();
	foreach ( $box['fields'] as $field ) {
		if ( metadata_exists( 'post', $post->ID, $field['id'] ) ) {
			$values[ $field['id'] ] = get_post_meta( $post->ID, $field['id'], true );
		}
	}
	Logos_Fields::render_table( $box['fields'], $values, 'logos_meta' );
}

/** Enregistre les champs (nonce, droits, nettoyage). */
add_action(
	'save_post',
	static function ( $post_id, $post ) {
		$boxes = logos_contenus_meta_boxes();
		if ( ! isset( $boxes[ $post->post_type ] ) ) {
			return;
		}
		if ( ! isset( $_POST['logos_meta_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['logos_meta_nonce'] ) ), 'logos_meta_save' ) ) {
			return;
		}
		if ( ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) || wp_is_post_revision( $post_id ) || ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}
		$input = isset( $_POST['logos_meta'] ) ? wp_unslash( $_POST['logos_meta'] ) : array(); // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized -- nettoyé champ par champ ci-dessous.
		$clean = Logos_Fields::sanitize_all( $boxes[ $post->post_type ]['fields'], $input );
		foreach ( $clean as $key => $value ) {
			update_post_meta( $post_id, $key, $value );
		}
	},
	10,
	2
);

/** Affiche un message reçu (lecture seule). */
function logos_contenus_render_message_box( $post ) {
	$rows = array(
		__( 'Nom', 'logos-tabernacle' )       => get_post_meta( $post->ID, '_lt_name', true ),
		__( 'Téléphone', 'logos-tabernacle' ) => get_post_meta( $post->ID, '_lt_phone', true ),
		__( 'E-mail', 'logos-tabernacle' )    => get_post_meta( $post->ID, '_lt_email', true ),
		__( 'Objet', 'logos-tabernacle' )     => get_post_meta( $post->ID, '_lt_subject', true ),
		__( 'Reçu le', 'logos-tabernacle' )   => logos_contenus_format_date( get_the_date( 'Y-m-d', $post ) ) . ' à ' . get_the_date( 'H:i', $post ),
		__( 'Envoi par e-mail', 'logos-tabernacle' ) => get_post_meta( $post->ID, '_lt_mailed', true ) ? __( 'Envoyé', 'logos-tabernacle' ) : __( 'Échec de l’envoi (le message est conservé ici)', 'logos-tabernacle' ),
	);
	echo '<table class="form-table" role="presentation"><tbody>';
	foreach ( $rows as $label => $value ) {
		if ( '' === (string) $value ) {
			continue;
		}
		echo '<tr><th scope="row">' . esc_html( $label ) . '</th><td>' . esc_html( $value ) . '</td></tr>';
	}
	echo '<tr><th scope="row">' . esc_html__( 'Message', 'logos-tabernacle' ) . '</th><td>' . nl2br( esc_html( get_post_meta( $post->ID, '_lt_message', true ) ) ) . '</td></tr>';
	echo '</tbody></table>';
	$phone = preg_replace( '/\D+/', '', (string) get_post_meta( $post->ID, '_lt_phone', true ) );
	$email = get_post_meta( $post->ID, '_lt_email', true );
	echo '<p>';
	if ( $phone ) {
		echo '<a class="button" href="' . esc_url( 'https://wa.me/' . $phone ) . '" target="_blank" rel="noopener noreferrer">' . esc_html__( 'Répondre sur WhatsApp', 'logos-tabernacle' ) . '</a> ';
	}
	if ( $email ) {
		echo '<a class="button" href="' . esc_url( 'mailto:' . $email ) . '">' . esc_html__( 'Répondre par e-mail', 'logos-tabernacle' ) . '</a>';
	}
	echo '</p>';
}
