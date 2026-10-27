<?php
/**
 * Bandeau d'en-tête des pages intérieures : fil d'Ariane, surtitre, titre (H1), introduction.
 *
 * @package Logos_Tabernacle
 */

defined( 'ABSPATH' ) || exit;

$lt_args = wp_parse_args(
	$args,
	array(
		'title'    => '',
		'eyebrow'  => '',
		'intro'    => '',
		'image_id' => 0,
		'image'    => 'temple-interieur.jpg',
		'crumbs'   => array(),
	)
);
$lt_image = lt_image_url( (int) $lt_args['image_id'], $lt_args['image'], 'full' );
?>
<section class="page-header" style="<?php echo esc_attr( '--page-header-image:url(' . esc_url( $lt_image ) . ')' ); ?>">
	<div class="container fade-up">
		<nav class="page-header__crumbs" aria-label="<?php esc_attr_e( 'Fil d’Ariane', 'logos-tabernacle' ); ?>">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Accueil', 'logos-tabernacle' ); ?></a>
			<?php foreach ( $lt_args['crumbs'] as $lt_crumb ) : ?>
				<span aria-hidden="true">/</span>
				<a href="<?php echo esc_url( $lt_crumb[1] ); ?>"><?php echo esc_html( $lt_crumb[0] ); ?></a>
			<?php endforeach; ?>
			<span aria-hidden="true">/</span>
			<span aria-current="page"><?php echo esc_html( wp_strip_all_tags( $lt_args['title'] ) ); ?></span>
		</nav>
		<?php if ( $lt_args['eyebrow'] ) : ?>
			<p class="eyebrow"><?php echo esc_html( $lt_args['eyebrow'] ); ?></p>
		<?php endif; ?>
		<h1 class="page-header__title"><?php echo esc_html( wp_strip_all_tags( $lt_args['title'] ) ); ?></h1>
		<?php if ( $lt_args['intro'] ) : ?>
			<p class="page-header__intro"><?php echo esc_html( $lt_args['intro'] ); ?></p>
		<?php endif; ?>
	</div>
</section>
<?php
// Fil d'Ariane en données structurées.
$lt_items = array( array( '@type' => 'ListItem', 'position' => 1, 'name' => __( 'Accueil', 'logos-tabernacle' ), 'item' => home_url( '/' ) ) );
foreach ( $lt_args['crumbs'] as $lt_i => $lt_crumb ) {
	$lt_items[] = array( '@type' => 'ListItem', 'position' => $lt_i + 2, 'name' => $lt_crumb[0], 'item' => $lt_crumb[1] );
}
$lt_items[] = array( '@type' => 'ListItem', 'position' => count( $lt_items ) + 1, 'name' => wp_strip_all_tags( $lt_args['title'] ) );
if ( ! lt_seo_plugin_active() ) {
	echo '<script type="application/ld+json">' . wp_json_encode( array( '@context' => 'https://schema.org', '@type' => 'BreadcrumbList', 'itemListElement' => $lt_items ), JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE ) . '</script>';
}
