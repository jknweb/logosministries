<?php
/**
 * Thème Logos Tabernacle : chargement des modules.
 *
 * @package Logos_Tabernacle
 */

defined( 'ABSPATH' ) || exit;

define( 'LT_VERSION', '1.0.0' );
define( 'LT_DIR', get_template_directory() );
define( 'LT_URI', get_template_directory_uri() );

require_once LT_DIR . '/inc/fields/class-logos-fields.php';
require_once LT_DIR . '/inc/options.php';
require_once LT_DIR . '/inc/helpers.php';
require_once LT_DIR . '/inc/setup.php';
require_once LT_DIR . '/inc/assets.php';
require_once LT_DIR . '/inc/page-fields.php';
require_once LT_DIR . '/inc/nav.php';
require_once LT_DIR . '/inc/customizer.php';
require_once LT_DIR . '/inc/seo.php';
require_once LT_DIR . '/inc/activation.php';

if ( is_admin() ) {
	require_once LT_DIR . '/inc/admin/settings-pages.php';
	require_once LT_DIR . '/inc/admin/page-meta.php';
}
