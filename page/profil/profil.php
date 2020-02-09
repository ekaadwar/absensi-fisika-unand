<?php 
	$kodekartu = $data['kode'];
	$nama = $data['nama'];
	$nobp = $data['no_induk'];
	$gender = $data['gender'];
	$jurusan = 'Fisika';
	$fakultas = 'Matematika dan Ilmu Pengetahuan Alam';
 ?>

<table class="data-kecil">
	<tr>
		<th colspan=2>Profil</th>
	</tr>
	<tr>
		<td>Kode Kartu</td>
		<td><?php echo $kodekartu; ?></td>
	</tr>
	<tr>
		<td>Nama</td>
		<td><?php echo $nama; ?></td>
	</tr>
	<tr>
		<td>Nomor BP</td>
		<td><?php echo $nobp; ?></td>
	</tr>
	<tr>
		<td>Jenis Kelamin</td>
		<td><?php echo $gender; ?></td>
	</tr>
	<tr>
		<td>Jurusan</td>
		<td><?php echo $jurusan; ?></td>
	</tr>
	<tr>
		<td>Fakultas</td>
		<td><?php echo $fakultas; ?></td>
	</tr>
	<tr>
		<td colspan=2>
			<a href="?page=profil&action=edit&no_indeks=<?php echo $data['no'] ?>">
				<button style="float:right";>
					Edit Profil
				</button>
			</a>	
		</td>
	</tr>
</table>