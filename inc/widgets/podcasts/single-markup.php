<?php

$coo_podcast_player_switch = $settings['coo_elementor_podcast_list_player_switch'];
$coo_apple_subs_switch = $settings['coo_elementor_podcast_list_apple_subs'];
$post_id = get_the_ID();
$podcast_player_link = get_post_meta($post_id, '_podcast_player_link', true);

if ( ! empty( $settings['coo_elementor_podcast_list_subscribe_url']['url'] ) ) {
    $this->add_link_attributes( 'coo_elementor_podcast_list_subscribe_url', $settings['coo_elementor_podcast_list_subscribe_url'] );
}
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
            <?php if (!empty($podcast_player_link) && $coo_podcast_player_switch === 'yes') : ?>
            <div class="coo-podcast-player coo-ele-podcast-player">
            <iframe title="<?php the_title(); ?>" frameborder="0" src="<?php echo esc_url($podcast_player_link); ?>"></iframe>
            </div>
             <?php else : ?>
             <?php endif; ?>
            <!-- /podcasts player -->

            <!-- podcasts excerpt -->
            <div class="coo-elementor-podcast-list-excerpt">
                <p>
                <?php 
                    echo wp_kses_post( wp_trim_words( get_the_content(), 20, '...') )
                ?>
            </p>
            </div>
            <!-- /excerpt -->

            <div class="coo-elementor-podcast-footer">
                    <!-- read more button -->
                    <div class="coo-elementor-podcast-list-more"><a href="<?php the_permalink(); ?>"><?php echo esc_html('Listen In…'); ?></a></div>
                    <!-- /read more button -->

                <?php if ($coo_apple_subs_switch === 'yes') : ?>
                    <div class="coo-elementor-podcast-subs-btn">                        
                        <a <?php echo $this->get_render_attribute_string( 'coo_elementor_podcast_list_subscribe_url' ); ?>><?php echo '<img src="' . COOELEMENTOR_ASSETS . '/img/sub-btn.svg" alt="Apple Podcasts">'; ?></a>
                    </div><!-- /apple subs area -->
                <?php endif; ?>

            </div>
        </div> <!-- content -->

    </article>

</div> <!-- end coo-elementor-podcast-list-item -->