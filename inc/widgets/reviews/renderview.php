<?php 
/**
 * Render View file for COO Reviews.
 * */

$settings = $this->get_settings_for_display();

?>

<!-- Podcasts Review Area-->
<div class="coo-elementor-podcasts-review-area">
    <div class="coo-elementor-podcast-single">
        <!--Podcast Review Header-->
        <div class="coo-elementor-podcast-header">
            <div class="coo-elementor-review-rating">
                <?php 
                    for ($i = 0; $i < $settings['coo_elementor_podcast_reviews_star_rating']; $i++) {
                        echo '<i class="eicon-star"></i>';
                    };
                ?>                
            </div>
            <div class="coo-elementor-review-time">
                <p><?php echo esc_html($settings['coo_elementor_podcast_reviews_time']); ?></p>
            </div>
        </div><!--/ Podcast Review Header-->
        <!--Podcast Feedback-->
        <div class="coo-elementor-podcast-feedback">
            <?php echo wpautop($settings['coo_elementor_podcast_reviews_feedback_text']); ?>
        </div><!--/ Podcast Feedback-->
        <div class="coo-elementor-podcast-review-quote">
            <i class="eicon-editor-quote"></i>
        </div>

    </div>
</div><!--/ Podcasts Review Area-->