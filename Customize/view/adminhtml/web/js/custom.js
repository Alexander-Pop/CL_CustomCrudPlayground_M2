require(
    [
        'jquery'
    ],
    function ($) {
    	var interval = setInterval(intervalJs, 2000);

        function intervalJs() {
    		if($('[name="product[is_customize]"]').length >= 1 ) {
                clearInterval(interval);

                $('#save-button').click(function() {
                    if($('.tableBody').find('input').hasClass('mage-error')) {
                        $('[name="product[is_customize]"]').attr('disabled', 'true');
                    } else {
                        $('[name="product[is_customize]"]').removeAttr('disabled');
                    }
                });

    			if($('[name="product[is_customize]"]').val() == 0) {
                    console.log('in is_customize == 0');
	    			$('.fildset_visibility').css('display', 'none');
    			}
          }

            $('[name="product[is_customize]"]').change(function() {
                console.log($('[name="product[is_customize]"]').val());
                if($('[name="product[is_customize]"]').val() == 0 && $('.fildset_visibility').length >= 1 && $('.fildset_visibility').css('display') == 'block') {
                    console.log('in if');
                    $('.fildset_visibility').css('display', 'none');
                } else if($('[name="product[is_customize]"]').val() == 1 && $('.fildset_visibility').css('display') == 'none'){
                    console.log('in else');
                    $('.fildset_visibility').css('display', 'block');
                }
            });
        }
    }
);
