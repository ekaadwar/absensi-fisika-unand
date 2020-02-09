<?php 
	$sql = mysql_query("select * from tb_matkul") or die (mysql_error());
	$data = mysql_fetch_array($sql);

	$sql2 = mysql_query("SELECT * FROM tb_rekap where no = '$user_terlogin'") or die (mysql_error());
	$data2 = mysql_fetch_array($sql2);
	$jml_hadir = $data2['jml_hadir'];
	$persentase = $data2['persentase'];
	$keterangan = $data2['keterangan'];
?>
<div id="matkul">
	<!-- Tabel untuk menampilkan data matakuliah -->
	<table style="width:30%; margin-bottom : 20px;" class="data">
		<tr>
			<th colspan="2">Data Mata Kuliah</th>
		</tr>
		<tr>
			<td>Nama Mata Kuliah</td>
			<td><?php echo $data["nama"]; ?></td>
		</tr>
		<tr>
			<td>Jurusan</td>
			<td><?php echo $data["jurusan"]; ?></td>
		</tr>
		<tr>
			<td>Fakultas</td>
			<td><?php echo $data["fakultas"]; ?></td>
		</tr>
		<tr>
			<td>Jumlah Pertemuan</td>
			<td><?php echo $data["jml_pertemuan"]; ?></td>
		</tr>
		<tr>
			<td>Jam Masuk</td>
			<td><?php echo $data["jam"].":".$data["menit"]; ?></td>
		</tr>
		<tr>
			<td>Toleransi Keterlambatan</td>
			<td><?php echo $data["menit_toleransi"]." menit"; ?></td>
		</tr>
		<?php 
			if (@$_SESSION['admin'] || @$_SESSION['operator'] || @$_SESSION['pengajar']) {
				?>
				<tr>
					<td colspan='3'>
						<a href="?page=rekap&action=edit">
							<button>Edit</button>
						</a>
					</td>
				</tr>
				<?php
			}else if(@$_SESSION['mahasiswa']){
				?>
				<tr>
					<td>Jumlah Kehadiran Anda</td>
					<td><?php echo $jml_hadir; ?></td>
				</tr>
				<tr>
					<td>Persentase Kehadiran Anda</td>
					<td><?php echo $persentase; ?>%</td>
				</tr>
				<tr>
					<td>Status Anda</td>
					<td><?php echo $keterangan; ?></td>
				</tr>
				<?php
			}
		 ?>
	</table>	
	
</div>

<!--Tabel untuk menampilkan data rekap semester-->
<?php 
	if(@$_SESSION['admin'] || @$_SESSION['operator'] || @$_SESSION['pengajar']){
		?>
		<center>
			<table class="data">
				<tr>
					<th colspan="11">Tabel Rekap Semester</th>
				</tr>
				<tr>
					<th>No</th>
					<th>Kode</th>
					<th>Nama</th>
					<th>No.Induk</th>
					<th>Kehadiran</th>
					<th>Izin</th>
					<th>Sakit</th>
					<th>Tanpa Keterangan</th>
					<th>Persentase</th>
					<th>Keterangan</th>
					<th>Opsi</th>
				</tr>
				<?php
					/*ambil data pada tb_rekap*/
					$sql2 = mysql_query("select * from tb_rekap");
					while($data2 = mysql_fetch_array($sql2)){
						?>
						<tr>
							<td><?php echo $data2['no']; ?></td>
							<td><?php echo $data2['kode']; ?></td>
							<td><?php echo $data2['nama']; ?></td>
							<td><?php echo $data2['no_induk']; ?></td>
							<td><?php echo $data2['jml_hadir']; ?></td>
							<td>
								<a href="?page=ambil_absen&action=is_tampil&action2=izin&no_induk=<?php echo $data2['no_induk']; ?>">
									<?php echo $data2['izin']; ?>	
								</a>
								
							</td>
							<td>
								<a href="?page=ambil_absen&action=is_tampil&action2=sakit&no_induk=<?php echo $data2['no_induk']; ?>">
									<?php echo $data2['sakit']; ?>	
								</a>
								
							</td>
							<td><?php echo $data2['tdk_hadir']; ?></td>
							<td><?php echo $data2['persentase'];?>%</td>
							<td><?php echo $data2['keterangan']; ?></td>
							<td class='opsi'>
								<a href="?page=rekap&action=edit2&no_indek=<?php echo $data2['no'];?>"><button>Edit</button></a>
							</td>
						</tr>
						<?php
					}
				?>
			</table>
		</center>
		<?php
	}
 ?>