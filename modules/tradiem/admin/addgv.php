<?php
/**
 * @Author GaNguCay (gangucay@gmail.com)
 * @createdate 05/09/2010
 */

if (! defined ( 'NV_IS_FILE_ADMIN' ))
	die ( 'Stop!!!' );

$id = $nv_Request->get_int ( 'id', 'get,post' );

if ($nv_Request->get_int ( 'save', 'post' )) {
	$gvid = $nv_Request->get_title ( 'gvid', 'post', '', 1 );
	$tengv = $nv_Request->get_title ( 'tengv', 'post','', 1);
	$user = $nv_Request->get_title ( 'user', 'post','', 1);
	$chunhiem = $nv_Request->get_int( 'chunhiem', 'post', 0 );
	$active = $nv_Request->get_int( 'active', 'post', 0 );
	
	if (! empty ( $id )) {
		$result = $db->query ( "UPDATE " . NV_PREFIXLANG . "_" . $module_data . "_dsgv SET tengv=" . $db->quote ( $tengv ). ",user=" . $db->quote ( $user ). ",chunhiem=" . $db->quote ( $chunhiem ). ",active=" . $db->quote ( $active ). " WHERE gvid=" . $id . "" );
		//$result = $db->query ( "UPDATE " . NV_PREFIXLANG . "_" . $module_data . "_dsgv SET tengv=" . $db->quote ( $tengv ). ",user=" . $db->quote ( $user ). ",chunhiem=" . $db->quote ( $chunhiem ) . ",active=" . $db->quote ( $active ) . " WHERE gvid=" . $id . "" );
		if ($result) {
			echo $lang_module ['addgv_update_success'];
		} else {
			print_r ( $db->sql_error () );
		}
	} else {
		$query = $db->query ( "SELECT gvid FROM " . NV_PREFIXLANG . "_" . $module_data . "_dsgv WHERE gvid = " . $db->quote ( $gvid ) . "" );
		$alreadygvid = $query->rowCount();
		if (! $alreadygvid) {
			$result = $db->query ( "INSERT INTO " . NV_PREFIXLANG . "_" . $module_data . "_dsgv (gvid,tengv,user,chunhiem,active)VALUES (" . $db->quote ( $gvid ) . ", " . $db->quote ( $tengv ) . ", " . $db->quote ( $user ) . ", " . $db->quote ( $chunhiem ) . ", " . $db->quote ( $active ) . ")" );	
			if ($result) {
				echo $lang_module ['addgv_success'];
			} else {
				print_r ( $db->sql_error () );
			}
		} else {
			echo '
	<script type="text/javascript">
		alert("' . $lang_module ['addgv_error_code_exist'] . '");
	</script>
		';
		}
	}
} else {
	if (! empty ( $id )) {
		$row = $db->query ( "SELECT * FROM " . NV_PREFIXLANG . "_" . $module_data . "_dsgv WHERE gvid='$id'" )->fetch ( );
		$dis = ! empty ( $id )?'disabled':'';
	} else {
		$row ['gvid'] = $row ['tengv'] = $row['chunhiem'] = $dis = $row['user'] = '';
	}
	$ch_cn = ($row['chunhiem'] == 1?'checked':'');
	if(empty($id)){
		$ch_kh = 'checked';
	}else{
		$ch_kh = ($row['active'] == 1?'checked':'');
	}
	$contents .= "<table class=\"table\" style='width:400px'>\n";
	$contents .= "<thead>\n";
	$contents .= "<tr>\n";
	$contents .= "<td colspan=\"2\">" . $lang_module ['addgv_title'] . "</td>\n";
	$contents .= "</tr>\n";
	$contents .= "</thead>\n";
	$contents .= "<tbody class='second'>\n";
	$contents .= "<tr>\n";
	$contents .= "<td style='width:150px'>" . $lang_module ['magv'] . "</td>\n";
	$contents .= "<td>";
	$contents .= "<input type='text' value='" . $row ['gvid'] . "' name='gvid' style='width:150px' ".$dis.">";
	$contents .= "</td>\n";
	$contents .= "</tr>\n";
	$contents .= "</tbody>\n";
	$contents .= "<tr>\n";
	$contents .= "<td style='width:150px'>" . $lang_module ['tengv'] . "</td>\n";
	$contents .= "<td>";
	$contents .= "<input type='text' value='" . $row ['tengv'] . "' name='tengv' style='width:250px'>";
	$contents .= "</td>\n";
	$contents .= "</tr>\n";
	$contents .= "<tbody class='second'>\n";
	$contents .= "<tr>\n";
	$contents .= "<td style='width:150px'>" . $lang_module ['user'] . "</td>\n";
	$contents .= "<td>";
	$contents .= "<input type='text' value='" . $row ['user'] . "' name='user' style='width:250px'>";
	$contents .= "</td>\n";
	$contents .= "</tr>\n";
	$contents .= "</tbody>\n";
	$contents .= "<tbody class='second'>\n";
	$contents .= "<tr>\n";
	$contents .= "<td style='width:150px'>" . $lang_module ['cn'] . "</td>\n";
	$contents .= "<td>";
	$contents .= "<input type=\"checkbox\" name=\"chunhiem\" id=\"chunhiem\" value=\"1\" ". $ch_cn ."/>";
	$contents .= "</td>\n";
	$contents .= "</tr>\n";
	$contents .= "</tbody>\n";
	$contents .= "<tr>\n";
	$contents .= "<td style='width:150px'>" . $lang_module ['active'] . "</td>\n";
	$contents .= "<td>";
	$contents .= "<input type=\"checkbox\" name=\"active\" id=\"active\" value=\"1\" ". $ch_kh ."/>";
	$contents .= "</td>\n";
	$contents .= "</tr>\n";
	$contents .= "<tbody class='second'>\n";
	$contents .= "<tr>\n";
	$contents .= "<td colspan='2' style='padding-left:100px'>";
	$contents .= "<span name='notice' style='float:right;padding-right:50px;color:red;font-weight:bold'></span>";
	$contents .= "<input type='button' name='confirm' value='" . $lang_module ['thuchien'] . "'>";
	$contents .= "</td>\n";
	$contents .= "</tr>\n";
	$contents .= "</tbody>\n";
	$contents .= "</table>\n";
	$contents .= "
<script type='text/javascript'>
$(function(){
$('input[name=\"confirm\"]').click(function(){
	var gvid = $('input[name=\"gvid\"]').val();
	if (gvid==''){
		alert('" . $lang_module ['addgv_error_code'] . "');
		$('input[name=\"gvid\"]').focus();
		return false;
	}
	var tengv = $('input[name=\"tengv\"]').val();
	if (tengv==''){
		alert('" . $lang_module ['addgv_error_name'] . "');
		$('input[name=\"tengv\"]').focus();
		return false;
	}
	
	var user = $('input[name=\"user\"]').val();
	var chunhiem = $('#chunhiem:checked').val();
	var active = $('#active:checked').val();
	$('span[name=\"notice\"]').html('<img src=\"../images/load.gif\"> Xin đợi một lát ...');
	$.ajax({	
		type: 'POST',
		url: 'index.php?" . NV_NAME_VARIABLE . "=" . $module_name . "&" . NV_OP_VARIABLE . "=addgv',
		data: 'gvid='+ gvid + '&tengv='+ tengv + '&user='+ user +'&chunhiem='+ chunhiem + '&active='+ active +'&save=1" . (! empty ( $id ) ? '&id=' . $id . '' : '') . "',
		success: function(data){
			$('input[name=\"confirm\"]').removeAttr('disabled');
			$('span[name=\"notice\"]').html(data);
			window.location='index.php?" . NV_NAME_VARIABLE . "=" . $module_name . "&".NV_OP_VARIABLE."=quanli_dsgv';
		}
	});
});
});
</script>
";
}
echo $contents;
