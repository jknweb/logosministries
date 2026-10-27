<?php
/**
 * Accueil : bandeau verset.
 *
 * @package Logos_Tabernacle
 */

defined( 'ABSPATH' ) || exit;

get_template_part(
	'template-parts/verse-banner',
	null,
	array(
		'text'      => lt_home( 'verse', 'text' ),
		'reference' => lt_home( 'verse', 'reference' ),
		'image_id'  => (int) lt_home( 'verse', 'image' ),
	)
);
