(function($){


    function add_minus_plus_if_missing()
    {

        //bc atc on some themes unable to add the class .bc-atc-qty, .bc-atc-qty-input to the input box
        //thus, we check if the input box has those classes, if not, add the classes
        var rawQuantityBox = $('.bc-uatc-custom-qty-container .quantity .qty');
        if (!rawQuantityBox.hasClass('bc-atc-qty') || !rawQuantityBox.hasClass('bc-atc-qty-input'))
        {
            rawQuantityBox.addClass('bc-atc-qty bc-atc-qty-input');

            if (typeof bc_uatc_settings !== 'undefined' && bc_uatc_settings.hideQtyInputArrows === 'true')
            {
                console.log('hide the arrows');
                rawQuantityBox.addClass('bc-atc-text-input')
            }
        }

        console.log(rawQuantityBox.siblings('.bc-atc-qty').length);

        if (bc_uatc_settings.displayAddMinus === "true" && rawQuantityBox.siblings('.bc-atc-qty').length == 0)
        {
            rawQuantityBox.wrap('<div style="display: flex; align-items: center;" class="bc-atc-qty-container"></div>');

            console.log('adding plus and minus');
            $('<span class="bc-atc-qty bc-atc-qty-changer bc-atc-qty-decrease">-</span>').insertBefore(rawQuantityBox);
            $('<span class="bc-atc-qty bc-atc-qty-changer bc-atc-qty-increase">+</span>').insertAfter(rawQuantityBox);
        }



        rawQuantityBox.parent().css('display', 'flex');

    }

    $(function(){


        //add the icons on load
        add_minus_plus_if_missing();


        //add the minus and add icon to the cart page
        $(document.body).on('updated_cart_totals', function(){
            //add the icons on load
            add_minus_plus_if_missing();

        });

        //enable ajax add to cart on product page
        $('.single-product .single_add_to_cart_button').on('click', function(e){
            if (bc_uatc_settings.enableAjaxProductPage === "true")
            {
                console.log('prevent adding the product to cart by default. Add it via ajax');
                e.preventDefault();
                //get the product ID
                var product_id = 0;

                //if the product is a simple product, it should have a value attribute
                var id_in_value = parseInt($(this).attr('value'));

                if (isNaN(id_in_value) || id_in_value == 0)
                {
                    //continue to search for product id
                    var id_in_hidden_input = parseInt($(this).closest('form').find('input[name=variation_id]').val());

                    if (isNaN(id_in_hidden_input) || id_in_hidden_input == 0)
                    {
                        //submit the form since we cannot find the product ID
                        $(this).closest('form').submit();
                        return;
                    } else
                    {
                        product_id = id_in_hidden_input;

                    }

                } else
                {
                    product_id = id_in_value;
                }

                //done finding product id, now find quantity
                var quantity = parseInt($(this).closest('form').find('.quantity input.qty').val());

                if (isNaN(quantity) || quantity == 0)
                    return;

                var button = $(this);
                button.addClass('loading');

                //now, send the request to add product to cart
                $.post(bc_uatc_settings.ajaxurl, {
                    action: 'bc_atc_add_product',
                    product_id: product_id,
                    quantity: quantity
                }, function(response){
                    console.log(response);
                    button.removeClass('loading');
                    button.addClass('added');

                    $(document.body).trigger('wc_fragment_refresh');

                    setTimeout(function(){

                        button.removeClass('added');
                    }, 1000);
                });



            }
        })






        //function for the add and subtract quantity button
        $(document).on('click', '.bc-atc-qty-decrease', function(){
            let quantityBox = $(this).closest('.quantity').find('.bc-atc-qty-input').first();
            let currentQuantity = isNaN( parseInt(quantityBox.val()) ) ? 0 : parseInt(quantityBox.val());
            if (quantityBox.val() > 1)
                quantityBox.val(currentQuantity - 1);

            //trigger the change to udpate on cart page
            quantityBox.trigger("change");
        });

        //function for the add and subtract quantity button
        $(document).on('click', '.bc-atc-qty-increase', function(){
            let quantityBox = $(this).closest('.quantity').find('.bc-atc-qty-input').first();
            let currentQuantity = isNaN( parseInt(quantityBox.val()) ) ? 0 : parseInt(quantityBox.val());
            let max = parseInt(quantityBox.attr('max'));

            if (Number.isInteger(max))
            {
                if (quantityBox.val() < max)
                {
                    quantityBox.val(currentQuantity + 1);
                }
            } else
            {
                quantityBox.val(currentQuantity + 1);
            }

            //trigger the change to udpate on cart page
            quantityBox.trigger("change");

        });


    });

})(jQuery);

//# sourceMappingURL=frontend-bundle.js.map