<?php
/**
 * Lecteur habillé aux couleurs du site : le lecteur YouTube (sans cookies) ne se charge qu'au clic.
 *
 * @package Logos_Tabernacle
 */

defined( 'ABSPATH' ) || exit;

$lt_sermon = $args['sermon'];
$lt_poster = $lt_sermon['image_id'] ? wp_get_attachment_image_url( $lt_sermon['image_id'], 'large' ) : 'https://i.ytimg.com/vi/' . rawurlencode( $lt_sermon['youtube_id'] ) . '/hqdefault.jpg';
$lt_params = 'autoplay=1&rel=0&modestbranding=1&iv_load_policy=3&playsinline=1&color=white';
?>
<div class="player" data-video="<?php echo esc_attr( 'https://www.youtube-nocookie.com/embed/' . rawurlencode( $lt_sermon['youtube_id'] ) . '?' . $lt_params ); ?>" data-video-title="<?php echo esc_attr( $lt_sermon['title'] ); ?>" data-video-class="player--playing">
	<button type="button" class="player__poster" data-video-play>
		<img src="<?php echo esc_url( $lt_poster ); ?>" alt="" loading="lazy">
		<span class="player__shade" aria-hidden="true"></span>
		<span class="player__play" aria-hidden="true"><?php lt_the_icon( 'play', 34 ); ?></span>
		<span class="player__caption">
			<span class="player__label"><?php esc_html_e( 'Regarder', 'logos-tabernacle' ); ?></span>
			<span class="player__title"><?php echo esc_html( $lt_sermon['title'] ); ?></span>
		</span>
		<span class="visually-hidden"><?php echo esc_html( sprintf( /* translators: %s: titre de la vidéo. */ __( 'Lire la vidéo : %s', 'logos-tabernacle' ), $lt_sermon['title'] ) ); ?></span>
	</button>
</div>
