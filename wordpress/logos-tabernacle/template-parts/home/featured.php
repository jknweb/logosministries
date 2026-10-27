<?php
/**
 * Accueil : « À la une » (dernière vidéo ou vidéo choisie).
 *
 * @package Logos_Tabernacle
 */

defined( 'ABSPATH' ) || exit;

$lt_sermon = lt_data( 'featured_sermon' );
if ( ! $lt_sermon ) {
	return;
}
$lt_link = lt_home( 'featured', 'link_url' ) ? lt_url( lt_home( 'featured', 'link_url' ) ) : lt_youtube_channel();
?>
<section class="section section--dark featured">
	<div class="container">
		<div class="section__head section__head--center">
			<?php if ( lt_home( 'featured', 'eyebrow' ) ) : ?>
				<p class="eyebrow"><?php echo esc_html( lt_home( 'featured', 'eyebrow' ) ); ?></p>
			<?php endif; ?>
			<?php if ( lt_home( 'featured', 'title' ) ) : ?>
				<h2 class="heading"><?php echo esc_html( lt_home( 'featured', 'title' ) ); ?></h2>
			<?php endif; ?>
		</div>

		<div class="featured__grid">
			<?php get_template_part( 'template-parts/video-player', null, array( 'sermon' => $lt_sermon ) ); ?>

			<aside class="featured__side">
				<div class="featured__info">
					<ul class="featured__meta">
						<?php if ( $lt_sermon['speaker'] ) : ?>
							<li>
								<?php lt_the_icon( 'user', 18 ); ?>
								<span><small><?php esc_html_e( 'Prédicateur', 'logos-tabernacle' ); ?></small><?php echo esc_html( $lt_sermon['speaker'] ); ?></span>
							</li>
						<?php endif; ?>
						<?php if ( $lt_sermon['long_date'] ) : ?>
							<li>
								<?php lt_the_icon( 'calendar', 18 ); ?>
								<span><small><?php esc_html_e( 'Date', 'logos-tabernacle' ); ?></small><?php echo esc_html( $lt_sermon['long_date'] ); ?></span>
							</li>
						<?php endif; ?>
					</ul>
					<?php if ( $lt_sermon['summary'] ) : ?>
						<p class="featured__summary"><?php echo esc_html( $lt_sermon['summary'] ); ?></p>
					<?php endif; ?>
					<div class="featured__actions">
						<?php
						if ( lt_home( 'featured', 'show_live' ) ) {
							echo lt_live_button( lt_home( 'featured', 'live_label' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
						}
						?>
						<?php if ( lt_home( 'featured', 'link_label' ) && $lt_link ) : ?>
							<a href="<?php echo esc_url( $lt_link ); ?>" class="link-arrow"<?php echo lt_link_attrs( $lt_link ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
								<?php echo esc_html( lt_home( 'featured', 'link_label' ) ); ?>
								<?php lt_the_icon( 'arrow', 18 ); ?>
							</a>
						<?php endif; ?>
					</div>
				</div>
			</aside>
		</div>
	</div>
</section>
