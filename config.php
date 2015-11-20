<?php

// 数据库连接配置
define("DB_HOST", "localhost");
define("DB_NAME", "swd");
define("DB_PORT", 3306);
define("DB_TABLE_daily_data","daily_data");
define("DB_USER", "swd");
define("DB_PASSWORD", "123456");

// 基本数据变量

// 字段数组
$FIELD_ARRAY=array(
	"RiQi"=>"日期",
	"JingHao"=>"井号",
	"BanZu"=>"班组",
	"MuQianJingBie"=>"井别",
	"QuKuaiDanYuan"=>"区块",
	"KaiCaiCengWei"=>"层位",
	"ChongCheng"=>"冲程",
	"ChongCi"=>"冲次",
	"YouZui"=>"油嘴",
	"ShangXingDianLiu"=>"上行电流",
	"XiaXingDianLiu"=>"下行电流",
	"PingHengLv"=>"平衡率",
	"ShengChanShiJian"=>"生产时间",
	"BengJing"=>"泵径",
	"BengShen"=>"泵深",
	"YeMianShiJian"=>"液面时间",
	"YeMian"=>"液面",
	"ChenMoDu"=>"沉没度",
	"LiLunPaiLiang"=>"理排",
	"BengXiao"=>"泵效",
	"YouYa"=>"油压",
	"TaoYa"=>"套压",
	"HuiYa"=>"回压",
	"RiChanYe"=>"日产液",
	"RiChanYou"=>"日产油",
	"RiChanQi"=>"日产气",
	"HanShui"=>"含水",
	"BeiZhu"=>"备注",
);
// 油井井号（字母大写）
$JINGHAO_ARRAY=array("NP2-3","NP2-38","NP2-82","NP203X1","NP203X16","NP280","NP286","NPX206","NP23-2106","NP23-2108","NP23-2113","NP23-2115","NP23-2116","NP23-2307","NP23-2308","NP23-2310","NP23-2312","NP23-2602","NP23-2603","NP23-2605","NP23-2606","NP23-2607","NP23-2609","NP23-2613","NP23-2614","NP23-2615","NP23-2616","NP23-2617","NP23-2623","NP23-2626","NP23-2628","NP23-2630","NP23-2632","NP23-2634","NP23-2642","NP23-2648","NP23-2650","NP23-2656","NP23-2658","NP23-2704","NP23-P2001","NP23-P2002","NP23-P2003","NP23-P2004","NP23-P2005","NP23-P2006","NP23-P2008","NP23-P2009","NP23-P2010","NP23-P2012","NP23-P2013","NP23-P2015","NP23-P2016","NP23-P2111","NP23-P2201","NP23-P2202","NP23-P2203","NP23-P2204","NP23-P2205","NP23-P2206","NP23-P2501","NP23-X2101","NP23-X2102","NP23-X2103","NP23-X2104","NP23-X2105","NP23-X2107","NP23-X2109","NP23-X2110","NP23-X2112","NP23-X2203","NP23-X2207","NP23-X2208","NP23-X2209","NP23-X2211","NP23-X2212","NP23-X2215","NP23-X2216","NP23-X2217","NP23-X2218","NP23-X2219","NP23-X2222","NP23-X2223","NP23-X2224","NP23-X2229","NP23-X2234","NP23-X2236","NP23-X2238","NP23-X2248","NP23-X2249","NP23-X2260","NP23-X2262","NP23-X2263","NP23-X2264","NP23-X2282","NP23-X2302","NP23-X2304","NP23-X2306","NP23-X2320","NP23-X2401","NP23-X2402","NP23-X2404","NP23-X2406","NP23-X2407","NP23-X2408","NP23-X2409","NP23-X2410","NP23-X2411","NP23-X2412","NP23-X2415","NP23-X2419","NP23-X2420","NP23-X2421","NP23-X2422","NP23-X2424","NP23-X2426","NP23-X2430","NP23-X2474");

?>