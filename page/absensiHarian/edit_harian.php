<?php 
	$no_indek = $_GET['no_indek'];
	$sql = mysql_query("select * from tb_harian where indek = '$no_indek'") or die (mysql_error());
	$data = mysql_fetch_array($sql);
 ?> 

<table>
	<tr>
		<th>
			DATA ABSENSI HARIAN <br>
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
							<li><input type="text" name="kode" value="<?php echo $data['kode']; ?>" disabled="disabled"></li>
							<li><input type="text" name="nama" value="<?php echo $data['nama']; ?>" disabled="disabled"></li>
							<li><input type="text" name="no_induk" value="<?php echo $data['no_induk']; ?>" disabled="disabled"></li>
							<li><input type="text" name="gender" value="<?php echo $data['gender']; ?>" disabled="disabled"></li>
							<li><input type="text" name="waktu" value="<?php echo $data['waktu']; ?>"></li>
							<li>
								<select name="keterangan" size='1'>
									<option value=''>Keterangan</option>
									<option value='on_time'>On Time</option>
									<option value='terlambat'>Terlambat</option>
								</select>
							</li>
							<li>
								<input type="submit" name="ganti" value="Ganti">
								<input type="reset" name="batal" value="Batal">
							</li>
						</ul>
					</form>
					<?php 
						/*
						$kode = @$_POST['kode'];
						$nama = @$_POST['nama'];
						$no_induk = @$_POST['no_induk'];
						$gender = @$_POST['gender'];
						*/
						
						$waktu= @$_POST['waktu'];
						$keterangan = @$_POST['keterangan'];
						$ganti = @$_POST['ganti'];

						//echo $kode."<br>".$nama."<br>".$no_induk."<br>".$gender."<br>".$time."<br>".$keterangan."<br>";

						if($ganti){
							if($waktu=='' || $keterangan==''){
								?>
								<script type="text/javascript">alert("Data tidak boleh ada yang kosong");</script>
								<?php
							}else{
								mysql_query("update tb_identitas set waktu='$waktu', keterangan='$keterangan' where no='$no_indek'" ) or die (mysql_error());	
								?>
								<script type="text/javascript">
									alert("Data berhasil diganti.");
									window.location.href = "?page=absensi_harian";
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
