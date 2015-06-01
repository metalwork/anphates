<?php
/**
* @Copyright Copyright (C) 2010 VTEM . All rights reserved.
* @license GNU/GPL http://www.gnu.org/copyleft/gpl.html
* @link     	http://www.vtem.net
**/

// no direct access
defined('_JEXEC') or die('Restricted access');
// Include the syndicate functions only once
require_once (dirname(__FILE__).DIRECTORY_SEPARATOR.'helper.php');
$imagePath 	= modVtemImagestackHelper::cleanDir($params->get( 'imagePath', 'images/stories/fruit' ));
$sortCriteria = $params->get( 'sortCriteria', 0);
$sortOrder = $params->get( 'sortOrder', 'asc');
$sortOrderManual = $params->get( 'sortOrderManual', '');
$width = $params->get( 'width', 650 );
$height = $params->get( 'height', 250 );

$largeFeatureWidth = $params->get( 'largeFeatureWidth', 400 );
$largeFeatureHeight = $params->get( 'largeFeatureHeight', 210 );
$smallFeatureWidth = $params->get( 'smallFeatureWidth', 250 );
$smallFeatureHeight = $params->get( 'smallFeatureHeight', 120 );
$topPadding = $params->get( 'topPadding', 10 );
$sidePadding = $params->get( 'sidePadding', 15 );
$smallFeatureOffset = $params->get( 'smallFeatureOffset', 50 );
$startingFeature = $params->get( 'startingFeature', 1 );
$carouselSpeed = $params->get( 'carouselSpeed', 1000 );
$counterStyle = $params->get( 'counterStyle', 1 );
$autoPlay = $params->get( 'autoPlay', 2000 );
$displayCutoff = $params->get( 'displayCutoff', 0 );
$preload = $params->get( 'preload', 1 );
$slideID= $params->get( 'slideID', 'vtemimagestack1' );

$document = &JFactory::getDocument();
$document->addStyleSheet(JURI::root().'modules/mod_vtem_imagestack/tmpl/styles.css');

if (trim($sortOrderManual) != "")
	$images = explode(",", $sortOrderManual);
else
	$images = modVtemImagestackHelper::imageList($imagePath, $sortCriteria, $sortOrder);
require(JModuleHelper::getLayoutPath('mod_vtem_imagestack'));