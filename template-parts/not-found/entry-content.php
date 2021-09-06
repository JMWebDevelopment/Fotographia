<?php
/**
 * Template part for displaying a post's comment and edit links
 *
 * @package wp_rig
 */

namespace WP_Rig\WP_Rig;

?>

<section class="entry-content" itemprop="articleBody">
	<div class="use-search-bar">
		<p><?php esc_html_e( 'Please use the search bar below to search for the content you\'re looking for.', 'wp-rig' ); ?></p>
		<?php get_search_form(); ?>
	</div>
</section> <!-- end article section -->
