<?php
/*------------------------------------------------------------------------
# JA Zeolite for Joomla 1.5 - Version 1.0 - Licence Owner JA108425
# ------------------------------------------------------------------------
# Copyright (C) 2004-2008 J.O.O.M Solutions Co., Ltd. All Rights Reserved.
# @license - Copyrighted Commercial Software
# Author: J.O.O.M Solutions Co., Ltd
# Websites:  http://www.joomlart.com -  http://www.joomlancers.com
# This file may not be redistributed in whole or significant part.
-------------------------------------------------------------------------*/

// no direct access
defined('_JEXEC') or die('Restricted access');

/**
 * This is a file to add template specific chrome to module rendering.  To use it you would
 * set the style attribute for the given module(s) include in your template to use the style
 * for each given modChrome function.
 *
 * eg.  To render a module mod_test in the sliders style, you would use the following include:
 * <jdoc:include type="module" name="test" style="slider" />
 *
 * This gives template designers ultimate control over how modules are rendered.
 *
 * NOTICE: All chrome wrapping methods should be named: modChrome_{STYLE} and take the same
 * two arguments.
 */

/*
 * Module chrome for rendering the module in a slider
 */
function modChrome_slider($module, &$params, &$attribs)
{
	jimport('joomla.html.pane');
	// Initialize variables
	$sliders = & JPane::getInstance('sliders');
	$sliders->startPanel( JText::_( $module->title ), 'module' . $module->id );
	echo $module->content;
	$sliders->endPanel();
}
function modChrome_slider2($module, &$params, &$attribs)
{
	jimport('joomla.html.pane');
	// Initialize variables
	$sliders = & JPane::getInstance('sliders');
	$sliders->startPanel( JText::_( $module->title ), 'module' . $module->id );
	echo $module->content;
	$sliders->endPanel();
}
function modChrome_search_right($module, &$params, &$attribs)
{
	jimport('joomla.html.pane');
	// Initialize variables
	$sliders = & JPane::getInstance('sliders');
	$sliders->startPanel( JText::_( $module->title ), 'module' . $module->id );
	echo $module->content;
	$sliders->endPanel();
}
function modChrome_search_left($module, &$params, &$attribs)
{
	jimport('joomla.html.pane');
	// Initialize variables
	$sliders = & JPane::getInstance('sliders');
	$sliders->startPanel( JText::_( $module->title ), 'module' . $module->id );
	echo $module->content;
	$sliders->endPanel();
}
/*Sytle cho cac vị trí*/
/*style của vị trí banner*/
function modChrome_banner($module, &$params, &$attribs)
{ ?>
		<div class="moduletable<?php echo $params->get('moduleclass_sfx'); ?>" id="Mod<?php echo $module->id; ?>">
			<?php echo $module->content; ?>
    	</div>
	<?php
}
function modChrome_bds($module, &$params, &$attribs){
 ?>	

		<!-- div an chua noi dung cua ajax paging -->
		<div id="hidden_ajax_paging_<?php echo $module->noiDungId?>" style='display:none'></div>
		<!-- end div an -->
		<div class="<?php echo $params->get('moduleclass_sfx');?>" id="Mod<?php echo $module->id; ?>">
			<div class="<?php echo $params->get('moduleclass_sfx');?>1">
				<div class="<?php echo $params->get('moduleclass_sfx');?>2">
					<div class="<?php echo $params->get('moduleclass_sfx');?>3">
						<div class="<?php echo $params->get('moduleclass_sfx');?>4">
							<div class="<?php echo $params->get('moduleclass_sfx');?>5">
						<?php  if(!empty($module->showtitle)){if ($module->showtitle != 0) : ?>
								<?php 
								if ( JRequest::getVar('Issearch') && $module->module =="mod_danh_sach_BDS" )
								{
								?>
									<h3><span><?php  //echo JText::_('DANH SÁCH BẤT ĐỘNG SẢN') ?></span></h3>
								<?php 
								}
								else
								{
									if(!empty($module->title)){
								?>
									<h3><span><?php echo $module->title; ?></span></h3>
								<?php
									}
								}
						endif; }?>
							<div class="<?php echo $params->get('moduleclass_sfx');?>bogoc-noidung" id= "noi_dung<?php echo $module->id; ?>">
							<?php echo $module->content; ?>
							</div>
							</div>
						</div>
					</div>
			</div>
		</div>
    </div>
	<?php
}
/*Style cho các vị trí*/
function modChrome_box8Content1($module, &$params, &$attribs)
{ ?>
		<div class="moduletable<?php echo $params->get('moduleclass_sfx'); ?>" id="Mod<?php echo $module->id; ?>">
		 									
												<div id="box8content_title">
                                              <!-- <div>
                                                <div>
                                                
												<?php if ($module->showtitle != 0) : ?>
												
													<?php 
													Global $pagingBDS_title;
													?>
													
												<div style="float:left" >
													<h3 style="background:none;">
												<?php echo $module->title;

												?>
												</h3>
												
												</div>
												
												<?php endif; ?>
                                                </div>
                                               </div> -->
                                                </div>
                                               <div id="box8_content"> 
                                               <div id="box8_centent2">
												<?php echo $module->content; ?>
                                                </div>
                                                </div>
                                                
											
										
									
								
							
						
					
                  
    </div>
	<?php
}
?>