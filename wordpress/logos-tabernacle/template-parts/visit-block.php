<?php
/**
 * Bloc « Planifiez votre visite » : horaires, adresse, carte et contacts directs.
 * Textes : Logos Tabernacle › Page d'accueil › Planifiez votre visite.
 *
 * @package Logos_Tabernacle
 */

defined( 'ABSPATH' ) || exit;

$lt_schedule = lt_data( 'schedule' );
?>
<section class="section section--cream" id="visite">
	<div class="container visit">
		<div class="visit__info">
			<?php if ( lt_home( 'visit', 'eyebrow' ) ) : ?>
				<p class="eyebrow"><?php echo esc_html( lt_home( 'visit', 'eyebrow' ) ); ?></p>
			<?php endif; ?>
			<?php if ( lt_home( 'visit', 'title' ) ) : ?>
				<h2 class="heading"><?php echo esc_html( lt_home( 'visit', 'title' ) ); ?></h2>
			<?php endif; ?>
			<?php if ( lt_home( 'visit', 'lead' ) ) : ?>
				<p class="lead"><?php echo esc_html( lt_home( 'visit', 'lead' ) ); ?></p>
			<?php endif; ?>

			<?php if ( $lt_schedule ) : ?>
				<ul class="visit__schedule">
					<?php foreach ( $lt_schedule as $lt_item ) : ?>
						<li>
							<span><?php echo esc_html( $lt_item['title'] ); ?></span>
							<strong><?php echo esc_html( trim( $lt_item['day'] . ' · ' . $lt_item['time'], ' ·' ) ); ?></strong>
						</li>
					<?php endforeach; ?>
				</ul>
			<?php endif; ?>

			<address class="visit__address">
				<?php lt_the_icon( 'pin' ); ?>
				<span>
					<?php echo esc_html( trim( lt_opt( 'site', 'address' ) . ', ' . lt_opt( 'site', 'city' ), ', ' ) ); ?>
					<small><?php echo esc_html( lt_opt( 'site', 'country' ) ); ?></small>
				</span>
			</address>

			<div class="visit__actions">
				<a href="<?php echo esc_url( lt_maps_directions_url() ); ?>" class="btn btn--primary" target="_blank" rel="noopener noreferrer">
					<?php lt_the_icon( 'directions' ); ?>
					<?php esc_html_e( 'Itinéraire', 'logos-tabernacle' ); ?>
				</a>
				<?php if ( lt_whatsapp_number() ) : ?>
					<a href="<?php echo esc_url( lt_whatsapp_url( lt_home( 'visit', 'whatsapp_message' ) ) ); ?>" class="btn btn--whatsapp" target="_blank" rel="noopener noreferrer">
						<?php lt_the_icon( 'whatsapp' ); ?>
						WhatsApp
					</a>
				<?php endif; ?>
				<?php if ( lt_opt( 'site', 'phone' ) ) : ?>
					<a href="<?php echo esc_url( lt_phone_href() ); ?>" class="btn btn--outline">
						<?php lt_the_icon( 'phone' ); ?>
						<?php esc_html_e( 'Appeler', 'logos-tabernacle' ); ?>
					</a>
				<?php endif; ?>
			</div>
		</div>

		<?php if ( lt_home( 'visit', 'show_map' ) ) : ?>
			<div class="visit__map">
				<iframe src="<?php echo esc_url( lt_maps_embed_url() ); ?>" title="<?php echo esc_attr( sprintf( /* translators: %s: adresse. */ __( 'Carte : %s', 'logos-tabernacle' ), lt_opt( 'site', 'name' ) . ', ' . lt_opt( 'site', 'address' ) ) ); ?>" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
			</div>
		<?php endif; ?>
	</div>
</section>
