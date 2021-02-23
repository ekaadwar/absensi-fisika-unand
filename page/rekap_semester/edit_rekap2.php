<?php
	$no_indek = $_GET['no_indek'];
	
	#baca isi tabel tb_rekap
	$sql1 = mysqli_query($conn, "SELECT * FROM tb_rekap where no='$no_indek';");
	$data1 = mysqli_fetch_assoc($sql1);
	$sakit = $data1["sakit"];
	$izin = $data1["izin"];
	
?>
<center>
	
	<form method="post" action="">
		<table>
			<tr>
				<th colspan="7">Tabel Edit Data Rekap Semester</th>
			</tr>
			<tr>
				<th>No</th>
				<th>Kode</th>
				<th>Nama</th>
				<th>No.Induk</th>
				<th>Jumlah Hadir</th>
				<th>Persentase</th>
				<th>Keterangan</th>
			</tr>		
			<tr>
				<td><input type="text" name="no" value="<?php echo $data1['no']; ?>" disabled="disabled"></td>
				<td><input type="text" name="kode" value="<?php echo $data1['kode']; ?>" disabled="disabled"></td>
				<td><input type="text" name="nama" value="<?php echo $data1['nama']; ?>" disabled="disabled"></td>
				<td><input type="text" name="no_induk" value="<?php echo $data1['no_induk']; ?>" disabled="disabled"></td>
				<td><input type="text" name="jml_hadir" value="<?php echo $data1['jml_hadir']; ?>"></td>
				<td><input type="text" name="persentase" disabled="disabled"></td>
				<td>
					<select name="keterangan" size='1' disabled="disabled">
						<option value=''>Keterangan</option>
						<option value='Dapat Mengikuti Ujian'>Dapat Mengikuti Ujian</option>
						<option value='Tidak Dapat Mengikuti Ujian'>Tidak Dapat Mengikuti Ujian</option>
					</select>
				</td>
			</tr>
			<tr>
				<td colspan = "7"><input type="submit" value="Edit" name="edit"></td>
			</tr>
		</table>
	</form>
		
	
</center>
<?php
	$jml_hadir = @$_POST['jml_hadir'];
	$edit = @$_POST['edit'];
	
	if(@$edit){
		if($jml_hadir==""){
			?>
			<script type="text/javascript">
				alert("Data Tidak Boleh Kosong!");
			</script>
			<?php
		}else{
			#baca tabel tb_matkul
			$sql_mk = mysqli_query($conn, "SELECT * from tb_matkul");
			$data_mk = mysqli_fetch_assoc($sql_mk);
			$jml_temu = $data_mk['jml_pertemuan'];

			//hitung persentasse hadir
			$kehadiran = $jml_hadir + $izin + $sakit;
			$tdk_hadir = $jml_temu - $kehadiran;
			$persentase = ($kehadiran/$jml_temu)*100;

			if($persentase>=75){
				$keterangan = 'Dapat Mengikuti Ujian';
			}else{
				$keterangan = 'Tidak Dapat Mengikuti Ujian';
			}

			//update tabel tb_rekap dengan data yang baru
			mysqli_query($conn, "update tb_rekap set jml_hadir='$jml_hadir', tdk_hadir='$tdk_hadir', persentase='$persentase', keterangan='$keterangan' where no='$no_indek'");
			?>
			<script type="text/javascript">
				alert("Data Berhasil Diganti.");
				window.location.href = "?page=rekap"
			</script>
			<?php
		}
	}
	
?>
