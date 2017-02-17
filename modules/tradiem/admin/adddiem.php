<?php
/**
 * @Author GaNguCay (gangucay@gmail.com)
 * @createdate 05/09/2010
 */

if (! defined ( 'NV_IS_FILE_ADMIN' ))
	die ( 'Stop!!!' );

$id = $nv_Request->get_int ( 'id', 'get,post' );
$lopid = $nv_Request->get_int ( 'lopid', 'get,post' );
$manamhoc = $nv_Request->get_int ( 'manamhoc', 'get,post' );
$monid = $nv_Request->get_title ( 'monid', 'post','', 1);
$mahocky = $nv_Request->get_title ( 'mahocky', 'get,post');

if ($nv_Request->get_int ( 'save', 'post' )) {
	$d15_1 = $nv_Request->get_title ( 'd15_1', 'post','', 1);
	$d15_2 = $nv_Request->get_title ( 'd15_2', 'post','', 1);
	$d15_3 = $nv_Request->get_title ( 'd15_3', 'post','', 1);
	$d15_4 = $nv_Request->get_title ( 'd15_4', 'post','', 1);
	$d15_5 = $nv_Request->get_title ( 'd15_5', 'post','', 1);
	$d15_6 = $nv_Request->get_title ( 'd15_6', 'post','', 1);
	$d15_7 = $nv_Request->get_title ( 'd15_7', 'post','', 1);
	$d15_8 = $nv_Request->get_title ( 'd15_8', 'post','', 1);
	$d15_9 = $nv_Request->get_title ( 'd15_9', 'post','', 1);
	
	$d45_1 = $nv_Request->get_title ( 'd45_1', 'post','', 1);
	$d45_2 = $nv_Request->get_title ( 'd45_2', 'post','', 1);
	$d45_3 = $nv_Request->get_title ( 'd45_3', 'post','', 1);
	$d45_4 = $nv_Request->get_title ( 'd45_4', 'post','', 1);
	$d45_5 = $nv_Request->get_title ( 'd45_5', 'post','', 1);
	$d45_6 = $nv_Request->get_title ( 'd45_6', 'post','', 1);
	$d45_7 = $nv_Request->get_title ( 'd45_7', 'post','', 1);
	
	$thi = $nv_Request->get_title ( 'thi', 'post','', 1);
	$tbm = $nv_Request->get_title ( 'tbm', 'post','', 1);
	$id = $nv_Request->get_int ( 'id', 'post' );

	if (! empty ( $id )) {
		$result = $db->query ( "UPDATE " . NV_PREFIXLANG . "_" . $module_data . "_diem SET 15_1=" . $db->quote ( $d15_1 ). ",15_2=" . $db->quote ( $d15_2 ). ",15_3=" . $db->quote ( $d15_3 ). ",15_4=" . $db->quote ( $d15_4 ). ",15_5=" . $db->quote ( $d15_5 ). ",15_6=" . $db->quote ( $d15_6 ). ",15_7=" . $db->quote ( $d15_7 ). ",15_8=" . $db->quote ( $d15_8 ). ",15_9=" . $db->quote ( $d15_9 ). ",45_1=" . $db->quote ( $d45_1 ). ",45_2=" . $db->quote ( $d45_2 ). ",45_3=" . $db->quote ( $d45_3 ). ",45_4=" . $db->quote ( $d45_4 ). ",45_5=" . $db->quote ( $d45_5 ). ",45_6=" . $db->quote ( $d45_6 ). ",45_7=" . $db->quote ( $d45_7 ). ",thi=" . $db->quote ( $thi ). ",tbm=" . $db->quote ( $tbm ). " WHERE id=" . $id . "" );
		if ($result) {
			echo $lang_module['adddiem_update_success'];
		} else {
			print_r ( $db->sql_error () );
		}
	} 
} else {
	if (! empty ( $id )) {
		$row =  $db->query ( "SELECT * FROM " . NV_PREFIXLANG . "_" . $module_data . "_diem WHERE id='$id'" )->fetch ();
		$dis = ! empty ( $id )?'disabled':'';
	} else {
		$row ['mahs'] = $row ['hoten'] ='';
	}
	$rowten = $db->query ( "SELECT hoten FROM " . NV_PREFIXLANG . "_" . $module_data . "_dshs WHERE mahs='".$row ['mahs']."'" )->fetch ();
	$contents .= "<table class=\"table\" style='width:600px'>\n";
	$contents .= "<thead>\n";
	$contents .= "<tr>\n";
	$contents .= "<td colspan=\"2\">" . $lang_module ['adddiem_title'] . "</td>\n";
	$contents .= "</tr>\n";
	$contents .= "</thead>\n";
	$contents .= "<tbody class='second'>\n";
	$contents .= "<tr>\n";
	$contents .= "<td style='width:150px'>" . $lang_module ['mahs'] . "</td>\n";
	$contents .= "<td>";
	$contents .= "<input type='text' value='" . $row ['mahs'] . "' name='mahs' style='width:70px' ".$dis.">";
	$contents .= "<input type='hidden' value='" . (isset($row ['lopid'])?$row ['lopid']:$lopid) . "' name='lopid'>";
	$contents .= "<input type='hidden' value='" . (isset($row ['manamhoc'])?$row ['manamhoc']:$manamhoc) . "' name='manamhoc'>";
	$contents .= "<input type='hidden' value='" . (isset($row ['mahocky'])?$row ['mahocky']:$mahocky) . "' name='mahocky'>";
	$contents .= "<input type='hidden' value='" . (isset($row ['monid'])?$row ['monid']:$monid) . "' name='monid'>";
	$contents .= "</td>\n";
	$contents .= "</tr>\n";
	$contents .= "</tbody>\n";
	$contents .= "<tr>\n";
	$contents .= "<td style='width:150px'>" . $lang_module ['hoten'] . "</td>\n";
	$contents .= "<td>";
	$contents .= "<input type='text' value='" . $rowten ['hoten'] . "' name='hoten' style='width:250px'  ".$dis.">";
	$contents .= "</td>\n";
	$contents .= "</tr>\n";
	$contents .= "<tbody class='second'>\n";
	$contents .= "</tbody>\n";
	$contents .= "<tr>\n";
	$contents .= "<td style='width:150px'>" . $lang_module ['d15ph'] . "</td>\n";
	$contents .= "<td><input type='text' value='" . $row ['15_1'] . "' name='d15_1' style='width:40px'>
				<input type='text' value='" . $row ['15_2'] . "' name='d15_2' style='width:40px'>
				<input type='text' value='" . $row ['15_3'] . "' name='d15_3' style='width:40px'>
				<input type='text' value='" . $row ['15_4'] . "' name='d15_4' style='width:40px'>
				<input type='text' value='" . $row ['15_5'] . "' name='d15_5' style='width:40px'>
				<input type='text' value='" . $row ['15_6'] . "' name='d15_6' style='width:40px'>
				<input type='text' value='" . $row ['15_7'] . "' name='d15_7' style='width:40px'>
				<input type='text' value='" . $row ['15_8'] . "' name='d15_8' style='width:40px'>
				<input type='text' value='" . $row ['15_9'] . "' name='d15_9' style='width:40px'></td>";
	$contents .= "</tr>\n";
	$contents .= "<tbody class='second'>\n";
	$contents .= "<tr>\n";
	$contents .= "<td style='width:150px'>" . $lang_module ['dhs2'] . "</td>\n";
	$contents .= "<td><input type='text' value='" . $row ['45_1'] . "' name='d45_1' style='width:40px'>
				<input type='text' value='" . $row ['45_2'] . "' name='d45_2' style='width:40px'>
				<input type='text' value='" . $row ['45_3'] . "' name='d45_3' style='width:40px'>
				<input type='text' value='" . $row ['45_4'] . "' name='d45_4' style='width:40px'>
				<input type='text' value='" . $row ['45_5'] . "' name='d45_5' style='width:40px'>
				<input type='text' value='" . $row ['45_6'] . "' name='d45_6' style='width:40px'>
				<input type='text' value='" . $row ['45_7'] . "' name='d45_7' style='width:40px'></td>";
	$contents .= "</tr>\n";
	$contents .= "</tbody>\n";
	$contents .= "<tr>\n";
	$contents .= "<td style='width:150px'>" . $lang_module ['dthi'] . "</td>\n";
	$contents .= "<td><input type='text' value='" . $row ['thi'] . "' name='thi' style='width:40px'></td>";
	$contents .= "</tr>\n";
	$contents .= "<tbody class='second'>\n";
	$contents .= "<tr>\n";
	$contents .= "<td style='width:150px'>" . $lang_module ['tbm'] . "</td>\n";
	$contents .= "<td><input type='text' value='" . $row ['tbm'] . "' name='tbm' style='width:40px'></td>";
	$contents .= "</tr>\n";
	$contents .= "</tbody>\n";
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
	var d15_1 = $('input[name=\"d15_1\"]').val();
	var d15_2 = $('input[name=\"d15_2\"]').val();
	var d15_3 = $('input[name=\"d15_3\"]').val();
	var d15_4 = $('input[name=\"d15_4\"]').val();
	var d15_5 = $('input[name=\"d15_5\"]').val();
	var d15_6 = $('input[name=\"d15_6\"]').val();
	var d15_7 = $('input[name=\"d15_7\"]').val();
	var d15_8 = $('input[name=\"d15_8\"]').val();
	var d15_9 = $('input[name=\"d15_9\"]').val();
	
	var d45_1 = $('input[name=\"d45_1\"]').val();
	var d45_2 = $('input[name=\"d45_2\"]').val();
	var d45_3 = $('input[name=\"d45_3\"]').val();
	var d45_4 = $('input[name=\"d45_4\"]').val();
	var d45_5 = $('input[name=\"d45_5\"]').val();
	var d45_6 = $('input[name=\"d45_6\"]').val();
	var d45_7 = $('input[name=\"d45_7\"]').val();
	
	var thi = $('input[name=\"thi\"]').val();
	var tbm = $('input[name=\"tbm\"]').val();
	var monid = $('input[name=\"monid\"]').val();
	var lopid = $('input[name=\"lopid\"]').val();
	var mahocky = $('input[name=\"mahocky\"]').val();
	var manamhoc = $('input[name=\"manamhoc\"]').val();
	$('span[name=\"notice\"]').html('<img src=\"../images/load.gif\"> Xin đợi một lát...');
	$.ajax({	
		type: 'POST',
		url: 'index.php?" . NV_NAME_VARIABLE . "=" . $module_name . "&" . NV_OP_VARIABLE . "=adddiem',
		data: 'd15_1='+ d15_1 + '&d15_2='+ d15_2 + '&d15_3='+ d15_3+ '&d15_4='+ d15_4+ '&d15_5='+ d15_5 +'&d15_6='+ d15_6 + '&d15_7='+ d15_7 +'&d15_8='+ d15_8 + '&d15_9='+ d15_9 +'&d45_1='+ d45_1 +'&d45_2='+ d45_2 + '&d45_3='+ d45_3 +'&d45_4='+ d45_4 + '&d45_5='+ d45_5 + '&d45_6='+ d45_6+ '&d45_7='+ d45_7 +'&thi='+ thi + '&tbm='+ tbm +'&save=1&id=". $id ."',
		success: function(data){				
			$('input[name=\"confirm\"]').removeAttr('disabled');
			$('span[name=\"notice\"]').html(data);
			window.location='index.php?" . NV_NAME_VARIABLE . "=" . $module_name . "&".NV_OP_VARIABLE."=quanli_diem&monid='+ monid +'&lopid='+ lopid +'&mahocky='+ mahocky +'&manamhoc='+ manamhoc +'';
		}
	});
});
});
</script>
";
}
echo $contents;
