<?php
/**
 * Schémas des réglages du thème et valeurs par défaut (fidèles au site d'origine).
 *
 * Règle : une clé jamais enregistrée prend sa valeur par défaut ; un texte vidé
 * volontairement reste vide (l'élément est alors masqué) ; une image vide
 * reprend l'image d'origine fournie avec le thème.
 *
 * @package Logos_Tabernacle
 */

defined( 'ABSPATH' ) || exit;

/** Fonds disponibles pour les sections. */
function lt_backgrounds() {
	return array(
		'light'    => __( 'Blanc', 'logos-tabernacle' ),
		'cream'    => __( 'Crème', 'logos-tabernacle' ),
		'dark'     => __( 'Noir', 'logos-tabernacle' ),
		'dark-2'   => __( 'Noir adouci', 'logos-tabernacle' ),
		'graphite' => __( 'Gris', 'logos-tabernacle' ),
	);
}

/** Paramètres du site. */
function lt_schema_site() {
	return array(
		array( 'type' => 'heading', 'label' => __( 'Identité', 'logos-tabernacle' ) ),
		array( 'id' => 'name', 'label' => __( 'Nom du site', 'logos-tabernacle' ), 'type' => 'text', 'default' => 'Logos Tabernacle Ministries', 'desc' => __( 'Utilisé dans les titres de pages, le pied de page et les partages.', 'logos-tabernacle' ) ),
		array( 'id' => 'short_name', 'label' => __( 'Nom court', 'logos-tabernacle' ), 'type' => 'text', 'default' => 'Logos Tabernacle' ),
		array( 'id' => 'tagline', 'label' => __( 'Slogan', 'logos-tabernacle' ), 'type' => 'text', 'default' => 'Une famille centrée sur la Parole depuis 1987' ),
		array( 'id' => 'description', 'label' => __( 'Description pour les moteurs de recherche', 'logos-tabernacle' ), 'type' => 'textarea', 'rows' => 3, 'default' => 'Logos Tabernacle Ministries, église fondée en 1987 à Ngaliema-Ozone (Kinshasa) par le Rév. Yves Kalombo. Cultes le dimanche à 8h30, mardi et jeudi à 17h30. Venez tel que vous êtes.' ),
		array( 'id' => 'founded_year', 'label' => __( 'Année de fondation', 'logos-tabernacle' ), 'type' => 'number', 'default' => 1987, 'min' => 1900, 'max' => 2100 ),
		array( 'id' => 'capacity', 'label' => __( 'Places dans le temple', 'logos-tabernacle' ), 'type' => 'number', 'default' => 2500, 'min' => 0 ),
		array( 'id' => 'logo', 'label' => __( 'Logo principal', 'logos-tabernacle' ), 'type' => 'image', 'default' => '', 'fallback' => LT_URI . '/assets/images/logo-logos.png', 'desc' => __( 'Affiché dans l’en-tête, sur fond blanc arrondi.', 'logos-tabernacle' ) ),
		array( 'id' => 'logo_secondary', 'label' => __( 'Logo secondaire', 'logos-tabernacle' ), 'type' => 'image', 'default' => '', 'desc' => __( 'Facultatif : remplace le nom écrit en haut du pied de page.', 'logos-tabernacle' ) ),
		array( 'id' => 'og_image', 'label' => __( 'Image de partage social', 'logos-tabernacle' ), 'type' => 'image', 'default' => '', 'fallback' => LT_URI . '/assets/images/og-logos.jpg', 'desc' => __( 'Image affichée quand un lien du site est partagé (Facebook, WhatsApp…). Idéalement 1200 × 630 px. Le favicon se règle dans Apparence › Personnaliser › Identité du site.', 'logos-tabernacle' ) ),

		array( 'type' => 'heading', 'label' => __( 'Coordonnées', 'logos-tabernacle' ) ),
		array( 'id' => 'address', 'label' => __( 'Adresse', 'logos-tabernacle' ), 'type' => 'text', 'default' => '09, avenue Kimpu, Barré/Ozone' ),
		array( 'id' => 'city', 'label' => __( 'Ville / commune', 'logos-tabernacle' ), 'type' => 'text', 'default' => 'Kinshasa-Ngaliema' ),
		array( 'id' => 'country', 'label' => __( 'Pays', 'logos-tabernacle' ), 'type' => 'text', 'default' => 'République démocratique du Congo' ),
		array( 'id' => 'phone', 'label' => __( 'Téléphone', 'logos-tabernacle' ), 'type' => 'tel', 'default' => '+243 818 139 464' ),
		array( 'id' => 'whatsapp', 'label' => __( 'Numéro WhatsApp', 'logos-tabernacle' ), 'type' => 'tel', 'default' => '+243 999 949 822', 'desc' => __( 'Au format international, ex. +243 999 949 822.', 'logos-tabernacle' ) ),
		array( 'id' => 'whatsapp_message', 'label' => __( 'Message WhatsApp prérempli', 'logos-tabernacle' ), 'type' => 'text', 'default' => '', 'desc' => __( 'Texte proposé quand un visiteur clique sur un bouton WhatsApp général (facultatif).', 'logos-tabernacle' ) ),
		array( 'id' => 'email', 'label' => __( 'E-mail', 'logos-tabernacle' ), 'type' => 'email', 'default' => 'contact@logostabernacle.com' ),
		array( 'id' => 'office_hours', 'label' => __( 'Horaires d’ouverture (secrétariat)', 'logos-tabernacle' ), 'type' => 'textarea', 'rows' => 2, 'default' => '', 'desc' => __( 'Facultatif : affiché sur la page Contact. Les horaires des cultes se gèrent dans Église › Horaires.', 'logos-tabernacle' ) ),
		array( 'id' => 'maps_query', 'label' => __( 'Adresse pour la carte', 'logos-tabernacle' ), 'type' => 'text', 'default' => '09 avenue Kimpu, Ozone, Ngaliema, Kinshasa', 'desc' => __( 'Texte recherché dans Google Maps. Ignoré si les coordonnées GPS sont renseignées.', 'logos-tabernacle' ) ),
		array( 'id' => 'latitude', 'label' => __( 'Latitude GPS', 'logos-tabernacle' ), 'type' => 'text', 'default' => '', 'placeholder' => '-4.3500' ),
		array( 'id' => 'longitude', 'label' => __( 'Longitude GPS', 'logos-tabernacle' ), 'type' => 'text', 'default' => '', 'placeholder' => '15.2500' ),

		array( 'type' => 'heading', 'label' => __( 'Réseaux sociaux et direct', 'logos-tabernacle' ), 'desc' => __( 'Laisser un champ vide masque l’icône correspondante.', 'logos-tabernacle' ) ),
		array( 'id' => 'youtube', 'label' => 'YouTube', 'type' => 'url', 'default' => 'https://www.youtube.com/@Logosfontaine' ),
		array( 'id' => 'facebook', 'label' => 'Facebook', 'type' => 'url', 'default' => '' ),
		array( 'id' => 'instagram', 'label' => 'Instagram', 'type' => 'url', 'default' => '' ),
		array( 'id' => 'tiktok', 'label' => 'TikTok', 'type' => 'url', 'default' => '' ),
		array( 'id' => 'live_url', 'label' => __( 'Lien des cultes en direct (bouton LIVE)', 'logos-tabernacle' ), 'type' => 'url', 'default' => 'https://www.youtube.com/@Logosfontaine/streams' ),

		array( 'type' => 'heading', 'label' => __( 'Chiffres clés', 'logos-tabernacle' ), 'desc' => __( 'Affichés dans « Qui sommes-nous » et sur la page À propos. Jetons calculés automatiquement : {fondation}, {annees}, {capacite}, {rendezvous}.', 'logos-tabernacle' ) ),
		array(
			'id'        => 'stats',
			'label'     => __( 'Chiffres', 'logos-tabernacle' ),
			'type'      => 'repeater',
			'add_label' => __( 'Ajouter un chiffre', 'logos-tabernacle' ),
			'fields'    => array(
				array( 'id' => 'value', 'label' => __( 'Valeur', 'logos-tabernacle' ), 'type' => 'text' ),
				array( 'id' => 'label', 'label' => __( 'Libellé', 'logos-tabernacle' ), 'type' => 'text' ),
			),
			'default'   => array(
				array( 'value' => '{fondation}', 'label' => 'Année de fondation' ),
				array( 'value' => '{annees} ans', 'label' => 'Au service de Kinshasa' ),
				array( 'value' => '{capacite}', 'label' => 'Places dans le temple' ),
				array( 'value' => '{rendezvous}', 'label' => 'Rendez-vous chaque semaine' ),
			),
		),
	);
}

