<?php

// 连接数据库，创建数据表
function connect_db(){
	$sdn="mysql:host=".DB_HOST.";port=".DB_PORT.";dbname=".DB_NAME;
	try {
		$conn=new PDO ($sdn,DB_USER,DB_PASSWORD);
	} catch (PDOException $e) {
		echo "数据库连接失败，请检查config.php文件内的配置数据。<br>
		错误信息：" . $e->getMessage();
	}
	// note 设置 utf8 ，否则中文会全显示成问号
	$conn->query("set names utf8");
	if(isset($conn)){
		// note 字段名不能用中文（但是在 phpmyadmin 里面正常）
		$query="create table if not exists ".DB_TABLE_daily_data." (".
			"RiQi date not null,"./*日期*/
			"JingHao varchar(50) not null,"./*井号*/
			"BanZu varchar(10),"./*班组*/
			"MuQianJingBie varchar(50),"./*目前井别*/
			"QuKuaiDanYuan varchar(100),"./*区块单元*/
			"KaiCaiCengWei varchar(100),"./*开采层位*/
			"ChongCheng varchar(50),"./*冲程*/
			"ChongCi varchar(50),"./*冲次*/
			"YouZui varchar(50),"./*油嘴*/
			"ShangXingDianLiu float,"./*上行电流*/
			"XiaXingDianLiu float,"./*下行电流*/
			"PingHengLv float,"./*平衡率*/
			"ShengChanShiJian varchar(10),"./*生产时间*/
			"BengJing float,"./*泵径*/
			"BengShen float,"./*泵深*/
			"YeMianShiJian float,"./*液面时间*/
			"YeMian varchar(50),"./*液面*/
			"ChenMoDu float,"./*沉没度*/
			"LiLunPaiLiang float,"./*理论排量*/
			"BengXiao varchar(50),"./*泵效*/
			"YouYa float,"./*油压*/
			"TaoYa float,"./*套压*/
			"HuiYa float,"./*回压*/
			"RiChanYe float,"./*日产液*/
			"RiChanYou float,"./*日产油*/
			"RiChanQi float,"./*日产气*/
			"HanShui float,"./*含水*/
			"BeiZhu varchar(255),"./*备注*/
			"primary key (RiQi,JingHao)) ".
			"default charset utf8;";
		$result=$conn->prepare($query);
		$result->execute();
		return $conn;
	}
}

?>