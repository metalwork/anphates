<?php
/**
 * @package     mod_bm_articles_sweet_slider
 * @author      brainymore.com
 * @email       brainymore@gmail.com
 * @copyright   Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

// Include the syndicate functions only once
require __DIR__ . '/defines.php';
require_once __DIR__ . '/helper.php';
require_once __DIR__ . '/libs/image.php';

$cache = $params->get('cache',1);

$bm_articles_{$module->id} = new ModBMArticlesSHelper($params);

if($cache)
{   
	$cache = JFactory::getCache($module->module.'_'.$module->id,'callback');
	$cache->setCaching(1);
	$cache->setLifeTime($params->get( 'cache_time', 900));
	$list  = $cache->call( array( $bm_articles_{$module->id}, 'getList' ), $params, $module );
}
else
{
	$list = $bm_articles_{$module->id}->getList($params, $module);
}

$moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx'));

require JModuleHelper::getLayoutPath($module->module, 'default');
