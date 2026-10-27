<?php
/**
 * Archives : catégories, étiquettes, auteurs, dates.
 *
 * @package Logos_Tabernacle
 */

defined( 'ABSPATH' ) || exit;

get_header();

$lt_blog = get_option( 'page_for_posts' ) ? array( array( get_the_title( (int) get_option( 'page_for_posts' ) ), get_permalink( (int) get_option( 'page_for_posts' ) ) ) ) : array();
get_template_part(
	'template-parts/page-header',
	null,
	array(
		'title'   => wp_strip_all_tags( get_the_archive_title() ),
		'eyebrow' => __( 'Archives', 'logos-tabernacle' ),
		'intro'   => wp_strip_all_tags( get_the_archive_description() ),
		'crumbs'  => $lt_blog,
	)
);
get_template_part( 'template-parts/post-list' );

get_footer();
