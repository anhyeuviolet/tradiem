<!-- BEGIN: main -->
	<div class = "tieude">BẢNG ĐIỂM HỌC KÌ {KY} - NĂM HỌC {NAMHOC}</div>
<table width="100%" border="1" style="border-collapse:collapse;border-color:#999999" cellpadding="2" cellspacing="2">
	<tr>
		<td colspan="7"><br>
			<table width="100%"  border="0" style="border-collapse:collapse" cellpadding="2" cellspacing="2">
	 		<tr>
				<td width="38%"><b>Họ và tên :</b> <a class="huongdan">{HOTEN}</a></td>
				<td><b>Giới tính:</b>&nbsp;{GTINH}</td>
				<td><b>Nơi sinh:</b>&nbsp;{NOISINH}</td>
	  		</tr>
	  		<tr>
				<td><b>Mã số:</b>&nbsp;{MAHS}</td>
				<td><b>Lớp:</b>&nbsp;{LOP}</td>
				<td><b>Ngày sinh:&nbsp;</b>{NGSINH}</td>
			</tr>
		</table><br>
		</td>
	</tr>
	<tr>
		<td width="100" class="stitle">Môn học</td>
		<td width="140" class="stitle">Điểm kiểm tra thường xuyên</td>
		<td width="100" class="stitle">Điểm kiểm tra định kỳ</td>
		<td width="65" class="stitle">KTHK</td>
		<td width="65" class="stitle">ĐTBmhk</td>
	</tr>
	<!-- BEGIN: loop_diem -->
	<tr>
		<td class="tdmonhoc">{MON}</td>
		<td>{15_1}&nbsp;&nbsp;{15_2}&nbsp;&nbsp;{15_3}&nbsp;&nbsp;{15_4}&nbsp;&nbsp;{15_5}&nbsp;&nbsp;{15_6}&nbsp;&nbsp;{15_7}&nbsp;&nbsp;{15_8}&nbsp;&nbsp;{15_9}</td>
		<td>{45_1}&nbsp;&nbsp;{45_2}&nbsp;&nbsp;{45_3}&nbsp;&nbsp;{45_4}&nbsp;&nbsp;{45_5}&nbsp;&nbsp;{45_6}&nbsp;&nbsp;{45_7}</td>
		<td align = "center">{THI}</td>
		<td align = "center">{TBM}</td>
	</tr>
	<!-- END: loop_diem -->
	<tr>
	  	<td colspan="7">
	  		<center><a class="huongdan">Tổng kết</a> 
	  	</td>
	</tr>
	<tr>
		<td class="tdmonhoc">ĐTBhk</td>
		<td colspan="5">{XEPLOAI.tbm}</td>
	</tr>
	<tr>
	  	<td class="tdmonhoc">Học lực</td>
		<td colspan="5">{XEPLOAI.hl}</td>
	</tr>
	<tr>
		<td class="tdmonhoc">Hạnh kiểm</td>
		<td colspan="5">{XEPLOAI.hk}</td>
	</tr>
	<tr>
	<tr>
	  	<td class="tdmonhoc">Số ngày nghỉ</td>
	  	<td colspan="5"> 
		<table width="100%" border="0" style="border-collapse:collapse;border-color:#999999" cellpadding="0" cellspacing="0">
		  	<tr>
		 		<td width=25% align=right>Có phép:&nbsp;&nbsp;</td><td>{XEPLOAI.snncp}</td>
	 			<td width=25% align=right>Không phép:&nbsp;&nbsp;</td><td>{XEPLOAI.snnkp}</td>
	 			<td width=25% align=right>Tổng cộng:&nbsp;&nbsp;</td><td>{TONG}</td>
	 		</tr>
	   	</table>
		</td>
	 </tr>
		<td class="tdmonhoc">Danh hiệu</td>
		<td colspan="5">{XEPLOAI.danhhieu}</td>
	 </tr>
 	 </tr>
		<td class="tdmonhoc"><b>Nhận xét của GVCN</b></td>
		<td colspan="5">{XEPLOAI.nxgvcn}</td>
	 </tr>
	  <tr>
		<td colspan="6"><div align="center"><strong>Nguồn từ : http://thpt-vinhloc-thuathienhue.edu.vn</strong></div></td>
	  </tr>
	</table>
<!-- END: main -->
