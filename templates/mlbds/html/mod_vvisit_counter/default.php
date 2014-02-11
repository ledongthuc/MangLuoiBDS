<?php
/**
* @version		$Id: default.php 2009-08-02 vinaora $
* @package		VINAORA VISITORS COUNTER
* @copyright	Copyright (C) 2007 - 2009 VINAORA.COM. All rights reserved.
* @license		GNU/GPL
* @website		http://vinaora.com
* @email		admin@vinaora.com
* 
* @warning		DON'T EDIT OR DELETE LINK HTTP://VINAORA.COM ON THE FOOTER OF MODULE. PLEASE CONTACT ME IF YOU WANT.
*
*/

// no direct access
defined('_JEXEC') or die('Restricted access'); 
?>
<?php
/* ------------------------------------------------------------------------------------------------ */
// BEGIN: SHOW DIGIT COUNTER
$html	=	'<!-- Vinaora Visitors Counter for Joomla! -->';
$html 	.= 	'<div>';
if ($pretext != "") $html .= '<div>'.$pretext.'</div>';

// Show digit counter
if($s_digit){

	$html .= '<div style="text-align: center;">';
	
	$arr = & modVisitCounterHelper::getDigits( $all_visitors,$number_digits );
	
	foreach ($arr as $digit){
		$html .= modVisitCounterHelper::showDigitImage( $digit_type, $digit );
	}
	$html .= '</div>';
	
}
// END: SHOW DIGIT COUNTER
/* ------------------------------------------------------------------------------------------------ */



/* ------------------------------------------------------------------------------------------------ */
// BEGIN: TABLE STATISTICS
if ( $s_stats ){

	$html		.=	'<div><table cellpadding="0" cellspacing="0" ';
	$html		.=	'style="margin: 3px; text-align: center; align: center; ';
	$html		.=	'width: '.$widthtable.'%;" class="vinaora_counter">';
	$html		.=	'<tbody align="center">';
	
	// Show today, yestoday, this week, this month, and all visitors

	if($s_today){
		$timeline	=	modVisitCounterHelper::showTimeLine( $local_daystart, 0, $offset );
		$html		.=	modVisitCounterHelper::showStatisticsRows( $stats_type, "vtoday", $timeline, $today, $today_visitors );
	}
	if($s_yesterday){
		$timeline	=	modVisitCounterHelper::showTimeLine( $local_yesterdaystart, 0, $offset );
		$html		.=	modVisitCounterHelper::showStatisticsRows( $stats_type, "vyesterday", $timeline, $yesterday, $yesterday_visitors );
	}
	if($s_week){
		$timeline	=	modVisitCounterHelper::showTimeLine( $local_weekstart, $local_daystart, $offset );
		$html		.=	modVisitCounterHelper::showStatisticsRows( $stats_type, "vweek", $timeline, $x_week, $week_visitors );
	}
	if($s_lweek){
		$timeline	=	modVisitCounterHelper::showTimeLine( $local_lweekstart, $local_weekstart, $offset );
		$html		.=	modVisitCounterHelper::showStatisticsRows( $stats_type, "vlweek", $timeline, $l_week, $lweek_visitors );
	}
	if($s_month){
		$timeline	=	modVisitCounterHelper::showTimeLine( $local_monthstart, $local_daystart, $offset );
		$html		.=	modVisitCounterHelper::showStatisticsRows( $stats_type, "vmonth", $timeline, $x_month, $month_visitors );
	}
	if($s_lmonth){
		$timeline	=	modVisitCounterHelper::showTimeLine( $local_lmonthstart, $local_monthstart, $offset );
		$html		.=	modVisitCounterHelper::showStatisticsRows( $stats_type, "vlmonth", $timeline, $l_month, $lmonth_visitors );
	}
	if($s_all){
		if ( !$beginday ) $beginday = "Visitors Counter";
		$html	.=	modVisitCounterHelper::showStatisticsRows( $stats_type, "vall", $beginday, $all, $all_visitors );
	}

	
	$html		.= "</tbody></table></div>";
}
// END: TABLE STATISTICS
/* ------------------------------------------------------------------------------------------------ */


/* ------------------------------------------------------------------------------------------------ */
// BEGIN: SHOW GUEST'S INFO
// Show Guest's Info
if ( $s_online || $s_ip || $s_guestinfo || $s_timenow ){

	$html  		.=	'<hr style="width: 90%" />';
	$html		.=	'<div style="text-align: center;">';

	if($s_online){
		$html	.= $online . " " . $online_visitors . "<br />";
	}
	
	if($s_ip){
		$html	.= $guestip . " " . $ip . "<br />";
	}
	
	if($s_guestinfo){
		$browser 	= 	modVisitCounterBrowser::browser();
		if (!empty( $browser )){
			$html	.= strtoupper($browser['name']);
			$html	.= " ";
			$html	.= $browser['version'];
			$html	.= ", ";
			$html	.= strtoupper($browser['platform']) ;
			$html		.= "<br /> ";
		}
	}
	
	if ( $s_timenow ){		
		$html		.=	$time->toFormat( $formattime );
	}
	
	$html		.=	'</div>';
}


if ($posttext != ""){
	$html		.= '<div>'.$posttext.'</div>';
}


$html .= '</div>';

// END: SHOW GUEST'S INFO
/* ------------------------------------------------------------------------------------------------ */


echo $html;
?>