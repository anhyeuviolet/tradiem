<?php

/**
 * @Author GaNguCay (gangucay@gmail.com)
 * @createdate 05/09/2010
 */

if ( ! defined( 'NV_ADMIN' ) or ! defined( 'NV_MAINFILE' ) or ! defined( 'NV_IS_MODADMIN' ) )
    die( 'Stop!!!' );
$submenu['quanli_nam'] = $lang_module['quanli_nam'];
$submenu['quanli_mon'] = $lang_module['quanli_mon'];
$submenu['quanli_lop'] = $lang_module['quanli_lop'];
$submenu['quanli_diem'] = $lang_module['quanli_diem'];
$submenu['quanli_xl'] = $lang_module['quanli_xl'];
$submenu['quanli_dsgv'] = $lang_module['quanli_dsgv'];
$submenu['import'] = $lang_module['import'];
$submenu['config'] = $lang_module['config'];
$allow_func = array( 'main','quanli_nam', 'addnam','delnam','quanli_mon', 'addmon','delmon','quanli_lop','addlop','dellop','quanli_dsgv','addgv','delgv','addhs','delhs', 'import','importgv','quanli_diem','adddiem','deldiem','quanli_xl','addxl','delxl', 'config', 'khoitaodl','khoitaoxl','change_ac');
define( 'NV_IS_FILE_ADMIN', true );
