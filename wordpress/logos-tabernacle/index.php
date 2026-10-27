<?php
/**
 * Liste d'articles (actualités) par défaut.
 *
 * @package Logos_Tabernacle
 */

defined( 'ABSPATH' ) || exit;

get_header();

$lt_title = is_home() && get_option( 'page_for_posts' ) ? get_the_title( (int) get_option( 'page_for_posts' ) ) : __( 'Actualités', 'logos-tabernacle' );
$lt_intro = is_home() && get_option( 'page_for_posts' ) ? lt_page( 'intro', (int) get_option( 'page_for_posts' ) ) : '';

get_template_part( 'template-parts/page-header', null, array( 'title' => $lt_title, 'eyebrow' => __( 'Vie de l’église', 'logos-tabernacle' ), 'intro' => $lt_intro ) );
get_template_part( 'template-parts/post-list' );

get_footer();
