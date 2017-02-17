<?php
/**
 * @Author GaNguCay (gangucay@gmail.com)
 * @createdate 05/09/2010
 */

if (! defined ( 'NV_IS_FILE_ADMIN' ))
	die ( 'Stop!!!' );
$lopid = $nv_Request->get_int ( 'lopid', 'get' );
$manamhoc = $nv_Request->get_int ( 'manamhoc', 'get' );
$monid = $nv_Request->get_int ( 'monid', 'get');
$mahocky = $nv_Request->get_int ( 'mahocky', 'get');
// Loc ma giao vien
$sql = "SELECT DISTINCT gvid FROM " . NV_PREFIXLANG . "_" . $module_data . "_lop WHERE lopid = '". $lopid ."'";
$result = $db->query( $sql);
$num = $result->rowCount();
if ($num == 1){
	$gvid = $result->fetch();
} else {
	$gvid = 0;
}
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
		$sql = "SELECT DISTINCT id FROM " . NV_PREFIXLANG . "_" . $module_data . "_diem WHERE mahs = '". $dsmahs[$i] ."' AND lopid = '". $lopid ."' AND manamhoc = '". $manamhoc ."' AND mahocky = '". $mahocky ."' AND monid = '". $monid ."'";
		$result = $db->query( $sql);
		$num2 = $result->rowCount();
		If ($num2 == 0){
			$sql = "INSERT INTO " . NV_PREFIXLANG . "_" . $module_data . "_diem (id, mahs, lopid, manamhoc, mahocky, monid, 15_1, 15_2, 15_3, 15_4, 15_5, 15_6, 15_7, 15_8, 15_9, 45_1, 45_2, 45_3, 45_4, 45_5, 45_6, 45_7, thi, tbm) VALUES (NULL, " . $db->quote ( $dsmahs[$i] ) . ", " . $db->quote ( $lopid ) . ", " . $db->quote ( $manamhoc ) . ", " . $db->quote ( $mahocky ) . ", " . $db->quote ( $monid ) . ",'','','','','','','','','','','','','','','','','','')";
			$result = $db->query( $sql);
		}
	}
	if ($result) {
		echo $lang_module ['khoitaodl_success'];
	} else {
		print_r ( $db->sql_error () );
	}
echo $contents;
