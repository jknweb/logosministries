<?php
/**
 * Template Name: Contact
 *
 * Coordonnées (Paramètres du site), formulaire (extension) et bloc visite.
 *
 * @package Logos_Tabernacle
 */

defined( 'ABSPATH' ) || exit;

get_header();
the_post();
lt_the_page_header();

$lt_email    = lt_opt( 'site', 'email' );
$lt_channels = array();
if ( lt_opt( 'site', 'phone' ) ) {
	$lt_channels[] = array( 'phone', __( 'Téléphone', 'logos-tabernacle' ), lt_opt( 'site', 'phone' ), lt_phone_href(), false );
}
if ( lt_whatsapp_number() ) {
	$lt_channels[] = array( 'whatsapp', 'WhatsApp', lt_opt( 'site', 'whatsapp' ), lt_whatsapp_url(), true );
}
if ( $lt_email ) {
	$lt_channels[] = array( 'mail', __( 'E-mail', 'logos-tabernacle' ), antispambot( $lt_email ), 'mailto:' . antispambot( $lt_email ), false );
}
$lt_channels[] = array( 'pin', __( 'Adresse', 'logos-tabernacle' ), trim( lt_opt( 'site', 'address' ) . ', ' . lt_opt( 'site', 'city' ), ', ' ), lt_page( 'show_visit' ) ? '#visite' : lt_maps_directions_url(), ! lt_page( 'show_visit' ) );
if ( lt_opt( 'site', 'office_hours' ) ) {
	$lt_channels[] = array( 'clock', __( 'Horaires d’ouverture', 'logos-tabernacle' ), lt_opt( 'site', 'office_hours' ), '', false );
}
?>
<section class="section section--light">
	<div class="container contact">
		<div>
			<?php if ( lt_page( 'channels_eyebrow' ) ) : ?>
				<p class="eyebrow"><?php echo esc_html( lt_page( 'channels_eyebrow' ) ); ?></p>
			<?php endif; ?>
			<?php if ( lt_page( 'channels_title' ) ) : ?>
				<h2 class="heading"><?php echo esc_html( lt_page( 'channels_title' ) ); ?></h2>
			<?php endif; ?>
			<?php if ( lt_page( 'channels_lead' ) ) : ?>
				<p class="lead"><?php echo esc_html( lt_page( 'channels_lead' ) ); ?></p>
			<?php endif; ?>
			<ul class="contact__channels">
				<?php foreach ( $lt_channels as $lt_channel ) : ?>
					<li>
						<?php if ( $lt_channel[3] ) : ?>
							<a href="<?php echo esc_url( $lt_channel[3] ); ?>"<?php echo $lt_channel[4] ? ' target="_blank" rel="noopener noreferrer"' : ''; ?>>
						<?php else : ?>
							<span class="contact__channel">
						<?php endif; ?>
							<span class="card__icon"><?php lt_the_icon( $lt_channel[0] ); ?></span>
							<span>
								<small><?php echo esc_html( $lt_channel[1] ); ?></small>
								<?php echo nl2br( esc_html( $lt_channel[2] ) ); ?>
							</span>
						<?php echo $lt_channel[3] ? '</a>' : '</span>'; ?>
					</li>
				<?php endforeach; ?>
			</ul>
		</div>
		<div>
			<?php if ( lt_page( 'form_title' ) ) : ?>
				<h2 class="contact__form-title"><?php echo esc_html( lt_page( 'form_title' ) ); ?></h2>
			<?php endif; ?>
			<?php
			if ( function_exists( 'logos_contact_form' ) ) {
				echo logos_contact_form(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- échappé dans l'extension.
			} else {
				echo '<div class="contact-form"><p>' . esc_html__( 'Écrivez-nous directement sur WhatsApp ou par e-mail.', 'logos-tabernacle' ) . '</p><div class="contact-form__actions">';
				if ( lt_whatsapp_number() ) {
					echo '<a class="btn btn--whatsapp" href="' . esc_url( lt_whatsapp_url() ) . '" target="_blank" rel="noopener noreferrer">' . lt_icon( 'whatsapp' ) . 'WhatsApp</a>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				}
				if ( $lt_email ) {
					echo '<a class="btn btn--outline" href="' . esc_url( 'mailto:' . antispambot( $lt_email ) ) . '">' . lt_icon( 'mail' ) . esc_html__( 'E-mail', 'logos-tabernacle' ) . '</a>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				}
				echo '</div></div>';
			}
			?>
		</div>
	</div>
</section>

<?php
lt_the_extra_content();
if ( lt_page( 'show_visit' ) ) {
	get_template_part( 'template-parts/visit-block' );
}
get_footer();
