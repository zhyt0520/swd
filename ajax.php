<?php

require "config.php";

// 返回建议井号列表
if(isset($_REQUEST["mark"],$_REQUEST["sub_jinghao"])&&$_REQUEST["mark"]=="hint"&&strlen($_REQUEST["sub_jinghao"])>0){
	$sub_jinghao=strtoupper($_REQUEST["sub_jinghao"]);
	// echo "sub_jinghao:".$sub_jinghao."<br>";
	$hint_jinghao=null;
	$hint_jinghao=[];
	$j=0;
	for($i=0;$i<count($JINGHAO_ARRAY);$i++){
		if(stristr($JINGHAO_ARRAY[$i],$sub_jinghao)){
			$hint_jinghao[$j]=$JINGHAO_ARRAY[$i];
			$j++;
		}
	}
	$response="";
	if(count($hint_jinghao)>0){
		$k=count($hint_jinghao)<10?count($hint_jinghao):10;
		for($i=0;$i<$k;$i++){
			$response.="<li>".$hint_jinghao[$i]."</li>";
		}
		echo $response;
	}
}

?>