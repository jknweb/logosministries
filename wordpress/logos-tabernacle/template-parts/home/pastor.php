<?php
/**
 * Accueil : « Le pasteur visionnaire ».
 *
 * @package Logos_Tabernacle
 */

defined( 'ABSPATH' ) || exit;

$lt_team = lt_data( 'team' );
if ( empty( $lt_team['lead'] ) ) {
	return;
}
?>
<section class="section <?php echo esc_attr( lt_bg_class( lt_home( 'pastor', 'bg' ) ) ); ?>">
	<div class="container">
		<?php
		get_template_part(
			'template-parts/pastor-intro',
			null,
			array(
				'pastor'       => $lt_team['lead'],
				'eyebrow'      => lt_home( 'pastor', 'eyebrow' ),
				'button_label' => lt_home( 'pastor', 'button_label' ),
				'button_url'   => lt_home( 'pastor', 'button_url' ),
			)
		);
		?>
	</div>
</section>
