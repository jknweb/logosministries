<?php
/**
 * Article seul (actualité).
 *
 * @package Logos_Tabernacle
 */

defined( 'ABSPATH' ) || exit;

get_header();
the_post();

$lt_blog       = get_option( 'page_for_posts' ) ? array( array( get_the_title( (int) get_option( 'page_for_posts' ) ), get_permalink( (int) get_option( 'page_for_posts' ) ) ) ) : array();
$lt_categories = get_the_category();
get_template_part(
	'template-parts/page-header',
	null,
	array(
		'title'    => get_the_title(),
		'eyebrow'  => $lt_categories ? $lt_categories[0]->name : __( 'Actualités', 'logos-tabernacle' ),
		/* translators: 1: date, 2: auteur. */
		'intro'    => sprintf( __( 'Publié le %1$s par %2$s', 'logos-tabernacle' ), get_the_date( 'j F Y' ), get_the_author() ),
		'image_id' => (int) get_post_thumbnail_id(),
		'crumbs'   => $lt_blog,
	)
);
?>
<article <?php post_class( 'section section--light' ); ?>>
	<div class="container container--narrow entry-content">
		<?php
		the_content();
		wp_link_pages();
		?>
		<?php if ( has_tag() ) : ?>
			<p class="entry-tags"><?php the_tags( '', ' ' ); ?></p>
		<?php endif; ?>
		<nav class="entry-nav" aria-label="<?php esc_attr_e( 'Articles voisins', 'logos-tabernacle' ); ?>">
			<?php previous_post_link( '<span class="entry-nav__prev">%link</span>', '← %title' ); ?>
			<?php next_post_link( '<span class="entry-nav__next">%link</span>', '%title →' ); ?>
		</nav>
		<?php
		if ( comments_open() || get_comments_number() ) {
			comments_template();
		}
		?>
	</div>
</article>
<?php
get_footer();