/** En-tête. */
function lt_schema_header() {
	return array(
		array( 'id' => 'brand_line1', 'label' => __( 'Nom à côté du logo', 'logos-tabernacle' ), 'type' => 'text', 'default' => 'Logos Tabernacle' ),
		array( 'id' => 'brand_line2', 'label' => __( 'Seconde ligne', 'logos-tabernacle' ), 'type' => 'text', 'default' => 'Ministries' ),
		array( 'id' => 'logo_width', 'label' => __( 'Largeur du logo (px)', 'logos-tabernacle' ), 'type' => 'number', 'default' => 54, 'min' => 32, 'max' => 160 ),
		array( 'id' => 'behavior', 'label' => __( 'Comportement au défilement', 'logos-tabernacle' ), 'type' => 'select', 'default' => 'transparent', 'options' => array( 'transparent' => __( 'Transparent en haut de page, opaque en défilant', 'logos-tabernacle' ), 'solid' => __( 'Toujours opaque', 'logos-tabernacle' ) ) ),
		array( 'id' => 'show_live', 'label' => __( 'Bouton LIVE', 'logos-tabernacle' ), 'type' => 'checkbox', 'default' => '1', 'text' => __( 'Afficher le bouton LIVE', 'logos-tabernacle' ) ),
		array( 'id' => 'live_label', 'label' => __( 'Texte du bouton LIVE', 'logos-tabernacle' ), 'type' => 'text', 'default' => 'Live' ),
		array( 'id' => 'cta_label', 'label' => __( 'Bouton d’action', 'logos-tabernacle' ), 'type' => 'text', 'default' => 'Nous visiter', 'desc' => __( 'Vide : bouton masqué.', 'logos-tabernacle' ) ),
		array( 'id' => 'cta_url', 'label' => __( 'Lien du bouton d’action', 'logos-tabernacle' ), 'type' => 'text', 'default' => '/#visite', 'desc' => __( 'Adresse complète ou chemin du site (ex. /contact/ ou /#visite).', 'logos-tabernacle' ) ),
		array( 'id' => 'mobile_breakpoint', 'label' => __( 'Menu mobile à partir de', 'logos-tabernacle' ), 'type' => 'select', 'default' => '1200', 'options' => array( '1200' => __( '1200 px (comme le site d’origine)', 'logos-tabernacle' ), '1024' => __( '1024 px', 'logos-tabernacle' ), '900' => __( '900 px', 'logos-tabernacle' ) ) ),
	);
}

