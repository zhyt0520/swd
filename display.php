<!DOCTYPE html>
<html>
<head>
	<title>display</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<?php require "config.php" ?>
	<?php require "functions.php" ?>
	<?php $conn=connect_db(); ?>
</head>
<body>
	<div id="top"></div>
	<div id="left">
		<?php isset($conn)?dis_daily_data($conn):false ?>
	</div><!-- note 这里用注释消除掉 #left 和 #right 两个标签段落之间默认的空格
	--><div id="right"></div>
	<script type="text/javascript" src="swa.js"></script>
</body>
</html>