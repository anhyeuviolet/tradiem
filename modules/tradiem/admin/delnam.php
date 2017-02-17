<?php
/**
 * @Author GaNguCay (gangucay@gmail.com)
 * @createdate 05/09/2010
 */
if (! defined ( 'NV_IS_FILE_ADMIN' ))
	die ( 'Stop!!!' );

$id = $nv_Request->get_int ( 'id', 'get' );
// Kiem tra su ton tai cua manamhoc tai cac table lien quan, neu co se khong xoa
$sql ="SELECT * FROM " . NV_PREFIXLANG . "_" . $module_data . "_diem WHERE  manamhoc='".$id."'";
$result = $db->query( $sql);
$num1 = $result->rowCount();

$sql ="SELECT * FROM " . NV_PREFIXLANG . "_" . $module_data . "_dshs WHERE  manamhoc='".$id."'";
$result = $db->query( $sql);
$num2 = $result->rowCount();

$sql ="SELECT * FROM " . NV_PREFIXLANG . "_" . $module_data . "_xeploai WHERE  manamhoc='".$id."'";
$result = $db->query( $sql);
$num3 = $result->rowCount();

if ($num1 == 0 and $num3 == 0 and $num3 == 0){
$db->query ( "DELETE FROM " . NV_PREFIXLANG . "_" . $module_data . "_namhoc WHERE manamhoc=$id" );
echo $lang_module ['delnamhoc_del_success'];
}else{
echo $lang_module ['delnamhoc_del_unsuccess'];
}
