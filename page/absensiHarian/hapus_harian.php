<?php
	$no_indek = $_GET['no_indek'];
	mysql_query("delete from tb_harian where indek='$no_indek'") or die(mysql_error());
?>
<script type="text/javascript">
	window.location.href = "?page=absensi_harian";
</script>