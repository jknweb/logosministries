<?php
/**
 * Formulaire de recherche.
 *
 * @package Logos_Tabernacle
 */

defined( 'ABSPATH' ) || exit;
?>
<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label class="field search-form__field">
		<span class="visually-hidden"><?php esc_html_e( 'Rechercher', 'logos-tabernacle' ); ?></span>
		<input type="search" name="s" value="<?php echo esc_attr( get_search_query() ); ?>" placeholder="<?php esc_attr_e( 'Rechercher…', 'logos-tabernacle' ); ?>">
	</label>
	<button type="submit" class="btn btn--primary"><?php lt_the_icon( 'search', 18 ); ?><?php esc_html_e( 'Rechercher', 'logos-tabernacle' ); ?></button>
</form>
