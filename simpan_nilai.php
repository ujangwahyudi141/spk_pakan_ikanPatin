<?php
include "./class/class_koneksi.php"; 
 
$config 	= new koneksi;
$db 		= $config->koneksi();

$kd_pakan 	= $_POST['pakan'];
$nilai_array 		= $_POST['nilai'];

$data_penilaian 	= mysqli_query($db, "SELECT * FROM `penilaian` WHERE kd_pakan = '$kd_pakan' ");
$count = mysqli_num_rows($data_penilaian);
if ($count> 1)
{
    
    $isi_kriteria = mysqli_query($db,"select * from kriteria");
    $delet_penilaian = mysqli_query($db, "DELETE FROM penilaian WHERE  kd_pakan ='$kd_pakan'");
	$isi_kriteria2 		=  mysqli_query($db,"select * form kriteria");
	$no2=0;
    
	foreach ($isi_kriteria as $row_kriteria)
	{
		$kriteria_id	= $row_kriteria['kd_kriteria'];
		$nilai = $nilai_array[$no2];
        $data_penilaian = mysqli_query($db,"INSERT INTO `penilaian`(`kd_pakan`, `kd_kriteria`, `nilai`) VALUES ('$kd_pakan','$kriteria_id','$nilai')");
		$no2++;
	}
	header('location:index1.php?page=form-penilaian');
}else
{
	
	$isi_kriteria 		= mysqli_query($db,"select * from kriteria");
	$no2=0;
	foreach ($isi_kriteria as $row_kriteria)
	{
		$kriteria_id	= $row_kriteria['kd_kriteria'];
		$nilai = $nilai_array[$no2];
        $data_penilaian = mysqli_query($db,"INSERT INTO `penilaian`(`kd_pakan`, `kd_kriteria`, `nilai`) VALUES ('$kd_pakan','$kriteria_id','$nilai')");
		$no2++;
		
	}
	header('location:index1.php?page=form-penilaian');
}

?>
