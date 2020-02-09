<center>
	<form method="post" action="">
		<table class="data-kecil">
			<tr>
				<th>							
					Silahkan Ambil Absen dengan Kartu Anda.
				</th>
			</tr>
		</table>
	</form>
</center>
<?php 
	$rfidNum1 = @$_GET["rfidNum1"];
	$rfidNum2 = @$_GET["rfidNum2"];
	$rfidNum3 = @$_GET["rfidNum3"];
	$rfidNum4 = @$_GET["rfidNum4"];

	$rfidNum = $rfidNum1."-".$rfidNum2."-".$rfidNum3."-".$rfidNum4;

	//kirim kode ke tabel tb_identitas pada database db_absen
	$sql = mysql_query("select * from tb_identitas where kode = '$rfidNum'") or die (mysql_error());
	$data = mysql_fetch_array($sql);
	$cek = mysql_num_rows($sql);

	if($cek >= 1){
		$indek = $data['no'];
		$kode = $data['kode'];
		$nama = $data['nama'];
		$no_induk = $data['no_induk'];
		$gender = $data['gender'];
		$jabatan = $data['jabatan'];

		if($jabatan == 'pengajar'){
			/*baca tabel tb_harian satu per satu sesuai nomor indek*/
			for($i=0;$i<=100;$i++){
				$sql1 = mysql_query("select * from tb_harian where indek='$i';");
					while($data1 = mysql_fetch_array($sql1)){
					$indek = $data1['indek'];
					$keterangan = $data1['keterangan'];
						
					//baca tabel tb_rekap untuk meng-update data jumlah hadir mahasiswa;
					$sql2 = mysql_query("select * from tb_rekap where no='$i';");
					$data2 = mysql_fetch_array($sql2);
					$jml_hadir = $data2['jml_hadir'];
									
					if($keterangan=='on_time'){
						$jml_hadir = $jml_hadir + 1;
					}
									
					//baca tabel tb_matkul untuk mencari nilai persentase
					$sql3 = mysql_query("select * from tb_matkul;");
					$data3 = mysql_fetch_array($sql3);
					$jml_pertemuan = $data3['jml_pertemuan'];
					$persentase = ($jml_hadir/$jml_pertemuan)*100;
					
					//jika persentase hadir lebih dari 75, maka dapat mengikuti ujian
					if($persentase>=75){
						$keterangan2 = "Dapat Mengikuti Ujian";
					}else{
						$keterangan2 = "Tidak Dapat Mengikuti Ujian";
					}
					
					//update nilai tabel tb_rekap dengan data yang mutakhir
					mysql_query("UPDATE tb_rekap SET `jml_hadir`='$jml_hadir', `persentase`='$persentase', `keterangan`='$keterangan2' where `no`='$i';");
				}
			}
			mysql_query("TRUNCATE TABLE `tb_harian` ");
			?>
			<script type="text/javascript">
				alert("Data telah di rekap.");
			</script>
			<?php
		}else if($jabatan == 'mahasiswa'){
			//ambil nilai jam dan menit absensi
			$d = date("Y-m-d G:i:s");
			$jam_e = date('G');
			$jam_i = $jam_e;
			$menit = date('i');
			$waktu_str = "$jam_i:$menit WIB";
					
			//ambil data jam masuk kuliah pada table tb_matkul untuk mendapatkan keterangan absensi
			$sql_matkul = mysql_query("SELECT * FROM tb_matkul");
			$data_matkul = mysql_fetch_array($sql_matkul);
			$jam_masuk = $data_matkul['jam'];
			$menit_masuk = $data_matkul['menit'];
			$mnt_toleran = $data_matkul['menit_toleransi'];
			$mnt_batas = $menit_masuk + $mnt_toleran;
					
			if($menit>$mnt_batas || $jam_i>$jam_masuk){
				$keterangan = "terlambat";
			}else{
				$keterangan = "on_time";
			}
										
			//update table tb_harian dengan data yang baru
			mysql_query("INSERT INTO `tb_harian` (indek, kode, nama, no_induk, gender, waktu_str, keterangan) VALUES('$indek','$kode','$nama','$no_induk','$gender', '$waktu_str', '$keterangan');") or die(mysql_error());
					?>
			<?php
		}
	}else{
		?>
			<script type="text/javascript">
				alert("kode kartu  '<?php echo $kode ; ?>' belum terdaftar!");
			</script>
		<?php
	}
	
?>