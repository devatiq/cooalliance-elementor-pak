<?php
/**
 * Plugin Name: COOAlliance Elementor Pack
 * Description: Custom Elementor widgets for COOAlliance.
 * Plugin URI: https://supreox.com/
 * Author: SupreoX Limited
 * Author URI: https://supreox.com/
 * Version: 1.0.0
 * Text Domain: cooalliance-ele
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

/**
 * Enqueue scripts and styles.
 */
function coo_alliance_ele_scripts() {   
	// enqueue style
    wp_enqueue_style( 'abcbiz-elementor-pro-style',  COOELEMENTOR_ASSETS . "/css/style.css");
    wp_enqueue_style( 'abcbiz-elementor-pro-responsive',  COOELEMENTOR_ASSETS . "/css/responsive.css");

}
add_action( 'wp_enqueue_scripts', 'coo_alliance_ele_scripts' );


function coo_alliance_plugin_general_init() {

    if (!class_exists('COOAllianceElePack', false)) {
        //load Main plugin class
        require_once 'ele-main.php';		
        /**
         * initiate the plugin class
         */
	    \COOELEMENTOR\COOAllianceElePack::instance();

    }	
}
add_action( 'plugins_loaded', 'coo_alliance_plugin_general_init' );


// Custom Category
function coo_alliance_add_ele_widget_categories( $elements_manager ) {

	$elements_manager->add_category(
		'coo-alliance-category',
		[
			'title' => esc_html__( 'COO Alliance Elements', 'cooalliance-ele' ),
			'icon' => 'fa fa-plug',
		]
	);

}
add_action( 'elementor/elements/categories_registered', 'coo_alliance_add_ele_widget_categories' );

//content excerpt
function coo_custom_excerpt_length($excerpt) {
    $char_limit = 270;
    $excerpt = strip_tags(strip_shortcodes($excerpt));

    if (strlen($excerpt) <= $char_limit) {
        return $excerpt;
    }

    $trimmed_text = substr($excerpt, 0, $char_limit);
    $trimmed_text = substr($trimmed_text, 0, strrpos($trimmed_text, ' '));
    $trimmed_text .= '...';
    return $trimmed_text;
}
add_filter('get_the_excerpt', 'coo_custom_excerpt_length', 999);


// Register podcasts post type
function register_podcastss_post_type() {
	register_post_type( 'podcasts',
		array(
			'labels' => array(
				'name' => __( 'Podcasts','cooalliance' ),
				'singular_name' =>  __( 'Podcast','cooalliance' ),
				'add_new' =>  __( 'Add New','cooalliance' ),
				'add_new_item' =>  __( 'Add New Podcast','cooalliance' ),
				'edit' =>  __( 'Edit','cooalliance' ),
				'edit_item' =>  __( 'Edit Podcasts','cooalliance' ),
				'new_item' =>  __( 'New Podcasts','cooalliance' ),
				'view' =>  __( 'View podcasts','cooalliance' ),
				'view_item' =>  __( 'View Podcasts','cooalliance' ),
				'search_items' =>  __( 'Search Podcasts','cooalliance' ),
				'not_found' =>  __( 'No podcasts found','cooalliance' ),
				'not_found_in_trash' =>  __( 'No podcasts found in trash','cooalliance' ),
				'parent' =>  __( 'Parent Podcasts','cooalliance' ),
			),
			'public' => true,
			'show_ui' => true,
			'has_archive' => true,
			'publicly_queryable' => true,
			'show_in_nav_menus' => false,
			'exclude_from_search' => false,
			'menu_icon' => 'dashicons-media-audio',
			'hierarchical' => false,
            'rewrite' => array( 'with_front' => false ),
			'supports' => array('title', 'editor', 'thumbnail', 'author', 'revisions'),
		)
	);
//flush_rewrite_rules();
}
add_action( 'init', 'register_podcastss_post_type' );