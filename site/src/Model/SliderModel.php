<?php

/**
 * @title		Minitek Slider
 * @copyright	Copyright (C) 2011-2020 Minitek, All rights reserved.
 * @license		GNU General Public License version 3 or later.
 * @author url	https://www.minitek.gr/
 * @developers	Minitek.gr
 */

namespace Joomla\Component\MinitekSlider\Site\Model;

defined('_JEXEC') or die;

use Joomla\CMS\Component\ComponentHelper;
use Joomla\CMS\Factory;
use Joomla\CMS\MVC\Model\BaseDatabaseModel;

/**
 * MinitekSlider Component Slider Model
 *
 * @since  4.0.0
 */
class SliderModel extends BaseDatabaseModel
{
	var $utilities = null;
	var $source = null;
	var $slider_css = null;

	function __construct()
	{
		$jinput = \JFactory::getApplication()->input;
		$widgetID = $jinput->get('widget_id');
		$this->utilities = $this->getUtilitiesLib();
		$this->source = $this->getSourceLib();
		$this->slider_css = $this->getCssLib();

		parent::__construct();
	}

	public function getUtilitiesLib()
	{
		$utilities = new \MinitekSliderLibUtilities;

		return $utilities;
	}

	public function getSourceLib()
	{
		$data_source = new \MinitekSliderLibSource;

		return $data_source;
	}

	public function getCssLib()
	{
		$options = new \MinitekSliderLibCss;

		return $options;
	}

	public function getItemsCount($widgetID)
	{
		// Get source params
		$source_id = $this->utilities->getSourceID($widgetID);
		$source_params = $this->utilities->getSourceParams($widgetID);

		// Limits
		$slider_params = $this->utilities->getSliderParams($widgetID);
		$globalLimit = (int)$slider_params['slider_global_limit'];

		// Count items
		$result = $this->source->getItems(true, $source_params, $globalLimit, false, false);

		if (isset($result)) {
			return $result;
		}

		return false;
	}

	public function getItems($widgetID)
	{
		// Get source params
		$source_id = $this->utilities->getSourceID($widgetID);
		$source_params = $this->utilities->getSourceParams($widgetID);

		// Limits
		$slider_params = $this->utilities->getSliderParams($widgetID);
		$startLimit = (int)$slider_params['slider_start_limit'];

		// Get items
		$result = $this->source->getItems(false, $source_params, $startLimit, false, false);

		if (isset($result)) {
			return $result;
		}

		return false;
	}

	public function getDisplayOptions($widgetID, $items, $detailBoxParams, $hoverBoxParams)
	{
		// Get items from content plugin
		$source_type = $this->utilities->getSourceID($widgetID);

		// Register plugin source class
		$class = 'MSource' . $source_type . 'Options';
		$plugin = 'msource' . $source_type;
		\JLoader::register($class, JPATH_SITE . '/plugins/content/' . $plugin . '/helpers/options.php');

		$options = new $class;
		$slider = $options->getDisplayOptions($widgetID, $items, $detailBoxParams, $hoverBoxParams, $navParams = false, 'com_minitekslider');

		return $slider;
	}
}
