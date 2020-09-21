<?php
/**
* @title				Minitek Slider
* @copyright   	Copyright (C) 2011-2019 Minitek, All rights reserved.
* @license   		GNU General Public License version 3 or later.
* @author url   http://www.minitek.gr/
* @developers   Minitek.gr
*/

namespace Joomla\Component\MinitekSlider\Administrator\Field;

defined('_JEXEC') or die('Restricted access');

\JFormHelper::loadFieldClass('radio');

class SliderListField extends \JFormFieldRadio
{
	public $type = 'SliderList';

	protected function getInput()
	{
		$html = array();

		// Initialize some field attributes.
		$class     = !empty($this->class) ? ' class="radio ' . $this->class . '"' : ' class="radio"';
		$required  = $this->required ? ' required aria-required="true"' : '';
		$autofocus = $this->autofocus ? ' autofocus' : '';
		$disabled  = $this->disabled ? ' disabled' : '';
		$readonly  = $this->readonly;

		// Start the radio field output.
		$html[] = '<fieldset id="' . $this->id . '"' . $class . $required . $autofocus . $disabled . ' >';

		// Get the field options.
		$options = $this->getOptions();

		// Build the radio field output.
		foreach ($options as $i => $option)
		{
			// Initialize some option attributes.
			$checked = ((string) $option->value == (string) $this->value) ? ' checked="checked"' : '';
			$class = !empty($option->class) ? ' class="' . $option->class . '"' : '';

			$disabled = !empty($option->disable) || ($readonly && !$checked);

			$disabled = $disabled ? ' disabled' : '';

			// Initialize some JavaScript option attributes.
			$onclick = !empty($option->onclick) ? ' onclick="' . $option->onclick . '"' : '';
			$onchange = !empty($option->onchange) ? ' onchange="' . $option->onchange . '"' : '';

			$html[] = '<div class="slider-radio '.(string) $option->value.'">';

				$html[] = '<label for="' . $this->id . $i . '"' . $class . ' >';

					$html[] = '<p>';
						$html[] = \JText::alt($option->text, preg_replace('/[^a-zA-Z0-9_\-]/', '_', $this->fieldname));
					$html[] = '</p>';

					$html[] = '<div class="slider-radio-demo-cont">';

						$html[] = '<div class="slider-radio-demo">';

							$html[] = '<img alt="" src="components/com_minitekslider/assets/images/slider/'.$option->image.'">';

						$html[] = '</div>';

					$html[] = '</div>';

				$html[] = '</label>';

				$html[] = '<div class="slider-radio-actions">';

					$html[] = '<input type="radio" id="' . $this->id . $i . '" name="' . $this->name . '" value="'
					. htmlspecialchars($option->value, ENT_COMPAT, 'UTF-8') . '"' . $checked . $class . $required . $onclick
					. $onchange . $disabled . ' />';

				$html[] = '</div>';

			$html[] = '</div>';

			$required = '';
		}

		// End the radio field output.
		$html[] = '</fieldset>';

		return implode($html);
	}

	protected function getOptions()
	{
		$elements = Array(
			Array(
				'value' => 'image_slider',
				'image' => 'slider_i.jpg',
				'text' => \JText::_('COM_MINITEKSLIDER_FIELD_IMAGE_SLIDER'),
				'class' => 'slider-radio-input'
			),
			Array(
				'value' => 'article_slider_1',
				'image' => 'slider_a1.jpg',
				'text' => \JText::_('COM_MINITEKSLIDER_FIELD_ARTICLE_SLIDER_1'),
				'class' => 'slider-radio-input'
			),
			Array(
				'value' => 'article_slider_2',
				'image' => 'slider_a2.jpg',
				'text' => \JText::_('COM_MINITEKSLIDER_FIELD_ARTICLE_SLIDER_2'),
				'class' => 'slider-radio-input'
			),
			Array(
				'value' => 'article_slider_3',
				'image' => 'slider_a3.jpg',
				'text' => \JText::_('COM_MINITEKSLIDER_FIELD_ARTICLE_SLIDER_3'),
				'class' => 'slider-radio-input'
			),
			Array(
				'value' => 'article_slider_4',
				'image' => 'slider_a4.jpg',
				'text' => \JText::_('COM_MINITEKSLIDER_FIELD_ARTICLE_SLIDER_4'),
				'class' => 'slider-radio-input'
			),
			Array(
				'value' => 'article_slider_5',
				'image' => 'slider_a5.jpg',
				'text' => \JText::_('COM_MINITEKSLIDER_FIELD_ARTICLE_SLIDER_5'),
				'class' => 'slider-radio-input'
			),
			Array(
				'value' => 'media_slider',
				'image' => 'slider_m.jpg',
				'text' => \JText::_('COM_MINITEKSLIDER_FIELD_MEDIA_SLIDER'),
				'class' => 'slider-radio-input'
			)
		);

		foreach ($elements as $option)
		{
			$disabled = false;

			// Create a new option object based on the <option /> element.
			$tmp = \JHtml::_(
				'select.option', (string) $option['value'], trim((string) $option['text']), 'value', 'text',
				$disabled
			);

			// Set some option attributes.
			$tmp->class = $option['class'];
			$tmp->image = $option['image'];

			// Add the option object to the result set.
			$options[] = $tmp;
		}

		reset($options);

		return $options;
	}

}
