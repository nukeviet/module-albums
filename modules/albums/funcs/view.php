<?php

/**
 * @Project NUKEVIET 3.0
 * @Author VINADES., JSC (contact@vinades.vn)
 * @Copyright (C) ${year} VINADES ., JSC. All rights reserved
 * @Createdate ${date}  ${time}
 */

if ( ! defined( 'NV_IS_MOD_ALBUMS' ) ) die( 'Stop!!!' );

if ( isset( $array_op[2] ) )
{
    $page = substr( $array_op[2], 5 );
}
else
{
    $page = 0;
}
if( $aID == 0 ){
    nv_info_die( $lang_global['error_404_title'], $lang_global['error_404_title'], $lang_global['error_404_content'] );
    exit();
}
$result = $adb->getAllAlbumCotent( $aID );

if ( $db->sql_numrows( $result ) > 0 )
{
    $rs = $db->sql_fetchrow( $result );
    $album = array( 
        'albumid' => $rs['albumid'], 'name' => $rs['name'], 'description' => $rs['description'], 'createddate' => $rs['createddate'], 'num_photo' => $rs['num_photo'], 'path_img' => $rs['path_img'], 'num_view' => $rs['num_view'], 'alias' => $rs['alias'] 
    );
    $page_title = "Album " . $rs['name'];
    
    $base_url = NV_BASE_SITEURL . "index.php?" . NV_LANG_VARIABLE . "=" . NV_LANG_DATA . "&amp;" . NV_NAME_VARIABLE . "=" . $module_name . "&amp;" . NV_OP_VARIABLE . "=view/" . $rs['alias'] . '-'. $aID;
    
    $result = $adb->updateAlbumNumView( $aID );
    
    $per_page = 20;
    
    $numcat = $db->sql_numrows( $adb->getAlbumImgs( $aID ) );
    
    $all_page = ( $numcat > 1 ) ? $numcat : 1;
    
    $albumimg = array();
    
    $result = $adb->getAlbumImgsOBWLim( $aID, $page, $per_page );
    
    while ( $rsp = $db->sql_fetchrow( $result ) )
    {
        $albumimg[] = array( 
            'pictureid' => $rsp['pictureid'], 'name' => $rsp['name'], 'path' => $rsp['path'], 'description' => $rsp['description'], 'numview' => $rsp['numview'], 'thumb_name' => $rsp['thumb_name'] 
        );
    }
    
    $list_pages = nv_alias_page( $lang_module['view'], $base_url, $all_page, $per_page, $page );
    $contents = call_user_func( "view", $albumimg, $album, $list_pages );
}
else
{
    nv_info_die( $lang_global['error_404_title'], $lang_global['error_404_title'], $lang_global['error_404_content'] );
}

include ( NV_ROOTDIR . "/includes/header.php" );
echo nv_site_theme( $contents );
include ( NV_ROOTDIR . "/includes/footer.php" );
?>