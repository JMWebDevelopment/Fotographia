<?php
/**
 * Renders a post for the front page.
 *
 * @package wp_rig
 */

namespace WP_Rig\WP_Rig;

use WP_Query;

$post_cat = get_the_category();
?>

<div id="home-post-<?php the_id(); ?>" <?php post_class( 'home-post' ); ?>>
	<a href="<?php the_permalink(); ?>">
		<div class="top-post-front">
			<?php the_post_thumbnail( 'fotographia-home-top' ); ?>
		</div>
		<div class="top-post-back">
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
