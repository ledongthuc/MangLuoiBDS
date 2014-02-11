<?php
/**
 * Core Design Scriptegrator plugin for Joomla! 1.5
 * @author		Daniel Rataj, <info@greatjoomla.com>
 * @package		Joomla 
 * @subpackage	System
 * @category	Plugin
 * @version		1.4.2
 * @copyright	Copyright (C) 2007 - 2010 Great Joomla!, http://www.greatjoomla.com
 * @license		http://www.gnu.org/copyleft/gpl.html GNU/GPL 3
 * 
 * This file is part of Great Joomla! extension.   
 * This extension is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This extension is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see <http://www.gnu.org/licenses/>.
 */

defined('_JEXEC') or die( 'Restricted access' );

class highslide {
	
	/**
	 * Import files to header
	 * 
	 * @return array
	 */
	function importFiles() {
		return array(
			'highslide-full.min.js',
			'highslide.css'
		);
	}
	
	/**
	 * Script declaration
	 * 
	 * @param $params
	 * @return string
	 */
	function scriptDeclaration($params = null) {
		
		// define database parameters
		$outlineType = $params->get('outlineType', 'rounded-white');
		$outlineWhileAnimating = (int) $params->get('outlineWhileAnimating', 1);
		$showCredits = (int) $params->get('showCredits', 1);
		$expandDuration = (int) $params->get('expandDuration', 250);
		$anchor = $params->get('anchor', 'auto');
		$align = $params->get('align', 'auto');
		$transitions = $params->get('transitions', 'expand');
		$dimmingOpacity = $params->get('dimmingOpacity', '0');
		// end

		// define script parameters
		switch ($outlineWhileAnimating)
		{
			case 1:
				$outlineWhileAnimating = 'true';
				break;
			case 0:
				$outlineWhileAnimating = 'false';
				break;
			default:
				$outlineWhileAnimating = 'true';
				break;
		}
		
		if ($showCredits) {
			$showCredits = 'true';
		} else {
			$showCredits = 'false';
		}

		switch ($transitions)
		{
			case 'expand':
				$transitions = '["expand"]';
				break;
			case 'fade':
				$transitions = '["fade"]';
				break;
			case 'expand+fade':
				$transitions = '["expand", "fade"]';
				break;
			case 'fade+expand':
				$transitions = '["fade", "expand"]';
				break;
			default:
				$transitions = '["expand"]';
				break;
		}
		// end
		
		$script = "
		<!--
		var cdhs = hs;
		hs.graphicsDir = '" . JScriptegrator::folder() . "/libraries/highslide/graphics/';
    	hs.outlineType = '" . $outlineType . "';
    	hs.outlineWhileAnimating = " . $outlineWhileAnimating . ";
    	hs.showCredits = " . $showCredits . ";
    	hs.expandDuration = " . $expandDuration . ";
		hs.anchor = '" . $anchor . "';
		hs.align = '" . $align . "';
		hs.transitions = " . $transitions . ";
		hs.dimmingOpacity = " . $dimmingOpacity . ";
		hs.lang = {
		   loadingText :     '" . JText::_('CDS_LOADING') . "',
		   loadingTitle :    '" . JText::_('CDS_CANCELCLICK') . "',
		   focusTitle :      '" . JText::_('CDS_FOCUSCLICK') . "',
		   fullExpandTitle : '" . JText::_('CDS_FULLEXPANDTITLE') . "',
		   fullExpandText :  '" . JText::_('CDS_FULLEXPANDTEXT') . "',
		   creditsText :     '" . JText::_('CDS_CREDITSTEXT') . "',
		   creditsTitle :    '" . JText::_('CDS_CREDITSTITLE') . "',
		   previousText :    '" . JText::_('CDS_PREVIOUSTEXT') . "',
		   previousTitle :   '" . JText::_('CDS_PREVIOUSTITLE') . "',
		   nextText :        '" . JText::_('CDS_NEXTTEXT') . "',
		   nextTitle :       '" . JText::_('CDS_NEXTTITLE') . "',
		   moveTitle :       '" . JText::_('CDS_MOVETITLE') . "',
		   moveText :        '" . JText::_('CDS_MOVETEXT') . "',
		   closeText :       '" . JText::_('CDS_CLOSETITLE') . "',
		   closeTitle :      '" . JText::_('CDS_CLOSETEXT') . "',
		   resizeTitle :     '" . JText::_('CDS_RESIZETITLE') . "',
		   playText :        '" . JText::_('CDS_PLAYTEXT') . "',
		   playTitle :       '" . JText::_('CDS_PLAYTITLE') . "',
		   pauseText :       '" . JText::_('CDS_PAUSETEXT') . "',
		   pauseTitle :      '" . JText::_('CDS_PAUSETITLE') . "',   
		   number :          '" . JText::_('CDS_NUMBER') . "',
		   restoreTitle :    '" . JText::_('CDS_RESTORETITLE') . "'
		};
		//-->
		";
		
		return $script;
	}
}

?>