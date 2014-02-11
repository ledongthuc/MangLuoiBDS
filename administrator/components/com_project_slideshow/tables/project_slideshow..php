<?php
		defined('_JEXEC') or die('Restricted Access');
		class Tableproject_slideshow extends JTable
		{
		 	 	 	 	 	 	
			var $SID = null;
			var $showstatus = null;
			var $shownumber = null;
			var $speed = null;
			var $textlengt = null;
			var $path = null;
			var $session = null;
			var $categories = 0;
			function TableProSlideShow(&$db)
			{
				parent::__construct( '#__proslideshow', 'SID', $db );
			}
		}