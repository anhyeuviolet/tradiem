<?php
/**
 * @Author GaNguCay (gangucay@gmail.com)
 * @createdate 05/09/2010
 */

if (! defined ( 'NV_IS_FILE_ADMIN' ))
	die ( 'Stop!!!' );

$id = $nv_Request->get_int ( 'id', 'get,post' );

if ($nv_Request->get_int ( 'save', 'post' )) {
	$monid = $nv_Request->get_title ( 'monid', 'post', '', 1 );
	$tenmon = $nv_Request->get_title ( 'tenmon', 'post','', 1);
	if (! empty ( $id )) {
		$result = $db->query ( "UPDATE " . NV_PREFIXLANG . "_" . $module_data . "_monhoc SET tenmon=" . $db->quote ( $tenmon ). " WHERE monid=" . $id . "" );
		if ($result) {
			echo $lang_module ['addmon_update_success'];
		} else {
			print_r ( $db->sql_error () );
		}
	} else {
		$sql = $db->query ( "SELECT monid FROM " . NV_PREFIXLANG . "_" . $module_data . "_monhoc WHERE monid = " . $db->quote ( $monid ) . "" );
		$alreadymonid = $sql->rowCount();
		if (! $alreadymonid) {
			$result = $db->query ( "INSERT INTO " . NV_PREFIXLANG . "_" . $module_data . "_monhoc VALUES (" . $db->quote ( $monid ) . ", " . $db->quote ( $tenmon ) . ")" );
			if ($result) {
				echo $lang_module ['addmon_success'];
			} else {
				print_r ( $db->sql_error () );
			}
		} else {
			echo '
	<script type="text/javascript">
		alert("' . $lang_module ['addmon_error_code_exist'] . '");
	</script>
		';
		}
	}
} else {
	if (! empty ( $id )) {
		$row = $db->query ( "SELECT * FROM " . NV_PREFIXLANG . "_" . $module_data . "_monhoc WHERE monid='$id'" )->fetch ();
		$dis = ! empty ( $id )?'disabled':'';
	} else {
		$row ['monid'] = $row ['tenmon'] = $dis = '';
	}
	$contents .= "<table class=\"table\" style='width:400px'>\n";
	$contents .= "<thead>\n";
	$contents .= "<tr>\n";
	$contents .= "<td colspan=\"2\">" . $lang_module ['addmon_title'] . "</td>\n";
	$contents .= "</tr>\n";
	$contents .= "</thead>\n";
	$contents .= "<tbody class='second'>\n";
	$contents .= "<tr>\n";
	$contents .= "<td style='width:150px'>" . $lang_module ['mamon'] . "</td>\n";
	$contents .= "<td>";
	$contents .= "<input type='text' value='" . $row ['monid'] . "' name='monid' style='width:150px' ".$dis.">";
	$contents .= "</td>\n";
	$contents .= "</tr>\n";
	$contents .= "</tbody>\n";
	$contents .= "<tr>\n";
	$contents .= "<td style='width:150px'>" . $lang_module ['tenmonhoc'] . "</td>\n";
	$contents .= "<td>";
	$contents .= "<input type='text' value='" . $row ['tenmon'] . "' name='tenmon' style='width:250px'>";
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
	var monid = $('input[name=\"monid\"]').val();
	if (monid==''){
		alert('" . $lang_module ['addmon_error_code'] . "');
		$('input[name=\"monid\"]').focus();
		return false;
	}
	var tenmon = $('input[name=\"tenmon\"]').val();
	if (tenmon==''){
		alert('" . $lang_module ['addmon_error_name'] . "');
		$('input[name=\"tenmon\"]').focus();
		return false;
	}

	$('span[name=\"notice\"]').html('<img src=\"../images/load.gif\"> please wait...');
	$.ajax({	
		type: 'POST',
		url: 'index.php?" . NV_NAME_VARIABLE . "=" . $module_name . "&" . NV_OP_VARIABLE . "=addmon',
		data: 'monid='+ monid + '&tenmon='+tenmon+ '&save=1" . (! empty ( $id ) ? '&id=' . $id . '' : '') . "',
		success: function(data){				
			$('input[name=\"confirm\"]').removeAttr('disabled');
			$('span[name=\"notice\"]').html(data);
			window.location='index.php?" . NV_NAME_VARIABLE . "=" . $module_name . "&".NV_OP_VARIABLE."=quanli_mon';
		}
	});
});
});
</script>
";
}
echo $contents;
