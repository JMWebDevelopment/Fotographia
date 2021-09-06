<?php
/**
 * Renders the top post for the front page.
 *
 * @package wp_rig
 */

namespace WP_Rig\WP_Rig;

use WP_Query;

global $do_not_duplicate;

?>
<div class="row top-posts">
	<?php
	$top_cat = esc_attr( get_theme_mod( 'fotographia-home-slider-cat' ) );
	if ( $top_cat ) {
		$top_cat = esc_attr( get_theme_mod( 'fotographia-home-slider-cat' ) );
	} else {
		$top_cat = 'none';
	}
	$slide_args = [
		'cat'                 => $top_cat,
		'posts_per_page'      => 5,
		'ignore_sticky_posts' => true,
		'orderby'             => 'date',
		'order'               => 'DESC',
	];
	$slide      = new WP_Query( $slide_args );
	$num_posts  = $slide->found_posts;
	$count      = 1;
	if ( $slide->have_posts() ) :
		while ( $slide->have_posts() ) :
			$slide->the_post();
			$do_not_duplicate[] = $post->ID;
			if ( 1 === $count ) {
				echo '<div class="top-posts-left">';
			}
			if ( 2 === $count ) {
				echo '<div class="top-posts-right">';
			}
			get_template_part( 'template-parts/front-page/home', 'post' );
			if ( 1 === $count ) {
				echo '</div>';
			}
			if ( 5 === $count || $num_posts === $count ) {
				echo '</div>';
			}
			$count++;
		endwhile;
	endif;
	?>
</div>
