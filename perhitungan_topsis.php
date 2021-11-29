<?php
require_once "class/class_function_topsis.php";
$topsis = new FunctionTOPSIS;
$config 	= new koneksi;
$db 		= $config->koneksi();

$jmlhrowpenilaian = mysqli_query($db, "SELECT DISTINCT kd_kriteria FROM penilaian ORDER BY id");
$jmlhrowp = mysqli_num_rows($jmlhrowpenilaian);
$jmlhrowkriteria 	= mysqli_query($db, "select kd_kriteria from kriteria");
$jmlhrowk 	= mysqli_num_rows($jmlhrowkriteria);





if ($jmlhrowp !== $jmlhrowk){
	echo "
	<script>
		alert('Lengkapi Terlebih Dahulu Penilaian !');  window.location.href = 'index1.php?page=form-penilaian';
	</script>
	
	";
}
else{
$topsis->PerhitunganTOPSIS();
}