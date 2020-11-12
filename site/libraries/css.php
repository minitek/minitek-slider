<?php
/**
* @title		Minitek Slider
* @copyright	Copyright (C) 2011-2020 Minitek, All rights reserved.
* @license		GNU General Public License version 3 or later.
* @author url	https://www.minitek.gr/
* @developers	Minitek.gr
*/

defined('_JEXEC') or die('Restricted access');

class MinitekSliderLibCss
{
	public function loadResponsiveSlider($slider_params, $widgetID)
	{
		$document = JFactory::getDocument();
		$mslider = 'mslider_'.$widgetID;

		// LG
		$responsive_lg_num = (int)$slider_params['slider_responsive_lg_num'];
		$responsive_lg_width = number_format((float)(100 / $responsive_lg_num), 4, '.', '');
		$responsive_lg = (int)$slider_params['slider_responsive_lg'];
		$responsive_lg_min = $responsive_lg - 1;
		$responsive_lg_db = $slider_params['slider_responsive_lg_db'];
		$responsive_lg_db_title = $slider_params['slider_responsive_lg_db_title'];

		$lg_width = '@media only screen and (min-width:'.$responsive_lg.'px)
		{
			#'.$mslider.' .mslider-item {
				width: '.$responsive_lg_width.'%;
			}
		}';
		$document->addStyleDeclaration( $lg_width );

