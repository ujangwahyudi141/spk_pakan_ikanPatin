<?php
include "./class/class_keputusan_topsis.php";
$class = new KeputusanTOPSIS;
// include "class/class_koneksi.php";
// include "./class/class_keputusan_topsis.php";

// $mulai = microtime(true);
// $config     = new koneksi;
// $db         = $config->koneksi();

// $data_topsis = new KeputusanTOPSIS();
?>

<h1>Hasil Topsis</h1>
<ul class="nav nav-tabs">
	<?php
	if ($_GET['k'] == 'nilai_matriks') {
		$act1 = 'class="active"';
		$act2 = '';
		$act3 = '';
		$act4 = '';
		$act5 = '';
		$act6 = '';
	} else if ($_GET['k'] == 'nilai_matriks_normalisasi') {
		$act1 = '';
		$act2 = 'class="active"';
		$act3 = '';
		$act4 = '';
		$act5 = '';
		$act6 = '';
	} else if ($_GET['k'] == 'nilai_bobot_normalisasi') {
		$act1 = '';
		$act2 = '';
		$act3 = 'class="active"';
		$act4 = '';
		$act5 = '';
		$act6 = '';
	} else if ($_GET['k'] == 'matriks_ideal') {
		$act1 = '';
		$act2 = '';
		$act3 = '';
		$act4 = 'class="active"';
		$act5 = '';
		$act6 = '';
	} else if ($_GET['k'] == 'jarak_solusi') {
		$act1 = '';
		$act2 = '';
		$act3 = '';
		$act4 = '';
		$act5 = 'class="active"';
		$act6 = '';
	} else if ($_GET['k'] == 'nilai_preferensi') {
		$act1 = '';
		$act2 = '';
		$act3 = '';
		$act4 = '';
		$act5 = '';
		$act6 = 'class="active"';
	} else {
		$act1 = '';
		$act2 = '';
		$act3 = '';
		$act4 = '';
		$act5 = '';
		$act6 = '';
	}
	?>
	<li <?php echo $act1; ?>><a href="index1.php?page=topsis&k=nilai_matriks">Nilai Matriks</a></li>

	<li <?php echo $act2; ?>><a href="index1.php?page=topsis&k=nilai_matriks_normalisasi">Nilai Matriks Ternormalisasi</a></li>

	<li <?php echo $act3; ?>><a href="index1.php?page=topsis&k=nilai_bobot_normalisasi">Nilai Bobot Ternormalisasi</a></li>

	<li <?php echo $act4; ?>><a href="index1.php?page=topsis&k=matriks_ideal">Matriks Ideal Posistif/Negatif</a></li>

	<li <?php echo $act5; ?>><a href="index1.php?page=topsis&k=jarak_solusi">Jarak Solusi Ideal Posistif/Negatif</a></li>

	<li <?php echo $act6; ?>><a href="index1.php?page=topsis&k=nilai_preferensi">Nilai Preferensi</a></li>

</ul>

<?php
// $koneksi = new koneksi;
$conn = $koneksi->koneksi();
$s = mysqli_query($conn, "select * from kriteria");
$h = mysqli_num_rows($s);
?>
<div class='box-header'>
	<h3 class='box-title'>Nilai Matriks Ternormalisasi</h3>
</div>

<table class='table table-bordered table-responsive'>
	<thead>
		<tr>
			<th rowspan='2'>No</th>
			<th rowspan='2'>Nama</th>
			<th colspan='$h'>Kriteria</th>
		</tr>
		<tr>
			<?php
			for ($n = 1; $n <= $h; $n++) {
				echo "<th>C{$n}</th>";
			}
			echo "</thead>
                <tbody>";

			$i = 0;
			$a = mysqli_query($conn, "select * from pakan order by kd_pakan asc");
			while ($da = mysqli_fetch_assoc($a)) {
			?>
		<tr>
			<td> <?php echo $i++; ?></td>
			<td><?php echo $da['nm_pakan']; ?></td>
		<?php
				$idalt = $da['kd_pakan'];
				//ambil nilai $n=mysqli_query($conn, "select * from penilaian where kd_pakan='$idalt' order by id asc" ); while ($dn=mysqli_fetch_assoc($n)) { $idk=$dn['kd_kriteria']; //nilai kuadrat $nilai_kuadrat=0; $k=mysqli_query($conn, "select * from penilaian where kd_kriteria='$idk' " ); while ($dkuadrat=mysqli_fetch_assoc($k)) { $nilai_kuadrat=$nilai_kuadrat + ($dkuadrat['nilai'] * $dkuadrat['nilai']); } echo "<td align='center'>" . round(($dn['nilai'] / sqrt($nilai_kuadrat)), 3) . "</td>" ; } echo "
				echo "</tr>\n";
			}
			echo "</tbody>
</table>
";
		?>
		<?php
		if (@$_GET['page'] == 'topsis' and @$_GET['k'] == 'nilai_matriks') {
			$matriks = $class->nilai_matriks();
		} else if (@$_GET['k'] == 'nilai_matriks_normalisasi') {
			$normalisasi = $class->normalisasi();
		} else if (@$_GET['k'] == 'nilai_bobot_normalisasi') {
			$normalisasi_bobot = $class->normalisasi_bobot();
		} else if (@$_GET['k'] == 'matriks_ideal') {
			$matrik_ideal = $class->matriks_ideal();
		} else if (@$_GET['k'] == 'jarak_solusi') {
			include("jarak_solusi.php");
		} else if (@$_GET['k'] == 'nilai_preferensi') {
			include("nilai_preferensi.php");
		}
		?>