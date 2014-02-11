<?php
/*****************************************************************************
/  Module - Infinity (MyGosu) Menus 2005/04/25
/  Version  1-0-8
/  Copyright Guy Thomas [brudinie]
/  brudinie@yahoo.co.uk
/  @ Released under GNU/GPL License : http://www.gnu.org/copyleft/gpl.html
/
/  Javascript Drop Down & Tree Menu Systems by Cezary Tomczak (Mygosu) (modded by Guy Thomas)
/  Mygosu: - http://gosu.pl/dhtml/mygosumenu.html
*****************************************************************************/


defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

/**
/* Loads main class file
*/	
$params->set( 'module_name', 'Mygosu Menus' );
$params->set( 'module', 'infinity_menus' );
$params->set( 'absPath', $mosConfig_absolute_path . '/modules/' . $params->get( 'module' ) );
$params->set( 'LSPath', $mosConfig_live_site . '/modules/' . $params->get( 'module' ) );
include_once( $params->get( 'absPath' ) .'/mainclass.php' );

/**
/* Loads menu items
*/	
$query = "SELECT * FROM #__menu "
	. "\n WHERE menutype = '". $params->get( 'menu' ) ."' "
	. "\n AND access <= $my->gid "
	. "\n AND published = '1' "
	. "\n ORDER BY '". $params->get( 'order' ) ."' ASC ";
	
$database->setQuery( $query );
$menus = $database->loadObjectList( );   


/**
/* Instantiate Menu
*/	
$mensys= new mygosu_menus ( $params );

/**
/* Load Menu Items
*/
$mensys->mygosu_menu_items ( $database, $my->gid, $params, 0, 0, 0);

/**
/* End Menu
*/
$mensys->module_end( $params );


?>

