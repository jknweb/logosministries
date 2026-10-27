<?php
/**
 * Présentation du pasteur principal (photo, présentation, repères, signature).
 *
 * @package Logos_Tabernacle
 */

defined( 'ABSPATH' ) || exit;

$lt_args   = wp_parse_args( $args, array( 'pastor' => null, 'eyebrow' => '', 'button_label' => '', 'button_url' => '', 'heading' => 'h2' ) );
$lt_pastor = $lt_args['pastor'];
if ( ! $lt_pastor ) {
	return;
}
?>
<div class="split pastor-intro">
	<figure class="pastor-intro__media">
		<?php
		echo lt_image( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			$lt_pastor['image_id'],
			'',
			array(
				/* translators: %s: nom du pasteur. */
				'alt'    => sprintf( __( 'Portrait du %s', 'logos-tabernacle' ), $lt_pastor['name'] ),
				'width'  => '555',
				'height' => '713',
			)
		);
		?>
	</figure>
	<div>
		<?php if ( $lt_args['eyebrow'] ) : ?>
			<p class="eyebrow"><?php echo esc_html( $lt_args['eyebrow'] ); ?></p>
		<?php endif; ?>
		<h2 class="heading"><?php echo esc_html( $lt_pastor['name'] ); ?></h2>
		<?php if ( $lt_pastor['excerpt'] ) : ?>
			<p class="lead"><?php echo esc_html( $lt_pastor['excerpt'] ); ?></p>
		<?php endif; ?>
		<?php if ( $lt_pastor['facts'] ) : ?>
			<dl class="pastor-intro__facts">
				<?php foreach ( $lt_pastor['facts'] as $lt_fact ) : ?>
					<div>
						<dt><?php echo esc_html( $lt_fact['label'] ); ?></dt>
						<dd><?php echo esc_html( $lt_fact['value'] ); ?></dd>
					</div>
				<?php endforeach; ?>
			</dl>
		<?php endif; ?>
		<p class="pastor-intro__signature">
			<?php echo esc_html( $lt_pastor['name'] ); ?>
			<?php if ( $lt_pastor['role'] ) : ?>
				<span><?php echo esc_html( $lt_pastor['role'] ); ?></span>
			<?php endif; ?>
		</p>
		<?php echo lt_button( $lt_args['button_label'], $lt_args['button_url'], 'btn btn--outline' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
	</div>
</div>
