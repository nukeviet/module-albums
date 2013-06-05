<?php

/**
 * @Project NUKEVIET 3.0
 * @Author VINADES.,JSC (contact@vinades.vn)
 * @Copyright (C) 2010 VINADES.,JSC. All rights reserved
 * @Createdate 7-17-2010 14:43
 */

if (!defined('NV_SYSTEM'))
    die('Stop!!!');

define('NV_IS_MOD_ALBUMS', true);
require_once NV_ROOTDIR . "/modules/" . $module_name . '/albumdb.php';

if (!defined('SHADOWBOX'))
{
    global $my_head;
    $my_head .= "<link rel=\"Stylesheet\" href=\"" . NV_BASE_SITEURL . "js/shadowbox/shadowbox.css\" />\n";
    $my_head .= "<script type=\"text/javascript\" src=\"" . NV_BASE_SITEURL . "js/shadowbox/shadowbox.js\"></script>\n";
    $my_head .= "<script type=\"text/javascript\">Shadowbox.init();</script>";
    define('SHADOWBOX', true);
}

$adb = new albumdb();
$result = $adb->getAllActiveAlbumOBW();
$albums = array();
$aID = isset($array_op[1]) ? intval( end( explode('-', $array_op[1] )) ) : 0;
while ($rs = $db->sql_fetchrow($result))
{
    $listimg = array();
    $albums[] = array('albumid' => $rs['albumid'], 'name' => $rs['name'], 'description' => $rs['description'], 'createddate' => $rs['createddate'], 'num_photo' => $rs['num_photo'], 'path_img' => $rs['path_img'], 'num_view' => $rs['num_view'], 'alias' => $rs['alias'], 'listimg' => $listimg);
    $act = ($rs['albumid'] == $aID) ? 1 : 0;
    $url_link = NV_BASE_SITEURL . "?" . NV_LANG_VARIABLE . "=" . NV_LANG_DATA . "&amp;" . NV_NAME_VARIABLE . "=" . $module_name . '&amp;' . NV_OP_VARIABLE . "=view/" . $rs['albumid'] . "/" . $rs['alias'];
    $nv_vertical_menu[] = array($rs['name'], $url_link, $act, 'submenu' => array());
}
?>