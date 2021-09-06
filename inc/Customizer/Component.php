<?php
/**
 * WP_Rig\WP_Rig\Customizer\Component class
 *
 * @package wp_rig
 */

namespace WP_Rig\WP_Rig\Customizer;

use WP_Rig\WP_Rig\Component_Interface;
use function WP_Rig\WP_Rig\wp_rig;
use WP_Customize_Manager;
use function add_action;
use function bloginfo;
use function wp_enqueue_script;
use function get_theme_file_uri;
use function get_theme_file_path;

/**
 * Class for managing Customizer integration.
 */
class Component implements Component_Interface {

	/**
	 * Gets the unique identifier for the theme component.
	 *
	 * @return string Component slug.
	 */
	public function get_slug() : string {
		return 'customizer';
	}

	/**
	 * Adds the action and filter hooks to integrate with WordPress.
	 */
	public function initialize() {
		add_action( 'customize_register', array( $this, 'action_customize_register' ) );
		add_action( 'customize_preview_init', array( $this, 'action_enqueue_customize_preview_js' ) );
	}

	/**
	 * Adds postMessage support for site title and description, plus a custom Theme Options section.
	 *
	 * @param WP_Customize_Manager $wp_customize Customizer manager instance.
	 */
	public function action_customize_register( WP_Customize_Manager $wp_customize ) {
		/**
		 * Theme options.
		 */
		$wp_customize->add_section(
			'general',
			[
				'title'       => esc_html__( 'Fotographia Settings', 'wp-rig' ),
				'description' => esc_html__( 'These are the Fotographia theme options.', 'wp-rig' ),
				'priority'    => 35, // Before Additional CSS.
			]
		);

		// Get the categories for the home page options.
		$schemes[ 'light' ] = esc_html__( 'Light', 'wp-rig' );
		$schemes[ 'dark' ]  = esc_html__( 'Dark', 'wp-rig' );

		// Home Slider Category.
		$wp_customize->add_setting(
			'fotographia-color-scheme',
			[
				'default'           => 'None',
				'sanitize_callback' => [ $this, 'sanitize_select' ],
			]
		);

		$wp_customize->add_control(
			'fotographia-color-scheme',
			[
				'label'     => esc_html__( 'Color Scheme', 'wp-rig' ),
				'section'   => 'general',
				'type'      => 'select',
				'choices'   => $schemes,
			]
		);

		//* Get the categories for the home page options
		$cats               = get_categories();
		$cat_args['none'] = esc_html__( 'None', 'wp-rig' );
		foreach ( $cats as $cat ) {
			$cat_args[ $cat->term_id ] = $cat->name;
		}

		//* Home Slider Category
		$wp_customize->add_setting(
			'fotographia-home-slider-cat',
			[
				'default'           => 'None',
				'sanitize_callback' => [ $this, 'sanitize_category' ],
			]
		);

		$wp_customize->add_control(
			'fotographia-home-slider-cat',
			[
				'label'     => esc_html__( 'Home Featured Category', 'wp-rig' ),
				'section'   => 'general',
				'type'      => 'select',
				'choices'   => $cat_args,
			]
		);

		//* Number of Home Slider Posts
		$wp_customize->add_setting(
			'fotographia-home-num',
			[
				'default'           => '10',
				'sanitize_callback' => [ $this, 'sanitize_num' ],
			]
		);

		$wp_customize->add_control(
			'fotographia-home-num',
			[
				'label'     => esc_html__( 'Number of Stories on the Homepage.', 'wp-rig' ),
				'section'   => 'general',
				'type'      => 'text',
			]
		);

		//* Author Position
		$wp_customize->add_setting(
			'fotographia-author-bio',
			[
				'default'           => '',
				'sanitize_callback' => [ $this, 'sanitize_checkbox' ],
			]
		);

		$wp_customize->add_control(
			'fotographia-author-bio',
			[
				'label'     => esc_html__( 'Display the Author\'s Bio', 'wp-rig' ),
				'section'   => 'general',
				'type'      => 'checkbox',
			]
		);

		//* Facebook
		$wp_customize->add_setting(
			'fotographia-facebook',
			[
				'default'           => '',
				'sanitize_callback' => [ $this, 'sanitize_link' ],
			]
		);

		$wp_customize->add_control(
			'fotographia-facebook',
			[
				'label'     => esc_html__( 'Facebook Link', 'wp-rig' ),
				'section'   => 'general',
				'type'      => 'text',
			]
		);

		//* Twitter
		$wp_customize->add_setting(
			'fotographia-twitter',
			[
				'default'           => '',
				'sanitize_callback' => [ $this, 'sanitize_link' ],
			]
		);

		$wp_customize->add_control(
			'fotographia-twitter',
			[
				'label'     => esc_html__( 'Twitter Link', 'wp-rig' ),
				'section'   => 'general',
				'type'      => 'text',
			]
		);

		//* YouTube
		$wp_customize->add_setting(
			'fotographia-youtube',
			[
				'default'           => '',
				'sanitize_callback' => [ $this, 'sanitize_link' ],
			]
		);

		$wp_customize->add_control(
			'fotographia-youtube',
			[
				'label'     => esc_html__( 'YouTube Link', 'wp-rig' ),
				'section'   => 'general',
				'type'      => 'text',
			]
		);

		//* Tumblr
		$wp_customize->add_setting(
			'fotographia-tumblr',
			[
				'default'           => '',
				'sanitize_callback' => [ $this, 'sanitize_link' ],
			]
		);

		$wp_customize->add_control(
			'fotographia-tumblr',
			[
				'label'     => esc_html__( 'Tumblr Link', 'wp-rig' ),
				'section'   => 'general',
				'type'      => 'text',
			]
		);

		//* Instagram
		$wp_customize->add_setting(
			'fotographia-instagram',
			[
				'default'           => '',
				'sanitize_callback' => [ $this, 'sanitize_link' ],
			]
		);

		$wp_customize->add_control(
			'fotographia-instagram',
			[
				'label'     => esc_html__( 'Instagram Link', 'wp-rig' ),
				'section'   => 'general',
				'type'      => 'text',
			]
		);

		//* RSS Feed
		$wp_customize->add_setting(
			'fotographia-rss-feed',
			[
				'default'           => '',
				'sanitize_callback' => [ $this, 'sanitize_link' ],
			]
		);

		$wp_customize->add_control(
			'fotographia-rss-feed',
			[
				'label'     => esc_html__( 'RSS Feed Link', 'wp-rig' ),
				'section'   => 'general',
				'type'      => 'text',
			]
		);

	}

