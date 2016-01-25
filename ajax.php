<?php

session_start();

require "config.php";

// 返回建议井号列表
if(isset($_REQUEST["mark"],$_REQUEST["sub_jinghao"])&&$_REQUEST["mark"]=="hint"&&strlen($_REQUEST["sub_jinghao"])>0){
	$jinghao_oil_and_water=array_merge($JINGHAO_OIL_ARRAY,$JINGHAO_WATER_ARRAY);
	$sub_jinghao=strtoupper($_REQUEST["sub_jinghao"]);
	$hint_jinghao=[];
	$j=0;
	for($i=0;$i<count($jinghao_oil_and_water);$i++){
		if(stristr($jinghao_oil_and_water[$i],$sub_jinghao)){
			$hint_jinghao[$j]=$jinghao_oil_and_water[$i];
			$j++;
		}
	}
	$response="";
	// 升序排列数组
	sort($hint_jinghao);
	if(count($hint_jinghao)>0){
		$k=count($hint_jinghao)<10?count($hint_jinghao):10;
		for($i=0;$i<$k;$i++){
			$response.="<li class='li_unselected' data-tmp=''>".$hint_jinghao[$i]."</li>";
		}
		echo $response;
	}
}

// 返回油井井号
if(isset($_REQUEST["mark"])&&$_REQUEST["mark"]=="JINGHAO_OIL_ARRAY"){
	echo json_encode($JINGHAO_OIL_ARRAY);
}

// 返回水井井号
if(isset($_REQUEST["mark"])&&$_REQUEST["mark"]=="JINGHAO_WATER_ARRAY"){
	echo json_encode($JINGHAO_WATER_ARRAY);
}

// 从session获取数据并传递给 js
if(isset($_REQUEST["res"])&&$_REQUEST["res"]=="res"){
	echo json_encode($_SESSION["res"]);
}

?>