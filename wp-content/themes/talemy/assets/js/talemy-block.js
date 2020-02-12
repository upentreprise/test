(function(global, $) {
    'use strict';

    var Talemy_Block = function(element) {
        return new Talemy_Block.init(element);
    };

    // arrange tabs according to block width
    Talemy_Block.prototype.arrangeTabs = function() {
        var header = this.wrapper.find('.block-header');
        var title = header.find('.sf-heading');
        var more = header.find('.more-tabs');
        var dropdown = header.find('.tabs-dropdown');
        var overflow = this.tabWrapper.width() + more.outerWidth() - header.width();

        if ($(window).width() > 600) {
            overflow = overflow + title.width() + 30;
        }

        if (overflow > 0) {
            // move items to dropdown
            for (var j = this.tabWrapper.children().length - 1; j >= 0; j--) {
                overflow -= this.tabWrapper.children().last().outerWidth();
                dropdown.prepend(this.tabWrapper.children().last());
                if (overflow < 0 || overflow === 0) {
                    break;
                }
            }
            more.css('display', 'inline-block');

        } else if (overflow < 0 && dropdown.children().length) {
            // move items to tabs list
            for (var k = dropdown.children().length - 1; k >= 0; k--) {
                overflow += dropdown.children().first().outerWidth();
                if (overflow < 0) {
                    this.tabWrapper.append(dropdown.children().first());
                } else {
                    break;
                }
            }
            // hide more button when there's no dropdown item
            if (dropdown.children().length === 0) {
                more.hide();
            }
        }
        this.tabWrapper.css('visibility', 'visible');
    };

    // load tab content
    Talemy_Block.prototype.loadTabContent = function(actionType) {
        var self = this;
        self.contentWrapper.removeClass('block-animated-short block-anim-fadeindown block-anim-fadeinleft block-anim-fadeinright');
        self.contentWrapper.css('min-height', self.contentWrapper.height() + 'px');

        if (typeof self.cache[self.currentTabID] !== 'undefined' && typeof self.cache[self.currentTabID][self.page[self.currentTabID]] !== 'undefined') {
            self.contentWrapper.html(self.cache[self.currentTabID][self.page[self.currentTabID]]);
            self.contentWrapper.imagesLoaded(function() {
                self.contentWrapper.find('.equal-height').matchHeight();
                self.animateContent(actionType);
                self.contentWrapper.css('min-height','');
            });
            self.updateNextPrev();
            self.updateLoadMore();
            if (self.loadMoreScroll.length) {
                self.loadOnScroll();
            }
            self.processing = false;
        } else {
            $.ajax({
                url: talemy_js_data.ajax_url,
                type: 'POST',
                dataType: 'json',
                data: ({
                    action: 'talemy_block_ajax_posts',
                    action_type: actionType,
                    atts: self.settings.atts,
                    block_id: self.settings.block_id,
                    page_number: self.page[self.currentTabID],
                    query_args: self.settings.query_args,
                    tab_id: self.currentTabID,
                }),
                beforeSend: function() {
                    self.wrapper.addClass('block-loading');
                },
                success: function(data) {

                    if ('tab' == actionType) {
                        self.page[self.currentTabID] = 0;
                        self.cache[self.currentTabID] = {};
                        self.maxPageNumber[self.currentTabID] = {};

                        if (self.settings.atts.pagination == 'next_prev') {
                            self.maxPageNumber[self.currentTabID] = Math.ceil(data.found_posts / self.settings.atts.count) - 1;
                        } else {
                            self.maxPageNumber[self.currentTabID] = Math.ceil((data.found_posts - self.settings.atts.count) / self.settings.atts.ppl );
                        }
                    }

                    if (data.html) {
                        var innerData = $(data.html).html();
                        self.contentWrapper.html(innerData);
                        self.contentWrapper.imagesLoaded(function() {
                            self.contentWrapper.find('.equal-height').matchHeight();
                            self.contentWrapper.find('img').addClass('inview');
                        });
                        self.cache[self.currentTabID][self.page[self.currentTabID]] = innerData;
                    }
                    self.wrapper.removeClass('block-loading');
                    self.animateContent(actionType);
                    self.contentWrapper.css('min-height', '');
                }
            })
            .always(function() {
                self.updateNextPrev();
                self.updateLoadMore();
                if (self.loadMoreScroll.length) {
                    self.loadOnScroll();
                }
                self.processing = false;
            });
        }
    };

    // load posts
    Talemy_Block.prototype.loadPosts = function() {
        var self = this;
        var pageNumber = self.page[self.currentTabID];

        $.ajax({
            url: talemy_js_data.ajax_url,
            type: 'POST',
            dataType: 'json',
            data: ({
                action: 'talemy_block_ajax_posts',
                action_type: 'more',
                atts: self.settings.atts,
                block_id: self.settings.block_id,
                page_number: self.page[self.currentTabID],
                query_args: self.settings.query_args,
                tab_id: self.currentTabID,
            }),
            beforeSend: function() {
                self.wrapper.addClass('loading');
            },
            success: function(data) {
                if (data.html) {
                    if (self.settings.atts.list_style === '') {
                        self.wrapper.find('.block-content').append($(data.html).html());
                    } else {
                        self.wrapper.find('.block-content .post-list').append($(data.html).children().html());
                    }
                    self.wrapper.imagesLoaded(function() {
                        self.wrapper.find('.equal-height').matchHeight();
                        self.wrapper.find('img').addClass('inview');
                    });
                    self.wrapper.removeClass('loading');
                    self.cache[self.currentTabID][pageNumber] = self.wrapper.find('.block-content').html();
                }
            }
        })
        .always(function() {
            self.updateLoadMore();
            self.processing = false;

            if (self.maxPageNumber[self.currentTabID] > pageNumber && pageNumber == self.settings.atts.max_loads) {
                window.removeEventListener('scroll', self.loadOnScroll);

                $.ajax({
                    url: talemy_js_data.ajax_url,
                    type: 'POST',
                    data: ({
                        action: 'talemy_ajax_more_button',
                    }),
                    success: function(data) {
                        self.loadMoreScroll.remove();
                        self.footerWrapper.append(data);
                        self.loadMore = self.footerWrapper.find('.load-more');
                        self.loadMore.on('click', function() {
                            if (!self.processing) {
                                self.processing = true;
                                self.page[self.currentTabID] ++;
                                self.loadPosts();
                            }
                        });
                    }
                });
            }
        });
    };

    // update next/prev button status according to current page number and max number of pages
    Talemy_Block.prototype.updateNextPrev = function() {
        var self = this;

        if (this.maxPageNumber[this.currentTabID] === 0) {
            this.nextPrev.find('.prev-posts').addClass('disabled');
            this.nextPrev.find('.next-posts').addClass('disabled');
            return;
        }

        if (this.page[this.currentTabID] === 0) {
            this.nextPrev.find('.prev-posts').addClass('disabled');
        } else {
            this.nextPrev.find('.prev-posts').removeClass('disabled');
        }

        if ((this.maxPageNumber[this.currentTabID]) == this.page[this.currentTabID]) {
            this.nextPrev.find('.next-posts').addClass('disabled');
        } else {
            this.nextPrev.find('.next-posts').removeClass('disabled');
        }
    };

    // show/hide load more button according to current page number and max number of pages
    Talemy_Block.prototype.updateLoadMore = function() {
        if (this.maxPageNumber[this.currentTabID] === this.page[this.currentTabID]) {
            this.loadMore.hide();
        } else {
            this.loadMore.show();
        }
    };

    // add animation according to action type
    Talemy_Block.prototype.animateContent = function(actionType) {
        switch (actionType) {
        case 'next': this.contentWrapper.addClass('block-animated-short block-anim-fadeinleft'); break;
        case 'prev': this.contentWrapper.addClass('block-animated-short block-anim-fadeinright'); break;
        default: this.contentWrapper.addClass('block-animated-short block-anim-fadeindown'); break;
        }
    };

    Talemy_Block.init = function(element) {
        
        var self = this, settings;
        self.wrapper = $(element);

        if (self.wrapper.length === 0) {
            return;
        }

        self.settings = $(element).data('block') || {};
        self.tabWrapper = self.wrapper.find('.tabs-wrapper');
        self.contentWrapper = self.wrapper.find('.block-content:first');
        self.footerWrapper = self.wrapper.find('.block-footer');
        self.loadMore = self.wrapper.find('.load-more');
        self.nextPrev = self.wrapper.find('.load-next-prev-posts');
        self.loadMoreScroll = self.wrapper.find('.load-more-scroll');
        self.page = {};
        self.cache = {};
        self.maxPageNumber = {};
        self.currentTabID = 0;
        self.processing = false;
        self.page[0] = 0;
        self.cache[0] = {};

        if (self.contentWrapper.length) {
            // add preload content to cache
            self.cache[0][0] = self.contentWrapper.html();
        }

        if (self.tabWrapper.length) {
            // add preload content to cache
            var preloadContent = self.wrapper.find('.block-preload-content');
            if (preloadContent.length) {
                preloadContent.children().each(function(i) {
                    var tabContent = $(this);
                    var tabID = tabContent.data('content-id');
                    if (tabID) {
                        self.page[tabID] = 0;
                        self.cache[tabID] = {};
                        self.cache[tabID][0] = tabContent.html();
                        self.maxPageNumber[tabID] = tabContent.data('max-pages');
                    }
                });
                preloadContent.remove();
            }

            // bind tab click event
            self.tabWrapper.parent().on('click', '.tab-item', function(e) {
                e.preventDefault();
                if (self.processing) {
                    return false;
                }
                self.processing = true;
                self.contentWrapper.stop();
                self.wrapper.find('.tab-item.active').removeClass('active');
                var currentTab = $(this);
                currentTab.addClass('active');
                self.currentTabID = currentTab.data('tab-id');
                self.loadTabContent('tab');
            });
            self.arrangeTabs();
            self.tabWrapper.find('.tab-item').first().addClass('active');

            $(window).on('resize orientationchange', $.debounce(200, function() {
                self.arrangeTabs();
            }));
        }

        if (self.nextPrev.length) {
            self.maxPageNumber[0] = self.settings.max_num_pages - 1;
            self.updateNextPrev();

            // bind next/prev click event
            self.nextPrev.find('.next-posts').on('click', function() {
                if (self.processing || $(this).hasClass('disabled')) {
                    return;
                }
                self.processing = true;
                self.page[self.currentTabID] ++;
                self.loadTabContent('next');
                self.updateNextPrev();
            });

            self.nextPrev.find('.prev-posts').on('click', function() {
                if (self.processing || $(this).hasClass('disabled')) {
                    return;
                }
                self.processing = true;
                self.page[self.currentTabID] --;
                self.loadTabContent('prev');
                self.updateNextPrev();
            });
        }

        else if (self.loadMore.length) {
            self.maxPageNumber[0] = Math.ceil((self.settings.found_posts - self.settings.atts.count) / self.settings.atts.ppl );
            self.updateLoadMore();

            if (self.settings.atts.ppl === 0 || self.settings.atts.ppl === '') {
                self.settings.atts.ppl = 3;
            }

            // bind click more event
            self.loadMore.on('click', self.footerWrapper, function() {
                if (!self.processing) {
                    self.processing = true;
                    self.page[self.currentTabID] ++;
                    self.loadPosts();
                }
            });
        }

        else if (self.loadMoreScroll.length) {
            self.maxPageNumber[0] = Math.ceil((self.settings.found_posts - self.settings.atts.count) / self.settings.atts.ppl );

            if (self.settings.atts.ppl === 0 || self.settings.atts.ppl === '') {
                self.settings.atts.ppl = 5;
            }

            if (self.maxPageNumber[0] > self.page[0]) {
                self.loadOnScroll = $.debounce(100, function() {
                    if (!self.processing) {
                        var scrollDistance = $(window).scrollTop();
                        var scrollTop = self.footerWrapper.offset().top - $(window).height();
                        var scrollBottom = self.footerWrapper.offset().top + 200;

                        if (scrollDistance >= scrollTop && scrollDistance < scrollBottom) {
                        	if (self.maxPageNumber[self.currentTabID] !== self.page[self.currentTabID]) {
	                            self.processing = true;
	                            self.page[self.currentTabID] ++;
	                            self.loadPosts();
                        	}
                        }
                    }
                });
                // bind scroll event
                window.addEventListener('scroll', self.loadOnScroll, false);
                self.loadOnScroll();
            }
        }
    };

    Talemy_Block.init.prototype = Talemy_Block.prototype;
    global.Talemy_Block = Talemy_Block;

})(window, jQuery);