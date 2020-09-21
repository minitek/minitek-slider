(function($) {
	$(function(){

		checkSliderRadio();

		function checkSliderRadio()
		{
			jQuery('.slider-radio-input:checked').parents('.slider-radio').addClass('active');

			jQuery('.slider-radio-input').change(function() {
				jQuery(this).parents('.controls').find('.slider-radio').removeClass('active');
			  	var checked = jQuery(this).attr('checked', true);
			  	if(checked){
					jQuery(this).parents('.slider-radio').addClass('active');
			  	}
			});
		}

	})
})(jQuery);
