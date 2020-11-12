<?php
/**
* @title		Minitek Slider
* @copyright	Copyright (C) 2011-2020 Minitek, All rights reserved.
* @license		GNU General Public License version 3 or later.
* @author url	https://www.minitek.gr/
* @developers	Minitek.gr
*/

namespace Joomla\Component\MinitekSlider\Site\View\Slider;

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\Language\Text;
use Joomla\CMS\MVC\View\HtmlView as BaseHtmlView;
use Joomla\CMS\MVC\View\GenericDataException;

/**
 * HTML Slider View class for the MinitekSlider component
 *
 * @since  4.0.0
 */
class HtmlView extends BaseHtmlView
{
	/**
	 * Execute and display a template script.
	 *
	 * @param   string  $tpl  The name of the template file to parse; automatically searches through the template paths.
	 *
	 * @return  mixed  A string if successful, otherwise an Error object.
	 */
	public function display($tpl = null)
 	{
  	$document = \JFactory::getDocument();
 		$this->model = $this->getModel();
 		$this->utilities = $this->model->utilities;
 		$this->params = $this->utilities->getParams('com_minitekslider');
 		$jinput = \JFactory::getApplication()->input;
 		$this->widgetID = $jinput->get('widget_id', '', 'INT');
 		$page = $jinput->get('page', '1', 'INT');

 		// Get slider parameters
 		$this->slider_params = $this->utilities->getSliderParams($this->widgetID);

 		// Get slider type
		$this->theme = $this->slider_params['slider_theme'];
		$this->suffix = $this->slider_params['slider_suffix'];
		$this->cont_padding = (int)$this->slider_params['slider_cont_padding'];
		$this->gutter = (int)$this->slider_params['slider_gutter'];
		$this->border_radius = (int)$this->slider_params['slider_border_radius'];
		$this->border = (int)$this->slider_params['slider_border'];
		$this->border_color = $this->slider_params['slider_border_color'];

		// Images
		$this->slider_images = $this->slider_params['slider_images'];
		$this->slider_image_link = true;
		if (array_key_exists('slider_image_link', $this->slider_params))
		{
			$this->slider_image_link = $this->slider_params['slider_image_link'];
		}

		// Get navigation
		$arrows = $this->slider_params['slider_arrows'];
		$this->bullets = $this->slider_params['slider_bullets'];
		$this->bullets_style = $this->slider_params['slider_bullets_style'];
		$this->progressbar = $this->slider_params['slider_progressbar'];

		if ($page === '1')
		{
			// Load css
			$document->addStyleSheet(\JURI::base().'components/com_minitekslider/assets/css/flickity.css');
			$document->addStyleSheet(\JURI::base().'components/com_minitekslider/assets/css/slider.css');
			if ($this->slider_params['slider_fullscreen'])
			{
				$document->addStyleSheet(\JURI::base().'components/com_minitekslider/assets/css/flickity.fullscreen.css');
			}

			$slider_css = $this->model->slider_css;
			$slider_css->loadResponsiveSlider($this->slider_params, $this->widgetID);
			$slider_css->loadDynamicCss($this->slider_params, $this->widgetID);

			// Load scripts
			$document->addCustomTag('<script src="'.\JURI::base().'components/com_minitekslider/assets/js/flickity.pkgd.min.js" type="text/javascript"></script>');
			if ($this->slider_params['slider_fullscreen'])
			{
				$document->addCustomTag('<script src="'.\JURI::base().'components/com_minitekslider/assets/js/flickity.fullscreen.js" type="text/javascript"></script>');
			}

			// Load lightbox
			$lightbox = false;
			if ($this->slider_params['slider_hb'] && isset($this->slider_params['slider_hb_lightbox']) && $this->slider_params['slider_hb_lightbox'] && $this->params->get('load_lightbox', true))
			{
				$lightbox = true;
				$document->addStyleSheet(\JURI::base(true).'/components/com_minitekslider/assets/lightbox/lightbox.min.css');
				$document->addCustomTag('<script src="'.\JURI::base(true).'/components/com_minitekslider/assets/lightbox/lightbox.min.js" type="text/javascript"></script>');
			}

			// Load javascript.php
			$slider_javascript = $this->model->slider_javascript;
			$slider_javascript->loadSliderJavascript($this->slider_params, $this->widgetID);
		}

 		// Detail box
		$this->detailBox = $this->slider_params['slider_db'];
		$detailBoxBackground = $this->slider_params['slider_db_bg'];
		$this->detailBoxBackground = $this->utilities->hex2RGB($detailBoxBackground, true);
		$detailBoxBackgroundOpacity = $this->slider_params['slider_db_bg_opacity'];
		$this->detailBoxBackgroundOpacity = number_format((float)$detailBoxBackgroundOpacity, 2, '.', '');
		$this->detailBoxTextColor = $this->slider_params['slider_db_color'];
		$this->detailBoxTitle = $this->slider_params['slider_db_title'];
		$this->detailBoxTitleLink = true;
		if (array_key_exists('slider_db_title_link', $this->slider_params))
		{
			$this->detailBoxTitleLink = $this->slider_params['slider_db_title_link'];
		}
		$detailBoxTitleLimit = $this->slider_params['slider_db_title_limit'];
		$this->detailBoxIntrotext = $this->slider_params['slider_db_introtext'];
		$detailBoxIntrotextLimit = $this->slider_params['slider_db_introtext_limit'];
		$detailBoxStripTags = $this->slider_params['slider_db_strip_tags'];
		$this->detailBoxDate = $this->slider_params['slider_db_date'];
		$detailBoxDateFormat = $this->slider_params['slider_db_date_format'];
		$this->detailBoxCategory = $this->slider_params['slider_db_category'];
		$this->detailBoxType = $this->slider_params['slider_db_content_type'];
		$this->detailBoxAuthor = $this->slider_params['slider_db_author'];
		$this->detailBoxHits = $this->slider_params['slider_db_hits'];
		$this->detailBoxCount = $this->slider_params['slider_db_count'];
		$this->detailBoxReadmore = $this->slider_params['slider_db_readmore'];

 		// Hover box
		$this->hoverBox = $this->slider_params['slider_hb'];
		$this->hoverBoxBg = $this->slider_params['slider_hb_bg'];
		$this->hoverBoxBgOpacity = $this->slider_params['slider_hb_bg_opacity'];
		$this->hoverBoxTextColor = $this->slider_params['slider_hb_text_color'];
		$this->hoverBoxEffect = $this->slider_params['slider_hb_effect'];
		$this->hoverBoxEffectSpeed = $this->slider_params['slider_hb_effect_speed'];
		$hoverBoxEffectEasing = $this->slider_params['slider_hb_effect_easing'];
		$this->hoverBoxTitle = $this->slider_params['slider_hb_title'];
		$hoverBoxTitleLimit = $this->slider_params['slider_hb_title_limit'];
		$this->hoverBoxIntrotext = $this->slider_params['slider_hb_introtext'];
		$hoverBoxIntrotextLimit = $this->slider_params['slider_hb_introtext_limit'];
		$hoverBoxStripTags = $this->slider_params['slider_hb_strip_tags'];
		$this->hoverBoxDate = $this->slider_params['slider_hb_date'];
		$hoverBoxDateFormat = $this->slider_params['slider_hb_date_format'];
		$this->hoverBoxCategory = $this->slider_params['slider_hb_category'];
		$this->hoverBoxType = $this->slider_params['slider_hb_type'];
		$this->hoverBoxAuthor = $this->slider_params['slider_hb_author'];
		$this->hoverBoxHits = $this->slider_params['slider_hb_hits'];
		$this->hoverBoxLinkButton = $this->slider_params['slider_hb_link'];
		$this->hoverBoxLightboxButton = false;
		if (isset($this->slider_params['slider_hb_lightbox']))
		{
			$this->hoverBoxLightboxButton = $this->slider_params['slider_hb_lightbox'];
		}

		// Hover effects
		$this->hoverEffectClass = '';
		if ($this->hoverBoxEffect == '4')
		{
			$this->hoverEffectClass = 'slideInRight';
		}
		if ($this->hoverBoxEffect == '5')
		{
			$this->hoverEffectClass = 'slideInLeft';
		}
		if ($this->hoverBoxEffect == '6')
		{
			$this->hoverEffectClass = 'slideInTop';
		}
		if ($this->hoverBoxEffect == '7')
		{
			$this->hoverEffectClass = 'slideInBottom';
		}
		if ($this->hoverBoxEffect == '8')
		{
			$this->hoverEffectClass = 'msliderzoomIn';
		}

 		// Transition styles
 		$this->animated = '';
 		if ($this->hoverBoxEffect != 'no' && $this->hoverBoxEffect != '2' && $this->hoverBoxEffect != '3')
 		{
 			$this->animated = '
 			transition: all '.$this->hoverBoxEffectSpeed.'s '.$hoverBoxEffectEasing.' 0s;
 			-webkit-transition: all '.$this->hoverBoxEffectSpeed.'s '.$hoverBoxEffectEasing.' 0s;
 			-o-transition: all '.$this->hoverBoxEffectSpeed.'s '.$hoverBoxEffectEasing.' 0s;
 			-ms-transition: all '.$this->hoverBoxEffectSpeed.'s '.$hoverBoxEffectEasing.' 0s;
 			';
 		}
 		$this->animated_flip = '';
 		if ($this->hoverBoxEffect == '2' || $this->hoverBoxEffect == '3')
 		{
 			$this->animated_flip = '
 			transition: all '.$this->hoverBoxEffectSpeed.'s '.$hoverBoxEffectEasing.' 0s;
 			-webkit-transition: all '.$this->hoverBoxEffectSpeed.'s '.$hoverBoxEffectEasing.' 0s;
 			-o-transition: all '.$this->hoverBoxEffectSpeed.'s '.$hoverBoxEffectEasing.' 0s;
 			-ms-transition: all '.$this->hoverBoxEffectSpeed.'s '.$hoverBoxEffectEasing.' 0s;
 			';
 		}

 		// Hover box background
 		$this->hb_bg_class = $this->utilities->hex2RGB($this->hoverBoxBg, true);
 		$this->hb_bg_opacity_class = number_format((float)$this->hoverBoxBgOpacity, 2, '.', '');

 		// Hover box text color
 		if ($this->hoverBoxTextColor == '1') {
 			$this->hoverTextColor = 'dark-text';
 		} else {
 			$this->hoverTextColor = 'light-text';
 		}

		// Get Slider
		if ($page === '1')
		{
			$this->slider = $this->model->getItems($this->widgetID);
		}
		else
		{
			$this->slider = $this->model->getItemsAjax($this->widgetID);
		}

		if (!$this->slider)
		{
			return;
		}

		// Create display params
		$detailBoxParams = array();
		$detailBoxParams['images'] = $this->slider_images;
		$detailBoxParams['crop_images'] = false;
		$detailBoxParams['detailBoxTitleLimit'] = $detailBoxTitleLimit;
		$detailBoxParams['detailBoxIntrotextLimit'] = $detailBoxIntrotextLimit;
		$detailBoxParams['detailBoxStripTags'] = $detailBoxStripTags;
		$detailBoxParams['detailBoxDateFormat'] = $detailBoxDateFormat;

		$hoverBoxParams = array();
		$hoverBoxParams['hoverBox'] = $this->hoverBox;
		$hoverBoxParams['hoverBoxTitle'] = $this->hoverBoxTitle;
		$hoverBoxParams['hoverBoxTitleLimit'] = $hoverBoxTitleLimit;
		$hoverBoxParams['hoverBoxIntrotext'] = $this->hoverBoxIntrotext;
		$hoverBoxParams['hoverBoxIntrotextLimit'] = $hoverBoxIntrotextLimit;
		$hoverBoxParams['hoverBoxStripTags'] = $hoverBoxStripTags;
		$hoverBoxParams['hoverBoxDate'] = $this->hoverBoxDate;
		$hoverBoxParams['hoverBoxDateFormat'] = $hoverBoxDateFormat;

 		// Get widget with display options
 		$this->slider = $this->model->getDisplayOptions($this->widgetID, $this->slider, $detailBoxParams, $hoverBoxParams);

		// Display Slider
		if (!$this->slider || $this->slider == '' || $this->slider == 0)
		{
			$output = '<div class="mslider-results-empty-results">';
			$output .= '<span>'.\JText::_('COM_MINITEKSLIDER_NO_ITEMS').'</span>';
			$output .= '</div>';
			echo $output;
		}
		else
		{
			// Check for errors.
			if (count($errors = $this->get('Errors')))
			{
				throw new GenericDataException(implode("\n", $errors), 500);

 				return false;
			}

 			if ($page === '1')
 			{
				// Set page meta data
 				$this->setPageMeta($this->slider_params, $this->params);

				// Set layout
				$layout = $this->slider_params['slider_layout'];

				if ($layout)
				{
					$this->setLayout($layout);
					$viewName = $jinput->get('view', 'slider', 'WORD');
					$layoutTemplate = $this->getLayoutTemplate(); // This is empty if the override has the name 'default'. Does not work for modules.
					$this->addTemplatePath(JPATH_SITE.'/templates/'.$layoutTemplate.'/html/com_minitekslider/'.$viewName);
				}
 			}

 			parent::display($tpl);
 		}
 	}

