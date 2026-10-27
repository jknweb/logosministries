<?php
/**
 * Accueil : enseignements (vidéos YouTube).
 *
 * @package Logos_Tabernacle
 */

defined( 'ABSPATH' ) || exit;

$lt_count = isset( $args['count'] ) ? (int) $args['count'] : (int) lt_home( 'sermons', 'count' );
if ( ! lt_data( 'sermons', $lt_count ) ) {
	return;
}
?>
<section class="section <?php echo esc_attr( lt_bg_class( lt_home( 'sermons', 'bg' ) ) ); ?>">
	<div class="container">
		<?php get_template_part( 'template-parts/sermon-showcase', null, array( 'count' => $lt_count ) ); ?>
	</div>
</section>
