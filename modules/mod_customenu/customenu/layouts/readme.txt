/**
 * Menu Layout: Help file
 * A list structure
 *
 * @package     CustoMenu
 * @version     2.5.1
 *
 * @author      Peter van Westen <peter@nonumber.nl>
 * @link        http://www.nonumber.nl
 * @copyright   Copyright (C) 2010 NoNumber! All Rights Reserved
 * @license     http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 */
 
These are the dynamic tags you can use in the layouts:

{suffix}				= The menu class suffix.

{items}...{/items}		= Everything between these tags will be repeated for every menu item.

{item_nr}				= The number of the menu item.

{item_link}				= The url of the link.
{item_link_href}		= The href (and target) for use in the link tag.
{item_link_onclick}		= An onclick function to open the link for us in elements like table cells.

{item_target}			= Value is either '_blank' or empty.
{item_target_bool}		= Should link be opened in a new window? Value is either '1' or '0'. Can be used in scripts.

{item_text}				= The text part of the link.
{item_title}			= The title. This is the same as the text, but stripped from tags.

{item_class}			= The extra class name.

{item_active}			= Value is either 'active' or 'inactive'.
{item_active_bool}		= Value is either '1' or '0'. Can be used in scripts.

{hover}					= An onmouseover and onmouseout function to set the classname 'link_normal' and 'link_hover'.