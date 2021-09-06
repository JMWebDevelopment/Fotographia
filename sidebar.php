<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package wp_rig
 */

namespace WP_Rig\WP_Rig;

if ( ! wp_rig()->is_primary_sidebar_active() ) {
	return;
}

wp_rig()->print_styles( 'wp-rig-sidebar' );

?>
<aside id="secondary" class="primary-sidebar widget-area">
	<h2 class="screen-reader-text"><?php esc_attr_e( 'Asides', 'wp-rig' ); ?></h2>
	<?php
		if ( is_author() ) {
			?>
			<aside id="author-bio1" class="widget author-bio clearfix">
				<?php the_post(); ?>
					<h4 class="widgettitle"><?php echo esc_html__( 'About ', 'wp-rig' ) . get_the_author_meta( 'display_name' ); ?></h4>
					<div class="mugshot"><?php echo get_avatar( esc_url( get_the_author_meta( 'email' ) ), $size = 96 ); ?></div>
					<p class="bio"><?php echo get_the_author_meta( 'description' ); ?></p>
				<?php rewind_posts(); ?>
			</aside>
		<?php
		}
	?>
	<?php wp_rig()->display_primary_sidebar(); ?>
</aside><!-- #secondary -->
