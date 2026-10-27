<?php
/**
 * Menu « Logos Tabernacle » : Paramètres du site, En-tête, Page d'accueil, Pied de page.
 *
 * @package Logos_Tabernacle
 */

defined( 'ABSPATH' ) || exit;

/** Pages de réglages : slug => [groupe, titre du menu, titre de page, introduction]. */
function lt_settings_pages() {
	return array(
		'lt-site'   => array( 'site', __( 'Paramètres du site', 'logos-tabernacle' ), __( 'Paramètres du site', 'logos-tabernacle' ), __( 'Identité, coordonnées et réseaux sociaux. Chaque modification est reprise automatiquement sur toutes les pages (en-tête, pied de page, contact, boutons WhatsApp, carte).', 'logos-tabernacle' ) ),
		'lt-header' => array( 'header', __( 'En-tête', 'logos-tabernacle' ), __( 'En-tête', 'logos-tabernacle' ), __( 'Les liens du menu se gèrent dans Apparence › Menus (emplacement « Menu principal ») ; le logo dans Paramètres du site ; les couleurs dans Apparence › Personnaliser › Apparence et design.', 'logos-tabernacle' ) ),
		'lt-home'   => array( 'home', __( 'Page d’accueil', 'logos-tabernacle' ), __( 'Page d’accueil', 'logos-tabernacle' ), __( 'Glissez les sections pour changer leur ordre, utilisez l’interrupteur pour les afficher ou les masquer, et cliquez sur « Modifier » pour changer leurs textes et images.', 'logos-tabernacle' ) ),
		'lt-footer' => array( 'footer', __( 'Pied de page et textes communs', 'logos-tabernacle' ), __( 'Pied de page et textes communs', 'logos-tabernacle' ), __( 'Les liens de la colonne Navigation se gèrent dans Apparence › Menus (emplacement « Pied de page »). Les liens légaux (mentions légales, confidentialité) se placent dans l’emplacement « Pied de page : liens légaux ».', 'logos-tabernacle' ) ),
	);
}

add_action(
	'admin_init',
	static function () {
		foreach ( lt_settings_pages() as $page ) {
			$group = $page[0];
			register_setting(
				'lt_' . $group,
				'lt_' . $group,
				array(
					'type'              => 'array',
					'sanitize_callback' => static function ( $input ) use ( $group ) {
						return lt_sanitize_group( $group, $input );
					},
					'default'           => array(),
				)
			);
		}
	}
);

/** Nettoie un groupe de réglages. */
function lt_sanitize_group( $group, $input ) {
	$clean = Logos_Fields::sanitize_all( lt_schema( $group ), is_array( $input ) ? $input : array() );

	if ( 'home' === $group ) {
		$valid = lt_home_default_order();
		$order = array_values( array_intersect( array_map( 'sanitize_key', explode( ',', (string) $clean['order'] ) ), $valid ) );
		foreach ( $valid as $key ) {
			if ( ! in_array( $key, $order, true ) ) {
				$order[] = $key;
			}
		}
		$clean['order'] = implode( ',', $order );
	}

	if ( 'site' === $group && ! empty( $clean['name'] ) ) {
		// Le nom et le slogan alimentent aussi les réglages natifs de WordPress.
		$GLOBALS['lt_syncing_blogname'] = true;
		update_option( 'blogname', $clean['name'] );
		update_option( 'blogdescription', $clean['tagline'] );
		$GLOBALS['lt_syncing_blogname'] = false;
	}
	return $clean;
}

// Un changement dans Réglages › Général est repris dans les Paramètres du site.
foreach ( array( 'blogname' => 'name', 'blogdescription' => 'tagline' ) as $lt_option => $lt_key ) {
	add_action(
		'update_option_' . $lt_option,
		static function ( $old, $value ) use ( $lt_key ) {
			if ( ! empty( $GLOBALS['lt_syncing_blogname'] ) ) {
				return;
			}
			$site = get_option( 'lt_site', array() );
			$site = is_array( $site ) ? $site : array();
			$site[ $lt_key ] = $value;
			remove_all_filters( 'sanitize_option_lt_site' );
			update_option( 'lt_site', $site );
		},
		10,
		2
	);
}
unset( $lt_option, $lt_key );

add_action(
	'admin_menu',
	static function () {
		add_menu_page(
			__( 'Logos Tabernacle', 'logos-tabernacle' ),
			__( 'Logos Tabernacle', 'logos-tabernacle' ),
			'manage_options',
			'lt-site',
			'lt_render_settings_page',
			'data:image/svg+xml;base64,' . base64_encode( '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="#a7aaad" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 4h6a4 4 0 0 1 4 4v13a3 3 0 0 0-3-3H2z"/><path d="M22 4h-6a4 4 0 0 0-4 4v13a3 3 0 0 1 3-3h7z"/></svg>' ), // phpcs:ignore WordPress.PHP.DiscouragedPHPFunctions.obfuscation_base64_encode
			3
		);
		foreach ( lt_settings_pages() as $slug => $page ) {
			$hook = add_submenu_page( 'lt-site', $page[2], $page[1], 'manage_options', $slug, 'lt_render_settings_page' );
			add_action( 'admin_print_scripts-' . $hook, 'lt_admin_assets' );
		}
		add_submenu_page( 'lt-site', __( 'Apparence et design', 'logos-tabernacle' ), __( 'Apparence et design', 'logos-tabernacle' ), 'edit_theme_options', 'customize.php?autofocus[panel]=lt_design' );
		add_submenu_page( 'lt-site', __( 'Menus', 'logos-tabernacle' ), __( 'Menus', 'logos-tabernacle' ), 'edit_theme_options', 'nav-menus.php' );
	}
);

