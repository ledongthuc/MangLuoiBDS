<?php
/**
* @version		$Id:mod_menu.php 2463 2006-02-18 06:05:38Z webImagery $
* @package		Joomla
* @copyright	Copyright (C) 2005 - 2008 Open Source Matters. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* Joomla! is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See COPYRIGHT.php for copyright notices and details.
*/

// no direct access
defined('_JEXEC') or die('Restricted access');

require_once(dirname(__FILE__).DS.'menu.php');

class modMenuHelper
{
	/**
	 * Show the menu
	 * @param string The current user type
	 */
	function buildMenu()
	{
		global $mainframe;

		$lang		= & JFactory::getLanguage();
		$user		= & JFactory::getUser();
		$db			= & JFactory::getDBO();
		$usertype	= $user->get('usertype');
		//TODO  lay gia tri cua user ID
		/*
		$app =& JFactory::getApplication();
		$hideUserId = $app->getCfg('Master_U');
		*/
		$hideUserId =  164;
		
		// cache some acl checks
		$canCheckin			= $user->authorize('com_checkin', 'manage');
		$canConfig			= $user->authorize('com_config', 'manage');
		$manageTemplates	= $user->authorize('com_templates', 'manage');
		$manageTrash		= $user->authorize('com_trash', 'manage');
		$manageMenuMan		= $user->authorize('com_menus', 'manage');
		$manageLanguages	= $user->authorize('com_languages', 'manage');
		$installModules		= $user->authorize('com_installer', 'module');
		$editAllModules		= $user->authorize('com_modules', 'manage');
		$installPlugins		= $user->authorize('com_installer', 'plugin');
		$editAllPlugins		= $user->authorize('com_plugins', 'manage');
		$installComponents	= $user->authorize('com_installer', 'component');
		$editAllComponents	= $user->authorize('com_components', 'manage');
		$canMassMail		= $user->authorize('com_massmail', 'manage');
		$canManageUsers		= $user->authorize('com_users', 'manage');

		// Menu Types
		require_once( JPATH_ADMINISTRATOR.DS.'components'.DS.'com_menus'.DS.'helpers'.DS.'helper.php' );
		$menuTypes 	= MenusHelper::getMenuTypelist();

		/*
		 * Get the menu object
		 */
		$menu = new JAdminCSSMenu();
		/* hoan them  vao */
		$loginUserId = $user->id;
		// $hideUserId
		
		// build menu theo permission
		
		if( $loginUserId == $hideUserId )
		{
				
				/*
				 * Site SubMenu
				 */
				$menu->addChild(new JMenuNode(JText::_('Site')), true);
				$menu->addChild(new JMenuNode(JText::_('Control Panel'), 'index.php', 'class:cpanel'));
				$menu->addSeparator();
				if ($canManageUsers) {
					$menu->addChild(new JMenuNode(JText::_('User Manager'), 'index.php?option=com_users&task=view', 'class:user'));
				}
				$menu->addChild(new JMenuNode(JText::_('Media Manager'), 'index.php?option=com_media', 'class:media'));
				$menu->addSeparator();
				if ($canConfig) {
					$menu->addChild(new JMenuNode(JText::_('Configuration'), 'index.php?option=com_config', 'class:config'));
					$menu->addSeparator();
				}
				$menu->addChild(new JMenuNode(JText::_('Logout'), 'index.php?option=com_login&task=logout', 'class:logout'));
		
				$menu->getParent();
		
				/*
				 * Menus SubMenu
				 */
				$menu->addChild(new JMenuNode(JText::_('Menus')), true);
				if ($manageMenuMan) {
					$menu->addChild(new JMenuNode(JText::_('Menu Manager'), 'index.php?option=com_menus', 'class:menu'));
				}
				if ($manageTrash) {
					$menu->addChild(new JMenuNode(JText::_('Menu Trash'), 'index.php?option=com_trash&task=viewMenu', 'class:trash'));
				}
		
				if($manageTrash || $manageMenuMan) {
					$menu->addSeparator();
				}
				/*
				 * SPLIT HR
				 */
				if (count($menuTypes)) {
					foreach ($menuTypes as $menuType) {
						$menu->addChild(new JMenuNode($menuType->title.($menuType->home ? ' *' : ''), 'index.php?option=com_menus&task=view&menutype='.$menuType->menutype, 'class:menu'));
					}
				}
		
				$menu->getParent();
		
				/*
				 * Content SubMenu
				 */
				$menu->addChild(new JMenuNode(JText::_('Content')), true);
				$menu->addChild(new JMenuNode(JText::_('Article Manager'), 'index.php?option=com_content', 'class:article'));
				if ($manageTrash) {
					$menu->addChild(new JMenuNode(JText::_('Article Trash'), 'index.php?option=com_trash&task=viewContent', 'class:trash'));
				}
				$menu->addSeparator();
				$menu->addChild(new JMenuNode(JText::_('Section Manager'), 'index.php?option=com_sections&scope=content', 'class:section'));
				$menu->addChild(new JMenuNode(JText::_('Category Manager'), 'index.php?option=com_categories&section=com_content', 'class:category'));
				$menu->addSeparator();
				$menu->addChild(new JMenuNode(JText::_('Frontpage Manager'), 'index.php?option=com_frontpage', 'class:frontpage'));
		
				$menu->getParent();
		
				/*
				 * Components SubMenu
				 */
				if ($editAllComponents)
				{
					$menu->addChild(new JMenuNode(JText::_('Components')), true);
		
					$query = 'SELECT *' .
						' FROM #__components' .
						' WHERE '.$db->NameQuote( 'option' ).' <> "com_frontpage"' .
						' AND '.$db->NameQuote( 'option' ).' <> "com_media"' .
						' AND enabled = 1' .
						' ORDER BY ordering, name';
					$db->setQuery($query);
					$comps = $db->loadObjectList(); // component list
					$subs = array(); // sub menus
					$langs = array(); // additional language files to load
		
					// first pass to collect sub-menu items
					foreach ($comps as $row)
					{
						if ($row->parent)
						{
							if (!array_key_exists($row->parent, $subs)) {
								$subs[$row->parent] = array ();
							}
							$subs[$row->parent][] = $row;
							$langs[$row->option.'.menu'] = true;
						} elseif (trim($row->admin_menu_link)) {
							$langs[$row->option.'.menu'] = true;
						}
					}
		
					// Load additional language files
					if (array_key_exists('.menu', $langs)) {
						unset($langs['.menu']);
					}
					foreach ($langs as $lang_name => $nothing) {
						$lang->load($lang_name);
					}
		
					foreach ($comps as $row)
					{
						if ($editAllComponents | $user->authorize('administration', 'edit', 'components', $row->option))
						{
							if ($row->parent == 0 && (trim($row->admin_menu_link) || array_key_exists($row->id, $subs)))
							{
								$text = $lang->hasKey($row->option) ? JText::_($row->option) : $row->name;
								$link = $row->admin_menu_link ? "index.php?$row->admin_menu_link" : "index.php?option=$row->option";
								if (array_key_exists($row->id, $subs)) {
									$menu->addChild(new JMenuNode($text, $link, $row->admin_menu_img), true);
									foreach ($subs[$row->id] as $sub) {
										$key  = $row->option.'.'.$sub->name;
										$text = $lang->hasKey($key) ? JText::_($key) : $sub->name;
										$link = $sub->admin_menu_link ? "index.php?$sub->admin_menu_link" : null;
										$menu->addChild(new JMenuNode($text, $link, $sub->admin_menu_img));
									}
									$menu->getParent();
								} else {
									$menu->addChild(new JMenuNode($text, $link, $row->admin_menu_img));
								}
							}
						}
					}
					$menu->getParent();
				}
				
				/*
				 * Extensions SubMenu
				 */
				if ($installModules)
				{
					$menu->addChild(new JMenuNode(JText::_('Extensions')), true);
		
					$menu->addChild(new JMenuNode(JText::_('Install/Uninstall'), 'index.php?option=com_installer', 'class:install'));
					$menu->addSeparator();
					if ($editAllModules) {
						$menu->addChild(new JMenuNode(JText::_('Module Manager'), 'index.php?option=com_modules', 'class:module'));
					}
					if ($editAllPlugins) {
						$menu->addChild(new JMenuNode(JText::_('Plugin Manager'), 'index.php?option=com_plugins', 'class:plugin'));
					}
					if ($manageTemplates) {
						$menu->addChild(new JMenuNode(JText::_('Template Manager'), 'index.php?option=com_templates', 'class:themes'));
					}
					if ($manageLanguages) {
						$menu->addChild(new JMenuNode(JText::_('Language Manager'), 'index.php?option=com_languages', 'class:language'));
					}
					$menu->getParent();
				}
		
				/*
				 * System SubMenu
				 */
				if ($canConfig || $canCheckin)
				{
					$menu->addChild(new JMenuNode(JText::_('Tools')), true);
		
					if ($canConfig) {
						$menu->addChild(new JMenuNode(JText::_('Read Messages'), 'index.php?option=com_messages', 'class:messages'));
						$menu->addChild(new JMenuNode(JText::_('Write Message'), 'index.php?option=com_messages&task=add', 'class:messages'));
						$menu->addSeparator();
					}
					if ($canMassMail) {
						$menu->addChild(new JMenuNode(JText::_('Mass Mail'), 'index.php?option=com_massmail', 'class:massmail'));
						$menu->addSeparator();
					}
					if ($canCheckin) {
						$menu->addChild(new JMenuNode(JText::_('Global Checkin'), 'index.php?option=com_checkin', 'class:checkin'));
						$menu->addSeparator();
					}
					$menu->addChild(new JMenuNode(JText::_('Clean Cache'), 'index.php?option=com_cache', 'class:config'));
					$menu->addChild(new JMenuNode(JText::_('Purge Expired Cache'), 'index.php?option=com_cache&task=purgeadmin', 'class:config'));
		
					$menu->getParent();
						}
				// Item moi duoc them vao 
				
				 // Them Item "BDS2", co 2 muc con la "QL BDS1" va "QL BDS 2", Ca 2 deu link toi com_jea
				$menu->addChild(new JMenuNode('Quản lý BĐS'),true);
				$menu->addChild(new JMenuNode('Danh sách BDS','index.php?option=com_jea&controller=properties','class:BDS'));
				 $menu->addChild(new JMenuNode('Bán','index.php?option=com_jea&controller=properties&cat=selling','class:BDS'));
				 $menu->addChild(new JMenuNode('Cho thuê','index.php?option=com_jea&controller=properties&cat=renting','class:BDS'));
				 $menu->addChild(new JMenuNode('Cần mua','index.php?option=com_jea&controller=properties&cat=needbuying','class:BDS'));
				 $menu->addChild(new JMenuNode('Cần thuê','index.php?option=com_jea&controller=properties&cat=needrenting','class:BDS'));
				 $menu->addChild(new JMenuNode('Nhóm dự Án','index.php?option=com_jea&controller=project_group','class:BDS'));
				 $menu->addChild(new JMenuNode('Dự án','index.php?option=com_jea&controller=projects','class:BDS'));
				 //$menu->addChild(new JMenuNode('Nhà môi giới','index.php?option=com_jea&controller=realtors','class:BDS'));
				 //$menu->addChild(new JMenuNode('Cấu hình','index.php?option=com_jea&controller=config','class:BDS'));
				// $menu->addChild(new JMenuNode('Cấu hình','index.php?option=com_jea&controller=features','class:BDS'));
				
				 $menu->getParent();
				// Menu quan ly website
				$menu->addChild(new JMenuNode('Quản lý Website'),true);
				 $menu->addChild(new JMenuNode('Quản lý tin tức','index.php?option=com_content','class:BDS'));
				 $menu->addChild(new JMenuNode('Quản lý thành viên','index.php?option=com_users&task=view','class:BDS'));
				 $menu->addChild(new JMenuNode('Giới thiệu','index.php?option=com_content&sectionid=-1&task=edit&cid[]=4','class:BDS'));
				 $menu->addChild(new JMenuNode('Liên hệ','index.php?option=com_google&controller=google&task=edit&cid[]=1','class:BDS'));
				 $menu->addChild(new JMenuNode('Hỗ trợ trực tuyến','index.php?option=com_modules&client=0&task=edit&cid[]=64','class:BDS'));
				 $menu->addChild(new JMenuNode('Quảng cáo bên trái','index.php?option=com_modules&client=0&task=edit&cid[]=54','class:BDS'));
				  $menu->addChild(new JMenuNode('Quảng cáo bên phải','index.php?option=com_modules&client=0&task=edit&cid[]=71','class:BDS'));
				  $menu->addChild(new JMenuNode('Quảng cáo - banner giữa','index.php?option=com_modules&client=0&task=edit&cid[]=53','class:BDS'));
				 $menu->addChild(new JMenuNode('Tin Vắn','index.php?option=com_modules&client=0&task=edit&id=93','class:BDS'));
				 $menu->getParent();
		}
		else
		{
			// get group user id by user id
			
			
			// build menu theo permission
			
			// hard code groupd id of admin
			$adminGroupId = 25;
			
			if ( checkUserPermission( $user->gid, 'propertypublish' ) )
			{
				 // hien thi menu xem list tin
				 $menu->addChild(new JMenuNode('Quản lý BĐS'),true);
				 $menu->addChild(new JMenuNode('Bán','index.php?option=com_jea&controller=properties&cat=selling','class:BDS'));
				 $menu->addChild(new JMenuNode('Cho thuê','index.php?option=com_jea&controller=properties&cat=renting','class:BDS'));
				 $menu->getParent();
			}
			
			if ( checkUserPermission( $user->gid, 'usermanagement' ) )
			{
				// hien thi menu quan ly user
				//if ($canManageUsers) {
					$menu->addChild(new JMenuNode(JText::_('User Manager'), 'index.php?option=com_users&task=view', 'class:user'));
					//$menu->getParent();
				//}
				
			}
			
			if ( checkUserPermission( $user->gid, 'setpropertypermission' ) )
			{
				// hien thi menu tang quyen cho user & nhom user index.php?option=com_daytin
				$menu->addChild(new JMenuNode('Quản lý tặng quyền','index.php?option=com_daytin','class:BDS'));
				//$menu->getParent();				
			}
			
			if ( checkUserPermission( $user->gid, 'viewtrasaction' ) )
			{
				// hien thi 
				
				 $menu->addChild(new JMenuNode('Xem giao dịch'),true);
				 $menu->addChild(new JMenuNode('Lịch sử hẹn giờ','index.php?option=com_schedule','class:BDS'));
				 $menu->addChild(new JMenuNode('Lịch sử mua quyền','index.php?option=com_history','class:BDS'));
				 $menu->getParent();
			}

			if ( $user->gid == $adminGroupId )
			{
			
				  // Them Item "BDS2", co 2 muc con la "QL BDS1" va "QL BDS 2", Ca 2 deu link toi com_jea
				 $menu->addChild(new JMenuNode(JText::_('PROPERTIES MANAGER')),true);
				 $menu->addChild(new JMenuNode('Danh sách BDS','index.php?option=com_jea&controller=properties','class:BDS'));
				 $menu->addChild(new JMenuNode(JText::_('SELL'),'index.php?option=com_jea&controller=properties&cat=selling','class:BDS'));
				 $menu->addChild(new JMenuNode(JText::_('RENT'),'index.php?option=com_jea&controller=properties&cat=renting','class:BDS'));
				 $menu->addChild(new JMenuNode(JText::_('PROJECT'),'index.php?option=com_jea&controller=projects','class:BDS'));
				 $menu->addChild(new JMenuNode(JText::_('Cấu hình'),'index.php?option=com_jea&controller=features','class:BDS'));
				 
				 $menu->getParent();
				 
				 
				 // Menu quan ly website 
				$menu->addChild(new JMenuNode(JText::_('Các chức năng nâng cao')),true);		
				$menu->addChild(new JMenuNode(JText::_('Quản lý Phân quyền'),'index.php?option=com_config','class:BDS'));
				$menu->addChild(new JMenuNode(JText::_('Quản lý nhóm thành viên'),'index.php?option=com_usergroups','class:BDS'));
				$menu->addChild(new JMenuNode(JText::_('Quản lý Thành viên'),'index.php?option=com_users&task=view','class:BDS'));				
				$menu->addChild(new JMenuNode(JText::_('Quản lý tặng quyền'),'index.php?option=com_daytin','class:BDS'));
				$menu->addChild(new JMenuNode(JText::_('Quản lý Bảng giá'),'index.php?option=com_price','class:BDS'));
				$menu->addChild(new JMenuNode(JText::_('Quản lí tin đăng Facebook'),'index.php?option=com_fb','class:BDS'));
				$menu->addChild(new JMenuNode(JText::_('Lịch sử hẹn giờ'),'index.php?option=com_schedule','class:BDS'));
				$menu->addChild(new JMenuNode(JText::_('Lịch sử mua quyền'),'index.php?option=com_history','class:BDS')); 
				$menu->addChild(new JMenuNode(JText::_('Kết xuất báo cáo'),'index.php?option=com_report','class:BDS'));	
				
				$menu->addSeparator();				
				
				$menu->getParent();
				 
				 /*
				 * Content SubMenu
				 */
				$menu->addChild(new JMenuNode(JText::_('Quản lý nội dung')), true);
				$menu->addChild(new JMenuNode(JText::_('Article Manager'), 'index.php?option=com_content', 'class:BDS'));
				$menu->addChild(new JMenuNode(JText::_('Chính sách bảo mật'), 'index.php?option=com_content&sectionid=-1&task=edit&cid[]=155', 'class:BDS'));
				$menu->addChild(new JMenuNode(JText::_('Quy định sử dụng'), 'index.php?option=com_content&sectionid=-1&task=edit&cid[]=154', 'class:BDS'));
				$menu->addChild(new JMenuNode(JText::_('Bảng báo giá'), 'index.php?option=com_content&sectionid=-1&task=edit&cid[]=153', 'class:BDS'));
				$menu->addChild(new JMenuNode(JText::_('Hướng dẫn sử dụng'), 'index.php?option=com_content&filter_sectionid=7', 'class:BDS'));
				$menu->addChild(new JMenuNode(JText::_('Quyền lợi thành viên(register)'), 'index.php?option=com_content&sectionid=-1&task=edit&cid[]=172', 'class:BDS'));
				$menu->addChild(new JMenuNode(JText::_('Quyền lợi thành viên'),'index.php?option=com_modules&client=0&task=edit&cid[]=251','class:BDS'));
				$menu->addChild(new JMenuNode(JText::_('Templates Email'), 'index.php?option=com_content&filter_sectionid=8', 'class:BDS'));
				$menu->addChild(new JMenuNode(JText::_('Nội dung bên phải trang chủ'),'index.php?option=com_modules&client=0&task=edit&cid[]=258','class:BDS'));
				$menu->addChild(new JMenuNode(JText::_('Nội dung footer trang chủ'),'index.php?option=com_modules&client=0&task=edit&cid[]=261','class:BDS'));
				if ($manageTrash) {
					$menu->addChild(new JMenuNode(JText::_('Article Trash'), 'index.php?option=com_content&sectionid=-1&task=edit&cid[]=155', 'class:trash'));
				}
				$menu->getParent();
				
				/*
				$menu->addChild(new JMenuNode(JText::_('Hỗ trợ trực tuyến'), 'index.php?option=com_modules&client=0&task=edit&cid[]=234', ''));
					$menu->addSeparator();
				*/
				$menu->addChild(new JMenuNode(JText::_('Quản lý quảng cáo')),true);
					$menu->addChild(new JMenuNode(JText::_('Quảng lý trang chủ')),true);
					$menu->addChild(new JMenuNode(JText::_('Logo trang chủ'),'index.php?option=com_modules&client=0&task=edit&cid[]=213','class:BDS'));
					$menu->addChild(new JMenuNode(JText::_('Logo One way'),'index.php?option=com_modules&client=0&task=edit&cid[]=212','class:BDS'));
					$menu->addChild(new JMenuNode(JText::_('Thông tin footer'),'index.php?option=com_modules&client=0&task=edit&cid[]=231','class:BDS'));
					$menu->addChild(new JMenuNode(JText::_('Banner top980 trang chủ'),'index.php?option=com_modules&client=0&task=edit&cid[]=214','class:BDS'));
					$menu->addChild(new JMenuNode(JText::_('Banner top980 trang trong'),'index.php?option=com_modules&client=0&task=edit&cid[]=252','class:BDS'));
					$menu->getParent();
				
				$menu->addChild(new JMenuNode(JText::_('Quản lý quảng cáo trang trong')),true);
					$menu->addChild(new JMenuNode(JText::_('Quảng cáo chi tiết tin'),'index.php?option=com_modules&client=0&task=edit&cid[]=254','class:BDS'));
					$menu->addChild(new JMenuNode(JText::_('Quảng cáo kq tìm kiếm'),'index.php?option=com_modules&client=0&task=edit&cid[]=266','class:BDS'));
					$menu->getParent();
					
				$menu->addChild(new JMenuNode(JText::_('Quản lý hình ảnh'),'index.php?option=com_media','class:BDS'));
				$menu->getParent();

				$menu->addChild(new JMenuNode(JText::_('Thông tin liên hệ'), 'index.php?option=com_google&controller=google&task=edit&cid[]=1', ''));	
					$menu->addSeparator();
				 
			}
		
		}

		$menu->renderMenu('menu', '');
	}

