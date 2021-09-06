<?php
/**
 * Template part for displaying a post's comment and edit links
 *
 * @package wp_rig
 */

namespace WP_Rig\WP_Rig;

$post_cat = get_the_category();

?>

<div id="archive-post-<?php the_id(); ?>" <?php post_class( 'archive-post story' ); ?>>
	<a href="<?php the_permalink(); ?>">
		<div class="archive-post-front">
			<?php the_post_thumbnail( 'fotographia-home' ); ?>
		</div>
		<div class="archive-post-back">
			<div class="photo-wrap">
				<?php wp_rig()->story_slideshow( get_the_ID() ); ?>
			</div>
			<span class="title-area">
				<h5 class="category"><?php echo esc_html( $post_cat[0]->name ); ?></h5>
				<h3 class="title"><?php the_title(); ?></h3>
			</span>
		</div>
	</a>
</div>
