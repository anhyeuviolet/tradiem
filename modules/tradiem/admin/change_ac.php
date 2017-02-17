<?php
/**
 * @Author GaNguCay (gangucay@gmail.com)
 * @createdate 05/09/2010
 */

if ( ! defined( 'NV_IS_FILE_ADMIN' ) ) die( 'Stop!!!' );

$lopid = $nv_Request->get_int( 'lopid', 'post,get', 0 );
$new_acgv = $nv_Request->get_int( 'new_acgv', 'post,get', 0 );
$cnid = $nv_Request->get_int( 'cnid', 'post,get', 0 );
$khid = $nv_Request->get_int( 'khid', 'post,get', 0 );

if ($lopid != 0){
	$sql = 'UPDATE ' . NV_PREFIXLANG . '_' . $module_data . '_lop SET gvid='. $new_acgv .' WHERE lopid=' . $lopid;
	$db->query( $sql ) or die ('Đã có lỗi xảy ra trong câu lệnh truy vấn');
}
if ( $nv_Request->isset_request( 'new_cn', 'post,get' ) ){
	if ( empty( $cnid ) ) die( 'NO' );
    $query = 'SELECT chunhiem FROM ' . NV_PREFIXLANG . '_' . $module_data . '_dsgv WHERE gvid=' . $cnid;
    $result = $db->query( $query );
    $numrows = $result->rowCount();
    if ( $numrows != 1 ) die( 'NO' );

    $new_cn = $result->fetchColumn();

    $new_cn = $new_cn ? 0 : 1;
    // Cap nhat vao CSDL
    $sql = 'UPDATE ' . NV_PREFIXLANG . '_' . $module_data . '_dsgv SET chunhiem='. $new_cn .' WHERE gvid=' . $cnid;
	$db->query( $sql ) or die ('Đã có lỗi xảy ra trong câu lệnh truy vấn');
}
if ( $nv_Request->isset_request( 'new_kh', 'post,get' ) ){
	if ( empty( $khid ) ) die( 'NO' );
    $query = 'SELECT active FROM ' . NV_PREFIXLANG . '_' . $module_data . '_dsgv WHERE gvid=' . $khid;
    $result = $db->query( $query );
    $numrows = $result->rowCount();
    if ( $numrows != 1 ) die( 'NO' );

    $new_kh = $result->fetchColumn();
    $new_kh = $new_kh ? 0 : 1;
    // Cap nhat vao CSDL
    $sql1 = 'UPDATE ' . NV_PREFIXLANG . '_' . $module_data . '_dsgv SET active='. $new_kh .' WHERE gvid=' . $khid;
	$db->query( $sql1 ) or die ('Đã có lỗi xảy ra trong câu lệnh truy vấn');
}
include ( NV_ROOTDIR . '/includes/header.php' );
include ( NV_ROOTDIR . '/includes/footer.php' );

