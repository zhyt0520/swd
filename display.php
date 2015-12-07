<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="display.css">
	<?php require "config.php" ?>
	<?php require "functions.php" ?>
	<?php $conn=connect_db(); ?>
	<title><?php dis_title() ?></title>
</head>
<body>
	<div id="top">
		<p><?php echo(isset($_REQUEST["jinghao"])?$_REQUEST["jinghao"]:false) ?></p>
	</div>
	<div id="left">
		<?php isset($conn)?dis_daily_data($conn):false ?>
	</div><!-- note 这里用注释消除掉 #left 和 #right 两个标签段落之间默认的空格
	--><div id="right">
		<ul id="tab_ul">
			<li class="tab_head tab_selected" id="tab_1">功图</li>
			<li class="tab_head tab_unselected" id="tab_2">液面</li>
		</ul>
		<div class="tab_content" id="tab_content_1">
			<?php dis_indicator_diagram() ?>
		</div>
		<div class="tab_content" id="tab_content_2">
			<?php dis_liquid_level() ?>
		</div>
	</div>
	<script type="text/javascript" src="jquery-1.11.3.js"></script>
	<script type="text/javascript" src="display.js"></script>
</body>
</html>