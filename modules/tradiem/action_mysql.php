<?php

/**
 * @Author GaNguCay (gangucay@gmail.com)
 * @createdate 05/09/2010
 */

if ( ! defined( 'NV_IS_FILE_MODULES' ) ) die( 'Stop!!!' );

$sql_drop_module = array();

$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_diem";
$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_dshs";
$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_lop";
$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_monhoc";
$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_namhoc";
$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_xeploai";
$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_dsgv";

$sql_create_module = $sql_drop_module;

$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_diem (
   id mediumint(9) NOT NULL auto_increment,
   mahs varchar(250) NOT NULL,
   lopid int(11) NOT NULL,
   manamhoc int(11) NOT NULL,
   mahocky int(11) NOT NULL,
   monid int(11) NOT NULL,
   15_1 varchar(5),
   15_2 varchar(5),
   15_3 varchar(5),
   15_4 varchar(5),
   15_5 varchar(5),
   15_6 varchar(5),
   15_7 varchar(5),
   15_8 varchar(5),
   15_9 varchar(5),
   45_1 varchar(5),
   45_2 varchar(5),
   45_3 varchar(5),
   45_4 varchar(5),
   45_5 varchar(5),
   45_6 varchar(5),
   45_7 varchar(5),
   thi varchar(5),
   tbm varchar(5),
   gvid mediumint(3) DEFAULT '0' NOT NULL,
   PRIMARY KEY (id)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8";

$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_dshs (
   id int(9) NOT NULL auto_increment,
   mahs varchar(250) NOT NULL,
   manamhoc int(11) NOT NULL,
   lopid int(11) NOT NULL,
   hoten varchar(250) NOT NULL,
   phai int(11) DEFAULT '1' NOT NULL,
   ngaysinh int(11) NOT NULL,
   noisinh varchar(250) NOT NULL,
   PRIMARY KEY (id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8";

$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_lop (
   lopid int(11) NOT NULL,
   tenlop varchar(250) NOT NULL,
   gvid int(11) DEFAULT '0' NOT NULL,
   PRIMARY KEY (lopid)
) ENGINE=MyISAM DEFAULT CHARSET=utf8";

$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_monhoc (
   monid int(11) NOT NULL,
   tenmon varchar(250) NOT NULL,
   PRIMARY KEY (monid)
) ENGINE=MyISAM DEFAULT CHARSET=utf8";

$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_namhoc (
   manamhoc int(11) NOT NULL,
   tennamhoc varchar(250) NOT NULL,
   PRIMARY KEY (manamhoc)
) ENGINE=MyISAM DEFAULT CHARSET=utf8";

$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_xeploai (
   id int(11) NOT NULL auto_increment,
   mahs varchar(250) NOT NULL,
   lopid int(11) NOT NULL,
   manamhoc int(11) NOT NULL,
   mahocky int(11) NOT NULL,
   tbm varchar(250) NOT NULL,
   hl varchar(250) NOT NULL,
   hk varchar(250) NOT NULL,
   snncp varchar(250),
   snnkp varchar(250),
   danhhieu varchar(250),
   nxgvcn varchar(250),
   PRIMARY KEY (id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8";

$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_dsgv (
   gvid int(11) NOT NULL auto_increment,
   tengv varchar(250) NOT NULL,
   user varchar(250),
   log text,
   chunhiem int(11) DEFAULT '0' NOT NULL,
   active int(11) DEFAULT '1' NOT NULL,
   PRIMARY KEY (gvid)
) ENGINE=MyISAM DEFAULT CHARSET=utf8";

$sql_create_module[] = "INSERT INTO " . NV_CONFIG_GLOBALTABLE . " (lang, module, config_name, config_value) VALUES ('" . $lang . "', '" . $module_name . "', 'instruction_title', 'HỆ THỐNG TRA CỨU ĐIỂM HỌC SINH <br/>CỦA TRƯỜNG')";
$sql_create_module[] = "INSERT INTO " . NV_CONFIG_GLOBALTABLE . " (lang, module, config_name, config_value) VALUES ('" . $lang . "', '" . $module_name . "', 'instruction', 'Tra theo họ tên, mã học sinh hoặc mã lớp. <br/>Ví dụ: Dung hoặc 12A0101 hoặc 12A01')";
