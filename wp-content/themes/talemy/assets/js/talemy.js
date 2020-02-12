(function($) {
    'use strict';

    var $window = $(window);
    var winWidth = $window.width();
    var winHeight = $window.height();

    var loader = {
        elem: null,
        loading: true,
        width: 0,
        maxWidth: 400,

        init: function() {
            loader.elem = $('#loader');

            if (loader.elem.length === 0) {
                return;
            }

            if (winWidth < 480) {
                loader.maxWidth = 100;
            } else {
                loader.maxWidth = 400;
            }

            switch(loader.elem.attr('class')) {
                case 'line': loader.line(); break;
                default: loader.spinner(); break;
            }
        },

        line: function() {
            
            loader.elem.css({ top: winHeight / 2 - 1, left: winWidth / 2 - loader.maxWidth / 2 });
            loader.progress();

            $window.on('load', function() {
                setTimeout(function() {
                    loader.loading = false;
                    loader.elem.stop(true);
                    loader.elem.animate({ left: 0, width: '100%' })
                    // loader.elem.animate({ top: '0', height: '100vh' })
                    loader.elem.fadeOut(100);
                    loader.elem.promise().done(function() {
                        $('body').removeClass('page-loading');
                    });
                }, 200);
            });
        },

        spinner: function() {
            $window.on('load', function() {
                setTimeout(function() {
                    loader.elem.fadeOut(100);
                    loader.elem.promise().done(function() {
                        $('body').removeClass('page-loading');
                    });
                }, 200);
            });
        },

        progress: function() {
            if (loader.loading && loader.width < loader.maxWidth) {
                loader.width += 3;
                loader.elem.animate({ width: loader.width }, 10);
                loader.progress();
            }
        }
    }

    loader.init();

    $(document).ready(function() {
        wpadminbar.init();
        navigation.init();
        layouts.init();
        stickyNavbar.init();
        stickySidebar();
        commonFeatures();
        courseTabs.init();
        stickyFooter();
    });


    /* -----------------------------------------------------------------------------
     * Common features
     * ----------------------------------------------------------------------------- */
    function commonFeatures() {

        // switch to retina image
        if (window.devicePixelRatio >= 2) {
            $('img.logo-retina').each(function() {
                var $this = $(this);
                $this.attr('src', $this.data('retina'));
            });
        }

        // Post gallery
        Slider($('.post-gallery'));
        
        // Fit video width
        $('.media-embed,.embed-youtube,.activity-list').fitVids();

        // Placeholder support for browsers do not support html5
        $('input,textarea').placeholder();

        // Equal height
        $('.equal-height').matchHeight();

        // Selectric
        $('.woocommerce-ordering .orderby,.product .variations select,.widget_archive select,.widget_text select,.wpcf7-form select,.course-search-category,.content-search select,#tinvwl_product_actions,#bbp_stick_topic_select,#bbp_topic_status_select').selectric();

        // Scroll top
        $('.scroll-top').on('click touchend', function(e) {
            e.preventDefault();
            $('html,body').animate({ scrollTop: 0 }, 400);
        });

        var scrollButton = $('#scroll-top');
        var scrollButtonVisible = false;

        $window.on('scroll', $.throttle(100, function() {
            if ($window.scrollTop() > 200) {
                if (!scrollButtonVisible) {
                    scrollButton.addClass('active');
                    scrollButtonVisible = true;
                }
            } else {
                if (scrollButtonVisible) {
                    scrollButton.removeClass('active');
                    scrollButtonVisible = false;
                }
            }
        }));

        // infinite scroll & load more
        var ajaxLoader = $('div.ajax-loader');
        if (ajaxLoader.length) {
            ajaxPosts.init(ajaxLoader);
        }

        // Hamburger
        $(document).on('click touchend', '.hamburger,.hamburger-2', function(e) {
            e.preventDefault();

            if ($(this).hasClass('hamburger')) {
                $('body').toggleClass('off-canvas-left-active');
            } else {
                $('body').toggleClass('off-canvas-right-active');
            }
        });

        $('.off-canvas-close').on('click touchend', function(e) {
            e.preventDefault();
            $('body').removeClass('off-canvas-left-active off-canvas-right-active');
        });

        $('.site-overlay').on('touchstart click', function(e) {
            e.preventDefault();
            $('body').removeClass('off-canvas-left-active off-canvas-right-active');
        });


        $('.btn-search').on('click', function(e) {
            e.preventDefault();

            if (!$('body').hasClass('nav-sf-active')) {
                $('body').addClass('nav-sf-active');
                setTimeout(function() {
                    $('.nav-sf-input').focus();
                }, 200);
            } else {
                $('body').removeClass('nav-sf-active');
            }
        });

        // side menu
        $('.off-canvas-menu a')
            .filter(function() {
                var a = $(this);
                return a.parent().hasClass('menu-item-has-children') && (a.attr('href') === '#' || typeof a.attr('href') === 'undefined');
            })
            .add('.off-canvas-menu .menu-expand')
            .bind('click touchend', function(e) {
                e.preventDefault();
                var menuItem = $(this).parent();
                
                if (!menuItem.hasClass('active')) {
                    menuItem.addClass('active');
                    menuItem.find('>ul').slideDown('fast');
                    
                    if (menuItem.parent().hasClass('side-menu')) {
                        $('.off-canvas-menu li.active').each(function() {
                            var $this = $(this);
                            
                            if (!$this.is(menuItem)) {
                                $(this).removeClass('active');
                                $(this).find('>ul').slideUp('fast');
                            }
                        });
                    }
                } else {
                    menuItem.find('>ul').slideUp('fast');
                    menuItem.removeClass('active');
                }
            });


        // Woocommerce quantity +/- buttons
        var wooQuantityInput = $('.woocommerce .quantity .qty');
        var wooProduct = null;

        $(document.body)

            .on('click', '.ajax_add_to_cart', function() {
                wooProduct = $(this).parents('.product');
                wooProduct.addClass('adding_to_cart');
            })

            .on('added_to_cart', function() {
                if (wooProduct !== null) {
                    wooProduct.removeClass('adding_to_cart').addClass('added_to_cart');
                    wooProduct = null;
                }
            })

            .on('click', 'input.plus, input.minus', function() {
                var qty = $(this).siblings('.qty');
                var val = parseFloat(qty.val());
                var max = parseFloat(qty.attr('max'));
                var min = parseFloat(qty.attr('min'));
                var step = qty.attr('step');

                if (val === '' || isNaN(val)) val = 1;
                if (max === '' || isNaN(max)) max = '';
                if (min === '' || isNaN(min)) min = 1;
                if (step === '' || step === 'any' || isNaN(parseFloat(step))) step = 1;

                if ($(this).is('.plus')) {
                    if (max && val >= max) {
                        qty.val(max);
                    } else {
                        qty.val(val + parseFloat(step));
                    }
                } else {
                    if (min && val <= min) {
                        qty.val(min);
                    } else if (val > 1) {
                        qty.val(val - parseFloat(step));
                    }
                }
                qty.trigger('change');
            });

        // account dropdown
        $('.nav-logged-in').superfish({
            animation: {opacity:'show'},
            cssArrows: false,
            delay: 0,
            disableHI: true,
            popUpSelector: '.account-dropdown',
            speed: 'fast',
            speedOut: 0,
            onBeforeShow: function(e) {
                var left = $(window).width() - $(this).prev().offset().left;
                if (left < 160) {
                    $(this).css({
                        'left': 'auto',
                        'right': '0'
                    });
                }
            }
        });


        // nav course categories
        $('.nav-category-list').superfish({
            animation: {opacity:'show'},
            cssArrows: false,
            delay: 0,
            disableHI: true,
            popUpSelector: '.course-category-list',
            speed: 'fast',
            speedOut: 0,
        });

        $('.course-section__title').on('click', function(e) {
            e.preventDefault();
            var $title = $(this);
            var $activeTitle = $title.siblings('.active');
            
            if (!$title.hasClass('active')) {
                $title.addClass('active');
                $title.next().slideDown();
            } else {
                $title.removeClass('active');
                $title.next().slideUp();
            }

            if ($activeTitle.length) {
                $activeTitle.removeClass('active');
                $activeTitle.next().slideUp();
            }
        });

        $('.course-section__title:first-child').click();

        $('#course-sidebar__share-btn').on('click', function(e) {
            e.preventDefault();
            $(this).siblings('.post-share').slideToggle();
        });

        // BuddyPress
        if ($('body').hasClass('buddypress')) {
            $('#group-members-role-filter,.select-wrap select').selectric();

            $('#whats-new-form').on('click', function() {
                $('#whats-new-post-in').selectric();
            });

            $(document).ajaxSuccess(function() {
                setTimeout(function() {
                    $('.select-wrap select').selectric();
                    $('.activity-list').fitVids();
                }, 600);
            });
        }

        // Popover positioning
        popoverPosition();

        // Move course sidebar
        moveCourseSidebar();
    }

    /* -----------------------------------------------------------------------------
     * Course Sidebar
     * ----------------------------------------------------------------------------- */
    function moveCourseSidebar() {
        if (matchMaxWidth(767) && $('.course-sidebar').length) {
            $('.course-intro-content').after($('.course-sidebar'));
        } else {
            $('.course-sidebar').prependTo($('.sidebar-wrapper'));
        }
    }

    /* -----------------------------------------------------------------------------
     * Popover content
     * ----------------------------------------------------------------------------- */
    function popoverPosition() {
        if (matchMinWidth(768)) {
            $(document).on('mouseenter', '.post-body.has-popover', function() {
                var $post = $(this);
                var $popover = $(this).find('.post-popover');
                var postOffset = $post.offset();
                var popoverClass = 'popover-right';
                var popoverHeight = $popover.outerHeight();
                var offset = popoverHeight - $post.outerHeight();
                // center popover content if its height is greater than post height
                offset = offset > 0 ? offset/2 : 0;
                var top = postOffset.top - $(window).scrollTop() - offset;
                var left = 0;


                if (top < 0) {
                    top = Math.abs(top) + wpadminbar.height - offset;
                } else if (top + popoverHeight > winHeight) {
                    top = - (top + popoverHeight - winHeight + offset);
                } else {
                    top = offset > 0 ? offset*-1 : 0;
                }

                if (postOffset.left + $post.width() + $popover.outerWidth() + 10 > winWidth) {
                    left = - $popover.outerWidth() - 10;
                    popoverClass = 'popover-left';
                } else {
                    left = $post.width() + 10;
                }

                $popover
                    .css({
                        'top': top + 'px',
                        'left': left + 'px'
                    })
                    .addClass(popoverClass);
            });
        } else {
            $(document).off('mouseenter', '.post-body.has-popover');
        }
    }

    /* -----------------------------------------------------------------------------
     * Sticky Footer
     * ----------------------------------------------------------------------------- */
    function stickyFooter() {
        var minHeight = winHeight - $('#header').outerHeight() - $('#footer').outerHeight() - wpadminbar.height;
        $('#content').css('min-height', minHeight + 'px');
    }

    /* -----------------------------------------------------------------------------
     * Sticky Sidebar
     * ----------------------------------------------------------------------------- */
    function stickySidebar() {
        $('.sidebar.sticky').each(function() {
            $(this).theiaStickySidebar({
                containerSelector: $(this).parents('.row'),
                additionalMarginTop: 60,
                // additionalMarginTop: this.stickyNavbar.getCushion(),
                additionalMarginBottom: 20
            });
        });
    }

    /* -----------------------------------------------------------------------------
     * Sticky Navbar
     * ----------------------------------------------------------------------------- */

    var stickyNavbar = (function(sn) {

        var el;
        var option;
        var offset;
        var lastScroll = 0;
        var isMaxY = false;
        var isMinY = true;
        var isTop = false;
        var ticking = false;
        var transformY = 0;

        var always = function() {
            if (!ticking) {
                requestAnimationFrame(function() {
                    var currentScroll = $window.scrollTop();

                    if (wpadminbar.enabled && wpadminbar.fixed || currentScroll === 0) {
                        el.css('top', wpadminbar.height + 'px');
                    } else {
                        el.css('top', '0');
                    }

                    if (isTop) {
                        ticking = false;
                        return;
                    }

                    if (currentScroll > offset) {
                        if (!el.hasClass('nav-is-fixed')) {
                            el.addClass('nav-is-fixed');
                        }
                    } else {
                        el.removeClass('nav-is-fixed');
                    }
                    ticking = false;
                });
                ticking = true;
            }
        };

        var smart = function() {
            var currentScroll = $window.scrollTop();
            var scrollDelta = currentScroll - lastScroll; // scroll distance

            if (wpadminbar.enabled && (wpadminbar.fixed || currentScroll === 0)) {
                el.css('top', wpadminbar.height + 'px');
            } else {
                el.css('top', '0');
            }

            if (currentScroll > offset) {
                if (!el.hasClass('nav-is-fixed')) {
                    el.addClass('nav-is-fixed');
                }

                // scroll up
                if (scrollDelta > 0 && !isMaxY) {
                    transformY -= scrollDelta;
                    var navheight = el.outerHeight();
                    
                    if (transformY < -1*navheight || transformY == -1*navheight) {
                        transformY = -1*navheight;
                        isMaxY = true;
                        if (!el.hasClass('nav-is-fixed')) {
                            el.addClass('nav-is-fixed');
                        }
                    }
                    
                    requestAnimationFrame(function() {
                        cssTranslate3d(el[0], transformY);
                    });

                    isMinY = false;

                // scroll down
                } else if (scrollDelta < 0 && !isMinY) {
                    transformY += -1*scrollDelta;
                    
                    if (transformY > 0 || transformY === 0) {
                        transformY = 0;
                        isMinY = true;
                    }
                    
                    requestAnimationFrame(function() {
                        cssTranslate3d(el[0], transformY);
                    });
                    
                    isMaxY = false;
                }

            } else if (currentScroll <= offset) {
                el.removeClass('nav-is-fixed');
                cssTranslate3d(el[0], 0);
            }
            lastScroll = currentScroll;
        };

        function setup() {
            offset = el.parent().offset().top;
            el.removeClass('nav-is-fixed').css('top', '');
            ticking = false;

            // if (wpadminbar.fixed) {
            //     offset -= wpadminbar.height;
            // }
        }

        sn.init = function() {
            el = $('.navbar');
            option = el.data('sticky-style');

            if (el.length === 0 || typeof option == 'undefined' || option == '' || option == 'disable') {
                return;
            }

            setup();

            switch(option) {
                
                case 'always':
                    window.addEventListener('scroll', always, false);
                    always();
                    break;

                case 'smart':
                    window.addEventListener('scroll', smart, false);
                    smart();
                    break;
            }
        };

        sn.refresh = function() {
            
            if (el.length === 0 || typeof option == 'undefined' || option == '' || option == 'disable') {
                return;
            }

            setup();

            switch(option) {

                case 'always':
                    window.addEventListener('scroll', always, false);
                    always();
                    break;
                
                case 'smart':
                    window.addEventListener('scroll', smart, false);
                    smart();
                    break;
            }
        };

        // determine the top distance for sticky elements like sticky sidebar
        sn.getCushion = function() {
            var cushion = 0;

            if (el.length === 0) {
                return cushion;
            }
            
            if (option == 'always' || option == 'smart') {
                cushion += el.outerHeight();
            }

            if (wpadminbar.fixed) {
                cushion += wpadminbar.height;
            }
            return cushion;
        }
        
        return sn;

    })(stickyNavbar || {});


    /* -----------------------------------------------------------------------------
     * Admin bar
     * ----------------------------------------------------------------------------- */
    var wpadminbar = {

        enabled: false,
        fixed: false,
        height: 0,

        init: function() {
            var adminbar = $('#wpadminbar');
            if (adminbar.length) {
                this.enabled = true;
                this.height = adminbar.height();
                if (adminbar.css('position') === 'fixed') {
                    this.fixed = true;
                } else {
                    this.fixed = false;
                }
            } else {
                this.enabled = false;
                this.height = 0; 
            }
        },
    };


    /* -----------------------------------------------------------------------------
     * Main Menu
     * ----------------------------------------------------------------------------- */
    var navigation = {

        menu: null,
        submenu: null,
        megamenu: null,
        container: null,
        width: 0,
        space: 0,
        cache: null,

        init: function() {
            var menu = $('.nav-menu');

            if (menu.length === 0) {
                return;
            }

            navigation.menu = menu;
            navigation.cache = menu.html();
            navigation.container = menu.parents('.nav');
            navigation.compress();

            navigation.submenu = menu.find('.sub-menu');
            navigation.megamenu = menu.find('.megamenu-custom-width .megamenu');

            if (navigation.submenu.length) {
                navigation.hovershift();
            }

            if (navigation.megamenu.length) {
                navigation.rePosition();
            }

            navigation.sfmenu();

            $(window).on('resize orientationchange', $.debounce(200, function() {
                navigation.refresh();
            }));
        },

        disableMenus: function() {
            navigation.moreItemsUl.find('.megamenu').each(function() {
                $(this).removeClass('megamenu').addClass('sub-menu');
            })
            
            navigation.moreItemsUl.find('.megamenu-submenu').each(function() {
                $(this).removeClass('megamenu-submenu').addClass('sub-menu');
            });

            navigation.moreItemsUl.find('[class^="megamenu-"],[class*=" megamenu-"]').each(function() {
                var oldName = $(this)[0].className;
                var newName = oldName.replace(new RegExp('megamenu', 'g'), 'mm');
                $(this).attr('class', newName);
            });

            navigation.moreItemsUl.find('>.menu-item>a').attr('style', '');
        },

        sfmenu: function() {
            navigation.menu.superfish({
                animation: {opacity:'show'},
                cssArrows: false,
                delay: 0,
                disableHI: true,
                popUpSelector: '.sub-menu,.megamenu',
                speed: 'fast',
                speedOut: 0,
            });
        },

        compress: function() {
            if (!matchMinWidth(768)) {
                return;
            }
            navigation.menu.addClass('pre-compress');
            var containerWidth = navigation.container.width();

            navigation.moreItems = navigation.menu.find('.menu-items-container');
            navigation.moreItemsUl = navigation.moreItems.find('>ul');
            navigation.moreItems.show();
            navigation.moreItemsWidth = navigation.moreItems.outerWidth();
            navigation.moreItems.hide();

            navigation.menuItems = navigation.menu.children().not('.menu-items-container');
            navigation.width = 0;
            
            navigation.container.children().each(function() {
                if ($(this).is('.nav-menu-wrapper') || $(this).is('.nav-menu')) {
                    for (var i = navigation.menuItems.length - 1; i >= 0; i--) {
                        navigation.width += navigation.menuItems.eq(i).outerWidth();
                    }
                } else {
                    navigation.width += $(this).outerWidth();
                }
            });

            if (navigation.width + navigation.space > containerWidth) {
                navigation.container.addClass('nav-compress');
                
                for (var i = navigation.menuItems.length - 1; i >= 0; i--) {
                    var currentMenuItem = navigation.menuItems.eq(i);
                    navigation.width = navigation.width - currentMenuItem.outerWidth();
                    currentMenuItem.prependTo(navigation.moreItemsUl);

                    if (navigation.width + navigation.space + navigation.moreItemsWidth <= containerWidth) {
                        break;
                    }
                }
                navigation.disableMenus();
                navigation.moreItems.show();
            } else {
                navigation.container.removeClass('nav-compress');
            }

            navigation.menu.removeClass('pre-compress');
        },

        hovershift: function() {
            // Submenu open in opposite direction if there's no enough space
            navigation.submenu.each(function() {
                var $this = $(this);
                var submenuLeft = $this.offset().left;
                var submenuRight = winWidth - submenuLeft - 200;
                if (submenuLeft < 0 || submenuRight < 0) {
                    $this.addClass('hover-shift');
                } else {
                    $this.removeClass('hover-shift');
                }
            });
        },

        rePosition: function() {
            var navWidth = navigation.container.outerWidth();
            var navOffset = navigation.menu.offset().left;

            navigation.megamenu.each(function() {
                var $menu = $(this);
                var $menuParent = $menu.parent();
                var menuOffset = $menuParent.offset().left;
                var menuWidth = $menu.attr('class').slice(-1) * 220 + 30; // get mega menu width setting from megamenu-custom-* class
                menuWidth = menuWidth > navWidth ? navWidth : menuWidth;
                $menu.css('width', menuWidth + 'px');
                
                // center mega menu
                var distance = menuWidth * 0.5 - $menuParent.outerWidth() * 0.5;
                var shiftRight = distance - menuOffset;
                var shiftLeft = menuWidth * 0.5 + $menuParent.outerWidth() * 0.5 + menuOffset - winWidth;
                var cssPropName = $('body').hasClass('rtl') ? 'margin-right' : 'margin-left';
                // left edge
                if (shiftRight >= 0) {
                    $menu.css(cssPropName, -1*(distance - shiftRight - 15) + 'px');
                // right edge
                } else if (shiftLeft >= 0) {
                    $menu.css(cssPropName, (-1*distance - shiftLeft - 15) + 'px');
                // normal
                } else {
                    $menu.css(cssPropName, -1*distance + 'px');
                }
            });
        },

        refresh: function() {
            if (!matchMinWidth(768)) {
                return;
            }

            navigation.menu.superfish('destroy');
            
            if (navigation.cache) {
                navigation.menu.html(navigation.cache);
            }

            navigation.compress();
            navigation.submenu = navigation.menu.find('.sub-menu');
            navigation.megamenu = navigation.menu.find('.megamenu-custom-width .megamenu');

            if (navigation.submenu.length) {
                navigation.hovershift();
            }

            if (navigation.megamenu.length) {
                navigation.rePosition();
            }

            navigation.sfmenu();
        }
    };

    /* -----------------------------------------------------------------------------
     * Masonry
     * ----------------------------------------------------------------------------- */
    var layouts = (function(self) {
        var masonry = $('.masonry');
        var animated = 0;
        var animation;

        self.init = function() {
            if (masonry.length) {
                masonry.imagesLoaded(function() {
                    self.masonry();
                    masonry.children().eq(animated).addClass('animation-bounce-up');
                    animated += 1;
                    oneByOne(masonry.children(), animated);
                });
            }
        };

        self.masonry = function() {
            masonry.isotope({
                itemSelector: '.post',
                transitionDuration: '0',
            });
        };

        function oneByOne(elems, index) {
            animation = setTimeout(function() {
                elems.eq(index).addClass('animation-bounce-up');
                if (index < elems.length - 1) {
                    animated += 1;
                    oneByOne(elems, animated);
                } else {
                    clearTimeout(animation);
                }
            }, 100);
        }

        return self;

    })(layouts || {});


    /* -----------------------------------------------------------------------------
     * Ajax Posts - Load More & Infinite Scroll
     * ----------------------------------------------------------------------------- */

    var ajaxPosts = (function(self) {

        var settings;
        var loader;
        var container;
        var parent;
        var maxPosts;
        var maxLoads;
        var loaded;
        var ppp;
        var ppl;
        var offset;
        var pagination;
        var footerInner;
        var pageNumber = 0;
        var processing = false;
        var dataStatus = true;

        var loadOnScroll = $.debounce(100, function() {
            if (dataStatus && !processing) {
                if ($(this).scrollTop() >= loader.offset().top - winHeight - offset) {
                    processing = true;
                    pageNumber ++;
                    loaded += ppl;
                    loadPosts();
                }
            }
        });

        function loadPosts() {

            $.ajax({
                url: talemy_js_data.ajax_url,
                type: 'POST',
                data: ({
                    action: 'talemy_ajax_posts',
                    page_number: pageNumber,
                    atts: settings.atts,
                    query_args: settings.query_args,
                }),
                beforeSend: function() {
                    parent.addClass('loading');
                },
                success: function(data) {
                    if (data) {
                        if (settings.atts.list_style == 'masonry') {
                            var $newEls = $(data);
                            container.append($newEls);
                            container.isotope('appended', $newEls);
                            layouts.init();
                            $('.media-embed,.embed-youtube').fitVids();
                        } else {
                            container.append($(data).hide().fadeIn());
                        }
                    }
                }
            })
            .always(function() {
                processing = false;
                parent.removeClass('loading');

                if (maxPosts <= loaded) {
                    parent.addClass('all-loaded');
                    footerInner.show();
                    dataStatus = false;
                    window.removeEventListener('scroll', loadOnScroll);
                } else {
                    if (pagination != 'scroll') {
                        return;
                    }

                    if (pageNumber == maxLoads) {
                        window.removeEventListener('scroll', loadOnScroll);

                        $.ajax({
                            url: talemy_js_data.ajax_url,
                            type: 'POST',
                            data: ({
                                action: 'talemy_ajax_more_button',
                            }),
                            success: function(data) {
                                pagination = 'more';
                                loader.remove();
                                parent.append(data);
                                footerInner.show();
                                parent.find('.load-more').on('click', function() {
                                    if (!processing) {
                                        processing = true;
                                        pageNumber ++;
                                        loaded += ppl;
                                        loadPosts();
                                    }
                                });
                            }
                        });
                    } else {
                        loadOnScroll();
                    }
                }
            });
        }

        self.init = function(ajaxLoader) {
            loader = ajaxLoader;
            container = ajaxLoader.prev();
            parent = ajaxLoader.parent();
            footerInner = $('#footer>div');

            settings = loader.data('list');
            offset = settings.offset;
            pagination = settings.pagination;
            maxPosts = settings.found_posts;
            maxLoads = settings.max_loads;
            loaded = ppp = parseInt(settings.atts.ppp);
            ppl = parseInt(settings.atts.ppl);

            if (ppl === 0 || ppl === '') {
                ppl = 5;
            }
            
            if (typeof maxLoads == 'undefined' || maxLoads === 0) {
                maxLoads = 9999;
            }

            if (typeof offset == 'undefined') {
                offset = 0;
            }

            if (maxPosts > ppp) {

                if (pagination == 'scroll') {
                    footerInner.hide();
                    window.addEventListener('scroll', loadOnScroll, false);
                    loadOnScroll();
                }

                if (pagination == 'more') {
                    loader.find('.load-more').on('click', function() {
                        if (!processing) {
                            processing = true;
                            pageNumber ++;
                            loaded += ppl;
                            loadPosts();
                        }
                    });
                }
            }
        };

        return self;

    })(ajaxPosts || {});

    var courseTabs = {

        init: function() {
            if ($('.course-tabs').length === 0) {
                return;
            }

            $(document.body).on('click', '.course-tab', function(e) {
                e.preventDefault();
                courseTabs.switchTab($(this));
                courseTabs.changeHash();
            });

            var hash = window.location.hash;
            if (typeof hash !== 'undefined' && hash !== '') {
                hash = hash.replace('#tab-', '#');
                var currentTab = $('a[href*="' + hash + '"]');
                if (currentTab.length) {
                    currentTab.click();
                } else {
                    $('.course-tabs').children().first().find('.course-tab').click();
                }
            } else {
                $('.course-tabs').children().first().find('.course-tab').click();
            }
        },

        switchTab: function(element) {
            this.hash = element.attr('href');
            element.parent().addClass('active').siblings().removeClass('active');
            $(this.hash).siblings().hide();
            $(this.hash).fadeIn(200);
        },

        hash: '',

        changeHash: function() {
            if (this.hash !== '') {
                window.location.hash = this.hash.replace('#', '#tab-');
                this.hash = '';
            }
        }
    };

    var Blocks = function($scope) {
        $scope.find('.pb-block').each(function() {
            Talemy_Block($(this));
        });
    }

    var CourseSearch = function($scope) {
        $scope.find('select').selectric();
    }

    var EventsCountdown = function($scope) {
       var $element = $scope.find('.events-countdown-timer'),
           date = new Date($element.data('date') * 1000);

        new Timer($element, date);
    }

    var CustomSlider = function($scope) {
        var $container = $scope.find('.swiper-container');
        if ($container.length === 0) {
            return;
        }

        var settings = $container.data('settings');
        var swiper = new Swiper($container, settings);

        var prevButton = $scope.find('.prev-slide');
        var nextButton = $scope.find('.next-slide');

        prevButton.on('click', function() {
            swiper.slidePrev();
        });

        nextButton.on('click', function() {
            swiper.slideNext();
        });
    }

    var Slider = function($scope) {
        var $container = $scope.find('.swiper-container');
        if ($container.length === 0) {
            return;
        }
        var settings = $container.data('settings');
        var swiper = new Swiper($container, settings);
    };

    var Timer = function($element, endTime) {
        var timeInterval,
            $elements = {
                $daysSpan: $element.find('.events-countdown-days'),
                $hoursSpan: $element.find('.events-countdown-hours'),
                $minutesSpan: $element.find('.events-countdown-minutes'),
                $secondsSpan: $element.find('.events-countdown-seconds')
            };

        var updateTimer = function() {
            var timeRemaining = Timer.getTimeRemaining(endTime);

            $.each(timeRemaining.parts, function(timePart) {
                var $element = $elements['$' + timePart + 'Span'],
                    partValue = this.toString();

                if (1 === partValue.length) {
                    partValue = 0 + partValue;
                }

                if ($element.length) {
                    $element.text(partValue);
                }
            });

            if (timeRemaining.total <= 0) {
                clearInterval(timeInterval);
            }
        };

        var init = function() {
            updateTimer();
            timeInterval = setInterval(updateTimer, 1000);
        };

        init();
    };

    Timer.getTimeRemaining = function(endTime) {
        var timeRemaining = endTime - new Date(),
            seconds = Math.floor((timeRemaining / 1000) % 60),
            minutes = Math.floor((timeRemaining / 1000 / 60) % 60),
            hours = Math.floor((timeRemaining / (1000 * 60 * 60)) % 24),
            days = Math.floor(timeRemaining / (1000 * 60 * 60 * 24));

        if (days < 0 || hours < 0 || minutes < 0) {
            seconds = minutes = hours = days = 0;
        }

        return {
            total: timeRemaining,
            parts: {
                days: days,
                hours: hours,
                minutes: minutes,
                seconds: seconds
            }
        };
    };

    /**
     * Elementor elements
     */
    $window.on('elementor/frontend/init', function() {
        elementorFrontend.hooks.addAction('frontend/element_ready/talemy-course-categories.default', Slider);
        elementorFrontend.hooks.addAction('frontend/element_ready/talemy-course-search.default', CourseSearch);
        elementorFrontend.hooks.addAction('frontend/element_ready/talemy-block-courses.default', Blocks);
        elementorFrontend.hooks.addAction('frontend/element_ready/talemy-block-posts.default', Blocks);
        elementorFrontend.hooks.addAction('frontend/element_ready/talemy-events-countdown.default', EventsCountdown);
        elementorFrontend.hooks.addAction('frontend/element_ready/talemy-events-slider.default', CustomSlider);
        elementorFrontend.hooks.addAction('frontend/element_ready/talemy-info-boxes.default', CustomSlider);
    });

    function cssTranslate3d(elem, value) {
        var translate3d = 'translate3d(0,' + value + 'px, 0)';
        elem.style['-webkit-transform'] = translate3d;
        elem.style['-moz-transform'] = translate3d;
        elem.style['-ms-transform'] = translate3d;
        elem.style['-o-transform'] = translate3d;
        elem.style.transform = translate3d;
    }

    function updateEnvironment() {
        winHeight = $window.height();
        winWidth = $window.width();
    }

    function matchMaxWidth(width) {
        if (typeof Modernizr == 'object') {
            return Modernizr.mq('(max-width:' + width + 'px)');
        } else {
            return (winWidth < width);
        }
    }

    function matchMinWidth(width) {
        if (typeof Modernizr == 'object') {
            return Modernizr.mq('(min-width:' + width + 'px)');
        } else {
            return (winWidth > width);
        }
    }

    $window.on("resize orientationchange", $.debounce(200, function() {
        updateEnvironment();
        wpadminbar.init();
        stickyNavbar.refresh();
        popoverPosition();
        moveCourseSidebar();
        layouts.init();
        stickyFooter();
    }));

    return self;

})(jQuery);
