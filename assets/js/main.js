(function($) {
    ("use strict");

    $(window).on('load', function(event) {
        $('#loading').delay(350).fadeOut('slow');
    })

    /*====================================
        Mobile Menu
    ======================================*/
    var $offcanvasNav = $("#offcanvas-menu a");
    $offcanvasNav.on("click", function() {
        var link = $(this);
        var closestUl = link.closest("ul");
        var activeLinks = closestUl.find(".active");
        var closestLi = link.closest("li");
        var linkStatus = closestLi.hasClass("active");
        var count = 0;

        closestUl.find("ul").slideUp(function() {
            if (++count == closestUl.find("ul").length)
                activeLinks.removeClass("active");
        });
        if (!linkStatus) {
            closestLi.children("ul").slideDown();
            closestLi.addClass("active");
        }
    });

    // Sticky Menu
    function hasStickyMenu() {
        var header = document.querySelector(".header-primary");

        if (header) {
            //Sticky Menu
            window.addEventListener("scroll", function() {
                if (window.scrollY > 100) {
                    header.classList.add("sticky");
                } else {
                    header.classList.remove("sticky");
                }
            });
        }
    }
    hasStickyMenu();

    /*====================================
        Scrool To Top JS
    ======================================*/
    $(window).on("scroll", function() {
        if ($(this).scrollTop() > 400) {
            $('.scrollToTop').addClass('show');
        } else {
            $('.scrollToTop').removeClass('show');
        }
    });

    $('.scrollToTop').on('click', function(e) {
        e.preventDefault();
        $('html, body').animate({
            scrollTop: 0
        }, 500);
        return false;
    });

})(jQuery, window);