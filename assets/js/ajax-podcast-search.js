jQuery(document).ready(function($) {
    // Function to initialize each podcast widget
    function initCooPodcastWidget(widgetId) {
        var defaultContent = $('#coo-elementor-podcast-default-' + widgetId).html();

        function CooFetchPodcasts(page = 1, query = '') {
            var preloaderSelector = '#podcast-preloader-' + widgetId;
            var resultsSelector = '#podcast-search-results-' + widgetId;

            $(preloaderSelector).show();

            $.ajax({
                url: ajax_podcast_params.ajax_url,
                type: 'POST',
                data: {
                    action: 'coo_ajax_search_podcasts',
                    query: query,
                    paged: page,
					widgetId:widgetId,
                },
                success: function(response) {
                    $(preloaderSelector).hide();
                    $(resultsSelector).html(response);
                },
                error: function() {
                    $(preloaderSelector).hide();
                    $(resultsSelector).html('An error occurred.');
                }
            });
        }

        // Search field input handler
        $('#coo-elementor-podcast-search-field-' + widgetId).on('input', function() {
            var searchValue = $(this).val().trim();
            if (searchValue === '') {
                $('#coo-elementor-podcast-default-' + widgetId).html(defaultContent);
                $('#podcast-search-results-' + widgetId).empty();
            }
        });

        // Search form submission handler
        $('#coo-elementor-podcast-search-form-' + widgetId).submit(function(e) {
            e.preventDefault();
            var searchField = $('#coo-elementor-podcast-search-field-' + widgetId).val().trim();

            if (searchField !== '') {
                $('#coo-elementor-podcast-default-' + widgetId).empty();
                CooFetchPodcasts(1, searchField);
            }
        });

        // Pagination link click handler
        $(document).on('click', '#coo-elementor-podcast-' + widgetId + '.coo-elementor-podcast-pagination a', function(e) {
            e.preventDefault();
            var page = $(this).attr('href').split('paged=')[1];
            var searchField = $('#coo-elementor-podcast-search-field-' + widgetId).val().trim();
            CooFetchPodcasts(page, searchField);
        });
    }

    // Initialize widgets
    $('.coo-elementor-podcast-widget').each(function() {
        var widgetId = $(this).data('widget-id');
        initCooPodcastWidget(widgetId);
    });
});