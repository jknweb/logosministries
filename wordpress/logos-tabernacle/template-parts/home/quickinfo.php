<?php
/**
 * Accueil : bandeau d'informations pratiques (horaires et adresse).
 *
 * @package Logos_Tabernacle
 */

defined( 'ABSPATH' ) || exit;

$lt_schedule = lt_data( 'schedule' );

// Le bas du bandeau prolonge le fond de la section suivante (gris « À la une » sur le site d'origine).
$lt_next  = isset( $args['next'] ) ? $args['next'] : '';
$lt_fixed = array( 'featured' => 'graphite', 'verse' => 'dark', 'visit' => 'cream' );
$lt_bg    = isset( $lt_fixed[ $lt_next ] ) ? $lt_fixed[ $lt_next ] : ( $lt_next ? lt_home( $lt_next, 'bg' ) : 'light' );
$lt_style = 'graphite' === $lt_bg ? '' : '--qi-next:' . lt_bg_var( $lt_bg );
?>
<section class="quick-info" aria-label="<?php esc_attr_e( 'Informations pratiques', 'logos-tabernacle' ); ?>"<?php echo $lt_style ? ' style="' . esc_attr( $lt_style ) . '"' : ''; ?>>
	<div class="container quick-info__grid">
		<?php foreach ( $lt_schedule as $lt_item ) : ?>
			<div class="quick-info__item">
				<?php lt_the_icon( 'clock', 24, 'quick-info__icon' ); ?>
				<div>
					<strong><?php echo esc_html( $lt_item['title'] ); ?></strong>
					<span><?php echo esc_html( trim( $lt_item['day'] . ' ' . __( 'à', 'logos-tabernacle' ) . ' ' . $lt_item['time'] ) ); ?></span>
				</div>
			</div>
		<?php endforeach; ?>
		<a href="<?php echo esc_url( home_url( '/#visite' ) ); ?>" class="quick-info__item quick-info__item--link">
			<?php lt_the_icon( 'pin', 24, 'quick-info__icon' ); ?>
			<div>
				<strong><?php echo esc_html( lt_opt( 'site', 'address' ) ); ?></strong>
				<span><?php echo esc_html( lt_opt( 'site', 'city' ) ); ?></span>
			</div>
		</a>
	</div>
</section>
