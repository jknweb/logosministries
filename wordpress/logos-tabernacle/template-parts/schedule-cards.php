<?php
/**
 * Cartes des horaires (Église › Horaires).
 *
 * @package Logos_Tabernacle
 */

defined( 'ABSPATH' ) || exit;

$lt_detailed = ! empty( $args['detailed'] );
?>
<div class="grid grid--3">
	<?php foreach ( lt_data( 'schedule' ) as $lt_item ) : ?>
		<article class="card">
			<span class="card__icon"><?php lt_the_icon( $lt_item['icon'] ); ?></span>
			<h3 class="card__title"><?php echo esc_html( $lt_item['title'] ); ?></h3>
			<p class="card__meta"><?php echo esc_html( trim( $lt_item['day'] . ' · ' . $lt_item['time'], ' ·' ) ); ?></p>
			<?php if ( $lt_item['summary'] ) : ?>
				<p class="card__text"><?php echo esc_html( $lt_item['summary'] ); ?></p>
			<?php endif; ?>
			<?php if ( $lt_detailed && $lt_item['details'] ) : ?>
				<ul class="check-list">
					<?php foreach ( $lt_item['details'] as $lt_detail ) : ?>
						<li><?php echo esc_html( $lt_detail ); ?></li>
					<?php endforeach; ?>
				</ul>
			<?php endif; ?>
		</article>
	<?php endforeach; ?>
</div>
