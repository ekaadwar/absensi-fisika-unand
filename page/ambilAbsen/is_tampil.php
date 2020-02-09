<center>
	<table class="data">
		<tr>
			<th colspan="8">Tabel Keterangan Izin/ Sakit</th>
		</tr>
		<tr>
			<th>Indeks</th>
			<th>Nama</th>
			<th>No. BP</th>
			<th>Kategori</th>
			<th>Tanggal</th>
			<th>Alasan</th>
			<th>Surat</th>
			<th>Opsi</th>
		</tr>
		<?php 
			$action2 = @$_GET["action2"];
			$bp = @$_GET["no_induk"];

			if($action2==""){
				$sql_is = mysql_query("SELECT * FROM tb_izin_sakit ORDER BY indek DESC;");	
			}else if($action2=="sakit"){
				$sql_is = mysql_query("SELECT * FROM tb_izin_sakit WHERE kategori='sakit' AND no_bp='$bp' ORDER BY indek DESC");
			}else if($action2=="izin"){
				$sql_is = mysql_query("SELECT * FROM tb_izin_sakit WHERE kategori='izin' AND no_bp='$bp' ORDER BY indek DESC");
			}

			while($data_is = mysql_fetch_array($sql_is)){
				?>
				<tr>
					<td><?php echo $data_is['indek']; ?></td>
					<td><?php echo $data_is['nama']; ?></td>
					<td><?php echo $data_is['no_bp']; ?></td>
					<td><?php echo $data_is['kategori']; ?></td>
					<td><?php echo $data_is['tanggal']; ?></td>
					<td><?php echo $data_is['alasan']; ?></td>
					<td align="center"><img src="gambar/<?php echo $data_is['gambar']; ?>" width="120px"></td>
					<td>
						<center>
							<a onclick="return confirm('Yakin ingin menghapus data?')" href="?page=ambil_absen&action=hapus&no_indeks=<?php echo $data_is['indek']; ?>&no_bp=<?php echo $data_is['no_bp']; ?>"><button>Hapus</button></a>
						</center>	
					</td>
				</tr>
				<?php
			}
		 ?>

	</table>
</center>