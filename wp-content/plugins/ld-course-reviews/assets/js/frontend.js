(function($) {
	'use strict';

	var $newReview = $('.ldcr-new__review');

	/**
	 * Select Stars
	 */
	
	$('.ldcr-input__star')

		.on('click', function() {
			var $this = $(this);
			$newReview.slideDown();
			
			if ($this.index() === 0) {
				$this.next().click();
				return;
			}

			$this.siblings().removeClass('active');
			$this.addClass('active');
			fillStars($this);
		})

		.on('mouseenter', function() {
			if ($(this).index() !== 0) {
				fillStars($(this));
			}
		});

	$('.ldcr-input__stars').on('mouseleave', function() {
		var $activeStar = $(this).find('.active');
		if ($activeStar.length === 0) {
			$activeStar = $(this).children().eq(1);
		}
		fillStars($activeStar);
	});

	function fillStars(activeStar) {
		activeStar.addClass('filled');
		activeStar.prevAll().addClass('filled');
		activeStar.nextAll().removeClass('filled');
	}


	/**
	 * Submit review
	 */
	
	$('.ldcr-review__form').on('submit', function(e) {
		e.preventDefault();
		var $form = $(this);

		$.ajax({
            url: ldcr_js_data.ajax_url,
            type: 'POST',
            dataType: 'json',
            data: ({
                action: 'ldcr_submit_review',
                course_id: $form.data('course-id'),
                rating: $form.find('.ldcr-input__star input:checked').val(),
                review: $form.find('#ldcr-input__review').val(),
                headline: $form.find('#ldcr-input__headline').val(),
                nonce: $form.find('#ldcr_review_nonce').val(),
            }),
            beforeSend: function() {
                $form.addClass('loading');
            },
            success: function(response) {console.log(response);
                if (response.data.message) {
                    $form.siblings('.ldcr-message').html(response.data.message);
                    $form.hide();
                }
                if (response.success) {
                    if (response.data.publish) {
                        window.location.reload();
                    }
                }
            }
		})
        .always(function() {
            $form.removeClass('loading');
        });
	});


    /**
     * Load reviews page
     */
    
    var filterByStar = null;

    function loadReviews(pageNumber) {
        var $items = $('.ldcr-reviews__items');

        $('html,body').animate({ scrollTop: $items.offset().top - 200 }, 400);

        $.ajax({
            url: ldcr_js_data.ajax_url,
            type: 'POST',
            dataType: 'json',
            data: ({
                action: 'ldcr_load_reviews',
                count: $items.data('count'),
                course_id: $items.data('course-id'),
                page_number: pageNumber,
                filter_by_star: filterByStar,
            }),
            beforeSend: function() {
                $items.parent().addClass('loading');
                $items.siblings('.ldcr-reviews__pagination').remove();
            },
            success: function(response) {
                if (response.success) {
                    if (response.data.items) {
                        $items.html(response.data.items);
                    }
                    if (response.data.pagination) {
                        $items.after(response.data.pagination);
                    }
                } else {
                    if (response.data.message) {
                        $items.html(response.data.message);
                    }
                }
            }
        })
        .always(function() {
            $items.parent().removeClass('loading');
        });
    }

    $(document.body).on('click', '.ldcr-stats__row:not(.disabled)', function(e) {
        e.preventDefault();
        var $row = $(this);
        if ('ldcr-clear' == e.target.className) {
            filterByStar = null;
            $row.removeClass('active inactive');
            $row.siblings().removeClass('active inactive');
        } else {
            filterByStar = $row.data('filter');
            $row.removeClass('inactive').addClass('active');
            $row.siblings().addClass('inactive');
            $row.siblings().removeClass('active');
        }
        loadReviews(1);
    })

    .on('click.ldcr_page', '.ldcr-page-number', function(e) {
        e.preventDefault();
        var $button = $(this);
        var pageNumber = $button.data('page');
        var totalPages = $button.siblings().length - 1;

        if (pageNumber == 'prev') {
            var $current = $button.siblings('.current');
            if ($current.data('page') == 2) {
                pageNumber = 1;
            } else {
                pageNumber = $current.prev().data('page');
            }
        }
        else if (pageNumber == 'next') {
            var $current = $button.siblings('.current');
            if ($current.data('page') == totalPages - 1) {
                pageNumber = totalPages;
            } else {
                pageNumber = $current.next().data('page');
            }
        }
        loadReviews(pageNumber);
    })


    /**
     * Vote
     */

    .on('click', '.ldcr-btn-vote:not(.disabled)', function(e) {
        e.preventDefault();

        var $button = $(this);
        // disable click if processing request
        $button.addClass('disabled');
        $button.siblings('.ldcr-btn-vote').addClass('disabled');
        // load url if not logged-in
        if (!$(document.body).hasClass('logged-in')) {
            window.location = $button.attr('href');
        }

        var $message = $button.siblings('.ldcr-message');
        var action = $button.data('action');
        var id = $button.parents('.ldcr-review__item').data('id');

        $.ajax({
            url: ldcr_js_data.ajax_url,
            type: 'POST',
            dataType: 'json',
            data: ({
                action: 'ldcr_vote_review',
                id: id,
                vote: action,
                nonce: $('#ldcr_vote_nonce').val(),
            }),
            beforeSend: function() {
                if (action != 'undo') {
                    $button.parent().addClass('sending');
                    $message.html(ldcr_js_data.sending_feedback);
                }
            },
            success: function(response) {
                $button.parent().removeClass('sending');
  
                if (response.success) {
                    if (response.data.vote == 'undo') {
                        $button.parent().removeClass('upvoted downvoted');
                        if ($button.hasClass('ldcr-upvote')) {
                            $button.data('action', 'up');
                            $button.removeClass('disabled');
                            $button.siblings('.ldcr-btn-vote').data('action', 'down');
                            $button.siblings('.ldcr-btn-vote').removeClass('disabled');
                        }
                        if ($button.hasClass('ldcr-downvote')) {
                            $button.data('action', 'down');
                            $button.removeClass('disabled');
                            $button.siblings('.ldcr-btn-vote').data('action', 'up');
                            $button.siblings('.ldcr-btn-vote').removeClass('disabled');
                        }
                    } else if (response.data.vote == 'up') {
                        $button.parent().find('.ldcr-btn-vote').remove();
                    } else if (response.data.vote == 'down') {
                        $button.parent().find('.ldcr-btn-vote').remove();
                    }
                }

                if (response.data.message) {
                    $message.html(response.data.message);
                } else {
                    $message.empty();
                }
            }
        });
    });


})(jQuery);
