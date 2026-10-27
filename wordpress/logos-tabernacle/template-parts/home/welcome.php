<?php
/**
 * Accueil : « Qui sommes-nous ».
 *
 * @package Logos_Tabernacle
 */

defined( 'ABSPATH' ) || exit;

$lt_values = lt_home( 'welcome', 'values' );
?>
<section class="section <?php echo esc_attr( lt_bg_class( lt_home( 'welcome', 'bg' ) ) ); ?> welcome">
	<div class="container">
		<div class="welcome__grid">
			<figure class="welcome__media">
				<?php
				echo lt_image( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
					(int) lt_home( 'welcome', 'image' ),
					'assemblee.jpg',
					array(
						'alt'    => __( 'L’assemblée réunie pour le culte à Logos Tabernacle', 'logos-tabernacle' ),
						'width'  => '1080',
						'height' => '720',
					)
				);
				?>
			</figure>

			<div>
				<?php if ( lt_home( 'welcome', 'eyebrow' ) ) : ?>
					<p class="eyebrow"><?php echo esc_html( lt_home( 'welcome', 'eyebrow' ) ); ?></p>
				<?php endif; ?>
				<?php if ( lt_home( 'welcome', 'title' ) ) : ?>
					<h2 class="heading"><?php echo esc_html( lt_home( 'welcome', 'title' ) ); ?></h2>
				<?php endif; ?>
				<?php if ( lt_home( 'welcome', 'lead' ) ) : ?>
					<p class="lead"><?php echo esc_html( lt_tokens( lt_home( 'welcome', 'lead' ) ) ); ?></p>
				<?php endif; ?>

				<?php if ( is_array( $lt_values ) && $lt_values ) : ?>
					<ul class="welcome__values">
						<?php foreach ( $lt_values as $lt_value ) : ?>
							<li>
								<span class="card__icon"><?php lt_the_icon( $lt_value['icon'] ? $lt_value['icon'] : 'book' ); ?></span>
								<div>
									<h3><?php echo esc_html( $lt_value['title'] ); ?></h3>
									<p><?php echo esc_html( $lt_value['text'] ); ?></p>
								</div>
							</li>
						<?php endforeach; ?>
					</ul>
				<?php endif; ?>

				<?php echo lt_button( lt_home( 'welcome', 'button_label' ), lt_home( 'welcome', 'button_url' ), 'btn btn--outline' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
			</div>
		</div>

		<?php
		if ( lt_home( 'welcome', 'show_stats' ) ) {
			get_template_part( 'template-parts/stats', null, array( 'variant' => 'row' ) );
		}
		?>
	</div>
</section>
