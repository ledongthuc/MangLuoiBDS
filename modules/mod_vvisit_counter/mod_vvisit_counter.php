<?php
/**
* @version		$Id: mod_vvisit_counter.php 2009-08-03 vinaora $
* @package		VINAORA VISITORS COUNTER
* @copyright	Copyright (C) 2007 - 2009 VINAORA.COM. All rights reserved.
* @license		GNU/GPL
* @website		http://vinaora.com
* @email		admin@vinaora.com
*
*/

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );
?>
<?php

// Birth day of Joomla: 15 Sept 2005
define( 'BIRTH_DAY_JOOMLA' , 1126742400 );
define( 'VERSION_MODULE' , "1.7.3" );
define( 'CACHE_TIMEOUT_DEFAULT' , 900 );
define( 'ONLINE_TIME_DEFAULT' , 20 );
define( 'DIGIT_COUNTER_PATH' , 'modules/mod_vvisit_counter/images/digit_counter' );
define( 'STATISTIC_ICON_PATH' , 'modules/mod_vvisit_counter/images/stats' );

require_once ( dirname(__FILE__).DS.'helper.php' );
require_once ( dirname(__FILE__).DS.'includes'.DS.'browsers.php' );
require_once ( dirname(__FILE__).DS.'includes'.DS.'datetime.php' );

/* ------------------------------------------------------------------------------------------------ */
// Read our Parameters
$mode			=	@$params->get( 'mode', 'full' );

$today			=	@$params->get( 'today', 'Today' );
$yesterday		=	@$params->get( 'yesterday', 'Yesterday' );
$x_week			=	@$params->get( 'week', 'This week' );
$l_week			=	@$params->get( 'lweek', 'Last week' );
$x_month		=	@$params->get( 'month', 'This month' );
$l_month		=	@$params->get( 'lmonth', 'Last month' );
$all			=	@$params->get( 'all', 'All days' );

$beginday		=	@$params->get( 'beginday', '' );

$online			=	@$params->get( 'online', 'Online Now: ' );
$guestip		=	@$params->get( 'guestip', 'Your IP: ' );
$guestinfo		=	@$params->get( 'guestinfo', 'Your: ' );
$formattime		=	@$params->get( 'formattime', 'Today: %B %d, %Y' );

$digit_type 	= 	@$params->get( 'digit_type', 'default' );
$number_digits	=	(int) @$params->get( 'number_digits', 6 );

$stats_type 	= 	@$params->get( 'stats_type', 'default' );
$widthtable		=	(int) @$params->get( 'widthtable', 90 );

$iplifetime		=	(int) @$params->get( 'iplifetime', 10 );

$initialvalue	=	(int) @$params->get( 'initialvalue', 0 );

$issunday		=	@$params->get( 'issunday', true );

$deldays		=	(int) @$params->get( 'deldays', 0 );

$delday			=	(int) @$params->get( 'delday', 15 );

$pretext  		= 	@$params->get( 'pretext', "" );
$posttext  		= 	@$params->get( 'posttext', "" );

$iscache		=	@$params->get( 'iscache', 0 );
$cache_time		=	(int) @$params->get( 'cache_time', 900 );

/* ------------------------------------------------------------------------------------------------ */



