<?php
/**
 * Page introuvable.
 *
 * @package Logos_Tabernacle
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>
<section class="section section--dark not-found">
	<div class="container container--narrow text-center">
		<p class="eyebrow"><?php echo esc_html( lt_opt( 'footer', '404_eyebrow' ) ); ?></p>
		<h1 class="heading"><?php echo esc_html( lt_opt( 'footer', '404_title' ) ); ?></h1>
		<p class="lead"><?php echo esc_html( lt_opt( 'footer', '404_text' ) ); ?></p>
		<div class="section__foot">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn btn--primary"><?php esc_html_e( 'Retour à l’accueil', 'logos-tabernacle' ); ?></a>
			<a href="<?php echo esc_url( lt_template_page_url( 'contact', '/contact/' ) ); ?>" class="btn btn--ghost"><?php esc_html_e( 'Nous contacter', 'logos-tabernacle' ); ?></a>
		</div>
	</div>
</section>
<?php
get_footer();
