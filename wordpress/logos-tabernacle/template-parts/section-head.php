<?php
/**
 * En-tête de section : surtitre, titre, texte.
 *
 * @package Logos_Tabernacle
 */

defined( 'ABSPATH' ) || exit;

$lt_args = wp_parse_args( $args, array( 'eyebrow' => '', 'title' => '', 'lead' => '', 'center' => false ) );
if ( ! $lt_args['eyebrow'] && ! $lt_args['title'] && ! $lt_args['lead'] ) {
	return;
}
?>
<div class="section__head<?php echo $lt_args['center'] ? ' section__head--center' : ''; ?>">
	<?php if ( $lt_args['eyebrow'] ) : ?>
		<p class="eyebrow"><?php echo esc_html( $lt_args['eyebrow'] ); ?></p>
	<?php endif; ?>
	<?php if ( $lt_args['title'] ) : ?>
		<h2 class="heading"><?php echo esc_html( $lt_args['title'] ); ?></h2>
	<?php endif; ?>
	<?php if ( $lt_args['lead'] ) : ?>
		<p class="lead"><?php echo esc_html( $lt_args['lead'] ); ?></p>
	<?php endif; ?>
</div>
