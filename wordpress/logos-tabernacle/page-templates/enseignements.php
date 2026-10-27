<?php
/**
 * Template Name: Enseignements
 *
 * Vidéos YouTube (Église › Enseignements) et ressources PDF (Église › Ressources PDF).
 *
 * @package Logos_Tabernacle
 */

defined( 'ABSPATH' ) || exit;

get_header();
the_post();
lt_the_page_header();

$lt_resources = lt_data( 'resources' );
?>
<?php if ( lt_data( 'sermons', (int) lt_page( 'count' ) ) ) : ?>
	<section class="section section--dark-2">
		<div class="container">
			<?php get_template_part( 'template-parts/sermon-showcase', null, array( 'count' => (int) lt_page( 'count' ) ) ); ?>
		</div>
	</section>
<?php endif; ?>

<?php if ( $lt_resources ) : ?>
	<section class="section section--cream">
		<div class="container">
			<?php get_template_part( 'template-parts/section-head', null, array( 'eyebrow' => lt_page( 'resources_eyebrow' ), 'title' => lt_page( 'resources_title' ), 'center' => true ) ); ?>
			<div class="grid grid--3">
				<?php foreach ( $lt_resources as $lt_resource ) : ?>
					<a class="card" href="<?php echo esc_url( $lt_resource['url'] ); ?>" download>
						<span class="card__icon"><?php lt_the_icon( 'download' ); ?></span>
						<h3 class="card__title"><?php echo esc_html( $lt_resource['title'] ); ?></h3>
						<p class="card__text">PDF<?php echo $lt_resource['size'] ? ' · ' . esc_html( $lt_resource['size'] ) : ''; ?></p>
					</a>
				<?php endforeach; ?>
			</div>
		</div>
	</section>
<?php endif; ?>

<?php
lt_the_extra_content();
get_template_part(
	'template-parts/verse-banner',
	null,
	array(
		'text'      => lt_page( 'verse_text' ),
		'reference' => lt_page( 'verse_ref' ),
		'image_id'  => (int) lt_page( 'verse_image' ),
	)
);
lt_the_page_cta();
get_footer();
