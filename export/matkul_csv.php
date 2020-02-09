<?php
	$connect = mysqli_connect("localhost","root","","db_absensi");

	header('Content-Type: text/csv; charset=utf-8');
	header('Content-Disposition: attachment; filename=tabel_matkul.csv');
	 
	$output = fopen("php://output", "w");

	$query = "SELECT * FROM tb_matkul";
	$result = mysqli_query($connect, $query);
	while($row = mysqli_fetch_assoc($result))
	{
		fputcsv($output, $row);
	}
	fclose($output);	
?>