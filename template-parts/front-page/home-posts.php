<?php
/**
 * Renders the top post for the front page.
 *
 * @package wp_rig
 */

namespace WP_Rig\WP_Rig;

use WP_Query;

global $do_not_duplicate;

$number_posts = esc_attr( get_theme_mod( 'fotographia-home-num' ) );
if ( $number_posts ) {
	$number_posts = esc_attr( get_theme_mod( 'fotographia-home-num' ) );
} else {
	$number_posts = 11;
}
$args  = [
	'showposts'           => $number_posts,
	'ignore_sticky_posts' => true,
	'post__not_in'        => $do_not_duplicate,
	'orderby'             => 'date',
	'order'               => 'DESC',
];
$home  = new WP_Query( $args );
$count = 1;
if ( $home->have_posts() ) :
	while ( $home->have_posts() ) :
		$home->the_post();
		echo '<div class="home-post-container">';
		get_template_part( 'template-parts/front-page/home', 'post' );
		echo '</div>';
		wp_reset_postdata();
	endwhile;
endif;
