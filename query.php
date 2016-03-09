<!DOCTYPE html>
<?php session_start(); ?>
<html>
<head>
	<title>query</title>
	<link rel="stylesheet" type="text/css" href="query.css">
	<?php require "config.php" ?>
</head>
<body>
	<div id="div_user_info">
		<?php
		if(isset($_SESSION["username"])){
			echo "<span>您好：<b>".$_SESSION["username"]."</b>。 <a>退出登录</a></span>";
		}
		?>
	</div>
	<div id='div_navigation'>
		<p>功能导航</p>
		<ul>
			<li><a>单井查询</a></li>
			<li><a>问题反馈</a></li>
			<li><a href="help.html" target="_blank">使用帮助</a></li>
		</ul>
	</div>
	<div id="query">
	<?php
		// if(isset($_SESSION["is_login"])&&$_SESSION["is_login"]=="login_yes"){
			dis_query_form();
		// }else{
			// header("Location:index.php");
		// }
	?>
	</div>
	<script type="text/javascript" src="jquery-1.11.3.min.js"></script>
	<script type="text/javascript" src="query.js"></script>
</body>
</html>

<?php
function dis_query_form(){
	// 把一组日期的 select 输出为 HTML 代码
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
	// 从 config.php 获取数组
	global $FIELD_OIL_ARRAY;
	global $FIELD_WATER_ARRAY;
	// 油井字段及中文名称
	foreach ($FIELD_OIL_ARRAY as $key => $value) {
		$DB_FIELD_OIL_ARRAY[]=$key;
		$TH_ARRAY_OIL[]=$value;
	}
	// 水井字段及中文名称
	foreach ($FIELD_WATER_ARRAY as $key => $value) {
		$DB_FIELD_WATER_ARRAY[]=$key;
		$TH_ARRAY_WATER[]=$value;
	}
	// 油井查询字段选择 checkbox
	$field_checkbox_oil="";
	for ($i=0; $i < count($FIELD_OIL_ARRAY); $i++) { 
		$field_checkbox_oil.="<input type='checkbox' id='".$DB_FIELD_OIL_ARRAY[$i]."' name='field_checkbox_oil[]' value='".$DB_FIELD_OIL_ARRAY[$i]."'/><label for='".$DB_FIELD_OIL_ARRAY[$i]."'>".$TH_ARRAY_OIL[$i]."</label><br>";
	}
	// 水井查询字段选择 checkbox
	$field_checkbox_water="";
	for ($i=0; $i < count($FIELD_WATER_ARRAY); $i++) { 
		$field_checkbox_water.="<input type='checkbox' id='".$DB_FIELD_WATER_ARRAY[$i]."' name='field_checkbox_water[]' value='".$DB_FIELD_WATER_ARRAY[$i]."'/><label for='".$DB_FIELD_WATER_ARRAY[$i]."'>".$TH_ARRAY_WATER[$i]."</label><br>";
	}
	$query_form=
		"<p>开始时间：".$begin_date."</p>".
		"<p>截止时间：".$end_date."</p>".
		"<div>井号：<input type='text' id='jinghao' name='jinghao' value='' autocomplete='off'/></div>".
		"<div id='hint'></div>".
		"<br>".
		/*note 用 autocomplete='off' 屏蔽输入框自动记录*/
		"<input type='button' value='查询' id='input_chaxun'/><input type='button' value='清除' id='input_qingchu'/>";
	$fun_button=
		"<button type='button' class='fun_button' id='select_all'>全选</button>".
		"<button type='button' class='fun_button' id='unselect_all'>全不选</button>".
		"<button type='button' class='fun_button' id='reset_default'>恢复默认</button>".
		"<button type='button' class='fun_button' id='save_checkbox_chose'>保存选择</button>".
		"<button type='button' class='fun_button' id='clear_checkbox_save'>清除保存</button>";
	// 输出 html
	echo "<form method='post' target='_blank'>";
	echo "<div id=div_fun_button>".$fun_button."</div>";
	echo "<div id='field_checkbox_oil'><br><b>油井数据选择</b><br><br>".$field_checkbox_oil."<br></div>";
	echo "<div id='field_checkbox_water'><br><b>水井数据选择</b><br><br>".$field_checkbox_water."<br></div>";
	echo "<div id='query_form'>".$query_form."</div>";
	echo "</form>";
}
?>