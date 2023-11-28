<?php
/*------------------------------------------------------------------------
# com_publisher
# ------------------------------------------------------------------------
# author    iJoomla
# copyright Copyright (C) 2013 ijoomla.com. All Rights Reserved.
# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
# Websites: http://www.ijoomla.com
# Technical Support:  Forum - http://www.ijoomla.com/forum/index/
-------------------------------------------------------------------------*/

use Joomla\CMS\Helper\ModuleHelper;

// no direct access
defined('_JEXEC') or die('Restricted access');

require_once JPATH_ROOT . '/components/com_jlms/helpers/helper.php';
require_once(dirname(__FILE__).DIRECTORY_SEPARATOR.'helper.php');

$document = JFactory::getDocument();
$document->addStyleSheet(JURI::root()."modules/mod_jlms_menus/jlms_menus.css");
$document->addScript(JURI::root()."modules/mod_jlms_menus/jlms_menus.js");

$helper = new modJlmsMenusHelper();
$result = $helper->getJlmsCategories($params);
require(ModuleHelper::getLayoutPath('mod_jlms_menus'));
?>
