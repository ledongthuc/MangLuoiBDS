<?php // no direct access
/*------------------------------------------------------------------------
# JA Zeolite for Joomla 1.5 - Version 1.0 - Licence Owner JA108425
# ------------------------------------------------------------------------
# Copyright (C) 2004-2008 J.O.O.M Solutions Co., Ltd. All Rights Reserved.
# @license - Copyrighted Commercial Software
# Author: J.O.O.M Solutions Co., Ltd
# Websites:  http://www.joomlart.com -  http://www.joomlancers.com
# This file may not be redistributed in whole or significant part.
-------------------------------------------------------------------------*/
defined('_JEXEC') or die('Restricted access'); ?>

<?php if ($this->user->authorize('com_content', 'edit', 'content', 'all') || $this->user->authorize('com_content', 'edit', 'content', 'own')) : ?>
	<div class="contentpaneopen_edit<?php echo $this->item->params->get( 'pageclass_sfx' ); ?>" style="float: left;">
		<?php echo JHTML::_('icon.edit', $this->item, $this->item->params, $this->access); ?>
	</div>
<?php endif; ?>
<div class="contentpaneopen<?php echo $this->item->params->get( 'pageclass_sfx' ); ?>">
<div class="article-content" style="clear:both">
<?php 
	// get image
	$sImageIndex = strpos($this->item->text, "<img");
	$imagePath = "";
	if ($sImageIndex !== false)
	{
		$eImageIndex = strpos($this->item->text, '/>', $sImageIndex) + 2;
		
		$imagePath = substr($this->item->text, $sImageIndex, $eImageIndex - $sImageIndex);
		
		$this->item->text = str_replace($imagePath, "",  $this->item->text);

	}
?>
		<?php if (!empty($imagePath)) {?>
		<div class="img-thumnbs">
			<?php echo $imagePath;?>
		</div>
		<?php }
		
if (isset ($this->item->toc)) : ?>
	<?php echo $this->item->toc; ?>
<?php endif; ?>
<!-- hang them -->
<div class="content-blog">
<?php if ($this->item->params->get('show_title')) : ?>
<h3 class="contentheading<?php echo $this->item->params->get( 'pageclass_sfx' ); ?>">
	<?php if ($this->item->params->get('link_titles') && $this->item->readmore_link != '') : ?>
	<a href="<?php echo $this->item->readmore_link; ?>" class="contentpagetitle<?php echo $this->item->params->get( 'pageclass_sfx' ); ?>">
		<?php echo $this->item->title; ?>
	</a>
	<?php else : ?>
		<?php echo $this->item->title; ?>
	<?php endif; ?>
</h3>
<?php endif; ?>

<?php  if (!$this->item->params->get('show_intro')) :
	echo $this->item->event->afterDisplayTitle;
endif; ?>

<?php
if (
($this->item->params->get('show_create_date'))
|| (($this->item->params->get('show_author')) && ($this->item->author != ""))
|| (($this->item->params->get('show_section') && $this->item->sectionid) || ($this->item->params->get('show_category') && $this->item->catid))
|| ($this->item->params->get('show_pdf_icon') || $this->item->params->get('show_print_icon') || $this->item->params->get('show_email_icon'))
|| ($this->item->params->get('show_url') && $this->item->urls)
) :
?>
<div class="article-toolswrap">
<div class="article-tools clearfix">
<div class="article-meta">

<?php if ($this->item->params->get('show_create_date')) : ?>
	<span class="createdate">
		<?php echo JHTML::_('date', $this->item->created, JText::_('DATE_FORMAT_LC2')); ?>
	</span>
<?php endif; ?>

<?php if (($this->item->params->get('show_author')) && ($this->item->author != "")) : ?>
	<span class="createby">
		<?php JText::printf(($this->item->created_by_alias ? $this->item->created_by_alias : $this->item->author) ); ?>
	</span>
<?php endif; ?>

