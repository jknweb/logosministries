<?php
/**
 * Bandeau d'appel à l'action de fin de page.
 *
 * @package Logos_Tabernacle
 */

defined( 'ABSPATH' ) || exit;

$lt_title = ! empty( $args['title'] ) ? $args['title'] : lt_opt( 'footer', 'cta_title' );
$lt_text  = ! empty( $args['text'] ) ? $args['text'] : lt_opt( 'footer', 'cta_text' );
$lt_url   = lt_url( lt_opt( 'footer', 'cta_url' ) );
?>
<section class="cta-band">
	<div class="container cta-band__inner">
		<div>
			<?php if ( $lt_title ) : ?>
				<h2 class="cta-band__title"><?php echo esc_html( $lt_title ); ?></h2>
			<?php endif; ?>
			<?php if ( $lt_text ) : ?>
				<p class="cta-band__text"><?php echo esc_html( $lt_text ); ?></p>
			<?php endif; ?>
		</div>
		<div class="cta-band__actions">
			<?php if ( lt_opt( 'footer', 'cta_button' ) && $lt_url ) : ?>
				<a href="<?php echo esc_url( $lt_url ); ?>" class="btn btn--primary"<?php echo lt_link_attrs( $lt_url ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
					<?php echo esc_html( lt_opt( 'footer', 'cta_button' ) ); ?>
					<?php lt_the_icon( 'arrow' ); ?>
				</a>
			<?php endif; ?>
			<?php if ( lt_opt( 'footer', 'cta_whatsapp' ) && lt_whatsapp_number() ) : ?>
				<a href="<?php echo esc_url( lt_whatsapp_url() ); ?>" class="btn btn--ghost" target="_blank" rel="noopener noreferrer">
					<?php lt_the_icon( 'whatsapp' ); ?>
					WhatsApp
				</a>
			<?php endif; ?>
		</div>
	</div>
</section>