/** Scripts des champs (médiathèque, couleurs, répéteurs). */
function lt_admin_assets() {
	Logos_Fields::enqueue( LT_URI . '/assets/admin/' );
}

/** Affiche une page de réglages. */
function lt_render_settings_page() {
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}
	$pages = lt_settings_pages();
	$slug  = isset( $_GET['page'] ) ? sanitize_key( wp_unslash( $_GET['page'] ) ) : 'lt-site'; // phpcs:ignore WordPress.Security.NonceVerification.Recommended
	if ( ! isset( $pages[ $slug ] ) ) {
		return;
	}
	list( $group, , $title, $intro ) = $pages[ $slug ];
	$option = 'lt_' . $group;

	echo '<div class="wrap"><h1>' . esc_html( $title ) . '</h1>';
	echo '<nav class="nav-tab-wrapper logos-admin-tabs">';
	foreach ( $pages as $tab_slug => $tab ) {
		echo '<a class="nav-tab' . ( $tab_slug === $slug ? ' nav-tab-active' : '' ) . '" href="' . esc_url( admin_url( 'admin.php?page=' . $tab_slug ) ) . '">' . esc_html( $tab[1] ) . '</a>';
	}
	echo '</nav>';
	echo '<p class="logos-admin-intro">' . esc_html( $intro ) . '</p>';
	settings_errors();
	echo '<form method="post" action="options.php">';
	settings_fields( $option );

	$saved = get_option( $option, array() );
	$saved = is_array( $saved ) ? $saved : array();

	if ( 'home' === $group ) {
		lt_render_home_sections( $saved );
	} else {
		Logos_Fields::render_table( lt_schema( $group ), $saved, $option );
	}

	submit_button( __( 'Enregistrer les modifications', 'logos-tabernacle' ) );
	echo '</form>';
	echo '<p><a href="' . esc_url( home_url( '/' ) ) . '" target="_blank" rel="noopener">' . esc_html__( 'Voir le site', 'logos-tabernacle' ) . ' ↗</a></p>';
	echo '</div>';
}

/** Sections de l'accueil : cartes repliables, ordonnables, avec interrupteur. */
function lt_render_home_sections( $saved ) {
	$sections = lt_home_sections();
	$order    = array_filter( explode( ',', (string) lt_opt( 'home', 'order' ) ) );
	foreach ( array_keys( $sections ) as $key ) {
		if ( ! in_array( $key, $order, true ) ) {
			$order[] = $key;
		}
	}

	echo '<input type="hidden" id="logos-sections-order" name="lt_home[order]" value="' . esc_attr( implode( ',', $order ) ) . '">';
	echo '<ol class="logos-sections">';
	foreach ( $order as $key ) {
		if ( ! isset( $sections[ $key ] ) ) {
			continue;
		}
		$section = $sections[ $key ];
		$enabled = '1' === (string) lt_opt( 'home', $key . '_enabled' );
		$fields  = array();
		$values  = array();
		foreach ( $section['fields'] as $field ) {
			$prefixed = $key . '_' . $field['id'];
			if ( array_key_exists( $prefixed, $saved ) ) {
				$values[ $field['id'] ] = $saved[ $prefixed ];
			}
			$fields[] = $field;
		}
		echo '<li class="logos-section' . ( $enabled ? '' : ' is-off' ) . '" data-section="' . esc_attr( $key ) . '">';
		echo '<div class="logos-section__head">';
		echo '<span class="logos-section__handle dashicons dashicons-move" title="' . esc_attr__( 'Glisser pour réordonner', 'logos-tabernacle' ) . '"></span>';
		echo '<span class="logos-section__name">' . esc_html( $section['label'] ) . '<small>' . esc_html( $section['desc'] ) . '</small></span>';
		Logos_Fields::render(
			array( 'type' => 'checkbox', 'text' => __( 'Affichée', 'logos-tabernacle' ) ),
			$enabled ? '1' : '0',
			'lt_home[' . $key . '_enabled]'
		);
		if ( $fields ) {
			echo '<button type="button" class="button logos-section__toggle" aria-expanded="false">' . esc_html__( 'Modifier', 'logos-tabernacle' ) . ' <span class="dashicons dashicons-arrow-down-alt2" aria-hidden="true"></span></button>';
		}
		echo '</div>';
		if ( $fields ) {
			echo '<div class="logos-section__body">';
			lt_render_prefixed_table( $fields, $values, $key );
			echo '</div>';
		}
		echo '</li>';
	}
	echo '</ol>';
}

/** Tableau de champs dont les noms sont préfixés par la section (lt_home[section_champ]). */
function lt_render_prefixed_table( $fields, $values, $prefix ) {
	echo '<table class="form-table logos-fields" role="presentation"><tbody>';
	foreach ( $fields as $field ) {
		$value = array_key_exists( $field['id'], $values ) ? $values[ $field['id'] ] : ( isset( $field['default'] ) ? $field['default'] : '' );
		$name  = 'lt_home[' . $prefix . '_' . $field['id'] . ']';
		echo '<tr><th scope="row"><label for="' . esc_attr( Logos_Fields::html_id( $name ) ) . '">' . esc_html( $field['label'] ) . '</label></th><td>';
		Logos_Fields::render( $field, $value, $name );
		echo '</td></tr>';
	}
	echo '</tbody></table>';
}

// Lien rapide vers les réglages depuis la barre d'administration.
add_action(
	'admin_bar_menu',
	static function ( $bar ) {
		if ( current_user_can( 'manage_options' ) ) {
			$bar->add_node(
				array(
					'parent' => 'site-name',
					'id'     => 'lt-settings',
					'title'  => __( 'Réglages Logos Tabernacle', 'logos-tabernacle' ),
					'href'   => admin_url( 'admin.php?page=lt-site' ),
				)
			);
		}
	},
	80
);
