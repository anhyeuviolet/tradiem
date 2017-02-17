<?php
/**
 * @Author GaNguCay (gangucay@gmail.com)
 * @createdate 05/09/2010
 */

if ( ! defined( 'NV_IS_MOD_TRADIEM' ) ) die( 'Stop!!!' );

function theme_main( $namhoc, $ext, $script)
{
    global $global_config, $lang_module, $module_info, $module_name, $module_file, $lang_global;
    $xtpl = new XTemplate( "main.tpl", NV_ROOTDIR . "/themes/" . $module_info['template'] . "/modules/tradiem/" );
    $xtpl->assign( 'LANG', $lang_module );
    $xtpl->assign( 'CAUHINH', $ext );
    $xtpl->assign( 'SCRIPT', $script );
    $hocki = array(1 => 'Học kì I', 2 => 'Học kì II', 3 => 'Cả năm');
    for ($i = 1; $i <=3; $i ++){
 	
    $xtpl->assign( 'MAHK', $i );
    $xtpl->assign( 'TENHK', $hocki[$i]);
    $xtpl->parse('main.block_table.loop_hk');
    }
	if ( ! empty( $namhoc) )
    {
       foreach ( $namhoc as $nhoc){
       $xtpl->assign( 'MANAMHOC', $nhoc['manamhoc']);
       $xtpl->assign( 'TENNAMHOC', $nhoc['tennamhoc']);
       $xtpl->parse('main.block_table.loop_nh');
       }
    }
    $xtpl->parse('main.block_table');
    $xtpl->parse( 'main' );
    return $xtpl->text( 'main' );
}
function viewhk($content, $diemmh, $lophoc, $monhoc, $namhoc, $xeploai, $ext)
{
    global $global_config, $lang_module, $module_info, $module_name, $module_file, $lang_global;
    $xtpl = new XTemplate( "view.tpl", NV_ROOTDIR . "/themes/" . $module_info['template'] . "/modules/tradiem/" );
    $xtpl->assign( 'LANG', $lang_module );
    $xtpl->assign( 'CAUHINH', $ext );
    if ( ! empty( $content) )
    {
       foreach ( $content as $thongtin){
			$xtpl->assign( 'MAHS', $thongtin['mahs'] );
			$xtpl->assign( 'NAMHOC', $namhoc[$thongtin['manamhoc']] );
			$xtpl->assign( 'LOP', $lophoc[$thongtin['lopid']] );
			$xtpl->assign( 'HOTEN', $thongtin['hoten'] );
			$xtpl->assign( 'NGSINH', date('d/m/Y',$thongtin['ngaysinh']));
			$xtpl->assign( 'GTINH', ($thongtin['phai'] == 0)?'Nữ':'Nam');
			$xtpl->assign( 'NOISINH', $thongtin['noisinh'] );
	   }
	}
    if ( ! empty( $xeploai) )
    {
       foreach ( $xeploai as $xl){
			$xtpl->assign( 'XEPLOAI', $xl );
			$xtpl->assign( 'KY', $xl['mahocky'] );
			$xtpl->assign( 'TONG', intval($xl['snncp']) + intval($xl['snnkp']) );
	   }
	}
    if ( ! empty( $diemmh) )
    {
       foreach ( $diemmh as $diem){
			$xtpl->assign( 'MON', $monhoc[$diem['monid']] );
			$xtpl->assign( '15_1', $diem['15_1'] );
			$xtpl->assign( '15_2', $diem['15_2'] );
			$xtpl->assign( '15_3', $diem['15_3'] );
			$xtpl->assign( '15_4', $diem['15_4'] );
			$xtpl->assign( '15_5', $diem['15_5'] );
			$xtpl->assign( '15_6', $diem['15_6'] );
			$xtpl->assign( '15_7', $diem['15_7'] );
			$xtpl->assign( '15_8', $diem['15_8'] );
			$xtpl->assign( '15_9', $diem['15_9'] );
			$xtpl->assign( '45_1', $diem['45_1'] );
			$xtpl->assign( '45_2', $diem['45_2'] );
			$xtpl->assign( '45_3', $diem['45_3'] );
			$xtpl->assign( '45_4', $diem['45_4'] );
			$xtpl->assign( '45_5', $diem['45_5'] );
			$xtpl->assign( 'THI', $diem['thi'] );
			$xtpl->assign( 'TBM', $diem['tbm'] );
			$xtpl->parse('main.loop_diem');
	   }
	}
	
    $xtpl->parse( 'main' );
    return $xtpl->text( 'main' );
}

