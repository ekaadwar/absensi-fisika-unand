 <?php 
	$sql = mysqli_query($conn, "select * from tb_matkul");
	$data = mysqli_fetch_assoc($sql);
?>
<form method="post" action="">
	<div id="matkul">
		<table style="width:30%; margin-left:30px;">
			<tr>
				<td>Nama Mata Kuliah</td>
				<td>:</td>
				<td>
					<select name="nama" size="1">
						<option value="<?php echo $data['nama']; ?>"><?php echo $data['nama']; ?></option>
						<option value="Fisika Komputasi">Fisika Komputasi</option>
						<option value="Pemrograman Komputer">Pemrograman Komputer</option>
						<option value="Elektromagnet II">Elektromagnet II</option>
					</select>
				</td>
			</tr>
			<tr>
				<td>Jurusan</td>
				<td>:</td>
				<td>
					<select name="jurusan" size="1">
						<option value="<?php echo $data['jurusan']; ?>"><?php echo $data['jurusan']; ?></option>
					</select>
				</td>
				
			</tr>
			<tr>
				<td>Fakultas</td>
				<td>:</td>
				<td>
					<select name="fakultas" size="1">
						<option value="<?php echo $data['fakultas']; ?>"><?php echo $data['fakultas']; ?></option>
					</select>
				</td>
			</tr>
			<tr>
				<td>Jumlah Pertemuan</td>
				<td>:</td>
				<td>
					<select name="jml_pertemuan" size="1">
						<option value="<?php echo $data['jml_pertemuan']; ?>"><?php echo $data['jml_pertemuan']; ?></option>
						<?php
							for($i=0;$i<=20;$i++){
								echo "<option value='$i'>$i</option>";
							}
						?>
					</select>
					kali
				</td>
			</tr>
			<tr>
				<td>Jam Masuk</td>
				<td>:</td>
				<td>
					<select name="jam" size="1">
						<option value="<?php echo $data['jam']; ?>"><?php echo $data['jam']; ?></option>
						<?php
							for($i=0;$i<=23;$i++){
								echo "<option value='$i'>$i</option>";
							}
						?>
					</select>
					:
					<select name="menit" size="1">
						<option value="<?php echo $data['menit']; ?>"><?php echo $data['menit']; ?></option>
						<?php
							for($i=0;$i<=59;$i++){
								echo "<option value='$i'>$i</option>";
							}
						?>
					</select>
				</td>
			</tr>
			<tr>
				<td>Toleransi Keterlambatan</td>
				<td>:</td>
				<td>
					<select name="menit_toleransi" size="1">
						<option value="<?php echo $data['menit_toleransi']; ?>"><?php echo $data['menit_toleransi']; ?></option>
						<?php
							for($i=0;$i<=59;$i++){
								echo "<option value='$i'>$i</option>";
							}
						?>
					</select>
					menit
				</td>
			</tr>
			<tr>
				<td colspan='3'>
					<input type="submit" name="ganti" value="Ganti">
					<input type="reset" name="batal" value="Batal">
				</td>
			</tr>
		</table>	
	</div>
</form>
<?php
	$nama = @$_POST['nama'];
	$jurusan = @$_POST['jurusan'];
	$fakultas = @$_POST['fakultas'];
	$jml_pertemuan = @$_POST['jml_pertemuan'];
	$jam = @$_POST['jam'];
	$menit = @$_POST['menit'];
	$menit_toleransi = @$_POST['menit_toleransi'];
	$ganti = @$_POST['ganti'];
	
	if($ganti){
		if($nama=="" || $jurusan=="" || $fakultas=="" || $jml_pertemuan=="" || $jam=="" || $menit=="" || $menit_toleransi==""){
			?>
			<script>
				alert("Form tidak boleh kosong");
			</script>
			<?php
		}else{
			mysqli_query($conn, "update tb_matkul set nama='$nama', jurusan='$jurusan', fakultas='$fakultas', jml_pertemuan='$jml_pertemuan', 
				jam='$jam', menit='$menit', menit_toleransi='$menit_toleransi'" );
				
			//update nilai ketidakhadiran dan persentase kehadiran pada tabel tb_rekap
			for($i=1; $i<=100; $i++){
				$sql2 = mysqli_query($conn, "SELECT * FROM tb_rekap where no='$i';");
				while($data2 = mysqli_fetch_assoc($sql2)){
					$jml_hadir = $data2['jml_hadir'];
					$izin = $data2['izin'];
					$sakit = $data2['sakit'];
					$tdk_hadir = $jml_pertemuan-($jml_hadir+$izin+$sakit);
					$persentase = ($jml_hadir/$jml_pertemuan)*100;
					
					if($persentase>=75){
						$keterangan2 = "Dapat Mengikuti Ujian";
					}else{
						$keterangan2 = "Tidak Dapat Mengikuti Ujian";
					}

					mysqli_query($conn, "UPDATE tb_rekap set tdk_hadir='$tdk_hadir', persentase='$persentase', keterangan='$keterangan2' where no='$i';");
				}
			}
			?>
			<script type="text/javascript">
				alert("Data berhasil diganti.");
				window.location.href = "?page=rekap";
			</script>
			<?php
		}
	}
?>