<?php

/**
* Gavick News Highlighter - default template
* @package Joomla!
* @Copyright (C) 2008-2009 Gavick.com
* @ All rights reserved
* @ Joomla! is Free Software
* @ Released under GNU/GPL License : http://www.gnu.org/copyleft/gpl.html
* @version $Revision: 1.5.1 $
**/

// access restriction
defined('_JEXEC') or die('Restricted access');

$uri = JURI::getInstance();

?>

<?php if($this->config['useMoo'] == 1) : ?>
<script type="text/javascript" src="<?php echo $uri->root(); ?>modules/mod_gk_news_highlighter/scripts/mootools.js"></script>
<?php endif; ?>

<?php if($this->config['useScript'] == 1) : ?>
<script type="text/javascript" src="<?php echo $uri->root(); ?>modules/mod_gk_news_highlighter/scripts/engine<?php echo (($this->config['compress_js'] == 1) ? '_compress' : ''); ?>.js"></script>
<?php endif; ?>

<?php if($this->config['clean_code'] == 0) : ?>
<script type="text/javascript">
	try{$Gavick;}catch(e){$Gavick = {};}
	
	$Gavick["gk_news_highlighter<?php echo $this->config['module_id'];?>"] = {
		"animationType" : <?php echo $this->config['animation_type']; ?>,
		"animationSpeed" : <?php echo $this->config['animation_speed']; ?>,
		"animationInterval" : <?php echo $this->config['animation_interval']; ?>,
		"animationFun" : <?php echo $this->config['animation_fun']; ?>,
		"mouseover" : <?php echo $this->config['mouseover']; ?>
	};
</script>
<?php endif; ?>