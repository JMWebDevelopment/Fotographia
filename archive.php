<?php
/**
 * The template for displaying archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package wp_rig
 */

namespace WP_Rig\WP_Rig;

get_header();

wp_rig()->print_styles( 'wp-rig-content' );
wp_rig()->print_styles( 'wp-rig-archive' );
wp_rig()->load_dark_styles();

?>
<main id="primary" class="site-main">
	<?php
	if ( have_posts() ) :
		the_post();
		get_template_part( 'template-parts/archive/archive', 'header' );
	endif;
	rewind_posts();
	?>
	<div id="inner-content" class="row archive-posts-section">

		<div class="archive-posts">
			<?php
			if ( have_posts() ) :
				while ( have_posts() ) :
					the_post();
					echo '<div class="archive-post-container">';
					get_template_part( 'template-parts/archive/archive', 'post' );
					echo '</div>';
				endwhile;
				the_posts_pagination();
			endif;
			?>
		</div>

		<?php get_sidebar(); ?>

	</div>
</main><!-- #primary -->
<?php
get_footer();
