<?php
/**
 * Template Name: Pasteur
 *
 * Pasteur principal (présentation et biographie) et pasteurs associés (Église › Équipe pastorale).
 *
 * @package Logos_Tabernacle
 */

defined( 'ABSPATH' ) || exit;

get_header();
the_post();
lt_the_page_header();

$lt_team   = lt_data( 'team' );
$lt_lead   = $lt_team['lead'];
$lt_bio    = $lt_lead ? lt_split_chapters( $lt_lead['content'] ) : array();
?>
<?php if ( $lt_lead ) : ?>
	<section class="section section--light">
		<div class="container">
			<?php get_template_part( 'template-parts/pastor-intro', null, array( 'pastor' => $lt_lead, 'eyebrow' => lt_page( 'intro_eyebrow' ) ) ); ?>
		</div>
	</section>
<?php endif; ?>

<?php if ( $lt_bio ) : ?>
	<section class="section section--cream">
		<div class="container container--narrow">
			<?php get_template_part( 'template-parts/section-head', null, array( 'eyebrow' => lt_page( 'bio_eyebrow' ), 'title' => lt_page( 'bio_title' ) ) ); ?>
			<div class="bio">
				<?php foreach ( $lt_bio as $lt_chapter ) : ?>
					<article class="bio__chapter">
						<h3 class="bio__title"><?php echo esc_html( $lt_chapter['title'] ); ?></h3>
						<div class="prose entry-content">
							<?php echo wp_kses_post( $lt_chapter['html'] ); ?>
						</div>
					</article>
				<?php endforeach; ?>
			</div>
		</div>
	</section>
<?php endif; ?>

<?php if ( $lt_team['associates'] ) : ?>
	<section class="section section--light">
		<div class="container">
			<?php get_template_part( 'template-parts/section-head', null, array( 'eyebrow' => lt_page( 'team_eyebrow' ), 'title' => lt_page( 'team_title' ), 'center' => true ) ); ?>
			<div class="team">
				<?php foreach ( $lt_team['associates'] as $lt_member ) : ?>
					<article class="team__member">
						<?php
						echo lt_image( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
							$lt_member['image_id'],
							'',
							array(
								'class' => 'team__photo',
								/* translators: %s: nom. */
								'alt'   => sprintf( __( 'Portrait du %s', 'logos-tabernacle' ), $lt_member['name'] ),
							),
							'lt-portrait'
						);
						?>
						<h3 class="team__name"><?php echo esc_html( $lt_member['name'] ); ?></h3>
						<?php if ( $lt_member['role'] ) : ?>
							<p class="team__role"><?php echo esc_html( $lt_member['role'] ); ?></p>
						<?php endif; ?>
						<?php if ( $lt_member['socials'] ) : ?>
							<ul class="team__socials">
								<?php foreach ( $lt_member['socials'] as $lt_network => $lt_link ) : ?>
									<li><a href="<?php echo esc_url( $lt_link ); ?>" target="_blank" rel="noopener noreferrer" aria-label="<?php echo esc_attr( ucfirst( $lt_network ) ); ?>"><?php lt_the_icon( $lt_network, 18 ); ?></a></li>
								<?php endforeach; ?>
							</ul>
						<?php endif; ?>
					</article>
				<?php endforeach; ?>
			</div>
		</div>
	</section>
<?php endif; ?>

<?php
lt_the_extra_content();
lt_the_page_cta();
get_footer();
