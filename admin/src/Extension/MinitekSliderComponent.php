<?php
/**
* @title		Minitek Slider
* @copyright	Copyright (C) 2011-2021 Minitek, All rights reserved.
* @license		GNU General Public License version 3 or later.
* @author url	https://www.minitek.gr/
* @developers	Minitek.gr
*/

namespace Joomla\Component\MinitekSlider\Administrator\Extension;

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Extension\BootableExtensionInterface;
use Joomla\CMS\Extension\MVCComponent;
use Joomla\CMS\HTML\HTMLRegistryAwareTrait;
use Psr\Container\ContainerInterface;
use Joomla\CMS\Component\Router\RouterServiceInterface;
use Joomla\CMS\Component\Router\RouterServiceTrait;

/**
 * Component class for com_minitekslider.
 *
 * @since  4.0.0
 */
class MinitekSliderComponent extends MVCComponent implements BootableExtensionInterface, RouterServiceInterface
{
	use HTMLRegistryAwareTrait;
	use RouterServiceTrait;

	/**
	 * Booting the extension. This is the function to set up the environment of the extension like
	 * registering new class loaders, etc.
	 *
	 * If required, some initial set up can be done from services of the container, eg.
	 * registering HTML services.
	 *
	 * @param   ContainerInterface  $container  The container
	 *
	 * @return  void
	 *
	 * @since   4.0.0
	 */
	public function boot(ContainerInterface $container)
	{
		if (Factory::getApplication()->isClient('administrator'))
			$this->loadAssets();
	}

	/**
	 * Method to load admin assets
	 *
	 * @since   4.0.0
	 *
	 * @return  void
	 */
	protected function loadAssets()
	{
		$wa = Factory::getApplication()->getDocument()->getWebAssetManager();
		$wa->useStyle('com_minitekslider.admin-minitekslider')
			->useScript('com_minitekslider.admin-minitekslider');
	}

	/**
	 * Method to check component access permission
	 *
	 * @since   4.0.0
	 *
	 * @return  void
	 */
	protected function checkAccess()
	{
		// Access check
		if (!Factory::getUser()->authorise('core.manage', 'com_minitekslider'))
		{
			throw new \Joomla\CMS\Access\Exception\Notallowed(Text::_('JERROR_ALERTNOAUTHOR'), 403);
		}
	}
}
