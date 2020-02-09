<center>
	<table class="data">
		<tr>
			<th colspan="8">Tabel Absensi Harian</th>
		</tr>
		<tr>
			<th>No</th>
			<th>Kode</th>
			<th>Nama</th>
			<th>No. Induk</th>
			<th>Gender</th>
			<th>Waktu Absensi</th>
			<th>Keterangan</th>
			<th>Opsi</th>
		</tr>
		<?php 
			$sql = mysql_query("SELECT * FROM tb_harian") or die(mysql_error());
			while($data = mysql_fetch_array($sql)){
				?>
				<tr>
					<td><?php echo $data['indek']; ?></td>
					<td><?php echo $data['kode']; ?></td>
					<td><?php echo $data['nama']; ?></td>
					<td><?php echo $data['no_induk']; ?></td>
					<td><?php echo $data['gender']; ?></td>
					<td><?php echo $data['waktu_str']; ?></td>
					<td><?php echo $data['keterangan']; ?></td>
					<td class='opsi'>
						<a href="?page=absensi_harian&action=edit&no_indek=<?php echo $data['indek'];?>"><button>Edit</button></a>
						<a href="?page=absensi_harian&action=hapus&no_indek=<?php echo $data['indek']; ?>"><button>Hapus</button></a>
					</td>
				</tr>
				<?php
			}
		?>
	</table>	
</center>