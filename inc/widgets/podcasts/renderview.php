<?php

/**
 * Render View file for COO Podcasts.
 */
$settings = $this->get_settings_for_display();
$unique_id = $this->get_id();
$coo_number_of_posts = $this->get_settings('coo_elementor_podcast_list_post_number')['size'];
$coo_pagination_switch = $settings['coo_elementor_podcast_list_pagination'];

?>
<!-- Podcasts Area-->
<div class="coo-elementor-podcast-list-area coo-elementor-podcast-widget" data-widget-id="<?php echo esc_attr($unique_id); ?>">
    <?php
    if ('yes' === $settings['coo_elementor_podcast_search_switch']) :
    ?>
        <div class="coo-elementor-podcast-search">
			
            <form role="search" method="get" class="coo-elementor-podcast-search-form" action="" id="coo-elementor-podcast-search-form-<?php echo esc_attr($unique_id); ?>">
				
                <input type="search" class="coo-elementor-podcast-search-field" id="coo-elementor-podcast-search-field-<?php echo esc_attr($unique_id); ?>" placeholder="<?php echo esc_html($settings['coo_elementor_podcast_search_field_placeholder']); ?>" value="<?php echo get_search_query(); ?>" name="s" />
				
                <button type="submit" class="coo-elementor-podcast-search-submit"><?php echo esc_html($settings['coo_elementor_podcast_search_submit_label']); ?></button>
				
            </form>
			
			<div class="podcast-preloader" id="podcast-preloader-<?php echo esc_attr($unique_id); ?>" style="display:none">
				 <?php echo '<img src="' . COOELEMENTOR_ASSETS . '/img/podcast-preloader.gif" alt="podcast preloader">'; ?>
	<!--             <div class="coo-elementor-hourglass"></div> -->
			</div>
        </div>

        <div id="podcast-search-results-<?php echo esc_attr($unique_id); ?>"></div>
    <?php
    endif;
    ?>

	 <?php
    if ('yes' === $settings['coo_elementor_podcast_list_switch']) :
    ?>
    <div class="coo-elementor-podcast-list" id="coo-elementor-podcast-default-<?php echo esc_attr($unique_id); ?>">   
        <?php

        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
        if (is_front_page()) {
            $paged = (get_query_var('page')) ? get_query_var('page') : 1;
        }

        $args = array(
            'post_type'      => 'podcasts',
            'paged'          => $paged,
            'posts_per_page' => $coo_number_of_posts,
        );

        $query = new WP_Query($args);

        if ($query->have_posts()) :

            while ($query->have_posts()) : $query->the_post();


               include COOELEMENTOR_PATH . '/inc/widgets/podcasts/single-markup.php';

            endwhile; ?>

            <?php if ($coo_pagination_switch === 'yes') : ?>
                <div class="clearfix"></div>
                <div class="coo-elementor-podcast-list-pagi-container">
                    <?php
                    $abcbig = 999999999;
                    echo paginate_links(array(
                        'base'    => str_replace($abcbig, '%#%', esc_url(get_pagenum_link($abcbig))),
                        'format'  => '?paged=%#%',
                        'current' => max(1, $paged),
                        'total'   => $query->max_num_pages,
						'end_size' => 4,
						'mid_size' => 5,
                    ));
                    ?>
                </div>
            <?php endif; ?>

        <?php else : ?>
            <div class="clearfix"></div>
            <h3 class="post-title"><?php esc_html_e('No Podacsts Found', 'cooalliance-ele'); ?></h3>
        <?php
            wp_reset_postdata();
        endif; ?>
    </div><!-- /podcast list -->
	<?php endif; ?>
	
</div><!--/ Podcasts area -->