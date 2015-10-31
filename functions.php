<?php

// 连接数据库，创建数据表
function connect_db(){
	$sdn="mysql:host=".DB_HOST.";port=".DB_PORT.";dbname=".DB_NAME;
	try {
		$conn=new PDO ($sdn,DB_USER,DB_PASSWORD);
	} catch (PDOException $e) {
		echo "数据库连接失败，请检查config.php文件内的配置数据。<br>错误信息：" . $e->getMessage();
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

// display.php 页面显示单井日数据表
function dis_daily_data($conn){
	if(isset($_REQUEST["begin_year"],$_REQUEST["begin_month"],$_REQUEST["begin_day"],$_REQUEST["end_year"],$_REQUEST["end_month"],$_REQUEST["end_day"],$_REQUEST["jinghao"])){
		$begin_riqi=$_REQUEST["begin_year"]."-".$_REQUEST["begin_month"]."-".$_REQUEST["begin_day"];
		$end_riqi=$_REQUEST["end_year"]."-".$_REQUEST["end_month"]."-".$_REQUEST["end_day"];
		$jinghao=$_REQUEST["jinghao"];
		// note 查询输入的字符串需要带引号
		$query="select * from ".DB_TABLE_daily_data." where riqi>='".$begin_riqi."' and riqi<='".$end_riqi."' and jinghao='".$jinghao."';";
		$result=$conn->prepare($query);
		$result->execute();
		$res=$result->fetchall(PDO::FETCH_ASSOC);
		// note 返回结果数组的 key 是数据库字段名，区分大小写
		// $th_array=array("日期","井号","班组","目前井别","区块单元","开采层位","冲程","冲次","油嘴","上行电流","下行电流","平衡率","生产时间","泵径","泵深","液面时间","液面","沉没度","理论排量","泵效","油压","套压","回压","日产液","日产油","日产气","含水","备注");
		// 精简表头文字
		$th_array=array("日期","井号","班组","井别","区块","层位","冲程","冲次","油嘴","上行电流","下行电流","平衡率","生产时间","泵径","泵深","液面时间","液面","沉没度","理排","泵效","油压","套压","回压","日产液","日产油","日产气","含水","备注");
		$db_field_array=array("RiQi","JingHao","BanZu","MuQianJingBie","QuKuaiDanYuan","KaiCaiCengWei","ChongCheng","ChongCi","YouZui","ShangXingDianLiu","XiaXingDianLiu","PingHengLv","ShengChanShiJian","BengJing","BengShen","YeMianShiJian","YeMian","ChenMoDu","LiLunPaiLiang","BengXiao","YouYa","TaoYa","HuiYa","RiChanYe","RiChanYou","RiChanQi","HanShui","BeiZhu");
		$left_th="<tr>";
		for($i=0;$i<count($th_array);$i++){
			$left_th.="<th class='$db_field_array[$i]'>".$th_array[$i]."</th>";
		}
		$left_th.="</tr>";
		$left_td="";
		for($i=0;$i<count($res);$i++){
			$left_td.="<tr>";
			for($j=0;$j<count($res[$i]);$j++){
				$left_td.="<td class='$db_field_array[$j]'>".$res[$i][$db_field_array[$j]]."</td>";
			}
			$left_td.="</tr>";
		}
		$left_table="<table>".$left_th.$left_td."</table>";
		echo $left_table;
	}
}
// index.php 页面显示日期选择部分
function query_form(){
	function single_date_html($prefix){
		$year_array=array(2010,2011,2012,2013,2014,2015,2016);
		$month_array=array(1,2,3,4,5,6,7,8,9,10,11,12);
		$day_array=array(1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31);
		$sele_year="<select name='".$prefix."_year'>";
		for($i=0;$i<count($year_array);$i++){ 
			$sele_year.="<option value=".$year_array[$i].">".$year_array[$i]."</option>";
		}
		$sele_year.="</select>";
		$sele_month="<select name='".$prefix."_month'>";
		for($i=0;$i<count($month_array);$i++){ 
			$sele_month.="<option value=".$month_array[$i].">".$month_array[$i]."</option>";
		}
		$sele_month.="</select>";
		$sele_day="<select name='".$prefix."_day'>";
		for($i=0;$i<count($day_array);$i++){ 
			$sele_day.="<option value=".$day_array[$i].">".$day_array[$i]."</option>";
		}
		$sele_day.="</select>";
		return $sele_year.$sele_month.$sele_day;
	}
	$begin_date=single_date_html("begin");
	$end_date=single_date_html("end");
	echo "<form action='display.php' method='get' target='_blank'>";
	echo "<p>开始时间：".$begin_date."</p>";
	echo "<p>截止时间：".$end_date."</p>";
	echo "<p>井号：<input type='text' name='jinghao' value='np2-3' /></p>
	<input type='submit' value='确定' />";
	echo "</form>";
}

?>