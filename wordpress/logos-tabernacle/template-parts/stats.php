<?php
/**
 * Chiffres clés (Paramètres du site › Chiffres clés).
 *
 * @package Logos_Tabernacle
 */

defined( 'ABSPATH' ) || exit;

$lt_stats = lt_opt( 'site', 'stats' );
if ( ! is_array( $lt_stats ) || ! $lt_stats ) {
	return;
}
$lt_variant = isset( $args['variant'] ) ? $args['variant'] : 'grid';
?>
<dl class="stats stats--<?php echo esc_attr( $lt_variant ); ?>">
	<?php foreach ( $lt_stats as $lt_stat ) : ?>
		<div class="stats__item">
			<dt><?php echo esc_html( $lt_stat['label'] ); ?></dt>
			<dd><?php echo esc_html( lt_tokens( $lt_stat['value'] ) ); ?></dd>
		</div>
	<?php endforeach; ?>
</dl>
