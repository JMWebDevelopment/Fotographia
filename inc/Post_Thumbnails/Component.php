<?php
/**
 * WP_Rig\WP_Rig\Post_Thumbnails\Component class
 *
 * @package wp_rig
 */

namespace WP_Rig\WP_Rig\Post_Thumbnails;

use WP_Rig\WP_Rig\Component_Interface;
use function WP_Rig\WP_Rig\wp_rig;
use function add_action;
use function add_theme_support;
use function add_image_size;

/**
 * Class for managing post thumbnail support.
 *
 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
 */
class Component implements Component_Interface {

	/**
	 * Gets the unique identifier for the theme component.
	 *
	 * @return string Component slug.
	 */
	public function get_slug() : string {
		return 'post_thumbnails';
	}

	/**
	 * Adds the action and filter hooks to integrate with WordPress.
	 */
	public function initialize() {
		add_action( 'after_setup_theme', array( $this, 'action_add_post_thumbnail_support' ) );
		add_action( 'after_setup_theme', array( $this, 'action_add_image_sizes' ) );
		add_action( 'wp_enqueue_scripts', [ $this, 'action_enqueue_fex_video_script' ] );
	}

	/**
	 * Adds support for post thumbnails.
	 */
	public function action_add_post_thumbnail_support() {
		add_theme_support( 'post-thumbnails' );
	}

	/**
	 * Adds custom image sizes.
	 */
	public function action_add_image_sizes() {
		add_image_size( 'fotographia-home-top', 4000, 3000, true );
		add_image_size( 'fotographia-home', 2000, 1500, true );
		add_image_size( 'fotographia-archive', 2000, 1500, true );
		add_image_size( 'fotographia-single', 5000, 3333, true );
	}

	/**
	 * Loads the script for adding the flex-video class to videos.
	 *
	 * @since 2.0
	 */
	public function action_enqueue_fex_video_script() {
		wp_enqueue_script(
			'wp-rig-flex-video',
			get_theme_file_uri( '/assets/js/flex-video.min.js' ),
			[ 'jquery' ],
			wp_rig()->get_asset_version( get_theme_file_path( '/assets/js/flex-video.min.js' ) ),
			false
		);
		wp_script_add_data( 'wp-rig-flex-video', 'async', true );
		wp_script_add_data( 'wp-rig-flex-video', 'precache', true );

	}
}
