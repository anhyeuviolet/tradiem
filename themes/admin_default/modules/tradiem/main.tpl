<!-- BEGIN: main -->

		<table class="table">
		<thead>
		<tr>
		<td align="center"> . $lang_module ['stt'] . "</td>
		<td align="center"> . $lang_module ['mahs'] . "</td>
		<td align="center"> . $lang_module ['hoten'] . "</td>
		<td align="center"> . $lang_module ['gtinh'] . "</td>
		<td align="center"> . $lang_module ['ngsinh'] . "</td>
		<td align="center"> . $lang_module ['noisinh'] . "</td>
		
		<td align="center"> . $lang_module ['quanli'] . "</td>
		</tr>
		</thead>
		$gtinh = array(0 => 'Nữ', 1 => 'Nam');
		$a = 0;
		while ($dshs = $result->fetch())
		{
			$class = ($a % 2) ? " class="second"" : "";
			<tbody" . $class . ">
			<tr>
			<td align="center">" . ++$a . "</td>
			<td align="center">" . $dshs ['mahs']."</td>
			<td align="left">" . $dshs ['hoten']."</td>
			<td align="center">" . $gtinh[$dshs ['phai']]."</td>
			<td align="center">" . date('d/m/Y',$dshs ['ngaysinh'])."</td>
			<td align="left">" . $dshs ['noisinh']."</td>
			<td align="center">";
			<span class="edit_icon"><a class="edit' href="index.php?" . NV_NAME_VARIABLE . "=" . $module_data . "&" . NV_OP_VARIABLE . "=addhs&amp;id=" . $dshs ['id'] . "">" . $lang_global ['edit'] . "</a></span>
			&nbsp;-&nbsp;<span class="delete_icon"><a class="del' href="index.php?" . NV_NAME_VARIABLE . "=" . $module_data . "&" . NV_OP_VARIABLE . "=delhs&amp;id=" . $dshs ['id'] . "">" . $lang_global ['delete'] . "</a></span></td>
			</tr>
			</tbody>
		}
	<tfoot><tr><td colspan="7"><span class="btn btn-primary"><a class="add' href="index.php?" . NV_NAME_VARIABLE . "=" . $module_data . "&" . NV_OP_VARIABLE . "=addhs&amp;lopid=" . $lopid . "&amp;manamhoc=" . $manamhoc . "">" . $lang_global ['add'] . "</a></span></td></tr></tfoot>";
	</table>
	$my_head = "<script type="text/javascript" src="" . NV_BASE_SITEURL . "js/popcalendar/popcalendar.js"></script>

	<div id="contentedit"></div><input id="hasfocus' style="width:0px;height:0px'/>";
	
	<script type="text/javascript">
	$(function(){
	$('a[class="add"]').click(function(event){
		event.preventDefault();
		var href= $(this).attr('href');
		$('#contentedit').load(href,function(){
			$('#hasfocus').focus();
		});

	});
	$('a[class="edit"]').click(function(event){
		event.preventDefault();
		var href= $(this).attr('href');
		$('#contentedit').load(href,function(){
			$('#hasfocus').focus();
		});
	});
	$('a[class="del"]').click(function(event){
		event.preventDefault();
		var href= $(this).attr('href');
		if (confirm(nv_is_del_confirm[0])){
			$.ajax({	
				type: 'POST',
				url: href,
				data: '',
				success: function(data){				
					alert(data);
					window.location="index.php?" . NV_NAME_VARIABLE . "=" . $module_name . "&".NV_OP_VARIABLE."=quanli_mon';
				}
			});
		}
	});
	});
	</script>
<!-- END: main -->