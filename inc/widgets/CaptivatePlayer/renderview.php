<?php 
/**
 * Render View file for COO Captivate Player
 * */

$settings = $this->get_settings_for_display();

$post_id = get_the_ID();
$podcast_player_link = get_post_meta($post_id, '_podcast_player_link', true);

?>

<!-- Podcasts Player Area-->
<div class="coo-elementor-podcasts-player-area">
    <div class="coo-elementor-player-single">
        <?php if (!empty($podcast_player_link)) : ?>
            <iframe title="<?php the_title(); ?>" frameborder="0" src="<?php echo esc_url($podcast_player_link); ?>"></iframe>
        <?php else : ?>
        <?php endif; ?>
    </div>
</div><!--/ Podcasts Player Area-->
