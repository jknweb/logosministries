<?php
/**
 * Page d'un événement (aussi accessible sans JavaScript depuis les cartes).
 *
 * @package Logos_Tabernacle
 */

defined( 'ABSPATH' ) || exit;

get_header();
the_post();

$lt_event = function_exists( 'logos_contenus_event' ) ? logos_contenus_event( get_post() ) : null;
get_template_part(
	'template-parts/page-header',
	null,
	array(
		'title'    => get_the_title(),
		'eyebrow'  => $lt_event && $lt_event['upcoming'] ? __( 'À venir', 'logos-tabernacle' ) : __( 'Événement passé', 'logos-tabernacle' ),
		'intro'    => $lt_event ? $lt_event['summary'] : '',
		'image_id' => (int) get_post_thumbnail_id(),
		'image'    => 'assemblee.jpg',
		'crumbs'   => array( array( __( 'Événements', 'logos-tabernacle' ), lt_template_page_url( 'evenements', '/evenements/' ) ) ),
	)
);
?>
<section class="section section--light">
	<div class="container container--narrow">
		<?php if ( $lt_event ) : ?>
			<ul class="event-modal__facts event-single__facts">
				<?php if ( $lt_event['long_date'] ) : ?>
					<li><?php lt_the_icon( 'calendar', 18 ); ?><?php echo esc_html( $lt_event['long_date'] ); ?></li>
				<?php endif; ?>
				<?php if ( $lt_event['time'] ) : ?>
					<li><?php lt_the_icon( 'clock', 18 ); ?><?php echo esc_html( $lt_event['time'] ); ?></li>
				<?php endif; ?>
				<?php if ( $lt_event['location'] ) : ?>
					<li><?php lt_the_icon( 'pin', 18 ); ?><?php echo esc_html( $lt_event['location'] ); ?></li>
				<?php endif; ?>
			</ul>
		<?php endif; ?>
		<div class="entry-content"><?php the_content(); ?></div>
		<?php
		if ( $lt_event ) {
			echo '<div class="section__foot event-single__actions">';
			get_template_part( 'template-parts/event-cta', null, array( 'event' => $lt_event ) );
			echo lt_button( __( 'Tout l’agenda', 'logos-tabernacle' ), lt_template_page_url( 'evenements', '/evenements/' ), 'btn btn--outline' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			echo '</div>';
		}
		?>
	</div>
</section>
<?php
get_template_part( 'template-parts/cta-band', null, array( 'title' => lt_page( 'cta_title', lt_template_page_id( 'evenements' ) ), 'text' => lt_page( 'cta_text', lt_template_page_id( 'evenements' ) ) ) );
get_footer();
