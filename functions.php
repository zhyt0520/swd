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


// index.php 页面显示查询部分
function dis_query_form(){
	function single_date_html($prefix){
		$year_array=array(2010,2011,2012,2013,2014,2015,2016);
		$monTH_ARRAY=array(1,2,3,4,5,6,7,8,9,10,11,12);
		$day_array=array(1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31);
		$sele_year="<select name='".$prefix."_year'>";
		for($i=0;$i<count($year_array);$i++){ 
			$sele_year.="<option value=".$year_array[$i].">".$year_array[$i]."</option>";
		}
		$sele_year.="</select>";
		$sele_month="<select name='".$prefix."_month'>";
		for($i=0;$i<count($monTH_ARRAY);$i++){ 
			$sele_month.="<option value=".$monTH_ARRAY[$i].">".$monTH_ARRAY[$i]."</option>";
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
	global $FIELD_ARRAY;
	foreach ($FIELD_ARRAY as $key => $value) {
		$DB_FIELD_ARRAY[]=$key;
		$TH_ARRAY[]=$value;
	}
	$field_checkbox="";
	for ($i=0; $i < count($FIELD_ARRAY); $i++) { 
		$field_checkbox.="<input type='checkbox' id='".$DB_FIELD_ARRAY[$i]."' name='field_checkbox[]' value='".$DB_FIELD_ARRAY[$i]."'/><label for='".$DB_FIELD_ARRAY[$i]."'>".$TH_ARRAY[$i]."</label><br>";
	}
	$query_form=
		"<p>开始时间：".$begin_date."</p>".
		"<p>截止时间：".$end_date."</p>".
		"<div>井号：<input type='text' id='jinghao' name='jinghao' value='' autocomplete='off'/></div>".
		"<div id='hint'></div>".
		"<br>".
		/*note 用 autocomplete='off' 屏蔽输入框自动记录*/
		"<input type='submit' value='查询' /><input type='reset' value='清除' />";
	$fun_button=
		"<button type='button' class='fun_button' id='select_all'>全选</button>".
		"<button type='button' class='fun_button' id='unselect_all'>全不选</button>".
		"<button type='button' class='fun_button' id='reset_default'>恢复默认</button>".
		"<button type='button' class='fun_button' id='save_checkbox_chose'>保存选择</button>".
		"<button type='button' class='fun_button' id='clear_checkbox_save'>清除保存</button>";
	// 输出 html
	echo "<form action='display.php' method='post' target='_blank'>";
	echo "<div id=fun_button>".$fun_button."</div>";
	echo "<div id='field_checkbox'>".$field_checkbox."</div>";
	echo "<div id='query_form'>".$query_form."</div>";
	echo "</form>";
}

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