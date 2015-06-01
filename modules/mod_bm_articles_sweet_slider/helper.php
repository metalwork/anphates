<?php
/**
 * @package     BM Articles Helper
 * @author      brainymore.com
 * @email       brainymore@gmail.com
 * @copyright   Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

require_once JPATH_SITE . '/components/com_content/helpers/route.php';

JModelLegacy::addIncludePath(JPATH_SITE . '/components/com_content/models', 'ContentModel');

jimport('joomla.image.image');
/**
 * Helper for mod_articles_latest
 *
 * @package     Joomla.Site
 * @subpackage  mod_articles_latest
 */
if(!class_exists("ModBMArticlesSHelper")){
    class ModBMArticlesSHelper
    {
        var $select_img_from = '';
        public function ModBMArticlesHelper()
        {
           
        }
                      
	    public function getList($params, $module)
	    {         
          
		    // Get the dbo
		    $db = JFactory::getDbo();

		    // Get an instance of the generic articles model
		    $model = JModelLegacy::getInstance('Articles', 'ContentModel', array('ignore_request' => true));

		    // Set application parameters in model
		    $app = JFactory::getApplication();
		    $appParams = $app->getParams();
		    $model->setState('params', $appParams);

		    // Set the filters based on the module params
		    $model->setState('list.start', 0);
		    $model->setState('list.limit', (int) $params->get('count', 5));
		    $model->setState('filter.published', 1);

		    // Access filter
		    $access = !JComponentHelper::getParams('com_content')->get('show_noauth');
		    $authorised = JAccess::getAuthorisedViewLevels(JFactory::getUser()->get('id'));
		    $model->setState('filter.access', $access);
					
			// Category filter
			$model->setState('filter.category_id', $params->get('catid', array()));
					
		    // User filter
		    $userId = JFactory::getUser()->get('id');
		    switch ($params->get('user_id'))
		    {
			    case 'by_me':
				    $model->setState('filter.author_id', (int) $userId);
				    break;
			    case 'not_me':
				    $model->setState('filter.author_id', $userId);
				    $model->setState('filter.author_id.include', false);
				    break;

			    case '0':
				    break;

			    default:
				    $model->setState('filter.author_id', (int) $params->get('user_id'));
				    break;
		    }

		    // Filter by language
		    $model->setState('filter.language', $app->getLanguageFilter());

		    //  Featured switch
		    switch ($params->get('show_featured'))
		    {
			    case '1':
				    $model->setState('filter.featured', 'only');
				    break;
			    case '0':
				    $model->setState('filter.featured', 'hide');
				    break;
			    default:
				    $model->setState('filter.featured', 'show');
				    break;
		    }

		    // Set ordering
		    $order_map = array(
			    'm_dsc' => 'a.modified DESC, a.created',
			    'mc_dsc' => 'CASE WHEN (a.modified = ' . $db->quote($db->getNullDate()) . ') THEN a.created ELSE a.modified END',
			    'c_dsc' => 'a.created',
			    'p_dsc' => 'a.publish_up',
		    );
		    $ordering = JArrayHelper::getValue($order_map, $params->get('ordering'), 'a.publish_up');
		    $dir = 'DESC';

		    $model->setState('list.ordering', $ordering);
		    $model->setState('list.direction', $dir);

		    $items = $model->getItems();

		    foreach ($items as $key=>&$item)
		    {   
                                                         
                $this->getImage($item, $params, $module);
                if($item->image!='')
                {
                    $item->introtext = strip_tags($item->introtext);
                    $item->slug = $item->id . ':' . $item->alias;
                    $item->catslug = $item->catid . ':' . $item->category_alias;

                    if ($access || in_array($item->access, $authorised))
                    {
                        // We know that user has the privilege to view the article
                        $item->link = JRoute::_(ContentHelperRoute::getArticleRoute($item->slug, $item->catslug));
                    }
                    else
                    {
                        $item->link = JRoute::_('index.php?option=com_users&view=login');
                    }
                }
                 else
                 {
                    unset($items[$key]);
                 }   
		    }

		    return $items;
	    }
        
        public function getImage($item, $params, $module){
                      
            $image_from = $params->get('image_from', 'full_article_image');
            $images = json_decode($item->images);
            $img_path = '';
            
            switch($image_from)
            {
                case 'full_article_image': 
                    if(isset($images->image_fulltext) && $images->image_fulltext!='')
                    {
                         $img_path = $images->image_fulltext;
                    }
                break;
                case 'intro_image': 
                    if(isset($images->image_intro) && $images->image_intro!='')
                    {
                         $img_path = $images->image_intro;
                    }
                break;
                case 'intro_text': 
                    $content = $item->introtext;

                    $pattern = '/src="([^"]*)"/';
                    preg_match_all($pattern, $content, $out);
                    if(isset($out[1][0]) && $out[1][0]!='')
                    {
                       $img_path = $out[1][0]; 
                    } 
                break;
            }                       
               
            if(!($img_path!='' && file_exists($img_path)))
            {     				         
                $img_path = 'modules/'.$module->module.'/assets/images/no-image.png';
            }		
			
			if($img_path!='' && file_exists($img_path)){
				if($params->get('resize_type', 5)==6)
				{
					$item->image = $img_path;
					
					$thumb = new JoomlaImage($img_path);
					$thumbSizes = array($params->get('width_thumb', 150).'x'.$params->get('height_thumb', 80));
					$thumb = $thumb->createThumbs($thumbSizes,5);
					$item->thumb = $thumb[0]->getPath();
				}
				else
				{
					$img = new JoomlaImage($img_path);
					$thumbSizes = array($params->get('width_image', 800).'x'.$params->get('height_image', 300));
					$imge = $img->createThumbs($thumbSizes,$params->get('resize_type', 5));
					$item->image = $imge[0]->getPath();		
					
					$thumb = new JoomlaImage($img_path);
					$thumbSizes = array($params->get('width_thumb', 150).'x'.$params->get('height_thumb', 80));
					$thumb = $thumb->createThumbs($thumbSizes,$params->get('resize_type', 5));
					$item->thumb = $thumb[0]->getPath();					
				}
				
			}
        
        }
		
        public static function loadScript($module, $params)
        {   

        }
        
        public static function addScript($module, $params)
        {        
            $document = JFactory::getDocument();            
            $style = ''; 
            $document->addStyleDeclaration($style);
            
        }
    }
}        
