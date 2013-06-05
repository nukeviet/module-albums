<?php

/**
 * @Project NUKEVIET 3.0
 * @Author VINADES.,JSC (contact@vinades.vn)
 * @Copyright (C) 2010 VINADES.,JSC. All rights reserved
 * @Createdate 7-17-2010 14:43
 */

class albumdb
{
	private $sql;
	private $result;
	private $module_data;
	private $db;

	function __construct()
	{
		global $module_data, $db;

		$this->module_data = $module_data;
		$this->db = $db;
	}

	function __destruct()
	{

	}

	function addNewalbum($weight, $aname, $aDes, $img_p, $alias, $active)
	{
		$this->sql = "INSERT INTO `" . NV_PREFIXLANG . "_" . $this->module_data . "_album` (
						`albumid` ,
						`weight`,
						`name` ,
						`description` ,
						`createddate` ,
						`num_photo` ,
						`path_img`,
						`alias`,
						`active`
					)
					VALUES (
					NULL , " . $this->db->dbescape($weight) . ", " . $this->db->dbescape($aname) . ", " . $this->db->dbescape($aDes) . ",CURRENT_TIMESTAMP,0," . $this->db->dbescape($img_p) . "," . $this->db->dbescape($alias) . "," . $this->db->dbescape($active) . ")";

