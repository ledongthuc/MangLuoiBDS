/**
* @version		$Id: fckeditor.php 1154 18-1-2008 AW
* @package		JoomlaFCK
* @copyright	Copyright (C) 2006 - 2008 WebXSolution Ltd. All rights reserved.
* @license		Creative Commons Licence
* The code for this additional work for the FCKeditor has been  been written/modified by WebxSolution Ltd.
* You may not copy or distribute the work without written consent
* from WebxSolution Ltd.
*/
var FCKFormatSourceCommand = function(){};FCKFormatSourceCommand.prototype.Execute = function(){FCKUndo.SaveUndoStep();FCKConfig.FormatSource =  !FCKConfig.FormatSource;FCKToolbarItems.LoadedItems['FormatSource']._UIButton.MainElement.title = (FCKConfig.FormatSource ? FCKLang.UNFormatSource :  FCKLang.FormatSource);FCKToolbarItems.LoadedItems['FormatSource']._UIButton.ChangeState(this.GetState(),true); if(FCK.EditMode == FCK_EDITMODE_SOURCE){if(FCKConfig.FormatSource){FCK.SetData(FCKCodeFormatter.Format( FCK.EditingArea.Textarea.value ));} else{srcHTML = FCK.EditingArea.Textarea.value.replace(new RegExp( "\\n","g" ),'');				srcHTML = srcHTML.replace(new RegExp( "\\r","g" ),'');				srcHTML = srcHTML.replace(new RegExp( ">[ ]+<" ,"g"),"><");				FCK.SetData(srcHTML);};FCK.Focus() ;}};FCKFormatSourceCommand.prototype.GetState = function(){return  (FCKConfig.FormatSource ? FCK_TRISTATE_OFF: FCK_TRISTATE_ON);}; var formatComand = new FCKFormatSourceCommand();FCKCommands.RegisterCommand('FormatSource',formatComand); var FormatSourceItem = new FCKToolbarButton("FormatSource",(FCKConfig.FormatSource ? FCKLang.UNFormatSource :  FCKLang.FormatSource),(FCKConfig.FormatSource ? FCKLang.UNFormatSource :  FCKLang.FormatSource),null,true);FormatSourceItem.IconPath = FCKConfig.PluginsPath + 'formatsource/FormatSource.gif';FCKToolbarItems.RegisterItem('FormatSource',FormatSourceItem);FCK.ContextMenu.RegisterListener({AddItems : function( menu,tag,tagName ){menu.AddSeparator();menu.AddItem( 'FormatSource',(FCKConfig.FormatSource ? FCKLang.UNFormatSource :  FCKLang.FormatSource),FormatSourceItem.IconPath );}});