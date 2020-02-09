<?php 
	$no_indeks = @$_GET['no_indeks'];
	/*baca status jabatan data yang akan dihapus*/
	$sql = mysql_query("select * from tb_identitas where no='$no_indeks'");
	$data = mysql_fetch_array($sql);
	$jabatan = $data['jabatan'];
	
	/*hapus data pada tabel tb_identitas*/
	mysql_query("delete from tb_identitas where no = '$no_indeks'") or die(mysql_error());
	
	if($jabatan=='mahasiswa'){
		/*hapus data pada tabel tb_rekap*/
		mysql_query("delete from tb_rekap where no = '$no_indeks'") or die(mysql_error());
	}
 ?>
 <script type="text/javascript">
 	window.location.href = "?page=data";
 </script>