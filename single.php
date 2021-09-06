<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package wp_rig
 */

namespace WP_Rig\WP_Rig;

get_header();

wp_rig()->print_styles( 'wp-rig-content' );
wp_rig()->print_styles( 'wp-rig-single' );
wp_rig()->load_dark_styles();

?>
	<main id="primary" class="site-main">
		<?php

		while ( have_posts() ) {
			the_post();

			get_template_part( 'template-parts/single/entry', 'header' );
			?>

			<div class="main-content">
				<?php
				get_template_part( 'template-parts/single/entry', 'content' );

				get_template_part( 'template-parts/single/entry', 'footer' );
				?>
			</div>
			<?php
		}
		?>
	</main><!-- #primary -->
<?php
get_footer();
