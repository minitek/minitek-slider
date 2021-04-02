(function (document) {
	'use strict';

	function checkSliderRadio()
	{
		var slider_radio_input_checked = document.querySelector('.slider-radio-input:checked');

		if (slider_radio_input_checked)
		{
			slider_radio_input_checked.closest('.slider-radio').classList.add('active');
		}
		
		var slider_radio_inputs = document.querySelectorAll('.slider-radio-input');

		if (slider_radio_inputs)
		{
			slider_radio_inputs.forEach(function(a)
			{
				a.addEventListener('change', function ()
				{
					document.querySelectorAll('.slider-radio').forEach(function(b)
					{
						b.classList.remove('active');
					});

					this.setAttribute('checked', 'checked');
					this.closest('.slider-radio').classList.add('active');
				});
			});
		}
	}

	document.addEventListener('DOMContentLoaded', function () 
	{
		checkSliderRadio();
	});

})(document);
