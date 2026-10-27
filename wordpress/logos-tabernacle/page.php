<?php
/**
 * Page standard (mentions légales, confidentialité, pages ajoutées…).
 *
 * @package Logos_Tabernacle
 */

defined( 'ABSPATH' ) || exit;

get_header();
the_post();
lt_the_page_header();
?>
<section class="section section--light">
	<div class="container container--narrow entry-content">
		<?php
		the_content();
		wp_link_pages();
		?>
	</div>
</section>
<?php
get_footer();
