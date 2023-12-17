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


	wp_enqueue_script( 'ajax-podcast-search', COOELEMENTOR_ASSETS . '/js/ajax-podcast-search.js', array( 'jquery' ), null, true );
    
    // Localize the script with new data
    wp_localize_script( 'ajax-podcast-search', 'ajax_podcast_params', array(
        'ajax_url' => admin_url( 'admin-ajax.php' )
    ));

}
add_action( 'wp_enqueue_scripts', 'coo_alliance_ele_scripts' );


function coo_ajax_search_podcasts() {
    $query = sanitize_text_field( $_POST['query'] );

    // Perform your query to search podcasts. This is an example:
    $args = array(
        'post_type' => 'podcasts',
        's'         => $query
    );
    $query = new WP_Query( $args );

    // Loop through the posts and output the results
    if ( $query->have_posts() ) {
        while ( $query->have_posts() ) {
            $query->the_post();
			
			$coo_podcast_player_switch = $settings['coo_elementor_podcast_list_player_switch'];
			$coo_read_more_switch = $settings['coo_elementor_podcast_list_read_more_switch'];
			$coo_grid_read_more_text = $settings['coo_elementor_podcast_list_read_more_text'];
			$coo_apple_subs_switch = $settings['coo_elementor_podcast_list_apple_subs'];
			
            ?>
<div class="coo-elementor-podcast-list-item">
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

        <?php if (has_post_thumbnail()) : ?>
            <div class="coo-elementor-podcast-list-thumb">
                <figure>
                    <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                        <?php the_post_thumbnail('coo-podcast-thumb'); ?>
                    </a>
                </figure>
            </div>
        <?php else : ?>
            <div class="coo-elementor-podcast-list-thumb">
                <figure>
                    <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                        <?php echo '<img src="' . COOELEMENTOR_ASSETS . '/img/sample-img.jpg" alt="' . the_title_attribute(['echo' => false]) . '">'; ?>
                    </a>
                </figure>
            </div>
        <?php endif; ?>

        <div class="coo-elementor-podcast-list-content">
            <h3 class="coo-elementor-podcast-list-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>

            <!-- podcasts player -->
            <?php
            include_once(ABSPATH . 'wp-admin/includes/plugin.php');
            if ($coo_podcast_player_switch === 'yes' && (is_plugin_active('powerpress/powerpress.php') || is_plugin_active('powerpress 2/powerpress.php'))) : ?>
                <div class="coo-podcast-player">
                    <?php echo do_shortcode('[powerpress]'); ?>
                </div>
            <?php endif; ?>

            <!-- /podcasts player -->

            <!-- podcasts excerpt -->
            <div class="coo-elementor-podcast-list-excerpt">
                <p><?php
                    echo get_the_excerpt() ?></p>
            </div>
            <!-- /excerpt -->

            <?php if ($coo_read_more_switch === 'yes') : ?>
                <div class="coo-elementor-podcast-list-more"><a href="<?php the_permalink(); ?>"><?php echo esc_html($coo_grid_read_more_text); ?></a></div>
            <?php endif; ?><!-- /read more button -->

            <?php if ($coo_apple_subs_switch === 'yes') : ?>
                <div class="coo-elementor-podcast-subs-btn">
                    <h4>Subscribe Now:</h4>
                    <a href="https://itunes.apple.com/us/podcast/second-in-command-the-chief-behind-the-chief/id1368800817" target="_blank"><?php echo '<img src="' . COOELEMENTOR_ASSETS . '/img/apple-podcasts-subscription.png" alt="Apple Podcasts">'; ?></a>
                </div><!-- /apple subs area -->
            <?php endif; ?>

        </div> <!-- content -->

    </article>

</div> <!-- end coo-elementor-podcast-list-item -->

<?php
        }
    } else {
        echo 'No podcasts found.';
    }

    wp_reset_postdata();
    die();
}
add_action( 'wp_ajax_coo_ajax_search_podcasts', 'coo_ajax_search_podcasts' );
add_action( 'wp_ajax_nopriv_coo_ajax_search_podcasts', 'coo_ajax_search_podcasts' );



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