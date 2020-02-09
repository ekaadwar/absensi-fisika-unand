<div id="isi">
	<?php 
		$page = @$_GET['page'];
		$action = @$_GET['action'];
		
		if($page == "data"){
			if(@$_SESSION['admin']||@$_SESSION['operator']){
				if($action == ''){
					include('page/data/data.php');	
				}else if($action == 'tambah_data'){
					include('page/data/tambah_data2.php');
				}else if($action == 'edit'){
					include('page/data/edit.php');
				}else if($action == 'hapus'){
					include('page/data/hapus_data.php');
				}
			}else{
				?>
				<script type="text/javascript">
					alert('Maaf, Anda tidak punya hak akses.');
				</script>
				<?php
			}
		}else if($page == "absensi_harian"){
			if(@$_SESSION['admin']||@$_SESSION['operator']){
				if($action==''){
					include("page/absensiHarian/absensi_harian.php");	
				}else if($action=='edit'){
					include("page/absensiHarian/edit_harian.php");
				}else if($action=='hapus'){
					include("page/absensiHarian/hapus_harian.php");
				}
			}else{
				?>
				<script type="text/javascript">
					alert('Maaf, Anda tidak punya hak akses.');
				</script>
				<?php
			}
		}else if($page == "rekap"){
			if($action == ""){
				include("page/rekap_semester/rekap.php");
			}else if($action == "edit"){
				include("page/rekap_semester/edit_rekap.php");
			}else if($action == "edit2"){
				include("page/rekap_semester/edit_rekap2.php");
			}
		}else if($page == "logout"){ 
			header("location: login.php");
		}else if($page == "ambil_absen"){
			if(@$_SESSION['admin']||@$_SESSION['operator']){
				if($action == ""){
					include("page/ambilAbsen/metode_abs.php");
				}else if($action == "kartu"){
					include("page/ambilAbsen/absen_kartu.php");
				}else if($action == "noInduk"){
					include("page/ambilAbsen/ambil_absen.php");
				}else if($action == "izin-sakit"){
					include("page/ambilAbsen/izin-sakit.php");
				}else if($action == "is_tampil"){
					include("page/ambilAbsen/is_tampil.php");
				}else if($action=="is_tambah"){
					include("page/ambilAbsen/is_input.php");
				}else if($action=="hapus"){
					include("page/ambilAbsen/is_hapus.php");
				}else if($action=="edit"){
					include("page/ambilAbsen/is_edit.php");
				}
			}else{
				?>
				<script type="text/javascript">
					alert('Maaf, Anda tidak punya hak akses.');
				</script>
				<?php
			}
		}else if($page=='profil'){
			if($action==''){
				include("page/profil/profil.php");	
			}else if($action=='edit'){
				include("page/profil/editProfil.php");
			}
		}else{
			if(@$_SESSION['mahasiswa']){
				if($action==""){
					include("page/profil/profil.php");
				}else if($action=="editProfil"){
					include("page/profil/editProfil.php");
				}
			}else{
				include("page/data/data.php");
			}
		}
	 ?>
</div>