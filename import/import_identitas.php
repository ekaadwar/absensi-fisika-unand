<?php
	$connect = mysqli_connect("localhost", "root","","db_absensi");
	if($connect){
		$waktu = date("l, d M Y");
		$identitas = @$_FILES["identitas"]["tmp_name"];
		$harian = @$_FILES["harian"]["tmp_name"];
		$rekap = @$_FILES["rekap"]["tmp_name"];
		$matkul = @$_FILES["matkul"]["tmp_name"];
		$permisi = @$_FILES["permisi"]["tmp_name"];

		
		//update tabel tb_identitas
		if(@$_FILES["identitas"]["size"] > 0){
			$file = fopen($identitas, "r");
			$kosongkan = "TRUNCATE tb_identitas";
			mysqli_query($connect, $kosongkan);
			while (($getData = fgetcsv($file, 10000, ",")) !== FALSE){
				$sql = "INSERT INTO tb_identitas (	no, 
													kode, 
													nama, 
													no_induk, 
													gender, 
													jabatan, 
													password) 
											VALUES ('$getData[0]', 
													'$getData[1]', 
													'$getData[2]', 
													'$getData[3]', 
													'$getData[4]', 
													'$getData[5]', 
													'$getData[6]')";
				$result = mysqli_query($connect, $sql);
				if(!isset($result)){
					echo "FILE INVALID, HANYA CSV YANG DIIZINKAN<br>";
				}
			}
			
			$sql_waktu = "UPDATE waktu_update set identitas='$waktu' WHERE indek=1";
			mysqli_query($connect, $sql_waktu);
			fclose($file);

			?>
			<script type="text/javascript">
				alert("Basis data telah diperbarui.");
				window.location.href = "../index.php";
			</script>
			<?php

		}

		//update tabel tb_harian
		if(@$_FILES["harian"]["size"] > 0){
			$file = fopen($harian, "r");
			$kosongkan = "TRUNCATE tb_harian";
			mysqli_query($connect, $kosongkan);

			while (($getData = fgetcsv($file, 10000, ",")) !== FALSE){
				$sql = "INSERT INTO tb_harian (	indek, 
												kode, 
												nama, 
												no_induk, 
												gender, 
												waktu_str, 
												keterangan) 
										VALUES ('$getData[0]', 
												'$getData[1]', 
												'$getData[2]', 
												'$getData[3]', 
												'$getData[4]', 
												'$getData[5]', 
												'$getData[6]')";
				$result = mysqli_query($connect, $sql);
				if(!isset($result)){
					echo "FILE INVALID, HANYA CSV YANG DIIZINKAN<br>";
				}
			}

			$sql_waktu = "UPDATE waktu_update set harian='$waktu' WHERE indek=1";
			mysqli_query($connect, $sql_waktu);

			fclose($file);
		}

		//update tabel tb_rekap
		if(@$_FILES["rekap"]["size"] > 0){
			$file = fopen($rekap, "r");
			$kosongkan = "TRUNCATE tb_rekap";
			mysqli_query($connect, $kosongkan);
			
			while (($getData = fgetcsv($file, 10000, ",")) !== FALSE){
				$sql = "INSERT INTO tb_rekap (	no, 
												kode, 
												nama, 
												no_induk, 
												jml_hadir, 
												izin, 
												sakit,
												tdk_hadir,
												persentase,
												keterangan) 
										VALUES ('$getData[0]', 
												'$getData[1]', 
												'$getData[2]', 
												'$getData[3]', 
												'$getData[4]', 
												'$getData[5]', 
												'$getData[6]',
												'$getData[7]',
												'$getData[8]',
												'$getData[9]')";
				$result = mysqli_query($connect, $sql);
				if(!isset($result)){
					echo "FILE INVALID, HANYA CSV YANG DIIZINKAN<br>";
				}
			}
			$sql_waktu = "UPDATE waktu_update set rekap='$waktu' WHERE indek=1";
			mysqli_query($connect, $sql_waktu);
			fclose($file);
		}

		//update tabel tb_matkul
		if(@$_FILES["matkul"]["size"] > 0){
			$waktu = date("l, d M Y");			
			$file = fopen($matkul, "r");
			$kosongkan = "TRUNCATE tb_matkul";
			mysqli_query($connect, $kosongkan);
			
			while (($getData = fgetcsv($file, 10000, ",")) !== FALSE){
				$sql = "INSERT INTO tb_matkul (	no, 
												nama, 
												jurusan, 
												fakultas, 
												jml_pertemuan, 
												jam,
												menit,
												menit_toleransi
											) 
										VALUES ('$getData[0]', 
												'$getData[1]', 
												'$getData[2]', 
												'$getData[3]', 
												'$getData[4]', 
												'$getData[5]', 
												'$getData[6]',
												'$getData[7]'
											)";
				$result = mysqli_query($connect, $sql);
				if(!isset($result)){
					echo "FILE INVALID, HANYA CSV YANG DIIZINKAN<br>";
				}
			}
			$sql_waktu = "UPDATE waktu_update set matkul='$waktu' WHERE indek=1";
			mysqli_query($connect, $sql_waktu);
			fclose($file);
		}

		//update tabel tb_izin_sakit
		if(@$_FILES["permisi"]["size"] > 0){
			$file = fopen($permisi, "r");
			$kosongkan = "TRUNCATE tb_izin_sakit";
			mysqli_query($connect, $kosongkan);
			
			while (($getData = fgetcsv($file, 10000, ",")) !== FALSE){
				$sql = "INSERT INTO tb_izin_sakit (	indek, 
													nama, 
													no_bp, 
													kategori, 
													tanggal, 
													alasan,
													gambar
												) 
										VALUES ('$getData[0]', 
												'$getData[1]', 
												'$getData[2]', 
												'$getData[3]', 
												'$getData[4]', 
												'$getData[5]', 
												'$getData[6]'
											)";
				$result = mysqli_query($connect, $sql);
				if(!isset($result)){
					echo "FILE INVALID, HANYA CSV YANG DIIZINKAN<br>";
				}
			}
			$sql_waktu = "UPDATE waktu_update set permisi='$waktu' WHERE indek=1";
			mysqli_query($connect, $sql_waktu);
			fclose($file);
		}

		?>
		<script type="text/javascript">
			alert("Update basis data telah selesai.");
			window.location.href = "../index.php";
		</script>
		<?php
		
	}else{
		echo "koneksi ekspor gagal";
	}	
?>