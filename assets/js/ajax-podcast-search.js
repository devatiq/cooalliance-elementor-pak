jQuery(document).ready(function($) {
    var defaultContent = $('#coo-elementor-podcast-default').html();

    function CooFetchPodcasts(page = 1, query = '') {
        // Show preloader or some loading indication
        $('#podcast-preloader').show();

        $.ajax({
            url: ajax_podcast_params.ajax_url,
            type: 'POST',
            data: {
                action: 'coo_ajax_search_podcasts',
                query: query,
                paged: page
            },
            success: function(response) {
                // Hide preloader
                $('#podcast-preloader').hide();
                // Update the podcast search results
                $('#podcast-search-results').html(response);
            },
            error: function() {
                // Hide preloader and show error message
                $('#podcast-preloader').hide();
                $('#podcast-search-results').html('An error occurred.');
            }
        });
    }

    // Search field input handler
    $('.coo-elementor-podcast-search-field').on('input', function() {
        var searchValue = $(this).val().trim();
        if (searchValue === '') {
            // Reset to default content when search field is cleared
            $('.coo-elementor-podcast-list#coo-elementor-podcast-default').html(defaultContent);
            $('#podcast-search-results').empty(); // Clear search results container
        }
    });

    // Search form submission handler
    $('.coo-elementor-podcast-search-form').submit(function(e) {
        e.preventDefault();
        var searchField = $('.coo-elementor-podcast-search-field').val().trim();

        if (searchField !== '') {
            // Empty the podcast list for non-empty queries and fetch new results
            $('.coo-elementor-podcast-list#coo-elementor-podcast-default').empty();
            CooFetchPodcasts(1, searchField);
        }
    });

    // Pagination link click handler
    $(document).on('click', '.coo-elementor-podcast-pagination a', function(e) {
        e.preventDefault();
        var page = $(this).attr('href').split('paged=')[1];
        var searchField = $('.coo-elementor-podcast-search-field').val().trim();
        CooFetchPodcasts(page, searchField);
    });
});