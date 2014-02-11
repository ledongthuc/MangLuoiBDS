<?php
/**
 * @version		$Id: english.common.php 953 2009-10-14 20:38:38Z mathias $
 * @category	DOCman
 * @package		DOCman15
 * @copyright	Copyright (C) 2003 - 2009 Johan Janssens and Mathias Verraes. All rights reserved.
 * @license		GNU GPLv2 <http://www.gnu.org/licenses/old-licenses/gpl-2.0.html>
 * @link     	http://www.joomladocman.org
 */
defined('_JEXEC') or die('Restricted access');

/**
 * TRANSLATORS:
 * PLEASE ADD THE INFO BELOW
 */

/**
 * Language:
 * Creator:
 * Website:
 * E-mail:
 * Revision:
 * Date:
 */

define ('_DM_DATEFORMAT_LONG', "%A %B %d, %Y %H:%M:%S"); // use PHP strftime Format, more info at http://php.net
define ('_DM_DATEFORMAT_SHORT', "%B %d, %Y");         // use PHP strftime Format, more info at http://php.net
define ('_DM_ISO', 'iso-8859-1');
define ('_DM_LANG', 'en');

// -- General
define('_DML_NAME', "Name");
define('_DML_DATE', "Date");
define('_DML_DATE_MODIFIED', "Date modified");
define('_DML_HITS', "Hits");
define('_DML_SIZE', "Size");
define('_DML_EXT', "Extension");
define('_DML_MIME', "Mime Type");
define('_DML_THUMBNAIL', "Thumbnail");
define('_DML_DESCRIPTION', "Mô tả");
define('_DML_VERSION', "Version");
define('_DML_DEFAULT', "Default");
define('_DML_FOLDER', "Folder");
define('_DML_FOLDERS', "Folders");
define('_DML_FILE', "File");
define('_DML_FILES', "Files");
define('_DML_URL', "URL");
define('_DML_PARAMS', "Parameters");
define('_DML_PARAMETERS', "Parameters");
define('_DML_TOP', "Top");
define('_DML_PROPERTY', "Property");
define('_DML_VALUE', "Value");
define('_DML_PATH', "Path");

define('_DML_DOC', "Tài liệu");
define('_DML_DOCS', "Documents");
define('_DML_DOCUMENT', "Tài liệu");
define('_DML_CAT', "Danh mục");
define('_DML_CATS', "Categories");
define('_DML_CATEGORY', "Thể loại");

define('_DML_UPLOAD', "Tải file");
define('_DML_SECURITY', "Security");
define('_DML_CPANEL', "Home");
define('_DML_CONFIG', "Configuration");
define('_DML_LICENSE', "License");
define('_DML_LICENSES', "Licenses");
define('_DML_UPDATES', "UPDATE");
define('_DML_DOWNLOADS', "Tải về");

define('_DML_HOMEPAGE', "Homepage");

define('_DML_NO', "No");
define('_DML_YES', "Yes");
define('_DML_OK', "OK");
define('_DML_CANCEL', "Hủy");
define('_DML_ADD', "THÊM");
define('_DML_EDIT', "SỬA");
define('_DML_CONTINUE', "Tiếp tục");
define('_DML_SAVE', "LƯU");

define('_DML_APPROVED', "Approved");
define('_DML_DELETED', "XÓA");

define('_DML_INSTALL', "Install");
define('_DML_PUBLISHED', "PUNLISHED");
define('_DML_UNPUBLISH', "UNPUBLISH");
define('_DML_CHECKED_OUT', "CHECK OUT");

define('_DML_TOOLTIP', "Tooltip");
define('_DML_FILTER_NAME', "Filter by name");

define('_DML_TITLE', "Tiêu đề");
define('_DML_MULTIPLE_SELECTS', "hold down the <b>Ctrl</b> key (for Windows/Unix/Linux) or <b>Command</b> key (for Mac) while selecting.");

define('_DML_USER', "User");
define('_DML_OWNER', "Viewers");
define('_DML_CREATOR', "Creator");
define('_DML_EDITOR', "Maintainer");
define('_DML_MAINTAINER', "Maintainer");
define('_DML_UNKNOWN', "Unknown");

define('_DML_FILEICON_ALT', "File Icon");

define('_DML_NOT_AUTHORIZED', "Not authorized");
define('_DML_ERROR', "Error");
define('_DML_OPERATION_FAILED', "Operation Failed");

define('_DML_EDIT_THIS_MODULE', "Edit this module");
define('_DML_UNPUBLISH_THIS_MODULE', "Unpublish this module");
define('_DML_ORDER_THIS_MODULE', "Order this module");

define('_DML_WRITABLE', "Writable");
define('_DML_UNWRITABLE', "Unwritable");

define('_DML_SAVED_CHANGES', "Saved changes");
define('_DML_ARE_YOU_SURE', "Bạn có chắc không?");


// -- HTML Class
define('_DML_SELECT_CAT', "Chọn thể loại");
define('_DML_SELECT_DOC', "Chọn tài liệu");
define('_DML_SELECT_FILE', "Chọn File");
define('_DML_ALL_CATS', "- Tất cả");
define('_DML_SELECT_USER', "Select User");
define('_DML_GENERAL', "General");
define('_DML_GROUPS', "Groups");
define('_DML_DOCMAN_GROUPS', "DOCman Groups");
define('_DML_MAMBO_GROUPS', "Joomla! Groups");
define('_DML_JOOMLA_GROUPS', "Joomla! Groups"); // alias
define('_DML_USERS', "Users");
define('_DML_EVERYBODY', "Everybody");
define('_DML_ALL_REGISTERED', "All Registered Users");
define('_DML_NO_USER_ACCESS', "No User Access");
define('_DML_AUTO_APPROVE', "Auto Approve");
define('_DML_AUTO_PUBLISH', "Auto Publish");
define('_DML_GROUP', "Group");
define('_DML_GROUP_PUBLISHER', "Publisher");
define('_DML_GROUP_EDITOR', "Editor");
define('_DML_GROUP_AUTHOR', "Author");

