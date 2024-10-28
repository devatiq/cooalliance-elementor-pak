<?php 
/**
 * Render View file for COO Captivate Player Single
 * */

$settings = $this->get_settings_for_display();
$podcast_player_individual_title = $settings['coo_elementor_podcast_player_single_title'];
$podcast_player_individual_link = $settings['coo_elementor_podcast_player_single_url'];

?>

<!-- Podcasts Player Area-->
<div class="coo-elementor-podcasts-player-single-area">
    <div class="coo-elementor-player-individual">
        <?php if (!empty($podcast_player_individual_link)) : ?>
            <iframe title="<?php echo esc_attr($podcast_player_individual_title); ?>" frameborder="0" src="<?php echo esc_url($podcast_player_individual_link); ?>"></iframe>
        <?php else : ?>
        <?php endif; ?>
    </div>
</div><!--/ Podcasts Player Area-->
