<?php

// 连接本地数据库
function connect_db(){
	$sdn="mysql:host=".DB_HOST.";port=".DB_PORT.";dbname=".DB_NAME;
	try {
		$conn=new PDO ($sdn,DB_USER,DB_PASSWORD);
	} catch (PDOException $e) {
		echo "数据库连接失败，请检查config.php文件内的配置数据。<br>
		错误信息：" . $e->getMessage();
	}
	if(isset($conn)){
		return $conn;
	}
}

// 连接远程数据库
function connect_db_remote(){
	// 用pdo查询
	// $sdn="oci:dbname=".DB_HOST_REMOTE.":".DB_PORT_REMOTE."/".DB_NAME_REMOTE.";charset=zhs16gbk";
	// $conn=new PDO ($sdn,DB_USER_REMOTE,DB_PASSWORD_REMOTE);
	// if(isset($conn)){
	// 	return $conn;
	// }
	
	// 用odbc查询
	$conn=odbc_connect('welldata','jd','jd');
	if(isset($conn)){
		return $conn;
	}
}

?>

