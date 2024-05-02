var page = 2; // Initialize the page number for pagination

$(window).scroll(function() {
    if($(window).scrollTop() + $(window).height() >= $(document).height() - 300) { // Detect when user scrolls to bottom
        if( !$('body').hasClass('loading') ) { // Check if another AJAX request is not already running
            $('body').addClass('loading'); // Add loading class to prevent multiple requests

            var data = {
                'action': 'load_posts',
                'query': loadmore_params.posts,
                'page' : page,
            };

            $.ajax({
                url : loadmore_params.ajaxurl,
                data : data,
                type : 'POST',
                beforeSend : function ( xhr ) {
                    // You can add loading indicator or text here
                },
                success : function( response ){
                    if( response ) { 
                        // Append the response to the container
                        $('.post-container').append(response);
                        page++; // Increment the page number for the next request
                        $('body').removeClass('loading'); // Remove loading class to enable next request
                    }
                }
            });
        }
    }
});
