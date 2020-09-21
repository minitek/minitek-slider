<?php
/**
* @title				Minitek Slider
* @copyright   	Copyright (C) 2011-2019 Minitek, All rights reserved.
* @license   		GNU General Public License version 3 or later.
* @author url   http://www.minitek.gr/
* @developers   Minitek.gr
*/

defined('_JEXEC') or die;

use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
?>

<?php echo HTMLHelper::_('uitab.addTab', 'myTab', 'slider_layout', Text::_('COM_MINITEKSLIDER_WIDGET_FIELDSET_LAYOUT', true)); ?>

	<div class="row">
		<div class="col-12">
			<fieldset id="fieldset-slider_layout" class="options-grid-form options-grid-form-full">
				<div>
				<?php echo $this->sliderform->renderFieldset('slider_layout'); ?>
				</div>
			</fieldset>
		</div>
	</div>

<?php echo HTMLHelper::_('uitab.endTab'); ?>

<?php echo HTMLHelper::_('uitab.addTab', 'myTab', 'slider_image_settings', Text::_('COM_MINITEKSLIDER_WIDGET_FIELDSET_IMAGES', true)); ?>

	<div class="row">
		<div class="col-12">
			<fieldset id="fieldset-slider_image_settings" class="options-grid-form options-grid-form-full">
				<div>
				<?php echo $this->sliderform->renderFieldset('slider_image_settings'); ?>
				</div>
			</fieldset>
		</div>
	</div>

<?php echo HTMLHelper::_('uitab.endTab'); ?>

<?php echo HTMLHelper::_('uitab.addTab', 'myTab', 'slider_detailbox', Text::_('COM_MINITEKSLIDER_WIDGET_FIELDSET_DETAIL_BOX', true)); ?>

	<div class="row">
		<div class="col-12">
			<fieldset id="fieldset-slider_detailbox" class="options-grid-form options-grid-form-full">
				<div>
				<?php echo $this->sliderform->renderFieldset('slider_detailbox'); ?>
				</div>
			</fieldset>
		</div>
	</div>

<?php echo HTMLHelper::_('uitab.endTab'); ?>

<?php echo HTMLHelper::_('uitab.addTab', 'myTab', 'slider_hoverbox', Text::_('COM_MINITEKSLIDER_WIDGET_FIELDSET_HOVER_BOX', true)); ?>

	<div class="row">
		<div class="col-12">
			<fieldset id="fieldset-slider_hoverbox" class="options-grid-form options-grid-form-full">
				<div>
				<?php echo $this->sliderform->renderFieldset('slider_hoverbox'); ?>
				</div>
			</fieldset>
		</div>
	</div>

<?php echo HTMLHelper::_('uitab.endTab'); ?>

<?php echo HTMLHelper::_('uitab.addTab', 'myTab', 'slider_pagination', Text::_('COM_MINITEKSLIDER_WIDGET_FIELDSET_NAVIGATION', true)); ?>

	<div class="row">
		<div class="col-12">
			<fieldset id="fieldset-slider_navigation" class="options-grid-form options-grid-form-full">
				<div>
				<?php echo $this->sliderform->renderFieldset('slider_navigation'); ?>
				</div>
			</fieldset>
		</div>
	</div>

<?php echo HTMLHelper::_('uitab.endTab'); ?>

<?php echo HTMLHelper::_('uitab.addTab', 'myTab', 'slider_effects', Text::_('COM_MINITEKSLIDER_WIDGET_FIELDSET_EFFECTS', true)); ?>

	<div class="row">
		<div class="col-12">
			<fieldset id="fieldset-slider_effects" class="options-grid-form options-grid-form-full">
				<div>
				<?php echo $this->sliderform->renderFieldset('slider_effects'); ?>
				</div>
			</fieldset>
		</div>
	</div>

<?php echo HTMLHelper::_('uitab.endTab'); ?>

<?php echo HTMLHelper::_('uitab.addTab', 'myTab', 'slider_responsive', Text::_('COM_MINITEKSLIDER_WIDGET_FIELDSET_RESPONSIVE', true)); ?>

	<div class="row">
		<div class="col-12">
			<fieldset id="fieldset-slider_responsive" class="options-grid-form options-grid-form-full">
				<div>
				<?php echo $this->sliderform->renderFieldset('slider_responsive'); ?>
				</div>
			</fieldset>
		</div>
	</div>

<?php echo JHtml::_('uitab.endTab'); ?>
