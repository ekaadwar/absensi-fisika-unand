<?php
	date_default_timezone_set("Asia/Jakarta");
	@session_start();
	include "mysql/koneksi.php";

	if(@$_SESSION['admin'] || @$_SESSION['operator'] || @$SESSION['pengajar'] || @$_SESSION['mahasiswa']){
		include "section/header.php";
		include "section/menu.php";
		include "section/isi.php";
		include "section/footer.php";
	}else{
		header("location: login.php");
	}
 ?>