/** Pied de page et textes communs. */
function lt_schema_footer() {
	return array(
		array( 'type' => 'heading', 'label' => __( 'Pied de page', 'logos-tabernacle' ) ),
		array( 'id' => 'brand', 'label' => __( 'Nom affiché', 'logos-tabernacle' ), 'type' => 'text', 'default' => 'Logos Tabernacle', 'desc' => __( 'Remplacé par le logo secondaire s’il est défini dans les Paramètres du site.', 'logos-tabernacle' ) ),
		array( 'id' => 'about', 'label' => __( 'Texte de présentation', 'logos-tabernacle' ), 'type' => 'textarea', 'rows' => 3, 'default' => 'Une église fondée en {fondation} à Ngaliema-Ozone, attachée à la Parole et ouverte à tous. Venez tel que vous êtes.', 'desc' => __( 'Jeton disponible : {fondation}.', 'logos-tabernacle' ) ),
		array( 'id' => 'show_socials', 'label' => __( 'Réseaux sociaux', 'logos-tabernacle' ), 'type' => 'checkbox', 'default' => '1', 'text' => __( 'Afficher les icônes', 'logos-tabernacle' ) ),
		array( 'id' => 'nav_title', 'label' => __( 'Titre de la colonne menu', 'logos-tabernacle' ), 'type' => 'text', 'default' => 'Navigation', 'desc' => __( 'Liens gérés dans Apparence › Menus (emplacement « Pied de page »).', 'logos-tabernacle' ) ),
		array( 'id' => 'schedule_title', 'label' => __( 'Titre de la colonne horaires', 'logos-tabernacle' ), 'type' => 'text', 'default' => 'Horaires', 'desc' => __( 'Vide : colonne masquée.', 'logos-tabernacle' ) ),
		array( 'id' => 'contact_title', 'label' => __( 'Titre de la colonne contact', 'logos-tabernacle' ), 'type' => 'text', 'default' => 'Contact', 'desc' => __( 'Vide : colonne masquée.', 'logos-tabernacle' ) ),
		array( 'id' => 'copyright', 'label' => __( 'Copyright', 'logos-tabernacle' ), 'type' => 'text', 'default' => '© {annee} {site}. Tous droits réservés.', 'desc' => __( '{annee} = année en cours, {site} = nom du site.', 'logos-tabernacle' ) ),

		array( 'type' => 'heading', 'label' => __( 'Bandeau d’appel à l’action', 'logos-tabernacle' ), 'desc' => __( 'Bandeau doré affiché en bas des pages À propos, Pasteur, Enseignements et Événements (chaque page peut le personnaliser ou le masquer).', 'logos-tabernacle' ) ),
		array( 'id' => 'cta_title', 'label' => __( 'Titre', 'logos-tabernacle' ), 'type' => 'text', 'default' => 'Nous serions heureux de vous accueillir' ),
		array( 'id' => 'cta_text', 'label' => __( 'Texte', 'logos-tabernacle' ), 'type' => 'textarea', 'rows' => 2, 'default' => 'Une question, une demande de prière ou envie de nous rendre visite ? Écrivez-nous, nous vous répondons rapidement.' ),
		array( 'id' => 'cta_button', 'label' => __( 'Bouton principal', 'logos-tabernacle' ), 'type' => 'text', 'default' => 'Nous écrire' ),
		array( 'id' => 'cta_url', 'label' => __( 'Lien du bouton principal', 'logos-tabernacle' ), 'type' => 'text', 'default' => '/contact/' ),
		array( 'id' => 'cta_whatsapp', 'label' => __( 'Bouton WhatsApp', 'logos-tabernacle' ), 'type' => 'checkbox', 'default' => '1', 'text' => __( 'Afficher le bouton WhatsApp', 'logos-tabernacle' ) ),

		array( 'type' => 'heading', 'label' => __( 'Page introuvable (404)', 'logos-tabernacle' ) ),
		array( 'id' => '404_eyebrow', 'label' => __( 'Surtitre', 'logos-tabernacle' ), 'type' => 'text', 'default' => 'Erreur 404' ),
		array( 'id' => '404_title', 'label' => __( 'Titre', 'logos-tabernacle' ), 'type' => 'text', 'default' => 'Cette page est introuvable' ),
		array( 'id' => '404_text', 'label' => __( 'Texte', 'logos-tabernacle' ), 'type' => 'text', 'default' => 'Le lien est peut-être ancien ou mal saisi.' ),
	);
}