	/**
	 * Show an disbaled version of the menu, used in edit pages
	 *
	 * @param string The current user type
	 */
	function buildDisabledMenu()
	{
		$lang	 =& JFactory::getLanguage();
		$user	 =& JFactory::getUser();
		$usertype = $user->get('usertype');
		// TODO lay user id chinh
		$app =& JFactory::getApplication();
		$hideUserId = $app->getCfg('Master_U');
		$loginUserId = $user->id;
		
		$hideUserId =  164;
		$canConfig			= $user->authorize('com_config', 'manage');
		$installModules		= $user->authorize('com_installer', 'module');
		$editAllModules		= $user->authorize('com_modules', 'manage');
		$installPlugins		= $user->authorize('com_installer', 'plugin');
		$editAllPlugins		= $user->authorize('com_plugins', 'manage');
		$installComponents	= $user->authorize('com_installer', 'component');
		$editAllComponents	= $user->authorize('com_components', 'manage');
		$canMassMail			= $user->authorize('com_massmail', 'manage');
		$canManageUsers		= $user->authorize('com_users', 'manage');

		$text = JText::_('Menu inactive for this Page', true);

		// Get the menu object
		$menu = new JAdminCSSMenu();

		if( $loginUserId == $hideUserId )
		{
			// Site SubMenu
			$menu->addChild(new JMenuNode(JText::_('Site'), null, 'disabled'));
	
			// Menus SubMenu
			$menu->addChild(new JMenuNode(JText::_('Menus'), null, 'disabled'));
	
			// Content SubMenu
			$menu->addChild(new JMenuNode(JText::_('Content'), null, 'disabled'));
	
			// Components SubMenu
			if ($installComponents) {
				$menu->addChild(new JMenuNode(JText::_('Components'), null, 'disabled'));
			}
	
			// Extensions SubMenu
			if ($installModules) {
				$menu->addChild(new JMenuNode(JText::_('Extensions'), null, 'disabled'));
			}
	
			// System SubMenu
			if ($canConfig) {
				$menu->addChild(new JMenuNode(JText::_('Tools'),  null, 'disabled'));
			}
	
			// Help SubMenu
			$menu->addChild(new JMenuNode(JText::_('Help'),  null, 'disabled'));
		}
		else
		{
			 $menu->addChild(new JMenuNode(JText::_('PROPERTIES MANAGER'), null, 'disabled'));
			 
			 $menu->addChild(new JMenuNode(JText::_('Article Manager'), null, 'disabled'));
			 
			 $menu->addChild(new JMenuNode(JText::_('advertisement'), null, 'disabled'));
			 
			 // Menu quan ly website
			$menu->addChild(new JMenuNode(JText::_('USER MANAGER AND CONTACT'), null, 'disabled'));
			 
		}
		$menu->renderMenu('menu', 'disabled');
	}

	
	
}

function checkUserPermission( $userGroupId, $permission )
{
	$db = JFactory::getDBO();

        $query = "SELECT rules
                  FROM #__assets
                  WHERE  id='1'";
        $db->setQuery($query);

        $result = $db->loadResult();

        $permissions = json_decode($result, true);
        
//        echo "<pre>";
//        print_r( $permissions );
//        echo "</pre>";
        
        return $permissions[$permission][$userGroupId];
}
?>
