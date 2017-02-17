<?php
/**
 * @Author GaNguCay (gangucay@gmail.com)
 * @createdate 05/09/2010
 */

if (! defined ( 'NV_IS_FILE_ADMIN' ))
	die ( 'Stop!!!' );

$id = $nv_Request->get_int ( 'id', 'get,post' );

if ($nv_Request->get_int ( 'save', 'post' )) {
	$code = $nv_Request->get_int ( 'code', 'post', '', 1 );
	$name = $nv_Request->get_title ( 'name', 'post', '', 1 );
	if (! empty ( $id )) {
		$result = $db->query ( "UPDATE " . NV_PREFIXLANG . "_" . $module_data . "_namhoc SET tennamhoc=" . $db->quote ( $name ) . " WHERE manamhoc=" . $id . "" );
		if ($result) {
			echo $lang_module ['addnam_update_success'];
		} else {
			print_r ( $db->sql_error () );
		}
	} else {
		$query = $db->query ( "SELECT manamhoc FROM " . NV_PREFIXLANG . "_" . $module_data . "_namhoc WHERE manamhoc = " . $db->quote ( $code ) . "" );
		$alreadycode = $query->rowCount();
		if (! $alreadycode) {
			$result = $db->query ( "INSERT INTO " . NV_PREFIXLANG . "_" . $module_data . "_namhoc VALUES (" . $db->quote ( $code ) . "," . $db->quote ( $name ) . ")" );
			if ($result) {
				echo $lang_module ['addnam_success'];
			} else {
				print_r ( $db->sql_error () );
			}
		} else {
			echo '
	<script type="text/javascript">
		alert("' . $lang_module ['addnam_error_code_exist'] . '");
	</script>
		';
		}
	}
} else {
	if (! empty ( $id )) {
		$row = $db->query ( "SELECT * FROM " . NV_PREFIXLANG . "_" . $module_data . "_namhoc WHERE manamhoc='$id'" )->fetch();
		$dis = ! empty ( $id )?'disabled':'';
	} else {
		$row['manamhoc'] = $row['tennamhoc'] = $dis = '';
	}
	$contents .= "<table class=\"table\" style='width:400px'>\n";
	$contents .= "<thead>\n";
	$contents .= "<tr>\n";
	$contents .= "<td colspan=\"2\">" . $lang_module ['addnam_title'] . "</td>\n";
	$contents .= "</tr>\n";
	$contents .= "</thead>\n";
	$contents .= "<tbody class='second'>\n";
	$contents .= "<tr>\n";
	$contents .= "<td style='width:150px'>" . $lang_module ['manam'] . "</td>\n";
	$contents .= "<td>";
	$contents .= "<input type='text' value='" . $row['manamhoc'] . "' name='code' style='width:150px' ".$dis.">";
	$contents .= "</td>\n";
	$contents .= "</tr>\n";
	$contents .= "</tbody>\n";
	$contents .= "<tr>\n";
	$contents .= "<td style='width:150px'>" . $lang_module ['tennamhoc'] . "</td>\n";
	$contents .= "<td>";
	$contents .= "<input type='text' value='" . $row ['tennamhoc'] . "' name='name' style='width:250px'>";
	$contents .= "</td>\n";
	$contents .= "</tr>\n";
	$contents .= "<tbody class='second'>\n";
	$contents .= "<tr>\n";
	$contents .= "<td colspan='2' align = 'center'>";
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
	var code = $('input[name=\"code\"]').val();
	if (code==''){
		alert('" . $lang_module ['addname_error_code'] . "');
		$('input[name=\"code\"]').focus();
		return false;
	}
	var name = $('input[name=\"name\"]').val();
	if (name==''){
		alert('" . $lang_module ['addname_error_name'] . "');
		$('input[name=\"name\"]').focus();
		return false;
	}
	$('span[name=\"notice\"]').html('<img src=\"../images/load.gif\"> please wait...');
	$.ajax({	
		type: 'POST',
		url: 'index.php?" . NV_NAME_VARIABLE . "=" . $module_name . "&" . NV_OP_VARIABLE . "=addnam',
		data: 'code='+ code + '&name='+name+'&save=1" . (! empty ( $id ) ? '&id=' . $id . '' : '') . "',
		success: function(data){				
			$('input[name=\"confirm\"]').removeAttr('disabled');
			$('span[name=\"notice\"]').html(data);
			window.location='index.php?" . NV_NAME_VARIABLE . "=" . $module_name . "&" . NV_OP_VARIABLE . "=quanli_nam';
		}
	});
});
});
</script>
";
}
echo $contents;
