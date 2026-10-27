<?php
/**
 * Grille de cartes d'événements. « Voir les détails » ouvre la fenêtre de détail
 * (ou la page de l'événement si JavaScript est indisponible).
 *
 * @package Logos_Tabernacle
 */

defined( 'ABSPATH' ) || exit;

$lt_events = isset( $args['events'] ) ? $args['events'] : array();
$lt_past   = ! empty( $args['past'] );
?>
<div class="grid grid--3">
	<?php foreach ( $lt_events as $lt_event ) : ?>
		<?php
		$lt_image = lt_image( $lt_event['image_id'], 'assemblee.jpg', array( 'alt' => '' ), 'lt-card' );
		$lt_meta  = $lt_event['long_date'] . ( $lt_event['time'] ? ' · ' . $lt_event['time'] : '' );
		?>
		<article class="event-card<?php echo $lt_past ? ' event-card--past' : ''; ?>">
			<div class="event-card__media">
				<?php echo $lt_image; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
				<span class="event-card__date">
					<strong><?php echo esc_html( $lt_event['day'] ); ?></strong>
					<?php echo esc_html( $lt_event['month'] ); ?>
				</span>
			</div>
			<div class="event-card__body">
				<p class="event-card__meta">
					<?php lt_the_icon( 'calendar', 16 ); ?>
					<?php echo esc_html( $lt_meta ); ?>
				</p>
				<h3 class="event-card__title"><?php echo esc_html( $lt_event['title'] ); ?></h3>
				<p class="event-card__text"><?php echo esc_html( $lt_event['summary'] ); ?></p>
				<a href="<?php echo esc_url( $lt_event['url'] ); ?>" class="link-arrow event-card__more" data-modal-open>
					<?php esc_html_e( 'Voir les détails', 'logos-tabernacle' ); ?>
					<?php lt_the_icon( 'arrow', 18 ); ?>
				</a>
			</div>
			<template data-modal-template>
				<?php echo lt_image( $lt_event['image_id'], 'assemblee.jpg', array( 'alt' => '', 'class' => 'event-modal__image', 'loading' => 'eager' ), 'large' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
				<div class="event-modal__body">
					<p class="eyebrow"><?php echo esc_html( $lt_event['upcoming'] ? __( 'À venir', 'logos-tabernacle' ) : __( 'Événement passé', 'logos-tabernacle' ) ); ?></p>
					<h2 id="event-modal-title" class="event-modal__title"><?php echo esc_html( $lt_event['title'] ); ?></h2>
					<ul class="event-modal__facts">
						<li><?php lt_the_icon( 'calendar', 18 ); ?><?php echo esc_html( $lt_event['long_date'] ); ?></li>
						<?php if ( $lt_event['time'] ) : ?>
							<li><?php lt_the_icon( 'clock', 18 ); ?><?php echo esc_html( $lt_event['time'] ); ?></li>
						<?php endif; ?>
						<?php if ( $lt_event['location'] ) : ?>
							<li><?php lt_the_icon( 'pin', 18 ); ?><?php echo esc_html( $lt_event['location'] ); ?></li>
						<?php endif; ?>
					</ul>
					<p class="event-modal__text"><?php echo esc_html( $lt_event['summary'] ); ?></p>
					<?php get_template_part( 'template-parts/event-cta', null, array( 'event' => $lt_event ) ); ?>
				</div>
			</template>
		</article>
	<?php endforeach; ?>
</div>
