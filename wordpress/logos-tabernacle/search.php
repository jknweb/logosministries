<?php
/**
 * Résultats de recherche.
 *
 * @package Logos_Tabernacle
 */

defined( 'ABSPATH' ) || exit;

get_header();

get_template_part(
	'template-parts/page-header',
	null,
	array(
		/* translators: %s: termes recherchés. */
		'title'   => sprintf( __( 'Recherche : %s', 'logos-tabernacle' ), get_search_query() ),
		'eyebrow' => __( 'Recherche', 'logos-tabernacle' ),
	)
);
?>
<section class="section section--light section--compact">
	<div class="container container--narrow"><?php get_search_form(); ?></div>
</section>
<?php
get_template_part( 'template-parts/post-list' );

get_footer();
