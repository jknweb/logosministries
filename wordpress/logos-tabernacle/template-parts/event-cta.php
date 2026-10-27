<?php
/**
 * Bouton WhatsApp « Je participe » d'un événement à venir.
 *
 * @package Logos_Tabernacle
 */

defined( 'ABSPATH' ) || exit;

$lt_event = $args['event'];
if ( ! $lt_event['upcoming'] || ! $lt_event['cta'] || ! lt_whatsapp_number() ) {
	return;
}
/* translators: 1: titre de l'événement, 2: date. */
$lt_message = sprintf( __( 'Bonjour, je souhaite participer à l’événement « %1$s » du %2$s.', 'logos-tabernacle' ), $lt_event['title'], $lt_event['long_date'] );
?>
<a class="btn btn--whatsapp" href="<?php echo esc_url( lt_whatsapp_url( $lt_message ) ); ?>" target="_blank" rel="noopener noreferrer">
	<?php lt_the_icon( 'whatsapp' ); ?>
	<?php esc_html_e( 'Je participe', 'logos-tabernacle' ); ?>
</a>
