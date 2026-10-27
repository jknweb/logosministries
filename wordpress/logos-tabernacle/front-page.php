<?php
/**
 * Page d'accueil : sections dans l'ordre et la visibilité choisis dans
 * Logos Tabernacle › Page d'accueil.
 *
 * @package Logos_Tabernacle
 */

defined( 'ABSPATH' ) || exit;

get_header();

$lt_sections = array_filter( explode( ',', (string) lt_opt( 'home', 'order' ) ) );
foreach ( lt_home_default_order() as $lt_key ) {
	if ( ! in_array( $lt_key, $lt_sections, true ) ) {
		$lt_sections[] = $lt_key;
	}
}
$lt_sections = array_values(
	array_filter(
		$lt_sections,
		static function ( $key ) {
			return '1' === (string) lt_opt( 'home', $key . '_enabled' ) && locate_template( 'template-parts/home/' . $key . '.php' );
		}
	)
);

foreach ( $lt_sections as $lt_index => $lt_key ) {
	get_template_part(
		'template-parts/home/' . $lt_key,
		null,
		array( 'next' => isset( $lt_sections[ $lt_index + 1 ] ) ? $lt_sections[ $lt_index + 1 ] : '' )
	);
}

get_footer();
