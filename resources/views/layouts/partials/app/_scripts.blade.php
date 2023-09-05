<script>
    var searchOverlayMobile = document.querySelector("#search-overlay");

    function toggleSearchOverlay() {
        if (searchOverlayMobile) {
            searchOverlayMobile.classList.toggle("overlay-show");
            document.querySelector("body").classList.toggle("overlay-is-open");

            if (searchOverlayMobile.classList.contains("overlay-show")) {
                document.querySelector("#search-overlay-input")
                    .focus(); // on open, focus to the input searchbar
                searchOverlayMobile.scrollTo(0, 0);
            } else {
                document.querySelector("#search-overlay-input").blur();
            }
        }
    }
    $(document).ready(function() {
        $('.home-featured-paddle-prev').on('click', function() {
            $("#home-favourite-track")
                .animate({
                    scrollLeft: '-=250'
                }, 180);
        });

        $('.home-featured-paddle-next').on('click', function() {
            $("#home-favourite-track")
                .animate({
                    scrollLeft: '+=250'
                }, 180);
        });

        //Initialize see all link
        $('#home-featured-seeall-link').attr('href', $('#homepage-game-tab [data-toggle="pill"]').first().attr(
            'data-seeall-link')); //assign first tab data-seeall-link to the "see all" href

        //On tab change handler
        $('#homepage-game-tab [data-toggle="pill"]').on('show.bs.tab', function(e) {
            featuredPaddleTargetId = '#' + e.target.getAttribute('aria-controls') +
                '-track'; //update paddle target
            $('#home-featured-seeall-link').attr('href', e.target.getAttribute(
                'data-seeall-link')); //update see all link with selected tab

        });


        if (document.getElementById("home-splide")) {
            var isBannerLazyLoadedFirstTime = true;

            //Splide Banner
            var homeSplide = new Splide("#home-splide", {
                type: "loop",
                padding: {
                    right: "60px",
                    left: "30px",
                },
                arrows: false,
                autoplay: true,
                interval: 3000,
                lazyLoad: 'nearby',
                pagination: true,
                breakpoints: {
                    992: {
                        type: "loop",
                        padding: {
                            right: "30px",
                            left: "15px",
                        },
                        rewind: false,
                        arrows: false,
                        pagination: false,
                    },
                }

            });

            homeSplide.on('mounted', function() {
                //show the banner skeleton
                let pagination = $("#home-splide .splide__pagination");
                pagination.prepend('<li class="icon-cheveron-Left splide-custom-arrow-left"></li>');
                pagination.append('<li class="icon-cheveron-Right splide-custom-arrow-right"></li>');
                //insert custom arrow to bullet
                $('.splide-custom-arrow-left').on('click', function() {
                    homeSplide.go('<');
                });
                $('.splide-custom-arrow-right').on('click', function() {
                    homeSplide.go('>');
                })
            });

            homeSplide.on('lazyload:loaded', function() {
                if (isBannerLazyLoadedFirstTime) {
                    $('#home-splide').show();
                    $('.splide-placeholder').hide();
                    isBannerLazyLoadedFirstTime = false;
                }
            })

            homeSplide.mount();

        }
    });
</script>
