<center>
	<form method="post" action="">
		<table class="data-kecil">
			<tr>
				<th>
					Silahkan masukan Kode Kartu atau Nomor Induk
				</th>
			</tr>
			<tr>
				<td style="padding: 10px;">
					<center>
						<form action='' method='post'>
							<input type="text" name="kode" placeholder="Kode Kartu / Nomor Induk"> <br class="tambah_data">
							<input type="submit" name="kirim" value="Kirim">
							<input type="reset" name="batal" value="Batal">
						</form>
					</center>
				</td>
			</tr>
		</table>
		<?php 
			$kode = @$_POST['kode'];
			$kirim = @$_POST['kirim'];

			if($kirim){
				if($kode == ''){
					?>
					<script type="text/javascript">alert('Anda belum memasukan kode');</script>
					<?php
				}else{								
					$sql = mysqli_query($conn, "SELECT * FROM tb_identitas where no_induk = '$kode'");
					$data = mysqli_fetch_assoc($sql);
					$cek = mysqli_num_rows($sql);

					if($cek >= 1){
						$indek = $data['no'];
						$kode = $data['kode'];
						$nama = $data['nama'];
						$no_induk = $data['no_induk'];
						$gender = $data['gender'];
						$jabatan = $data['jabatan'];

						if($jabatan == 'operator'||$jabatan == 'admin'){
							/*baca tabel tb_harian satu per satu sesuai nomor indek*/
							for($i=0;$i<=100;$i++){
								$sql1 = mysqli_query($conn, "select * from tb_harian where indek='$i';");
								while($data1 = mysqli_fetch_assoc($sql1)){
									$indek = $data1['indek'];
									$keterangan = $data1['keterangan'];
								
									//baca tabel tb_rekap untuk meng-update data jumlah hadir mahasiswa;
									$sql2 = mysqli_query($conn, "select * from tb_rekap where no='$i';");
									$data2 = mysqli_fetch_assoc($sql2);
									$jml_hadir = $data2['jml_hadir'];
									
									if($keterangan=='on_time'){
										$jml_hadir = $jml_hadir + 1;
									}
									
									//baca tabel tb_matkul untuk mencari nilai persentase
									$sql3 = mysqli_query($conn, "select * from tb_matkul;");
									$data3 = mysqli_fetch_assoc($sql3);
									$jml_pertemuan = $data3['jml_pertemuan'];
									$persentase = ($jml_hadir/$jml_pertemuan)*100;
									
									//jika persentase hadir lebih dari 75, maka dapat mengikuti ujian
									if($persentase>=75){
										$keterangan2 = "Dapat Mengikuti Ujian";
									}else{
										$keterangan2 = "Tidak Dapat Mengikuti Ujian";
									}
									
									//update nilai tabel tb_rekap dengan data yang mutakhir
									mysqli_query($conn, "UPDATE tb_rekap SET `jml_hadir`='$jml_hadir', `persentase`='$persentase', `keterangan`='$keterangan2' where `no`='$i';");
								}
							}
							mysqli_query($conn, "TRUNCATE TABLE `tb_harian` ");
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
							$sql_matkul = mysqli_query($conn, "SELECT * FROM tb_matkul");
							$data_matkul = mysqli_fetch_assoc($sql_matkul);
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
							mysqli_query($conn, "INSERT INTO `tb_harian` (indek, kode, nama, no_induk, gender, waktu_str, keterangan) VALUES ('$indek','$kode','$nama','$no_induk','$gender', '$waktu_str', '$keterangan');");
							?>
							<script type="text/javascript">
								alert("Form absensi '<?php echo $nama; ?>' telah diisi.");
							</script>
							<?php

						}
					}else{
						?>
							<script type="text/javascript">
								alert("nomor induk <?php echo $kode ; ?> belum terdaftar!");
							</script>
						<?php
					}
				}
			}
		 ?>
	</form>
</center>