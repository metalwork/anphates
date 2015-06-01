<?php
/**
 * @package     mod_bm_defines
 * @author      brainymore.com
 * @email       brainymore@gmail.com
 * @copyright   Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

$arr_status = array(0=>'false', 1=>'true');
$interval = $params->get('interval', 3000);
$module_height = intval($params->get('module_height', 550));

$autoplay = $arr_status[$params->get('autoplay', 1)];
$show_readmore = $params->get('show_readmore', 1);
$readmore_label = $params->get('readmore_label', 'More detail');
$show_arrows = $params->get('show_arrows', 1);
$show_paging = $params->get('show_paging', 1);
$show_desc = $params->get('show_desc', 1);

$document = JFactory::getDocument();    
$class_module_id = '#bm-sweet-slider-'.$module->id;

$style = $class_module_id.'{height:' .$module_height. 'px;}';

$document->addStyleDeclaration($style);

if(!defined('BM_SLICEBOX_LOAD_SCRIPT'))
{
	if($params->get('jquery', 'true') == 'true')
	{
		JHtml::script(Juri::base() . 'modules/'.$module->module.'/assets/js/jquery.min.js');
	}
	JHtml::script(Juri::base() . 'modules/'.$module->module.'/assets/js/jquery.no-conflict.js');
	JHtml::script(Juri::base() . 'modules/'.$module->module.'/assets/js/jquery.sequence.js');;
	JHtml::stylesheet(Juri::base() . 'modules/'.$module->module.'/assets/css/styles.css');
	define('BM_SLICEBOX_LOAD_SCRIPT', TRUE);
}
?>
