<?php
/**
 * Template part for displaying a post's comment and edit links
 *
 * @package wp_rig
 */

namespace WP_Rig\WP_Rig;

?>

<footer class="article-footer">
	<p class="tags"><?php the_tags( '<span class="tags-title">' . esc_html__( 'Tags:', 'wp-rig' ) . '</span> ', ', ', '' ); ?></p>
</footer> <!-- end article footer -->
<div class="post-navigation-container">
	<?php
	$prev_post = get_previous_post();
	$next_post = get_next_post();
	?>
	<?php
	if ( $prev_post ) {
		previous_post_link( '<div class="large-6 medium-6 columns"><div class="previous-post">' . get_the_post_thumbnail( $prev_post->ID ) . '<span class="paginate-title">&laquo;&laquo; %link</span></div></div>', '%title' );
	}
	if ( $next_post ) {
		next_post_link( '<div class="large-6 medium-6 columns"><div class="next-post">' . get_the_post_thumbnail( $next_post->ID ) . '<span class="paginate-title">%link &raquo;&raquo;</span></div></div>', '%title' );
	}
	?>
</div>
<?php
$show_bio = esc_attr( get_theme_mod( 'fotographia-author-bio' ) );
if ( '1' === $show_bio ) {
	get_template_part( 'template-parts/single/entry', 'bio' );
}
?>
<?php comments_template(); ?>
