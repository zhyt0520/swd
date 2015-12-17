<!DOCTYPE html>
<?php session_start(); ?>
<html>
<head>
	<title>query</title>
	<link rel="stylesheet" type="text/css" href="query.css">
	<?php require "config.php" ?>
	<?php require "functions.php" ?>
	<?php $conn=connect_db(); ?>
</head>
<body>
	<div id="div_user_info">
		<?php
		if(isset($_SESSION["username"])){
			echo "<span>您好：<b>".$_SESSION["username"]."</b>。 <a>退出登录</a></span>";
		}
		?>
	</div>
	<div id='div_navigation'>navigation</div>
	<div id="query">
	<?php
	if(isset($_SESSION["is_login"])&&$_SESSION["is_login"]=="login_yes"){
		dis_query_form();
	}else{
		header("Location:index.php");
	}
	?>
	</div>
	<script type="text/javascript" src="jquery-1.11.3.min.js"></script>
	<script type="text/javascript" src="query.js"></script>
</body>
</html>

<?php
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
		"<input type='submit' value='查询' /><input type='button' value='清除' id='input_qingchu'/>";
	$fun_button=
		"<button type='button' class='fun_button' id='select_all'>全选</button>".
		"<button type='button' class='fun_button' id='unselect_all'>全不选</button>".
		"<button type='button' class='fun_button' id='reset_default'>恢复默认</button>".
		"<button type='button' class='fun_button' id='save_checkbox_chose'>保存选择</button>".
		"<button type='button' class='fun_button' id='clear_checkbox_save'>清除保存</button>";
	// 输出 html
	echo "<form action='display.php' method='post' target='_blank'>";
	echo "<div id=div_fun_button>".$fun_button."</div>";
	echo "<div id='field_checkbox'>".$field_checkbox."</div>";
	echo "<div id='query_form'>".$query_form."</div>";
	echo "</form>";
}
?>