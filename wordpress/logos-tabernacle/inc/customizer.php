<?php
/**
 * Apparence › Personnaliser › « Apparence et design » : couleurs, polices, tailles, arrondis, espacements.
 * Les valeurs par défaut sont celles du site d'origine ; seules les valeurs modifiées
 * sont injectées dans la page sous forme de variables CSS.
 *
 * @package Logos_Tabernacle
 */

defined( 'ABSPATH' ) || exit;

/** Polices proposées (Google Fonts) : famille => [pile CSS, graisses]. */
function lt_fonts() {
	return array(
		'Cormorant Garamond' => array( "'Cormorant Garamond', Garamond, Georgia, serif", 'ital,wght@0,500;0,600;0,700;1,500;1,600' ),
		'Cinzel'             => array( "'Cinzel', 'Trajan Pro', Georgia, serif", 'wght@500;600;700' ),
		'Marcellus'          => array( "'Marcellus', 'Trajan Pro', Georgia, serif", '' ),
		'Source Sans 3'      => array( "'Source Sans 3', 'Segoe UI', system-ui, sans-serif", 'wght@300;400;500;600' ),
		'Playfair Display'   => array( "'Playfair Display', Georgia, serif", 'ital,wght@0,500;0,600;0,700;1,500' ),
		'Lora'               => array( "'Lora', Georgia, serif", 'ital,wght@0,400;0,500;0,600;1,400' ),
		'EB Garamond'        => array( "'EB Garamond', Garamond, Georgia, serif", 'ital,wght@0,400;0,500;0,600;1,400' ),
		'Montserrat'         => array( "'Montserrat', system-ui, sans-serif", 'wght@300;400;500;600;700' ),
		'Open Sans'          => array( "'Open Sans', system-ui, sans-serif", 'wght@300;400;500;600' ),
		'Lato'               => array( "'Lato', system-ui, sans-serif", 'wght@300;400;700' ),
		'Poppins'            => array( "'Poppins', system-ui, sans-serif", 'wght@300;400;500;600' ),
		'Inter'              => array( "'Inter', system-ui, sans-serif", 'wght@300;400;500;600' ),
	);
}

/**
 * Réglages de design : clé => [libellé, type, défaut, variable CSS, section].
 */
function lt_design_settings() {
	return array(
		'primary'       => array( __( 'Couleur principale (or)', 'logos-tabernacle' ), 'color', '#c9a23a', '--c-gold', 'colors' ),
		'primary_soft'  => array( __( 'Couleur secondaire (or clair, survol des boutons)', 'logos-tabernacle' ), 'color', '#ead89b', '--c-gold-soft', 'colors' ),
		'accent'        => array( __( 'Couleur d’accentuation (or foncé sur fond clair)', 'logos-tabernacle' ), 'color', '#85691b', '--c-gold-deep', 'colors' ),
		'button_text'   => array( __( 'Texte des boutons principaux', 'logos-tabernacle' ), 'color', '#0b0b0c', '--lt-btn-text', 'colors' ),
		'link'          => array( __( 'Couleur des liens dans les textes', 'logos-tabernacle' ), 'color', '#85691b', '--lt-link', 'colors' ),
		'heading'       => array( __( 'Couleur des titres (sections claires)', 'logos-tabernacle' ), 'color', '#26241f', '--lt-heading', 'colors' ),
		'text'          => array( __( 'Couleur du texte', 'logos-tabernacle' ), 'color', '#26241f', '--c-text', 'colors' ),
		'muted'         => array( __( 'Couleur du texte secondaire', 'logos-tabernacle' ), 'color', '#5e594e', '--c-muted', 'colors' ),
		'paper'         => array( __( 'Fond clair', 'logos-tabernacle' ), 'color', '#ffffff', '--c-paper', 'colors' ),
		'cream'         => array( __( 'Fond crème', 'logos-tabernacle' ), 'color', '#f7f3ea', '--c-cream', 'colors' ),
		'ink'           => array( __( 'Fond sombre', 'logos-tabernacle' ), 'color', '#0b0b0c', '--c-ink', 'colors' ),
		'ink2'          => array( __( 'Fond sombre adouci', 'logos-tabernacle' ), 'color', '#141416', '--c-ink-2', 'colors' ),
		'graphite'      => array( __( 'Fond gris (« À la une »)', 'logos-tabernacle' ), 'color', '#3a3b3f', '--c-graphite', 'colors' ),
		'on_dark'       => array( __( 'Texte sur fond sombre', 'logos-tabernacle' ), 'color', '#f4f1ea', '--c-on-dark', 'colors' ),
		'header_bg'     => array( __( 'Fond de l’en-tête (au défilement)', 'logos-tabernacle' ), 'color', '#0b0b0c', '--lt-header-bg', 'colors' ),
		'header_text'   => array( __( 'Texte de l’en-tête', 'logos-tabernacle' ), 'color', '#f4f1ea', '--lt-header-text', 'colors' ),
		'footer_bg'     => array( __( 'Fond du pied de page', 'logos-tabernacle' ), 'color', '#0b0b0c', '--lt-footer-bg', 'colors' ),
		'footer_text'   => array( __( 'Texte du pied de page', 'logos-tabernacle' ), 'color', '#b8b2a4', '--lt-footer-text', 'colors' ),

		'font_heading'  => array( __( 'Police des titres', 'logos-tabernacle' ), 'font', 'Cormorant Garamond', '--font-heading', 'fonts' ),
		'font_accent'   => array( __( 'Police des surtitres, boutons et logo', 'logos-tabernacle' ), 'font', 'Cinzel', '--font-accent', 'fonts' ),
		'font_verse'    => array( __( 'Police du verset d’accueil', 'logos-tabernacle' ), 'font', 'Marcellus', '--font-verse', 'fonts' ),
		'font_text'     => array( __( 'Police du texte courant', 'logos-tabernacle' ), 'font', 'Source Sans 3', '--font-text', 'fonts' ),

		'heading_scale' => array( __( 'Taille des titres (%)', 'logos-tabernacle' ), 'percent', 100, '', 'sizes' ),
		'text_scale'    => array( __( 'Taille des paragraphes (%)', 'logos-tabernacle' ), 'percent', 100, '', 'sizes' ),
		'btn_radius'    => array( __( 'Arrondi des boutons (px, 999 = pilule)', 'logos-tabernacle' ), 'radius', 999, '--lt-btn-radius', 'sizes' ),
		'section_space' => array( __( 'Espacement vertical des sections (%)', 'logos-tabernacle' ), 'percent', 100, '--lt-section-scale', 'sizes' ),
	);
}

