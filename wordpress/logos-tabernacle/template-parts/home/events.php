<?php
/**
 * Accueil : prochains événements (masqué s'il n'y en a aucun).
 *
 * @package Logos_Tabernacle
 */

defined( 'ABSPATH' ) || exit;

$lt_events = lt_data( 'events_upcoming', max( 1, (int) lt_home( 'events', 'count' ) ) );
if ( ! $lt_events ) {
	return;
}
?>
<section class="section <?php echo esc_attr( lt_bg_class( lt_home( 'events', 'bg' ) ) ); ?>">
	<div class="container">
		<?php
		get_template_part(
			'template-parts/section-head',
			null,
			array(
				'eyebrow' => lt_home( 'events', 'eyebrow' ),
				'title'   => lt_home( 'events', 'title' ),
				'center'  => true,
			)
		);
		get_template_part( 'template-parts/event-grid', null, array( 'events' => $lt_events ) );
		$lt_dark   = in_array( lt_home( 'events', 'bg' ), array( 'dark', 'dark-2', 'graphite' ), true );
		$lt_button = lt_button( lt_home( 'events', 'button_label' ), lt_home( 'events', 'button_url' ), $lt_dark ? 'btn btn--ghost' : 'btn btn--outline' );
		if ( $lt_button ) {
			echo '<div class="section__foot">' . $lt_button . '</div>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		}
		?>
	</div>
</section>
