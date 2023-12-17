<?php 
    $settings = $this->get_settings_for_display();
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