/** Valeur d'un réglage de design. */
function lt_design( $key ) {
	$settings = lt_design_settings();
	if ( 'ink' === $key || isset( $settings[ $key ] ) ) {
		$default = $settings[ $key ][2];
		$value   = get_theme_mod( 'lt_' . $key, $default );
		return ( '' === $value || null === $value ) ? $default : $value;
	}
	return '';
}

add_action(
	'customize_register',
	static function ( WP_Customize_Manager $wp_customize ) {
		$wp_customize->add_panel(
			'lt_design',
			array(
				'title'       => __( 'Apparence et design', 'logos-tabernacle' ),
				'description' => __( 'Les valeurs par défaut reproduisent le site d’origine. Le bouton « Réinitialiser » de chaque couleur y revient.', 'logos-tabernacle' ),
				'priority'    => 25,
			)
		);
		$sections = array(
			'colors' => __( 'Couleurs', 'logos-tabernacle' ),
			'fonts'  => __( 'Polices', 'logos-tabernacle' ),
			'sizes'  => __( 'Tailles, arrondis et espacements', 'logos-tabernacle' ),
		);
		foreach ( $sections as $id => $title ) {
			$wp_customize->add_section( 'lt_design_' . $id, array( 'title' => $title, 'panel' => 'lt_design' ) );
		}

		$font_choices = array_combine( array_keys( lt_fonts() ), array_keys( lt_fonts() ) );

		foreach ( lt_design_settings() as $key => $def ) {
			list( $label, $type, $default, , $section ) = $def;
			$setting = 'lt_' . $key;
			switch ( $type ) {
				case 'color':
					$wp_customize->add_setting( $setting, array( 'default' => $default, 'sanitize_callback' => 'sanitize_hex_color', 'transport' => 'refresh' ) );
					$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $setting, array( 'label' => $label, 'section' => 'lt_design_' . $section ) ) );
					break;
				case 'font':
					$wp_customize->add_setting(
						$setting,
						array(
							'default'           => $default,
							'sanitize_callback' => static function ( $value ) use ( $default ) {
								return array_key_exists( $value, lt_fonts() ) ? $value : $default;
							},
						)
					);
					$wp_customize->add_control( $setting, array( 'label' => $label, 'section' => 'lt_design_' . $section, 'type' => 'select', 'choices' => $font_choices ) );
					break;
				default:
					$attrs = 'radius' === $type ? array( 'min' => 0, 'max' => 999, 'step' => 1 ) : array( 'min' => 70, 'max' => 150, 'step' => 5 );
					$wp_customize->add_setting( $setting, array( 'default' => $default, 'sanitize_callback' => 'absint' ) );
					$wp_customize->add_control( $setting, array( 'label' => $label, 'section' => 'lt_design_' . $section, 'type' => 'number', 'input_attrs' => $attrs ) );
			}
		}

		// Raccourcis vers les réglages de contenu du thème.
		$wp_customize->add_section(
			'lt_shortcuts',
			array(
				'title'       => __( 'Contenus du site', 'logos-tabernacle' ),
				'priority'    => 26,
				'description' => sprintf(
					/* translators: %s: lien vers l'administration. */
					__( 'Les textes, images et sections se modifient dans le menu %s du tableau de bord.', 'logos-tabernacle' ),
					'<a href="' . esc_url( admin_url( 'admin.php?page=lt-site' ) ) . '">« Logos Tabernacle »</a>'
				),
			)
		);
		$wp_customize->add_setting( 'lt_shortcuts_dummy', array( 'sanitize_callback' => '__return_empty_string' ) );
		$wp_customize->add_control( 'lt_shortcuts_dummy', array( 'section' => 'lt_shortcuts', 'type' => 'hidden' ) );
	}
);

