<?php

/**
 * @Author GaNguCay (gangucay@gmail.com)
 * @createdate 05/09/2010
 */
if ( ! defined( 'NV_IS_FILE_ADMIN' ) ) die( 'Stop!!!' );
$page_title = $lang_module['quanli_diem'];
	$lopid = $nv_Request->get_int ( 'lopid', 'post,get' );
	$monid = $nv_Request->get_int ( 'monid', 'post,get' );
	$mahocky = $nv_Request->get_int ( 'mahocky', 'post,get' );
	$manamhoc = $nv_Request->get_int ( 'manamhoc', 'post,get' );
	if (!empty($lopid) and !empty($monid) and !empty($mahocky) and !empty($manamhoc)){
	// Hien thi hop lua chon
	$contents .= "<div>";
    $contents .= "<form name=\"deltkb\" action=\"\" method=\"post\">";
    $contents .= "<table summary=\"\" class=\"table\">\n";
    $contents .= "<td>";
    $contents .= "<center><b><font color=blue size=\"3\">" . $lang_module['quanli_diem_td'] . "</font></b></center>";
    $contents .= "</td>\n";
    $contents .= "</table>";
	$contents .= "</form>";
    $contents .= "</div>";
		$contents .= "<form name=\"chon_ds\" method=\"post\">";
		$contents .= "<table summary=\"\" class=\"table\">\n";
		$contents .= "<td align = \"center\">";
		// Chon mon hoc
		$contents .= "<select name = \"monid\">";
		$contents .= "<option value=\"0\" size = \"50\">&nbsp;Chọn môn học</option>";
		$sql = "SELECT * FROM " . NV_PREFIXLANG . "_" . $module_data . "_monhoc";
		$result = $db->query( $sql);
		while ($monhoc = $result->fetch())
		{
			if ($monid == $monhoc['monid']){
				$tenmon = $monhoc['tenmon'];
				$sel = "selected";
			} else {
				$sel = "";
			}
			$contents .= '<option value="' . $monhoc['monid'] . '" "' . $sel . '">&nbsp;' . $monhoc['tenmon'] . '</option>';
		}
		$contents .= "</select>&nbsp;&nbsp;";
		// Chon lop
		$contents .= "<select name = \"lopid\">";
		$contents .= "<option value=\"0\" size = \"50\">&nbsp;Chọn lớp</option>";
		$sql = "SELECT * FROM " . NV_PREFIXLANG . "_" . $module_data . "_lop";
		$result = $db->query( $sql);
		while ($dslop = $result->fetch())
		{
			if ($lopid == $dslop['lopid']){
				$tenlop = $dslop['tenlop'];
				$sel = "selected";
			} else {
				$sel = "";
			}
			$contents .= '<option value="' . $dslop['lopid'] . '" "' . $sel . '">&nbsp;' . $dslop['tenlop'] . '</option>';
		}
		$contents .= "</select>&nbsp;&nbsp;";
		// Chon hoc ki
		$contents .= "<select name = \"mahocky\">";
		$contents .= "<option value=\"0\" size = \"60\">&nbsp;Chọn học kì</option>";
		$hocki = array(1 => 'Học kì I', 2 => 'Học kì II');
		For ($i = 1; $i <= 2; $i ++)
		{
			if ($mahocky == $i){
				$tenhk = $hocki[$i];
				$sel = "selected";
			} else {
				$sel = "";
			}
			$contents .= "<option value=\"$i\" ". $sel .">&nbsp;$hocki[$i]</option>";
		}
		$contents .= "</select>&nbsp;&nbsp;";

		// Chon nam hoc
		$contents .= "<select name = \"manamhoc\">";
		$contents .= "<option value=\"0\" size = \"50\">&nbsp;Chọn năm học</option>";
		$sql = "SELECT * FROM " . NV_PREFIXLANG . "_" . $module_data . "_namhoc";
		$result = $db->query( $sql);
		while ($namhoc = $result->fetch())
		{
			if ($manamhoc == $namhoc['manamhoc']){
				$tennamhoc = $namhoc['tennamhoc'];
				$sel = "selected";
			} else {
				$sel = "";
			}
			$contents .= '<option value="' . $namhoc['manamhoc'] . '" "' . $sel . '">&nbsp;' . $namhoc['tennamhoc'] . '</option>';
		}
		$contents .= "</select>";
		
		$contents .= "&nbsp;&nbsp;&nbsp;<input type=\"submit\" name=\"submit\" value = \"" . $lang_module['thuchien'] . "\" /></center>";
		$contents .= "</td>\n";
		$contents .= "</table>";
		$contents .= "</form>";
		// Het hop lua chon
		$contents .= "<div>";
	    $contents .= "<form>";
	    $contents .= "<table summary=\"\" class=\"table\">\n";
	    $contents .= "<td>";
	    $contents .= "<center><b><font color=blue size=\"3\">" . $lang_module['diem_td'] . "".$tenlop."<br />" . $lang_module['namhoc_td'] ."".$tennamhoc."</font></b></center>";
	    $contents .= "</td>\n";
	    $contents .= "</table>";
		$contents .= "</form>";
	    $contents .= "</div>";
		$sql = "SELECT DISTINCT " . NV_PREFIXLANG . "_" . $module_data . "_diem.id," . NV_PREFIXLANG . "_" . $module_data . "_diem.mahs," . NV_PREFIXLANG . "_" . $module_data . "_diem.15_1," . NV_PREFIXLANG . "_" . $module_data . "_diem.15_2," . NV_PREFIXLANG . "_" . $module_data . "_diem.15_3," . NV_PREFIXLANG . "_" . $module_data . "_diem.15_4," . NV_PREFIXLANG . "_" . $module_data . "_diem.15_5," . NV_PREFIXLANG . "_" . $module_data . "_diem.15_6," . NV_PREFIXLANG . "_" . $module_data . "_diem.15_7," . NV_PREFIXLANG . "_" . $module_data . "_diem.45_1," . NV_PREFIXLANG . "_" . $module_data . "_diem.45_2," . NV_PREFIXLANG . "_" . $module_data . "_diem.45_3," . NV_PREFIXLANG . "_" . $module_data . "_diem.45_4," . NV_PREFIXLANG . "_" . $module_data . "_diem.45_5," . NV_PREFIXLANG . "_" . $module_data . "_diem.45_6," . NV_PREFIXLANG . "_" . $module_data . "_diem.45_7," . NV_PREFIXLANG . "_" . $module_data . "_diem.thi," . NV_PREFIXLANG . "_" . $module_data . "_diem.tbm," . NV_PREFIXLANG . "_" . $module_data . "_dshs.hoten FROM " . NV_PREFIXLANG . "_" . $module_data . "_diem," . NV_PREFIXLANG . "_" . $module_data . "_dshs WHERE " . NV_PREFIXLANG . "_" . $module_data . "_diem.lopid = ".$lopid." AND " . NV_PREFIXLANG . "_" . $module_data . "_diem.manamhoc = ".$manamhoc." AND " . NV_PREFIXLANG . "_" . $module_data . "_diem.mahocky = ".$mahocky." AND " . NV_PREFIXLANG . "_" . $module_data . "_diem.monid=".$monid." AND " . NV_PREFIXLANG . "_" . $module_data . "_diem.mahs = " . NV_PREFIXLANG . "_" . $module_data . "_dshs.mahs ORDER BY " . NV_PREFIXLANG . "_" . $module_data . "_diem.mahs ASC";

		$result = $db->query( $sql);
		$contents .= "<table class=\"table\">\n";
		$contents .= "<thead>\n";
		$contents .= "<tr>\n";
		$contents .= "<td align='center'>" . $lang_module ['stt'] . "</td>\n";
		$contents .= "<td align='center'>" . $lang_module ['hoten'] . "</td>\n";
		// $contents .= "<td align='center' colspan = '2'>" . $lang_module ['dmieng'] . "</td>\n";
		$contents .= "<td align='center' colspan = '5'>" . $lang_module ['d15ph'] . "</td>\n";
		$contents .= "<td align='center' colspan = '5'>" . $lang_module ['dhs2'] . "</td>\n";
		$contents .= "<td align='center'>" . $lang_module ['dthi'] . "</td>\n";
		$contents .= "<td align='center'>" . $lang_module ['tbm'] . "</td>\n";
		$contents .= "<td align='center' width = '13%'>" . $lang_module ['quanli'] . "</td>\n";
		$contents .= "</tr>\n";
		$contents .= "</thead>\n";
		$gtinh = array(0 => 'Nữ', 1 => 'Nam');
		$a = 0;
		while ($dshs = $result->fetch())
		{
			$class = ($a % 2) ? " class=\"second\"" : "";
			$contents .= "<tbody" . $class . ">\n";
			$contents .= "<tr>\n";
			$contents .= "<td align=\"center\" width = \"4%\">" . ++$a . "</td>\n";
			$contents .= "<td align=\"left\">" . $dshs ['hoten']."</td>\n";
			$contents .= "<td align=\"center\" width = \"4%\">" . $dshs ['15_1']."</td>\n";
			$contents .= "<td align=\"center\" width = \"4%\">" . $dshs ['15_2']."</td>\n";
			$contents .= "<td align=\"center\" width = \"4%\">" . $dshs ['15_3']."</td>\n";
			$contents .= "<td align=\"center\" width = \"4%\">" . $dshs ['15_4']."</td>\n";
			$contents .= "<td align=\"center\" width = \"4%\">" . $dshs ['15_5']."</td>\n";
			$contents .= "<td align=\"center\" width = \"4%\">" . $dshs ['15_6']."</td>\n";
			$contents .= "<td align=\"center\" width = \"4%\">" . $dshs ['15_7']."</td>\n";
			$contents .= "<td align=\"center\" width = \"4%\">" . $dshs ['45_1']."</td>\n";
			$contents .= "<td align=\"center\" width = \"4%\">" . $dshs ['45_2']."</td>\n";
			$contents .= "<td align=\"center\" width = \"4%\">" . $dshs ['45_3']."</td>\n";
			$contents .= "<td align=\"center\" width = \"4%\">" . $dshs ['45_4']."</td>\n";
			$contents .= "<td align=\"center\" width = \"4%\">" . $dshs ['45_5']."</td>\n";
			$contents .= "<td align=\"center\" width = \"4%\">" . $dshs ['45_6']."</td>\n";
			$contents .= "<td align=\"center\" width = \"4%\">" . $dshs ['45_7']."</td>\n";
			$contents .= "<td align=\"center\" width = \"5%\">" . $dshs ['thi']."</td>\n";
			$contents .= "<td align=\"center\" width = \"5%\">" . $dshs ['tbm']."</td>\n";
			$contents .= "<td align=\"center\">";
			$contents .= "<span class=\"edit_icon\"><a class='edit' href=\"index.php?" . NV_NAME_VARIABLE . "=" . $module_data . "&" . NV_OP_VARIABLE . "=adddiem&amp;id=" . $dshs ['id'] . "\">" . $lang_global ['edit'] . "</a></span>\n";
			$contents .= "&nbsp;-&nbsp;<span class=\"delete_icon\"><a class='del' href=\"index.php?" . NV_NAME_VARIABLE . "=" . $module_data . "&" . NV_OP_VARIABLE . "=deldiem&amp;id=" . $dshs ['id'] . "\">" . $lang_global ['delete'] . "</a></span></td>\n";
			$contents .= "</tr>\n";
			$contents .= "</tbody>\n";
		}
	$contents .= "<tfoot><tr><td colspan='17'><span class=\"btn btn-primary\"><a class='khoitao' href=\"index.php?" . NV_NAME_VARIABLE . "=" . $module_data . "&" . NV_OP_VARIABLE . "=khoitaodl&amp;lopid=" . $lopid . "&amp;manamhoc=" . $manamhoc . "&amp;mahocky=" . $mahocky . "&amp;monid=" . $monid . "\">" . $lang_module ['khoitao'] . "</a></span></td></tr></tfoot>";
	$contents .= "</table>\n";
	$my_head = "<script type=\"text/javascript\" src=\"" . NV_BASE_SITEURL . "js/popcalendar/popcalendar.js\"></script>\n";
	// Het hien thi danh sach
	$contents .= "<div id='contentedit'></div><input id='hasfocus' style='width:0px;height:0px'/>";
	$contents .= "
	<script type='text/javascript'>
	$(function(){
	$('a[class=\"add\"]').click(function(event){
		event.preventDefault();
		var href= $(this).attr('href');
		$('#contentedit').load(href,function(){
			$('#hasfocus').focus();
		});

	});
	$('a[class=\"edit\"]').click(function(event){
		event.preventDefault();
		var href= $(this).attr('href');
		$('#contentedit').load(href,function(){
			$('#hasfocus').focus();
		});
	});
	$('a[class=\"del\"]').click(function(event){
		event.preventDefault();
		var href= $(this).attr('href');
		if (confirm('".$lang_module['deldiem_del_confirm']."')){
			$.ajax({	
				type: 'POST',
				url: href,
				data: '',
				success: function(data){				
					alert(data);
					window.location='index.php?" . NV_NAME_VARIABLE . "=" . $module_name . "&".NV_OP_VARIABLE."=quanli_diem';
				}
			});
		}
	});
		$('a[class=\"khoitao\"]').click(function(event){
		event.preventDefault();
		var href= $(this).attr('href');
		if (confirm('".$lang_module['khoitaodl_confirm']."')){
			$.ajax({	
				type: 'POST',
				url: href,
				data: '',
				success: function(data){				
					alert(data);
					window.location='index.php?" . NV_NAME_VARIABLE . "=" . $module_name . "&".NV_OP_VARIABLE."=quanli_diem&monid='+ monid +'&lopid='+ lopid +'&mahocky='+ mahocky +'&manamhoc='+ manamhoc +'';
				}
			});
		}
	});
	});
	</script>
	";

	}else {
	$contents .= "<div>";
    $contents .= "<form name=\"deltkb\" action=\"\" method=\"post\">";
    $contents .= "<table summary=\"\" class=\"table\">\n";
    $contents .= "<td>";
    $contents .= "<center><b><font color=blue size=\"3\">" . $lang_module['quanli_diem_td'] . "</font></b></center>";
    $contents .= "</td>\n";
    $contents .= "</table>";
	$contents .= "</form>";
    $contents .= "</div>";
		$contents .= "<form name=\"chon_ds\" method=\"post\">";
		$contents .= "<table summary=\"\" class=\"table\">\n";
		$contents .= "<td align = \"center\">";
		// Chon mon hoc
		$contents .= "<select name = \"monid\">";
		$contents .= "<option value=\"0\" size = \"50\">&nbsp;Chọn môn học</option>";
		$sql = "SELECT * FROM " . NV_PREFIXLANG . "_" . $module_data . "_monhoc";
		$result = $db->query( $sql);
		while ($monhoc = $result->fetch())
		{
			if ($monid == $monhoc['monid']){
				$tenmon = $monhoc['tenmon'];
				$sel = "selected";
			} else {
				$sel = "";
			}
			$contents .= '<option value="' . $monhoc['monid'] . '" "' . $sel . '">&nbsp;' . $monhoc['tenmon'] . '</option>';
		}
		$contents .= "</select>&nbsp;&nbsp;";
		// Chon lop
		$contents .= "<select name = \"lopid\">";
		$contents .= "<option value=\"0\" size = \"50\">&nbsp;Chọn lớp</option>";
		$sql = "SELECT * FROM " . NV_PREFIXLANG . "_" . $module_data . "_lop";
		$result = $db->query( $sql);
		while ($dslop = $result->fetch())
		{
			if ($lopid == $dslop['lopid']){
				$tenlop = $dslop['tenlop'];
				$sel = "selected";
			} else {
				$sel = "";
			}
			$contents .= '<option value="' . $dslop['lopid'] . '" "' . $sel . '">&nbsp;' . $dslop['tenlop'] . '</option>';
		}
		$contents .= "</select>&nbsp;&nbsp;";
		// Chon hoc ki
		$contents .= "<select name = \"mahocky\">";
		$contents .= "<option value=\"0\" size = \"60\">&nbsp;Chọn học kì</option>";
		$hocki = array(1 => 'Học kì I', 2 => 'Học kì II');
		For ($i = 1; $i <= 2; $i ++)
		{
			if ($mahocky == $i){
				$tenhk = $hocki[$i];
				$sel = "selected";
			} else {
				$sel = "";
			}
			$contents .= "<option value=\"$i\" ". $sel .">&nbsp;$hocki[$i]</option>";
		}
		$contents .= "</select>&nbsp;&nbsp;";
		// Chon nam hoc
		$contents .= "<select name = \"manamhoc\">";
		$contents .= "<option value=\"0\" size = \"50\">&nbsp;Chọn năm học</option>";
		$sql = "SELECT * FROM " . NV_PREFIXLANG . "_" . $module_data . "_namhoc";
		$result = $db->query( $sql);
		while ($namhoc = $result->fetch())
		{
		if ($manamhoc == $namhoc['manamhoc']){
				$tennamhoc = $namhoc['tennamhoc'];
				$sel = "selected";
			} else {
				$sel = "";
			}
			$contents .= '<option value="' . $namhoc['manamhoc'] . '" "' . $sel . '">&nbsp;' . $namhoc['tennamhoc'] . '</option>';
		}
		$contents .= "</select>";
		
		$contents .= "&nbsp;&nbsp;&nbsp;<input type=\"submit\" name=\"submit\" value = \"" . $lang_module['thuchien'] . "\" /></center>";
		$contents .= "</td>\n";
		$contents .= "</table>";
		$contents .= "</form>";
    }
include (NV_ROOTDIR . "/includes/header.php");
echo nv_admin_theme ( $contents);
include (NV_ROOTDIR . "/includes/footer.php");
