<?php
/**
 * En-tête du site.
 *
 * @package Logos_Tabernacle
 */

defined( 'ABSPATH' ) || exit;

$lt_logo_width = (int) lt_opt( 'header', 'logo_width' );
$lt_cta_label  = lt_opt( 'header', 'cta_label' );
$lt_cta_url    = lt_url( lt_opt( 'header', 'cta_url' ) );
$lt_solid      = 'solid' === lt_opt( 'header', 'behavior' );
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<a href="#contenu" class="skip-link"><?php esc_html_e( 'Aller au contenu', 'logos-tabernacle' ); ?></a>

<header class="site-header<?php echo $lt_solid ? ' site-header--solid site-header--always-solid' : ''; ?>" data-header>
	<div class="container site-header__inner">
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="brand" aria-label="<?php echo esc_attr( sprintf( /* translators: %s: nom du site. */ __( '%s, accueil', 'logos-tabernacle' ), lt_opt( 'site', 'name' ) ) ); ?>">
			<span class="brand__badge"<?php echo 54 !== $lt_logo_width ? ' style="width:' . (int) $lt_logo_width . 'px;height:auto;aspect-ratio:54 / 46"' : ''; ?>>
				<?php echo lt_image( (int) lt_opt( 'site', 'logo' ), 'logo-logos.png', array( 'alt' => '', 'width' => '64', 'height' => '38', 'loading' => 'eager' ), 'medium' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
			</span>
			<?php if ( lt_opt( 'header', 'brand_line1' ) || lt_opt( 'header', 'brand_line2' ) ) : ?>
				<span class="brand__name">
					<?php echo esc_html( lt_opt( 'header', 'brand_line1' ) ); ?>
					<?php if ( lt_opt( 'header', 'brand_line2' ) ) : ?>
						<small><?php echo esc_html( lt_opt( 'header', 'brand_line2' ) ); ?></small>
					<?php endif; ?>
				</span>
			<?php endif; ?>
		</a>

		<nav id="main-nav" class="main-nav" aria-label="<?php esc_attr_e( 'Menu principal', 'logos-tabernacle' ); ?>">
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'primary',
					'container'      => false,
					'menu_class'     => 'main-nav__list',
					'depth'          => 3,
					'walker'         => new LT_Nav_Walker(),
					'fallback_cb'    => 'lt_nav_fallback',
				)
			);
			?>
			<?php if ( $lt_cta_label && $lt_cta_url ) : ?>
				<a href="<?php echo esc_url( $lt_cta_url ); ?>" class="btn btn--primary main-nav__cta"><?php echo esc_html( $lt_cta_label ); ?></a>
			<?php endif; ?>
		</nav>

		<div class="site-header__actions">
			<?php
			if ( lt_opt( 'header', 'show_live' ) ) {
				echo lt_live_button( lt_opt( 'header', 'live_label' ), 'sm' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			}
			?>
			<?php if ( $lt_cta_label && $lt_cta_url ) : ?>
				<a href="<?php echo esc_url( $lt_cta_url ); ?>" class="btn btn--primary btn--sm site-header__cta"><?php echo esc_html( $lt_cta_label ); ?></a>
			<?php endif; ?>
			<button type="button" class="burger" aria-expanded="false" aria-controls="main-nav" data-burger>
				<span class="visually-hidden" data-burger-label data-open="<?php esc_attr_e( 'Ouvrir le menu', 'logos-tabernacle' ); ?>" data-close="<?php esc_attr_e( 'Fermer le menu', 'logos-tabernacle' ); ?>"><?php esc_html_e( 'Ouvrir le menu', 'logos-tabernacle' ); ?></span>
				<span aria-hidden="true"></span>
				<span aria-hidden="true"></span>
				<span aria-hidden="true"></span>
			</button>
		</div>
	</div>
</header>

<main id="contenu">
