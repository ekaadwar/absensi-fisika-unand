<?php 
	$no_indek = $_GET['no_indek'];
	$sql = mysqli_query($conn, "SELECT * FROM tb_harian where indek = '$no_indek'");
	$data = mysqli_fetch_array($sql);
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
							<li><input type="text" name="waktu" value="<?php echo $data['waktu_str']; ?>"></li>
							<!-- <br /><b>Notice</b>:  Undefined index: waktu in <b>C:\xampp\htdocs\absensi-fisika-unand\page\absensiHarian\edit_harian.php</b> on line <b>25</b><br /> -->
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
						$waktu= @$_POST['waktu'];
						$keterangan = @$_POST['keterangan'];
						$ganti = @$_POST['ganti'];

						if($ganti){
							if($waktu=='' || $keterangan==''){
								?>
								<script type="text/javascript">alert("Data tidak boleh ada yang kosong");</script>
								<?php
							}else{
								mysqli_query($conn, "UPDATE tb_identitas set waktu='$waktu', keterangan='$keterangan' where no='$no_indek'" );
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
