<?php
/**
* @title		Minitek Slider
* @copyright	Copyright (C) 2011-2020 Minitek, All rights reserved.
* @license		GNU General Public License version 3 or later.
* @author url	https://www.minitek.gr/
* @developers	Minitek.gr
*/

namespace Joomla\Component\MinitekSlider\Site\Controller;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\Controller\BaseController;

\JLoader::registerPrefix('MinitekSliderLib', JPATH_SITE . '/components/com_minitekslider/libraries');

/**
 * MinitekSlider slider class.
 *
 * @since  4.0.0
 */
class SliderController extends BaseController
{
	public function getContent()
	{
		// Get input
		$document = \JFactory::getDocument();
		$app = \JFactory::getApplication();
		$jinput = $app->input;

		// Get variables
		$widget_id = $jinput->get('widget_id', '', 'INT');
		$page = $jinput->get('page', '2', 'INT');
		$type = $jinput->get('type', 'slider', 'STRING');

		// Get params
		$model = $this->getModel('Slider');
		$utilities = $model->utilities;
		$slider_params = $utilities->getSliderParams($widget_id);
		if ($type == 'slider')
		{
    	$theme = $slider_params['slider_theme'];
		}
		else if ($type == 'navigator')
		{
			$theme = 'navigator';
		}
		$layout = $slider_params['slider_layout'];
		$layout = substr($layout, strpos($layout, ":") + 1);

		// Set variables
		$jinput->set('view', 'slider');
		$jinput->set('widget_id', $widget_id);
		$jinput->set('page', $page);

		// Set layout
		$jinput->set('layout', $layout.'_'.$theme, 'STRING');

		// Display
		parent::display();

		// Exit
		$app->close();
	}
}
