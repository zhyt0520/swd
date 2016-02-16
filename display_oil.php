<!DOCTYPE html>
<?php session_start(); ?>
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
		<p>油井：<b><?php echo(isset($_REQUEST["jinghao"])?$_REQUEST["jinghao"]:false) ?></b> 生产数据</p>
	</div>
	<div id="left">
		<?php isset($conn)?dis_daily_data($conn):false ?>
	</div>
	<div id="right">
		<ul id="tab_ul">
			<li class="tab_head tab_selected" id="tab_1">功图</li>
			<li class="tab_head tab_unselected" id="tab_2">液面</li>
		</ul>
		<div class="tab_content" id="tab_content_1">
			<?php dis_indicator_diagram() ?>
		</div>
		<div class="tab_content" id="tab_content_2">
			<?php dis_liquid_level() ?>
		</div>
	</div>

	<div id="div_tube_rod">
		<div id="div_chart"></div>
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
	if(isset($_REQUEST["begin_year"],$_REQUEST["begin_month"],$_REQUEST["begin_day"],$_REQUEST["end_year"],$_REQUEST["end_month"],$_REQUEST["end_day"],$_REQUEST["jinghao"],$_REQUEST["field_checkbox_oil"])){

		$begin_riqi=$_REQUEST["begin_year"]."-".$_REQUEST["begin_month"]."-".$_REQUEST["begin_day"];
		$end_riqi=$_REQUEST["end_year"]."-".$_REQUEST["end_month"]."-".$_REQUEST["end_day"];
		// 转换日期格式
		$begin_riqi=date_format(date_create($begin_riqi),"d-M-y");
		$end_riqi=date_format(date_create($end_riqi),"d-M-y");

		$jinghao=$_REQUEST["jinghao"];

		$field_checkbox_oil=$_REQUEST["field_checkbox_oil"];
		// 把字段数组连成一条字符串
		$field_str="";
		foreach ($field_checkbox_oil as $value) {
			$field_str.=$value.",";
		}
		// 删除最后多余的一个逗号
		$field_str=substr($field_str,0,strlen($field_str)-1);
		// note 查询输入的字符串需要带引号
		$query="select ".$field_str." from ".DB_TABLE_oil_well_data." where RQ>='".$begin_riqi."' and RQ<='".$end_riqi."' and JH='".$jinghao."'";
		$result=$conn->prepare($query);
		$result->execute();
		$res=$result->fetchall(PDO::FETCH_ASSOC);

		// 把查询结果存入 session
		$_SESSION["res"]=$res;

		// note 返回结果数组的 key 是数据库字段名，区分大小写
		global $FIELD_OIL_ARRAY;
		foreach ($field_checkbox_oil as $key) {
			$DB_FIELD_OIL_ARRAY[]=$key;
			$TH_ARRAY[]=$FIELD_OIL_ARRAY[$key];
		}
		$left_th="<tr id='th'>";
		for($i=0;$i<count($TH_ARRAY);$i++){
			$left_th.="<th class='$DB_FIELD_OIL_ARRAY[$i]'>".$TH_ARRAY[$i]."</th>";
		}
		$left_th.="</tr>";
		$left_td="";
		for($i=0;$i<count($res);$i++){
			$left_td.="<tr>";
			for($j=0;$j<count($res[$i]);$j++){
				if($DB_FIELD_OIL_ARRAY[$j]=="RQ"){
					$left_td.="<td class='$DB_FIELD_OIL_ARRAY[$j]'>".date_format(date_create(mb_convert_encoding($res[$i][$DB_FIELD_OIL_ARRAY[$j]],"UTF-8", "GBK")),"Y-m-d")."</td>";
				}else{
					$left_td.="<td class='$DB_FIELD_OIL_ARRAY[$j]'>".mb_convert_encoding($res[$i][$DB_FIELD_OIL_ARRAY[$j]],"UTF-8", "GBK")."</td>";
				}
			}
			$left_td.="</tr>";
		}
		// 暂时不删
		// 添加最底部合计行
		// $RiChanYe_sum=0;
		// $RiChanYou_sum=0;
		// $RiChanQi_sum=0;
		// for($i=0;$i<count($res);$i++){
		// 	$RiChanYe_sum+=$res[$i]["RiChanYe"];
		// 	$RiChanYou_sum+=$res[$i]["RiChanYou"];
		// 	$RiChanQi_sum+=$res[$i]["RiChanQi"];
		// }
		// $left_sum_td="";
		// $left_sum_td.="<td class='$DB_FIELD_OIL_ARRAY[0]'>合计</td>";
		// for($i=1;$i<count($TH_ARRAY);$i++){
		// 	if($DB_FIELD_OIL_ARRAY[$i]=="RiChanYe"){
		// 		$left_sum_td.="<td class='$DB_FIELD_OIL_ARRAY[$i]'>".$RiChanYe_sum."</td>";
		// 	}elseif($DB_FIELD_OIL_ARRAY[$i]=="RiChanYou"){
		// 		$left_sum_td.="<td class='$DB_FIELD_OIL_ARRAY[$i]'>".$RiChanYou_sum."</td>";
		// 	}elseif($DB_FIELD_OIL_ARRAY[$i]=="RiChanQi"){
		// 		$left_sum_td.="<td class='$DB_FIELD_OIL_ARRAY[$i]'>".$RiChanQi_sum."</td>";
		// 	}else{
		// 		$left_sum_td.="<td class='$DB_FIELD_OIL_ARRAY[$i]'></td>";
		// 	}
		// }
		// $left_sum="<tr id='table_sum'>".$left_sum_td."</tr>";
		// 暂时不删
		$left_table="<table>".$left_th.$left_td./*$left_sum.*/"</table>";
		echo $left_table; 
	}
}

