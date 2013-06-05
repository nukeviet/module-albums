<?php

/**
 * @Project NUKEVIET 3.0
 * @Author VINADES.,JSC (contact@vinades.vn)
 * @Copyright (C) 2010 VINADES.,JSC. All rights reserved
 * @Createdate 7-17-2010 14:43
 */

if( ! defined( 'NV_IS_MOD_ALBUMS' ) ) die( 'Stop!!!' );

$page_title = $lang_module['album'];
if( ! empty( $albums ) )
{
	foreach( $albums as &$rs )
	{
		$listimg = array();
		$re = $adb->getAlbumImgsOBW( $rs['albumid'] );
		while( $rsp = $db->sql_fetchrow( $re ) )
		{
			$listimg[] = array(
				'pictureid' => $rsp['pictureid'],
				'name' => $rsp['name'],
				'path' => $rsp['path'],
				'description' => $rsp['description'],
				'numview' => $rsp['numview'],
				'thumb_name' => $rsp['thumb_name'] );
		}
		$rs['listimg'] = $listimg;
	}
    $contents = call_user_func( "main", $albums );
}else{
    $contents = '';
}

include ( NV_ROOTDIR . "/includes/header.php" );
echo nv_site_theme( $contents );
include ( NV_ROOTDIR . "/includes/footer.php" );

?>