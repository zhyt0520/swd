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
define("DB_HOST_REMOTE", "10.86.13.188");
define("DB_NAME_REMOTE", "oracle9");
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
$JINGHAO_OIL_ARRAY=array("NP11-K8-X224","NP43-X4858","G24-P3","G51-25","G512-6","G53-25","G7","G7-1","G7-2","G7-4","G5-80","G76-40","G76-42","G23-21","C2-3","G5-54","NP13-1140","NP23-P2012","G62","L1-46","NP23-P2015","LN8-2","G5-58","G104-5P14","G104-5P15CP1","L1-47","G63-2","G63-22","L1-50","G59-40","L121X1","NP13-X1080","G94-42","LB1-7","NP13-X1082","M17-23","NP11-231","M17-25","LB2-1","M27-15","LB2-15-21","M17-30","NP13-X1091","NP13-X1106","M28-P10","LB1-17-10","G3102-20","NP23-X2304","NP23-X2207","NP23-2108","NP12-58","G3102-31","L2-19","G3102-40","L36","GC30-28","L36-3","NP23-X2209","L20-3","G26-22","G28","G59-51","NP23-X2409","NP23-X2211","L21-2","LN9-1","NP23-X2212","NP13-1288","NP23-X2410","L23-P7","G113-5","L10-18","G58-20-1","GX15-18","NP12-162","NP23-X2218","G59","NP23-X2112","G15-15","L28-5","L28-9","G29-P3","L25-15","G180X3","NP13-1326","NP23-X2238","NP23-X2415","NP23-X2419","G308-4","NP23-X2101","G104-5P89","G3102-15","NP12-51","G59-56","G76-32","NP13-1322","NP12-161","NP23-X2107","G76-27","G80-23","G88-4","NP12-176","G88-6","G149X2","L90-17","NP13-1510","G160X1","L90-18","NP23-P2202","L90-34","L90-59","NP23-P2201","L90-61","NP23-X2208","L90-63","L11-2","L90-6","NP13-1706","L90-64","G37-1","NP23-X2224","G37-11","NP23-X2234","L2-31","G37-12","L2-35","G37-15","L2-52","C2-P2","G76-65","C2-P3","L102X2","L102X3","L17-3","G104-5P101","L23-6","M3-11","M3-12","G180-10","M101-P11CP1","M101-P12CP1","M101-P14","G110X9","NP12-X79","LX11-2","M17-9","G60-25","G63-32-1","G63-33","G63-35","G76-71","MC101-P17","G59-88","MC19-12","NP12-X87","G60-31","G60-36","LX90-23","NP401X2","G64-30","G61-31","G65-31","G76-72","G65-33","LB1-13","M27-17","G64-32","NP13-X1108","G64-35","L21-P3","NP11-235","L211X1","NP13-X1116","NP11-236","NP13-X1122","G69-22","NP13-X1136","NP41-X4538","L25-4","G37-13","NP23-2609","G13-14","NP23-2602","G29-ZP1","G97-5","G3X3","G3102-12","G76-44","NP13-1960","G180-12","NP23-P2204","NP23-X2260","G104-5P81","M18-15","G70-35","G59-35","NP101X20","L130X1","G94-33","G104-5P84","NP101X22","G94-43","M3","M3-10","NP101X29","NP106","G512-5","M101-P10","M101-P20","G110-7CP1","M101-P3","G112-5","G76-37","G94-30","N70-22","G111-8","G166-50","N15-17","NP4-32","NP4-39","M25-11","G23-59","G104-5P126","G160X2","G104-5P18","T105X1","G160-P2","G104-5P24","NP43-4827","G104-5P67","NP43-4831","G45-22","G49-29","NP43-4938","NP43-X4805","N15-9","G19-10","M27-37","M28-12","NP12-X810","NP13-X1923","M106X2","M36-P2","NP105X3","M7X2","NP109","NP21-X2416","M30-39","G56-48","M101-P15","G59-13","G69-24","L25","M101-P18","L25X1","G59-16","G80-20","M128X1","NP3-2","M27-4","NP42-4131","G98-18","G59-49","M101-P6","G59-6","L13-23","G93-1","M17-4","MC17-5","NP41-X4546","G89-1","M28-5","LB1-17-4","G89-2","M18-23","G69-10","M26-25","M30-15","G56-50","NP11-296","G59-15","M30-7","M28-11","M28-7","G104-5P110","NP11-310","NP13-X1190","G62-28","NP11-326","LC125X4","NP13-1935","G3102-11","LN3-11","G3102-13","G34-CP1","NP12-X60","NP13-1946","G36-28","G194X1","G3102-41","L38X1","G76-26","G15-17","G76-29","L109X1","NP13-1958","L4","L7","L1-27","L90-P1","L8-CP1","G76-34","LN3-20","G17-50","NP23-2656","NP101X15","NP12-X78","G76-50","NP13-X1018","G66-53","G62-37","G94-31","NP12-X806","M28-18","LB-P5","M18-27","M28-25","M28-27","M28-29","M108X1","LB1-19-10","LB1-19-8","LB2-19-7","M28-P8","G104-5CP28","M29-27","M18-25","G104-5P22","NP11-292","M27-23","M30-27","M27-25","NP11-300","NP101X16","G59-21","NP41-X4550","M27-29","NP12-P801","G59-P7","NP11-306","G62-35","G64-37","LB-P6","L23-8","G104-5P129","G89-6","NP118X20","M101-P8","G78-15","G59-P12","M101-P9","M28-13","LB1-13-22","M105X1","M28-3","LC15-24","M28-P15","G62-39","M28-P2CP1","L19-17","M101-P23","NP13-P1652","M102","G119-2","NP118-X2","NP118-X8","T2-16","N70-25","G215-7","T70X5","G24-26","GX208-4","G59-8","N15-18","G166-61","MB-P9","NP43-4934","NP43-X4809","NP43-X4810","NP43-X4822","T37-P2","G24-P1","T138X1","G24-P2","NP4-19","L90-75","LB2-25","G3102-6","LN3-21","L1-28","L202X3","G89-5","L1-40","NP12-X70","GX59-51","NP13-1963","NP23-X2282","NP13-1976","GX88-13","NP23-2662","NP101X3","M101X1","G36-7","G64-34","G34-32","N27","NP13-1978","M130X1","M130X3","G104-5P40","G9-P3","LN6-2","NP12-X76","M18-12","G30-CP1","G66-42","G59-20","G59-30","M19-14","M17-13","L12","M17-14","M19-13","M19-16","G76-70","M19-18","M27-35","MB-P1","MB-P8","G59-P5","G60-27","G61-32-1","G61-33","NP13-X1022","G78-P20","G79-1","G79-2","L9-15","G165X1","G18-22","L102-P3","LB-P3","G91","G91-1","LN1-3","G91-10","G91-12","LN1-6CP1","G37X3","G54-16-1CP1","LN1-8","G55-10","LB1-13-13","G29-11","NP1-85","G63-11","G41-25","G80-32","NP1-86","G41-P1","G41-P2","G63-12","G75-21","G5-52","G63-9","NP13-1056","G5-68","LN8-3","G23-48","G63-8","G5-34","L10-5","G123X9","NP13-1155","NP13-1158","G104-5P1","G104-5P128","G104-5P54","G23-22","NP13-1162","L102X4","L13X1","G3102","L7-12","G104-5P5","LN5-6","L17-1","NP23-2616","L16-11","L29","NP23-X2302","NP13-1284","G56-32","G109-5CP1","G27X1","NP11-502","G104-5P116","NP13-X1256","NP1-3X315","M23-11","NP11-504","NP1-3X512","NP13-X1276","M25-13","M25-16","LB1-19-16","G28-7","NP102X12","NP102X13","M23-6","NP13-X1702","NP41-X4556","NP11-518","G104-5P35","M25-3","NP13-X1902","G139X1","NP13-X1904","M126X2","NP118","NP13-X1906","G62-32","XL2","NP12-X88","NP12-X92","NP13-X1030","G76-77","NP41-4110","NP12-X94","C2-P5","NP41-4116","NP13-X1032","G66-41","C3X1","G75-9","NP401X33","NP41-4101","NP2-38","LB1-19-4","T19-12","G104-5P105","G66-32","C2-P6","M190X1","M190-P1","NP13-X1040","L17-6","M190-P2","T19","NP11-26","NP13-X1042","NP41-4138","L23-14","NP12-X805","LB2-7","M110X1","NP13-X1068","M110X2","G69-11","L19-1","M26-26","L20-1","G69-13","M27-11","NP41-X4522","L90-10","NP13-X1072","NP41-X4528","G51-15-1","NP12-X808","NP13-X1077","G62-22","LB1-15-20","NP41-X4532","GX10-1","NP11-230","L21-5","L21-P2","G160-P11","NP41-X4537","NP11-256","NP13-X1134","G93","NP11-260","M27-19","NP41-X4542","G69-14","L25-5","NP13-X1180","L25-P3","NP11-266","LN2-3","M170X2","MX27-15","L1-1","L1-19","G76","G62-34","G98-16","LB-P4","NP13-X1050","LB-P7","G6","L2-15","NP41-4139","M2X1","G12-11","G75-1","M23-9","NP13-X1907","G94-52","L25-14","G66-44","NP118-212","NP102X16","L25-18","M28-6","NP41-X4557","NP102X19","G104-5P120","M28-P1","G104-5P4","G104-5P69","M25-26","LB2-17-13","G104-5P78CP1","M106X1","G10-1","G104-5P71","G115-8","NP32-P3202","NP509","NP526X1","G59-17","G12-9","G60-37","G60-39","G12-23","L25-P1","M125-P11","L2","GX12-33","G3103","G104-5P3","L124X1","NP13-X1188","NP102X9","M28-9CP1","M25","G62-30","NP13-X1196","NP11-316","G63-31","NP1-24","G64-26","G104-5P132","G66-28","NP1-32C1","NP13-X1626","G98-10","NP103X1","M23-5","MC25-15","M125X2","NP11-510","NP103X18","NP102X15","G14","M25-5","NP116X1","NP11-535","G104-5P92","LN3-3P1","NP11-606","G115-5","LN3-3P3","LN6-1","NP11-H8-P16","G117-5","NP11-J17-P18","NPX1-29","G119-5","LPN1","NP1-5","NP1-5X1070","NP1-5X1072","NP1-5X1114","NP1-5X1150","NP42-4130","NP1-29P69","G16","NP1-29X90","G76-47","NP1-P2","G321-1","NP1-4A2-P3","M113X1","NP13-X1063","M11-12","M11-13","LB2-3","M11-8","NP41-X4514","L23-P3","G69-27","M26-24","G59-29","NP41-X4517","M30-16","L17-28","G104-5CP11","NP102X6","G104-5CP9","M30-9","NP1-3","M125-P4","NP1-4C1","M125-P5","NP1-15","M136X1","NPC1-19","M25X1","NP1-17","M136X2","NP1-23","G50","L2-41","L24","NP103X5","G104-5P127","L24X1","L24-6","NP11-506","G104-5P130","NP13-X1908","G98-17","NP118X1","M28-15","NP13-X1910","NP11-530","G104-5P66","M28-P3","M36X1","NP11J2-P9","NP41-X4558","XGC1","M28-P7","G66-51","LB2-19-15","NP1-5X1002","NP1-5X1060","NP11-P111","G119-6","MC23-7-1","M30-4","M10X1","NP1-29","G76-95","M150X1CP1","G12-42","NP1-29X95","NP1-29X97","G78-12","M106X8","NP1-29X108","NP1-29X110","M36-p4","NP1-29X112","NP100X2","NP100X3","M5","NP102X1","G519-5","M101-P13","G12-33","G56-46","M103X1","M28-23","L17-21","NP42-4150","M28-24","M103X2","L201","M17-16","M17-17","M28-26","M28X2CP1","NP3-80","G76-98","NP32-3211","NP1-4B15-P5","NP1-4P6","G59-22","G59-26","M30-50","NP32-3213","NP32-3216","NP1-4A15-P251","NP32-3217","G91-5","NP1-4P335","NP13-1286","G111-6","G59-53","L10","NP23-X2217","NP12-68","NP12-82","NP23-X2422","NP23-2606","G28-26","G78-P1","NP23-2615","G29-17","G88-10","G29-18","NP23-2617","G88-11","G29-19","NP23-2307","G29-20","NP23-2310","NP23-2312","NP13-1606","L90-11","G29-14","L90-31","NP23-2634","L1-5","NP12-282","L90-24","LS-11","G183X1","G160-P8","NP23-2642","L90-62","NP23-2704","L90-65","NP23-X2215","NP23-P2205","NP12-X67","NP23-P2206","G76-62","NP23-X2219","L1-3","G76-63","NP23-X2264","NP1-35","G180X9","L1-30","G36-6","G65-35","M118X1","G65-37","NP23-X2229","G9-P1","M130X6","NP101X6","L1-41","G66-36","M17-15","NP101X10","G70-34","G58-29","NP11-H16-X18","NP11-C18-X111","L1-15","T108X1","G17-30","G103-1","G104-5CP22","G211-6","B10","G190X1","NP1-22","NP117X2","NP503","NP42-X4320","G60-40","M28-36","NP118X21","NP42-X4322","NP32-3016","L13-16","M28-P12","GC80-22","L15-15","M28-P4","NP4-51","NP4-52","NP13-P1601","M101-P19","G104-5CP10","NP118-P21","G3102-7","M107X1","G121-1","NP118-X12","NP1-P1C1","NP1-4X4CP1","G104-5P60","NP1-P8","NP32-3215","NP1-4B14-P225","G104-5CP13","NP32-3218","NP1-4P351","G104-5CP7","G104-5CP8","NP1-4X34","M8X1","M8X2","G104-5P36","M125X3","G3102-50","G59-P11","G12-3","NP1-4A4-X501","GJ317-6","N70-21","G515-6","N70-20","G517-7","G213-4","G518-6","LN3-24","M38-11","M38-13","G104-5CP15","G56-33","G65-P5","M38X1","NP32-X3040","T71-11","M39X1","G59-43","G166-62","G104-5P88","G66X3","G23-79","G104-5P91CP1","G66X5","G104-15","G104-5CP3","G166X1","G32-25","G104-5P16","N15-8CP1","T18-15","G104-5P10","G104-5P131","M125-P8","NP306X6","G104-5P102","G104-5P39","M25-8","NP43-4833","T105-P7","G104-5P96","G104-5P97","G45-11","G15-13","G45-12","G32-23","NP11-J29-P175","B7","B10X1","B10-11","B12-11","B12X3","GX109-8","B26-P1","B26-P2","B26X1","M125-P3","NP1-1","G32-24","G25X1","G66","N38-P3","G104-7","N15-11","G67-1","G15-44","G81-1","G104-5P107","T18-8","G104-5P122","NP4-65","NP4-66","NP4-86","NP43-4704","NP43-4801","NP43-4802","G160-P1","G160-P3","G160-P4","G104-5P2","NP43-4803","T105-P13","G160-P5","G104-5P37","T105-P5","G104-5P93","G45-16","NP43-4932","M7","M7X1","T18-P1","GX105-6","NP43-4942","G56-31","G58-32","G58-33","G3104","NP32-3220","NP32-3222","NP32-3224","NP32-3226","NP32-3228","G59-18","NP32-3230","NP32-3626","NP32-3646","NP13-P1656","G59-24","NP32-3656","G56-62","NP32-3708","G59-54","NP32-3710","NP1-4B13-X38","NP32-3712","NP1-4X81","NP32-P3201","NP13-P1658","G60-32","G76-P3","G17-41","G59-11","NP11-A25-X115","G17-15","LN3-19","T170X1","L168X1","NP32-X3033","M38-17","G104-5CP14","NP43-4864","G104-5P95","G19","N22","G22","G23-35","NP306X3","NP36-3803","NP36-3804","NP36-3806","NP36-3601","NP36-3602","NP36-3604","NP36-3606","NP36-3620","NP36-3622","NP43-P4001","G24-P6","N15-26","G29X1","G3101","G104-5P124","G104-5P125","G23-23","L101X2","NP23-P2016","NPX206","G104-5P68","L102X7","G23-32","L102-P1","G29-10","NP23-X2104","L90-92","NP23-X2306","NP23-X2216","L90-66","NP23-X2248","L2-36","L90-69","NP13-1932","NP23-X2262","NP23-P2111","L1-11","G37X6","G88-9","NP23-X2406","L1-18","G97-4","G3","G104-5P79","NP13-1942","LN3-10","G98-31","G80-26","G6X1","LB-P8","NP11-128","NP13-X1058","LB1-11","G75","NP41-4201","G75-13","NP13-X1061","LB1-15","G75-2","NP13-X1062","NP41-4202","G6-P1","LB1-27","L1-51","L123X2","G94-1","L18","M25-24","G65-7","G65-P1","G69-16","G69-19","G180X6","LB2-11","G193X1","G94-11","M11-1","G94-22","NP12-X802","G160-10","G58-28","M117X1","L35-3","M38-21","M6X1","T71-17","T71-19","G65-P6","T71-12","NP32-X3034","G65-P3","NP32-X3038","M39X2","M39-3","T71-15","M39-5","G56-34","G146X1","NP32-X3106","G101-3","N15-23","G83-10CP1","G104-5P47","L202X2","M125-P13","L202-33","G104-5P51","G215-4CP2","NP1-29X93","M25-25","G36-8","M36-P1","NP1-29X98","G12-31","M30","NP105X1","G66-62","LN6-5","MC10","LB2-9","M101-P16","L125X1","M101-P1CP1","M101-P2","G12","G59-14","M101-P21","M101-P4","NP3-27","G59-37-1","L25-11","M27-26","M101-P22","G78-14","M101-P5CP1","M28X1","M101-P7","G80-80","M17-18","M28-38","NP32-3108","G88-12","M28-P14","G56-61","L17-19","G76-79","LB1-15-17","LB1-19","G104-5P83","LB1-21","NP4-56","LB2-15-14","G62-40","LB2-15-15","NP118X23","G13-11","G64-38","M28-P5","M36-P3","LC13-14","NP118-X216","G36-P5","G104-5P50","NP1-4A14-X317","G12-12","G12-2","G10","G60-35","NP1-4X584","G101-2","GX106-6","NP43-4948","NP11-221","L13-19","G64-31","M27-18","M170X1","NP13-X1165","L118X1","M17-3","NP11-268","M109X1","L18-P1","G98-24","M24X2","G98-27","M123X1","G98-28","LN3-12","M28-14","LB2-17-15","LB2-17-9","M35-6","NP32-X3019","NP11-X228","NP11-X252","G166-51","M125-P12","NP11-H3-X254","G17-18","G98-26","NP11-X258","G166-64","NP11-X35C1","M16-P1","NP32-X3027","G166-65","G17-40","L202-6","G140X1","NP4-31","T18-P2","NP43-4812","G29-22","G80-24","G104-5P77","G34-36","G91-4","NP1-89","LB2-23","G5-P4","GC35-3","NP13-1076","G81","LN2-8","LN3-1","G23-54","NP13-1086","LN3-2","G5-P2","G63-P11","LN3-6","G94-6","G63-P4","G104-5P76","G104-4","LN3-8","G63-P5","G63-P7","NP23-P2013","G70-1","G72-1","G74-1","L1-12","G104-5P117","NP23-P2003","G98-21","L16X1","L16-3","NP13-1130","G104-5P17","LN5-5","NP13-1132","G104-5P19","NP23-P2005","G104-5P20CP1","G104-5P28","G104-5P31","NP23-P2010","NP43-4950","T37-P1","NP43-X4826","NP43-X4828","N15-21","NP43-X4830","NP43-X4832","G22-10","NP43-X4834","G24","PG2","NP36-3802","NP36-3610","NP36-3612","G24-P4","NP36-3616","NP36-3624","NP36-3634","NP36-3650","NP36-3652","NP36-3653","NP36-3660","NP36-3706","NP36-P3001","NP36-P3002","G24-P5","N38-3","G24-P7","N38-5","N15-12","N15-25","N38-P11","G209-5","G59X1","T105-P2","T180X2","T18-10","T18-11","T18-12","N36-11","T31X1","T2X1","T2-14","T2-15","T2-18","T2-19","T2-P1","T30X1","T11-13","N29","N36","T29X1","G29-8","��1","G76-6","T29-12","T29-14","G59-10","G59-12CP1","G104-5P56","G59-19","G32-17","T109X1","G109-9","G114-6","G166-53","G59-P3","N15-28","G102-3","G211-7","N15-16CP1","G104-5P38","G104-5P42","G3104-5","G104-5P49","G211-8","G104-5P53","NP5-10","NP5-11","NP511","B2","B5","B6X1","G3105","B12X1","B13","B16","G104-5P32","L1-42","L18-10","G5-64","G104-5P33","G108-5","L18-16","L18-17","G94-40","L90-27","G104-5P7","L18-18","LN5-8","NP43-4835","G29-P4","G104-5P90","NP43-4836","NP23-2425","L18-19","LN5-9","NP23-X2412","L18-3","L18-33","NP12-42","NP2-3","NP23-X2103","NP12-46","NP23-X2105","LN8-5","L180X2","NP203X1","NP12-48","NP13-1278","NP23-X2110","L2-10","L2-11","G55-27","LN6-3","NP13-X1006","NP4-25","G7-5","NP13-X1074","M27-13","NP11-225","M17-21","G62-24","GJ69-29","LB1-5","L21-1","M27-14","G94-21","GX94-1","NP41-X4536","G160X5","M27-16","L21-10","NP11-233","NP11-234","G93-10","L25-8","NP13-X1186","LN10-2","G94-13","G76-93","M25-P1","L23-P8","NP11-276","M24-13","NP41-X4544","G76-78","L1-16","NP11-X116","L1-32","NP11-X118","NP11-F11-X218","NP11-X22","M135X1","N38-10","G160-P13","G8X1","G92","LB1-17","G97-6","G29-15","G59-P2","NP1-26","G59-P4","G34-38","N15-15","B26-2","B26-4","G66X1","B26-5","B26-6","B26-8","BS28","G180X5","B26-P5","NP1-37","NP101","GJ315-7","NP117X1","N38-P1","L9","G104-5","G104-5CP17","T18-P4","G104-5P21","G87X2","M125-P6","N21","G85-55","M125-P7","G140X6","G145X1","G104-5P104","N38X1","G160-P6","NP43-4804","T105-P4","G104-5P34","G119-7","G110X1","G94-7","G98-14","M125-P1","L25-9","G10-3","G104-5CP21","L2-18","NP11-A1-P151","G28-10","NP11-A26-P152","G104-5P57","L1-6","G104-5P98","NP11-X121","NP11-D17-X122","L10-3","G111-4","NP11-X123","G104-5CP20","NP11-D1-X125","NP11-X129","G104-5P41","NP32-X3012","NP11-X130","G113-4","L35-1","L35-2","L90-23","L90-26","G104-5P61","G104-5P63CP1","NP11-L8-X204","L90-8","NP32-X3015","G13-13","NP11-C9-X205","NP11-B17-X208","NP11-X217","NP32-X3018","G166-63","LX90-20","M16X3","NP32-X3026","NP11-B45-X503","NP11-E4-X508","NP11-X522","N70-P1","NP11-X526","G17-22","G17-24","T70-16","L3X2","L3X3","T70-18","T70X2","G60-41","N15-27","N38-P2","N38-P5","T106X1","T138X2","N8","T105-P1","N36-CP1","N80-1CP1","N80-2CP1","T129X1CP1","T2X2","T2X3","T158X1","T158X3","T2-17","N16","T9X1","M12","T29-17","G3102-21","G11","T20-10","G108-7","T20-12","T20-14","T20-16","T20-11","M38-22","M60X2","T158X2","TC18-16","G40X2","G63-10","G41-17","G5-78","LB1-25","LB1-31","G98-13","G32-11","G32-33","G32-21","G34-26","G104-5P121","LB2-21-3","G104-5P58","G5-70","G104-5P80","G23-49","NP13-1060","G104-5P94","G23-57","G163X3","LBJ1-24","G55-29","G76-51","G56-20-1","G17-17","G63-15","G63-19","G76-52","G63-32","G104-5P133","G104-5P11","G63-P1","G63-P10","G104-5CP27","G104-5P111","LX19-17","G63-P17","G94-5","G94-51","G104-5P112","G104-5P115","G63-P2","G63-P3","NP13-1092","G120-P1CP1","G104-5P103","G63-P6","NP13-1094","G123X2","NP13-1096","NP13-1151","LC101X1","L90-P2","LN1-7","G315-6","NP32-X3102","T71-18","G58-34","G58-36","NP11-X23","N38-P6","LIN1X1","T18-30","T28-20","T60X2","N36-10","T129X2","T105-P3C1","TC18-13","TC180X3","T29-11","T18-32","TC20X2","G34-28","G28-24","M25-6","G160-P9","G160-P10","NP43-4838","T105-P8","NP43-4840","G104-6CP2","G105-1","G45-10","T105-P9","G106-5CP1","G107-5","NP43-4842","T137X1","G107-6","NP43-4856","G15-10","G45-13","NP43-4860","G15-18","G15-21","NP43-4862","G45-14","G45-15","G15-22","MX17-16","G45-20","NP43-4936","G45-26","G45-28","G17-P2","G207-4","NP43-4940","NP43-4946","NP43-P4003","NP43-X4806","T28-15","T37X1","NP43-X4811","NP43-X4816","G24-3","NP306X2","L1-36","L11-1","LN3-4","L1-P1","L111X1","LN3-5","L90-37","L17","G23-30","L16-14","LN5-7","G37-14","NP13-1332","G28-25","G55-18","G60-21","G60-23","G76-14","G213-5","L29-3","G76-16","L90-1","NP286","G88-2","NP13-1505","NP23-2623","NP23-2626","NP13-1508","NP23-P2001","L33X1","NP23-2308","G15-32","L90-13","G213-6","G29-13","L90-32","L90-33","L90-21","NP23-2650","NP13-1618","NP23-X2102","L2-13","L90-90","LN8-4","NP23-X2474","NP13-1264","L18-37","NP23-2614","NP13-1274","G95-12","NP23-2658","L18-6","NP23-X2109","NP13-1280","G55-22","NP12-49","G3102-3","NP23-X2430","NP13-1294","G15-12","NP12-160","L25-10","G59-59","NP23-X2320","G180X1","NP206","NP23-X2223","L90-16","NP280","G180X2","NP23-X2236","NP2-82","L90-19","L90-20","G16-10","NP23-X2411","NP23-X2249","L25-19","NP23-X2420","G30-27","G31","NP23-2113","L25-20","G80-33","NP23-2115","G149X1","NP23-X2426","L90-22","G80-35","L25-22","L90-25","L25-23","G80-37","G129X2","G17-19","G80-40","NP12-170","L90-5","L1-10","NP13-1501","NP12-818","NP23-P2203","G513-4","NP13-1940","LN3-13","G3102-32","LN3-14","G3102-33","G37-5","NP23-X2404","LC18-1","L1-13","NP203X16","L1-14","G97-2","NP23-X2408","G55-19","G160-22","G129X1","G160-23","G160-3","NP23-2116","G197X1","NP12-822","G29-12","NP4-11","NP4-12","G191X1","NP23-2605","G2-1","G3102-23","L1-26","NP12-X63","NP23-2607","NP13-1950","G3102-4","NP23-2630","NP23-2628","L90-71","G32-10","G3102-5","NP23-2632","NP23-2648","LN3-15","G76-39","G98-29","NP23-P2008","NP12-X74","G13-12","G36-P2","NP12-X77","G94-8","G56-52","M18-14","G57","G66-56","NP13-X1004","M17-7","G36-33","M18-13","NP13-X1026","G61-35-1","NP401X5","G61-37-1","L12-P1","G62-31","G66-30","L202X1","LX90-26","L23-2","NP401X6","NP13-X1028","NP13-X1928","NP13-X1917","NP13-X1931","NP13-1620","NP13-X1938","NP13-1330","NP13-1616","NP105X5","NP13-X1020","NP13-X1017","G104-5P44","G3104X6","T171X3","L15-25","G104-5P48","L158X1","G3104-1","NP101X18","NP13-1142","NP13-X1036","NP13-X1052","NP13-1336","NP13-X1925","G76-53","G104-5P87","G78-P10","G76-38","G76-46","G5-60","C2-P4","L13-15","L102","L15-18","L17-16","L102X5","L17-17","G9","G78-P15","LN2-5","G91-3","G135X6","G92-2","G29-23","G35-2","G36-P1","G36-P3","G36-P4","G76-10","G76-11","G76-22","G59-P10","LN2-6","G55-28","G37-8","NP1-83","G41-19","G43-21","G45X1","LB1-18","G63-16","G75-23","LB1-19-14","G32-15","G63-20","LB1-19-18","G75-25","G75-27","G75-5","G75-6","G75-7","G32-13","G98-12","LB1-33","G32-28","G65-P2","G32-19","G104-5P113","NP13-1016","LB1-35","G32-30","G104-5P118","G163X2","LN5-11","G7-6","G7-P1","G7-P2","G80-12","NP23-P2002","NP13-1098","G98-19","L1-2","GX308-4","L1-21","L16-5","NP23-P2004","G104-5P9","L16X8","LN5-3","L1-22","L16-9","NP23-P2006","G104-5P25","G163X1","G5-48","G104-5P46","G63-30","NP23-2603","NP23-X2263","L1-34","G76-P4","NP23-X2407","NP101X2","G36","C2X1","NP13-1974","M101","NP101X5","NP12-X71","G76-80","C2-P1","G9-P2","NP12-X72","NP13-X1002","NP41-4128","L17-5","G67-33","M19X2","M190X2","G102-1","M2","L150X1","NP13-X1048","L17-7","G94-10CP1","LB1-37","G94-2","L18-11","NP13-X1064","L18-15","G93-12","G6-P2","G93-3","NP41-X4504","G65-1","NP13-X1066","LB1-9","NP41-X4509","G43-1","NP41-X4512","NP12-X106","M11","LB2-13","G69-20","M26-23CP1","M11-10","G69-21","NP12-X168","LB2-21-1","L180X1","LB2-21-2","NP13-X1067","G69-31","M101-P24","NP11-272","M128X2","L23-P1","M24","NP32-P3203","G104-5CP5","NP11-C1-X206","G17-10","NP11-C16-X215","NP32-X3020","G17-16","G104-5P64","NP32-X3021","NP32-X3022","G104-5P82","G115-6","NP11-F4-X232","NP32-X3023","G166-40","G166-42","M16-6","M16X1","NP32-X3029","N70X1","G104-5P52","N70-12","G104-5P65","M160X6","M38-10","G17-23","N72-12","L3-1","L3-12","N72-13","G17-32","G104-5P70","G104-5P72","G104-5P73","G104-5P75CP1","NP32-X3031","G104-5P100","T171X1","M141X1","T71X3","M41X1","NP32-X3210","G29-24","M7-P1","NP32-X3212","T71X2","M7-P2","G56-36","NP32-X3214","T20X1","N15-22","T71-22","G56-42","G81-4","G56-55","M125-P2","G102-2","G59-41","G104-5P62","G59-42","N15-13","G104-5P106CP1","G55-20","LB1-23","G75-3","G24-30","LB1-26","G26","NP13-1015","LB1-29","L160X1","NP23-P2009","NP13-1138","G5-74","G104-5P30","LN8-1","G63-P8","L109X3","L1-45","G63-5","NP13-1154","G63X1","L10-7","GC63","L101-8","G206-4","NP13-1166","G208-4","G21X1","G15-19","L13","NP23-P2501","G5-14","G5-20","L9-12","G104-5P43","G104-5P109","LB1-15-13","L102-P5","G94-63","M28-16","M130X5","M18-21","L17-12","G89","M30-11","M26-27","M27-27","NP11-301","NP102X3","M2-3","G123-1","NP105X8","G12-20","NP105X12","G104-5P8","G3103X1","NP32-X3017","L28-12","L103-P1","L28-2","L10-2","G36-36","G63-7","G5-10","LB3-9-13","G104-5P45","G104-5P108","G5-22","L102-P2","G5-32","L102-P4","G5-36","G104-5P6","L103","L103X1","G5-40","L27","L28-13","G104-5P99","G2-2","L2-17","NP12-52","G3102-30","NP23-X2203","NP13-1282","GC29","NP23-X2401","L30-1","G3102-51","NP12-86","GX10-3CP1","NP23-2106","NP23-X2222","NP23-X2421","NP23-X2424","NP23-2613","L25-6","G28X3","G59-P8","NP12-173","G17-26","G55-21","G76-61","NP12-X59","G92-3","G97-1","G29-P2","G94-9","G59-31-1CP1","M19-15","G59-32","NP13-X1011","LN6-4","NP23-X2402","G59-36","G104-5P85","G59-38","GC63-37-1","M28-19","L28-6","G23-53","G131X1","NP13-1168","L127X2","L1-35","NP13-1170","NP13-1260","L1-P2","L16-P1","LN5-1","L18-31","L12-4","LN5-13","L12-6","LN5-14","LN5-17","L28-1","L90-29","G78-10","G23-29","L90-38","LN5-18","NP13-1262","L29-2",);
$JINGHAO_WATER_ARRAY=array("B26-3","B28","B28X2","G10-11","G10-2","G102-4","G104-1","G104-2","G104-3","G104-5CP1","G104-5CP12","G104-5CP4","G104-5P119","G104-5P12","G104-5P13","G104-5P23","G104-5P26","G104-5P27","G104-5P29","G104-5P55","G104-5P86","G105-7","G106-7","G107-10","G107-7","G108-6","G109-10","G109-7","G111-10","G111-5","G111-7","G111-9","G113-6","G113-8","G113-9","G115-7","G115-9","G117-7","G117-8","G117-9","G119-3","G119-4","G119-8","G12-10","G12-13","G12-21","G12-24","G12-32","G12-43","G120-1","G121-5","G123-6","G123-7","G13","G138X1","G15-11","G15-14","G15-16","G15-20","G15-42","G15-43","G156X1","G16-20","G160X8","G166-41","G166-43","G166-52","G17","G17-11","G17-14","G17-2","G17-25","G17-29","G17-31","G17-42","G17-9","G170X1","G179X1","G180-11","G2","G215-5","G217-6","G217-7","G219-6","G22-26","G23-43","G23-52","G24-24","G26-24","G28-27","G28-28","G29-2","G29-9","G29-P1","G29X6","G30-26","G30-29","G30-30","G3101-2","G3102-1","G3102-10","G3102-16","G3102-18","G3102-2","G3102-22","G3102-42","G3102-9","G3106","G315-5","G32","G32-14","G32-16","G32-20","G32-27","G32-32","G32-34","G32-5","G36-32","G36-34","G36-35","G37-2","G37-9","G41-21","G43-19","G43-23","G45-21","G45-23","G47-21","G49","G49-21","G49-23","G49-25","G5","G5-24","G5-88","G51-27","G51-29","G51-31","G514-6","G516-6","G516-7","G53-27","G54-18-1","G55-19-1","G56-34-1","G57-35-1","G58-30","G59-25-1","G59-28","G59-35-1","G59-47","G59-5","G59-52","G59-55","G59-57","G59-7","G59-9","G5X1","G60-24","G60-28","G60-30","G60-38","G62-26","G62-33","G62-36","G62-38","G62-P1","G62-P2","G63-13","G63-25","G63-29","G63-P9","G64-28","G64-36","G64-36-2","G64-39","G65","G65-2","G65-4","G65-5","G65-6","G66-38","G66-40","G66-43","G66-52","G66-54","G66-55","G66-57","G66-63","G66-64","G67-34-1","G68-30","G68-32","G75-26","G75-4","G75-8","G76-1","G76-12","G76-15","G76-2","G76-23","G76-24","G76-25","G76-28","G76-30","G76-31","G76-33","G76-35","G76-43","G76-45","G76-60","G76-73","G76-81","G76-82","G76-83","G76-84","G76-85","G76-86","G76-90","G76-91","G76-92","G76-94","G77","G78","G78-13","G85-65","G88","G88-1","G88-13","G88-3","G88-5","G88-7","G88-8","G89-3","G89-4","G9-1","G93-2","G94","G94-12","G94-23","G94-32","G94-4","G94-41","G94-44","G94-53","G94-62","G95-1","G95-2","G97-3","G98-11","G98-15","G98-23","G98-25","G98-42","G99-3","GC37","GJ3102-8","GJ5-44","GJ514-5","GX108-6","GX110-7","GX16","GX17-2","GX7-3","GX93-1","L1","L1-17","L1-23","L1-25","L1-37","L1-38","L1-39","L1-4","L1-43","L1-44","L1-48","L1-7","L1-8","L10-1","L10-4","L102X1","L103X4","L11","L11-12","L11-14","L11-16","L11-21","L11-3","L116X1","L116X2","L12-1","L12-2","L12-3","L123X1","L13-12","L13-13","L13-17","L13-18","L13-20","L13-21","L13-25","L130X2","L140X1","L15","L15-12","L15-14","L15-16","L15-19","L15-21","L15-23","L15-8","L16","L16-10","L16-12","L16-15","L16-18","L16-2","L17-14","L17-18","L17-2","L17-22","L17-23","L17-26","L17-9","L18-27","L18-30","L18-5","L18-7","L19-14","L2-14","L2-16","L2-20","L2-25","L2-26","L2-50","L2-51","L21-101","L21-3","L23-4","L25-12","L25-13","L25-16","L25-24","L25-26","L25-30","L25-7","L26","L26-1","L27-2","L27X6","L28-10","L28-11","L28-3","L28-4","L28-7","L31","L31X4","L35X4","L9-14","L90","L90-12","L90-14","L90-15","L90-2","L90-28","L90-3","L90-35","L90-36","L90-39","L90-4","L90-40","L90-42","L90-43","L90-44","L90-45","L90-58","L90-67","L90-68","L90-7","L90-72","L90-74","L90-77","L90-9","LB1-12","LB1-13-14","LB1-14","LB1-15-10","LB1-15-22","LB1-15-4","LB1-16","LB1-17-20","LB1-17-6","LB1-17-8","LB1-19-12","LB1-19-20","LB1-20","LB1-22","LB1-28","LB1-30","LB1-4","LB1-6","LB1-8","LB2-10","LB2-12","LB2-13-19","LB2-17-11","LB2-19-13","LB2-2","LB2-21-4","LB2-21-5","LB2-4","LB2-5","LB2-6","LB2-8","LB3-7-10","LB3-9-11","LBJ1-10","LC19-21","LN1-1","LN1-5","LN3-16","LN3-17","LN3-18","LN3-22","LN3-3","LN5-10","LN5-12","LN5-4","LX1-3","LX11-14","LX16-7","LX17-22","LX19-14","LX90-30","M125-P10","M125X1","M18-16","M18-18","M19-19","M23-P1","M23-P2","M25-17","M25-23","M25-7","M25-9","M28-4","M30-3","M30-5","M30-6","M5X1","MB-P6","MC129X1","N138X3","N15-29","N38","N38-12","N38-13","N38-17","NP1-29X118","NP1-29X89","NP1-29X91","NP1-29X96","NP1-29X99","NP1-3X36","NP1-3X451","NP1-4A13-X322","NP1-4A3-P238","NP1-4B1-P321","NP1-4B12-X155","NP1-4B3-X151","NP1-4P352","NP1-4P453C1","NP1-4X201","NP1-P4C1","NP103X3","NP105X2","NP11-219","NP11-223","NP11-227","NP11-237","NP11-239","NP11-246","NP11-248","NP11-262","NP11-270","NP11-302","NP11-304","NP11-517","NP11-B3-X308","NP11-E27-X226","NP11-H24-X37","NP11-H30-X13","NP11-K18-X307","NP11-L12-X209","NP11-X112","NP11-X127","NP11-X132","NP118-X3","NP118-X32","NP118-X5","NP118-X52","NP118-X6","NP12-163","NP12-166","NP12-50","NP12-53","NP12-55","NP12-56","NP12-807","NP12-81","NP12-X61","NP12-X64","NP12-X66","NP12-X73","NP12-X75","NP12-X80","NP12-X803","NP12-X812","NP12-X83","NP12-X84","NP12-X85","NP13-1070","NP13-1114","NP13-1152","NP13-1156","NP13-1292","NP13-1321","NP13-1323","NP13-1502","NP13-1503","NP13-1507","NP13-1513","NP13-1926","NP13-1930","NP13-1933","NP13-1937","NP13-X1001","NP13-X1003","NP13-X1007","NP13-X1009","NP13-X1013","NP13-X1025","NP13-X1027","NP13-X1033","NP13-X1034","NP13-X1035","NP13-X1037","NP13-X1039","NP13-X1041","NP13-X1043","NP13-X1046","NP13-X1054","NP13-X1055","NP13-X1078","NP13-X1088","NP13-X1102","NP13-X1118","NP13-X1150","NP13-X1169","NP13-X1178","NP13-X1183","NP13-X1191","NP13-X1257","NP13-X1258","NP13-X1901","NP13-X1905","NP13-X1912","NP13-X1916","NP13-X1918","NP13-X1922","NP13-X1927","NP13-X1936","NP203X2","NP23-2601","NP23-2604","NP23-2608","NP23-2610","NP23-2611","NP23-2612","NP23-2619","NP23-2621","NP23-2622","NP23-2636","NP23-2638","NP23-2646","NP23-2647","NP23-2654","NP23-X2206","NP23-X2210","NP23-X2213","NP23-X2214","NP23-X2220","NP23-X2296","NP23-X2298","NP23-X2301","NP23-X2303","NP23-X2305","NP23-X2405","NP23-X2417","NP23-X2418","NP23-X2423","NP23-X2428","NP23-X2436","NP23-X2448","NP3-26","NP306X1","NP306X9","NP32-3632","NP32-3640","NP32-3644","NP32-X3014","NP32-X3025","NP32-X3028","NP32-X3036","NP36-3003","NP36-3608","NP36-3613","NP36-3618","NP36-3654","NP36-3659","NP36-3701","NP36-3702","NP36-3801","NP4-53","NP403X1","NP41-X4502","NP41-X4503","NP41-X4506","NP41-X4510","NP41-X4539","NP41-X4548","NP41-X4553","NP41-X4559","NP41-X4595","NP43-4823","NP43-4829","NP43-4849","NP43-4850","NP43-4941","NP43-4943","NP43-4945","NP43-P4002","NP43-X4808","NP43-X4813","NP43-X4814","NP43-X4815","NP43-X4817","NP43-X4818","NP43-X4819","NP43-X4820","NP43-X4821","NP43-X4824","NP43-X4841","NP43-X4988","NPX1-5","NPX106","PG1","T105-P6","T2-13","T28-13","T28-16","T28-17","T28-19","T37-3",);

?>