<?php
/**
 * @package     Header Element
 * @author      brainymore.com
 * @email       brainymore@gmail.com
 * @copyright   Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
defined('_JEXEC') or die ;

defined('JPATH_PLATFORM') or die;

class JFormFieldHeader extends JFormField
{

	protected $type = 'header';

	protected function getInput()
	{
		$document = JFactory::getDocument();
        $document->addStyleSheet(JURI::root(true).'/modules/'.$this->element['module'].'/assets/css/xml.css');
		return '<div class="bmHeaderContainer"><div class="bmparamHeaderContent">'.JText::_($this->value).'</div></div>';
	}
}