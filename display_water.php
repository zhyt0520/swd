<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="display.css">
	<?php require "config.php" ?>
	<?php require "functions.php" ?>
	<?php $conn=connect_db_remote();?>
	<title><?php dis_title() ?></title>
</head>
<body>
	<div id="top">
		<p>水井：<b><?php echo(isset($_REQUEST["jinghao"])?$_REQUEST["jinghao"]:false) ?></b> 生产数据</p>
	</div>
	<div id="left">
		<?php isset($conn)?dis_daily_data($conn):false ?>
	</div>
	<div id="div_tube_rod">
		<?php dis_tube_rod() ?>
	</div>
	<script type="text/javascript" src="jquery-1.11.3.min.js"></script>
	<script type="text/javascript" src="canvasjs.min.js"></script>
	<script type="text/javascript" src="display.js"></script>
</body>
</html>

<?php
// 页面标题title
function dis_title(){
	if(isset($_REQUEST["jinghao"])){
		if(strstr(strtoupper($_REQUEST["jinghao"]),"NP23-")){
			$str_pos=strpos($_REQUEST["jinghao"],"-");
			echo substr(strtoupper($_REQUEST["jinghao"]),$str_pos+1);
		}else{
			echo strtoupper($_REQUEST["jinghao"]);
		}
	}
}

// 页面显示单井日数据表
function dis_daily_data($conn){
	if(isset($_REQUEST["begin_year"],$_REQUEST["begin_month"],$_REQUEST["begin_day"],$_REQUEST["end_year"],$_REQUEST["end_month"],$_REQUEST["end_day"],$_REQUEST["jinghao"],$_REQUEST["field_checkbox_water"])){

		$begin_riqi=$_REQUEST["begin_year"]."-".$_REQUEST["begin_month"]."-".$_REQUEST["begin_day"];
		$end_riqi=$_REQUEST["end_year"]."-".$_REQUEST["end_month"]."-".$_REQUEST["end_day"];
		// 转换日期格式
		$begin_riqi=date_format(date_create($begin_riqi),"d-M-y");
		$end_riqi=date_format(date_create($end_riqi),"d-M-y");

		$jinghao=$_REQUEST["jinghao"];

		$field_checkbox_water=$_REQUEST["field_checkbox_water"];
		// 把字段数组连成一条字符串
		$field_str="";
		foreach ($field_checkbox_water as $value) {
			$field_str.=$value.",";
		}
		// 删除最后多余的一个逗号
		$field_str=substr($field_str,0,strlen($field_str)-1);
		// note 查询输入的字符串需要带引号
		$query="select ".$field_str." from ".DB_TABLE_water_well_data." where RQ>='".$begin_riqi."' and RQ<='".$end_riqi."' and JH='".$jinghao."'";
		$result=$conn->prepare($query);
		$result->execute();
		$res=$result->fetchall(PDO::FETCH_ASSOC);
		// note 返回结果数组的 key 是数据库字段名，区分大小写
		global $FIELD_WATER_ARRAY;
		foreach ($field_checkbox_water as $key) {
			$DB_FIELD_WATER_ARRAY[]=$key;
			$TH_ARRAY[]=$FIELD_WATER_ARRAY[$key];
		}
		$left_th="<tr id='th'>";
		for($i=0;$i<count($TH_ARRAY);$i++){
			$left_th.="<th class='$DB_FIELD_WATER_ARRAY[$i]'>".$TH_ARRAY[$i]."</th>";
		}
		$left_th.="</tr>";
		$left_td="";
		for($i=0;$i<count($res);$i++){
			$left_td.="<tr>";
			for($j=0;$j<count($res[$i]);$j++){
				if($DB_FIELD_WATER_ARRAY[$j]=="RQ"){
					$left_td.="<td class='$DB_FIELD_WATER_ARRAY[$j]'>".date_format(date_create(mb_convert_encoding($res[$i][$DB_FIELD_WATER_ARRAY[$j]],"UTF-8", "GBK")),"Y-m-d")."</td>";
				}else{
					$left_td.="<td class='$DB_FIELD_WATER_ARRAY[$j]'>".mb_convert_encoding($res[$i][$DB_FIELD_WATER_ARRAY[$j]],"UTF-8", "GBK")."</td>";
				}
			}
			$left_td.="</tr>";
		}
		$left_table="<table>".$left_th.$left_td./*$left_sum.*/"</table>";
		echo $left_table; 
	}
}

// 显示管柱图
function dis_tube_rod(){
	if(isset($_REQUEST["jinghao"])){
		$jinghao=strtoupper($_REQUEST["jinghao"]);
		global $JINGHAO_WATER_ARRAY;
		$tube_rod_files=glob("../data/tube_rod/*");
		$is_jinghao_right=false;
		for($i=0;$i<count($JINGHAO_WATER_ARRAY);$i++){
			if($jinghao==$JINGHAO_WATER_ARRAY[$i]){
				$is_jinghao_right=true;
				break;
			}
		}
		$tube_rod_imgs="";
		if($is_jinghao_right){
			for($i=0;$i<count($tube_rod_files);$i++){
				if(strstr($tube_rod_files[$i],$jinghao)){
					$tube_rod_imgs.="<a class='preview' rel='$tube_rod_files[$i]'><img class='tube_rod' src='$tube_rod_files[$i]'/></a>";
				}
			}
			echo $tube_rod_imgs;
		}
	}
}

?>