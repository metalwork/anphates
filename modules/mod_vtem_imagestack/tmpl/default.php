<?php
/**
* @Copyright Copyright (C) 2010 VTEM . All rights reserved.
* @license GNU/GPL http://www.gnu.org/copyleft/gpl.html
* @link     	http://www.vtem.net
**/

// no direct access
defined('_JEXEC') or die('Restricted access'); 
if (count($images) > 0) :
if($params->get('jquery', 1) == 1){	
?>
<script type="text/javascript" src="<?php echo JURI::root();?>modules/mod_vtem_imagestack/tmpl/jquery-1.5.1.min.js"></script>
<?php }?>
<script type="text/javascript" src="<?php echo JURI::root();?>modules/mod_vtem_imagestack/tmpl/script.js"></script>
<script type="text/javascript">
var vtemimagestack = jQuery.noConflict();
(function($) {
$(document).ready(function(){
$('#<?php echo $slideID;?>').featureCarousel({
        largeFeatureWidth :     <?php echo $largeFeatureWidth;?>,
        largeFeatureHeight:		<?php echo $largeFeatureHeight;?>,
        smallFeatureWidth:      <?php echo $smallFeatureWidth;?>,
        smallFeatureHeight:		<?php echo $smallFeatureHeight;?>,
        topPadding:             <?php echo $topPadding;?>,
        sidePadding:            <?php echo $sidePadding;?>,
        smallFeatureOffset:		<?php echo $smallFeatureOffset;?>,
        startingFeature:        <?php echo $startingFeature;?>,
        carouselSpeed:          <?php echo $carouselSpeed;?>,
        autoPlay:               <?php echo $autoPlay;?>,
        counterStyle:           <?php echo $counterStyle;?>,
        preload:                <?php echo $preload;?>,
        displayCutoff:          <?php echo $displayCutoff;?>
});
});
})(jQuery);
</script>
<style type="text/css">
#<?php echo $slideID;?>{
width:<?php echo $width;?>px;
height:<?php echo $height;?>px;
padding-bottom:<?php echo $topPadding;?>px;
}
</style>
<div class="vtem_image_stack_wrapp vtem_image_stack_nav<?php echo $counterStyle;?>">
<div id="<?php echo $slideID;?>" class="vtem_image_stack">
<?php
foreach($images as $img) {
?>
  <div class="carousel-feature">
    <a href="#"><img class="vtem-carousel-image" src="<?php echo $imagePath.$img;?>" alt="VTEM Image Stack" /></a>
  </div>
<?php 
}
endif;?>
</div>
<div style="clear:both"></div>
</div>