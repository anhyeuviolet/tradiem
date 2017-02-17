<?php
/**
 * @Author GaNguCay (gangucay@gmail.com)
 * @createdate 05/09/2010
 */
if ( ! defined( 'NV_IS_MOD_TRADIEM' ) ) die( 'Stop!!!' );

$page_title = $module_info['custom_title'];
$key_words = $module_info['keywords'];
//Doc du lieu tu file cau hinh
include (NV_ROOTDIR .'/modules/'. $module_file . "/geturl.class.php");
$code = $nv_Request->get_title ( 'keywords', 'post,get','', 1);
$hkid = $nv_Request->get_int ( 'hkid', 'post,get' );
$namid = $nv_Request->get_int ( 'namid', 'post,get' );
$findtype= $nv_Request->get_int( 'findtype', 'post,get');
$kqsearch = array(1 => $code, 2 => $hkid, 3 => $namid, 4 => $findtype);
$data = file_get_contents ( NV_ROOTDIR . '/modules/tradiem/config.txt' );
$ext = explode ( '|', $data );
$script ='
	<script type="text/javascript">
	$("#button_submit").click(function(){
		$("#result").html("<img src=\''.NV_BASE_SITEURL.'images/load_bar.gif\'/>");
		var code = $("#keyword").val();
		if (code==""){
			alert("Hãy nhập tên hoặc mã học sinh cần tra cứu");
			$("#keyword").focus();
			return false;
		}
		var hkid = $("#hkid").val();
		if (hkid==0){
			alert("Hãy chọn học kì cần tra");
			$("#hkid").focus();
			return false;
		}
		var namid = $("#namid").val();
		if (namid==0){
			alert("Hãy chọn năm học cần tra");
			$("#namid").focus();
			return false;
		}
		$.ajax({	
			type: "POST",
			url: "' . NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=main",
			data: "code="+ code +"&hkid="+ hkid +"&namid="+ namid +"&findtype="+ findtype
		});
	});
	</script>';
//Loc danh sach nam hoc
$sql = "SELECT * FROM " . NV_PREFIXLANG . "_" . $module_data . "_namhoc ORDER BY manamhoc ASC";
$result = $db->query( $sql );
$namhoc = array();
while ($row = $result->fetch())
{
    $namhoc[]=$row;
}
if ($hkid > 0 and $code != ""){
	$content = array();
	if ($findtype == 1){
		$sql = "SELECT DISTINCT * FROM " . NV_PREFIXLANG . "_" . $module_data . "_dshs WHERE (hoten LIKE '%$code' AND manamhoc = '$namid')";
		$result = $db->query( $sql );
	}elseif ($findtype == 2){
		$sql = "SELECT DISTINCT * FROM " . NV_PREFIXLANG . "_" . $module_data . "_dshs WHERE (mahs LIKE '$code%'  AND manamhoc = '$namid')";
		$result = $db->query( $sql );
	}
	$num = $result->rowCount();
	while ($rows = $result->fetch())
	{
    	$content[] = $rows;
	}
	// Neu khong co trong danh sach hoc sinh
	if ($num == 0){
		$contents = theme_main( $namhoc, $ext, $script);
	} elseif ($num == 1){
		// Ma hoc sinh
		$mahs = $content[0]['mahs'];
		$lopid = $content[0]['lopid'];
		$lophoc = array();
		// Loc danh sach cac lop hoc
		$sql = "SELECT DISTINCT * FROM " . NV_PREFIXLANG . "_" . $module_data . "_lop";
		$result = $db->query( $sql );
		while ($rows = $result->fetch())
		{
	    	$lophoc[$rows['lopid']] = $rows['tenlop'];
		}
		// Loc danh sach mon hoc
		$sql = "SELECT DISTINCT * FROM " . NV_PREFIXLANG . "_" . $module_data . "_monhoc";
		$result = $db->query( $sql );
		$monhoc = array();
		while ($rows = $result->fetch())
		{
	    	$monhoc[$rows['monid']] = $rows['tenmon'];
		}
		// Loc danh sach nam hoc
		$sql = "SELECT DISTINCT * FROM " . NV_PREFIXLANG . "_" . $module_data . "_namhoc";
		$result = $db->query( $sql );
		$namhoc = array();
		while ($rows = $result->fetch())
		{
	    	$namhoc[$rows['manamhoc']] = $rows['tennamhoc'];
		}
		// Loc xep loai cua hoc sinh
		$sql = "SELECT DISTINCT * FROM " . NV_PREFIXLANG . "_" . $module_data . "_xeploai WHERE mahs = '$mahs' AND mahocky = '$hkid'";
		$result = $db->query( $sql );
		$xeploai = array();
		while ($rows = $result->fetch())
		{
	    	$xeploai[] = $rows;
		}

		if ($hkid < 3){
		// Loc diem cua hoc sinh
		$diemmh = array();
		$sql = "SELECT DISTINCT * FROM " . NV_PREFIXLANG . "_" . $module_data . "_diem WHERE mahs = '$mahs' AND manamhoc = '$namid' AND mahocky = '$hkid' AND lopid = '$lopid' ORDER BY monid ASC";
		$result = $db->query( $sql );
		while ($rows = $result->fetch())
		{
	    	$diemmh[] = $rows;
		}
		$contents = viewhk($content, $diemmh, $lophoc, $monhoc, $namhoc, $xeploai, $ext);
		// Neu tra cuu ket qua ca nam
		}elseif ($hkid == 3){
			$diemtb = array();
			// Loc diem trung binh cua cac mon
			$sql = "SELECT mahocky,monid,tbm FROM " . NV_PREFIXLANG . "_" . $module_data . "_diem WHERE mahs = '$mahs' AND manamhoc = '$namid'";
			$result = $db->query( $sql );
			while ($rows = $result->fetch())
			{
		    	$diemtb[$rows['mahocky']][$rows['monid']] = $rows['tbm'];
			}
			// Loc xep loai cua hoc sinh
			$sql = "SELECT DISTINCT * FROM " . NV_PREFIXLANG . "_" . $module_data . "_xeploai WHERE mahs = '$mahs' AND manamhoc = '$namid' ORDER BY mahocky ASC";
			$result = $db->query( $sql );
			$xeploaicn = array();
			while ($rows = $result->fetch())
			{
		    	$xeploaicn[$rows['manamhoc']] = $rows;
			}
			$contents = maincn($content, $diemtb, $xeploaicn, $lophoc, $monhoc, $namhoc, $ext);
		}
	} elseif ($num > 1){
		// Neu nhieu hon mot ket qua tra ve
		// Loc danh sach cac lop hoc
		$sql = "SELECT * FROM " . NV_PREFIXLANG . "_" . $module_data . "_lop";
		$result = $db->query( $sql );
		$lophoc = array();
		while ($rows = $result->fetch())
		{
	    	$lophoc[$rows[0]] = $rows[1];
		}
		$contents = mains($content, $lophoc, $namhoc, $ext, $script, $kqsearch);
	}
}else {
	$contents = theme_main( $namhoc, $ext, $script);
}
include ( NV_ROOTDIR . "/includes/header.php" );
echo nv_site_theme( $contents );
include ( NV_ROOTDIR . "/includes/footer.php" );
