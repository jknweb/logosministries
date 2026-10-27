<?php
/**
 * Grille d'articles avec pagination.
 *
 * @package Logos_Tabernacle
 */

defined( 'ABSPATH' ) || exit;
?>
<section class="section section--light">
	<div class="container">
		<?php if ( have_posts() ) : ?>
			<div class="grid grid--3">
				<?php
				while ( have_posts() ) :
					the_post();
					get_template_part( 'template-parts/post-card' );
				endwhile;
				?>
			</div>
			<?php lt_pagination(); ?>
		<?php else : ?>
			<p class="lead"><?php esc_html_e( 'Aucun contenu à afficher pour le moment.', 'logos-tabernacle' ); ?></p>
		<?php endif; ?>
	</div>
</section>