<?php if (($this->item->params->get('show_section') && $this->item->sectionid) || ($this->item->params->get('show_category') && $this->item->catid)) : ?>
	<?php if ($this->item->params->get('show_section') && $this->item->sectionid && isset($this->item->section)) : ?>
	<span class="article-section">
		<?php if ($this->item->params->get('link_section')) : ?>
			<?php echo '<a href="'.JRoute::_(ContentHelperRoute::getSectionRoute($this->item->sectionid)).'">'; ?>
		<?php endif; ?>
		<?php echo $this->item->section; ?>
		<?php if ($this->item->params->get('link_section')) : ?>
			<?php echo '</a>'; ?>
		<?php endif; ?>
			<?php if ($this->item->params->get('show_category')) : ?>
			<?php echo ' - '; ?>
		<?php endif; ?>
	</span>
	<?php endif; ?>
	<?php if ($this->item->params->get('show_category') && $this->item->catid) : ?>
	<span class="article-category">
		<?php if ($this->item->params->get('link_category')) : ?>
			<?php echo '<a href="'.JRoute::_(ContentHelperRoute::getCategoryRoute($this->item->catslug, $this->item->sectionid)).'">'; ?>
		<?php endif; ?>
		<?php echo $this->item->category; ?>
		<?php if ($this->item->params->get('link_section')) : ?>
			<?php echo '</a>'; ?>
		<?php endif; ?>
	</span>
	<?php endif; ?>
<?php endif; ?>
</div>

<?php if ($this->item->params->get('show_pdf_icon') || $this->item->params->get('show_print_icon') || $this->item->params->get('show_email_icon')) : ?>
<div class="buttonheading">
	<?php if ($this->item->params->get('show_email_icon')) : ?>
	<span>
	<?php echo JHTML::_('icon.email', $this->item, $this->item->params, $this->access); ?>
	</span>
	<?php endif; ?>

	<?php if ( $this->item->params->get( 'show_print_icon' )) : ?>
	<span>
	<?php echo JHTML::_('icon.print_popup', $this->item, $this->item->params, $this->access); ?>
	</span>
	<?php endif; ?>

	<?php if ($this->item->params->get('show_pdf_icon')) : ?>
	<span>
	<?php echo JHTML::_('icon.pdf', $this->item, $this->item->params, $this->access); ?>
	</span>
	<?php endif; ?>
</div>
<?php endif; ?>

<?php if ($this->item->params->get('show_url') && $this->item->urls) : ?>
	<span class="article-url">
		<a href="http://<?php echo $this->item->urls ; ?>" target="_blank">
			<?php echo $this->item->urls; ?></a>
	</span>
<?php endif; ?>
</div>
</div>
<?php endif; ?>

<?php echo $this->item->event->beforeDisplayContent; ?>

<div class="content"><?php echo $this->item->text; ?></div>
</div>
<!-- hang them -->
</div>

<?php if ( intval($this->item->modified) != 0 && $this->item->params->get('show_modify_date')) : ?>
	<span class="modifydate">
		<?php echo JText::_( 'Last Updated' ); ?> ( <?php echo JHTML::_('date', $this->item->modified, JText::_('DATE_FORMAT_LC2')); ?> )
	</span>
<?php endif; ?>

<?php if ($this->item->params->get('show_readmore') && $this->item->readmore) : ?>
<div class="readon-right">
	<a href="<?php echo $this->item->readmore_link; ?>" title="<?php echo $this->item->title; ?>" class="readon<?php echo $this->item->params->get('pageclass_sfx'); ?>">
			<?php if ($this->item->readmore_register) : ?>
				<?php echo JText::_('Register to read more...'); ?>
			<?php else : ?>
				<?php echo JText::_('Read more...'); ?>
			<?php endif; ?>
	</a>
<?php endif; ?>
</div>
</div>
<?php echo $this->item->event->afterDisplayContent; ?>