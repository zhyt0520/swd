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
	<?php dis_query_form(); ?>
	</div>
	<script type="text/javascript" src="jquery-1.11.3.js"></script>
	<script type="text/javascript" src="swd.js"></script>
</body>
</html>