<?php
/**
 * @Author GaNguCay (gangucay@gmail.com)
 * @createdate 05/09/2010
 */
 
if (! defined ( 'NV_IS_FILE_ADMIN' ))
	die ( 'Stop!!!' );

$id = $nv_Request->get_int ( 'id', 'get' );
if (isset($id)){
	$result = $db->query ( "UPDATE " . NV_PREFIXLANG . "_" . $module_data . "_xeploai SET tbm='',hl='',hk='',snncp='',snnkp='',danhhieu='',nxgvcn='' WHERE id=" . $id . "" );
	echo $lang_module ['delxl_del_success'];
}else{
	echo $lang_module ['delxl_del_unsuccess'];
}

