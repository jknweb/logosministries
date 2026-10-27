<?php
/**
 * Vignette YouTube : le lecteur ne se charge qu'au clic (bien plus léger).
 *
 * @package Logos_Tabernacle
 */

defined( 'ABSPATH' ) || exit;

$lt_sermon = $args['sermon'];
?>
<div class="yt-lite" data-video="<?php echo esc_attr( 'https://www.youtube-nocookie.com/embed/' . rawurlencode( $lt_sermon['youtube_id'] ) . '?autoplay=1&rel=0' ); ?>" data-video-title="<?php echo esc_attr( $lt_sermon['title'] ); ?>">
	<button type="button" class="yt-lite__poster" data-video-play>
		<img src="<?php echo esc_url( 'https://i.ytimg.com/vi/' . rawurlencode( $lt_sermon['youtube_id'] ) . '/hqdefault.jpg' ); ?>" alt="" loading="lazy">
		<span class="yt-lite__play"><?php lt_the_icon( 'play', 28 ); ?></span>
		<span class="visually-hidden"><?php echo esc_html( sprintf( /* translators: %s: titre de la vidéo. */ __( 'Lire la vidéo : %s', 'logos-tabernacle' ), $lt_sermon['title'] ) ); ?></span>
	</button>
</div>
