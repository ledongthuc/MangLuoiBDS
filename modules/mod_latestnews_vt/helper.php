<?php
/**
* @version              $Id: helper.php 10079 2008-02-28 13:39:08Z ircmaxell $
* @package              Joomla
* @copyright    Copyright (C) 2005 - 2008 Open Source Matters. All rights reserved.
* @license              GNU/GPL, see LICENSE.php
* Joomla! is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See COPYRIGHT.php for copyright notices and details.
*/

// no direct access
defined('_JEXEC') or die('Restricted access');

require_once (JPATH_SITE.DS.'components'.DS.'com_content'.DS.'helpers'.DS.'route.php');
class modLatestNewsHelper_vt
{
        function getList_vt(&$params)
        {
                global $mainframe;

                $db             =& JFactory::getDBO();
                $user           =& JFactory::getUser();
                $userId         = (int) $user->get('id');

                $count          = (int) $params->get('count', 5);
                $catid          = trim( $params->get('catid') );
                $secid          = trim( $params->get('secid') );
                $show_front     = $params->get('show_front', 1);
                $style_show     = $params->get('show_style', 0);
                $aid            = $user->get('aid', 0);
                $imgheight      = $params->get('imgheight',70);
                $imgwidth       = $params->get('imgwidth',70);
                $imgstatus      = $params->get('imgstatus',1);

                $contentConfig = &JComponentHelper::getParams( 'com_content' );
                $access         = !$contentConfig->get('shownoauth');

                $nullDate       = $db->getNullDate();

                $date =& JFactory::getDate();
                $now = $date->toMySQL();

                $where          = 'a.state = 1'
                        . ' AND ( a.publish_up = '.$db->Quote($nullDate).' OR a.publish_up <= '.$db->Quote($now).' )'
                        . ' AND ( a.publish_down = '.$db->Quote($nullDate).' OR a.publish_down >= '.$db->Quote($now).' )'
                        ;
		

                switch ($params->get( 'user_id' ))
                {
                        case 'by_me':
                                $where .= ' AND (created_by = ' . (int) $userId . ' OR modified_by = ' . (int) $userId . ')';
                                break;
                        case 'not_me':
                                $where .= ' AND (created_by <> ' . (int) $userId . ' AND modified_by <> ' . (int) $userId . ')';
                                break;
                }

                // Ordering
                switch ($params->get( 'ordering' ))
                {
                        case 'm_dsc':
                                $ordering               = 'a.modified DESC, a.created DESC';
                                break;
                        case 'c_dsc':
                        default:
                                $ordering               = 'a.created DESC';
                                break;
                }

                if ($catid)
                {
                        $ids = explode( ',', $catid );
                        JArrayHelper::toInteger( $ids );
                        $catCondition = ' AND (cc.id=' . implode( ' OR cc.id=', $ids ) . ')';
                }
                if ($secid)
                {
                        $ids = explode( ',', $secid );
                        JArrayHelper::toInteger( $ids );
                        $secCondition = ' AND (s.id=' . implode( ' OR s.id=', $ids ) . ')';
                }

                // Content Items only
                $query = 'SELECT a.*, ' .
                        ' CASE WHEN CHAR_LENGTH(a.alias) THEN CONCAT_WS(":", a.id, a.alias) ELSE a.id END as slug,'.
                        ' CASE WHEN CHAR_LENGTH(cc.alias) THEN CONCAT_WS(":", cc.id, cc.alias) ELSE cc.id END as catslug'.
                        ' FROM #__content AS a' .
                        ($show_front == '0' ? ' LEFT JOIN #__content_frontpage AS f ON f.content_id = a.id' : '') .
                        ' INNER JOIN #__categories AS cc ON cc.id = a.catid' .
                        ' INNER JOIN #__sections AS s ON s.id = a.sectionid' .
                        ' WHERE '. $where .' AND s.id > 0' .
                        ($access ? ' AND a.access <= ' .(int) $aid. ' AND cc.access <= ' .(int) $aid. ' AND s.access <= ' .(int) $aid : '').
                        ($catid ? $catCondition : '').
                        ($secid ? $secCondition : '').
                        ($show_front == '0' ? ' AND f.content_id IS NULL ' : '').
                        ' AND s.published = 1' .
                        ' AND cc.published = 1' .
                        ' ORDER BY '. $ordering;
                $db->setQuery($query, 0, $count);
                $rows = $db->loadObjectList();

                $i              = 0;
                $lists  = array();



                foreach ( $rows as $row )
                {
                    $img_url="";
                    $introtext=$rows[$i]->introtext;
                    $find_img=strpos($introtext,"img");
                    if ($find_img){
                      $end_img=strpos($introtext,"src=",$find_img);
                      if ($end_img){
                        $j=$end_img;
                        while (($introtext[$j]!='"')||($j<count($introtext))){
                          $img_url.=$introtext[$j];
                          $j++;
                          if ($img_url=="src="){
                            $img_url="";
                            $j++;
                          } //if
                        } //while
                      } //if
                    } //if
                        $lists[$i]->link = JRoute::_(ContentHelperRoute::getArticleRoute($row->slug, $row->catslug, $row->sectionid));
                        $lists[$i]->image=$img_url;
                        $lists[$i]->text =htmlspecialchars( $row->title );
                        $lists[$i]->imgheight=$imgheight;
                        $lists[$i]->imgwidth=$imgwidth;
                        $lists[$i]->style_show=$style_show;
                        $lists[$i]->imgstatus = $imgstatus;
                        $lists[$i]->introtext = strip_tags($row->introtext);
                        $i++;
                }
				
                $lists["catLink"] = "index.php?option=com_content&view=category&layout=blog&id=" . $catid . "119&Itemid=245";
                return $lists;
        }



}
