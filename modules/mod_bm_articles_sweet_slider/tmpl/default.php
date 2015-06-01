<?php
/**
 * @package     mod_bm_articles_sweet_slider
 * @author      brainymore.com
 * @email       brainymore@gmail.com
 * @copyright   Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
if(!empty($list)):
$total = count($list);
?>

	<div id="bm-sweet-slider-<?php echo $module->id;?>" class="bm-sweet-slider">
		<?php if($show_arrows): ?>
			<div class="sequence-prev" ></div>
			<div class="sequence-next" ></div>
		<?php endif;?>
		<ul class="sequence-canvas">
			<?php foreach ($list as $item) : ?>
				<li class="animate-in">
					<div class="title" style="width:85%; padding:10px;text-align:center; background-color:#c9c9c9;">
						<a href="<?php echo $item->link; ?>" title="<?php echo htmlspecialchars($item->title); ?>"><?php echo JHTML::_('string.truncate', ( $item->title ), $params->get('title_limit',50)); ?></a>
					</div>
					<div class="subtitle">
						<?php if($show_desc):?>
						
								<?php echo JHTML::_('string.truncate', ( $item->introtext ), $params->get('readmore_limit',200)); ?>
								<?php if($show_readmore):?>
									<a class="bm_readmore_button" href="<?php echo $item->link; ?>" title="<?php echo htmlspecialchars($item->title); ?>">
										<?php echo JText::_($readmore_label); ?>
									</a>
								<?php endif;?>
						
						<?php endif;?>
					</div>
				
					<img src="<?php echo htmlspecialchars($item->image); ?>" alt="<?php echo htmlspecialchars($item->title); ?>" class="model"/>
				
				</li>
			<?php endforeach; ?> 
		</ul>
		<?php if($show_paging): ?>
			<ul class="sequence-pagination">
				<?php foreach ($list as $item) : ?>
					<li><img src="<?php echo htmlspecialchars($item->thumb); ?>" alt="<?php echo htmlspecialchars($item->title); ?>" /></li>
				<?php endforeach; ?> 
				
			</ul>
		<?php endif;?>
	</div>

<script type="text/javascript" language="javascript">

	if (typeof jqbm != 'undefined') {	
		jqbm(document).ready(function(){
		
			jqbm("#bm-sweet-slider-<?php echo $module->id;?>").sequence({
				nextButton: true,
				prevButton: true,
				pagination: true,
				animateStartingFrameIn: true,
				autoPlay: <?php echo $autoplay;?>,
				autoPlayDelay: <?php echo $interval;?>
			}).data("sequence");
		});
	}
</script> 

<?php else: ?>
	<div class="bm-nodata"><?php echo JText::_('Found no item!');?></div>
<?php endif;?>