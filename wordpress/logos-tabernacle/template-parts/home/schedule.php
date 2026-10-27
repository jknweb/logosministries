<?php
/**
 * Accueil : « Nos rendez-vous ».
 *
 * @package Logos_Tabernacle
 */

defined( 'ABSPATH' ) || exit;

if ( ! lt_data( 'schedule' ) ) {
	return;
}
?>
<section class="section <?php echo esc_attr( lt_bg_class( lt_home( 'schedule', 'bg' ) ) ); ?>">
	<div class="container">
		<?php
		get_template_part(
			'template-parts/section-head',
			null,
			array(
				'eyebrow' => lt_home( 'schedule', 'eyebrow' ),
				'title'   => lt_home( 'schedule', 'title' ),
				'lead'    => lt_home( 'schedule', 'lead' ),
				'center'  => true,
			)
		);
		get_template_part( 'template-parts/schedule-cards' );
		$lt_dark   = in_array( lt_home( 'schedule', 'bg' ), array( 'dark', 'dark-2', 'graphite' ), true );
		$lt_button = lt_button( lt_home( 'schedule', 'button_label' ), lt_home( 'schedule', 'button_url' ), $lt_dark ? 'btn btn--ghost' : 'btn btn--outline' );
		if ( $lt_button ) {
			echo '<div class="section__foot">' . $lt_button . '</div>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		}
		?>
	</div>
</section>
