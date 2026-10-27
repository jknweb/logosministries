<?php
/**
 * Carte d'un article dans une liste.
 *
 * @package Logos_Tabernacle
 */

defined( 'ABSPATH' ) || exit;

$lt_categories = 'post' === get_post_type() ? get_the_category() : array();
?>
<article <?php post_class( 'event-card post-card' ); ?>>
	<a class="event-card__media" href="<?php the_permalink(); ?>" tabindex="-1" aria-hidden="true">
		<?php echo lt_image( (int) get_post_thumbnail_id(), 'assemblee.jpg', array( 'alt' => '' ), 'lt-card' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
	</a>
	<div class="event-card__body">
		<p class="event-card__meta">
			<?php lt_the_icon( 'calendar', 16 ); ?>
			<time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo esc_html( get_the_date( 'j F Y' ) ); ?></time>
			<?php if ( $lt_categories ) : ?>
				· <?php echo esc_html( $lt_categories[0]->name ); ?>
			<?php endif; ?>
		</p>
		<h2 class="event-card__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
		<p class="event-card__text"><?php echo esc_html( get_the_excerpt() ); ?></p>
		<a href="<?php the_permalink(); ?>" class="link-arrow event-card__more">
			<?php esc_html_e( 'Lire la suite', 'logos-tabernacle' ); ?>
			<?php lt_the_icon( 'arrow', 18 ); ?>
		</a>
	</div>
</article>
