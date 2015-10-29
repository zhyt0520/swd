<!DOCTYPE html>
<html>
<head>
	<title>single well data</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<style>body{text-align: center;}</style>
	<?php require "config.php" ?>
	<?php require "functions.php" ?>
	<?php $conn=connect_db(); ?>
</head>
<body>
	<div id="query">
		<form action="display.php" method="get" target="_blank">
			<select name="year">
				<option value="2015">2015</option>
				<option value="2014">2014</option>
			</select>
			<select name="month">
				<option value="1">1</option>
				<option value="2">2</option>
			</select>
			<select name="day">
				<option value="1">1</option>
				<option value="2">2</option>
			</select>
			<p>井号：<input type="text" name="jinghao" value="np2-3" /></p>
			<input type="submit" value="确定" />
		</form>
	</div>
	<script type="text/javascript" src="swa.js"></script>
</body>
</html>