/* ------------------------------------------------------------------------------------------------ */
// Check the Display Mode
switch ( $mode ){
	case "simple":
		$s_digit		=	true;
		
		$s_stats		=	false;
		
		$s_today		=	false;
		$s_yesterday	=	false;
		$s_week			=	false;
		$s_lweek		=	false;
		$s_month		=	false;
		$s_lmonth		=	false;
		$s_all			=	false;
		
		$s_online		=	false;
		$s_ip			=	false;
		$s_guestinfo	=	false;
		$s_timenow		=	false;
		break;
		
	case "standard":
		$s_digit		=	true;
		
		$s_stats		=	true;
		
		$s_today		=	true;
		$s_yesterday	=	true;
		$s_week			=	true;
		$s_lweek		=	true;
		$s_month		=	true;
		$s_lmonth		=	true;
		$s_all			=	true;
		
		$s_online		=	false;
		$s_ip			=	false;
		$s_guestinfo	=	false;
		$s_timenow		=	false;
		break;
		
	case "full":
		$s_digit		=	true;
		
		$s_stats		=	true;
		
		$s_today		=	true;
		$s_yesterday	=	true;
		$s_week			=	true;
		$s_lweek		=	true;
		$s_month		=	true;
		$s_lmonth		=	true;
		$s_all			=	true;
		
		$s_online		=	true;
		$s_ip			=	true;
		$s_guestinfo	=	true;
		$s_timenow		=	true;
		break;
	
	case "custom":
		$s_digit		=	modVisitCounterHelper::isEnabled( $digit_type );
		
		$s_stats		=	modVisitCounterHelper::isEnabled( $stats_type );
		
		$s_today		=	modVisitCounterHelper::isEnabled( $today );
		$s_yesterday	=	modVisitCounterHelper::isEnabled( $yesterday );
		$s_week			=	modVisitCounterHelper::isEnabled( $x_week );
		$s_lweek		=	modVisitCounterHelper::isEnabled( $l_week );
		$s_month		=	modVisitCounterHelper::isEnabled( $x_month );
		$s_lmonth		=	modVisitCounterHelper::isEnabled( $l_month );
		$s_all			=	modVisitCounterHelper::isEnabled( $all );
		
		$s_online		=	modVisitCounterHelper::isEnabled( $online );
		$s_ip			=	modVisitCounterHelper::isEnabled( $guestip );
		$s_guestinfo	=	modVisitCounterHelper::isEnabled( $guestinfo );
		$s_timenow		=	modVisitCounterHelper::isEnabled( $formattime );
		break;
}
$s_delrecords	=	modVisitCounterHelper::isEnabled( $deldays );
/* ------------------------------------------------------------------------------------------------ */
	

// From minutes to seconds
$iplifetime	=	$iplifetime * 60;

// Get Time Offset from Global Configuration of Joomla!
$config			=&	JFactory::getConfig();
$offset			=	$config->getValue('config.offset');

// May be use $offset =	$mainframe->getCfg( 'offset' );

// Get a reference to the global cache object.
$cache = & JFactory::getCache();
if ( $cache_time<0 || $cache_time>86400 ){
	$cache_time = CACHE_TIMEOUT_DEFAULT;
}
$cache->setLifeTime( $cache_time );

/* ------------------------------------------------------------------------------------------------ */
// Detect Guest's IP Address and Insert new records
$ip = "0.0.0.0";
if( !empty($_SERVER['REMOTE_ADDR']) ) $ip = $_SERVER['REMOTE_ADDR'];

// Determine Date/Time Now
// Pls see >> http://groups.drupal.org/node/4838#comment-14101 - time() or mktime() or gmmktime()
$now	=	mktime();

// Now we are checking if the ip was logged in the database.
// Depending of the value in minutes in the iplifetime variable.
// Check session time, insert new record if timeout
modVisitCounterHelper::insertVisitor( $iplifetime, $ip, $now );

// Update Date/Time Now
$now	=	mktime();

$datetime				=	& modVisitCounterDateTime::getTimeStart( $offset, $issunday, $now );

$daystart				=	$datetime["daystart"];
$local_daystart			=	$datetime["local_daystart"];
$yesterdaystart			=	$datetime["yesterdaystart"];
$local_yesterdaystart	=	$datetime["local_yesterdaystart"];
$weekstart				=	$datetime["weekstart"];
$local_weekstart		=	$datetime["local_weekstart"];
$lweekstart				=	$datetime["lweekstart"];
$local_lweekstart		=	$datetime["local_lweekstart"];
$monthstart				=	$datetime["monthstart"];
$local_monthstart		=	$datetime["local_monthstart"];
$lmonthstart			=	$datetime["lmonthstart"];
$local_lmonthstart		=	$datetime["local_lmonthstart"];
/* ------------------------------------------------------------------------------------------------ */



