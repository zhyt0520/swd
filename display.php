<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="display.css">
	<?php require "config.php" ?>
	<?php require "functions.php" ?>
	<?php $conn=connect_db(); ?>
	<title><p></p><?php dis_title() ?><p></p></title>
</head>
<body>
	<div id="top">
		<p><?php echo(isset($_REQUEST["jinghao"])?$_REQUEST["jinghao"]:false) ?></p>
	</div>
	<div id="left">
		<?php isset($conn)?dis_daily_data($conn):false ?>
	</div><!-- note 这里用注释消除掉 #left 和 #right 两个标签段落之间默认的空格
	--><div id="right">
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
	<script type="text/javascript" src="jquery-1.11.3.min.js"></script>
	<script type="text/javascript" src="display.js"></script>
</body>
</html>

<?php
// display.php 页面标题title
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

// display.php 页面显示单井日数据表
function dis_daily_data($conn){
	if(isset($_REQUEST["begin_year"],$_REQUEST["begin_month"],$_REQUEST["begin_day"],$_REQUEST["end_year"],$_REQUEST["end_month"],$_REQUEST["end_day"],$_REQUEST["jinghao"],$_REQUEST["field_checkbox"])){

		$begin_riqi=$_REQUEST["begin_year"]."-".$_REQUEST["begin_month"]."-".$_REQUEST["begin_day"];
		$end_riqi=$_REQUEST["end_year"]."-".$_REQUEST["end_month"]."-".$_REQUEST["end_day"];
		$jinghao=$_REQUEST["jinghao"];
		$field_checkbox=$_REQUEST["field_checkbox"];
		// 把字段数组连成一条字符串
		$field_str="";
		foreach ($field_checkbox as $value) {
			$field_str.=$value.",";
		}
		// 删除最后多余的一个逗号
		$field_str=substr($field_str,0,strlen($field_str)-1);
		// note 查询输入的字符串需要带引号
		$query="select ".$field_str." from ".DB_TABLE_daily_data." where riqi>='".$begin_riqi."' and riqi<='".$end_riqi."' and jinghao='".$jinghao."';";
		$result=$conn->prepare($query);
		$result->execute();
		$res=$result->fetchall(PDO::FETCH_ASSOC);
		// note 返回结果数组的 key 是数据库字段名，区分大小写
		global $FIELD_ARRAY;
		foreach ($field_checkbox as $key) {
			$DB_FIELD_ARRAY[]=$key;
			$TH_ARRAY[]=$FIELD_ARRAY[$key];
		}
		$left_th="<tr id='th'>";
		for($i=0;$i<count($TH_ARRAY);$i++){
			$left_th.="<th class='$DB_FIELD_ARRAY[$i]'>".$TH_ARRAY[$i]."</th>";
		}
		$left_th.="</tr>";
		$left_td="";
		for($i=0;$i<count($res);$i++){
			$left_td.="<tr>";
			for($j=0;$j<count($res[$i]);$j++){
				$left_td.="<td class='$DB_FIELD_ARRAY[$j]'>".$res[$i][$DB_FIELD_ARRAY[$j]]."</td>";
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
		// $left_sum_td.="<td class='$DB_FIELD_ARRAY[0]'>合计</td>";
		// for($i=1;$i<count($TH_ARRAY);$i++){
		// 	if($DB_FIELD_ARRAY[$i]=="RiChanYe"){
		// 		$left_sum_td.="<td class='$DB_FIELD_ARRAY[$i]'>".$RiChanYe_sum."</td>";
		// 	}elseif($DB_FIELD_ARRAY[$i]=="RiChanYou"){
		// 		$left_sum_td.="<td class='$DB_FIELD_ARRAY[$i]'>".$RiChanYou_sum."</td>";
		// 	}elseif($DB_FIELD_ARRAY[$i]=="RiChanQi"){
		// 		$left_sum_td.="<td class='$DB_FIELD_ARRAY[$i]'>".$RiChanQi_sum."</td>";
		// 	}else{
		// 		$left_sum_td.="<td class='$DB_FIELD_ARRAY[$i]'></td>";
		// 	}
		// }
		// $left_sum="<tr id='table_sum'>".$left_sum_td."</tr>";
		// 暂时不删
		$left_table="<table>".$left_th.$left_td./*$left_sum.*/"</table>";
		echo $left_table; 
	}
}

// display.php 页面显示功图图片
function dis_indicator_diagram(){
	if(isset($_REQUEST["begin_year"],$_REQUEST["begin_month"],$_REQUEST["begin_day"],$_REQUEST["end_year"],$_REQUEST["end_month"],$_REQUEST["end_day"],$_REQUEST["jinghao"])){
		$begin_riqi=$_REQUEST["begin_year"]."-".$_REQUEST["begin_month"]."-".$_REQUEST["begin_day"];
		$end_riqi=$_REQUEST["end_year"]."-".$_REQUEST["end_month"]."-".$_REQUEST["end_day"];
		$jinghao=strtoupper($_REQUEST["jinghao"]);
		global $JINGHAO_ARRAY;
		$indicator_diagram_files=glob("../data/indicator_diagram/*");
		$is_jinghao_right=false;
		for($i=0;$i<count($JINGHAO_ARRAY);$i++){
			if($jinghao==$JINGHAO_ARRAY[$i]){
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
				$right_imgs_time[$i]=mktime(0,0,0,substr($right_imgs_date[$i],5,2),substr($right_imgs_date[$i],8,2),substr($right_imgs_date[$i],0,4));
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
// display.php 页面显示液面图片
function dis_liquid_level(){
	if(isset($_REQUEST["begin_year"],$_REQUEST["begin_month"],$_REQUEST["begin_day"],$_REQUEST["end_year"],$_REQUEST["end_month"],$_REQUEST["end_day"],$_REQUEST["jinghao"])){
		$begin_riqi=$_REQUEST["begin_year"]."-".$_REQUEST["begin_month"]."-".$_REQUEST["begin_day"];
		$end_riqi=$_REQUEST["end_year"]."-".$_REQUEST["end_month"]."-".$_REQUEST["end_day"];
		$jinghao=strtoupper($_REQUEST["jinghao"]);
		global $JINGHAO_ARRAY;
		$liquid_level_files=glob("../data/liquid_level/*");
		$is_jinghao_right=false;
		for($i=0;$i<count($JINGHAO_ARRAY);$i++){
			if($jinghao==$JINGHAO_ARRAY[$i]){
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
				$right_imgs_time[$i]=mktime(0,0,0,substr($right_imgs_date[$i],5,2),substr($right_imgs_date[$i],8,2),substr($right_imgs_date[$i],0,4));
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
?>