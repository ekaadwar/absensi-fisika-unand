<?php 
	@session_start();
	include "mysql/koneksi.php";
	if(@$_SESSION['admin']||@$_SESSION['operator']||@$_SESSION['pengajar']||@$_SESSION{'mahasiswa'}){
		header("location: index.php");
	}else{
	?>

<!DOCTYPE html>
<html>
<head>
	<title>Login | Absensi</title>
	<link rel="stylesheet" type="text/css" href="style/login.css">
</head>
<body>
	<div id="canvas">
		<div id="judul">
			<h3>
				Sistem Absensi Mahasiswa</br>
				Jurusan Fisika</br>
				Fakultas Matematika dan Ilmu Pengetahuan Alam</br>
				Universitas Andalas</br>
			</h3>
		</div>
		<div id="badan">
			<form method="post" action="">
				<table>
					<tr><td><input type="text" name="username" placeholder="Username/ No. Induk" class="in"></td></tr>
					<tr><td><input type="password" name="password" placeholder="Password" class="in"></td></tr>
					<tr>
						<td>
							<input type="submit" name="login" value="Login" class="btn">
							<input type="reset" name="batal" value="Batal" class="btn" style="margin-left : 114px;">
						</td>
					</tr>
				</table>
			</form>
			<?php 
				$username = @$_POST['username'];
				$password = @$_POST['password'];
				$login = @$_POST['login'];

				if($login){
					if($username=='' || $password==''){
						?> <script type="text/javascript">alert("Username dan Password tidak boleh kosong");</script> <?php
					}else{
						$sql = "select * from tb_identitas where no_induk = '$username' and password = '$password'";
						$result = mysqli_query($conn, $sql);
						


						$data = mysqli_fetch_assoc($result);
						$cek = mysqli_num_rows($result);
						if($cek>=1){
							if($data['jabatan']=='admin'){
								@$_SESSION['admin'] = $data['no'];
								header('location: index.php');
							}else if($data['jabatan'] == 'operator'){
								@$_SESSION['operator'] = $data['no'];
								header('location: index.php');
							}else if($data['jabatan'] == 'pengajar'){
								@$_SESSION['pengajar'] = $data['no'];
								header('location: index.php');
							}else if($data['jabatan'] == 'mahasiswa'){
								@$_SESSION['mahasiswa'] = $data['no'];
								header('location: index.php');
							}
						}else{
							?>
							<script type="text/javascript">
								alert("Username atau Password salah.");
							</script>
							<?php
						}
					}
				}
			?>
		</div>
	</div>
</body>
</html>
	
	<?php			
	}
 ?>

