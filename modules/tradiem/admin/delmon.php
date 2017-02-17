<?php
/**
 * @Author GaNguCay (gangucay@gmail.com)
 * @createdate 05/09/2010
 */
 
if (! defined ( 'NV_IS_FILE_ADMIN' ))
	die ( 'Stop!!!' );

$id = $nv_Request->get_int ( 'id', 'get' );
// Kiem tra su ton tai cua monid tai cac table lien quan, neu co se khong xoa
$sql ="SELECT * FROM " . NV_PREFIXLANG . "_" . $module_data . "_diem WHERE  monid='".$id."'";
$result = $db->query( $sql);
$num = $result->rowCount();
if ($num == 0){
	$db->query ( "DELETE FROM " . NV_PREFIXLANG . "_" . $module_data . "_monhoc WHERE monid=$id" );
	echo $lang_module ['delmonhoc_del_success'];
}else{
	echo $lang_module ['delmonhoc_del_unsuccess'];
}

