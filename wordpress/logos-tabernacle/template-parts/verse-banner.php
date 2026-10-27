<?php
/**
 * Bandeau verset sur image assombrie.
 *
 * @package Logos_Tabernacle
 */

defined( 'ABSPATH' ) || exit;

$lt_args = wp_parse_args( $args, array( 'text' => '', 'reference' => '', 'image_id' => 0 ) );
if ( '' === trim( (string) $lt_args['text'] ) ) {
	return;
}
$lt_image = lt_image_url( (int) $lt_args['image_id'], 'louange.jpg', 'full' );
?>
<section class="verse-banner" style="<?php echo esc_attr( '--verse-image:url(' . esc_url( $lt_image ) . ')' ); ?>">
	<div class="container container--narrow">
		<blockquote>
			<p class="verse-banner__text">« <?php echo esc_html( $lt_args['text'] ); ?> »</p>
			<?php if ( $lt_args['reference'] ) : ?>
				<cite class="verse-banner__ref"><?php echo esc_html( $lt_args['reference'] ); ?></cite>
			<?php endif; ?>
		</blockquote>
	</div>
</section>
