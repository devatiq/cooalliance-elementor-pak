<?php
/**
 * Plugin Name: COOAlliance Elementor Pack
 * Description: Custom Elementor widgets for COOAlliance.
 * Plugin URI: https://supreox.com/
 * Author: Atiqur Rahman
 * Author URI: https://devatiq.com/
 * Version: 1.1.0
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
    wp_enqueue_style( 'abcbiz-elementor-pro-style', COOELEMENTOR_ASSETS . "/css/style.css", array(), '1.1.0' );
wp_enqueue_style( 'abcbiz-elementor-pro-responsive', COOELEMENTOR_ASSETS . "/css/responsive.css", array(), '1.0.0' );



	wp_enqueue_script( 'ajax-podcast-search', COOELEMENTOR_ASSETS . '/js/ajax-podcast-search.js', array( 'jquery' ), 1.3, true );
    
    // Localize the script with new data
    wp_localize_script( 'ajax-podcast-search', 'ajax_podcast_params', array(
        'ajax_url' => admin_url( 'admin-ajax.php' )
    ));

}
add_action( 'wp_enqueue_scripts', 'coo_alliance_ele_scripts' );

function coo_ajax_search_podcasts() {
    // Check for the 'query' and 'paged' parameters
    $search_query = isset($_POST['query']) ? sanitize_text_field($_POST['query']) : '';
    $paged = isset($_POST['paged']) ? intval($_POST['paged']) : 1;
	$widgetId = isset($_POST['widgetId']) ? sanitize_text_field($_POST['widgetId']) : '';

    // Construct the query arguments
    $args = array(
        'post_type' => 'podcasts',
        's' => $search_query,
        'posts_per_page' => 10,
        'paged' => $paged
    );

    $query = new WP_Query($args);

    if ($query->have_posts()) {
        echo '<div class="coo-elementor-podcast-search-result">';
        echo '<h2 class="coo-elementor-pdocast-search-heading">Search Results for "' . esc_html($search_query) . '" Total ' . $query->found_posts . ' Results</h2>';

        while ($query->have_posts()) {
            $query->the_post();
           include COOELEMENTOR_PATH . '/inc/widgets/podcasts/search-markup.php';
        }

        // Pagination
        echo '<div id="coo-elementor-podcast-'.$widgetId.'" class="coo-elementor-podcast-list-pagi-container coo-elementor-podcast-pagination">';
        echo paginate_links(array(
            'total' => $query->max_num_pages,
            'current' => $paged,
            'format' => '?paged=%#%',
            'add_args' => array('query' => $search_query)
        ));
        echo '</div>'; // end coo-elementor-podcast-pagination

        wp_reset_postdata();
    } else {
        echo 'No podcasts found.';
    }

    die();
}

add_action('wp_ajax_coo_ajax_search_podcasts', 'coo_ajax_search_podcasts');
add_action('wp_ajax_nopriv_coo_ajax_search_podcasts', 'coo_ajax_search_podcasts');


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
			'show_in_nav_menus' => true,
			'exclude_from_search' => false,
			'menu_icon' => 'dashicons-media-audio',
			'hierarchical' => false,
            'rewrite' => array( 'with_front' => true ),
			'supports' => array('title', 'editor', 'thumbnail', 'author', 'revisions'),
		)
	);
//flush_rewrite_rules();
}
add_action( 'init', 'register_podcastss_post_type' );

function cooalliance_admin_css() {
echo '<style>
    .dashicons-media-audio:before {color: #37c1ee !important;}
    </style>';
}
add_action('admin_head', 'cooalliance_admin_css');

//Podcasts Custom Meta
function coo_podcast_captivate_meta_box() {
    add_meta_box(
        'podcast_custom_meta_box',
        'Captivate Player Link',
        'render_coo_podcast_captivate_meta_data',
        'podcasts',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'coo_podcast_captivate_meta_box');

function render_coo_podcast_captivate_meta_data($post) {
    $podcast_player_link = get_post_meta($post->ID, '_podcast_player_link', true);
    ?>
    <label for="podcast_player_link">Enter Player URL:</label>
    <input type="text" id="podcast_player_link" name="podcast_player_link" value="<?php echo esc_attr($podcast_player_link); ?>" style="width: 100%;">
    <?php
}

function save_coo_podcast_captivate_meta_data($post_id) {
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if ($post_id && isset($_POST['podcast_player_link'])) {
        update_post_meta($post_id, '_podcast_player_link', sanitize_text_field($_POST['podcast_player_link']));
    }
}
add_action('save_post', 'save_coo_podcast_captivate_meta_data');
