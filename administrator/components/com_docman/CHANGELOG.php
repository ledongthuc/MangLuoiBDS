<?php
/**
 * @version		$Id: CHANGELOG.php 1063 2009-12-15 10:58:46Z tom $
 * @category	DOCman
 * @package		DOCman15
 * @copyright	Copyright (C) 2003 - 2009 Johan Janssens and Mathias Verraes. All rights reserved.
 * @license	    This file can not be redistributed without the written consent of the 
 *				original copyright holder. This file is not licensed under the GPL. 
 * @link     	http://www.joomladocman.org
 */
defined('_JEXEC') or die('Restricted access');
?>

Note: This changelog only contains the most important changes.

Legend:

* -> Security Fix
# -> Bug Fix
$ -> Language fix or change
+ -> Addition
^ -> Change
- -> Removed
! -> Note

# [#86] Override checkboxes in configuration
# [#83] TCPDF error with DOClink pdf icon
^ [#80] Changed 'number of documents per page' setting to list (5-100, 5 step increments)
- [#80] Removed 'all' option from pagination in backend
# [#78] Memory issues in log view 
# Fixed Issue with content plugins
# [#76] Added Menu item name and description
# [#72] Missing translation in mod_docman_latestdown
# [#71] Search plugin caused issue with language strings
# [#70] Frontend modules where not visible in module manager
+ [#68] Document title link options [None, Direct download, Details page] to default template
# [#62] Thumbnail preview in frontend edit form with SEF on and mod_rewrite off
# Fixed Category selection in Joomla Menu Manager
# Fixed Process Content Plugins configuration setting

-------------------- 1.5.0 Stable Release [09-December-2009] ------------------

- Removed legacy (Joomla 1.5 Native)
+ DOClink, search plugin and modules are now included in the package and installed automatically
^ Complete new frontend default theme. Optimised to easily blend into any Joomla template.
^ Fully refactored administrator to fully match Joomla 1.5's native look and feel
^ Performance optimizations
! Performed a full security audit
! Many minor improvements based on feedback from community

-------------------- 1.4.0 Stable Release [14-February-2009] ------------------