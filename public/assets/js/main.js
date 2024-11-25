$(document).ready(function () {
    // sticky header
    var sticky = $('.header_section');
    function toggleHeaderClass() {
        $(window).scrollTop() < 1 ? sticky.removeClass('active') : sticky.addClass('active');
    }
    toggleHeaderClass();
    $(window).on('scroll', function () {
        toggleHeaderClass();
    })

    // testimonial
    var owl = $('.client_slider');
    owl.owlCarousel({
        items: 2,
        loop: true,
        margin: 10,
        autoplay: true,
        nav: false,
        dots: false,
        autoplayTimeout: 5000,
        autoplayHoverPause: true,
        responsive: {
            0: {
                items: 1,
            },
            480: {
                items: 1,
            },
            768: {
                items: 2,
            }
        }
    });

    // related posts

    var related_posts = $('.related_posts');
    related_posts.owlCarousel({
        items: 3,
        loop: true,
        margin: 20,
        autoplay: true,
        nav: false,
        dots: false,
        autoplayTimeout: 5000,
        autoplayHoverPause: true,
        responsive: {
            0: {
                items: 1,
            },
            767: {
                items: 2,
            },
            992: {
                items: 3,
            }
        }
    });

    // scrol to top
    $(window).scroll(function () {
        if ($(this).scrollTop() > 1000) {
            $('.scrollToTop').fadeIn();
        } else {
            $('.scrollToTop').fadeOut();
        }
    });
    $('.scrollToTop').click(function () {
        $('html, body').animate({ scrollTop: 0 }, 10);
        return false;
    });




    // password show hide
    $(".toggle-password").click(function () {
        $(this).toggleClass("fa-eye fa-eye-slash");
        var input = $($(this).attr("data-toggle"));
        if (input.attr("type") == "password") {
            input.attr("type", "text");
        } else {
            input.attr("type", "password");
        }
    });

    $(".toggle-password2").click(function () {
        $(this).toggleClass("fa-eye fa-eye-slash");
        var input = $($(this).attr("data-toggle"));
        if (input.attr("type") == "password") {
            input.attr("type", "text");
        } else {
            input.attr("type", "password");
        }
    });

    $(".confirm-toggle-password").click(function () {
        $(this).toggleClass("fa-eye fa-eye-slash");
        var input = $($(this).attr("data-toggle"));
        if (input.attr("type") == "password") {
            input.attr("type", "text");
        } else {
            input.attr("type", "password");
        }
    });
});  // end document

// preloader
$(window).on("load", function () {
    $(".preloader").fadeOut();
});

