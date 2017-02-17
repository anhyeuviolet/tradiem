<?php
/**
 * @Author GaNguCay (gangucay@gmail.com)
 * @createdate 05/09/2010
 */

if (! defined ( 'NV_IS_FILE_ADMIN' ))
	die ( 'Stop!!!' );
$lopid = $nv_Request->get_int ( 'lopid', 'get' );
$manamhoc = $nv_Request->get_int ( 'manamhoc', 'get' );
$mahocky = $nv_Request->get_int ( 'mahocky', 'get');
// Loc ma giao vien
/*
$sql = "SELECT DISTINCT gvid FROM " . NV_PREFIXLANG . "_" . $module_data . "_lop WHERE lopid = '". $lopid ."'";
$result = $db->query( $sql);
$num = $result->rowCount();
if ($num == 1){
	$gvid = mysql_fetch_array($result);
} else {
	$gvid = 0;
}
*/
// Loc danh sach ma hoc sinh trong lop
$dsmahs = array();
$sql = "SELECT DISTINCT mahs FROM " . NV_PREFIXLANG . "_" . $module_data . "_dshs WHERE lopid = '". $lopid ."'";
$result = $db->query( $sql);
$dsmahs = array();
while ($row = $result->fetch())
	{
		$dsmahs[] = $row['mahs'];
	}
// Khoi tao diem cua mon hoc
	For ($i = 0; $i < count($dsmahs); $i ++){
		// Kiem tra ton tai trong CSDL
		$sql = "SELECT DISTINCT id FROM " . NV_PREFIXLANG . "_" . $module_data . "_xeploai WHERE mahs = '". $dsmahs[$i] ."' AND lopid = '". $lopid ."' AND manamhoc = '". $manamhoc ."' AND mahocky = '". $mahocky ."'";
		$result = $db->query( $sql);
		$num2 = $result->rowCount();
		If ($num2 == 0){
			$sql = "INSERT INTO " . NV_PREFIXLANG . "_" . $module_data . "_xeploai (id, mahs, lopid, manamhoc, mahocky, tbm, hl, hk, snncp, snnkp, danhhieu, nxgvcn) VALUES (NULL, " . $db->quote ( $dsmahs[$i] ) . ", " . $db->quote ( $lopid ) . ", " . $db->quote ( $manamhoc ) . ", " . $db->quote ( $mahocky ) . ",'','','','','','','')";
			$result = $db->query( $sql);
		}
	}
	if ($result) {
		echo $lang_module ['khoitaodl_success'];
	} else {
		print_r ( $db->sql_error () );
	}
echo $contents;
