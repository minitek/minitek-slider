<?php
/**
* @title		Minitek Slider
* @copyright	Copyright (C) 2011-2020 Minitek, All rights reserved.
* @license		GNU General Public License version 3 or later.
* @author url	https://www.minitek.gr/
* @developers	Minitek.gr
*/

namespace Joomla\Component\MinitekSlider\Site\Service;

defined('_JEXEC') or die;

use Joomla\CMS\Application\SiteApplication;
use Joomla\CMS\Component\Router\RouterView;
use Joomla\CMS\Component\Router\RouterViewConfiguration;
use Joomla\CMS\Component\Router\Rules\MenuRules;
use Joomla\CMS\Component\Router\Rules\NomenuRules;
use Joomla\CMS\Component\Router\Rules\StandardRules;
use Joomla\CMS\Menu\AbstractMenu;

/**
 * Routing class of com_minitekslider
 *
 * @since  4.0.0
 */
class Router extends RouterView
{
    /**
     * Build the route for the com_minitekslider component
     *
     * @param   array  &$query  An array of URL arguments
     *
     * @return  array  The URL arguments to use to assemble the subsequent URL.
     *
     * @since   4.0.0
     */
    public function build(&$query)
    {
        $segments = array();

        if (isset($query['view']))
        {
	        unset($query['view']);
        }

        if (isset($query['widget_id']))
        {
	        unset($query['widget_id']);
        }

        return $segments;
    }

    /**
     * Parse the segments of a URL.
     *
     * @param   array  &$segments  The segments of the URL to parse.
     *
     * @return  array  The URL attributes to be used by the application.
     *
     * @since   4.0.0
     */
    public function parse(&$segments)
    {
		$lang = JFactory::getLanguage();
		$lang->load('com_minitekslider', JPATH_SITE, $lang->getTag(), true);

		$vars = array();

		if (count($segments))
		{
			JError::raiseError(404, JText::_('COM_MINITEKSLIDER_ERROR_PAGE_NOT_FOUND'));
		}

		return $vars;
    }
}

/**
 * Content router functions
 *
 * These functions are proxys for the new router interface
 * for old SEF extensions.
 *
 * @deprecated  4.0  Use Class based routers instead
 */
function MinitekSliderBuildRoute(&$query)
{
    $router = new MinitekSliderRouter;

    return $router->build($query);
}

function MinitekSliderParseRoute($segments)
{
    $router = new MinitekSliderRouter;

    return $router->parse($segments);
}