// 页面显示功图图片
function dis_indicator_diagram(){
	if(isset($_REQUEST["begin_year"],$_REQUEST["begin_month"],$_REQUEST["begin_day"],$_REQUEST["end_year"],$_REQUEST["end_month"],$_REQUEST["end_day"],$_REQUEST["jinghao"])){
		$begin_riqi=$_REQUEST["begin_year"]."-".$_REQUEST["begin_month"]."-".$_REQUEST["begin_day"];
		$end_riqi=$_REQUEST["end_year"]."-".$_REQUEST["end_month"]."-".$_REQUEST["end_day"];
		$jinghao=strtoupper($_REQUEST["jinghao"]);
		global $JINGHAO_OIL_ARRAY;
		$indicator_diagram_files=glob("../data/indicator_diagram/*");
		$is_jinghao_right=false;
		for($i=0;$i<count($JINGHAO_OIL_ARRAY);$i++){
			if($jinghao==$JINGHAO_OIL_ARRAY[$i]){
				$is_jinghao_right=true;
			}
		}
		if($is_jinghao_right){
			// 截取文件路径中日期的字符串
			$right_imgs_date=$indicator_diagram_files;
			for($i=0;$i<count($right_imgs_date);$i++){
				// 字符串最后一次出现参数字符的位置，不区分大小写
				$pos=strripos($right_imgs_date[$i],"_");
				// 截取文件名中日期部分的字符串
				// 从一个位置向右截取一定长度字符串
				$right_imgs_date[$i]=substr($right_imgs_date[$i],$pos+1,10);
			}
			// 比较日期
			$begin_time=mktime(0,0,0,$_REQUEST["begin_month"],$_REQUEST["begin_day"],$_REQUEST["begin_year"]);
			$end_time=mktime(0,0,0,$_REQUEST["end_month"],$_REQUEST["end_day"],$_REQUEST["end_year"]);
			$right_imgs_time=[];
			for($i=0;$i<count($right_imgs_date);$i++){
				// note mktime 参数，如果不添加 0+ 会报 warning，参数期望long，给的string
				$right_imgs_time[$i]=mktime(0,0,0,0+substr($right_imgs_date[$i],5,2),0+substr($right_imgs_date[$i],8,2),0+substr($right_imgs_date[$i],0,4));
			}
			// html 输出 p 和 img
			$right_imgs="";
			for($i=0;$i<count($indicator_diagram_files);$i++){
				if(strstr($indicator_diagram_files[$i],$jinghao)&&$begin_time<$right_imgs_time[$i]&&$right_imgs_time[$i]<$end_time){
					$right_imgs.="<a class='preview' rel='$indicator_diagram_files[$i]'><img class='indicator_diagram' src='$indicator_diagram_files[$i]'/></a><p>".$right_imgs_date[$i]."</p>";
				}
			}
			echo $right_imgs;
		}
	}
}