		return $this->db->sql_query_insert_id($this->sql);
	}

	function deleteAlbumByID($aID)
	{
		$this->sql = "DELETE
					FROM `" . NV_PREFIXLANG . "_" . $this->module_data . "_album`
					WHERE  albumid ='$aID'";

		return $this->db->sql_query($this->sql);
	}

	function deletePicturesByAlbumID($aID)
	{
		$this->sql = "DELETE
					FROM `" . NV_PREFIXLANG . "_" . $this->module_data . "_picture` WHERE  albumid ='$aID'";

		return $this->db->sql_query($this->sql);
	}

	function updateAlbumNumView($aID)
	{
		$this->sql = "UPDATE `" . NV_PREFIXLANG . "_" . $this->module_data . "_album`
					SET num_view =num_view+1
					WHERE  albumid ='$aID'";

		return $this->db->sql_query($this->sql);
	}

	function deletePictrueByID($pID)
	{
		$this->sql = "DELETE
					FROM `" . NV_PREFIXLANG . "_" . $this->module_data . "_picture`
					WHERE  pictureid ='$pID'";

		return $this->db->sql_query($this->sql);
	}

	function updateAlbumPicsNum($aID, $num)
	{
		$this->sql = "UPDATE `" . NV_PREFIXLANG . "_" . $this->module_data . "_album`
					SET `num_photo` = " . $num . "
					WHERE `albumid` =" . $aID . ";";

		return $this->db->sql_query($this->sql);
	}

	function getAllAlbumCotent($aID)
	{
		$this->sql = "SELECT *
					FROM `" . NV_PREFIXLANG . "_" . $this->module_data . "_album`
					WHERE albumid = '" . $aID . "'";

		return $this->db->sql_query($this->sql);
	}

	function updatealbum($aID, $aname, $aDes, $img_p, $alias, $active)
	{
		$this->sql = "UPDATE `" . NV_PREFIXLANG . "_" . $this->module_data . "_album`
					SET `name` = " . $this->db->dbescape($aname) . ", `description` = " . $this->db->dbescape($aDes) . " , `path_img` = " . $this->db->dbescape($img_p) . " , `alias` = " . $this->db->dbescape($alias) . " , `active` = " . $this->db->dbescape($active) . "
					WHERE `albumid` =" . $aID . ";";
		return $this->db->sql_query($this->sql);
	}

	function getAlbumImgs($aID)
	{
		$this->sql = "SELECT *
					FROM `" . NV_PREFIXLANG . "_" . $this->module_data . "_picture`
					WHERE `albumid` = " . $aID;

		return $this->db->sql_query($this->sql);
	}

	function getAlbumImgsOBW($aID)
	{
		$this->sql = "SELECT *
					FROM `" . NV_PREFIXLANG . "_" . $this->module_data . "_picture`
					WHERE `albumid` = " . $aID . "
					ORDER BY `weight` ASC";

		return $this->db->sql_query($this->sql);
	}

	function getAlbumImgsOBWLim($aID, $page, $per_page)
	{
		$this->sql = "SELECT *
					FROM `" . NV_PREFIXLANG . "_" . $this->module_data . "_picture`
					WHERE `albumid` = " . $aID . "
					ORDER BY `weight` ASC
					LIMIT " . $page . "," . $per_page;

		return $this->db->sql_query($this->sql);
	}

	function getAlbumIDByPicID($pid)
	{
		$this->sql = "SELECT *
					FROM `" . NV_PREFIXLANG . "_" . $this->module_data . "_picture`
					WHERE `pictureid` = " . $pid . ";";

		return $this->db->sql_query($this->sql);
	}

	//
	//	function getalbumImg($aID, $limit = 1)
	//	{
	//		$this->sql = "SELECT t1.``, t1.`name` AS `albumname`, t1.`description` AS `albumdes`, t3.`pictureID`, t3.`name` AS `picturename`, t3.`Path`, t3.`description` AS `pictureDes`
	//					FROM `" . NV_PREFIXLANG . "_" . $this->module_data . "_album` AS t1
	//						JOIN (`" . NV_PREFIXLANG . "_" . $this->module_data . "_albumpicturedetail` AS t2, `" . NV_PREFIXLANG . "_" . $this->module_data . "_picture` AS t3)
	//						ON (t1.`` = t2.`` AND t2.`pictureid` = t3.`pictureid`)
	//					WHERE t1.`` = " . $aID . "
	//					LIMIT 0, " . $limit;
	//
	//		return $this->db->sql_query($this->sql);
	//	}


	function getAllalbums()
	{
		$this->sql = "SELECT *
					FROM `" . NV_PREFIXLANG . "_" . $this->module_data . "_album`";

		return $this->db->sql_query($this->sql);
	}

	function getAllAlbumOBW()
	{
		$this->sql = "SELECT *
					FROM `" . NV_PREFIXLANG . "_" . $this->module_data . "_album`
					ORDER BY `weight` ASC";

		return $this->db->sql_query($this->sql);
	}

	function getAllActiveAlbumOBW()
	{
		$this->sql = "SELECT *
					FROM `" . NV_PREFIXLANG . "_" . $this->module_data . "_album`
					WHERE `active` = '1'
					ORDER BY `weight` ASC";

		return $this->db->sql_query($this->sql);
	}

	function changeABWeight($old, $new)
	{
		$this->sql = "UPDATE `" . NV_PREFIXLANG . "_" . $this->module_data . "_album`
		SET `weight` = " . $new . "
		WHERE `weight` = " . $old . ";";

		return $this->db->sql_query($this->sql);
	}

	function changeABWeightByID($aid, $neww)
	{
		$this->sql = "UPDATE `" . NV_PREFIXLANG . "_" . $this->module_data . "_album`
					SET `weight` = '" . $neww . "'
					WHERE `albumid` =" . $aid . ";";

		return $this->db->sql_query($this->sql);
	}

	function chageImgWByID($pid, $neww)
	{
		$this->sql = "UPDATE `" . NV_PREFIXLANG . "_" . $this->module_data . "_picture`
					SET `weight` = '" . $neww . "'
					WHERE `pictureid` =" . $pid . ";";

		return $this->db->sql_query($this->sql);
	}

	function isExistsImg($path)
	{
		$this->sql = "SELECT *
					FROM `" . NV_PREFIXLANG . "_" . $this->module_data . "_picture`
					WHERE `Path` = " . $this->db->dbescape($path) . "
					";

		$result = $this->db->sql_query($this->sql);

		return $this->db->sql_fetchrow($result);
	}

	function addNewImg($name, $path, $des, $thumb_name, $albumid, $weight)
	{
		$this->sql = "INSERT INTO `" . NV_PREFIXLANG . "_" . $this->module_data . "_picture` (
					`pictureid` ,
					`name` ,
					`path` ,
					`description`,
					`thumb_name`,
					`albumid`,
					`weight`
					)
					VALUES (
					NULL , " . $this->db->dbescape($name) . ", " . $this->db->dbescape($path) . ", " . $this->db->dbescape($des) . " , " . $this->db->dbescape($thumb_name) . " , " . $this->db->dbescape($albumid) . " , " . $this->db->dbescape($weight) . "
					);
					";
		return $this->db->sql_query_insert_id($this->sql);
	}

	function changeImgW($old, $new, $aid)
	{
		$this->sql = "UPDATE `" . NV_PREFIXLANG . "_" . $this->module_data . "_picture`
					SET `weight` = '" . $new . "'
					WHERE `albumid` = " . $aid . "
						AND `weight` = " . $old . ";";

		return $this->db->sql_query($this->sql);
	}

	function updateImgInfo($id, $name, $path, $des, $thumb_name, $albumid)
	{
		$this->sql = "UPDATE `" . NV_PREFIXLANG . "_" . $this->module_data . "_picture`
					SET `name` = " . $this->db->dbescape($name) . ",`path` = " . $this->db->dbescape($path) . ", `description` = " . $this->db->dbescape($des) . ", `thumb_name` = " . $this->db->dbescape($thumb_name) . " , `albumid` =" . $this->db->dbescape($albumid) . "
					WHERE `pictureid` =" . $id . ";";
		return $this->db->sql_query($this->sql);
	}

	function getImgIdByPath($path)
	{
		$this->sql = "SELECT *
					FROM `" . NV_PREFIXLANG . "_" . $this->module_data . "_picture`
					WHERE `path` = " . $this->db->dbescape($path) . "
					";

		return $this->db->sql_fetchrow($this->db->sql_query($this->sql));
	}

	//
	//	function addalbumImgdetail($aID, $iID)
	//	{
	//		$this->sql = "INSERT INTO `" . NV_PREFIXLANG . "_" . $this->module_data . "_albumpicturedetail`
	//					  VALUES ( " . $aID . ", " . $iID . ")";
	//		return $this->db->sql_query_insert_id($this->sql);
	//	}


	function freeResult()
	{
		$this->db->sql_freeresult();
	}

	function update_numphoto($aID)
	{
		$this->sql = "SELECT count(*) FROM `" . NV_PREFIXLANG . "_" . $this->module_data . "_picture`  WHERE  albumid ='$aID'";
		$result = $this->db->sql_query($this->sql);
		list($num_photo) = $this->db->sql_fetchrow($result);
		$this->sql = "UPDATE `" . NV_PREFIXLANG . "_" . $this->module_data . "_album` SET num_photo =" . $num_photo . " WHERE  albumid ='" . $aID . "'";
		$result = $this->db->sql_query($this->sql);
	}

	function ActiveAlbum($aID)
	{
		$this->sql = "SELECT active FROM `" . NV_PREFIXLANG . "_" . $this->module_data . "_album`
					  WHERE `albumid` =" . $aID . ";";
		$result = $this->db->sql_query($this->sql);
		list($active) = $this->db->sql_fetchrow($result);
		$active = ($active == 1) ? 0 : 1;
		$this->sql = "UPDATE `" . NV_PREFIXLANG . "_" . $this->module_data . "_album`
					SET `active` = " . $this->db->dbescape($active) . "
					WHERE `albumid` =" . $aID . ";";
		$this->db->sql_query($this->sql);
		return $active;
	}
}

?>