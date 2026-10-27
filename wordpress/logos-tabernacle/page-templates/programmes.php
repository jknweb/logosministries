<?php
/**
 * Template Name: Programmes
 *
 * Horaires détaillés et départements (Église › Horaires, Église › Départements).
 *
 * @package Logos_Tabernacle
 */

defined( 'ABSPATH' ) || exit;

get_header();
the_post();
lt_the_page_header();

$lt_ministries = lt_data( 'ministries' );
?>
<?php if ( lt_data( 'schedule' ) ) : ?>
	<section class="section section--light">
		<div class="container">
			<?php get_template_part( 'template-parts/section-head', null, array( 'eyebrow' => lt_page( 'schedule_eyebrow' ), 'title' => lt_page( 'schedule_title' ), 'center' => true ) ); ?>
			<?php get_template_part( 'template-parts/schedule-cards', null, array( 'detailed' => true ) ); ?>
		</div>
	</section>
<?php endif; ?>

<?php if ( $lt_ministries ) : ?>
	<section class="section section--dark">
		<div class="container">
			<?php get_template_part( 'template-parts/section-head', null, array( 'eyebrow' => lt_page( 'ministries_eyebrow' ), 'title' => lt_page( 'ministries_title' ), 'lead' => lt_page( 'ministries_lead' ), 'center' => true ) ); ?>
			<div class="grid grid--3">
				<?php foreach ( $lt_ministries as $lt_ministry ) : ?>
					<article class="card">
						<span class="card__icon"><?php lt_the_icon( $lt_ministry['icon'] ); ?></span>
						<h3 class="card__title"><?php echo esc_html( $lt_ministry['title'] ); ?></h3>
						<p class="card__text"><?php echo esc_html( $lt_ministry['text'] ); ?></p>
						<?php if ( $lt_ministry['join'] && lt_whatsapp_number() ) : ?>
							<?php /* translators: %s: département. */ ?>
							<a class="link-arrow card__link" href="<?php echo esc_url( lt_whatsapp_url( sprintf( __( 'Bonjour, je souhaite rejoindre le département « %s ».', 'logos-tabernacle' ), $lt_ministry['title'] ) ) ); ?>" target="_blank" rel="noopener noreferrer">
								<?php esc_html_e( 'Rejoindre ce département', 'logos-tabernacle' ); ?>
								<?php lt_the_icon( 'arrow', 18 ); ?>
							</a>
						<?php endif; ?>
					</article>
				<?php endforeach; ?>
			</div>
		</div>
	</section>
<?php endif; ?>

<?php
lt_the_extra_content();
if ( lt_page( 'show_visit' ) ) {
	get_template_part( 'template-parts/visit-block' );
}
get_footer();
