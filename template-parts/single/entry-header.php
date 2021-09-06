<?php
/**
 * Template part for displaying a post's comment and edit links
 *
 * @package wp_rig
 */

namespace WP_Rig\WP_Rig;

if ( has_post_thumbnail() ) {
	?>
	<div class="featured-photo">
		<?php the_post_thumbnail( 'fotographia-single' ); ?>
		<span class="article-header">
			<h1 class="entry-title"><?php the_title(); ?></h1>
			<p class="entry-meta"><?php esc_html_e( 'Written By:', 'wp-rig' ); ?> <?php the_author_posts_link(); ?> &bull; <?php the_date( get_option( 'date_format' ) ); ?></p>
		</span>
	</div>
	<?php
} else {
	?>
	<div class="single-header">
		<h1 class="single-title"><?php the_title(); ?></h1>
		<p class="single-meta"><?php esc_html_e( 'Written By: ', 'wp-rig' ); ?> <?php the_author_posts_link(); ?> &bull; <?php the_date( get_option( 'date_format' ) ); ?></p>
	</div>
	<?php
}
