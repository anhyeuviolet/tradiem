<?php
/**
 * @Author GaNguCay (gangucay@gmail.com)
 * @createdate 05/09/2010
 */

if (! defined ( 'NV_IS_FILE_ADMIN' ))
	die ( 'Stop!!!' );

$id = $nv_Request->get_int ( 'id', 'get,post' );

if ($nv_Request->get_int ( 'save', 'post' )) {
	$lopid = $nv_Request->get_title ( 'lopid', 'post', '', 1 );
	$tenlop = $nv_Request->get_title ( 'tenlop', 'post','', 1);
	$gvid = $nv_Request->get_int ( 'gvid', 'post', 0 );
	if (! empty ( $id )) {
		$result = $db->query ( "UPDATE " . NV_PREFIXLANG . "_" . $module_data . "_lop SET tenlop=" . $db->quote ( $tenlop ). ",gvid=" . $db->quote ( $gvid ). "  WHERE lopid=" . $id . "" );
		if ($result) {
			echo $lang_module ['addlop_update_success'];
		} else {
			print_r ( $db->sql_error () );
		}
	} else {
		$query = $db->query ( "SELECT lopid FROM " . NV_PREFIXLANG . "_" . $module_data . "_lop WHERE lopid = " . $db->quote ( $lopid ) . "" );
		$alreadylopid = $query->rowCount();
		if (! $alreadylopid) {
			$result = $db->query ( "INSERT INTO " . NV_PREFIXLANG . "_" . $module_data . "_lop (lopid, tenlop,gvid) VALUES (" . $db->quote ( $lopid ) . ", " . $db->quote ( $tenlop ) . ", " . $db->quote ( $gvid ) . ")" );
			if ($result) {
				echo $lang_module ['addlop_success'];
			} else {
				print_r ( $db->sql_error () );
			}
		} else {
			echo '
	<script type="text/javascript">
		alert("' . $lang_module ['addlop_error_code_exist'] . '");
	</script>
		';
		}
	}
} else {
	if (! empty ( $id )) {
		$row = $db->query ( "SELECT * FROM " . NV_PREFIXLANG . "_" . $module_data . "_lop WHERE lopid='$id'" )->fetch();
		$dis = ! empty ( $id ) ? 'disabled' : '';
	} else {
		$row['lopid'] = $row['tenlop'] = $row['gvid'] = $dis = '';
	}

	$contents .= "<table class=\"table\" style='width:400px'>\n";
	$contents .= "<thead>\n";
	$contents .= "<tr>\n";
	$contents .= "<td colspan=\"2\">" . $lang_module ['addlop_title'] . "</td>\n";
	$contents .= "</tr>\n";
	$contents .= "</thead>\n";
	$contents .= "<tbody class='second'>\n";
	$contents .= "<tr>\n";
	$contents .= "<td style='width:150px'>" . $lang_module ['lopid'] . "</td>\n";
	$contents .= "<td>";
	$contents .= "<input class='form-control' type='text' value='" . $row['lopid'] . "' name='lopid' style='width:150px' ".$dis.">";
	$contents .= "</td>\n";
	$contents .= "</tr>\n";
	$contents .= "</tbody>\n";
	$contents .= "<tr>\n";
	$contents .= "<td style='width:150px'>" . $lang_module ['tenlop'] . "</td>\n";
	$contents .= "<td>";
	$contents .= "<input class='form-control' type='text' value='" . $row['tenlop'] . "' name='tenlop' style='width:250px'>";
	$contents .= "</td>\n";
	$contents .= "</tr>\n";
	$contents .= "<tbody class='second'>\n";
	$contents .= "<tr>\n";
	$contents .= "<td style='width:150px'>" . $lang_module ['gvcn'] . "</td>\n";
	$contents .= "<td><select class='form-control' name='gvid' id = 'gvid'>";
	// Loc danh sach giao vien
	$sqlgv = "SELECT gvid,tengv FROM " . NV_PREFIXLANG . "_" . $module_data . "_dsgv WHERE chunhiem=1 ORDER BY gvid ASC";
	$resultgv = $db->query( $sqlgv);
    $contents .= "<option value=\"0\" size = \"30\">&nbsp;Chọn giáo viên chủ nhiệm</option>";
		while ( $dsgv = $resultgv->fetch () ) {
	       	$selkh =(($dsgv['gvid'] == $row['gvid'])?'selected':'');
			$contents .= '<option value ="' . $dsgv['gvid'] . '" '. $selkh .'>&nbsp;' . $dsgv['tengv'] . '&nbsp;</option>';
		}
	$contents .= "</select></td>\n";
	$contents .= "</tr>\n";
	$contents .= "</tbody>\n";
	
	//$contents .= "<tbody class='second'>\n";
	$contents .= "<tr>\n";
	$contents .= "<td colspan='2' style='padding-left:100px'>";
	$contents .= "<span name='notice' style='float:right;padding-right:50px;color:red;font-weight:bold'></span>";
	$contents .= "<input type='button' name='confirm' value='" . $lang_module ['thuchien'] . "'>";
	$contents .= "</td>\n";
	$contents .= "</tr>\n";
	//$contents .= "</tbody>\n";
	
	$contents .= "</table>\n";
	$contents .= "
<script type='text/javascript'>
$(function(){
$('input[name=\"confirm\"]').click(function(){
	var lopid = $('input[name=\"lopid\"]').val();
	if (lopid==''){
		alert('" . $lang_module ['addlop_error_code'] . "');
		$('input[name=\"lopid\"]').focus();
		return false;
	}
	var tenlop = $('input[name=\"tenlop\"]').val();
	if (tenlop==''){
		alert('" . $lang_module ['addlop_error_name'] . "');
		$('input[name=\"tenlop\"]').focus();
		return false;
	}
	var gvid = $('#gvid').val();

	$('span[name=\"notice\"]').html('<img src=\"../images/load.gif\"> please wait...');
	$.ajax({	
		type: 'POST',
		url: 'index.php?" . NV_NAME_VARIABLE . "=" . $module_name . "&" . NV_OP_VARIABLE . "=addlop',
		data: 'lopid='+ lopid + '&tenlop='+tenlop+ '&gvid='+gvid+ '&save=1" . (! empty ( $id ) ? '&id=' . $id . '' : '') . "',
		success: function(data){				
			$('input[name=\"confirm\"]').removeAttr('disabled');
			$('span[name=\"notice\"]').html(data);
			window.location='index.php?" . NV_NAME_VARIABLE . "=" . $module_name . "&".NV_OP_VARIABLE."=quanli_lop';
		}
	});
});
});
</script>
";
}
echo $contents;
