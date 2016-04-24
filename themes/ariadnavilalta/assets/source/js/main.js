$(function() {

    'use strict';

    var SLIDESHOW = (function () {

        var counter = $('.slideshow__counter'),
            data = $('.slideshow__info-wrapper');

        function initSlideshow() {
            window.mainSlideshow = Swipe( document.getElementById('slider'), {
                auto: 5000,
                speed: 500,
                continuous: true,
                callback: function(index, elem) {

                    //change the counter
                    counter.find('li').eq(index).addClass('active').siblings().removeClass('active');

                    // hide the current project information
                    var currentProjectInfo = data.find('.slideshow__info-project.active');
                    currentProjectInfo.removeClass('active');

                },
                transitionEnd: function(index, elem) {
                    // show the current project information
                    var newProjectInfo = data.find('.slideshow__info-project').eq(index);
                    newProjectInfo.addClass('active');
                    
                }
            });
        };

        function bindUI() {

            counter.find('li').on( 'click', function() {
                window.mainSlideshow.slide( $(this).index(), 500 );
            });

        };

        function init() {

            initSlideshow();
            bindUI();

        };

        return {
            init: init
        }

    })();


    var PROJECTS = (function () {

        var $container,
            windowHeight,
            hotPoint,
            currScroll,
            $navigation,
            loadUrl;

        function init() {

            $container = $('#project-grid');
            $navigation = $('.navigation');
            
            if ( $('.infinite-scroll').length > 0 && $('.navigation .nav-next').length > 0 ) {
                infinitescroll();
            }

            bindUI();
        };

        function infinitescroll() {

            windowHeight = document.body.offsetHeight;
            hotPoint = windowHeight - 1000;
            currScroll = document.body.scrollTop;
            loadUrl = $('.navigation .nav-next a').prop( 'href' );

            $(window).on( 'scroll', function() {
                currScroll = document.body.scrollTop;

                if ( currScroll > hotPoint ) {
                    $navigation.addClass('loading');
                    loadElements();
                    $(window).off( 'scroll' );
                }
            });

        };

        function loadElements() {

            $.get( loadUrl, function( data ) {
                var newData = $(data),
                    newNavigation = newData.find('.navigation .nav-links'),
                    newNextLink = newNavigation.find('.nav-next a'),
                    newProjectGrid = newData.find('#project-grid'),
                    newProjects = newProjectGrid.find('.project-thumb');

                if ( newNextLink.length > 0 ) {
                    $navigation.html(newNavigation);
                    infinitescroll();
                } else {
                    $navigation.remove();
                }

                $container.append(newProjects);
            });

        };


        function bindUI() {

            $('select[name="project-category"]').on( 'change', function() {
                var newUrl = $(this).val();

                location.href = newUrl;
            });

        };

        return {
            init: init
        }

    })();


    if ( document.getElementById('slider') ) SLIDESHOW.init();
    if ( document.getElementById('project-grid') ) PROJECTS.init();

    // decode the email addresses
    $('.change-email').each( function() {
        var oldAddress = $(this).prop('href');

        $(this).prop('href', oldAddress.replace( 'AT', '@' ) );
    });

});
