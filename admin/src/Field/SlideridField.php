<?php
/**
* @title		Minitek Slider
* @copyright	Copyright (C) 2011-2020 Minitek, All rights reserved.
* @license		GNU General Public License version 3 or later.
* @author url	https://www.minitek.gr/
* @developers	Minitek.gr
*/

namespace Joomla\Component\MinitekSlider\Administrator\Field;

defined('_JEXEC') or die;

\JFormHelper::loadFieldClass('list');

class SliderIdField extends \JFormFieldList
{
	protected $type = 'SliderId';

	protected function getOptions()
	{
		$db = \JFactory::getDBO();
		$query = 'SELECT id as value, name as text FROM '.$db->quoteName('#__minitek_slider_widgets');
		$query .= ' WHERE '.$db->quoteName('state').' = 1 ORDER BY '.$db->quoteName('name');
		$db->setQuery($query);
		$widgets = $db->loadObjectList();
		$options = array();

		foreach ($widgets as $widget)
		{
			$options[] = \JHTML::_('select.option', $widget->value, $widget->text);
		}

		$options = array_merge(parent::getOptions(), $options);

		return $options;
	}
}
