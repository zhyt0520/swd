<?php

// 数据库连接配置
// 一、本地数据库
define("DB_HOST", "localhost");
define("DB_NAME", "swd");
define("DB_PORT", 3306);
define("DB_TABLE_USER", "user");
define("DB_USER", "swd");
define("DB_PASSWORD", "123456");

// 二、远程数据库
define("DB_HOST_REMOTE", "10.86.10.50");
define("DB_NAME_REMOTE", "oracle10");
define("DB_PORT_REMOTE", 1521);
define("DB_TABLE_oil_well_data","DBA01");
define("DB_TABLE_water_well_data","DBA02");
define("DB_USER_REMOTE", "jd");
define("DB_PASSWORD_REMOTE", "jd");

// 基本数据变量
// 字段数组
$FIELD_OIL_ARRAY=array(
	"RQ"=>"日期",
	"JH"=>"井号",
	"CYFS"=>"井别",
	"CC"=>"冲程",
	"CC1"=>"冲次",
	"YZ"=>"油嘴",
	"SCSJ"=>"生产时间",
	"BJ"=>"泵径",
	"PL"=>"理排",
	"YY"=>"油压",
	"TY"=>"套压",
	"HY"=>"回压",
	"RCYL1"=>"日产液",
	"RCYL"=>"日产油",
	"RCSL"=>"日产水",
	"RCQL"=>"日产气",
	"HS"=>"含水",
	"BZ"=>"备注",
	);
// $for_js_default_checked_checkbox="<script>var default_checked_checkbox = [";
// foreach($FIELD_OIL_ARRAY as $key=>$value){
// 	$for_js_default_checked_checkbox.="'".$key."',";
// }
// $for_js_default_checked_checkbox.="];</script>";
// echo $for_js_default_checked_checkbox;
$FIELD_WATER_ARRAY=array(
	"JH"=>"井号",
	"RQ"=>"日期",
	"SCSJ"=>"生产时间",
	"ZSFS"=>"注水方式",
	"GXYL"=>"干线压力",
	"YY"=>"油压",
	"TY"=>"套压",
	"JKHT"=>"井口含铁",
	"JKZZ"=>"井口杂质",
	"RPZSL"=>"日配注",
	"RZSL"=>"日注水",
	"PZCDS"=>"配注层段",
	"BZ"=>"备注",
	);

// 井号（字母大写）
$JINGHAO_OIL_ARRAY=array("NP2-3","NP2-38","NP2-82","NP203X1","NP203X16","NP280","NP286","NPX206","NP23-2106","NP23-2108","NP23-2113","NP23-2115","NP23-2116","NP23-2307","NP23-2308","NP23-2310","NP23-2312","NP23-2425","NP23-2602","NP23-2603","NP23-2605","NP23-2606","NP23-2607","NP23-2609","NP23-2613","NP23-2614","NP23-2615","NP23-2616","NP23-2617","NP23-2623","NP23-2626","NP23-2628","NP23-2630","NP23-2632","NP23-2634","NP23-2642","NP23-2648","NP23-2650","NP23-2656","NP23-2658","NP23-2662","NP23-2704","NP23-P2001","NP23-P2002","NP23-P2003","NP23-P2004","NP23-P2005","NP23-P2006","NP23-P2008","NP23-P2009","NP23-P2010","NP23-P2012","NP23-P2013","NP23-P2015","NP23-P2016","NP23-P2111","NP23-P2201","NP23-P2202","NP23-P2203","NP23-P2204","NP23-P2205","NP23-P2206","NP23-P2501","NP23-X2101","NP23-X2102","NP23-X2103","NP23-X2104","NP23-X2105","NP23-X2107","NP23-X2109","NP23-X2110","NP23-X2112","NP23-X2203","NP23-X2207","NP23-X2208","NP23-X2209","NP23-X2211","NP23-X2212","NP23-X2215","NP23-X2216","NP23-X2217","NP23-X2218","NP23-X2219","NP23-X2222","NP23-X2223","NP23-X2224","NP23-X2229","NP23-X2234","NP23-X2236","NP23-X2238","NP23-X2248","NP23-X2249","NP23-X2260","NP23-X2262","NP23-X2263","NP23-X2264","NP23-X2282","NP23-X2302","NP23-X2304","NP23-X2306","NP23-X2320","NP23-X2401","NP23-X2402","NP23-X2404","NP23-X2406","NP23-X2407","NP23-X2408","NP23-X2409","NP23-X2410","NP23-X2411","NP23-X2412","NP23-X2415","NP23-X2419","NP23-X2420","NP23-X2421","NP23-X2422","NP23-X2424","NP23-X2426","NP23-X2430","NP23-X2474");
$JINGHAO_WATER_ARRAY=array("NP203X2","NP23-2601","NP23-2604","NP23-2608","NP23-2610","NP23-2611","NP23-2612","NP23-2619","NP23-2621","NP23-2622","NP23-2636","NP23-2638","NP23-2646","NP23-2647","NP23-2654","NP23-X2210","NP23-X2213","NP23-X2214","NP23-X2220","NP23-X2296","NP23-X2298","NP23-X2301","NP23-X2303","NP23-X2305","NP23-X2405","NP23-X2417","NP23-X2418","NP23-X2423","NP23-X2428","NP23-X2436","NP23-X2448",);

?>