jQuery(document).ready(function($) {
    // Assuming default content is stored in a variable
    var defaultContent = $('#coo-elementor-podcast-default').html();

    $('.coo-elementor-podcast-search-field').on('input', function() {
        if ($(this).val().trim() === '') {
            // Reset to default content when search field is cleared
            $('.coo-elementor-podcast-list#coo-elementor-podcast-default').html(defaultContent);
            $('#podcast-search-results').empty();
        }
    });

    $('.coo-elementor-podcast-search-form').submit(function(e) {
        e.preventDefault();

        let searchField = $('.coo-elementor-podcast-search-field').val();
        let preloader = $('#podcast-preloader');

        if (searchField.trim() !== '') {
            // Empty the podcast list for non-empty queries
            $('.coo-elementor-podcast-list#coo-elementor-podcast-default').empty();

            // Show preloader
            preloader.show();

            // Execute the AJAX call
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

                    // Populate the podcast search results
                    $('#podcast-search-results').html(response);
                },
                error: function() {
                    // Hide preloader in case of error
                    preloader.hide();

                    // Display error message
                    $('#podcast-search-results').html('An error occurred.');
                }
            });
        }
    });
});