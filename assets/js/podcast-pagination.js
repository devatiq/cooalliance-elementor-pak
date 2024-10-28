jQuery(document).ready(function ($) {
    var loading = false;

    $(window).on('scroll', function () {       
        var loadMoreBtn = $('#cooalliance-load-more');       
        if (loadMoreBtn.length && !loading) {
            var offset = loadMoreBtn.offset().top - $(window).scrollTop();
            if (offset < window.innerHeight) {
                var paged = loadMoreBtn.data('paged');
                var maxPages = loadMoreBtn.data('max-pages');

                if (paged <= maxPages) {
                    loading = true;
                    $.ajax({
                        url: cooalliance_ajax.ajax_url,
                        type: 'POST',
                        data: {
                            action: 'cooalliance_load_more_podcasts',
                            paged: paged,
                        },
                        success: function (response) {
                            if (response) {
                                $('.coo-elementor-podcast-list').append(response);
                                loadMoreBtn.data('paged', paged + 1);
                            } else {
                                loadMoreBtn.remove(); // Remove button if no more pages
                            }
                            loading = false;
                        }
                    });
                } else {
                    loadMoreBtn.remove(); // Remove button if no more pages
                }
            }
        }
    });
});