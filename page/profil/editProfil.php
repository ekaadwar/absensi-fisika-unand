<?php 
	$no_indeks = $data['no'];
	$kodekartu = $data['kode'];
	$nama = $data['nama'];
	$nobp = $data['no_induk'];
	$gender = $data['gender'];
	$password = $data['password'];
	$jurusan = 'Fisika';
	$fakultas = 'Matematika dan Ilmu Pengetahuan Alam';
?>

<form method="post" action="">
	<table class="data-kecil">
		<tr>
			<th colspan=2>Profil</th>
		</tr>
		<tr>
			<td>Kode Kartu</td>
			<td><input type="text" name="kodeKartu" value="<?php echo $kodekartu;?>" disabled="disabled"></td>
		</tr>
		<tr>
			<td>Nama</td>
			<td><input type="text" name="nama" value="<?php echo $nama; ?>"></td>
		</tr>
		<tr>
			<td>Nomor Induk</td>
			<td><input type="text" name="nobp" value="<?php echo $nobp; ?>" disabled="disabled"></td>
		</tr>
		<tr>
			<td>Jenis Kelamin</td>
			<td>
				<select name="gender" size="1">
					<option value="<?php echo $gender; ?>"> <?php echo $gender; ?> </option>
					<option value="Laki-laki">Laki-laki</option>
					<option value="Perempuan">Perempuan</option>
				</select>
			</td>
		</tr>
		<tr>
			<td>Jurusan</td>
			<td>
				<select name='jurusan' size="1">
					<option value="<?php echo $jurusan; ?>"><?php echo $jurusan; ?></option>
					<option value="Fisika">Fisika</option>
				</select>
			</td>
		</tr>
		<tr>
			<td>Fakultas</td>
			<td>
				<select name='fakultas' size="1">
					<option value="<?php echo $fakultas; ?>"><?php echo $fakultas; ?></option>
					<option value="Matematika dan Ilmu Pengetahuan Alam">Matematika dan Ilmu Pengetahuan Alam</option>
				</select>
			</td>
		</tr>
		<tr>
			<td>Ganti Password</td>
			<td><input type="password" name="password" value="<?php echo $password; ?>"></td>
		</tr>
		<tr>
			<td colspan=2>
				<input type="submit" name="submit" value="Edit">
				<input type="reset" name="reset" value="Batal">
			</td>
		</tr>
	</table>
</form>

<?php 
	$nama = @$_POST['nama'];
	$gender = @$_POST['gender'];
	$jurusan = @$_POST['jurusan'];
	$fakultas = @$_POST['fakultas'];
	$password = @$_POST['password'];
	$submit = @$_POST['submit'];

	if($submit){
		if($nama=="" || $gender=="" || $jurusan=="" || $fakultas=="" || $password==""){
			?>
			<script type="text/javascript">
				alert("Data masukan tidak boleh kosong!");
			</script>
			<?php
		}else{
			/*-ubah data pada tabel tb_identitas dengan data yang baru-*/
			mysqli_query($conn, "UPDATE tb_identitas SET kode='$kodekartu', nama='$nama', no_induk='$nobp', gender='$gender', password='$password' WHERE no='$no_indeks'" );
					
			if(@$_SESSION['mahasiswa']){
				/*ubah data pada tabel tb_rekap dengan data yang beru*/
				mysqli_query($conn, "UPDATE tb_rekap SET kode='$kodekartu',nama='$nama', no_induk='$nobp' WHERE no='$no_indeks'");
			}
			?>
			<script type="text/javascript">
				alert("Data berhasil diganti.");
				window.location.href = "?page=profil";
			</script>
			<?php
		}
	}
 ?>