// -- File Class
define('_DML_OPTION_HTTP', "Upload file từ máy tính của bạn");
define('_DML_OPTION_XFER', "Chuyển một file từ máy khác");
define('_DML_OPTION_LINK', "Liên kết một tập tin từ máy khác");
define('_DML_SIZEEXCEEDS', "Vượt quá kích thước tối đa cho phép.");
define('_DML_ONLYPARTIAL', "Chỉ có một phần tập tin được nhận. Hãy thử lại.");
define('_DML_NOUPLOADED', "Không có tài liệu được tải lên.");
define('_DML_TRANSFERERROR', "Transfer error occurred");
define('_DML_DIRPROBLEM', "Directory problem. Cannot move file.");
define('_DML_DIRPROBLEM2', "Directory problem");
define('_DML_COULDNOTCONNECT', "Could not connect to host");
define('_DML_COULDNOTOPEN', "Could not open destination directory. Check permissions.");
define('_DML_FILETYPE', "File type");
define('_DML_NOTPERMITED', "Not permitted");
define('_DML_EMPTY', "Empty");

define('_DML_ALREADYEXISTS', "Đã tồn tại.");
define('_DML_PROTOCOL', "Protocol");
define('_DML_NOTSUPPORTED', "Not supported.");
define('_DML_NOFILENAME', "Không có tên tập tin được chỉ định.");
define('_DML_FILENAME', "Tên file");
define('_DML_CONTAINBLANKS', "contains blanks.");
define('_DML_ISNOTVALID', "tập tin không hợp lệ");
define('_DML_SELECTIMAGE', "Chọn hình");
define('_DML_FAILEDTOCREATEDIR', "Không thể tạo thư mục");
define('_DML_DIRNOTEXISTS', "Thư mục không tồn tại; không thể gỡ bỏ tập tin");
define('_DML_TEMPLATEEMPTY', "Template id is empty; cannot remove files");
define('_DML_INTERRORMAMBOT', "Internal error: no plugin set");
define('_DML_INTERRORMABOT', _DML_INTERRORMAMBOT); // alias
define('_DML_NOTARGGIVEN', "not enough arguments given");
define('_DML_ARG', "argument");
define('_DML_ISNOTARRAY', "is not an array");

define('_DML_NEW', "new!");
define('_DML_HOT', "hot!");

define('_DML_BYTES', "Bytes");
define('_DML_KB', "kB");
define('_DML_MB', "MB");
define('_DML_GB', "GB");
define('_DML_TB', "TB");


// -- Form Validation
define('_DML_ENTRY_ERRORS', "DOCman System Message : Please correct the following error(s):");
define('_DML_ENTRY_TITLE', "Bạn phải nhập tiêu đề.");
define('_DML_ENTRY_NAME', "Entry must have a name.");
define('_DML_ENTRY_DATE', "Entry must have a date.");
define('_DML_ENTRY_OWNER', "Entry must have an owner.");
define('_DML_ENTRY_CAT', "Bạn phải chọn thể loại.");
define('_DML_ENTRY_DOC', "Entry must have a document selected.");
define('_DML_ENTRY_MAINT', "Entry must have a Maintainer specified.");

define('_DML_ENTRY_DOCLINK_LINK', "Document needs to have LINK selected.");
define('_DML_ENTRY_DOCLINK', "Document has both a filename and a document link");
define('_DML_ENTRY_DOCLINK_PROTOCOL', "Unknown protocol for document link");
define('_DML_ENTRY_DOCLINK_NAME', "Need full document link");
define('_DML_ENTRY_DOCLINK_HOST', "A complete URL is required");
define('_DML_ENTRY_DOCLINK_INVALID', "Không tìm thấy file");
define('_DML_FILENAME_REQUIRED', "A filename is required");

// Missing  constants from J!1.0.x
define('_DML_FILTER', "Lọc");
define('_DML_UPDATE', "Update");
define('_DML_SEARCH_ANYWORDS', "Bất kì từ nào");
define('_DML_SEARCH_ALLWORDS', "Tất cả từ");
define('_DML_SEARCH_PHRASE', "Chính xác cụm từ");
define('_DML_SEARCH_NEWEST', "Mới nhất");
define('_DML_SEARCH_OLDEST', "Cũ nhất");
define('_DML_SEARCH_POPULAR', "Phổ biến nhất");
define('_DML_SEARCH_ALPHABETICAL', "Thứ tự ABC");
define('_DML_SEARCH_CATEGORY', "Danh mục");
define('_DML_SEARCH_MESSAGE', "Tìm kiếm phải được tối thiểu là 3 ký tự và tối đa là 20 ký tự");
define('_DML_SEARCH_TITLE', "Tìm kiếm");
define('_DML_PROMPT_KEYWORD', "Từ khóa tìm kiếm");
define('_DML_SEARCH_MATCHES', "returned %d matches");
define('_DML_NOKEYWORD', "Không tìm thấy kết quả");
define('_DML_IGNOREKEYWORD', "Một hoặc nhiều từ ngữ thường được bỏ qua trong tìm kiếm");
define('_DML_CMN_ORDERING', "Thứ tự");

// Added DOCman 1.4 RC3
define('_DML_HELP', "Trợ giúp");

