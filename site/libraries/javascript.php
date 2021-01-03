<?php
/**
* @title		Minitek Slider
* @copyright	Copyright (C) 2011-2021 Minitek, All rights reserved.
* @license		GNU General Public License version 3 or later.
* @author url	https://www.minitek.gr/
* @developers	Minitek.gr
*/

defined('_JEXEC') or die('Restricted access');

class MinitekSliderLibJavascript
{
	public function loadSliderJavascript($slider_params, $widgetID)
	{
		$document = JFactory::getDocument();

		$javascript = "
			;(function($) {
				$(function() {
		";

			$javascript .= $this->initializeSlider($slider_params, $widgetID);

			// Progress bar
			if ($slider_params['slider_progressbar'])
			{
				$javascript .= $this->initializeProgressBar($widgetID);
			}

			// Media slider
			if ($slider_params['slider_theme'] == 'media_slider')
			{
				$javascript .= $this->initializeMediaSlider($widgetID);
			}

			// Hover box
			if ($slider_params['slider_hb'])
			{
				$javascript .= $this->initializeHoverBox($slider_params['slider_hb_effect'], $widgetID);
			}

		$javascript .= "
				})
			})(jQuery);	
		";

		//$document->addScriptDeclaration($javascript);
		$document->addCustomTag('<script type="text/javascript">'.$javascript.'</script>');
	}

	public function initializeSlider($slider_params, $widgetID)
	{
		$draggable = $slider_params['slider_drag'];
		if ($draggable) {
			$draggable = "'>1'";
		} else {
			$draggable = 'false';
		}

		$freeScroll = $slider_params['slider_free_scroll'];
		if ($freeScroll) {
			$freeScroll = 'true';
		} else {
			$freeScroll = 'false';
		}

		$wrapAround = $slider_params['slider_rewind'];
		if ($wrapAround && !$load_more) {
			$wrapAround = 'true';
		} else {
			$wrapAround = 'false';
		}

		$fullscreen = $slider_params['slider_fullscreen'];
		if ($fullscreen) {
			$fullscreen = 'true';
		} else {
			$fullscreen = 'false';
		}

		$adaptiveHeight = $slider_params['slider_adaptive_height'];
		if ($adaptiveHeight) {
			$adaptiveHeight = 'true';
		} else {
			$adaptiveHeight = 'false';
		}

		if (!isset($slider_params['slider_drag_threshold']) || !$slider_params['slider_drag_threshold'])
		{
			$slider_params['slider_drag_threshold'] = 3;
		}

		$dragThreshold = (int)$slider_params['slider_drag_threshold'];

		if (!isset($slider_params['slider_selected_attraction']) || !$slider_params['slider_selected_attraction'])
		{
			$slider_params['slider_selected_attraction'] = 0.025;
		}

		$selectedAttraction = $slider_params['slider_selected_attraction'];

		if (!isset($slider_params['slider_friction']) || !$slider_params['slider_friction'])
		{
			$slider_params['slider_friction'] = 0.28;
		}

		$friction = $slider_params['slider_friction'];

		if (!isset($slider_params['slider_free_scroll_friction']) || !$slider_params['slider_free_scroll_friction'])
		{
			$slider_params['slider_free_scroll_friction'] = 0.075;
		}

		$freeScrollFriction = $slider_params['slider_free_scroll_friction'];
		$cellAlign = $slider_params['slider_cell_align'];

		$contain = $slider_params['slider_contain'];
		if ($contain) {
			$contain = 'true';
		} else {
			$contain = 'false';
		}

		$rightToLeft = $slider_params['slider_rtl'];
		if ($rightToLeft) {
			$rightToLeft = 'true';
		} else {
			$rightToLeft = 'false';
		}

		$prevNextButtons = $slider_params['slider_arrows'];
		if ($prevNextButtons) {
			$prevNextButtons = 'true';
		} else {
			$prevNextButtons = 'false';
		}

		$pageDots = $slider_params['slider_bullets'];
		if ($pageDots) {
			$pageDots = 'true';
		} else {
			$pageDots = 'false';
		}

		$arrows_color = $slider_params['slider_arrows_color'];
		$site_path = JURI::root();

		$javascript = "
			// Show slider
			$('#mslider_".$widgetID."').show();

			// Initialize slider
			var _slider = $('#mslider_".$widgetID."').flickity({
				draggable: ".$draggable.",
				freeScroll: ".$freeScroll.",
				wrapAround: ".$wrapAround.",
				fullscreen: ".$fullscreen.",
				adaptiveHeight: ".$adaptiveHeight.",
				hash: false,
				dragThreshold: ".$dragThreshold.",
				selectedAttraction: ".$selectedAttraction.",
				friction: ".$friction.",
				freeScrollFriction: ".$freeScrollFriction.",
				imagesLoaded: true,
				cellSelector: '.mslider-item',
				initialIndex: 0,
				accessibility: true,
				setGallerySize: true,
				resize: true,
				cellAlign: '".$cellAlign."',
				contain: ".$contain.",
				rightToLeft: ".$rightToLeft.",
				percentPosition: true,
				prevNextButtons: ".$prevNextButtons.",
				pageDots: ".$pageDots.",
				on: {
					ready: function() {
						$('#mslider_".$widgetID."').addClass('flickity-ready');
					},
			  	}
			});
		";

		return $javascript;
	}

