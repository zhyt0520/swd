<!DOCTYPE html>
<?php
session_start();
if(isset($_SESSION["is_login"])&&$_SESSION["is_login"]=="login_yes"){
	// 已登录
	header("Location:query.php");
}
?>
<html>
<head>
	<title>login</title>
	<link rel="stylesheet" type="text/css" href="index.css">
</head>
<body>
	<div id="div_login">
		<form method="post" action="login.php">
			<p id="p_wrong_warning">&nbsp</p>
			<span>帐号：</span><input type="text" name="username"/><br>
			<span>密码：</span><input type="password" name="password"/><br>
			<input type="checkbox" name="is_save_login_status" id="input_is_save_login_status"/><label for="input_is_save_login_status">保存登录状态</label><br>
			<input type="submit" name="login" value="登录"/>
			<input type="button" name="signin" value="注册" title="功能暂未开放" />
		</form>
	</div>
	<script type="text/javascript" src="jquery-1.11.3.min.js"></script>
	<script type="text/javascript" src="index.js"></script>
</body>
</html>