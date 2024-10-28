<!-- single markup for ajax search loop -->

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
             $post_id = get_the_ID();
             $podcast_player_link = get_post_meta($post_id, '_podcast_player_link', true); ?>
             <?php if (!empty($podcast_player_link)) : ?>
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
               
                <div class="coo-elementor-podcast-list-more"><a href="<?php the_permalink(); ?>"><?php echo _e('Listen In…', 'cooalliance-ele') ?></a></div>                  
                <div class="coo-elementor-podcast-subs-btn">                        
                    <a href="https://itunes.apple.com/us/podcast/second-in-command-the-chief-behind-the-chief/id1368800817" target="_blank"><?php echo '<img src="' . COOELEMENTOR_ASSETS . '/img/sub-btn.svg" alt="Apple Podcasts">'; ?></a>
                </div><!-- /apple subs area -->            

            </div>
        </div> <!-- content -->

    </article>

</div> <!-- end coo-elementor-podcast-list-item -->