	/**
	 * Enqueues JavaScript to make Customizer preview reload changes asynchronously.
	 */
	public function action_enqueue_customize_preview_js() {
		wp_enqueue_script(
			'wp-rig-customizer',
			get_theme_file_uri( '/assets/js/customizer.min.js' ),
			array( 'customize-preview' ),
			wp_rig()->get_asset_version( get_theme_file_path( '/assets/js/customizer.min.js' ) ),
			true
		);
	}

	// Sanitize Links.
	public function sanitize_link( $input ) {
		return esc_url_raw( $input );
	}

	// Sanitize Layout Option.
	public function sanitize_select( $input, $setting ) {
		$input   = sanitize_key( $input );
		$choices = $setting->manager->get_control( $setting->id )->choices;
		return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
	}

	// Sanitize Checkboxes.
	public function sanitize_checkbox( $input ) {
		return ( ( isset( $input ) && true === $input ) ? 1 : 0 );
	}

	// Sanitize Category Options.
	public function sanitize_category( $input, $setting ) {
		$input   = sanitize_key( $input );
		$choices = $setting->manager->get_control( $setting->id )->choices;
		return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
	}

	// Sanitize Numbers.
	public function sanitize_num( $input, $setting ) {
		$input = absint( $input );
		return ( $input ? $input : $setting->default );
	}

	// Sanitize Text.
	public function sanitize_text( $input ) {
		return wp_filter_nohtml_kses( $input );
	}
}
