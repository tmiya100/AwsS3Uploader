<?php

// +---------------------------------------------------------------------------+
// | Calendar Plugin 1.1                                                       |
// +---------------------------------------------------------------------------+
// | index.php                                                                 |
// |                                                                           |
// | Geeklog calendar plugin                                                   |
// +---------------------------------------------------------------------------+
// | Copyright (C) 2000-2010 by the following authors:                         |
// |                                                                           |
// | Authors: Tony Bibbs        - tony AT tonybibbs DOT com                    |
// |          Mark Limburg      - mlimburg AT users DOT sourceforge DOT net    |
// |          Jason Whittenburg - jwhitten AT securitygeeks DOT com            |
// |          Dirk Haun         - dirk AT haun-online DOT de                   |
// +---------------------------------------------------------------------------+
// |                                                                           |
// | This program is free software; you can redistribute it and/or             |
// | modify it under the terms of the GNU General Public License               |
// | as published by the Free Software Foundation; either version 2            |
// | of the License, or (at your option) any later version.                    |
// |                                                                           |
// | This program is distributed in the hope that it will be useful,           |
// | but WITHOUT ANY WARRANTY; without even the implied warranty of            |
// | MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the             |
// | GNU General Public License for more details.                              |
// |                                                                           |
// | You should have received a copy of the GNU General Public License         |
// | along with this program; if not, write to the Free Software Foundation,   |
// | Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.           |
// |                                                                           |
// +---------------------------------------------------------------------------+

/**
 * Geeklog common function library
 */
require_once '../lib-common.php';

if (!in_array('awss3', $_PLUGINS)) {
    COM_handle404();
    exit;
}

if (COM_isAnonUser()) {
    $display .= SEC_loginRequiredForm();
    $display = COM_createHTMLDocument($display, array('pagetitle' => $LANG_CAL_1[41]));
    COM_output($display);
    exit;
}

// +---------------------------------------------------------------------------+
// | Get Mode                                                                  |
// +---------------------------------------------------------------------------+
if ( isset($_GET['mode']) ) {
    $mode = COM_applyFilter($_GET['mode']);
} else {
    if ( isset($_POST['mode']) ) {
        $mode = COM_applyFilter($_POST['mode']);
    } else {
        $mode = '';
    }
}

// +---------------------------------------------------------------------------+
// | MAIN                                                                      |
// +---------------------------------------------------------------------------+
switch ($mode) {

  case 'regist':
      AWSS3_upload($_FILES, $_POST);
      break;

  case 'delete':
      AWSS3_delete($_GET['key']);
      break;
      
  case 'get':
      AWSS3_download($_GET['key']);
      break;
      
  default:
      AWSS3_default("");
      break;
}

?>