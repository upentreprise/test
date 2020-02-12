(function($) {
	'use strict';

	$('.ldcr-change-review-status').on('click', function(e) {
		e.preventDefault();

		var $this = $(this);
		var $tr = $this.closest('.type-ldcr_review');
		var url = $this.attr('href');
		var action = getParameterByName('action', url);

		$.ajax({
			type: "POST",
			url: ajaxurl,
			dataType: 'json',
			data: {
				action: 'ldcr_' + action + '_review',
				post_id: getParameterByName('post', url),
				_wpnonce: getParameterByName('_wpnonce', url)
			},
			success: function(response) {
				if (response.success) {
					$tr.removeClass('status-pending status publish');
					if (action == 'approve') {
						$tr.find('.column-title>strong').html($tr.find('.row-title'));
						$tr.addClass('status-publish');
					} else if (action == 'unapprove') {
						$tr.find('.column-title>strong').append(response.data.state);
						$tr.addClass('status-pending');
					}
				}
			},
		});
	});

	$('#ldcr-btn-recount-stats').on('click', function(e) {
		e.preventDefault();
		var $btnRecount = $(this);
		$btnRecount.addClass('ldcr-loading');

		$.ajax({
			type: "POST",
			url: ajaxurl,
			dataType: 'json',
			data: {
				action: 'ldcr_recount_stats',
				ldcr_recount_nonce: $('#ldcr_recount_nonce').val()
			},
			success: function(response) {
				$btnRecount.removeClass('ldcr-loading');
			}
		});
	});

	function getParameterByName(name, url) {
	    if (!url) url = window.location.href;
	    name = name.replace(/[\[\]]/g, '\\$&');
	    var regex = new RegExp('[?&]' + name + '(=([^&#]*)|&|#|$)'),
	        results = regex.exec(url);
	    if (!results) return null;
	    if (!results[2]) return '';
	    return decodeURIComponent(results[2].replace(/\+/g, ' '));
	}

})(jQuery);
