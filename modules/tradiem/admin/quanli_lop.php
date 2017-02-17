<?php
/**
 * @Author GaNguCay (gangucay@gmail.com)
 * @createdate 05/09/2010
 */

if (! defined ( 'NV_IS_FILE_ADMIN' ))
	die ( 'Stop!!!' );
$page_title = $lang_module ['quanli_lop'];
// Hien thi tieu de
$contents .= "<div>";
$contents .= "<form name=\"deltkb\" action=\"\" method=\"post\">";
$contents .= "<table summary=\"\" class=\"table\">\n";
$contents .= "<td>";
$contents .= "<center><b><font color=blue size=\"3\">" . $lang_module['quanli_lop_td'] . "</font></b></center>";
$contents .= "</td>\n";
$contents .= "</table>";
$contents .= "</form>";
$contents .= "</div>";

$contents .= "<table class=\"table\">\n";
$contents .= "<thead>\n";
$contents .= "<tr>\n";
$contents .= "<td align='center'>" . $lang_module ['stt'] . "</td>\n";
$contents .= "<td align='center'>" . $lang_module ['lopid'] . "</td>\n";
$contents .= "<td align='center'>" . $lang_module ['tenlop'] . "</td>\n";
$contents .= "<td align='center'>" . $lang_module ['gvcn'] . "</td>\n";
$contents .= "<td align='center'>" . $lang_module ['quanli'] . "</td>\n";
$contents .= "</tr>\n";
$contents .= "</thead>\n";

$page = $nv_Request->get_int ( 'page', 'get', 0 );
$per_page = 20;
$base_url = NV_BASE_ADMINURL.'index.php?'.NV_NAME_VARIABLE.'='.$module_name;
$query = $db->query ( "SELECT lopid FROM " . NV_PREFIXLANG . "_" . $module_data . "_lop" );
$all_page = $query->rowCount();
$a = 0;
$sql = "SELECT *  FROM " . NV_PREFIXLANG . "_" . $module_data . "_lop ORDER BY lopid ASC LIMIT $page,$per_page";
$result = $db->query ( $sql );

while ( $row = $result->fetch ( ) ) {
	// Loc danh sach giao vien
	$sqlgv = "SELECT gvid,tengv FROM " . NV_PREFIXLANG . "_" . $module_data . "_dsgv WHERE chunhiem=1 ORDER BY gvid ASC";
	$resultgv = $db->query( $sqlgv);

	$class = ($a % 2) ? " class=\"second\"" : "";
	$contents .= "<tbody" . $class . ">\n";
	$contents .= "<tr>\n";
	$contents .= "<td align=\"center\">" . ++$a . "</td>\n";
	$contents .= "<td align=\"center\">" . $row ['lopid']."</td>\n";
	$contents .= "<td align=\"center\">" . $row ['tenlop']."</td>\n";
    // Hien thi danh sach giao vien
   	$contents .= "<td align=\"center\" width = \"25%\">
        <select name = \"dsgv\" id=\"change_acgv_" . $row['lopid'] . "\" onchange=\"nv_chang_acgv(" . $row['lopid'] . ");\">";
    $contents .= "<option value=\"0\" size = \"30\">&nbsp;Chọn giáo viên chủ nhiệm</option>";
    	while ( $dsgv = $resultgv->fetch () ) {
    		if ($row['gvid'] != 0){
	       	$selkh =(($dsgv['gvid'] == $row['gvid'])?'selected':'');
	       	$contents .= '<option value ="' . $dsgv['gvid'] . '" '. $selkh . '>&nbsp;' . $dsgv['tengv'] . '&nbsp;</option>';
	       	} else {
	       		$contents .= '<option value ="' . $dsgv['gvid'] . '">&nbsp;' . $dsgv['tengv'] . '&nbsp;</option>';
	       	}
    	}
	$contents .= "</select></td>\n";
	// Het hien thi danh sach giao vien
	//$contents .= "<td align=\"center\">" . $row ['gvid']."</td>\n";
	$contents .= "<td align=\"center\" width = \"20%\">";
	$contents .= "<span class=\"edit_icon\"><a class='edit' href=\"index.php?" . NV_NAME_VARIABLE . "=" . $module_data . "&" . NV_OP_VARIABLE . "=addlop&amp;id=" . $row ['lopid'] . "\">" . $lang_global ['edit'] . "</a></span>\n";
	$contents .= "&nbsp;-&nbsp;<span class=\"delete_icon\"><a class='del' href=\"index.php?" . NV_NAME_VARIABLE . "=" . $module_data . "&" . NV_OP_VARIABLE . "=dellop&amp;id=" . $row ['lopid'] . "\">" . $lang_global ['delete'] . "</a></span></td>\n";
	$contents .= "</tr>\n";
	$contents .= "</tbody>\n";
	//$a ++;
}
$contents .= "<tfoot><tr><td colspan='6'><span class=\"btn btn-primary\"><a class='add' href=\"index.php?" . NV_NAME_VARIABLE . "=" . $module_data . "&" . NV_OP_VARIABLE . "=addlop\">" . $lang_global ['add'] . "</a></span></td></tr></tfoot>";
$contents .= "</table>\n";
//$my_head = "<script type=\"text/javascript\" src=\"" . NV_BASE_SITEURL . "js/popcalendar/popcalendar.js\"></script>\n";

$generate_page = nv_generate_page ( $base_url, $all_page, $per_page, $page );
if (! empty ( $generate_page ))
	$contents .= "<br><p align=\"center\">" . $generate_page . "</p>\n";
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
	if (confirm('".$lang_module['dellop_del_confirm']."')){
		$.ajax({	
			type: 'POST',
			url: href,
			data: '',
			success: function(data){				
				alert(data);
				window.location='index.php?" . NV_NAME_VARIABLE . "=" . $module_name . "&".NV_OP_VARIABLE."=quanli_lop';
			}
		});
	}
});
});
</script>
";


include (NV_ROOTDIR . "/includes/header.php");
echo nv_admin_theme ( $contents );
include (NV_ROOTDIR . "/includes/footer.php");
