<?php
/**
 * Pied de page.
 *
 * @package Logos_Tabernacle
 */

defined( 'ABSPATH' ) || exit;

$lt_schedule       = lt_data( 'schedule' );
$lt_logo_secondary = (int) lt_opt( 'site', 'logo_secondary' );
?>
</main>

<footer class="site-footer">
	<div class="container">
		<div class="site-footer__grid">
			<div class="site-footer__about">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="site-footer__brand">
					<?php if ( $lt_logo_secondary ) : ?>
						<?php echo wp_get_attachment_image( $lt_logo_secondary, 'medium', false, array( 'class' => 'site-footer__logo', 'alt' => lt_opt( 'site', 'name' ), 'loading' => 'lazy' ) ); ?>
					<?php else : ?>
						<?php echo esc_html( lt_opt( 'footer', 'brand' ) ); ?><span>.</span>
					<?php endif; ?>
				</a>
				<?php if ( lt_opt( 'footer', 'about' ) ) : ?>
					<p><?php echo esc_html( lt_tokens( lt_opt( 'footer', 'about' ) ) ); ?></p>
				<?php endif; ?>
				<?php $lt_socials = lt_socials(); ?>
				<?php if ( lt_opt( 'footer', 'show_socials' ) && $lt_socials ) : ?>
					<ul class="site-footer__socials" aria-label="<?php esc_attr_e( 'Réseaux sociaux', 'logos-tabernacle' ); ?>">
						<?php foreach ( $lt_socials as $lt_social ) : ?>
							<li>
								<a href="<?php echo esc_url( $lt_social['url'] ); ?>" target="_blank" rel="noopener noreferrer" aria-label="<?php echo esc_attr( $lt_social['label'] ); ?>">
									<?php lt_the_icon( $lt_social['id'], 20 ); ?>
								</a>
							</li>
						<?php endforeach; ?>
					</ul>
				<?php endif; ?>
			</div>

			<div>
				<h2 class="site-footer__title"><?php echo esc_html( lt_opt( 'footer', 'nav_title' ) ); ?></h2>
				<?php lt_footer_nav(); ?>
			</div>

			<?php if ( lt_opt( 'footer', 'schedule_title' ) && $lt_schedule ) : ?>
				<div>
					<h2 class="site-footer__title"><?php echo esc_html( lt_opt( 'footer', 'schedule_title' ) ); ?></h2>
					<ul class="site-footer__list site-footer__list--schedule">
						<?php foreach ( $lt_schedule as $lt_item ) : ?>
							<li>
								<strong><?php echo esc_html( $lt_item['title'] ); ?></strong>
								<span><?php echo esc_html( trim( $lt_item['day'] . ' · ' . $lt_item['time'], ' ·' ) ); ?></span>
							</li>
						<?php endforeach; ?>
					</ul>
				</div>
			<?php endif; ?>

			<?php if ( lt_opt( 'footer', 'contact_title' ) ) : ?>
				<div>
					<h2 class="site-footer__title"><?php echo esc_html( lt_opt( 'footer', 'contact_title' ) ); ?></h2>
					<ul class="site-footer__list site-footer__list--contact">
						<?php if ( lt_opt( 'site', 'address' ) || lt_opt( 'site', 'city' ) ) : ?>
							<li>
								<?php lt_the_icon( 'pin', 18 ); ?>
								<span><?php echo esc_html( lt_opt( 'site', 'address' ) ); ?><br><?php echo esc_html( lt_opt( 'site', 'city' ) ); ?></span>
							</li>
						<?php endif; ?>
						<?php if ( lt_opt( 'site', 'phone' ) ) : ?>
							<li>
								<?php lt_the_icon( 'phone', 18 ); ?>
								<a href="<?php echo esc_url( lt_phone_href() ); ?>"><?php echo esc_html( lt_opt( 'site', 'phone' ) ); ?></a>
							</li>
						<?php endif; ?>
						<?php if ( lt_whatsapp_number() ) : ?>
							<li>
								<?php lt_the_icon( 'whatsapp', 18 ); ?>
								<a href="<?php echo esc_url( lt_whatsapp_url() ); ?>" target="_blank" rel="noopener noreferrer">WhatsApp</a>
							</li>
						<?php endif; ?>
						<?php if ( lt_opt( 'site', 'email' ) ) : ?>
							<li>
								<?php lt_the_icon( 'mail', 18 ); ?>
								<a href="<?php echo esc_url( 'mailto:' . antispambot( lt_opt( 'site', 'email' ) ) ); ?>"><?php echo esc_html( antispambot( lt_opt( 'site', 'email' ) ) ); ?></a>
							</li>
						<?php endif; ?>
					</ul>
				</div>
			<?php endif; ?>
		</div>

		<div class="site-footer__bottom">
			<p><?php echo esc_html( lt_tokens( lt_opt( 'footer', 'copyright' ) ) ); ?></p>
			<?php
			if ( has_nav_menu( 'legal' ) ) {
				wp_nav_menu(
					array(
						'theme_location' => 'legal',
						'container'      => 'nav',
						'container_class' => 'site-footer__legal',
						'container_aria_label' => __( 'Liens légaux', 'logos-tabernacle' ),
						'depth'          => 1,
					)
				);
			}
			?>
		</div>
	</div>
</footer>

<div class="event-modal" hidden data-modal>
	<div class="event-modal__dialog" role="dialog" aria-modal="true" aria-labelledby="event-modal-title" data-modal-dialog>
		<button type="button" class="event-modal__close" data-modal-close>
			<?php lt_the_icon( 'close' ); ?>
			<span class="visually-hidden"><?php esc_html_e( 'Fermer', 'logos-tabernacle' ); ?></span>
		</button>
		<div data-modal-content></div>
	</div>
</div>

<?php wp_footer(); ?>
</body>
</html>
