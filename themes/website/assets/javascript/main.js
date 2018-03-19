/*
 * Application
 */

$(document).tooltip({
    selector: "[data-toggle=tooltip]"
})

/*
 * Auto hide navbar
 */
jQuery(document).ready(function($){
    var $header = $('.navbar-autohide'),
        scrolling = false,
        previousTop = 0,
        currentTop = 0,
        scrollDelta = 10,
        scrollOffset = 150

    $(window).on('scroll', function(){
        if (!scrolling) {
            scrolling = true

            if (!window.requestAnimationFrame) {
                setTimeout(autoHideHeader, 250)
            }
            else {
                requestAnimationFrame(autoHideHeader)
            }
        }
    })

    function autoHideHeader() {
        var currentTop = $(window).scrollTop()

        // Scrolling up
        if (previousTop - currentTop > scrollDelta) {
            $header.removeClass('is-hidden')
        }
        else if (currentTop - previousTop > scrollDelta && currentTop > scrollOffset) {
            // Scrolling down
            $header.addClass('is-hidden')
        }

        previousTop = currentTop
        scrolling = false
    }

    $(".sidebar_banner").find("img").each(function() {
    	$(this).addClass("img-responsive");
    });

    $("body").on("click", "a.new-window", function(){
      window.open($(this).attr("href"), '_blank', 'toolbar=yes,scrollbars=yes,resizable=yes,top=60,left=50,width=800,height=600');
      return false;
    });

    $("body").on("click", "a.new-tab", function(){
      window.open($(this).attr("href"));
      return false;
    });
});
