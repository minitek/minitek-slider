<?php
/**
* @title		Minitek Slider
* @copyright	Copyright (C) 2011-2020 Minitek, All rights reserved.
* @license		GNU General Public License version 3 or later.
* @author url	https://www.minitek.gr/
* @developers	Minitek.gr
*/

namespace Joomla\Component\MinitekSlider\Administrator\Helper;

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\URI\URI;

class MinitekSliderHelper
{
	public static $extension = 'com_minitekslider';

	/**
	 * Get latest version.
	 *
	 * @return  Version number
	 *
	 * @since   4.0.0
	 */
	public static function latestVersion()
	{
		$params = \JComponentHelper::getParams('com_minitekslider');
		$version = 0;

		$xml_file = @file_get_contents('https://update.minitek.gr/joomla-extensions/minitek_slider.xml');
		
		if ($xml_file)
		{
			$updates = new \SimpleXMLElement($xml_file);

			foreach ($updates as $key => $update)
			{
				$platform = (array)$update->targetplatform->attributes()->version;

				if ($platform[0] == '4.*')
				{
					$version = (string)$update->version;
					break;
				}
			}
		}

		return $version;
	}

	/**
	 * Get local version.
	 *
	 * @return  Version number
	 *
	 * @since   4.0.0
	 */
 	public static function localVersion()
	{
		$xml = simplexml_load_file(JPATH_ADMINISTRATOR .'/components/com_minitekslider/minitekslider.xml');
		$version = (string)$xml->version;

		return $version;
	}

	/**
	 * Method to clear user state variables.
	 *
	 * @since   4.0.0
	 */
	public static function clearWidgetStateVariables()
	{
		$app = Factory::getApplication();

		$app->setUserState('com_minitekslider.source_id', '');
	}

	/**
	 * Check if Minitek Slider Module is installed.
	 *
	 * @return  bool
	 *
	 * @since   4.0.0
	 */
	public static function getModule()
 	{
 		$db = Factory::getDBO();
 		$query = $db->getQuery(true);

 		// Construct the query
 		$query->select('*')
 			->from('#__extensions AS e');
 		$query->where('e.element = ' . $db->quote('mod_minitekslider'));

 		// Setup the query
 		$db->setQuery($query);

 		$module_exists = $db->loadObject();

 		if ($module_exists)
 			return true;

 		return false;
	}
	 
	/**
	 * Check if source plugin is installed.
	 *
	 * @return  bool
	 *
	 * @since   4.0.6
	 */
	public static function getSourcePlugin($type)
	{
		$db = Factory::getDbo();
		$query = $db->getQuery(true)
			->select('*')
			->from($db->quoteName('#__extensions'))
			->where($db->quoteName('folder') . ' = ' . $db->quote('content'))
			->where($db->quoteName('element') . ' = ' . $db->quote('msource'.$type));
		$db->setQuery($query);

		$result = $db->loadObject();

		if (!$result)
			return false;

		return $result;
	}
}
