<?php
/**
 * @Author GaNguCay (gangucay@gmail.com)
 * @createdate 05/09/2010
 */
if (! defined ( 'NV_IS_FILE_ADMIN' ))
	die ( 'Stop!!!' );
$page_title = $lang_module ['import'];
if ($nv_Request->isset_request ( 'import1', 'post' )) {
	$lopid = $nv_Request->get_int ( 'lopid', 'post' );
	$manamhoc = $nv_Request->get_int ( 'manamhoc', 'post' );
	$data = array ();
	if ($_FILES ['ufile1'] ['tmp_name'] and $lopid > 0 and $manamhoc > 0) {
		$doc = new DOMDocument ();
		$doc->load ( $_FILES ['ufile1'] ['tmp_name'] );
		$rows = $doc->getElementsByTagName ( 'Row' );
		$tde = array ();
		$line = 0;
		$them = 0;
		$sua = 0;
		foreach ( $rows as $row ) {
			$cells = $row->getElementsByTagName ( 'Cell' );
			$datarow = array ();
			foreach ( $cells as $cell ) {
				if ($line == 0) {
					$tde [] = $cell->nodeValue;
				} else {
					$datarow [] = $cell->nodeValue;
				}
			}
			$data [] = $datarow;
			$line = $line + 1;
		}
		//
		foreach ( $data as $row ) {
			$dscb = array ();
			$i = 0;
			if (isset ( $row [0] )) {
				foreach ( $row as $item ) {
					// chen vo CSDL
					$dscb [$i] = $item;
					$i = $i + 1;
				}
				
				if ($dscb [0] != "" and $dscb [1] != "" and $dscb [2] != "") {
					$sql = "SELECT * FROM " . NV_PREFIXLANG . "_" . $module_data . "_dshs WHERE mahs='" . $dscb [0] . "'";
					$result = $db->query ( $sql );
					$numrows = $result->rowCount ();
					if (! $numrows) {
						if (! empty ( $dscb [3] ) && preg_match ( "/^([0-9]{1,2})\.([0-9]{1,2})\.([0-9]{4})$/", $dscb [3], $m )) {
							$ngaysinh = mktime ( 0, 0, 0, $m [2], $m [1], $m [3] );
						} else {
							$ngaysinh = NV_CURRENTTIME;
						}
						$sql1 = "INSERT INTO " . NV_PREFIXLANG . "_" . $module_data . "_dshs (mahs, manamhoc, lopid, hoten, phai, ngaysinh, noisinh) VALUES (" . $db->quote ( $dscb [0] ) . ", " . $db->quote ( $manamhoc ) . ", " . $db->quote ( $lopid ) . ", " . $db->quote ( $dscb [1] ) . ", " . $db->quote ( $dscb [2] ) . ", " . $db->quote ( $ngaysinh ) . ", " . $db->quote ( $dscb [4] ) . ")";
						$result = $db->query ( $sql1 ) or die ( 'Đã có lỗi xảy ra trong quá trình thêm mới danh sách học sinh.<br />' . $sql2 );
						$them = $them + 1;
					} else {
						if (! empty ( $dscb [3] ) && preg_match ( "/^([0-9]{1,2})\.([0-9]{1,2})\.([0-9]{4})$/", $dscb [3], $m )) {
							$ngaysinh = mktime ( 0, 0, 0, $m [2], $m [1], $m [3] );
						} else {
							$ngaysinh = NV_CURRENTTIME;
						}
						$sql2 = "UPDATE " . NV_PREFIXLANG . "_" . $module_data . "_dshs SET hoten=" . $db->quote ( $dscb [1] ) . ", phai=" . $db->quote ( $dscb [2] ) . ", ngaysinh=" . $db->quote ( $ngaysinh ) . ", noisinh=" . $db->quote ( $dscb [4] ) . " WHERE mahs=" . $db->quote ( $dscb [0] ) . "";
						$db->query ( $sql2 ) or die ( 'Đã có lỗi xảy ra trong quá trình cập nhật CSDL học sinh.<br />' . $sql2 );
						$sua = $sua + 1;
					}
				}
			}
		}
		$line = $line - 1;
		// Hien thi thong bao sau khi import
		$contents .= "<div class=\"quote\" style=\"width:780px;\">\n";
		$contents .= "<blockquote class=\"error\"><span>" . $lang_module ['import_success'] . "</span></blockquote>\n";
		$contents .= "</div><br>";
		$contents .= "<div class=\"clear\"></div>\n";
		$contents .= "<div id=\"list_mods\"
	<form id=\"form\" name=\"form\" method=\"post\">
	<table class=\"table\">
	<tr>
		<td class=\"fr\">" . $lang_module ['line'] . "" . $line . "<br></td>
	</tr>
	<tr>
		<td class=\"fr\">" . $lang_module ['them'] . "" . $them . "<br></td>
	</tr>
	<tr>
		<td class=\"fr\">" . $lang_module ['sua'] . "" . $sua . "<br></td>
	</tr>
	</table>
	</form></div>";
	}
} else if ($nv_Request->isset_request ( 'import2', 'post' )) {
	$data = array ();
	$lopid = $nv_Request->get_int ( 'lopid', 'post' );
	$manamhoc = $nv_Request->get_int ( 'manamhoc', 'post' );
	$monid = $nv_Request->get_int ( 'monid', 'post' );
	$mahocky = $nv_Request->get_int ( 'mahocky', 'post' );
	if ($_FILES ['ufile2'] ['tmp_name'] and $lopid > 0 and $manamhoc > 0 and $monid > 0 and $mahocky > 0) {
		$doc = new DOMDocument ();
		$doc->load ( $_FILES ['ufile2'] ['tmp_name'] );
		$rows = $doc->getElementsByTagName ( 'Row' );
		$tde = array ();
		$line = 0;
		$them = 0;
		$sua = 0;
		foreach ( $rows as $row ) {
			$cells = $row->getElementsByTagName ( 'Cell' );
			$datarow = array ();
			foreach ( $cells as $cell ) {
				if ($line == 0) {
					$tde [] = $cell->nodeValue;
				} else {
					$datarow [] = $cell->nodeValue;
				}
			}
			$data [] = $datarow;
			$line = $line + 1;
		}
		//
		foreach ( $data as $row ) {
			$dscb = array ();
			$i = 0;
			if (isset ( $row [0] )) {
				foreach ( $row as $item ) {
					// chen vo CSDL
					$dscb [$i] = $item;
					$i = $i + 1;
				}
				if ($dscb [0] != "") {
					$sql = "SELECT * FROM " . NV_PREFIXLANG . "_" . $module_data . "_diem WHERE mahs='" . $dscb [0] . "' AND lopid = '" . $lopid . "' AND monid = '" . $monid . "' AND manamhoc = '" . $manamhoc . "' AND mahocky = '" . $mahocky . "'";
					$result = $db->query ( $sql );
					$numrows = $result->rowCount ();
					if (! $numrows) {
						$sql1 = "INSERT INTO " . NV_PREFIXLANG . "_" . $module_data . "_diem ( mahs ,lopid, manamhoc, mahocky, monid, 15_1 ,15_2 ,15_3 ,15_4 ,15_5 ,15_6 ,15_7,15_8 ,15_9 ,45_1 ,45_2 ,45_3 ,45_4 ,45_5 ,45_6 ,45_7 ,thi ,tbm) VALUES (" . $db->quote ( $dscb [0] ) . ", " . $db->quote ( $lopid ) . ", " . $db->quote ( $manamhoc ) . ", " . $db->quote ( $mahocky ) . ", " . $db->quote ( $monid ) . ", " . $db->quote ( $dscb [1] ) . ", " . $db->quote ( $dscb [2] ) . ", " . $db->quote ( $dscb [3] ) . ", " . $db->quote ( $dscb [4] ) . ", " . $db->quote ( $dscb [5] ) . ", " . $db->quote ( $dscb [6] ) . ", " . $db->quote ( $dscb [7] ) . ", " . $db->quote ( $dscb [8] ) . ", " . $db->quote ( $dscb [9] ) . ", " . $db->quote ( $dscb [10] ) . ", " . $db->quote ( $dscb [11] ) . ", " . $db->quote ( $dscb [12] ) . ", " . $db->quote ( $dscb [13] ) . ", " . $db->quote ( $dscb [14] ) . ", " . $db->quote ( $dscb [15] ) . ", " . $db->quote ( $dscb [16] ) . ", " . $db->quote ( $dscb [17] ) . ", " . $db->quote ( $dscb [18] ) . ")";
						$result = $db->query ( $sql1 ) or die ( 'Đã có lỗi xảy ra trong quá trình thêm mới vào CSDL điểm học sinh.<br />' . $sql1 );
						$them = $them + 1;
					} else {
						$sql2 = "UPDATE " . NV_PREFIXLANG . "_" . $module_data . "_diem SET 15_1=" . $db->quote ( $dscb [1] ) . ", 15_2=" . $db->quote ( $dscb [2] ) . ", 15_3=" . $db->quote ( $dscb [3] ) . ", 15_4=" . $db->quote ( $dscb [4] ) . ", 15_5=" . $db->quote ( $dscb [5] ) . ", 15_6=" . $db->quote ( $dscb [6] ) . ", 15_7=" . $db->quote ( $dscb [7] ) . ", 15_8=" . $db->quote ( $dscb [8] ) . ", 15_9=" . $db->quote ( $dscb [9] ) . ", 45_1=" . $db->quote ( $dscb [10] ) . ", 45_2='" . $dscb[11] . "', 45_3=" . $db->quote ( $dscb [12] ) . ", 45_4=" . $db->quote ( $dscb [13] ) . ", 45_5=" . $db->quote ( $dscb [14] ) . ", 45_6=" . $db->quote ( $dscb [15] ) . ", 45_7=" . $db->quote ( $dscb [16] ) . ", thi=" . $db->quote ( $dscb [17] ) . ", tbm=" . $db->quote ( $dscb [18] ) . " WHERE mahs=" . $db->quote ( $dscb [0] ) . "";
						$db->query ( $sql2 ) or die ( 'Đã có lỗi xảy ra trong quá trình cập nhật vào CSDL điểm của học sinh.<br />' . $sql2 );
						$sua = $sua + 1;
					}
				}
			}
		}
		$line = $line - 1;
		// Hien thi thong bao sau khi import
		$contents .= "<div class=\"quote\" style=\"width:780px;\">\n";
		$contents .= "<blockquote class=\"error\"><span>" . $lang_module ['import_success'] . "</span></blockquote>\n";
		$contents .= "</div><br>";
		$contents .= "<div class=\"clear\"></div>\n";
		$contents .= "<div id=\"list_mods\"
	<form id=\"form\" name=\"form\" method=\"post\">
	<table class=\"table\">
	<tr>
		<td class=\"fr\">" . $lang_module ['line'] . "" . $line . "<br></td>
	</tr>
	<tr>
		<td class=\"fr\">" . $lang_module ['them'] . "" . $them . "<br></td>
	</tr>
	<tr>
		<td class=\"fr\">" . $lang_module ['sua'] . "" . $sua . "<br></td>
	</tr>
	</table>
	</form></div>";
	}
} else if ($nv_Request->isset_request ( 'import3', 'post' )) {
	$data = array ();
	$lopid = $nv_Request->get_int ( 'lopid', 'post' );
	$manamhoc = $nv_Request->get_int ( 'manamhoc', 'post' );
	$mahocky = $nv_Request->get_int ( 'mahocky', 'post' );
	if ($_FILES ['ufile3'] ['tmp_name'] and $lopid > 0 and $manamhoc > 0 and $mahocky > 0) {
		$doc = new DOMDocument ();
		$doc->load ( $_FILES ['ufile3'] ['tmp_name'] );
		$rows = $doc->getElementsByTagName ( 'Row' );
		$tde = array ();
		$line = 0;
		$them = 0;
		$sua = 0;
		foreach ( $rows as $row ) {
			$cells = $row->getElementsByTagName ( 'Cell' );
			$datarow = array ();
			foreach ( $cells as $cell ) {
				if ($line == 0) {
					$tde [] = $cell->nodeValue;
				} else {
					$datarow [] = $cell->nodeValue;
				}
			}
			$data [] = $datarow;
			$line = $line + 1;
		}
		//
		foreach ( $data as $row ) {
			$dscb = array ();
			$i = 0;
			if (isset ( $row [0] )) {
				foreach ( $row as $item ) {
					// chen vo CSDL
					$dscb [$i] = $item;
					$i = $i + 1;
				}
				if ($dscb [0] != "") {
					$sql = "SELECT * FROM " . NV_PREFIXLANG . "_" . $module_data . "_xeploai WHERE mahs='" . $dscb [0] . "' AND lopid = '" . $lopid . "' AND manamhoc = '" . $manamhoc . "' AND mahocky = '" . $mahocky . "'";
					$result = $db->query ( $sql );
					$numrows = $result->rowCount ();
					if (! $numrows) {
						$sql1 = "INSERT INTO " . NV_PREFIXLANG . "_" . $module_data . "_xeploai ( mahs ,lopid, manamhoc, mahocky, tbm ,hl ,hk ,snncp ,snnkp ,danhhieu ,nxgvcn) VALUES (" . $db->quote ( $dscb [0] ) . ", " . $db->quote ( $lopid ) . ", " . $db->quote ( $manamhoc ) . ", " . $db->quote ( $mahocky ) . ", " . $db->quote ( $dscb [1] ) . ", " . $db->quote ( $dscb [2] ) . ", " . $db->quote ( $dscb [3] ) . ", " . $db->quote ( $dscb [4] ) . ", " . $db->quote ( $dscb [5] ) . ", " . $db->quote ( $dscb [6] ) . ", " . $db->quote ( $dscb [7] ) . ")";
						$result = $db->query ( $sql1 ) or die ( 'Đã có lỗi xảy ra trong quá trình thêm mới vào CSDL xếp loại học sinh.<br />' . $sql1 );
						$them = $them + 1;
					} else {
						$sql2 = "UPDATE " . NV_PREFIXLANG . "_" . $module_data . "_xeploai SET tbm=" . $db->quote ( $dscb [1] ) . ", hl=" . $db->quote ( $dscb [2] ) . ", hk=" . $db->quote ( $dscb [3] ) . ", snncp=" . $db->quote ( $dscb [4] ) . ", snnkp=" . $db->quote ( $dscb [5] ) . ", danhhieu=" . $db->quote ( $dscb [6] ) . ", nxgvcn=" . $db->quote ( $dscb [7] ) . " WHERE mahs=" . $db->quote ( $dscb [0] ) . "";
						$db->query ( $sql2 ) or die ( 'Đã có lỗi xảy ra trong quá trình cập nhật vào CSDL xếp loại của học sinh.<br />' . $sql2 );
						$sua = $sua + 1;
					}
				}
			}
		}
		$line = $line - 1;
		// Hien thi thong bao sau khi import
		$contents .= "<div class=\"quote\" style=\"width:780px;\">\n";
		$contents .= "<blockquote class=\"error\"><span>" . $lang_module ['import_success'] . "</span></blockquote>\n";
		$contents .= "</div><br>";
		$contents .= "<div class=\"clear\"></div>\n";
		$contents .= "<div id=\"list_mods\"
	<form id=\"form\" name=\"form\" method=\"post\">
	<table class=\"table\">
	<tr>
		<td class=\"fr\">" . $lang_module ['line'] . "" . $line . "<br></td>
	</tr>
	<tr>
		<td class=\"fr\">" . $lang_module ['them'] . "" . $them . "<br></td>
	</tr>
	<tr>
		<td class=\"fr\">" . $lang_module ['sua'] . "" . $sua . "<br></td>
	</tr>
	</table>
	</form></div>";
	}
} else if ($nv_Request->isset_request ( 'import4', 'post' )) {
	$data = array ();
	if ($_FILES ['ufile4'] ['tmp_name']) {
		$doc = new DOMDocument ();
		$doc->load ( $_FILES ['ufile4'] ['tmp_name'] );
		$rows = $doc->getElementsByTagName ( 'Row' );
		$tde = array ();
		$line = 0;
		$them = 0;
		$sua = 0;
		foreach ( $rows as $row ) {
			$cells = $row->getElementsByTagName ( 'Cell' );
			$datarow = array ();
			foreach ( $cells as $cell ) {
				if ($line == 0) {
					$tde [] = $cell->nodeValue;
				} else {
					$datarow [] = $cell->nodeValue;
				}
			}
			$data [] = $datarow;
			$line = $line + 1;
		}
		//
		foreach ( $data as $row ) {
			$dscb = array ();
			$i = 0;
			if (isset ( $row [0] )) {
				foreach ( $row as $item ) {
					// chen vo CSDL
					$dscb [$i] = $item;
					$i = $i + 1;
				}
				if ($dscb [0] != "") {
					$sql = "SELECT * FROM " . NV_PREFIXLANG . "_" . $module_data . "_dsgv WHERE gvid='" . $dscb [0] . "'";
					$result = $db->query ( $sql );
					$numrows = $result->rowCount ();
					if (! $numrows) {
						$sql1 = "INSERT INTO " . NV_PREFIXLANG . "_" . $module_data . "_dsgv ( gvid ,tengv, user, log, chunhiem ,active ) VALUES (" . $db->quote ( $dscb [0] ) . ", " . $db->quote ( $dscb [1] ) . ", " . $db->quote ( $dscb [2] ) . ", " . $db->quote ( $dscb [3] ) . ", " . $db->quote ( $dscb [4] ) . ", " . $db->quote ( $dscb [5] ) . ")";
						$result = $db->query ( $sql1 ) or die ( 'Đã có lỗi xảy ra trong quá trình thêm mới giáo viên.<br />' . $sql1 );
						$them = $them + 1;
					} else {
						$sql2 = "UPDATE " . NV_PREFIXLANG . "_" . $module_data . "_dsgv SET tengv=" . $db->quote ( $dscb [1] ) . ", user=" . $db->quote ( $dscb [2] ) . ", log=" . $db->quote ( $dscb [3] ) . ", chunhiem=" . $db->quote ( $dscb [4] ) . ", active=" . $db->quote ( $dscb [5] ) . " WHERE gvid=" . $db->quote ( $dscb [0] ) . "";
						$db->query ( $sql2 ) or die ( 'Đã có lỗi xảy ra trong quá trình cập nhật giáo viên.<br />' . $sql2 );
						$sua = $sua + 1;
					}
				}
			}
		}
		$line = $line - 1;
		// Hien thi thong bao sau khi import
		$contents .= "<div class=\"quote\" style=\"width:780px;\">\n";
		$contents .= "<blockquote class=\"error\"><span>" . $lang_module ['import_success'] . "</span></blockquote>\n";
		$contents .= "</div><br>";
		$contents .= "<div class=\"clear\"></div>\n";
		$contents .= "<div id=\"list_mods\"
	<form id=\"form\" name=\"form\" method=\"post\">
	<table class=\"table\">
	<tr>
		<td class=\"fr\">" . $lang_module ['line'] . "" . $line . "<br></td>
	</tr>
	<tr>
		<td class=\"fr\">" . $lang_module ['them'] . "" . $them . "<br></td>
	</tr>
	<tr>
		<td class=\"fr\">" . $lang_module ['sua'] . "" . $sua . "<br></td>
	</tr>
	</table>
	</form></div>";
	}
} else if ($nv_Request->isset_request ( 'import5', 'post' )) {
	$data = array ();
	$manamhoc = $nv_Request->get_int ( 'manamhoc', 'post' );
	$mahocky = $nv_Request->get_int ( 'mahocky', 'post' );
	if ($_FILES ['ufile5'] ['tmp_name'] and $manamhoc > 0 and $mahocky > 0) {
		$doc = new DOMDocument ();
		$doc->load ( $_FILES ['ufile5'] ['tmp_name'] );
		$rows = $doc->getElementsByTagName ( 'Row' );
		$tde = array ();
		$line = 0;
		$them = 0;
		$sua = 0;
		foreach ( $rows as $row ) {
			$cells = $row->getElementsByTagName ( 'Cell' );
			$datarow = array ();
			foreach ( $cells as $cell ) {
				if ($line == 0) {
					$tde [] = $cell->nodeValue;
				} else {
					$datarow [] = $cell->nodeValue;
				}
			}
			$data [] = $datarow;
			$line = $line + 1;
		}
		//
		foreach ( $data as $row ) {
			$dscb = array ();
			$i = 0;
			if (isset ( $row [0] )) {
				foreach ( $row as $item ) {
					// chen vo CSDL
					$dscb [$i] = $item;
					$i = $i + 1;
				}
				if ($dscb [0] != "") {
					$sql = "SELECT * FROM " . NV_PREFIXLANG . "_" . $module_data . "_diem WHERE mahs='" . $dscb [0] . "' AND lopid = '" . $dscb [1] . "' AND monid = '" . $dscb [2] . "' AND manamhoc = '" . $manamhoc . "' AND mahocky = '" . $mahocky . "'";
					$result = $db->query ( $sql );
					$numrows = $result->rowCount ();
					if (! $numrows) {
						$sql1 = "INSERT INTO " . NV_PREFIXLANG . "_" . $module_data . "_diem ( mahs ,lopid, manamhoc, mahocky, monid, 15_1 ,15_2 ,15_3 ,15_4 ,15_5 ,15_6 ,15_7, 15_8 ,15_9 ,45_1 ,45_2 ,45_3 ,45_4 ,45_5, 45_6 ,45_7, thi ,tbm) VALUES (" . $db->quote ( $dscb [0] ) . ", " . $db->quote ( $dscb [1] ) . ", " . $db->quote ( $manamhoc ) . ", " . $db->quote ( $mahocky ) . ", " . $db->quote ( $dscb [2] ) . ", " . $db->quote ( $dscb [3] ) . ", " . $db->quote ( $dscb [4] ) . ", " . $db->quote ( $dscb [5] ) . ", " . $db->quote ( $dscb [6] ) . ", " . $db->quote ( $dscb [7] ) . ", " . $db->quote ( $dscb [8] ) . ", " . $db->quote ( $dscb [9] ) . ", " . $db->quote ( $dscb [10] ) . ", " . $db->quote ( $dscb [11] ) . ", " . $db->quote ( $dscb [12] ) . ", " . $db->quote ( $dscb [13] ) . ", " . $db->quote ( $dscb [14] ) . ", " . $db->quote ( $dscb [15] ) . ", " . $db->quote ( $dscb [16] ) . ", " . $db->quote ( $dscb [17] ) . ", " . $db->quote ( $dscb [18] ) . ", " . $db->quote ( $dscb [19] ) . ", " . $db->quote ( $dscb [20] ) . ")";
						$result = $db->query ( $sql1 ) or die ( 'Đã có lỗi xảy ra trong quá trình thêm mới vào CSDL điểm học sinh.<br />' . $sql1 );
						$them = $them + 1;
					} else {
						$sql2 = "UPDATE " . NV_PREFIXLANG . "_" . $module_data . "_diem SET 15_1=" . $db->quote ( $dscb [3] ) . ", 15_2=" . $db->quote ( $dscb [4] ) . ", 15_3=" . $db->quote ( $dscb [5] ) . ", 15_4=" . $db->quote ( $dscb [6] ) . ", 15_5=" . $db->quote ( $dscb [7] ) . ", 15_6=" . $db->quote ( $dscb [8] ) . ", 15_7=" . $db->quote ( $dscb [9] ) . ", 15_8=" . $db->quote ( $dscb [10] ) . ", 15_9=" . $db->quote ( $dscb [11] ) . ", 45_1=" . $db->quote ( $dscb [12] ) . ", 45_2=" . $db->quote ( $dscb [13] ) . ", 45_3=" . $db->quote ( $dscb [14] ) . ", 45_4=" . $db->quote ( $dscb [15] ) . ", 45_5=" . $db->quote ( $dscb [16] ) . ", 45_6=" . $db->quote ( $dscb [17] ) . ", 45_7=" . $db->quote ( $dscb [18] ) . ", thi=" . $db->quote ( $dscb [19] ) . ", tbm=" . $db->quote ( $dscb [20] ) . " WHERE mahs=" . $db->quote ( $dscb [0] ) . "";
						$db->query ( $sql2 ) or die ( 'Đã có lỗi xảy ra trong quá trình cập nhật vào CSDL điểm của học sinh.<br />' . $sql2 );
						$sua = $sua + 1;
					}
				}
			}
		}
		$line = $line - 1;
		// Hien thi thong bao sau khi import
		$contents .= "<div class=\"quote\" style=\"width:780px;\">\n";
		$contents .= "<blockquote class=\"error\"><span>" . $lang_module ['import_success'] . "</span></blockquote>\n";
		$contents .= "</div><br>";
		$contents .= "<div class=\"clear\"></div>\n";
		$contents .= "<div id=\"list_mods\"
	<form id=\"form\" name=\"form\" method=\"post\">
	<table class=\"table\">
	<tr>
		<td class=\"fr\">" . $lang_module ['line'] . "" . $line . "<br></td>
	</tr>
	<tr>
		<td class=\"fr\">" . $lang_module ['them'] . "" . $them . "<br></td>
	</tr>
	<tr>
		<td class=\"fr\">" . $lang_module ['sua'] . "" . $sua . "<br></td>
	</tr>
	</table>
	</form></div>";
	}
} else if ($nv_Request->isset_request ( 'import6', 'post' )) {
	$data = array ();
	$manamhoc = $nv_Request->get_int ( 'manamhoc', 'post' );
	if ($_FILES ['ufile6'] ['tmp_name'] and $manamhoc > 0) {
		$doc = new DOMDocument ();
		$doc->load ( $_FILES ['ufile6'] ['tmp_name'] );
		$rows = $doc->getElementsByTagName ( 'Row' );
		$tde = array ();
		$line = 0;
		$them = 0;
		$sua = 0;
		foreach ( $rows as $row ) {
			$cells = $row->getElementsByTagName ( 'Cell' );
			$datarow = array ();
			foreach ( $cells as $cell ) {
				if ($line == 0) {
					$tde [] = $cell->nodeValue;
				} else {
					$datarow [] = $cell->nodeValue;
				}
			}
			$data [] = $datarow;
			$line = $line + 1;
		}
		//
		foreach ( $data as $row ) {
			$dscb = array ();
			$i = 0;
			if (isset ( $row [0] )) {
				foreach ( $row as $item ) {
					// chen vo CSDL
					$dscb [$i] = $item;
					$i = $i + 1;
				}
				if ($dscb [0] != "") {
					$sql = "SELECT * FROM " . NV_PREFIXLANG . "_" . $module_data . "_diem WHERE mahs='" . $dscb [0] . "' AND lopid = '" . $dscb [1] . "' AND mahocky = '" . $dscb [2] . "' AND monid = '" . $dscb [3] . "' AND manamhoc = '" . $manamhoc . "'";
					$result = $db->query ( $sql );
					$numrows = $result->rowCount ();
					if (! $numrows) {
						$sql1 = "INSERT INTO " . NV_PREFIXLANG . "_" . $module_data . "_diem ( mahs ,lopid, manamhoc, mahocky, monid, 15_1 ,15_2 ,15_3 ,15_4 ,15_5 ,15_6 ,15_7 ,15_8 ,15_9 ,45_1 ,45_2 ,45_3 ,45_4 ,45_5,45_6 ,45_7 ,thi ,tbm) VALUES (" . $db->quote ( $dscb [0] ) . ", " . $db->quote ( $dscb [1] ) . ", " . $db->quote ( $manamhoc ) . ", " . $db->quote ( $dscb [2] ) . ", " . $db->quote ( $dscb [3] ) . ", " . $db->quote ( $dscb [4] ) . ", " . $db->quote ( $dscb [5] ) . ", " . $db->quote ( $dscb [6] ) . ", " . $db->quote ( $dscb [7] ) . ", " . $db->quote ( $dscb [8] ) . ", " . $db->quote ( $dscb [9] ) . ", " . $db->quote ( $dscb [10] ) . ", " . $db->quote ( $dscb [11] ) . ", " . $db->quote ( $dscb [12] ) . ", " . $db->quote ( $dscb [13] ) . ", " . $db->quote ( $dscb [14] ) . ", " . $db->quote ( $dscb [15] ) . ", " . $db->quote ( $dscb [16] ) . ", " . $db->quote ( $dscb [17] ) . ", " . $db->quote ( $dscb [18] ) . ", " . $db->quote ( $dscb [19] ) . ", " . $db->quote ( $dscb [20] ) . ", " . $db->quote ( $dscb [21] ) . ")";
						$result = $db->query ( $sql1 ) or die ( 'Đã có lỗi xảy ra trong quá trình thêm mới vào CSDL điểm học sinh.<br />' . $sql1 );
						$them = $them + 1;
					} else {
						$sql2 = "UPDATE " . NV_PREFIXLANG . "_" . $module_data . "_diem SET 15_1=" . $db->quote ( $dscb [4] ) . ", 15_2=" . $db->quote ( $dscb [5] ) . ", 15_3=" . $db->quote ( $dscb [6] ) . ", 15_4=" . $db->quote ( $dscb [7] ) . ", 15_5=" . $db->quote ( $dscb [8] ) . ", 15_6=" . $db->quote ( $dscb [9] ) . ", 15_7=" . $db->quote ( $dscb [10] ) . ", 15_8=" . $db->quote ( $dscb [11] ) . ", 15_9=" . $db->quote ( $dscb [12] ) . ", 45_1=" . $db->quote ( $dscb [13] ) . ", 45_2=" . $db->quote ( $dscb [14] ) . ", 45_3=" . $db->quote ( $dscb [15] ) . ", 45_4=" . $db->quote ( $dscb [16] ) . ", 45_5=" . $db->quote ( $dscb [17] ) . ", 45_6=" . $db->quote ( $dscb [18] ) . ", 45_7=" . $db->quote ( $dscb [19] ) . ", thi=" . $db->quote ( $dscb [20] ) . ", tbm=" . $db->quote ( $dscb [21] ) . " WHERE mahs=" . $db->quote ( $dscb [0] ) . "";
						$db->query ( $sql2 ) or die ( 'Đã có lỗi xảy ra trong quá trình cập nhật vào CSDL điểm của học sinh.<br />' . $sql2 );
						$sua = $sua + 1;
					}
				}
			}
		}
		$line = $line - 1;
		// Hien thi thong bao sau khi import
		$contents .= "<div class=\"quote\" style=\"width:780px;\">\n";
		$contents .= "<blockquote class=\"error\"><span>" . $lang_module ['import_success'] . "</span></blockquote>\n";
		$contents .= "</div><br>";
		$contents .= "<div class=\"clear\"></div>\n";
		$contents .= "<div id=\"list_mods\"
	<form id=\"form\" name=\"form\" method=\"post\">
	<table class=\"table\">
	<tr>
		<td class=\"fr\">" . $lang_module ['line'] . "" . $line . "<br></td>
	</tr>
	<tr>
		<td class=\"fr\">" . $lang_module ['them'] . "" . $them . "<br></td>
	</tr>
	<tr>
		<td class=\"fr\">" . $lang_module ['sua'] . "" . $sua . "<br></td>
	</tr>
	</table>
	</form></div>";
	}
} else if ($nv_Request->isset_request ( 'import7', 'post' )) {
	$data = array ();
	$manamhoc = $nv_Request->get_int ( 'manamhoc', 'post' );
	$mahocky = $nv_Request->get_int ( 'mahocky', 'post' );
	if ($_FILES ['ufile7'] ['tmp_name'] and $manamhoc > 0 and $mahocky > 0) {
		$doc = new DOMDocument ();
		$doc->load ( $_FILES ['ufile7'] ['tmp_name'] );
		$rows = $doc->getElementsByTagName ( 'Row' );
		$tde = array ();
		$line = 0;
		$them = 0;
		$sua = 0;
		foreach ( $rows as $row ) {
			$cells = $row->getElementsByTagName ( 'Cell' );
			$datarow = array ();
			foreach ( $cells as $cell ) {
				if ($line == 0) {
					$tde [] = $cell->nodeValue;
				} else {
					$datarow [] = $cell->nodeValue;
				}
			}
			$data [] = $datarow;
			$line = $line + 1;
		}
		//
		foreach ( $data as $row ) {
			$dscb = array ();
			$i = 0;
			if (isset ( $row [0] )) {
				foreach ( $row as $item ) {
					// chen vo CSDL
					$dscb [$i] = $item;
					$i = $i + 1;
				}
				if ($dscb [0] != "") {
					$sql = "SELECT * FROM " . NV_PREFIXLANG . "_" . $module_data . "_xeploai WHERE mahs='" . $dscb [0] . "' AND lopid = '" . $dscb [1] . "' AND manamhoc = '" . $manamhoc . "' AND mahocky = '" . $mahocky . "'";
					$result = $db->query ( $sql );
					$numrows = $result->rowCount ();
					if (! $numrows) {
						$sql1 = "INSERT INTO " . NV_PREFIXLANG . "_" . $module_data . "_xeploai ( mahs ,lopid, manamhoc, mahocky, tbm ,hl ,hk ,snncp ,snnkp ,danhhieu ,nxgvcn) VALUES (" . $db->quote ( $dscb [0] ) . ", " . $db->quote ( $dscb [1] ) . ", " . $db->quote ( $manamhoc ) . ", " . $db->quote ( $mahocky ) . ", " . $db->quote ( $dscb [2] ) . ", " . $db->quote ( $dscb [3] ) . ", " . $db->quote ( $dscb [4] ) . ", " . $db->quote ( $dscb [5] ) . ", " . $db->quote ( $dscb [6] ) . ", " . $db->quote ( $dscb [7] ) . ", " . $db->quote ( $dscb [8] ) . ")";
						$result = $db->query ( $sql1 ) or die ( 'Đã có lỗi xảy ra trong quá trình thêm mới vào CSDL xếp loại học sinh.<br />' . $sql1 );
						$them = $them + 1;
					} else {
						$sql2 = "UPDATE " . NV_PREFIXLANG . "_" . $module_data . "_xeploai SET tbm=" . $db->quote ( $dscb [2] ) . ", hl=" . $db->quote ( $dscb [3] ) . ", hk=" . $db->quote ( $dscb [4] ) . ", snncp=" . $db->quote ( $dscb [5] ) . ", snnkp=" . $db->quote ( $dscb [6] ) . ", danhhieu=" . $db->quote ( $dscb [7] ) . ", nxgvcn=" . $db->quote ( $dscb [8] ) . " WHERE mahs=" . $db->quote ( $dscb [0] ) . "";
						$db->query ( $sql2 ) or die ( 'Đã có lỗi xảy ra trong quá trình cập nhật vào CSDL xếp loại của học sinh.<br />' . $sql2 );
						$sua = $sua + 1;
					}
				}
			}
		}
		$line = $line - 1;
		// Hien thi thong bao sau khi import
		$contents .= "<div class=\"quote\" style=\"width:780px;\">\n";
		$contents .= "<blockquote class=\"error\"><span>" . $lang_module ['import_success'] . "</span></blockquote>\n";
		$contents .= "</div><br>";
		$contents .= "<div class=\"clear\"></div>\n";
		$contents .= "<div id=\"list_mods\"
	<form id=\"form\" name=\"form\" method=\"post\">
	<table class=\"table\">
	<tr>
		<td class=\"fr\">" . $lang_module ['line'] . "" . $line . "<br></td>
	</tr>
	<tr>
		<td class=\"fr\">" . $lang_module ['them'] . "" . $them . "<br></td>
	</tr>
	<tr>
		<td class=\"fr\">" . $lang_module ['sua'] . "" . $sua . "<br></td>
	</tr>
	</table>
	</form></div>";
	}
} else if ($nv_Request->isset_request ( 'import8', 'post' )) {
	$data = array ();
	$manamhoc = $nv_Request->get_int ( 'manamhoc', 'post' );
	if ($_FILES ['ufile8'] ['tmp_name'] and $manamhoc > 0) {
		$doc = new DOMDocument ();
		$doc->load ( $_FILES ['ufile8'] ['tmp_name'] );
		$rows = $doc->getElementsByTagName ( 'Row' );
		$tde = array ();
		$line = 0;
		$them = 0;
		$sua = 0;
		foreach ( $rows as $row ) {
			$cells = $row->getElementsByTagName ( 'Cell' );
			$datarow = array ();
			foreach ( $cells as $cell ) {
				if ($line == 0) {
					$tde [] = $cell->nodeValue;
				} else {
					$datarow [] = $cell->nodeValue;
				}
			}
			$data [] = $datarow;
			$line = $line + 1;
		}
		//
		foreach ( $data as $row ) {
			$dscb = array ();
			$i = 0;
			if (isset ( $row [0] )) {
				foreach ( $row as $item ) {
					// chen vo CSDL
					$dscb [$i] = $item;
					$i = $i + 1;
				}
				if ($dscb [0] != "" and $dscb [1] != "") {
					$sql = "SELECT * FROM " . NV_PREFIXLANG . "_" . $module_data . "_xeploai WHERE mahs='" . $dscb [0] . "' AND lopid = '" . $dscb [1] . "' AND manamhoc = '" . $manamhoc . "' AND mahocky = '" . $dscb [2] . "'";
					$result = $db->query ( $sql );
					$numrows = $result->rowCount ();
					if (! $numrows) {
						$sql1 = "INSERT INTO " . NV_PREFIXLANG . "_" . $module_data . "_xeploai ( mahs ,lopid, manamhoc, mahocky, tbm ,hl ,hk ,snncp ,snnkp ,danhhieu ,nxgvcn) VALUES (" . $db->quote ( $dscb [0] ) . ", " . $db->quote ( $dscb [1] ) . ", " . $db->quote ( $manamhoc ) . ", " . $db->quote ( $dscb [2] ) . ", " . $db->quote ( $dscb [3] ) . ", " . $db->quote ( $dscb [4] ) . ", " . $db->quote ( $dscb [5] ) . ", " . $db->quote ( $dscb [6] ) . ", " . $db->quote ( $dscb [7] ) . ", " . $db->quote ( $dscb [8] ) . ", " . $db->quote ( $dscb [9] ) . ")";
						$result = $db->query ( $sql1 ) or die ( 'Đã có lỗi xảy ra trong quá trình thêm mới vào CSDL xếp loại học sinh.<br />' . $sql1 );
						$them = $them + 1;
					} else {
						$sql2 = "UPDATE " . NV_PREFIXLANG . "_" . $module_data . "_xeploai SET tbm=" . $db->quote ( $dscb [3] ) . ", hl=" . $db->quote ( $dscb [4] ) . ", hk=" . $db->quote ( $dscb [5] ) . ", snncp=" . $db->quote ( $dscb [6] ) . ", snnkp=" . $db->quote ( $dscb [7] ) . ", danhhieu=" . $db->quote ( $dscb [8] ) . ", nxgvcn=" . $db->quote ( $dscb [9] ) . " WHERE mahs=" . $db->quote ( $dscb [0] ) . "";
						$db->query ( $sql2 ) or die ( 'Đã có lỗi xảy ra trong quá trình cập nhật vào CSDL xếp loại của học sinh.<br />' . $sql2 );
						$sua = $sua + 1;
					}
				}
			}
		}
		$line = $line - 1;
		// Hien thi thong bao sau khi import
		$contents .= "<div class=\"quote\" style=\"width:780px;\">\n";
		$contents .= "<blockquote class=\"error\"><span>" . $lang_module ['import_success'] . "</span></blockquote>\n";
		$contents .= "</div><br>";
		$contents .= "<div class=\"clear\"></div>\n";
		$contents .= "<div id=\"list_mods\"
	<form id=\"form\" name=\"form\" method=\"post\">
	<table class=\"table\">
	<tr>
		<td class=\"fr\">" . $lang_module ['line'] . "" . $line . "<br></td>
	</tr>
	<tr>
		<td class=\"fr\">" . $lang_module ['them'] . "" . $them . "<br></td>
	</tr>
	<tr>
		<td class=\"fr\">" . $lang_module ['sua'] . "" . $sua . "<br></td>
	</tr>
	</table>
	</form></div>";
	}
} else {
	$contents .= "<table summary=\"\" class=\"table\">\n";
	$contents .= "<td><center><b><font color=blue size=3>" . $lang_module ['import_tdds'] . "</font></b></center></td>\n";
	$contents .= "</table>";
	
	$contents .= "<div><form enctype=\"multipart/form-data\" id=\"form1\" name=\"form1\" method=\"post\">
<table class=\"table\">
	<tr>
		<td class=\"fr\" width=\"220\">" . $lang_module ['import_dshs'] . "</td>
		<td class=\"fr1\">";
	// Chon lop hoc
	$contents .= "<select name = \"lopid\">
		<option value=\"0\" size = \"50\">&nbsp;Chọn lớp</option>";
	$sql = "SELECT * FROM " . NV_PREFIXLANG . "_" . $module_data . "_lop";
	$result = $db->query ( $sql );
	while ( $dslop = $result->fetch () ) {
		$contents .= '<option value="' . $dslop ['lopid'] . '">&nbsp;' . $dslop ['tenlop'] . '</option>';
	}
	$contents .= "</select>&nbsp;&nbsp;";
	// Chon nam hoc
	$contents .= "<select name = \"manamhoc\">";
	$contents .= "<option value=\"0\" size = \"50\">&nbsp;Chọn năm học</option>";
	$sql = "SELECT * FROM " . NV_PREFIXLANG . "_" . $module_data . "_namhoc";
	$result = $db->query ( $sql );
	while ( $namhoc = $result->fetch () ) {
		$contents .= '<option value="' . $namhoc ['manamhoc'] . '">&nbsp;' . $namhoc ['tennamhoc'] . '</option>';
	}
	$contents .= "</select><br />
		<input type=\"file\" name=\"ufile1\" size = \"35\" id=\"ufile1\"/>
		<input type=\"submit\" name=\"import1\" id=\"import1\" value=\"Import\" /></td>
	</tr>
	</table></center>
	</form></div>
		
	<div><form enctype=\"multipart/form-data\" id=\"form4\" name=\"form4\" method=\"post\"><center>
	<table class=\"table\">
	<tr>
		<td class=\"fr\"  width=\"220\"  align = \"left\">" . $lang_module ['impdsgv_title'] . "</td>
		<td class=\"fr1\"  align = \"left\">
		<input type=\"file\" name=\"ufile4\" size = \"35\" id=\"ufile4\"/>
		<input type=\"submit\" name=\"import4\" id=\"import4\" value=\"Import\" /></td>
	</tr>
</table>
</form></div>";
	
	$contents .= "<table summary=\"\" class=\"table\">\n";
	$contents .= "<td><center><b><font color=blue size=3>" . $lang_module ['import_tddiem'] . "</font></b></center></td>\n";
	$contents .= "</table>";
	
	$contents .= "<div><form enctype=\"multipart/form-data\" id=\"form2\" name=\"form2\" method=\"post\"><center>
	<table class=\"table\">
	<tr>
		<td class=\"fr\"  width=\"220\" align = \"left\">" . $lang_module ['import_diem'] . "</td>
		<td class=\"fr1\"  align = \"left\">";
	
	// Chon lop
	$contents .= "<select name = \"lopid\">
		<option value=\"0\" size = \"50\">&nbsp;Chọn lớp</option>";
	$sql = "SELECT * FROM " . NV_PREFIXLANG . "_" . $module_data . "_lop";
	$result = $db->query ( $sql );
	while ( $dslop = $result->fetch () ) {
		$contents .= '<option value="' . $dslop ['lopid'] . '">&nbsp;' . $dslop ['tenlop'] . '</option>';
	}
	$contents .= "</select>&nbsp;&nbsp;";
	
	// Chon mon hoc
	$contents .= "<select name = \"monid\">";
	$contents .= "<option value=\"0\" size = \"50\">&nbsp;Chọn môn học</option>";
	$sql = "SELECT * FROM " . NV_PREFIXLANG . "_" . $module_data . "_monhoc";
	$result = $db->query ( $sql );
	while ( $monhoc = $result->fetch () ) {
		$contents .= '<option value=" ' . $monhoc ['monid'] . '">&nbsp;' . $monhoc ['tenmon'] . '</option>';
	}
	$contents .= "</select>&nbsp;&nbsp;";
	
	// Chon hoc ki
	$contents .= "<select name = \"mahocky\">";
	$contents .= "<option value=\"0\" size = \"60\">&nbsp;Chọn học kì</option>";
	$hocki = array (
			1 => 'Học kì I',
			2 => 'Học kì II' 
	);
	For($i = 1; $i <= 2; $i ++) {
		$contents .= "<option value=\"$i\">&nbsp;$hocki[$i]</option>";
	}
	$contents .= "</select>&nbsp;&nbsp;";
	
	// Chon nam hoc
	$contents .= "<select name = \"manamhoc\">";
	$contents .= "<option value=\"0\" size = \"50\">&nbsp;Chọn năm học</option>";
	$sql = "SELECT * FROM " . NV_PREFIXLANG . "_" . $module_data . "_namhoc";
	$result = $db->query ( $sql );
	while ( $namhoc = $result->fetch () ) {
		$contents .= '<option value="' . $namhoc ['manamhoc'] . '">&nbsp;' . $namhoc ['tennamhoc'] . '</option>';
	}
	$contents .= "</select><br />
		<input type=\"file\" name=\"ufile2\" size = \"35\" id=\"ufile2\"/>
		<input type=\"submit\" name=\"import2\" id=\"import2\" value=\"Import\" /></td>
	</tr>
	</table></center>
	</form></div>
	
	<div><form enctype=\"multipart/form-data\" id=\"form5\" name=\"form5\" method=\"post\"><center>
	<table class=\"table\">
	<tr>
		<td class=\"fr\"  width=\"220\" align = \"left\">" . $lang_module ['import_diem2'] . "</td>
		<td class=\"fr1\"  align = \"left\">";
	// Chon hoc ki
	$contents .= "<select name = \"mahocky\">";
	$contents .= "<option value=\"0\" size = \"60\">&nbsp;Chọn học kì</option>";
	$hocki = array (
			1 => 'Học kì I',
			2 => 'Học kì II' 
	);
	For($i = 1; $i <= 2; $i ++) {
		$contents .= "<option value=\"$i\">&nbsp;$hocki[$i]</option>";
	}
	$contents .= "</select>&nbsp;&nbsp;";
	
	// Chon nam hoc
	$contents .= "<select name = \"manamhoc\">";
	$contents .= "<option value=\"0\" size = \"50\">&nbsp;Chọn năm học</option>";
	$sql = "SELECT * FROM " . NV_PREFIXLANG . "_" . $module_data . "_namhoc";
	$result = $db->query ( $sql );
	while ( $namhoc = $result->fetch () ) {
		$contents .= '<option value="' . $namhoc ['manamhoc'] . '">&nbsp;' . $namhoc ['tennamhoc'] . '</option>';
	}
	$contents .= "</select><br />
		<input type=\"file\" name=\"ufile5\" size = \"35\" id=\"ufile5\"/>
		<input type=\"submit\" name=\"import5\" id=\"import5\" value=\"Import\" /></td>
	</tr>
	</table></center>
	</form></div>
	
	<div><form enctype=\"multipart/form-data\" id=\"form6\" name=\"form6\" method=\"post\"><center>
	<table class=\"table\">
	<tr>
		<td class=\"fr\"  width=\"220\" align = \"left\">" . $lang_module ['import_diem3'] . "</td>
		<td class=\"fr1\"  align = \"left\">";
	// Chon nam hoc
	$contents .= "<select name = \"manamhoc\">";
	$contents .= "<option value=\"0\" size = \"50\">&nbsp;Chọn năm học</option>";
	$sql = "SELECT * FROM " . NV_PREFIXLANG . "_" . $module_data . "_namhoc";
	$result = $db->query ( $sql );
	while ( $namhoc = $result->fetch () ) {
		$contents .= '<option value="' . $namhoc ['manamhoc'] . '">&nbsp;' . $namhoc ['tennamhoc'] . '</option>';
	}
	$contents .= "</select><br />
		<input type=\"file\" name=\"ufile6\" size = \"35\" id=\"ufile6\"/>
		<input type=\"submit\" name=\"import6\" id=\"import6\" value=\"Import\" /></td>
	</tr>
	</table></center>
	</form></div>";
	
	$contents .= "<table summary=\"\" class=\"table\">\n";
	$contents .= "<td><center><b><font color=blue size=3>" . $lang_module ['import_tdxl'] . "</font></b></center></td>\n";
	$contents .= "</table>";
	
	$contents .= "<div><form enctype=\"multipart/form-data\" id=\"form3\" name=\"form3\" method=\"post\"><center>
	<table class=\"table\">
	<tr>
		<td class=\"fr\"  width=\"220\"  align = \"left\">" . $lang_module ['import_xeploai_lop'] . "</td>
		<td class=\"fr1\"  align = \"left\">";
	// Chon nam hoc
	$contents .= "<select name = \"lopid\">
		<option value=\"0\" size = \"50\">&nbsp;Chọn lớp</option>";
	$sql = "SELECT * FROM " . NV_PREFIXLANG . "_" . $module_data . "_lop";
	$result = $db->query ( $sql );
	while ( $dslop = $result->fetch () ) {
		$contents .= '<option value="' . $dslop ['lopid'] . '">&nbsp;' . $dslop ['tenlop'] . '</option>';
	}
	$contents .= "</select>&nbsp;&nbsp;";
	// Chon hoc ki
	$contents .= "<select name = \"mahocky\">";
	$contents .= "<option value=\"0\" size = \"60\">&nbsp;Chọn học kì</option>";
	$hocki = array (
			1 => 'Học kì I',
			2 => 'Học kì II',
			3 => 'Cả năm' 
	);
	For($i = 1; $i <= 3; $i ++) {
		$contents .= "<option value=\"$i\">&nbsp;$hocki[$i]</option>";
	}
	$contents .= "</select>&nbsp;&nbsp;";
	// Chon nam hoc
	$contents .= "<select name = \"manamhoc\">";
	$contents .= "<option value=\"0\" size = \"50\">&nbsp;Chọn năm học</option>";
	$sql = "SELECT * FROM " . NV_PREFIXLANG . "_" . $module_data . "_namhoc";
	$result = $db->query ( $sql );
	while ( $namhoc = $result->fetch () ) {
		$contents .= '<option value="' . $namhoc ['manamhoc'] . '">&nbsp;' . $namhoc ['tennamhoc'] . '</option>';
	}
	$contents .= "</select><br />
		<input type=\"file\" name=\"ufile3\" size = \"35\" id=\"ufile3\"/>
		<input type=\"submit\" name=\"import3\" id=\"import3\" value=\"Import\" /></td>
	</tr>
	</table>
	</form></div>
		
	<div><form enctype=\"multipart/form-data\" id=\"form7\" name=\"form7\" method=\"post\"><center>
	<table class=\"table\">
	<tr>
		<td class=\"fr\"  width=\"220\"  align = \"left\">" . $lang_module ['import_xeploai_hk'] . "</td>
		<td class=\"fr1\"  align = \"left\">";
	// Chon hoc ki
	$contents .= "<select name = \"mahocky\">";
	$contents .= "<option value=\"0\" size = \"60\">&nbsp;Chọn học kì</option>";
	$hocki = array (
			1 => 'Học kì I',
			2 => 'Học kì II',
			3 => 'Cả năm' 
	);
	For($i = 1; $i <= 3; $i ++) {
		$contents .= "<option value=\"$i\">&nbsp;$hocki[$i]</option>";
	}
	$contents .= "</select>&nbsp;&nbsp;";
	// Chon nam hoc
	$contents .= "<select name = \"manamhoc\">";
	$contents .= "<option value=\"0\" size = \"50\">&nbsp;Chọn năm học</option>";
	$sql = "SELECT * FROM " . NV_PREFIXLANG . "_" . $module_data . "_namhoc";
	$result = $db->query ( $sql );
	while ( $namhoc = $result->fetch () ) {
		$contents .= '<option value="' . $namhoc ['manamhoc'] . '">&nbsp;' . $namhoc ['tennamhoc'] . '</option>';
	}
	$contents .= "</select><br />
		<input type=\"file\" name=\"ufile7\" size = \"35\" id=\"ufile7\"/>
		<input type=\"submit\" name=\"import7\" id=\"import7\" value=\"Import\" /></td>
	</tr>
	</table>
	</form></div>
		
	<div><form enctype=\"multipart/form-data\" id=\"form8\" name=\"form8\" method=\"post\"><center>
	<table class=\"table\">
	<tr>
		<td class=\"fr\"  width=\"220\"  align = \"left\">" . $lang_module ['import_xeploai_nam'] . "</td>
		<td class=\"fr1\"  align = \"left\">";
	// Chon nam hoc
	$contents .= "<select name = \"manamhoc\">";
	$contents .= "<option value=\"0\" size = \"50\">&nbsp;Chọn năm học</option>";
	$sql = "SELECT * FROM " . NV_PREFIXLANG . "_" . $module_data . "_namhoc";
	$result = $db->query ( $sql );
	while ( $namhoc = $result->fetch () ) {
		$contents .= '<option value="' . $namhoc ['manamhoc'] . '">&nbsp;' . $namhoc ['tennamhoc'] . '</option>';
	}
	$contents .= "</select><br />
		<input type=\"file\" name=\"ufile8\" size = \"35\" id=\"ufile8\"/>
		<input type=\"submit\" name=\"import8\" id=\"import8\" value=\"Import\" /></td>
	</tr>
</table>
</form></div><br>";
}
include (NV_ROOTDIR . "/includes/header.php");
echo nv_admin_theme ( $contents );
include (NV_ROOTDIR . "/includes/footer.php");

