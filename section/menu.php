<div id="menu">
	<ul>
		<?php if(@$_SESSION['admin']||@$_SESSION['operator']): ?>
		<li><a href="?page=data">Data</a></li>
		<li><a href="?page=ambil_absen">Ambil Absen</a></li>
		<li><a href="?page=absensi_harian">Absensi Harian</a></li>
		<?php endif; ?>
		
		<li><a href="?page=rekap">Rekap Semester</a></li>
		<li class="kanan"><a onclick="return confirm('Yakin Mau Keluar?')" href="page/logOut/logout.php">Log Out</a></li> 
		<?php 
			if(@$_SESSION['admin']){
				$user_terlogin = @$_SESSION['admin'];
			}else if(@$_SESSION['operator']){
				$user_terlogin = @$_SESSION['operator'];
			}else if(@$_SESSION['pengajar']){
				$user_terlogin = @$_SESSION['pengajar'];
			}else if(@$_SESSION['mahasiswa']){
				$user_terlogin = @$_SESSION['mahasiswa'];
			}
			// $sql = mysql_query("select * from tb_identitas where no = '$user_terlogin'") or die (mysql_error());
			$sql = "select * from tb_identitas where no = '$user_terlogin'";
			$result = mysqli_query($conn, $sql);

			$data = mysqli_fetch_array($result);
			?>
			<li class="kanan"><a href="?page=profil">Selamat Datang, <?= $data['nama']; ?></a></li>
			<?php
		 ?>
	</ul>
</div>