/** Déclarations CSS des valeurs modifiées. */
function lt_design_css() {
	$vars = array();
	foreach ( lt_design_settings() as $key => $def ) {
		list( , $type, $default, $var ) = $def;
		$value = lt_design( $key );
		if ( (string) $value === (string) $default ) {
			continue;
		}
		switch ( $type ) {
			case 'color':
				$vars[ $var ] = $value;
				if ( 'header_bg' === $key ) {
					// L'en-tête d'origine est légèrement transparent (flou d'arrière-plan).
					list( $r, $g, $b ) = sscanf( $value, '#%02x%02x%02x' );
					$vars['--lt-header-bg-rgba'] = 'rgba(' . (int) $r . ',' . (int) $g . ',' . (int) $b . ',0.94)';
				}
				break;
			case 'font':
				$fonts        = lt_fonts();
				$vars[ $var ] = $fonts[ $value ][0];
				break;
			case 'radius':
				$vars[ $var ] = (int) $value . 'px';
				break;
			case 'percent':
				$ratio = max( 0.5, min( 2, (int) $value / 100 ) );
				if ( 'heading_scale' === $key ) {
					$vars['--fs-h1'] = 'calc(clamp(2.6rem, 1.8rem + 3.4vw, 4.4rem) * ' . $ratio . ')';
					$vars['--fs-h2'] = 'calc(clamp(2.2rem, 1.6rem + 2vw, 3.2rem) * ' . $ratio . ')';
					$vars['--fs-h3'] = 'calc(1.55rem * ' . $ratio . ')';
				} elseif ( 'text_scale' === $key ) {
					$vars['--fs-md'] = 'calc(1.0625rem * ' . $ratio . ')';
					$vars['--fs-lg'] = 'calc(1.25rem * ' . $ratio . ')';
					$vars['--fs-sm'] = 'calc(0.925rem * ' . $ratio . ')';
				} else {
					$vars[ $var ] = $ratio;
				}
				break;
		}
	}
	if ( ! $vars ) {
		return '';
	}
	$css = ':root{';
	foreach ( $vars as $name => $value ) {
		$css .= $name . ':' . $value . ';';
	}
	return $css . '}';
}

/** Adresse Google Fonts pour les polices choisies. */
function lt_fonts_url() {
	$fonts    = lt_fonts();
	$families = array();
	foreach ( array( 'font_accent', 'font_verse', 'font_heading', 'font_text' ) as $key ) {
		$name = lt_design( $key );
		if ( isset( $fonts[ $name ] ) && ! isset( $families[ $name ] ) ) {
			$families[ $name ] = 'family=' . str_replace( ' ', '+', $name ) . ( $fonts[ $name ][1] ? ':' . $fonts[ $name ][1] : '' );
		}
	}
	return 'https://fonts.googleapis.com/css2?' . implode( '&', $families ) . '&display=swap';
}

// Le thème n'a pas de zone de widgets : sans cela, WordPress émet une alerte PHP en affichant leurs modèles dans le Personnaliseur.
add_action(
	'customize_register',
	static function ( WP_Customize_Manager $wp_customize ) {
		if ( isset( $wp_customize->widgets ) && ! current_theme_supports( 'widgets' ) ) {
			remove_action( 'customize_controls_print_footer_scripts', array( $wp_customize->widgets, 'output_widget_control_templates' ) );
		}
	},
	99
);
