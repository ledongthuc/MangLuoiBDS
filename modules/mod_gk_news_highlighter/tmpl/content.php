<?php

/**
* Gavick News Highlighter - content template
* @package Joomla!
* @Copyright (C) 2008-2009 Gavick.com
* @ All rights reserved
* @ Joomla! is Free Software
* @ Released under GNU/GPL License : http://www.gnu.org/copyleft/gpl.html
* @version $Revision: 1.5.1 $
**/

// access restriction
defined('_JEXEC') or die('Restricted access');

?>

<div class="gk_news_highlighter" id="<?php echo $this->config['module_id']; ?>">
        <?php if($this->config['extra_divs'] == 1) : ?>
        <div class="gk_news_highlighter_interface">
                <span class="text"><?php echo $this->config['introtext']; ?></span>
                <?php if($this->config['arrows'] != 0) : ?>
				<div><a href="#" class="prev"></a>
				<a href="#" class="next"></a></div>
				<?php endif; ?>
        </div>
        <?php endif; ?>
        <div class="gk_news_highlighter_wrapper">
                <?php if($this->config['animation_type'] == 0) : ?>
<marquee onmouseover="this.stop();" onmouseout="this.start();" scrollamount="4" scrolldelay="0">
                <div class="nowrap">
                <?php endif; ?>
                    <?php for($i = 0;$i < count($content); $i++) : ?>
                        <?php if($this->config['animation_type'] != 0) : ?>
                        	<div class="gk_news_highlighter_item"><?php echo $content[$i]; ?></div>
                        <?php else : ?>
                        	<?php echo $content[$i]; ?>
                        <?php endif; ?>
                    <?php endfor; ?>
                <?php if($this->config['animation_type'] == 0) : ?>
                </div>
</marquee>
                <?php endif; ?>
        </div>
</div>
