<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_search
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

// Including fallback code for the placeholder attribute in the search field.
JHtml::_('jquery.framework');
JHtml::_('script', 'system/html5fallback.js', false, true);
?>
<script type="text/javascript">
	jQuery(function () {
		jQuery("#danhsachmuc li").hover(function () {
			jQuery("#mucimage").attr("src", "images/muc/" + this.id + "_to.png");
		});
	});
</script>
<div style="width:100%">
        <div id="wrapper-danhsachmuc">
            <ul id="danhsachmuc">
                <li id="1">
                    <a href="index.php/be-boi">
                        <img src="images/muc/1.jpg" alt="icon" width="100px" />
                        <p>Bể bơi</p>
                    </a>
                </li>
                <li id="2">
                    <a href="index.php/doanh-nghiep-lon">
                        <img src="images/muc/2.jpg" alt="icon" width="100px" />
                        <p>Doanh nghiệp lớn</p>
                    </a>
                </li>
                <li id="3">
                    <a href="index.php/doanh-nghiep-nho">
                        <img src="images/muc/3.jpg" alt="icon" width="100px" />
                        <p>Doanh nghiệp nhỏ</p>
                    </a>
                </li>
                <li id="4">
                    <a href="index.php/dan-dung">
                        <img src="images/muc/4.jpg" alt="icon" width="100px" />
                        <p>Dân dụng</p>
                    </a>
                </li>
                <li id="5">
                    <a href="index.php/nuoi-thuy-san">
                        <img src="images/muc/5.jpg" alt="icon" width="100px" />
                        <p>Nuôi thủy sản</p>
                    </a>
                </li>
                <li id="6">
                    <a href="index.php/san-pham-2in1">
                        <img src="images/muc/6.jpg" alt="icon" width="100px" />
                        <p>Sản phẩm 2in1</p>
                    </a>
                </li>
            </ul>
        </div>
        <div >
            <img id="mucimage" src="images/muc/1_to.png" style="margin-top:20px;width:55%" />
        </div>
</div>