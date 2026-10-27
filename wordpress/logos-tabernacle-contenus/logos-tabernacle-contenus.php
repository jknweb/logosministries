<?php
/**
 * Plugin Name:       Logos Tabernacle – Contenus
 * Description:       Contenus de l'église (événements, enseignements, ressources PDF, horaires, départements, équipe) et formulaire de contact. Les contenus restent disponibles même si le thème change.
 * Version:           1.0.0
 * Requires at least: 6.2
 * Requires PHP:      7.4
 * Author:            Logos Tabernacle Ministries
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       logos-tabernacle
 *
 * @package Logos_Contenus
 */

defined( 'ABSPATH' ) || exit;

define( 'LOGOS_CONTENUS_VERSION', '1.0.0' );
define( 'LOGOS_CONTENUS_FILE', __FILE__ );
define( 'LOGOS_CONTENUS_DIR', plugin_dir_path( __FILE__ ) );
define( 'LOGOS_CONTENUS_URL', plugin_dir_url( __FILE__ ) );

require_once LOGOS_CONTENUS_DIR . 'includes/fields/class-logos-fields.php';
require_once LOGOS_CONTENUS_DIR . 'includes/post-types.php';
require_once LOGOS_CONTENUS_DIR . 'includes/meta.php';
require_once LOGOS_CONTENUS_DIR . 'includes/admin.php';
require_once LOGOS_CONTENUS_DIR . 'includes/api.php';
require_once LOGOS_CONTENUS_DIR . 'includes/contact-form.php';
require_once LOGOS_CONTENUS_DIR . 'includes/import.php';

register_activation_hook(
	__FILE__,
	static function () {
		logos_contenus_register_post_types();
		logos_contenus_import_defaults();
		flush_rewrite_rules();
	}
);

register_deactivation_hook( __FILE__, 'flush_rewrite_rules' );
