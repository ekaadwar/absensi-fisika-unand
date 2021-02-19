<div class="bagian-kiri">
	<div class="kiri-atas" style="font-size:12px;">
		<?php 
			$sql_wkt = mysqli_query($conn, "SELECT * FROM waktu_update");
			//$sql_wkt = mysqli_query("SELECT * FROM waktu_update") or die (mysql_error());

			$data_wkt = mysqli_fetch_array($sql_wkt);
			//$data = mysql_fetch_array($sql))
		 ?>
		<table>
			<tr style="font-size:16px;">
				<th colspan="3" style="text-align:left;">Terakhir Diperbarui</th>
			</tr>
			<tr>
				<td>Tabel Data Identitas</td>
				<td>:</td>
				<td><?php echo $data_wkt['identitas']; ?></td>
			</tr>
			<tr>
				<td>Tabel Absensi Harian</td>
				<td>:</td>
				<td><?php echo $data_wkt['harian']; ?></td>
			</tr>
			<tr>
				<td>Tabel Rekap</td>
				<td>:</td>
				<td><?php echo $data_wkt['rekap']; ?></td>
			</tr>
			<tr>
				<td>Tabel Mata Kuliah</td>
				<td>:</td>
				<td><?php echo $data_wkt['matkul']; ?></td>
			</tr>
			<tr>
				<td>Tabel Permisi</td>
				<td>:</td>
				<td><?php echo $data_wkt['permisi']; ?></td>
			</tr>
		</table>
	</div>
	<div class="kiri-atas">
		<h4 style="margin:auto;">Download File CSV</h4>
		<ul>
			<li><a href="export/identitas_csv.php">Tabel Identitas</a></li>
			<li><a href="export/harian_csv.php">Tabel Absensi Harian</a></li>
			<li><a href="export/rekap_csv.php">Tabel Rekap</a></li>
			<li><a href="export/matkul_csv.php">Tabel Mata Kuliah</a></li>
			<li><a href="export/permisi_csv.php">Tabel Permisi</a></li>
		</ul>
	</div>
	<div class="kiri-bawah">
		<h4 style="margin:auto;">Perbarui Data Tabel</h4>
		<form method="post" action="import/import_identitas.php" enctype="multipart/form-data">
			<table>
				<tr style="font-size:12px;">
					<td>Tabel Data Identitas</td>
					<td><input type="file" name="identitas"></td>
				</tr>
				<tr style="font-size:12px;">
					<td>Tabel Absensi Harian</td>
					<td><input type="file" name="harian"></td>
				</tr>
				<tr style="font-size:12px;">
					<td>Tabel Rekap</td>
					<td><input type="file" name="rekap"></td>
				</tr>
				<tr style="font-size:12px;">
					<td>Tabel Mata Kuliah</td>
					<td><input type="file" name="matkul"></td>
				</tr>
				<tr style="font-size:12px;">
					<td>Tabel Permisi</td>
					<td><input type="file" name="permisi"></td>
				</tr>	
				<tr>
					<td colspan="3">
						<input type="submit" name="perbarui" value="Perbarui" >
					</td>
				</tr>
			</table>
		</form>
	</div>
</div>
<div class="bagian-kanan">
	<table class="data">
		<tr>
			<th colspan='8'>
					DATA IDENTITAS USER <br>
					JURUSAN FISIKA FMIPA UNAND
			</th>
		</tr>
		<tr>
			<th>Indeks</th>
			<th>Kode</th>
			<th>Nama</th>
			<th>No. Induk</th>
			<th>Jenis Kelamin</th>
			<th>Jabatan</th>
			<th>Password</th>
			<th>Opsi</th>
		</tr>
		
		<?php
			if(@$_SESSION['admin']){
				$sql = mysqli_query("select * from tb_identitas where jabatan = 'operator' or jabatan = 'pengajar' or jabatan = 'mahasiswa' ") or die (mysql_error());
			}else if(@$_SESSION['operator']){
				$sql = mysqli_query("select * from tb_identitas where jabatan ='pengajar' or jabatan='mahasiswa'") or die (mysql_error());
			}
			while($data = mysql_fetch_array($sql)){
				?>
				<tr>
					<td><?php echo $data['no']; ?></td>
					<td><?php echo $data['kode']; ?></td> 
					<td><?php echo $data['nama']; ?></td>
					<td><?php echo $data['no_induk']; ?></td>
					<td><?php echo $data['gender']; ?></td>
					<td><?php echo $data['jabatan']; ?></td>
					<td><?php echo $data['password']; ?></td>
					<td>
						<center>
							<a href="?page=data&action=edit&no_indeks=<?php echo $data['no']; ?>"><button>Edit</button></a>
							<a onclick="return confirm('Yakin ingin menghapus data?')" href="?page=data&action=hapus&no_indeks=<?php echo $data['no']; ?>"><button>Hapus</button></a>
						</center>
					</td>
				</tr>
				<?php
			}
		 ?>
		<tr>
			<td colspan='8' style='padding: 4px;'>
				<a href='?page=data&action=tambah_data'>
					<button>Tambah Data</button>
				</a>
			</td>
		</tr>
	</table>
</div>
<div class="clear"></div>