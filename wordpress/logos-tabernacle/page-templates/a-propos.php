<?php
/**
 * Template Name: À propos
 *
 * Histoire de l'église : origines (contenu de la page), chiffres, frise et identité.
 *
 * @package Logos_Tabernacle
 */

defined( 'ABSPATH' ) || exit;

get_header();
the_post();
lt_the_page_header();

$lt_timeline = lt_page( 'timeline' );
$lt_pillars  = lt_page( 'pillars' );
?>
<section class="section section--light">
	<div class="container split">
		<div>
			<?php if ( lt_page( 'origins_eyebrow' ) ) : ?>
				<p class="eyebrow"><?php echo esc_html( lt_page( 'origins_eyebrow' ) ); ?></p>
			<?php endif; ?>
			<?php if ( lt_page( 'origins_title' ) ) : ?>
				<h2 class="heading"><?php echo esc_html( lt_page( 'origins_title' ) ); ?></h2>
			<?php endif; ?>
			<div class="prose entry-content">
				<?php the_content(); ?>
			</div>
		</div>
		<?php
		if ( lt_page( 'show_stats' ) ) {
			get_template_part( 'template-parts/stats' );
		}
		?>
	</div>
</section>

<?php if ( is_array( $lt_timeline ) && $lt_timeline ) : ?>
	<section class="section section--cream">
		<div class="container">
			<?php get_template_part( 'template-parts/section-head', null, array( 'eyebrow' => lt_page( 'timeline_eyebrow' ), 'title' => lt_page( 'timeline_title' ), 'center' => true ) ); ?>
			<ol class="timeline">
				<?php foreach ( $lt_timeline as $lt_item ) : ?>
					<li class="timeline__item">
						<span class="timeline__year"><?php echo esc_html( $lt_item['year'] ); ?></span>
						<div class="timeline__body">
							<h3 class="timeline__title"><?php echo esc_html( $lt_item['title'] ); ?></h3>
							<p><?php echo esc_html( $lt_item['text'] ); ?></p>
						</div>
					</li>
				<?php endforeach; ?>
			</ol>
		</div>
	</section>
<?php endif; ?>

<?php if ( is_array( $lt_pillars ) && $lt_pillars ) : ?>
	<section class="section section--dark">
		<div class="container">
			<?php get_template_part( 'template-parts/section-head', null, array( 'eyebrow' => lt_page( 'identity_eyebrow' ), 'title' => lt_page( 'identity_title' ), 'lead' => lt_page( 'identity_lead' ), 'center' => true ) ); ?>
			<div class="grid grid--3">
				<?php foreach ( $lt_pillars as $lt_pillar ) : ?>
					<article class="card">
						<h3 class="card__title"><?php echo esc_html( $lt_pillar['title'] ); ?></h3>
						<p class="card__text"><?php echo esc_html( $lt_pillar['text'] ); ?></p>
					</article>
				<?php endforeach; ?>
			</div>
		</div>
	</section>
<?php endif; ?>

<?php
lt_the_page_cta();
get_footer();
