<?php 
/*------------------------------------------------------------------------
# com_guru
# ------------------------------------------------------------------------
# author    iJoomla
# copyright Copyright (C) 2013 ijoomla.com. All Rights Reserved.
# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
# Websites: http://www.ijoomla.com
# Technical Support:  Forum - http://www.ijoomla.com/forum/index/
-------------------------------------------------------------------------*/

// no direct access
defined('_JEXEC') or die('Restricted access');

$categories_alias = array();

$db = JFactory::getDbo();
$sql = "select id, params from #__menu where menutype='guru-categories'";
$db->setQuery($sql);
$menus_result = $db->loadAssocList();

if(isset($menus_result) && count($menus_result) > 0){
    foreach($menus_result as $key=>$value){
        $menu_params = $value["params"];
        $menu_params = json_decode($menu_params, true);
        $cid = $menu_params["cid"];
        @$categories_alias[$cid] = $value["id"];
    }
}



require_once(JPATH_SITE. '/components/com_guru/helpers/helper.php');
$helper = new guruHelper();
$seo_itemid = $helper->getSeoItemid();

$show_courses = $params->get("show_courses", "0");
?>

<script src="<?php echo JURI::root()."modules/mod_guru_menus/guru_menus.js"; ?>"></script>

<div class="guru-mod--menu">
    <?php
        if(isset($result) && count($result) > 0){
    ?>
    <ul class="guru-mod--menu__list">
    <?php
            foreach($result as $key=>$value){
                if(intval($value["total"]) == 0){
                    continue;
                }
				
                $db = JFactory::getDbo();
                $sql = "select id, catid, name, alias from #__guru_program where published='1' and catid=".intval($value["id"])." ORDER BY name asc";
                $db->setQuery($sql);
                $courses = $db->loadAssocList();
    ?>
                <li class="guru-mod--menu__item">
                    <a href="<?php echo JRoute::_(guruHelper::getRoute('index.php?option=com_guru&view=guruPcategs&task=view&cid='.$value["id"]."-".$value["alias"])); ?>">
                        <?php
                            if(isset($value["icon"]) && trim($value["icon"]) != ""){
                                echo '<i class="fa '.trim($value["icon"]).'"></i>';
                            }
                        ?>
        
                        <?php echo $value["name"]; ?>
                    </a>
        
                    <?php
                        if(isset($courses) && count($courses) > 0 && $show_courses){
                    ?>
                            <ul class="module-list-courses">
                                <?php
                                    foreach($courses as $key_c=>$value_c){
                                ?>
                                <li>
                                    <a href="<?php echo JRoute::_(guruHelper::getRoute("index.php?option=com_guru&view=guruPrograms&task=view&cid=".intval($value_c["id"])."-".$value_c["alias"])); ?>">
                                        <?php echo $value_c["name"]; ?>
                                    </a>
                                </li>
                                <?php
                                    }
                                ?>
                            </ul>
                    <?php
                        }
                    ?>
                </li>
    <?php
            }
    ?>
    </ul>
    <?php
        }
    ?>
</div>