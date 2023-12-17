jQuery(document).ready(function($) {
    $('.coo-elementor-podcast-search-form').submit(function(e) {
        e.preventDefault();

        let searchField = $('.coo-elementor-podcast-search-field').val();
        let preloader = $('#podcast-preloader');

        // Show preloader
        preloader.show();

        $.ajax({
            url: ajax_podcast_params.ajax_url,
            type: 'POST',
            data: {
                action: 'coo_ajax_search_podcasts',
                query: searchField
            },
            success: function(response) {
                 // Hide preloader
                 preloader.hide();
                // Handle the response here. For example:
                $('#podcast-search-results').html(response);
            },
            error: function() {
                // Hide preloader in case of error
                preloader.hide();
                $('#podcast-search-results').html('An error occurred.');
            }
        });
    });
});