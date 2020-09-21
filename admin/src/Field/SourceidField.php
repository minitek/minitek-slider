<?php
/**
* @title				Minitek Slider
* @copyright   	Copyright (C) 2011-2019 Minitek, All rights reserved.
* @license   		GNU General Public License version 3 or later.
* @author url   https://www.minitek.gr/
* @developers   Minitek.gr
*/

namespace Joomla\Component\MinitekSlider\Administrator\Field;

defined('_JEXEC') or die;

\JFormHelper::loadFieldClass('list');

class SourceidField extends \JFormFieldList
{
	protected $type = 'SourceId';

	public function getOptions()
	{
		$options = Array(
			Array(
				'value' => '',
				'text' => \JText::_('COM_MINITEKSLIDER_SELECT_SOURCE_ID')
			)
		);

		// Get all sources from content plugins
		$app = \JFactory::getApplication();
		$sources = (array)$app->triggerEvent('onWidgetPrepareSource', array());

		foreach ($sources as $source)
		{
			$options[] = Array(
				'value' => $source['type'],
				'text' => $source['title']
			);
		}

		return $options;
	}
}
