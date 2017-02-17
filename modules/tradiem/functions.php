<?php
/**
 * @Author GaNguCay (gangucay@gmail.com)
 * @createdate 05/09/2010
 */

if (! defined ( 'NV_SYSTEM' ))
	die ( 'Stop!!!' );
define ( 'NV_IS_MOD_TRADIEM', true );
function creat_config($str) {
	if (! file_exists ( NV_ROOTDIR . '/' . NV_DATADIR . '/tradiem/' . $str . ".txt" )) {
		$f = fopen ( NV_ROOTDIR . '/' . NV_DATADIR . '/tradiem/' . $str . ".txt", "w" );
		if ($str == 'config') {
			fwrite ( $f, 'Hệ thống tra điểm của trường THPT Vinh Lộc|20/08/2010|7h00|13h00' );
		}
		fclose ( $f );
	}
}
function is_admin($nickname) {
	global $module_data, $db;
	$sql = "SELECT a.userid FROM " . NV_USERS_GLOBALTABLE . " a INNER JOIN " . NV_AUTHORS_GLOBALTABLE . " b ON a.userid=b.admin_id WHERE a.username=" . $db->quote ( $nickname ) . "";
	list ( $userid ) = $db->fetch ( $db->query ( $sql ) );
	return ($userid) ? 1 : 0;
}
