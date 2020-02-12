(function(window, $) {

    $(document).ready(function() {
        if($('.pda-tooltip')) {
            $('.pda-tooltip').tooltip({
                position: {
                    // at: "center top"
                    my: "center bottom-10",
                    at: "center top",
                }
            });
        }
	    $("body").on("click", "#pda_gold_signup_newsletter", _pda_gold_signup_newsletter_cb);
    });
    $('#pda_free_options').submit(function(evt) {
        evt.preventDefault();
        const title_page = $("#title_page_404_input").val();
        if(title_page !== "") {
            $(".selected_page").text("Selected page: ");
            $("#remove_page").show();
            $('.remove-no-access-page').show();
            $(".no-access-selected-page-title").text(title_page);
            $(".no-access-selected-page-label").text('Selected page: ');
            $(".value_page").text(title_page);
        }
        _updateSettingsGeneral({
            enable_image_hot_linking: $("#enable_image_hot_linking").prop('checked') ? 'on' : 'off',
            enable_directory_listing: $("#enable_directory_listing").prop('checked') ? 'on' : 'off',
            search_result_page_404: $("#search_page_404_input").val(),
        }, function(error) {
            if(error) {
                console.error(error);
            }
        });
    });

    function _updateSettingsGeneral(settings, cb){
        var _data = {
            action: 'pda_lite_update_general_settings',
            settings: settings,
            security_check: $("#nonce_pda_v3").val(),
        }
        $('#summit').val('Submiting');
        $("#submit").prop("disabled", true);
        $.ajax({
            url: ajax_object.ajax_url,
            type: 'POST',
            data: _data,
            success: function(data) {
                $("#submit").prop("disabled", false);
                //Do something with the result from server
                if (data === 'invalid_nonce') {
                    alert('No! No! No! Verify Nonce Fails!');
                } else if(data) {
                    //success here
                    console.log("Success", data);
                    toastr.success('Your settings have been updated successfully!', 'Prevent Direct Access Lite')
                } else {
                    console.log("Failed", data);
                }
                cb();
            },

            error: function(error) {
                $("#submit").prop("disabled", false);
                console.log("Errors", error);
                cb(error);
            },
            timeout: 5000
        });
    }

    function _pda_gold_signup_newsletter_cb(evt) {
	    evt.preventDefault();
	    var email = $("#pda_gold_signup_newsletter_input").val().trim();
	    var emailPattern = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	    $("#pda_gold_signup_newsletter").val("Saving...");
	    if (email && emailPattern.test(email)) {
		    $.ajax({
			    url: newsletter_data.newsletter_url,
			    type: 'POST',
			    data: {
				    action: 'pda_free_subscribe',
				    security_check: newsletter_data.newsletter_nonce,
				    email: email
			    },
			    success: function (data) {
				    $(".pda_sub_form").hide();
				    $(".newsletter_inform").show("slow");
				    console.log("Success", data);
				    $("#pda_gold_signup_newsletter").val("Get Lucky");
			    },
			    error: function (error) {
				    $(".pda_sub_form").hide();
				    $(".newsletter_inform").show("slow");
				    $("#pda_gold_signup_newsletter").val("Get Lucky");
			    }
		    });
	    } else {
		    $("#pda_signup_newsletter_error").show("slow");
		    $("#pda_signup_newsletter").focus();
		    $("#pda_gold_signup_newsletter").val("Get Lucky");
	    }
    }

})(window, jQuery);


