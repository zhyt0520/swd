<?php
// 数据库连接配置
define("DB_HOST", "localhost");
define("DB_NAME", "swd");
define("DB_PORT", 3306);
define("DB_TABLE_daily_data","daily_data");
define("DB_USER", "swd");
define("DB_PASSWORD", "123456");
// 基本数据变量
$th_array=array("日期","井号","班组","井别","区块","层位","冲程","冲次","油嘴","上行电流","下行电流","平衡率","生产时间","泵径","泵深","液面时间","液面","沉没度","理排","泵效","油压","套压","回压","日产液","日产油","日产气","含水","备注");
$db_field_array=array("RiQi","JingHao","BanZu","MuQianJingBie","QuKuaiDanYuan","KaiCaiCengWei","ChongCheng","ChongCi","YouZui","ShangXingDianLiu","XiaXingDianLiu","PingHengLv","ShengChanShiJian","BengJing","BengShen","YeMianShiJian","YeMian","ChenMoDu","LiLunPaiLiang","BengXiao","YouYa","TaoYa","HuiYa","RiChanYe","RiChanYou","RiChanQi","HanShui","BeiZhu");
?>