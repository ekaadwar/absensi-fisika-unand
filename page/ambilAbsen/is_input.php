<div>
	<form method="post" action="" enctype="multipart/form-data">
		<table class="data-kecil">
			<tr>
				<th colspan = "2">Formulir Izin/Sakit</th>
			</tr>
			<tr>
				<td>Nama</td>
				<td><input type="text" name="nama" class="izin-sakit"></td>
			</tr>
			<tr>
				<td>No. BP</td>
				<td><input type="text" name="no_bp"></td>
			</tr>
			<tr>
				<td>Keterangan</td>
				<td>
					<select name="keterangan">
						<option value="">Pilih Keterangan Izin atau Sakit</option>
						<option value="izin">Izin</option>
						<option value="sakit">Sakit</option>
					</select>
				</td>	
					
			</tr>
			<tr>
				<td>Tanggal</td>
				<td>
					<select name="tanggal">
						<option value=""></option>
						<?php 
							for($i=1;$i<=31;$i++){
								?>
								<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
								<?php
							}
						 ?>
					</select>
					<select name="bulan">
						<option value=""></option>
						<?php 
							$bulan = array("Januari","Februari","Maret","April", "Juni","Juli", "Agustus","September", "Oktober", "November", "Desember");
							for($j=0;$j<11;$j++){
								?>
								<option value="<?php echo $bulan[$j]; ?>"><?php echo $bulan[$j]; ?></option>
								<?php
							}
						 ?>
					</select>
					<select name="tahun">
						<option value=""></option>
						<?php 
							for($l=2019;$l<=2025;$l++){
								?>
								<option value="<?php echo $l; ?>"><?php echo $l; ?></option>
								<?php
							}
						 ?>
					</select>
				</td>
			</tr>
			<tr>
				<td>Alasan</td>
				<td>
					<textarea name="alasan">
					</textarea>
				</td>
			</tr>
			<tr>
				<td>Surat Keterangan</td>
				<td><input type="file" name="gambar"></td>
			</tr>
			<tr>
				<td colspan="2">
					<input type="submit" name="kirim" value="Kirim">
					<input type="reset" name="batal" value="Batal">	
				</td>
			</tr>
		</table>
	</form>
</div>
<?php 
	$nama = @$_POST["nama"];
	$no_bp = @$_POST["no_bp"];
	$keterangan = @$_POST["keterangan"];
	$tanggal = @$_POST["tanggal"];
	$bulan = @$_POST["bulan"];
	$tahun = @$_POST["tahun"];
	$tanggal_full = @"$tanggal $bulan $tahun";
	$alasan = @$_POST["alasan"];

	$sumber = @$_FILES["gambar"]["tmp_name"];
	$target = 'gambar/';
	$nama_gambar = @$_FILES["gambar"]["name"];
	

	$kirim = @$_POST["kirim"];

	if($kirim){
		if($nama==""||$no_bp==""||$keterangan==""||$tanggal==""||$bulan==""||$tahun=""||$alasan==""||$nama_gambar==""){
			?>
			<script type="text/javascript">
				alert("Data masukan tidak boleh kosong!");
			</script>
			<?php
		}else{
			$pindah = move_uploaded_file($sumber, $target.$nama_gambar);
			if($pindah){
				$sql_id = mysql_query("select * from tb_identitas where nama='$nama' and no_induk='$no_bp'");
				$data_id = mysql_fetch_array($sql_id);
				$indek = $data_id["no"];
				$jabatan = $data_id["jabatan"];

				if($jabatan=='mahasiswa'){
					mysql_query("insert into tb_izin_sakit(nama,no_bp, kategori, tanggal, alasan, gambar) value('$nama','$no_bp', '$keterangan', '$tanggal_full', '$alasan', '$nama_gambar')");
					$sql_kul = mysql_query("select * from tb_matkul");
					$data_kul = mysql_fetch_array($sql_kul);
					
					$sql_rkp = mysql_query("select * from tb_rekap where no_induk = '$no_bp'");
					$data_rkp = mysql_fetch_array($sql_rkp);

					$hadir = $data_rkp["jml_hadir"];
					$izin = $data_rkp["izin"];
					$sakit = $data_rkp["sakit"];

					$jml_pertemuan = $data_kul["jml_pertemuan"];

					if($keterangan == "sakit"){
						$sakit = $sakit+1;
					}else if($keterangan == "izin"){
						$izin = $izin +1;
					}

					$kehadiran = $hadir + $izin + $sakit;
					$ketidakhadiran = $jml_pertemuan - $kehadiran;
					$persentase = ($kehadiran/$jml_pertemuan)*100;

					if($persentase >= 75){
						$status = "Dapat Mengikuti Ujian";
					}else{
						$status = "Tidak Dapat Mengikuti Ujian";
					}

					//update nilai pada tabel tb_rekap
					$update = mysql_query("update tb_rekap set izin='$izin', sakit='$sakit', tdk_hadir='$ketidakhadiran', persentase='$persentase', keterangan='$status' where no_induk='$no_bp'") or die (mysql_error());

					if($update){
						?>
						<script type="text/javascript">
							alert("Data telah terkirim.");
							window.location.href="?page=ambil_absen";
						</script>
						<?php
					}

				}else{
					?>
					<script type="text/javascript">
						alert("Anda bukan mahasiswa. :D");
					</script>
					<?php
				}
			}else{
				?>
				<script type="text/javascript">
					alert("Gambar gagal di upload");
				</script>
				<?php
			}
		}
	}
 ?>