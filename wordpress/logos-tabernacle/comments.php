<?php
/**
 * Commentaires des articles.
 *
 * @package Logos_Tabernacle
 */

defined( 'ABSPATH' ) || exit;

if ( post_password_required() ) {
	return;
}
?>
<div id="comments" class="comments-area">
	<?php if ( have_comments() ) : ?>
		<h2 class="contact__form-title">
			<?php
			/* translators: %s: nombre de commentaires. */
			echo esc_html( sprintf( _n( '%s commentaire', '%s commentaires', get_comments_number(), 'logos-tabernacle' ), number_format_i18n( get_comments_number() ) ) );
			?>
		</h2>
		<ol class="comment-list">
			<?php wp_list_comments( array( 'style' => 'ol', 'short_ping' => true, 'avatar_size' => 48 ) ); ?>
		</ol>
		<?php the_comments_navigation(); ?>
	<?php endif; ?>
	<?php comment_form(); ?>
</div>
