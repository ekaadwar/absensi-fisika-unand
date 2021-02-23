<?php
	$no_indek = $_GET['no_indek'];
	mysqli_query($conn, "delete from tb_harian where indek='$no_indek'");
?>
<script type="text/javascript">
	window.location.href = "?page=absensi_harian";
</script>