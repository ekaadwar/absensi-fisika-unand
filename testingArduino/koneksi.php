<?php 
	$host = "localhost";
	$user = "root";
	$pass = "";
	$dbname = "db_absensi";

	$koneksi = mysql_connect($host, $user, $pass) or die (mysql_error());
	mysql_select_db($dbname);

	if($koneksi){
		echo "koneksi berhasil<br>";
	}else{
		echo "koneksi gagal<br>";
	}

 ?>