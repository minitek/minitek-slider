<?php
/**
* @title		Minitek Slider
* @copyright	Copyright (C) 2011-2021 Minitek, All rights reserved.
* @license		GNU General Public License version 3 or later.
* @author url	https://www.minitek.gr/
* @developers	Minitek.gr
*/

namespace Joomla\Component\MinitekSlider\Administrator\View\Dashboard;

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\URI\URI;
use Joomla\CMS\MVC\View\HtmlView as BaseHtmlView;
use Joomla\CMS\Toolbar\Toolbar;
use Joomla\CMS\Toolbar\ToolbarHelper;

class HtmlView extends BaseHtmlView
{
	/**
	 * Display the view
	 *
	 * @param   string  $tpl  The name of the template file to parse; automatically searches through the template paths.
	 *
	 * @return  void
	 */
	public function display($tpl = null)
	{
		// Skip if view == update
		if (Factory::getApplication()->input->get('view') != 'update')
		{
			// Load dashboard javascript
			$wa = Factory::getApplication()->getDocument()->getWebAssetManager();
			$wa->useScript('com_minitekslider.admin-dashboard');

			$this->addToolbar();

			return parent::display($tpl);
		}
	}

	/**
	 * Add the page title and toolbar.
	 *
	 * @return  void
	 *
	 * @since   4.0.0
	 */
	protected function addToolbar()
	{
		\JToolbarHelper::title(\JText::_('COM_MINITEKSLIDER_DASHBOARD_TITLE'), '');
	}
}