/**
 * Sections de la page d'accueil, dans l'ordre d'origine.
 * Chaque section : label, desc, fields (les identifiants sont préfixés par la section).
 */
function lt_home_sections() {
	$bg = static function ( $default ) {
		return array( 'id' => 'bg', 'label' => __( 'Fond de la section', 'logos-tabernacle' ), 'type' => 'select', 'default' => $default, 'options' => lt_backgrounds() );
	};

	return array(
		'hero'      => array(
			'label'  => __( 'Bannière principale (hero)', 'logos-tabernacle' ),
			'desc'   => __( 'Verset, bouton LIVE et image animée en plein écran.', 'logos-tabernacle' ),
			'fields' => array(
				array( 'id' => 'eyebrow', 'label' => __( 'Surtitre', 'logos-tabernacle' ), 'type' => 'text', 'default' => 'Bienvenue à Logos Tabernacle Ministries' ),
				array( 'id' => 'title', 'label' => __( 'Titre principal (H1)', 'logos-tabernacle' ), 'type' => 'text', 'default' => 'Logos Tabernacle Ministries, église à Kinshasa-Ngaliema', 'desc' => __( 'Lu par les moteurs de recherche et les lecteurs d’écran.', 'logos-tabernacle' ) ),
				array( 'id' => 'title_visible', 'label' => __( 'Afficher le titre', 'logos-tabernacle' ), 'type' => 'checkbox', 'default' => '0', 'text' => __( 'Afficher le titre au-dessus du verset (masqué sur le site d’origine)', 'logos-tabernacle' ) ),
				array( 'id' => 'verse', 'label' => __( 'Verset / texte mis en avant', 'logos-tabernacle' ), 'type' => 'textarea', 'rows' => 3, 'default' => 'Dieu ne fait point acception de personnes, mais en toute nation celui qui le craint et qui pratique la justice lui est agréable.' ),
				array( 'id' => 'reference', 'label' => __( 'Référence', 'logos-tabernacle' ), 'type' => 'text', 'default' => 'Actes 10:34-35' ),
				array( 'id' => 'show_live', 'label' => __( 'Bouton LIVE', 'logos-tabernacle' ), 'type' => 'checkbox', 'default' => '1', 'text' => __( 'Afficher le bouton LIVE', 'logos-tabernacle' ) ),
				array( 'id' => 'live_label', 'label' => __( 'Texte du bouton LIVE', 'logos-tabernacle' ), 'type' => 'text', 'default' => 'Suivre le culte en direct' ),
				array( 'id' => 'button_label', 'label' => __( 'Second bouton', 'logos-tabernacle' ), 'type' => 'text', 'default' => '', 'desc' => __( 'Facultatif.', 'logos-tabernacle' ) ),
				array( 'id' => 'button_url', 'label' => __( 'Lien du second bouton', 'logos-tabernacle' ), 'type' => 'text', 'default' => '' ),
				array( 'id' => 'image', 'label' => __( 'Image de fond', 'logos-tabernacle' ), 'type' => 'image', 'default' => '', 'fallback' => LT_URI . '/assets/images/temple-interieur.jpg' ),
				array( 'id' => 'image_mobile', 'label' => __( 'Image pour mobile', 'logos-tabernacle' ), 'type' => 'image', 'default' => '', 'desc' => __( 'Facultative, utilisée sous 700 px de large.', 'logos-tabernacle' ) ),
				array( 'id' => 'overlay_color', 'label' => __( 'Couleur du voile', 'logos-tabernacle' ), 'type' => 'color', 'default' => '#0b0b0c' ),
				array( 'id' => 'overlay_opacity', 'label' => __( 'Intensité du voile (%)', 'logos-tabernacle' ), 'type' => 'number', 'default' => 100, 'min' => 0, 'max' => 130, 'desc' => __( '100 = comme le site d’origine.', 'logos-tabernacle' ) ),
				array( 'id' => 'text_color', 'label' => __( 'Couleur du texte', 'logos-tabernacle' ), 'type' => 'color', 'default' => '#f4f1ea' ),
				array( 'id' => 'size', 'label' => __( 'Taille du verset', 'logos-tabernacle' ), 'type' => 'select', 'default' => 'normal', 'options' => array( 'small' => __( 'Petite', 'logos-tabernacle' ), 'normal' => __( 'Normale', 'logos-tabernacle' ), 'large' => __( 'Grande', 'logos-tabernacle' ) ) ),
				array( 'id' => 'align', 'label' => __( 'Alignement', 'logos-tabernacle' ), 'type' => 'select', 'default' => 'left', 'options' => array( 'left' => __( 'À gauche', 'logos-tabernacle' ), 'center' => __( 'Centré', 'logos-tabernacle' ) ) ),
				array( 'id' => 'height', 'label' => __( 'Hauteur', 'logos-tabernacle' ), 'type' => 'select', 'default' => 'full', 'options' => array( 'full' => __( 'Plein écran', 'logos-tabernacle' ), 'large' => __( 'Trois quarts d’écran', 'logos-tabernacle' ), 'medium' => __( 'Demi-écran', 'logos-tabernacle' ) ) ),
				array( 'id' => 'animation', 'label' => __( 'Animation', 'logos-tabernacle' ), 'type' => 'checkbox', 'default' => '1', 'text' => __( 'Travelling avant lent sur l’image', 'logos-tabernacle' ) ),
			),
		),
		'quickinfo' => array(
			'label'  => __( 'Bandeau d’informations pratiques', 'logos-tabernacle' ),
			'desc'   => __( 'Horaires et adresse sous la bannière (contenus repris d’Église › Horaires et des Paramètres du site).', 'logos-tabernacle' ),
			'fields' => array(),
		),
		'featured'  => array(
			'label'  => __( 'À la une', 'logos-tabernacle' ),
			'desc'   => __( 'Vidéo cochée « À la une » dans Église › Enseignements, sinon la dernière publiée.', 'logos-tabernacle' ),
			'fields' => array(
				array( 'id' => 'eyebrow', 'label' => __( 'Surtitre', 'logos-tabernacle' ), 'type' => 'text', 'default' => 'À la une' ),
				array( 'id' => 'title', 'label' => __( 'Titre', 'logos-tabernacle' ), 'type' => 'text', 'default' => 'Nourrir votre foi cette semaine' ),
				array( 'id' => 'show_live', 'label' => __( 'Bouton LIVE', 'logos-tabernacle' ), 'type' => 'checkbox', 'default' => '1', 'text' => __( 'Afficher le bouton LIVE', 'logos-tabernacle' ) ),
				array( 'id' => 'live_label', 'label' => __( 'Texte du bouton LIVE', 'logos-tabernacle' ), 'type' => 'text', 'default' => 'Live' ),
				array( 'id' => 'link_label', 'label' => __( 'Texte du lien', 'logos-tabernacle' ), 'type' => 'text', 'default' => 'Tous les messages' ),
				array( 'id' => 'link_url', 'label' => __( 'Adresse du lien', 'logos-tabernacle' ), 'type' => 'text', 'default' => '', 'desc' => __( 'Vide : chaîne YouTube des Paramètres du site.', 'logos-tabernacle' ) ),
			),
		),
		'welcome'   => array(
			'label'  => __( 'Qui sommes-nous', 'logos-tabernacle' ),
			'desc'   => __( 'Image, présentation, trois valeurs et chiffres clés.', 'logos-tabernacle' ),
			'fields' => array(
				$bg( 'light' ),
				array( 'id' => 'eyebrow', 'label' => __( 'Surtitre', 'logos-tabernacle' ), 'type' => 'text', 'default' => 'Qui sommes-nous' ),
				array( 'id' => 'title', 'label' => __( 'Titre', 'logos-tabernacle' ), 'type' => 'text', 'default' => 'Plus qu’une église, une famille' ),
				array( 'id' => 'lead', 'label' => __( 'Texte', 'logos-tabernacle' ), 'type' => 'textarea', 'rows' => 3, 'default' => 'Depuis {fondation}, Logos Tabernacle rassemble à Ngaliema celles et ceux qui veulent connaître Dieu et grandir dans Sa Parole.' ),
				array( 'id' => 'image', 'label' => __( 'Image', 'logos-tabernacle' ), 'type' => 'image', 'default' => '', 'fallback' => LT_URI . '/assets/images/assemblee.jpg', 'desc' => __( 'Le texte alternatif se modifie dans la médiathèque.', 'logos-tabernacle' ) ),
				array(
					'id'        => 'values',
					'label'     => __( 'Valeurs', 'logos-tabernacle' ),
					'type'      => 'repeater',
					'add_label' => __( 'Ajouter une valeur', 'logos-tabernacle' ),
					'fields'    => array(
						array( 'id' => 'icon', 'label' => __( 'Icône', 'logos-tabernacle' ), 'type' => 'icon' ),
						array( 'id' => 'title', 'label' => __( 'Titre', 'logos-tabernacle' ), 'type' => 'text' ),
						array( 'id' => 'text', 'label' => __( 'Texte', 'logos-tabernacle' ), 'type' => 'textarea', 'rows' => 2 ),
					),
					'default'   => array(
						array( 'icon' => 'book', 'title' => 'La Parole au centre', 'text' => 'Une prédication fidèle et bibliquement fondée, pour grandir chaque semaine dans la connaissance de Christ.' ),
						array( 'icon' => 'heart', 'title' => 'Une famille qui accueille', 'text' => 'Que vous découvriez la foi ou cherchiez une église, vous trouverez ici une communauté fraternelle.' ),
						array( 'icon' => 'worship', 'title' => 'Une foi apostolique', 'text' => 'Attachés à la foi des apôtres et au Message de la restauration, depuis la fondation de l’église.' ),
					),
				),
				array( 'id' => 'button_label', 'label' => __( 'Bouton', 'logos-tabernacle' ), 'type' => 'text', 'default' => 'Découvrir notre histoire' ),
				array( 'id' => 'button_url', 'label' => __( 'Lien du bouton', 'logos-tabernacle' ), 'type' => 'text', 'default' => '/a-propos/' ),
				array( 'id' => 'show_stats', 'label' => __( 'Chiffres clés', 'logos-tabernacle' ), 'type' => 'checkbox', 'default' => '1', 'text' => __( 'Afficher la ligne de chiffres', 'logos-tabernacle' ) ),
			),
		),
		'schedule'  => array(
			'label'  => __( 'Nos rendez-vous', 'logos-tabernacle' ),
			'desc'   => __( 'Cartes d’Église › Horaires.', 'logos-tabernacle' ),
			'fields' => array(
				$bg( 'dark' ),
				array( 'id' => 'eyebrow', 'label' => __( 'Surtitre', 'logos-tabernacle' ), 'type' => 'text', 'default' => 'Nos rendez-vous' ),
				array( 'id' => 'title', 'label' => __( 'Titre', 'logos-tabernacle' ), 'type' => 'text', 'default' => 'Chaque semaine, une place pour vous' ),
				array( 'id' => 'lead', 'label' => __( 'Texte', 'logos-tabernacle' ), 'type' => 'textarea', 'rows' => 2, 'default' => 'Louange, prière et enseignement de la Parole, pour toute la famille.' ),
				array( 'id' => 'button_label', 'label' => __( 'Bouton', 'logos-tabernacle' ), 'type' => 'text', 'default' => 'Programmes et départements' ),
				array( 'id' => 'button_url', 'label' => __( 'Lien du bouton', 'logos-tabernacle' ), 'type' => 'text', 'default' => '/programmes/' ),
			),
		),
		'pastor'    => array(
			'label'  => __( 'Le pasteur visionnaire', 'logos-tabernacle' ),
			'desc'   => __( 'Membre coché « Pasteur principal » dans Église › Équipe pastorale.', 'logos-tabernacle' ),
			'fields' => array(
				$bg( 'cream' ),
				array( 'id' => 'eyebrow', 'label' => __( 'Surtitre', 'logos-tabernacle' ), 'type' => 'text', 'default' => 'Le pasteur visionnaire' ),
				array( 'id' => 'button_label', 'label' => __( 'Bouton', 'logos-tabernacle' ), 'type' => 'text', 'default' => 'Lire sa biographie' ),
				array( 'id' => 'button_url', 'label' => __( 'Lien du bouton', 'logos-tabernacle' ), 'type' => 'text', 'default' => '/pasteur/' ),
			),
		),
		'sermons'   => array(
			'label'  => __( 'Enseignements (vidéos)', 'logos-tabernacle' ),
			'desc'   => __( 'Dernières vidéos d’Église › Enseignements. Ces textes servent aussi sur la page Enseignements.', 'logos-tabernacle' ),
			'fields' => array(
				$bg( 'dark-2' ),
				array( 'id' => 'eyebrow', 'label' => __( 'Surtitre', 'logos-tabernacle' ), 'type' => 'text', 'default' => 'Enseignements' ),
				array( 'id' => 'title', 'label' => __( 'Titre', 'logos-tabernacle' ), 'type' => 'text', 'default' => 'La Parole, chaque semaine' ),
				array( 'id' => 'lead', 'label' => __( 'Texte', 'logos-tabernacle' ), 'type' => 'textarea', 'rows' => 3, 'default' => 'Nous croyons que la Parole de Dieu est la boussole de notre vie. Retrouvez les prédications et les cultes en direct sur notre chaîne YouTube, où que vous soyez.' ),
				array( 'id' => 'count', 'label' => __( 'Nombre de vidéos', 'logos-tabernacle' ), 'type' => 'number', 'default' => 3, 'min' => 1, 'max' => 9 ),
				array( 'id' => 'button1_label', 'label' => __( 'Bouton 1', 'logos-tabernacle' ), 'type' => 'text', 'default' => 'Tous les enseignements' ),
				array( 'id' => 'button1_url', 'label' => __( 'Lien du bouton 1', 'logos-tabernacle' ), 'type' => 'text', 'default' => '', 'desc' => __( 'Vide : page des directs YouTube.', 'logos-tabernacle' ) ),
				array( 'id' => 'button2_label', 'label' => __( 'Bouton 2', 'logos-tabernacle' ), 'type' => 'text', 'default' => 'S’abonner à la chaîne' ),
				array( 'id' => 'button2_url', 'label' => __( 'Lien du bouton 2', 'logos-tabernacle' ), 'type' => 'text', 'default' => '', 'desc' => __( 'Vide : abonnement à la chaîne YouTube.', 'logos-tabernacle' ) ),
			),
		),
		'events'    => array(
			'label'  => __( 'Prochains événements', 'logos-tabernacle' ),
			'desc'   => __( 'Événements à venir d’Église › Événements. La section se masque s’il n’y en a aucun.', 'logos-tabernacle' ),
			'fields' => array(
				$bg( 'light' ),
				array( 'id' => 'eyebrow', 'label' => __( 'Surtitre', 'logos-tabernacle' ), 'type' => 'text', 'default' => 'Agenda' ),
				array( 'id' => 'title', 'label' => __( 'Titre', 'logos-tabernacle' ), 'type' => 'text', 'default' => 'Prochains événements' ),
				array( 'id' => 'count', 'label' => __( 'Nombre d’événements', 'logos-tabernacle' ), 'type' => 'number', 'default' => 3, 'min' => 1, 'max' => 12 ),
				array( 'id' => 'button_label', 'label' => __( 'Bouton', 'logos-tabernacle' ), 'type' => 'text', 'default' => 'Tout l’agenda' ),
				array( 'id' => 'button_url', 'label' => __( 'Lien du bouton', 'logos-tabernacle' ), 'type' => 'text', 'default' => '/evenements/' ),
			),
		),
		'verse'     => array(
			'label'  => __( 'Bandeau verset', 'logos-tabernacle' ),
			'desc'   => __( 'Citation sur image assombrie.', 'logos-tabernacle' ),
			'fields' => array(
				array( 'id' => 'text', 'label' => __( 'Texte', 'logos-tabernacle' ), 'type' => 'textarea', 'rows' => 2, 'default' => 'Nous croyons que chaque vie peut être restaurée par la puissance de Christ.' ),
				array( 'id' => 'reference', 'label' => __( 'Référence', 'logos-tabernacle' ), 'type' => 'text', 'default' => 'Notre conviction' ),
				array( 'id' => 'image', 'label' => __( 'Image de fond', 'logos-tabernacle' ), 'type' => 'image', 'default' => '', 'fallback' => LT_URI . '/assets/images/louange.jpg' ),
			),
		),
		'visit'     => array(
			'label'  => __( 'Planifiez votre visite', 'logos-tabernacle' ),
			'desc'   => __( 'Horaires, adresse, carte et contacts. Ce bloc est aussi affiché sur les pages Programmes et Contact.', 'logos-tabernacle' ),
			'fields' => array(
				array( 'id' => 'eyebrow', 'label' => __( 'Surtitre', 'logos-tabernacle' ), 'type' => 'text', 'default' => 'Première visite' ),
				array( 'id' => 'title', 'label' => __( 'Titre', 'logos-tabernacle' ), 'type' => 'text', 'default' => 'Planifiez votre visite' ),
				array( 'id' => 'lead', 'label' => __( 'Texte', 'logos-tabernacle' ), 'type' => 'textarea', 'rows' => 3, 'default' => 'Que vous découvriez la foi ou que vous cherchiez une église, vous êtes le bienvenu. Une équipe d’accueil vous reçoit à l’entrée et vous guide.' ),
				array( 'id' => 'whatsapp_message', 'label' => __( 'Message WhatsApp prérempli', 'logos-tabernacle' ), 'type' => 'text', 'default' => 'Bonjour, je souhaite venir à Logos Tabernacle. Pouvez-vous me renseigner ?' ),
				array( 'id' => 'show_map', 'label' => __( 'Carte', 'logos-tabernacle' ), 'type' => 'checkbox', 'default' => '1', 'text' => __( 'Afficher la carte Google Maps', 'logos-tabernacle' ) ),
			),
		),
	);
}

