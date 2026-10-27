<?php
/**
 * Page d'un enseignement : vidéo, informations et texte.
 *
 * @package Logos_Tabernacle
 */

defined( 'ABSPATH' ) || exit;

get_header();
the_post();

$lt_sermon = function_exists( 'logos_contenus_sermon' ) ? logos_contenus_sermon( get_post() ) : null;
get_template_part(
	'template-parts/page-header',
	null,
	array(
		'title'    => get_the_title(),
		'eyebrow'  => __( 'Enseignement', 'logos-tabernacle' ),
		'intro'    => $lt_sermon ? trim( $lt_sermon['speaker'] . ( $lt_sermon['speaker'] && $lt_sermon['long_date'] ? ' · ' : '' ) . $lt_sermon['long_date'] ) : '',
		'image'    => 'ambiance-temple.jpg',
		'crumbs'   => array( array( __( 'Enseignements', 'logos-tabernacle' ), lt_template_page_url( 'enseignements', '/enseignements/' ) ) ),
	)
);
?>
<section class="section section--dark featured">
	<div class="container">
		<div class="featured__grid">
			<?php
			if ( $lt_sermon && $lt_sermon['youtube_id'] ) {
				get_template_part( 'template-parts/video-player', null, array( 'sermon' => $lt_sermon ) );
			}
			?>
			<?php if ( $lt_sermon && $lt_sermon['summary'] ) : ?>
				<p class="featured__summary"><?php echo esc_html( $lt_sermon['summary'] ); ?></p>
			<?php endif; ?>
		</div>
	</div>
</section>
<?php if ( '' !== trim( get_the_content() ) ) : ?>
	<section class="section section--light">
		<div class="container container--narrow entry-content"><?php the_content(); ?></div>
	</section>
<?php endif; ?>
<?php
get_template_part( 'template-parts/cta-band' );
get_footer();
