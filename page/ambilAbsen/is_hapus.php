<?php 
	$indek = $_GET['no_indeks'];
	$no_bp = $_GET['no_bp'];

	$sql_is = mysqli_query($conn, "SELECT * FROM tb_izin_sakit WHERE indek = $indek");
	$data_is = mysqli_fetch_array($sql_is);

	$kategori = $data_is['kategori'];
	//melihat nilai yang terbaca oleh $sql_is
	$indek = $data_is['indek'];
	$no_bp = $data_is['no_bp'];
	$tanggal = $data_is['tanggal'];
	$alasan = $data_is['alasan'];
	$gambar = $data_is['gambar'];

	//menghapus data
	mysqli_query($conn, "DELETE FROM tb_izin_sakit WHERE indek=$indek");

	//mengambil nilai-nilai yang diperlukan pada tabel rekap semester
	$sql_rekap = mysqli_query($conn, "SELECT * FROM tb_rekap WHERE no_induk=$no_bp");
	$data_rekap = mysqli_fetch_array($sql_rekap);

	$hadir = $data_rekap["jml_hadir"];
	$izin = $data_rekap["izin"];
	$sakit = $data_rekap["sakit"];

	if($kategori=="sakit"){
		$sakit = $sakit-1;
	}else if($kategori=="izin"){
		$izin = $izin-1;
	}

	//mengambil data jumlah pertemuan perkuliahan
	$sql_matkul = mysqli_query($conn, "SELECT * FROM tb_matkul");
	$data_matkul = mysqli_fetch_array($sql_matkul);

	$jml_pertemuan = $data_matkul["jml_pertemuan"];

	//melakukan kalkulasi untuk data rekap semester
	$kehadiran = $hadir + $izin + $sakit;
	$tdk_hadir = $jml_pertemuan - $kehadiran;
	$persentase = ($kehadiran/$jml_pertemuan)*100;

	if($persentase>=75){
		$ket = "Dapat Mengikuti Ujian";
	}else{
		$ket = "Tidak Dapat Mengikuti Ujian";
	}
	
	//update tabel rekap semester dengan data yang baru
	mysqli_query($conn, "UPDATE tb_rekap SET jml_hadir='$hadir', izin='$izin', sakit='$sakit', tdk_hadir='$tdk_hadir', persentase='$persentase', keterangan='$ket' WHERE no_induk='$no_bp' ");
 ?>
 <script type="text/javascript">
 	alert("Data telah dihapus.");
 	window.location.href="?page=ambil_absen&action=is_tampil";
 </script>