/** Ordre par défaut des sections de l'accueil. */
function lt_home_default_order() {
	return array_keys( lt_home_sections() );
}

/** Champs « à plat » de la page d'accueil (clé = section_champ). */
function lt_schema_home() {
	$flat = array(
		array( 'id' => 'order', 'type' => 'text', 'label' => '', 'default' => implode( ',', lt_home_default_order() ) ),
	);
	foreach ( lt_home_sections() as $key => $section ) {
		$flat[] = array( 'id' => $key . '_enabled', 'type' => 'checkbox', 'label' => '', 'default' => '1' );
		foreach ( $section['fields'] as $field ) {
			$field['id'] = $key . '_' . $field['id'];
			$flat[]      = $field;
		}
	}
	return $flat;
}

/** Schéma d'un groupe de réglages. */
function lt_schema( $group ) {
	switch ( $group ) {
		case 'site':
			return lt_schema_site();
		case 'header':
			return lt_schema_header();
		case 'footer':
			return lt_schema_footer();
		case 'home':
			return lt_schema_home();
	}
	return array();
}

/**
 * Lit un réglage du thème.
 *
 * @param string      $group site, header, home ou footer.
 * @param string|null $key   Clé ; null pour tout le groupe.
 * @return mixed
 */
function lt_opt( $group, $key = null ) {
	static $cache = array();
	if ( ! isset( $cache[ $group ] ) ) {
		$saved  = get_option( 'lt_' . $group, array() );
		$saved  = is_array( $saved ) ? $saved : array();
		$values = array();
		foreach ( lt_schema( $group ) as $field ) {
			if ( empty( $field['id'] ) ) {
				continue;
			}
			$values[ $field['id'] ] = array_key_exists( $field['id'], $saved ) ? $saved[ $field['id'] ] : ( isset( $field['default'] ) ? $field['default'] : '' );
		}
		$cache[ $group ] = $values;
	}
	if ( null === $key ) {
		return $cache[ $group ];
	}
	return isset( $cache[ $group ][ $key ] ) ? $cache[ $group ][ $key ] : '';
}
