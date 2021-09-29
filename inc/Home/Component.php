<?php
/**
 * WP_Rig\WP_Rig\Home\Component class
 *
 * @package wp_rig
 */

namespace WP_Rig\WP_Rig\Home;

use WP_Rig\WP_Rig\Component_Interface;
use WP_Rig\WP_Rig\Templating_Component_Interface;
use function WP_Rig\WP_Rig\wp_rig;
use WP_Post;
use function add_action;
use function add_filter;
use function register_nav_menus;
use function esc_html__;
use function has_nav_menu;
use function wp_nav_menu;

/**
 * Class for managing navigation menus.
 *
 * Exposes template tags:
 * * `wp_rig()->is_primary_nav_menu_active()`
 * * `wp_rig()->display_primary_nav_menu( array $args = array() )`
 */
class Component implements Component_Interface, Templating_Component_Interface {

	/**
	 * Gets the unique identifier for the theme component.
	 *
	 * @return string Component slug.
	 */
	public function get_slug() : string {
		return 'home';
	}

	/**
	 * Adds the action and filter hooks to integrate with WordPress.
	 */
	public function initialize() {
		add_action( 'wp_enqueue_scripts', [ $this, 'action_enqueue_scripts' ] );
	}

	/**
	 * Gets template tags to expose as methods on the Template_Tags class instance, accessible through `wp_rig()`.
	 *
	 * @return array Associative array of $method_name => $callback_info pairs. Each $callback_info must either be
	 *               a callable or an array with key 'callable'. This approach is used to reserve the possibility of
	 *               adding support for further arguments in the future.
	 */
	public function template_tags() : array {
		return [
			'story_slideshow' => [ $this, 'story_slideshow' ],
		];
	}

	public function action_enqueue_scripts() {

		if ( is_front_page() || is_archive() ) {
			wp_enqueue_script(
				'wp-rig-cycle',
				get_theme_file_uri( '/assets/js/cycle.min.js' ),
				array(),
				wp_rig()->get_asset_version( get_theme_file_path( '/assets/js/cycle.min.js' ) ),
				false
			);
			wp_script_add_data( 'wp-rig-cycle', 'async', true );
			wp_script_add_data( 'wp-rig-cycle', 'precache', true );

			wp_enqueue_script(
				'wp-rig-show-hide',
				get_theme_file_uri( '/assets/js/show-hide.min.js' ),
				array(),
				wp_rig()->get_asset_version( get_theme_file_path( '/assets/js/show-hide.min.js' ) ),
				false
			);
			wp_script_add_data( 'wp-rig-show-hide', 'async', true );
			wp_script_add_data( 'wp-rig-show-hide', 'precache', true );
		}
	}

	public function story_slideshow() {
		$media = get_attached_media( 'image', get_the_ID() );
		foreach ( $media as $image ) {
			echo '<img src="' . esc_url( $image->guid ) . '" alt="' . esc_attr( get_post_meta( $image->ID, '_wp_attachment_image_alt', true ) ) . '" />';
		}
	}

}
