<?php
/**
* @title		Minitek Slider
* @copyright	Copyright (C) 2011-2021 Minitek, All rights reserved.
* @license		GNU General Public License version 3 or later.
* @author url	https://www.minitek.gr/
* @developers	Minitek.gr
*/

// no direct access
defined('_JEXEC') or die('Restricted access');

// Page title
if ($this->slider_page_title)
{
	if ($this->params->get('show_page_heading', 1))
	{
		$app = JFactory::getApplication();
		$menu = $app->getMenu();
		$active = $menu->getActive();

		if ($active->params->get('page_heading'))
		{
			$page_heading = $active->params->get('page_heading');
		} 
		else 
		{
			$doc = JFactory::getDocument();
			$page_heading = $doc->getTitle();
		}
		
		?><div class="page-header">
			<h1><?php echo $this->escape($page_heading); ?></h1>
		</div><?php
	}
}

// Suffix
$suffix = '';

if (isset($this->suffix))
{
	$suffix = $this->suffix;
}

// Wrapper padding
if (!$this->cont_padding)
{
	$padding = '0 0 1px 0';
}
else 
{
	$padding = $this->cont_padding.'px';
}

// Slider Container
?><div id="mslider_wrapper_<?php echo $this->widgetID; 
	?>" class="mslider-wrapper" style="padding: <?php echo $padding; ?>;"><?php

	?><div class="mslider-wrapper-inner <?php
	echo $this->horizontal_padding ? 'mslider_horizontal_padding' : ''; ?>"><?php 
		
		// Main slider
		?><div id="mslider_<?php echo $this->widgetID; 
			?>" class="mslider mslider_main mslider_<?php echo $this->theme; ?> <?php 
			echo ($this->bullets) ? 'with-bullets' : ''; ?> <?php
			echo ($this->progressbar) ? 'with-progressbar' : ''; ?> <?php
			echo $this->bullets_style.'-bullets'; ?> <?php 
			echo $suffix; ?>"><?php
			include (dirname(__FILE__).'/'.$this->getLayout().'_'.$this->theme.'.php');
		?></div><?php

		// Progress bar
		if ($this->progressbar)
		{
			?><div id="mslider_progressbar_<?php echo $this->widgetID; ?>" class="mslider-progressbar <?php
			echo ($this->bullets) ? 'with-bullets' : ''; ?>"></div><?php
		}
	
	?></div><?php
	
?></div>
