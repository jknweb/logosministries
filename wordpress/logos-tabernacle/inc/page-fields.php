<?php
/**
 * Champs des pages intérieures : en-tête commun et champs propres à chaque gabarit.
 * Valeurs enregistrées dans la métadonnée « _lt_page » de chaque page.
 *
 * @package Logos_Tabernacle
 */

defined( 'ABSPATH' ) || exit;

/** Champs de l'en-tête, communs à toutes les pages. */
function lt_page_header_fields( $template = '' ) {
	$defaults = array(
		'a-propos'      => array( 'Notre histoire', 'D’un petit commencement dans un salon d’Ozone à une œuvre durable au service des croyants.', 'L’histoire de Logos Tabernacle, de la campagne d’Ozone en 1986 au temple de 2 500 places dédié en 2007.' ),
		'pasteur'       => array( 'Équipe pastorale', 'Découvrez le parcours du Rév. Yves Kalombo et les pasteurs qui l’entourent.', 'Biographie du Rév. Yves Kalombo, fondateur de Logos Tabernacle, et présentation de l’équipe pastorale.' ),
		'programmes'    => array( 'Vie de l’église', 'Nos rendez-vous hebdomadaires de prière, d’édification et de louange, et les départements où chacun peut servir.', 'Horaires des cultes de Logos Tabernacle (dimanche 8h30, mardi et jeudi 17h30, Ecodim 7h30) et départements de l’église.' ),
		'enseignements' => array( 'Replays', 'Des messages bibliquement fondés pour vous équiper, vous fortifier et vous préparer au retour de Christ.', 'Prédications et cultes en direct de Logos Tabernacle sur YouTube.' ),
		'evenements'    => array( 'Agenda', 'Cultes spéciaux, retraites, nuits de prière et séminaires : ne manquez aucun temps fort de la vie de l’église.', 'Agenda des événements de Logos Tabernacle : cultes spéciaux, retraites, nuits de prière et séminaires.' ),
		'contact'       => array( 'Écrivez-nous', 'Une question, une demande de prière ou une première visite ? Nous serons heureux de vous répondre.', 'Contactez Logos Tabernacle par téléphone, WhatsApp ou e-mail. 09, avenue Kimpu, Barré/Ozone, Kinshasa-Ngaliema.' ),
	);
	$d = isset( $defaults[ $template ] ) ? $defaults[ $template ] : array( '', '', '' );
	return array(
		array( 'id' => 'eyebrow', 'label' => __( 'Surtitre', 'logos-tabernacle' ), 'type' => 'text', 'default' => $d[0] ),
		array( 'id' => 'intro', 'label' => __( 'Introduction', 'logos-tabernacle' ), 'type' => 'textarea', 'rows' => 2, 'default' => $d[1] ),
		array( 'id' => 'show_header', 'label' => __( 'Bandeau d’en-tête', 'logos-tabernacle' ), 'type' => 'checkbox', 'default' => '1', 'text' => __( 'Afficher le bandeau (titre, fil d’Ariane, image)', 'logos-tabernacle' ), 'desc' => __( 'L’image du bandeau est l’« Image mise en avant » de la page.', 'logos-tabernacle' ) ),
		array( 'id' => 'seo_description', 'label' => __( 'Description pour les moteurs de recherche', 'logos-tabernacle' ), 'type' => 'textarea', 'rows' => 2, 'default' => $d[2], 'desc' => __( 'Environ 150 caractères. Ignorée si une extension SEO est active.', 'logos-tabernacle' ) ),
	);
}

/** Champs « bandeau d'appel » réutilisés par plusieurs gabarits. */
function lt_page_cta_fields( $title = '', $text = '' ) {
	return array(
		array( 'type' => 'heading', 'label' => __( 'Bandeau d’appel à l’action (bas de page)', 'logos-tabernacle' ), 'desc' => __( 'Vide : textes communs définis dans Logos Tabernacle › Pied de page.', 'logos-tabernacle' ) ),
		array( 'id' => 'cta_show', 'label' => __( 'Afficher', 'logos-tabernacle' ), 'type' => 'checkbox', 'default' => '1', 'text' => __( 'Afficher le bandeau', 'logos-tabernacle' ) ),
		array( 'id' => 'cta_title', 'label' => __( 'Titre', 'logos-tabernacle' ), 'type' => 'text', 'default' => $title ),
		array( 'id' => 'cta_text', 'label' => __( 'Texte', 'logos-tabernacle' ), 'type' => 'textarea', 'rows' => 2, 'default' => $text ),
	);
}

