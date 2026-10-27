<?php
/**
 * Accueil : bannière principale (verset, bouton LIVE, image en travelling).
 *
 * @package Logos_Tabernacle
 */

defined( 'ABSPATH' ) || exit;

$lt_image  = lt_image_url( (int) lt_home( 'hero', 'image' ), 'temple-interieur.jpg', 'full' );
$lt_mobile = lt_image_url( (int) lt_home( 'hero', 'image_mobile' ), '', 'large' );
$lt_rgb    = sscanf( (string) ( lt_home( 'hero', 'overlay_color' ) ? lt_home( 'hero', 'overlay_color' ) : '#0b0b0c' ), '#%02x%02x%02x' );

$lt_style = array( '--hero-image:url(' . esc_url( $lt_image ) . ')' );
if ( $lt_mobile ) {
	$lt_style[] = '--hero-image-mobile:url(' . esc_url( $lt_mobile ) . ')';
}
if ( is_array( $lt_rgb ) && 3 === count( array_filter( $lt_rgb, 'is_int' ) ) && array( 11, 11, 12 ) !== $lt_rgb ) {
	$lt_style[] = '--hero-overlay:' . implode( ' ', array_map( 'intval', $lt_rgb ) );
}
$lt_strength = (int) lt_home( 'hero', 'overlay_opacity' );
if ( 100 !== $lt_strength && '' !== (string) lt_home( 'hero', 'overlay_opacity' ) ) {
	$lt_style[] = '--hero-strength:' . max( 0, min( 1.3, $lt_strength / 100 ) );
}
$lt_text = sanitize_hex_color( (string) lt_home( 'hero', 'text_color' ) );
if ( $lt_text && '#f4f1ea' !== strtolower( $lt_text ) ) {
	$lt_style[] = '--hero-text:' . $lt_text;
}

$lt_classes = array( 'hero' );
if ( 'center' === lt_home( 'hero', 'align' ) ) {
	$lt_classes[] = 'hero--center';
}
if ( in_array( lt_home( 'hero', 'height' ), array( 'large', 'medium' ), true ) ) {
	$lt_classes[] = 'hero--h-' . lt_home( 'hero', 'height' );
}
if ( in_array( lt_home( 'hero', 'size' ), array( 'small', 'large' ), true ) ) {
	$lt_classes[] = 'hero--verse-' . lt_home( 'hero', 'size' );
}
if ( ! lt_home( 'hero', 'animation' ) ) {
	$lt_classes[] = 'hero--static';
}

$lt_title_visible = (bool) lt_home( 'hero', 'title_visible' );
?>
<section class="<?php echo esc_attr( implode( ' ', $lt_classes ) ); ?>" style="<?php echo esc_attr( implode( ';', $lt_style ) ); ?>">
	<div class="hero__bg" aria-hidden="true"></div>
	<div class="hero__shade" aria-hidden="true"></div>
	<div class="container hero__inner">
		<div class="hero__content fade-up">
			<?php if ( lt_home( 'hero', 'eyebrow' ) ) : ?>
				<p class="eyebrow"><?php echo esc_html( lt_home( 'hero', 'eyebrow' ) ); ?></p>
			<?php endif; ?>
			<?php if ( lt_home( 'hero', 'title' ) ) : ?>
				<h1 class="<?php echo $lt_title_visible ? 'hero__title' : 'visually-hidden'; ?>"><?php echo esc_html( lt_home( 'hero', 'title' ) ); ?></h1>
			<?php endif; ?>
			<?php if ( lt_home( 'hero', 'verse' ) ) : ?>
				<blockquote class="hero__verse">
					<p>« <?php echo esc_html( lt_home( 'hero', 'verse' ) ); ?> »</p>
					<?php if ( lt_home( 'hero', 'reference' ) ) : ?>
						<cite><?php echo esc_html( lt_home( 'hero', 'reference' ) ); ?></cite>
					<?php endif; ?>
				</blockquote>
			<?php endif; ?>
			<?php
			$lt_live   = lt_home( 'hero', 'show_live' ) ? lt_live_button( lt_home( 'hero', 'live_label' ) ) : '';
			$lt_second = lt_button( lt_home( 'hero', 'button_label' ), lt_home( 'hero', 'button_url' ), 'btn btn--ghost' );
			if ( $lt_live || $lt_second ) :
				?>
				<div class="hero__actions">
					<?php echo $lt_live . $lt_second; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- échappé dans les fonctions. ?>
				</div>
			<?php endif; ?>
		</div>
	</div>
</section>
