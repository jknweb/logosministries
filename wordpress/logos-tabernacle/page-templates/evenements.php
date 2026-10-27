<?php
/**
 * Template Name: Événements
 *
 * Agenda : événements à venir puis passés, classés automatiquement par date.
 *
 * @package Logos_Tabernacle
 */

defined( 'ABSPATH' ) || exit;

get_header();
the_post();
lt_the_page_header();

$lt_upcoming   = lt_data( 'events_upcoming' );
$lt_past_count = (int) lt_page( 'past_count' );
$lt_past       = $lt_past_count > 0 ? lt_data( 'events_past', $lt_past_count ) : array();
?>
<section class="section section--light">
	<div class="container">
		<?php get_template_part( 'template-parts/section-head', null, array( 'eyebrow' => lt_page( 'upcoming_eyebrow' ), 'title' => lt_page( 'upcoming_title' ) ) ); ?>
		<?php if ( $lt_upcoming ) : ?>
			<?php get_template_part( 'template-parts/event-grid', null, array( 'events' => $lt_upcoming ) ); ?>
		<?php elseif ( lt_page( 'empty_text' ) ) : ?>
			<p class="lead"><?php echo esc_html( lt_page( 'empty_text' ) ); ?></p>
		<?php endif; ?>
	</div>
</section>

<?php if ( $lt_past ) : ?>
	<section class="section section--cream">
		<div class="container">
			<?php get_template_part( 'template-parts/section-head', null, array( 'eyebrow' => lt_page( 'past_eyebrow' ), 'title' => lt_page( 'past_title' ) ) ); ?>
			<?php get_template_part( 'template-parts/event-grid', null, array( 'events' => $lt_past, 'past' => true ) ); ?>
		</div>
	</section>
<?php endif; ?>

<?php
lt_the_extra_content();
lt_the_page_cta();
get_footer();