/** Champs propres à chaque gabarit de page. */
function lt_page_template_fields( $template ) {
	switch ( $template ) {
		case 'a-propos':
			return array_merge(
				array(
					array( 'type' => 'heading', 'label' => __( 'Les origines', 'logos-tabernacle' ), 'desc' => __( 'Le texte de cette section est le contenu principal de la page (éditeur ci-dessus).', 'logos-tabernacle' ) ),
					array( 'id' => 'origins_eyebrow', 'label' => __( 'Surtitre', 'logos-tabernacle' ), 'type' => 'text', 'default' => 'Les origines' ),
					array( 'id' => 'origins_title', 'label' => __( 'Titre', 'logos-tabernacle' ), 'type' => 'text', 'default' => 'Une église née de l’évangélisation' ),
					array( 'id' => 'show_stats', 'label' => __( 'Chiffres clés', 'logos-tabernacle' ), 'type' => 'checkbox', 'default' => '1', 'text' => __( 'Afficher les chiffres à côté du texte', 'logos-tabernacle' ) ),
					array( 'type' => 'heading', 'label' => __( 'Les grandes étapes', 'logos-tabernacle' ) ),
					array( 'id' => 'timeline_eyebrow', 'label' => __( 'Surtitre', 'logos-tabernacle' ), 'type' => 'text', 'default' => 'Les grandes étapes' ),
					array( 'id' => 'timeline_title', 'label' => __( 'Titre', 'logos-tabernacle' ), 'type' => 'text', 'default' => 'De 1986 à aujourd’hui' ),
					array(
						'id'        => 'timeline',
						'label'     => __( 'Étapes', 'logos-tabernacle' ),
						'type'      => 'repeater',
						'add_label' => __( 'Ajouter une étape', 'logos-tabernacle' ),
						'fields'    => array(
							array( 'id' => 'year', 'label' => __( 'Année', 'logos-tabernacle' ), 'type' => 'text' ),
							array( 'id' => 'title', 'label' => __( 'Titre', 'logos-tabernacle' ), 'type' => 'text' ),
							array( 'id' => 'text', 'label' => __( 'Texte', 'logos-tabernacle' ), 'type' => 'textarea', 'rows' => 3 ),
						),
						'default'   => array(
							array( 'year' => '1986', 'title' => 'La campagne d’Ozone', 'text' => 'En juillet, une grande campagne d’évangélisation est lancée à Ngaliema-Ozone avec l’appui de quelques frères, dont Grégoire Bosunga. Les convertis sont si nombreux que le salon du pasteur ne suffit plus.' ),
							array( 'year' => '1987', 'title' => 'Fondation de Logos Tabernacle', 'text' => 'Après les premières réunions dans un salon prêté puis dans des cours de la Ngeli, l’église est officiellement implantée en septembre, sous un hangar de bambous et de nattes.' ),
							array( 'year' => '1988', 'title' => 'Le premier bâtiment', 'text' => 'L’église acquiert un terrain et y construit un premier édifice, modeste mais central pour les cultes, la prière et l’enseignement biblique.' ),
							array( 'year' => '1994', 'title' => 'L’agrandissement', 'text' => 'La location de la parcelle voisine permet de construire un hangar plus vaste et plus solide pour une assemblée qui ne cesse de grandir.' ),
							array( 'year' => '2007', 'title' => 'Dédicace du nouveau temple', 'text' => 'Un édifice moderne est dédié. Il peut accueillir environ 2 500 personnes et abrite aussi les bureaux administratifs de l’église.' ),
						),
					),
					array( 'type' => 'heading', 'label' => __( 'Ce qui nous anime', 'logos-tabernacle' ) ),
					array( 'id' => 'identity_eyebrow', 'label' => __( 'Surtitre', 'logos-tabernacle' ), 'type' => 'text', 'default' => 'Notre identité' ),
					array( 'id' => 'identity_title', 'label' => __( 'Titre', 'logos-tabernacle' ), 'type' => 'text', 'default' => 'Ce qui nous anime' ),
					array( 'id' => 'identity_lead', 'label' => __( 'Texte', 'logos-tabernacle' ), 'type' => 'textarea', 'rows' => 2, 'default' => 'Logos Tabernacle est une communion fraternelle centrée sur la Parole révélée, reconnue pour son attachement à la foi apostolique.' ),
					array(
						'id'        => 'pillars',
						'label'     => __( 'Cartes', 'logos-tabernacle' ),
						'type'      => 'repeater',
						'add_label' => __( 'Ajouter une carte', 'logos-tabernacle' ),
						'fields'    => array(
							array( 'id' => 'title', 'label' => __( 'Titre', 'logos-tabernacle' ), 'type' => 'text' ),
							array( 'id' => 'text', 'label' => __( 'Texte', 'logos-tabernacle' ), 'type' => 'textarea', 'rows' => 2 ),
						),
						'default'   => array(
							array( 'title' => 'Notre mission', 'text' => 'Rassembler l’Épouse de Christ et annoncer l’Évangile avec fidélité, à Kinshasa et au-delà.' ),
							array( 'title' => 'Ce que nous croyons', 'text' => 'Nous sommes attachés à la foi apostolique et au Message de la restauration, centrés sur la Parole révélée.' ),
							array( 'title' => 'Notre vision', 'text' => 'Être une communion fraternelle où chaque vie peut être restaurée par la puissance de Christ.' ),
						),
					),
				),
				lt_page_cta_fields()
			);

		case 'pasteur':
			return array_merge(
				array(
					array( 'type' => 'heading', 'label' => __( 'Sections', 'logos-tabernacle' ), 'desc' => __( 'La présentation, les repères et la biographie viennent du membre « Pasteur principal » (Église › Équipe pastorale).', 'logos-tabernacle' ) ),
					array( 'id' => 'intro_eyebrow', 'label' => __( 'Surtitre de la présentation', 'logos-tabernacle' ), 'type' => 'text', 'default' => 'Le pasteur visionnaire' ),
					array( 'id' => 'bio_eyebrow', 'label' => __( 'Surtitre de la biographie', 'logos-tabernacle' ), 'type' => 'text', 'default' => 'Biographie' ),
					array( 'id' => 'bio_title', 'label' => __( 'Titre de la biographie', 'logos-tabernacle' ), 'type' => 'text', 'default' => 'Son parcours' ),
					array( 'id' => 'team_eyebrow', 'label' => __( 'Surtitre de l’équipe', 'logos-tabernacle' ), 'type' => 'text', 'default' => 'À ses côtés' ),
					array( 'id' => 'team_title', 'label' => __( 'Titre de l’équipe', 'logos-tabernacle' ), 'type' => 'text', 'default' => 'Nos pasteurs associés' ),
				),
				lt_page_cta_fields()
			);

		case 'programmes':
			return array(
				array( 'type' => 'heading', 'label' => __( 'Sections', 'logos-tabernacle' ), 'desc' => __( 'Les cartes viennent d’Église › Horaires et Église › Départements.', 'logos-tabernacle' ) ),
				array( 'id' => 'schedule_eyebrow', 'label' => __( 'Surtitre des horaires', 'logos-tabernacle' ), 'type' => 'text', 'default' => 'Horaires' ),
				array( 'id' => 'schedule_title', 'label' => __( 'Titre des horaires', 'logos-tabernacle' ), 'type' => 'text', 'default' => 'Nos rendez-vous de la semaine' ),
				array( 'id' => 'ministries_eyebrow', 'label' => __( 'Surtitre des départements', 'logos-tabernacle' ), 'type' => 'text', 'default' => 'Servir ensemble' ),
				array( 'id' => 'ministries_title', 'label' => __( 'Titre des départements', 'logos-tabernacle' ), 'type' => 'text', 'default' => 'Nos départements' ),
				array( 'id' => 'ministries_lead', 'label' => __( 'Texte des départements', 'logos-tabernacle' ), 'type' => 'textarea', 'rows' => 2, 'default' => 'Chaque membre a sa place. Trouvez le département où mettre vos dons au service de Dieu.' ),
				array( 'id' => 'show_visit', 'label' => __( 'Bloc « Planifiez votre visite »', 'logos-tabernacle' ), 'type' => 'checkbox', 'default' => '1', 'text' => __( 'Afficher en bas de page', 'logos-tabernacle' ) ),
			);

		case 'enseignements':
			return array_merge(
				array(
					array( 'type' => 'heading', 'label' => __( 'Sections', 'logos-tabernacle' ), 'desc' => __( 'Les vidéos et leurs textes sont ceux de la section « Enseignements » de la page d’accueil. Les PDF viennent d’Église › Ressources PDF (section masquée tant qu’aucun fichier n’est joint).', 'logos-tabernacle' ) ),
					array( 'id' => 'count', 'label' => __( 'Nombre de vidéos', 'logos-tabernacle' ), 'type' => 'number', 'default' => 3, 'min' => 1, 'max' => 12 ),
					array( 'id' => 'resources_eyebrow', 'label' => __( 'Surtitre des ressources', 'logos-tabernacle' ), 'type' => 'text', 'default' => 'Ressources' ),
					array( 'id' => 'resources_title', 'label' => __( 'Titre des ressources', 'logos-tabernacle' ), 'type' => 'text', 'default' => 'À télécharger' ),
					array( 'id' => 'verse_text', 'label' => __( 'Verset', 'logos-tabernacle' ), 'type' => 'textarea', 'rows' => 2, 'default' => 'Ta parole est une lampe à mes pieds, et une lumière sur mon sentier.', 'desc' => __( 'Vide : bandeau masqué.', 'logos-tabernacle' ) ),
					array( 'id' => 'verse_ref', 'label' => __( 'Référence', 'logos-tabernacle' ), 'type' => 'text', 'default' => 'Psaume 119:105' ),
					array( 'id' => 'verse_image', 'label' => __( 'Image du bandeau verset', 'logos-tabernacle' ), 'type' => 'image', 'default' => '', 'fallback' => LT_URI . '/assets/images/louange.jpg' ),
				),
				lt_page_cta_fields()
			);

		case 'evenements':
			return array_merge(
				array(
					array( 'type' => 'heading', 'label' => __( 'Sections', 'logos-tabernacle' ), 'desc' => __( 'Les événements viennent d’Église › Événements et sont classés automatiquement selon leur date.', 'logos-tabernacle' ) ),
					array( 'id' => 'upcoming_eyebrow', 'label' => __( 'Surtitre « À venir »', 'logos-tabernacle' ), 'type' => 'text', 'default' => 'À venir' ),
					array( 'id' => 'upcoming_title', 'label' => __( 'Titre « À venir »', 'logos-tabernacle' ), 'type' => 'text', 'default' => 'Prochains événements' ),
					array( 'id' => 'empty_text', 'label' => __( 'Texte sans événement', 'logos-tabernacle' ), 'type' => 'textarea', 'rows' => 2, 'default' => 'Aucun événement n’est programmé pour le moment. Revenez bientôt ou suivez-nous sur YouTube.' ),
					array( 'id' => 'past_eyebrow', 'label' => __( 'Surtitre « Passés »', 'logos-tabernacle' ), 'type' => 'text', 'default' => 'Archives' ),
					array( 'id' => 'past_title', 'label' => __( 'Titre « Passés »', 'logos-tabernacle' ), 'type' => 'text', 'default' => 'Événements passés' ),
					array( 'id' => 'past_count', 'label' => __( 'Nombre d’événements passés affichés', 'logos-tabernacle' ), 'type' => 'number', 'default' => 12, 'min' => 0, 'max' => 60 ),
				),
				lt_page_cta_fields( 'Vous organisez votre venue ?', 'Écrivez-nous pour toute question sur un événement, nous vous répondons rapidement.' )
			);

		case 'contact':
			return array(
				array( 'type' => 'heading', 'label' => __( 'Sections', 'logos-tabernacle' ), 'desc' => __( 'Les coordonnées viennent des Paramètres du site ; le formulaire se règle dans Église › Formulaire de contact.', 'logos-tabernacle' ) ),
				array( 'id' => 'channels_eyebrow', 'label' => __( 'Surtitre', 'logos-tabernacle' ), 'type' => 'text', 'default' => 'Coordonnées' ),
				array( 'id' => 'channels_title', 'label' => __( 'Titre', 'logos-tabernacle' ), 'type' => 'text', 'default' => 'Restons en contact' ),
				array( 'id' => 'channels_lead', 'label' => __( 'Texte', 'logos-tabernacle' ), 'type' => 'textarea', 'rows' => 2, 'default' => 'Le plus rapide est de nous écrire sur WhatsApp. Vous pouvez aussi nous appeler ou nous envoyer un e-mail.' ),
				array( 'id' => 'form_title', 'label' => __( 'Titre du formulaire', 'logos-tabernacle' ), 'type' => 'text', 'default' => 'Envoyez-nous un message' ),
				array( 'id' => 'show_visit', 'label' => __( 'Bloc « Planifiez votre visite »', 'logos-tabernacle' ), 'type' => 'checkbox', 'default' => '1', 'text' => __( 'Afficher en bas de page', 'logos-tabernacle' ) ),
			);
	}
	return array();
}

/** Gabarit (slug court) d'une page : « a-propos », « contact »… ou chaîne vide. */
function lt_page_template_slug( $post_id ) {
	$template = (string) get_page_template_slug( $post_id );
	if ( preg_match( '#^page-templates/([a-z-]+)\.php$#', $template, $m ) ) {
		return $m[1];
	}
	return '';
}

/** Tous les champs d'une page. */
function lt_page_fields( $post_id ) {
	$template = lt_page_template_slug( $post_id );
	return array_merge( lt_page_header_fields( $template ), lt_page_template_fields( $template ) );
}

/** Valeur d'un champ de page (valeur par défaut si jamais enregistrée). */
function lt_page_value( $post_id, $key ) {
	$saved = get_post_meta( $post_id, '_lt_page', true );
	$saved = is_array( $saved ) ? $saved : array();
	if ( array_key_exists( $key, $saved ) ) {
		return $saved[ $key ];
	}
	foreach ( lt_page_fields( $post_id ) as $field ) {
		if ( isset( $field['id'] ) && $field['id'] === $key ) {
			return isset( $field['default'] ) ? $field['default'] : '';
		}
	}
	return '';
}