 	public function setPageMeta($slider_params, $params)
 	{
 		$document = \JFactory::getDocument();
 		$app = \JFactory::getApplication();
 		$menus = $app->getMenu();
 		$menu = $menus->getActive();

 		$this->slider_page_title = false;

 		if (array_key_exists('slider_page_title', $slider_params) && $slider_params['slider_page_title'])
 		{
 			$this->slider_page_title = true;

 			if ($menu)
 			{
 				$params->def('page_heading', $params->get('page_title', $menu->title));
 			}

 			$title = $params->get('page_title', '');

 			// Check for empty title and add site name if param is set
 			if (empty($title))
 			{
 				$title = $app->get('sitename');
 			}
 			elseif ($app->get('sitename_pagetitles', 0) == 1)
 			{
 				$title = JText::sprintf('JPAGETITLE', $app->get('sitename'), $title);
 			}
 			elseif ($app->get('sitename_pagetitles', 0) == 2)
 			{
 				$title = JText::sprintf('JPAGETITLE', $title, $app->get('sitename'));
 			}

 			$document->setTitle($title);

 			if ($params->get('menu-meta_description'))
 			{
 				$document->setDescription($params->get('menu-meta_description'));
 			}

 			if ($params->get('menu-meta_keywords'))
 			{
 				$document->setMetadata('keywords', $params->get('menu-meta_keywords'));
 			}

 			if ($params->get('robots'))
 			{
 				$document->setMetadata('robots', $params->get('robots'));
 			}
 		}

 		if (isset($menu->query['option']) && $menu->query['option'] == 'com_minitekslider')
 		{
 			$title = $params->get('page_title', '');

 			// Check for empty title and add site name if param is set
 			if (empty($title))
 			{
 				$title = $app->get('sitename');
 			}
 			elseif ($app->get('sitename_pagetitles', 0) == 1)
 			{
 				$title = JText::sprintf('JPAGETITLE', $app->get('sitename'), $title);
 			}
 			elseif ($app->get('sitename_pagetitles', 0) == 2)
 			{
 				$title = JText::sprintf('JPAGETITLE', $title, $app->get('sitename'));
 			}

 			$document->setTitle($title);
 		}
 	}
}
