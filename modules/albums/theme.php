<?php

/**
 * @Project
 * @Author VINADES
 * @Email: hungtmit@gmail.com | tmh@xwebgate.com
 * @Copyright (c) 2010 TMH. All rights reserved
 * @Createdate Jul 13, 2010
 */

if ( ! defined( 'NV_IS_MOD_ALBUMS' ) ) die( 'Stop!!!' );

function main ( $albums )
{
    global $module_info, $global_config, $module_file, $db, $lang_module, $lang_global, $module_name, $my_head;
    

    $xtpl = new XTemplate( "main.tpl", NV_ROOTDIR . "/themes/" . $module_info['template'] . "/modules/" . $module_file );
    
    foreach ( $albums as $album )
    {
        $xtpl->assign( 'TITLE_ALBUM', $album['name'] );
        $xtpl->assign( 'NUM_PHOTO', $album['num_photo'] );
        $xtpl->assign( 'NUM_VIEW', $album['num_view'] );
        $url_link = NV_BASE_SITEURL . "index.php?" . NV_LANG_VARIABLE . "=" . NV_LANG_DATA . "&amp;" . NV_NAME_VARIABLE . "=" . $module_name . "&amp;" . NV_OP_VARIABLE . "=view/" . $album['alias'] . '-'. $album['albumid'];
        $xtpl->assign( 'URL_VIEW', $url_link );
        $xtpl->assign( 'DES_AL', $album['description'] );
        
        if ( ! empty( $album['listimg'] ) )
        {
            foreach ( $album['listimg'] as $listimg )
            {
                if ( ! nv_is_url( $listimg['thumb_name'] ) && $listimg['thumb_name'] != "" )
                {
                    $listimg['thumb_name'] = NV_BASE_SITEURL . NV_UPLOADS_DIR . "/" . $module_name . "/" . $listimg['thumb_name'];
                    $listimg['path'] = NV_BASE_SITEURL . NV_UPLOADS_DIR . "/" . $module_name . "/" . $listimg['path'];
                }
                else
                {
                    $listimg['thumb_name'] = NV_BASE_SITEURL . "themes/" . $global_config['site_theme'] . "/images/" . $module_name . "/no_image.gif";
                }
                $xtpl->assign( 'SRC', $listimg['thumb_name'] );
                $xtpl->assign( 'NAME', $listimg['name'] );
                $xtpl->assign( 'DES', $listimg['description'] );
                $xtpl->assign( 'SRC_LAGE', $listimg['path'] );
                $xtpl->parse( 'main.items.album' );
            }
            if ( count( $album['listimg'] ) == 4 ) $xtpl->parse( 'main.items.all' );
        }
        else
        {
            $xtpl->assign( 'NONE', "no image" );
        }
        
        $xtpl->parse( 'main.items' );
    }
    
    $xtpl->parse( 'main' );
    return $xtpl->text( 'main' );
}

function view ( $albumimg, $ialbum, $list_pages )
{
    global $module_info, $global_config, $module_file, $db, $lang_module, $lang_global, $module_name;
    $xtpl = new XTemplate( "view.tpl", NV_ROOTDIR . "/themes/" . $module_info['template'] . "/modules/" . $module_file );
    $i = 0;
    $num_per_rows = 4;
    $xtpl->assign( 'AL_NAME', $ialbum['name'] );
    $xtpl->assign( 'NUM_PHOTO', $ialbum['num_photo'] );
    $xtpl->assign( 'NUM_VIEW', $ialbum['num_view'] );
    $xtpl->assign( 'NV_BASE_SITE', NV_BASE_SITEURL );
    $xtpl->assign( 'DES_AL', $ialbum['description'] );
    
    while ( $i < count( $albumimg ) )
    {
        for ( $j = 0; $j < $num_per_rows; $j ++ )
        {
            $album = $albumimg[$i];
            $i ++;
            if ( ! nv_is_url( $album['path'] ) && $album['thumb_name'] != "" )
            {
                $album['thumb_name'] = NV_BASE_SITEURL . NV_UPLOADS_DIR . "/" . $module_name . "/" . $album['thumb_name'];
                $album['path'] = NV_BASE_SITEURL . NV_UPLOADS_DIR . "/" . $module_name . "/" . $album['path'];
            }
            else
            {
                $album['thumb_name'] = NV_BASE_SITEURL . "themes/" . $global_config['site_theme'] . "/images/" . $module_name . "/no_image.gif";
                $album['path'] = NV_BASE_SITEURL . "themes/" . $global_config['site_theme'] . "/images/" . $module_name . "/no_image.gif";
            }
            $xtpl->assign( 'SRC', $album['thumb_name'] );
            $xtpl->assign( 'SRC_LAGE', $album['path'] );
            $xtpl->assign( 'DES', $album['description'] );
            $xtpl->assign( 'NAME', $album['name'] );
            //			$xtpl->assign('NUM_VIEW', $album['numview']);
            $xtpl->parse( 'main.row.album.img' );
            $xtpl->parse( 'main.row.album' );
            
            if ( $i >= count( $albumimg ) )
            {
                break;
            }
        }
        $xtpl->parse( 'main.row' );
    }
    
    $xtpl->assign( 'PAGES', $list_pages );
    if ( ! empty( $list_pages ) ) $xtpl->parse( 'main.pages' );
    $xtpl->parse( 'main' );
    return $xtpl->text( 'main' );
}
?>