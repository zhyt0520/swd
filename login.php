<?php

require "config.php";
// require "functions.php";

// 登录
if(isset($_REQUEST["username"],$_REQUEST["password"],$_REQUEST["is_save_login_status"])){
	$username=$_REQUEST["username"];
	$password=$_REQUEST["password"];
	$is_save_login_status=$_REQUEST["is_save_login_status"];
	// 连接数据库
	$sdn="mysql:host=".DB_HOST.";port=".DB_PORT.";dbname=".DB_NAME;
	$conn=new PDO ($sdn,DB_USER,DB_PASSWORD);
	// note 设置 utf8 ，否则中文会全显示成问号
	// $conn->query("set names utf8");

	// ！！！ 密码如何加密保存

	// 验证用户名和密码
	$query="select password from ".DB_TABLE_USER." where username = '".$username."' ;";
	$result=$conn->prepare($query);
	$result->execute();
	$res=$result->fetchColumn();
	if($password!=""&&$password==$res){
		$is_login=true;
	}else{
		$is_login=false;
	}

	// 返回正确登录结果 并且 设置 session
	if($is_login==true){
		session_start();
		if($_REQUEST["is_save_login_status"]=="true"){
			// 记录登录状态7天
			session_set_cookie_params(60*60*24*7);
			session_regenerate_id(true);
		}else{
			// 清除登录状态
			session_set_cookie_params(0);
			session_regenerate_id(true);
		}
		$_SESSION["is_login"]="login_yes";
		$_SESSION["username"]=$username;
	echo "login_yes";
	}
}

// 退出登录
if(isset($_REQUEST["logout"])&&$_REQUEST["logout"]=="logout"){
	session_start();
	session_set_cookie_params(0);
	session_regenerate_id(true);
	$_SESSION["is_login"]="login_no";
	echo "login_no";
}

?>