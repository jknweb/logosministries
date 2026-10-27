<?php
/**
 * Vitrine des enseignements : texte, boutons, vidéo principale et vidéos précédentes.
 *
 * @package Logos_Tabernacle
 */

defined( 'ABSPATH' ) || exit;

$lt_sermons = lt_data( 'sermons', isset( $args['count'] ) ? (int) $args['count'] : 3 );
if ( ! $lt_sermons ) {
	return;
}
$lt_featured = array_shift( $lt_sermons );
$lt_channel  = rtrim( lt_youtube_channel(), '/' );
$lt_url1     = lt_home( 'sermons', 'button1_url' ) ? lt_url( lt_home( 'sermons', 'button1_url' ) ) : lt_live_url();
$lt_url2     = lt_home( 'sermons', 'button2_url' ) ? lt_url( lt_home( 'sermons', 'button2_url' ) ) : ( $lt_channel ? $lt_channel . '?sub_confirmation=1' : '' );
?>
<div class="sermons">
	<div class="sermons__intro">
		<?php if ( lt_home( 'sermons', 'eyebrow' ) ) : ?>
			<p class="eyebrow"><?php echo esc_html( lt_home( 'sermons', 'eyebrow' ) ); ?></p>
		<?php endif; ?>
		<?php if ( lt_home( 'sermons', 'title' ) ) : ?>
			<h2 class="heading"><?php echo esc_html( lt_home( 'sermons', 'title' ) ); ?></h2>
		<?php endif; ?>
		<?php if ( lt_home( 'sermons', 'lead' ) ) : ?>
			<p class="lead"><?php echo esc_html( lt_home( 'sermons', 'lead' ) ); ?></p>
		<?php endif; ?>
		<div class="sermons__actions">
			<?php if ( lt_home( 'sermons', 'button1_label' ) && $lt_url1 ) : ?>
				<a href="<?php echo esc_url( $lt_url1 ); ?>" class="btn btn--primary"<?php echo lt_link_attrs( $lt_url1 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
					<?php lt_the_icon( 'youtube' ); ?>
					<?php echo esc_html( lt_home( 'sermons', 'button1_label' ) ); ?>
				</a>
			<?php endif; ?>
			<?php if ( lt_home( 'sermons', 'button2_label' ) && $lt_url2 ) : ?>
				<a href="<?php echo esc_url( $lt_url2 ); ?>" class="btn btn--ghost"<?php echo lt_link_attrs( $lt_url2 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
					<?php echo esc_html( lt_home( 'sermons', 'button2_label' ) ); ?>
				</a>
			<?php endif; ?>
		</div>
	</div>
	<div class="sermons__videos">
		<?php get_template_part( 'template-parts/youtube-lite', null, array( 'sermon' => $lt_featured ) ); ?>
		<?php if ( $lt_sermons ) : ?>
			<div class="sermons__more">
				<?php
				foreach ( $lt_sermons as $lt_sermon ) {
					get_template_part( 'template-parts/youtube-lite', null, array( 'sermon' => $lt_sermon ) );
				}
				?>
			</div>
		<?php endif; ?>
	</div>
</div>
