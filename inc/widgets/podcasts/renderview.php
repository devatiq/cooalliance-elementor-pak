<?php
/**
 * Render View file for COO Podcasts.
 */
$settings = $this->get_settings_for_display();
$coo_podcast_player_switch = $settings['coo_elementor_podcast_list_player_switch'];
$coo_number_of_posts = $this->get_settings('coo_elementor_podcast_list_post_number')['size'];
$coo_pagination_switch = $settings['coo_elementor_podcast_list_pagination'];
$coo_read_more_switch = $settings['coo_elementor_podcast_list_read_more_switch'];
$coo_grid_read_more_text = $settings['coo_elementor_podcast_list_read_more_text'];
$coo_apple_subs_switch = $settings['coo_elementor_podcast_list_apple_subs'];
?>
<!-- Podcasts Area-->
<div class="coo-elementor-podcast-list-area">
    <div class="coo-elementor-podcast-list">

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

            while ($query->have_posts()) : $query->the_post(); ?>

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
                        <?php else:?>
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
                            include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
                            if ( $coo_podcast_player_switch === 'yes' && (is_plugin_active('powerpress/powerpress.php') || is_plugin_active('powerpress 2/powerpress.php')) ) : ?>
                           <div class="coo-podcast-player">    
                           <?php echo do_shortcode('[powerpress]');?>
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

            <?php endwhile; ?>

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

    </div>
</div><!--/ Podcasts area -->