function maincn($content, $diemtb, $xeploaicn, $lophoc, $monhoc, $namhoc, $ext)
{
    global $global_config, $lang_module, $module_info, $module_name, $module_file, $lang_global;
    $xtpl = new XTemplate( "viewcn.tpl", NV_ROOTDIR . "/themes/" . $module_info['template'] . "/modules/tradiem/" );
    $xtpl->assign( 'LANG', $lang_module );
    $xtpl->assign( 'CAUHINH', $ext );
    if ( ! empty( $content) )
    {
       foreach ( $content as $thongtin){
			$xtpl->assign( 'MAHS', $thongtin['mahs'] );
			$xtpl->assign( 'NAMHOC', $namhoc[$thongtin['manamhoc']] );
			$xtpl->assign( 'LOP', $lophoc[$thongtin['lopid']] );
			$xtpl->assign( 'HOTEN', $thongtin['hoten'] );
			$xtpl->assign( 'NGSINH', date('d/m/Y',$thongtin['ngaysinh']));
			$xtpl->assign( 'GTINH', ($thongtin['phai'] == 0)?'Nữ':'Nam');
			$xtpl->assign( 'NOISINH', $thongtin['noisinh'] );
	   }
	}
    if ( ! empty( $monhoc) AND !empty($diemtb))
    {
       foreach ( $monhoc as $key => $value){
       	   $mon = $key;
       	   //foreach ( $diemtb as $dtb){
       	   	$hk1 = $diemtb[1][$mon];
       	   	$hk2 = $diemtb[2][$mon];
       	   	$hk3 = (intval($hk1) != 0 AND intval($hk2) != 0)?round(($hk1 + $hk2*2)/3, 1):'';
			$xtpl->assign( 'MON', $value );
			$xtpl->assign( 'HKI', $hk1 );
			$xtpl->assign( 'HKII', $hk2 );
			$xtpl->assign( 'HKIII', $hk3 );
			$xtpl->parse('main.loop_diem');
		   //}
	   }
	}
	if ( ! empty( $xeploaicn) )
    {
       foreach ( $xeploaicn as $xloai){
       	   if ($xloai['mahocky'] == 1){
       	   		$tbmk1 = $xloai['tbm'] ;
       	   		$hl1 = $xloai['hl'] ;
       	   		$hak1 = $xloai['hk'] ;
       	   		$snncp1 = $xloai['snncp'] ;
       	   		$snnkp1 = $xloai['snnkp'] ;
       	   		$dh1 = $xloai['danhhieu'] ;
	   			$xtpl->assign( 'TBMKI', $tbmk1 );
	   			$xtpl->assign( 'HLI', $hl1 );
       	   		$xtpl->assign( 'HAKI', $hak1 );
       	   		$xtpl->assign( 'SNNCP1', $snncp1 + 0);
       	   		$xtpl->assign( 'SNNKP1', $snnkp1 + 0);
       	   		$xtpl->assign( 'SNN1', intval($snncp1) + intval($snnkp1) + 0);
       	   		$xtpl->assign( 'DHI', $dh1 );
       	   }elseif ($xloai['mahocky'] == 2){
       	   		$tbmk2 = $xloai['tbm'] ;
       	   		$hl2 = $xloai['hl'] ;
       	   		$hak2 = $xloai['hk'] ;
       	   		$snncp2 = $xloai['snncp'] ;
       	   		$snnkp2 = $xloai['snnkp'] ;
       	   		$dh2 = $xloai['danhhieu'] ;
       	   		$xtpl->assign( 'TBMKII', $tbmk2 );
			    $xtpl->assign( 'HLII', $hl2 );
			    $xtpl->assign( 'HAKII', $hak2 );
			    $xtpl->assign( 'SNNCP2', $snncp2 + 0);
			    $xtpl->assign( 'SNNKP2', $snnkp2 + 0);
			    $xtpl->assign( 'SNN2', intval($snncp2) + intval($snnkp2) + 0);
		 	    $xtpl->assign( 'DHII', $dh2 );
       	   }else{
       	   		$tbmk3 = $xloai['tbm'] ;
       	   		$hl3 = $xloai['hl'] ;
       	   		$hak3 = $xloai['hk'] ;
       	   		$snncp3 = $xloai['snncp'] ;
       	   		$snnkp3 = $xloai['snnkp'] ;
       	   		$dh3 = $xloai['danhhieu'] ;
       	   		$nxgvcn = $xloai['nxgvcn'] ;
	   			$xtpl->assign( 'TBMKIII', $tbmk3 );
			    $xtpl->assign( 'HLIII', $hl3 );
			    $xtpl->assign( 'HAKIII', $hak3 );
			    $xtpl->assign( 'SNNCP3', $snncp3 + 0);
			    $xtpl->assign( 'SNNKP3', $snnkp3 + 0);
			    $xtpl->assign( 'SNN3', intval($snncp3) + intval($snnkp3) + 0);
       	   		$xtpl->assign( 'DHIII', $dh3 );
       	   		$xtpl->assign( 'NXGVCN', $nxgvcn );
       	   }
	   }
	}
    $xtpl->parse( 'main' );
    return $xtpl->text( 'main' );
}
function mains($content, $lophoc, $namhoc, $ext, $script, $kqsearch)
{
    global $global_config, $lang_module, $module_info, $module_name, $module_file, $lang_global;
    $xtpl = new XTemplate( "main.tpl", NV_ROOTDIR . "/themes/" . $module_info['template'] . "/modules/tradiem/" );
    $xtpl->assign( 'LANG', $lang_module );
    $xtpl->assign( 'CAUHINH', $ext );
    $xtpl->assign( 'SCRIPT', $script );
    $hocki = array(1 => 'Học kì I', 2 => 'Học kì II', 3 => 'Cả năm');
    for ($i = 1; $i <=3; $i ++){
 	
    $xtpl->assign( 'MAHK', $i );
    $xtpl->assign( 'TENHK', $hocki[$i]);
    $xtpl->parse('main.block_table.loop_hk');
    }
	if ( ! empty( $namhoc) )
    {
       foreach ( $namhoc as $nhoc){
       $xtpl->assign( 'MANAMHOC', $nhoc['manamhoc']);
       $xtpl->assign( 'TENNAMHOC', $nhoc['tennamhoc']);
       $xtpl->parse('main.block_table.loop_nh');
       }
    }
    $xtpl->parse('main.block_table');
    $num = count($content);
    $xtpl->assign( 'COUNT', $num );
    $xtpl->assign( 'KEY', $kqsearch[1] );
    $xtpl->assign( 'HKID', $kqsearch[2] );
    $xtpl->assign( 'NAMID', $kqsearch[3] );
    $xtpl->assign( 'FINDTYPE', $kqsearch[4] );
    $links = NV_BASE_SITEURL . "index.php?" . NV_LANG_VARIABLE . "=" . NV_LANG_DATA . "&amp;" . NV_NAME_VARIABLE . "=" . $module_name . "&amp;" . NV_OP_VARIABLE . "=view&keywords";
    $xtpl->assign( 'LINKS', $links );
    if ( ! empty( $content) )
    {
       foreach ( $content as $thongtin){
			$xtpl->assign( 'MAHS', $thongtin['mahs'] );
			$xtpl->assign( 'NAMID', $thongtin['manamhoc'] );
			//$xtpl->assign( 'LOP', $lophoc[$thongtin['lopid']] );
			$xtpl->assign( 'HOTEN', $thongtin['hoten'] );
			$xtpl->assign( 'NGSINH', date('d/m/Y',$thongtin['ngaysinh']));
			$xtpl->assign( 'NOISINH', $thongtin['noisinh'] );
			$xtpl->parse('main.block_tablekq.loop_kq');
	   }
	}
	$xtpl->parse('main.block_tablekq');
    $xtpl->parse( 'main' );
    return $xtpl->text( 'main' );
}

