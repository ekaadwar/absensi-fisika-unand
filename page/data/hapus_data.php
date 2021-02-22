<?php 
	$no_indeks = @$_GET['no_indeks'];
	/*baca status jabatan data yang akan dihapus*/
	$sql = mysqli_query($conn, "select * from tb_identitas where no='$no_indeks'");
	$data = mysqli_fetch_array($sql);
	$jabatan = $data['jabatan'];
	
	/*hapus data pada tabel tb_identitas*/
	mysqli_query($conn, "delete from tb_identitas where no = '$no_indeks'");
	
	if($jabatan=='mahasiswa'){
		/*hapus data pada tabel tb_rekap*/
		mysqli_query($conn, "delete from tb_rekap where no = '$no_indeks'");
	}
 ?>
 <script type="text/javascript">
 	window.location.href = "?page=data";
 </script>