<table>
	<tr>
		<th>
			DATA IDENTITAS MAHASISWA DAN DOSEN <br>
			JURUSAN FISIKA FMIPA UNAND
		</th>
	</tr>
	<tr>
		<td>
			<div id="tambah_data">
				<fieldset >
					<legend>Tambah Data</legend>
					<form action='' method='post'>
						<ul>
							<li><input type="text" name="kode" placeholder="Kode Kartu"></li>
							<li><input type="text" name="nama" placeholder="Nama Lengkap"></li>
							<li><input type="text" name="no_induk" placeholder="Nomor Induk"></li>
							<li>
								<select name="jenis_kelamin" size='1'>
									<option value=''>Jenis Kelamin</option>
									<option value='Laki-Laki'>Laki-Laki</option>
									<option value='Perempuan'>Perempuan</option>
								</select>
							</li>
							<li>
								<select name='jabatan' size='1'>
									<option value=''>Jabatan</option>
									<option value='admin'>Admin</option>
									<option value='operator'>Operator</option>
									<option value='pengajar'>Dosen</option>
									<option value='mahasiswa'>Mahasiswa</option>
								</select>
							</li>
							<li><input type="password" name="password" placeholder="Password"> <br></li>
							<li>
								<input type="submit" name="tambah" value="Tambah">
								<input type="reset" name="batal" value="Batal">		
							</li>
						</ul>
					</form>
					<?php 
						$kode = @$_POST['kode'];
						$nama = @$_POST['nama'];
						$no_induk = @$_POST['no_induk'];
						$gender = @$_POST['jenis_kelamin'];
						$jabatan = @$_POST['jabatan'];
						$password = @$_POST['password'];
						$tambah = @$_POST['tambah'];

						if($tambah){
							if($kode=='' || $nama=='' || $no_induk=='' || $gender=='' || $jabatan=='' || $password==''){
								?>
								<script type="text/javascript">alert("Data tidak boleh ada yang kosong");</script>
								<?php
							}else{
								//kirim data ke tabel tb_identitas
								$sql_matkul = mysql_query("SELECT * FROM tb_matkul") or die (mysql_error());
								$data_matkul = mysql_fetch_array($sql_matkul);
								$jml_pertemuan = $data_matkul['jml_pertemuan'];
								

								mysql_query("INSERT INTO `tb_identitas` (`no`, `kode`, `nama`, `no_induk`, `gender`, `jabatan`, `password`) VALUES (NULL, '$kode', '$nama', '$no_induk', '$gender', '$jabatan', '$password');") or die (mysql_error());	
								
								//---
								
								if($jabatan == 'mahasiswa'){
									/*mengambil nilai nomor indeks dari tabel tb_identitas untuk
									digunakan sebagai nomor indeks pada tabel tb_rekap*/
									$sql = mysql_query("SELECT * FROM tb_identitas where kode='$kode'");
									$data = mysql_fetch_array($sql);
									$indek = $data['no'];
									/*---*/
									
									/*Kirim data baru ke tabel tb_rekap*/
									mysql_query("INSERT INTO `tb_rekap` (`no`, `kode`, `nama`, `no_induk`, `jml_hadir`, `izin`, `sakit`, `tdk_hadir`,`persentase`, `keterangan`) VALUES('$indek','$kode', '$nama', '$no_induk','0','0','0','$jml_pertemuan','0','Tidak Dapat Mengikuti Ujian');") or die (mysql_error());
									/*---*/
									}	
								?>
								<script type="text/javascript">
									alert("Data berhasil ditambah.");
									window.location.href = "?page=data";
								</script>
								<?php
							}
						}
					 ?>
				</fieldset>	
			</div>						
		</td>
	</tr>
</table>