		if (!$responsive_lg_db)
		{
			$lg_db = '@media only screen and (min-width:'.$responsive_lg.'px)
			{
				#'.$mslider.' .mslider-detail-box {
					display: none;
				}
			}';
			$document->addStyleDeclaration( $lg_db );
		}

		if ($responsive_lg_db_title)
		{
			$lg_db_title = '@media only screen and (min-width:'.$responsive_lg.'px)
			{
				#'.$mslider.' .mslider-date,
				#'.$mslider.' .mslider-item-info,
				#'.$mslider.' .mslider-desc,
				#'.$mslider.' .mslider-hits,
				#'.$mslider.' .mslider-count,
				#'.$mslider.' .mslider-readmore {
					display: none;
				}
			}';
			$document->addStyleDeclaration( $lg_db_title );
		}

		// MD
		$responsive_md_num = (int)$slider_params['slider_responsive_md_num'];
		$responsive_md_width = number_format((float)(100 / $responsive_md_num), 4, '.', '');
		$responsive_md = (int)$slider_params['slider_responsive_md'];
		$responsive_md_min = $responsive_md - 1;
		$responsive_md_db = $slider_params['slider_responsive_md_db'];
		$responsive_md_db_title = $slider_params['slider_responsive_md_db_title'];

		$md_width = '@media only screen and (min-width:'.$responsive_md.'px) and (max-width:'.$responsive_lg_min.'px)
		{
			#'.$mslider.' .mslider-item {
				width: '.$responsive_md_width.'%;
			}
		}';
		$document->addStyleDeclaration( $md_width );

		if (!$responsive_md_db)
		{
			$md_db = '@media only screen and (min-width:'.$responsive_md.'px) and (max-width:'.$responsive_lg_min.'px)
			{
				#'.$mslider.' .mslider-detail-box {
					display: none;
				}
			}';
			$document->addStyleDeclaration( $md_db );
		}

		if ($responsive_md_db_title)
		{
			$md_db_title = '@media only screen and (min-width:'.$responsive_md.'px) and (max-width:'.$responsive_lg_min.'px)
			{
				#'.$mslider.' .mslider-date,
				#'.$mslider.' .mslider-item-info,
				#'.$mslider.' .mslider-desc,
				#'.$mslider.' .mslider-hits,
				#'.$mslider.' .mslider-count,
				#'.$mslider.' .mslider-readmore {
					display: none;
				}
			}';
			$document->addStyleDeclaration( $md_db_title );
		}

		// SM
		$responsive_sm_num = (int)$slider_params['slider_responsive_sm_num'];
		$responsive_sm_width = number_format((float)(100 / $responsive_sm_num), 4, '.', '');
		$responsive_sm = (int)$slider_params['slider_responsive_sm'];
		$responsive_sm_min = $responsive_sm - 1;
		$responsive_sm_db = $slider_params['slider_responsive_sm_db'];
		$responsive_sm_db_title = $slider_params['slider_responsive_sm_db_title'];

		$sm_width = '@media only screen and (min-width:'.$responsive_sm.'px) and (max-width:'.$responsive_md_min.'px)
		{
			#'.$mslider.' .mslider-item {
				width: '.$responsive_sm_width.'%;
			}
		}';
		$document->addStyleDeclaration( $sm_width );

		if (!$responsive_sm_db)
		{
			$sm_db = '@media only screen and (min-width:'.$responsive_sm.'px) and (max-width:'.$responsive_md_min.'px)
			{
				#'.$mslider.' .mslider-detail-box {
					display: none;
				}
			}';
			$document->addStyleDeclaration( $sm_db );
		}

		if ($responsive_sm_db_title)
		{
			$sm_db_title = '@media only screen and (min-width:'.$responsive_sm.'px) and (max-width:'.$responsive_md_min.'px)
			{
				#'.$mslider.' .mslider-date,
				#'.$mslider.' .mslider-item-info,
				#'.$mslider.' .mslider-desc,
				#'.$mslider.' .mslider-hits,
				#'.$mslider.' .mslider-count,
				#'.$mslider.' .mslider-readmore {
					display: none;
				}
			}';
			$document->addStyleDeclaration( $sm_db_title );
		}

		// XS
		$responsive_xs_num = (int)$slider_params['slider_responsive_xs_num'];
		$responsive_xs_width = number_format((float)(100 / $responsive_xs_num), 4, '.', '');
		$responsive_xs = (int)$slider_params['slider_responsive_xs'];
		$responsive_xs_min = $responsive_xs - 1;
		$responsive_xs_db = $slider_params['slider_responsive_xs_db'];
		$responsive_xs_db_title = $slider_params['slider_responsive_xs_db_title'];

		$xs_width = '@media only screen and (min-width:'.$responsive_xs.'px) and (max-width:'.$responsive_sm_min.'px)
		{
			#'.$mslider.' .mslider-item {
				width: '.$responsive_xs_width.'%;
			}
		}';
		$document->addStyleDeclaration( $xs_width );

		if (!$responsive_xs_db)
		{
			$xs_db = '@media only screen and (min-width:'.$responsive_xs.'px) and (max-width:'.$responsive_sm_min.'px)
			{
				#'.$mslider.' .mslider-detail-box {
					display: none;
				}
			}';
			$document->addStyleDeclaration( $xs_db );
		}

		if ($responsive_xs_db_title)
		{
			$xs_db_title = '@media only screen and (min-width:'.$responsive_xs.'px) and (max-width:'.$responsive_sm_min.'px)
			{
				#'.$mslider.' .mslider-date,
				#'.$mslider.' .mslider-item-info,
				#'.$mslider.' .mslider-desc,
				#'.$mslider.' .mslider-hits,
				#'.$mslider.' .mslider-count,
				#'.$mslider.' .mslider-readmore {
					display: none;
				}
			}';
			$document->addStyleDeclaration( $xs_db_title );
		}

		// XXS
		$responsive_xxs_num = (int)$slider_params['slider_responsive_xxs_num'];
		$responsive_xxs_width = number_format((float)(100 / $responsive_xxs_num), 4, '.', '');
		$responsive_xxs_db = $slider_params['slider_responsive_xxs_db'];
		$responsive_xxs_db_title = $slider_params['slider_responsive_xxs_db_title'];

		$xxs_width = '@media only screen and (max-width:'.$responsive_xs_min.'px)
		{
			#'.$mslider.' .mslider-item {
				width: '.$responsive_xxs_width.'%;
			}
		}';
		$document->addStyleDeclaration( $xxs_width );

		if (!$responsive_xxs_db)
		{
			$xxs_db = '@media only screen and (max-width:'.$responsive_xs_min.'px)
			{
				#'.$mslider.' .mslider-detail-box {
					display: none;
				}
			}';
			$document->addStyleDeclaration( $xxs_db );
		}

		if ($responsive_xxs_db_title)
		{
			$xxs_db_title = '@media only screen and (max-width:'.$responsive_xs_min.'px)
			{
				#'.$mslider.' .mslider-date,
				#'.$mslider.' .mslider-item-info,
				#'.$mslider.' .mslider-desc,
				#'.$mslider.' .mslider-hits,
				#'.$mslider.' .mslider-count,
				#'.$mslider.' .mslider-readmore {
					display: none;
				}
			}';
			$document->addStyleDeclaration( $xxs_db_title );
		}

	}

	public function loadDynamicCss($slider_params, $widgetID)
	{
		$document = JFactory::getDocument();
		$mslider_wrapper = 'mslider_wrapper_'.$widgetID;
		$mslider = 'mslider_'.$widgetID;
		$mslider_nav = 'mslider_nav_'.$widgetID;

		// Container background color
		$container_bg = $slider_params['slider_cont_bg'];
		if ($container_bg)
		{
			$container_bg_css = '
				#'.$mslider_wrapper.' {
					background-color: '.$container_bg.';
				}
			';
			$document->addStyleDeclaration( $container_bg_css );
		}

		// Container background image
		$container_image = $slider_params['slider_cont_image'];
		if ($container_image)
		{
			$container_image_css = '
				#'.$mslider_wrapper.' {
					background-image: url("'.JURI::base().$container_image.'");
					background-size: cover;
				}
			';
			$document->addStyleDeclaration( $container_image_css );
		}

		// Fullscreen background color
		$fullscreen_bg = $slider_params['slider_fullscreen_bg'];
		if ($fullscreen_bg)
		{
			$fullscreen_bg_css = '
				#'.$mslider_wrapper.'.is-fullscreen {
					background-color: '.$fullscreen_bg.';
				}
			';
			$document->addStyleDeclaration( $fullscreen_bg_css );
		}

		// Fullscreen background image
		$fullscreen_image = $slider_params['slider_fullscreen_image'];
		if ($fullscreen_image)
		{
			$fullscreen_image_css = '
				#'.$mslider_wrapper.'.is-fullscreen {
					background-image: url("'.JURI::base().$fullscreen_image.'");
					background-size: cover;
				}
			';
			$document->addStyleDeclaration( $fullscreen_image_css );
		}

		// Detail box border-radius
		$border_radius = (int)$slider_params['slider_border_radius'];
		if ($border_radius)
		{
			$border_radius_css = '
				#'.$mslider.'.mslider_image_slider .mslider-detail-box,
				#'.$mslider.'.mslider_media_slider .mslider-detail-box {
					border-radius: '.$border_radius.'px;
				}
			';
			$document->addStyleDeclaration( $border_radius_css );
		}

		// Arrows / Fullscreen button color
		$arrows_color = $slider_params['slider_arrows_color'];
		$arrows_color_css = '
			#'.$mslider.' .flickity-prev-next-button,
			#'.$mslider_nav.' .flickity-prev-next-button,
			#'.$mslider.' .flickity-fullscreen-button {
				color: '.$arrows_color.';
			}
		';
		$document->addStyleDeclaration( $arrows_color_css );

		// Bullets color
		$bullets_color = $slider_params['slider_bullets_color'];
		$bullets_color_css = '
			#'.$mslider.' .flickity-page-dots .dot {
				background: '.$bullets_color.';
			}
		';
		$document->addStyleDeclaration( $bullets_color_css );

		// Progress bar color
		$progressbar_color = $slider_params['slider_progressbar_color'];
		$progressbar_color_css = '
			#mslider_progressbar_'.$widgetID.' {
				background: '.$progressbar_color.';
			}
		';
		$document->addStyleDeclaration( $progressbar_color_css );
	}
}
