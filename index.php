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
	<div id="browser_remind">
		请使用 WebKit 内核浏览器或 IE9 以上版本访问<br>
		多内核浏览器请选择极速模式<br>
		确保显示器分辨率宽度不小于1440<br>
		否则页面排版及部分功能会出现问题<br>
		测试账号：<b>test</b>，密码：<b>test</b>
	</div>
	<div id="div_login">
		<form method="post" action="login.php">
			<p id="p_wrong_warning">&nbsp</p>
			<span>帐号：</span><input type="text" name="username" autocomplete="off"/><br>
			<span>密码：</span><input type="password" name="password" autocomplete="off"/><br>
			<input type="checkbox" name="is_save_login_status" id="input_is_save_login_status" /><label for="input_is_save_login_status">保存登录状态</label><br>
			<input type="button" name="login" value="登录"/>
			<input type="button" name="signin" value="注册" title="功能建设中" />
		</form>
	</div>
	<script type="text/javascript" src="jquery-1.11.3.min.js"></script>
	<script type="text/javascript" src="index.js"></script>
</body>
</html>