<?php 
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "db_absensi";

	$dsn = "mysql:host=" . $servername . ";dbname=" . $dbname;

	$option = [
		PDO::ATTR_PERSISTENT => true,
		PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
	];

	try {
		$dbh = new PDO($dsn, $username, $password, $option);
	} catch (PDOException $e) {
		die($e->getMessage());
	}
	

	

	
	
 ?>