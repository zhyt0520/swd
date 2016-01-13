<?php

// 给js输出井号
$FOR_JS_JINGHAO_OIL_ARRAY="<script>var JINGHAO_OIL_ARRAY=[";
foreach($JINGHAO_OIL_ARRAY as $value){
	$FOR_JS_JINGHAO_OIL_ARRAY.="'".$value."',";
}
$FOR_JS_JINGHAO_OIL_ARRAY.="];</script>";
echo $FOR_JS_JINGHAO_OIL_ARRAY;

$FOR_JS_JINGHAO_WATER_ARRAY="<script>var JINGHAO_WATER_ARRAY=[";
foreach($JINGHAO_WATER_ARRAY as $value){
	$FOR_JS_JINGHAO_WATER_ARRAY.="'".$value."',";
}
$FOR_JS_JINGHAO_WATER_ARRAY.="];</script>";
echo $FOR_JS_JINGHAO_WATER_ARRAY;

?>