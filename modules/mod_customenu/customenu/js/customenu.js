/**
 * Helper File
 *
 * @package     CustoMenu
 * @version     2.5.1
 *
 * @author      Peter van Westen <peter@nonumber.nl>
 * @link        http://www.nonumber.nl
 * @copyright   Copyright (C) 2010 NoNumber! All Rights Reserved
 * @license     http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 */
 
function changeClassName( el, oldClass, newClass )
{
	if ( el.className.match( new RegExp( '(\\s|^)'+oldClass+'(\\s|$)' ) ) ) {
		// remove oldClass
		var reg = new RegExp( '(\\s|^)'+oldClass+'(\\s|$)' );
		el.className = el.className.replace( reg, ' ' );
	}
	if ( !el.className.match( new RegExp( '(\\s|^)'+newClass+'(\\s|$)' ) ) ) {
		// add newClass
		el.className += ' '+newClass;
	}
}