<?php
/**
 * The template for displaying all pages
 *
 * @package wp_rig
 */

namespace WP_Rig\WP_Rig;

get_header();

wp_rig()->print_styles( 'wp-rig-content' );
wp_rig()->print_styles( 'wp-rig-page' );
wp_rig()->load_dark_styles();

?>
	<main id="primary" class="site-main">
		<?php get_template_part( 'template-parts/not-found/entry', 'header' ); ?>

		<div class="main-content">
			<?php
			get_template_part( 'template-parts/not-found/entry', 'content' );
			?>
		</div>
	</main><!-- #primary -->
<?php
get_footer();