	public function initializeProgressBar($widgetID)
	{
		$javascript = "
			var _progressBar = $('#mslider_progressbar_".$widgetID."');
			_slider.on( 'scroll.flickity', function( event, progress ) {
				progress = Math.max( 0, Math.min( 1, progress ) );
				_progressBar.width( progress * 100 + '%' );
			});
		";

		return $javascript;
	}

	public function initializeMediaSlider($widgetID)
	{
		$javascript = "
			$('#mslider_".$widgetID." .mslider-media-db').insertAfter('#mslider_".$widgetID." .flickity-viewport');

			$('#mslider_".$widgetID." .mslider-media-db .mslider-detail-box').each(function(index){
				$(this).attr('data-selectedindex', index);
			});

			$('#mslider_".$widgetID." .mslider-media-db .mslider-detail-box[data-selectedindex=\"0\"]').show();

			_slider.on( 'select.flickity', function(event, index) {
				$('#mslider_".$widgetID." .mslider-media-db .mslider-detail-box').hide();
				$('#mslider_".$widgetID." .mslider-media-db .mslider-detail-box[data-selectedindex=\"'+ index +'\"]').show();
			})
		";

		return $javascript;
	}

	public function initializeHoverBox($hoverBoxEffect, $widgetID)
	{
		$javascript = "
			// Hover effects
			var hoverBoxEffect = '".$hoverBoxEffect."';

			// Hover box trigger
			var triggerHoverBox = function triggerHoverBox() 
			{
				// Hover effects
				$('#mslider_".$widgetID."').on( 'mouseenter', '.mslider-item', function(e)
				{
					if (hoverBoxEffect == 'no') 
					{
						$(this).find('.mslider-hover-box').stop().addClass('hoverShow');
					}
					else if (hoverBoxEffect == '1') 
					{
						$(this).find('.mslider-hover-box').stop().addClass('hoverFadeIn');
					}
					else if (hoverBoxEffect == '2') 
					{
						$(this).stop().addClass('perspective');
						$(this).find('.mslider-item-outer-cont').stop().addClass('flip flipY hoverFlipY');
					}
					else if (hoverBoxEffect == '3') 
					{
						$(this).stop().addClass('perspective');
						$(this).find('.mslider-item-outer-cont').stop().addClass('flip flipX hoverFlipX');
					}
					else if (hoverBoxEffect == '4') 
					{
						$(this).find('.mslider-hover-box').stop().addClass('animated slideInRight');
					}
					else if (hoverBoxEffect == '5') 
					{
						$(this).find('.mslider-hover-box').stop().addClass('animated slideInLeft');
					}
					else if (hoverBoxEffect == '6') 
					{
						$(this).find('.mslider-hover-box').stop().addClass('animated slideInTop');
					}
					else if (hoverBoxEffect == '7') 
					{
						$(this).find('.mslider-hover-box').stop().addClass('animated slideInBottom');
					}
					else if (hoverBoxEffect == '8') 
					{
						$(this).find('.mslider-hover-box').stop().addClass('animated msliderzoomIn');
					}
				});

				$('#mslider_".$widgetID."').on( 'mouseleave', '.mslider-item', function(e)
				{
					if (hoverBoxEffect == 'no') 
					{
						$(this).find('.mslider-hover-box').stop().removeClass('hoverShow');
					}
					else if (hoverBoxEffect == '1') 
					{
						$(this).find('.mslider-hover-box').stop().removeClass('hoverFadeIn');
					}
					else if (hoverBoxEffect == '2') 
					{
						$(this).find('.mslider-item-outer-cont').stop().removeClass('hoverFlipY');
					}
					else if (hoverBoxEffect == '3') 
					{
						$(this).find('.mslider-item-outer-cont').stop().removeClass('hoverFlipX');
					}
					else if (hoverBoxEffect == '4') 
					{
						$(this).find('.mslider-hover-box').stop().removeClass('slideInRight');
					}
					else if (hoverBoxEffect == '5') 
					{
						$(this).find('.mslider-hover-box').stop().removeClass('slideInLeft');
					}
					else if (hoverBoxEffect == '6') 
					{
						$(this).find('.mslider-hover-box').stop().removeClass('slideInTop');
					}
					else if (hoverBoxEffect == '7') 
					{
						$(this).find('.mslider-hover-box').stop().removeClass('slideInBottom');
					}
					else if (hoverBoxEffect == '8') 
					{
						$(this).find('.mslider-hover-box').stop().removeClass('msliderzoomIn');
					}
				});
			};

			triggerHoverBox();
		";

		return $javascript;
	}
}
