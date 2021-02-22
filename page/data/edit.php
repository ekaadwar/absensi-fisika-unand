<?php 
	$no_indeks = $_GET['no_indeks'];
	
	//memilih data pada tabel tb_identidas
	$sql = mysqli_query($conn, "select * from tb_identitas where no = '$no_indeks'");
	$data = mysqli_fetch_array($sql);

	//memilih data pada table tb_matkul
	$sql_matkul = mysqli_query($conn, "SELECT * FROM tb_matkul");
	$data_matkul = mysqli_fetch_array($sql_matkul);

	//data user yang akan di edit
	$kode = $data['kode'];
	$nama = $data['nama'];
	$no_induk = $data['no_induk'];
	$gender = $data['gender'];
	$jabatan_lama = $data['jabatan'];
	$password = $data['password'];
	//data matkul
	$jml_pertemuan = $data_matkul['jml_pertemuan'];
 ?>

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
					<legend>Edit Data</legend>
					<form action='' method='post'>
						<ul>
							<li><input type="text" name="kode" value="<?php echo $data['kode']; ?>"></li>
							<li><input type="text" name="nama" value="<?php echo $data['nama']; ?>"></li>
							<li><input type="text" name="no_induk" value="<?php echo $data['no_induk']; ?>"></li>
							<li>
								<select name="gender" size='1'>
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
								<input type="submit" name="ganti" value="Ganti">
								<input type="reset" name="batal" value="Batal">
							</li>
						</ul>
					</form>
					<?php 
						$kode = @$_POST['kode'];
						$nama = @$_POST['nama'];
						$no_induk = @$_POST['no_induk'];
						$gender = @$_POST['gender'];
						$jabatan = @$_POST['jabatan'];
						$password = @$_POST['password'];
						$ganti = @$_POST['ganti'];

						if($ganti){
							if($kode=='' || $nama=='' || $no_induk=='' || $gender=='' || $jabatan=='' || $password==''){
								?>
								<script type="text/javascript">alert("Data tidak boleh ada yang kosong");</script>
								<?php
							}else{
								/*-ubah data pada tabel tb_identitas dengan data yang baru-*/
								mysqli_query($conn, "UPDATE tb_identitas set kode='$kode', nama='$nama', no_induk='$no_induk', gender='$gender', jabatan='$jabatan', password='$password' where no='$no_indeks'" );	
								
								//pengeditan pada tabel tb_rekap
								if($jabatan_lama == 'mahasiswa'){
									mysqli_query($conn, "update tb_rekap set kode='$kode',nama='$nama', no_induk='$no_induk' where no='$no_indeks'");
									if($jabatan!='mahasiswa'){
										mysqli_query($conn, "delete from tb_rekap where no = '$no_indeks'");
									}
								}else{
									if($jabatan == 'mahasiswa'){
										mysqli_query($conn, "INSERT INTO `tb_rekap` (`no`, `kode`, `nama`, `no_induk`, `jml_hadir`, `izin`, `sakit`, `tdk_hadir`, `persentase`, `keterangan`) VALUES('$no_indeks','$kode', '$nama', '$no_induk','0', '0', '0', '$jml_pertemuan','0','Tidak Dapat Mengikuti Ujian');");
									}
								}
								?>
								<script type="text/javascript">
									alert("Data berhasil diganti.");
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