// ！！！显示功图和液面的代码绝大部分重复
// 页面显示液面图片
function dis_liquid_level(){
	if(isset($_REQUEST["begin_year"],$_REQUEST["begin_month"],$_REQUEST["begin_day"],$_REQUEST["end_year"],$_REQUEST["end_month"],$_REQUEST["end_day"],$_REQUEST["jinghao"])){
		$begin_riqi=$_REQUEST["begin_year"]."-".$_REQUEST["begin_month"]."-".$_REQUEST["begin_day"];
		$end_riqi=$_REQUEST["end_year"]."-".$_REQUEST["end_month"]."-".$_REQUEST["end_day"];
		$jinghao=strtoupper($_REQUEST["jinghao"]);
		global $JINGHAO_OIL_ARRAY;
		$liquid_level_files=glob("../data/liquid_level/*");
		$is_jinghao_right=false;
		for($i=0;$i<count($JINGHAO_OIL_ARRAY);$i++){
			if($jinghao==$JINGHAO_OIL_ARRAY[$i]){
				$is_jinghao_right=true;
			}
		}
		if($is_jinghao_right){
			// 截取文件路径中日期的字符串
			$right_imgs_date=$liquid_level_files;
			for($i=0;$i<count($right_imgs_date);$i++){
				// 字符串最后一次出现参数字符的位置，不区分大小写
				$pos=strripos($right_imgs_date[$i],"Y");
				// 从一个位置向右截取一定长度字符串
				$right_imgs_date[$i]=substr($right_imgs_date[$i],$pos+1,10);
			}
			// 比较日期
			$begin_time=mktime(0,0,0,$_REQUEST["begin_month"],$_REQUEST["begin_day"],$_REQUEST["begin_year"]);
			$end_time=mktime(0,0,0,$_REQUEST["end_month"],$_REQUEST["end_day"],$_REQUEST["end_year"]);
			$right_imgs_time=[];
			for($i=0;$i<count($right_imgs_date);$i++){
				$right_imgs_time[$i]=mktime(0,0,0,substr($right_imgs_date[$i],5,2),substr($right_imgs_date[$i],8,2),0+substr($right_imgs_date[$i],0,4));
			}
			// html 输出 p 和 img
			$right_imgs="";
			for($i=0;$i<count($liquid_level_files);$i++){
				if(strstr($liquid_level_files[$i],$jinghao)&&$begin_time<$right_imgs_time[$i]&&$right_imgs_time[$i]<$end_time){
					$right_imgs.="<a class='preview' rel='$liquid_level_files[$i]'><img class='liquid_level' src='$liquid_level_files[$i]'/></a><p>".$right_imgs_date[$i]."</p>";
				}
			}
			echo $right_imgs;
		}
	}
}

// 显示管柱图
function dis_tube_rod(){
	if(isset($_REQUEST["jinghao"])){
		$jinghao=strtoupper($_REQUEST["jinghao"]);
		global $JINGHAO_OIL_ARRAY;
		$tube_rod_files=glob("../data/tube_rod/*");
		$is_jinghao_right=false;
		for($i=0;$i<count($JINGHAO_OIL_ARRAY);$i++){
			if($jinghao==$JINGHAO_OIL_ARRAY[$i]){
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