/* ------------------------------------------------------------------------------------------------ */
// BEGIN: Caculate number visitors of Today, Yesterday, This Week, Last Week, This Month, Last Month

// Count All Visitors
$all_visitors	=	modVisitCounterHelper::getMaxID();
$all_visitors	+=	$initialvalue;

// Count Today's Visitors
$today_visitors		= modVisitCounterHelper::getVisitors( $local_daystart );

// Count Yesterday's Visitors
if( $s_yesterday ){
	if ( $iscache ){
		$yesterday_visitors = $cache->call( array( 'modVisitCounterHelper', 'getVisitors' ), $local_yesterdaystart, $local_daystart );
	}
	else {
		$yesterday_visitors	= modVisitCounterHelper::getVisitors( $local_yesterdaystart, $local_daystart );
	}
}

// Count This Week's Visitors
if( $s_week ){
	if ( $iscache ){
		$week_visitors	= $cache->call( array( 'modVisitCounterHelper', 'getVisitors' ), $local_weekstart, $local_daystart );
		$week_visitors	+=	$today_visitors;
	}
	else{
		$week_visitors	= modVisitCounterHelper::getVisitors( $local_weekstart, $local_daystart );
		$week_visitors	+=	$today_visitors;
	}
}

// Count Last Week's Visitors
if( $s_lweek ){
	if ( $iscache ){
		$lweek_visitors	= $cache->call( array( 'modVisitCounterHelper', 'getVisitors' ), $local_lweekstart, $local_weekstart );
	}
	else{
		$lweek_visitors	= modVisitCounterHelper::getVisitors( $local_lweekstart, $local_weekstart );
	}
}

// Count This Month's Visitors
if( $s_month ){
	if ( $iscache ){
		$month_visitors		= $cache->call( array( 'modVisitCounterHelper', 'getVisitors' ), $local_monthstart, $local_daystart );
		$month_visitors		+=  $today_visitors;
	}
	else{
		$month_visitors		= modVisitCounterHelper::getVisitors( $local_monthstart, $local_daystart );
		$month_visitors		+=  $today_visitors;
	}
}

// Count Last Month's Visitors
if( $s_lmonth ){
	if ( $iscache ){
		$lmonth_visitors = $cache->call( array( 'modVisitCounterHelper', 'getVisitors' ), $local_lmonthstart, $local_monthstart );
	}
	else{
		$lmonth_visitors = modVisitCounterHelper::getVisitors( $local_lmonthstart, $local_monthstart );
	}
}

// Count Online in 20 minutes
$online_time	=	ONLINE_TIME_DEFAULT;
if( $s_online ){
	$online_visitors	= modVisitCounterHelper::getVisitors( $now - $online_time*60 );
}

// END: CACULATE VISITORS
/* ------------------------------------------------------------------------------------------------ */

/* ------------------------------------------------------------------------------------------------ */
// BEGIN: Delete old records if today is the 7th, 14th, 21th or 28th of the month.

$time	=	& JFactory::getDate( );
$time->setOffset( $offset );

if ( $s_delrecords ){

	$day	=	(int) $time->toFormat("%d");
	$minute	=	(int) $time->toFormat("%M");

	if ( ($day % 7) == 0 ){
		if ( ($minute % 20) == 0 ){
			$temp = $daystart - $deldays*24*60*60;
			modVisitCounterHelper::delVisitors( 0, $temp );
		}
	}
}

// END: Delete old records
/* ------------------------------------------------------------------------------------------------ */
$template		=	$params->get('template');
if( $template == 1)
{
	$layoutname		=	$params->get('layoutname');
	require(JModuleHelper::getLayoutPath('mod_vvisit_counter',$layoutname));
}
?>
