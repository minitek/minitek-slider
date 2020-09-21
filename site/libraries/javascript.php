<?php
/**
* @title				Minitek Slider
* @copyright   	Copyright (C) 2011-2019 Minitek, All rights reserved.
* @license   		GNU General Public License version 3 or later.
* @author url   https://www.minitek.gr/
* @developers   Minitek.gr
*/

defined('_JEXEC') or die('Restricted access');

class MinitekSliderLibJavascript
{
	public function loadSliderJavascript($slider_params, $widgetID)
	{
		$document = JFactory::getDocument();

		$javascript = "jQuery(function(){";

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

		$javascript .= "});";

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
			jQuery('#mslider_".$widgetID."').show();

			// Initialize slider
			var _slider = jQuery('#mslider_".$widgetID."').flickity({

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
			      jQuery('#mslider_".$widgetID."').addClass('flickity-ready');
			    },
			  }

			});
		";

		return $javascript;
	}

	public function initializeProgressBar($widgetID)
	{
		$javascript = "

			var _progressBar = jQuery('#mslider_progressbar_".$widgetID."');
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

			jQuery('#mslider_".$widgetID." .mslider-media-db').insertAfter('#mslider_".$widgetID." .flickity-viewport');

			jQuery('#mslider_".$widgetID." .mslider-media-db .mslider-detail-box').each(function(index){
				jQuery(this).attr('data-selectedindex', index);
			});

			jQuery('#mslider_".$widgetID." .mslider-media-db .mslider-detail-box[data-selectedindex=\"0\"]').show();

			_slider.on( 'select.flickity', function(event, index) {
				jQuery('#mslider_".$widgetID." .mslider-media-db .mslider-detail-box').hide();
				jQuery('#mslider_".$widgetID." .mslider-media-db .mslider-detail-box[data-selectedindex=\"'+ index +'\"]').show();
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
			var triggerHoverBox = function triggerHoverBox() {

				// Hover effects
				jQuery('#mslider_".$widgetID."').on( 'mouseenter', '.mslider-item', function(e)
				{
					if (hoverBoxEffect == 'no') {
						jQuery(this).find('.mslider-hover-box').stop().addClass('hoverShow');
					}
					if (hoverBoxEffect == '1') {
						jQuery(this).find('.mslider-hover-box').stop().addClass('hoverFadeIn');
					}
					if (hoverBoxEffect == '2') {
						jQuery(this).stop().addClass('perspective');
						jQuery(this).find('.mslider-item-outer-cont').stop().addClass('flip flipY hoverFlipY');
					}
					if (hoverBoxEffect == '3') {
						jQuery(this).stop().addClass('perspective');
						jQuery(this).find('.mslider-item-outer-cont').stop().addClass('flip flipX hoverFlipX');
					}
					if (hoverBoxEffect == '4') {
						jQuery(this).find('.mslider-hover-box').stop().addClass('animated slideInRight');
					}
					if (hoverBoxEffect == '5') {
						jQuery(this).find('.mslider-hover-box').stop().addClass('animated slideInLeft');
					}
					if (hoverBoxEffect == '6') {
						jQuery(this).find('.mslider-hover-box').stop().addClass('animated slideInTop');
					}
					if (hoverBoxEffect == '7') {
						jQuery(this).find('.mslider-hover-box').stop().addClass('animated slideInBottom');
					}
					if (hoverBoxEffect == '8') {
						jQuery(this).find('.mslider-hover-box').stop().addClass('animated msliderzoomIn');
					}
				});

				jQuery('#mslider_".$widgetID."').on( 'mouseleave', '.mslider-item', function(e)
				{
					if (hoverBoxEffect == 'no') {
						jQuery(this).find('.mslider-hover-box').stop().removeClass('hoverShow');
					}
					if (hoverBoxEffect == '1') {
						jQuery(this).find('.mslider-hover-box').stop().removeClass('hoverFadeIn');
					}
					if (hoverBoxEffect == '2') {
						jQuery(this).find('.mslider-item-outer-cont').stop().removeClass('hoverFlipY');
					}
					if (hoverBoxEffect == '3') {
						jQuery(this).find('.mslider-item-outer-cont').stop().removeClass('hoverFlipX');
					}
					if (hoverBoxEffect == '4') {
						jQuery(this).find('.mslider-hover-box').stop().removeClass('slideInRight');
					}
					if (hoverBoxEffect == '5') {
						jQuery(this).find('.mslider-hover-box').stop().removeClass('slideInLeft');
					}
					if (hoverBoxEffect == '6') {
						jQuery(this).find('.mslider-hover-box').stop().removeClass('slideInTop');
					}
					if (hoverBoxEffect == '7') {
						jQuery(this).find('.mslider-hover-box').stop().removeClass('slideInBottom');
					}
					if (hoverBoxEffect == '8') {
						jQuery(this).find('.mslider-hover-box').stop().removeClass('msliderzoomIn');
					}
				});

			};

			triggerHoverBox();

		";

		return $javascript;
	}
}
