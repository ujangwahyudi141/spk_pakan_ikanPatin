<?php
function microtime_float()
{
	list($usec, $sec) = explode(" ", microtime());
	return ((float)$usec + (float)$sec);
}
// include "./class/class_koneksi.php";
include "./class/class_keputusan_saw.php";
$config 	= new koneksi;
$db 		= $config->koneksi();
$data_saw 			= new KeputusanSAW();

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
$mulai = microtime(true);

//deklarasi array kriteria
$array_kriteria = array();
//deklarasi array bobot kriteria
$array_bobot	= array();
//deklarasi array  type bobot
$array_tipe		= array();

//set bobot
$isi_kriteria 	= mysqli_query($db, "select * from kriteria");
foreach ($isi_kriteria as $row_kriteria) {
	$array_kriteria[] = $row_kriteria['kd_kriteria'];
	$array_bobot[] = round(($row_kriteria['bobot'] / 100), 2);
	$array_tipe[] = $row_kriteria['tipe'];
}
//set pakan
$array_pakan		= array();
$isi_pakan = mysqli_query($db, "SELECT DISTINCT kd_pakan FROM penilaian ORDER BY id");
foreach ($isi_pakan as $row_pakan) {
	$array_pakan[] = $row_pakan['kd_pakan'];
}


//set matriks array--------------------------------------------------------------
$matriks = array();
for ($row = 0; $row < sizeof($array_pakan); $row++) {

	for ($col = 0; $col < sizeof($array_kriteria); $col++) {
		$isi_value = mysqli_query($db, "SELECT * FROM penilaian WHERE kd_pakan = '" . $array_pakan[$row] . "' AND kd_kriteria = '" . $array_kriteria[$col] . "'");
		$row_value = $isi_value->fetch_assoc();
		$matriks[$row][$col]			= $row_value['nilai'];
	}
}


if ((sizeof($array_kriteria) == false) or (sizeof($array_pakan) == false)) {
?>

	<body>

		<div class="wrapper">

			<div class="section">
				<div class="header" style="margin-top:85px; border: 1px solid; ">
					<a href="http://localhost/dbpakan">Beranda</a> / Simple Additive Weighting (SAW)
				</div>
				<div style="border:2px solid #BFBFBF; padding:7px;margin-top:5px;border-radius:5px">
					<h3>Belum ada data penilaian, silakan isi penilaian terlebih dahulu</h3>
				</div>
			</div>
	</body>
<?php
} else {
	//method atau fungsi normalisasi matrik
	$normalisasi 	= $data_saw->normalisasi($matriks, $array_tipe);
	//method atau fungsi skor hasil normalisasi
	$skor 			= $data_saw->skor($normalisasi, $array_bobot);
	//method atau fungsi vektor atau pembobotan akhir dari skor
	$vektor			= $data_saw->vektor($skor);



	// Sleep for a while


	//echo "Did nothing in $time seconds\n";
?>

	<div class="container mt-3">
		<div class='box-header'>
			<h4 class='box-title'>Hasil Seleksi</h4>
			<hr>
			<h4 class='box-title'>Matrik Keputusan</h4>
		</div>
		<table class="demo-tableMatriks">
			<?php
			$first = true;
			foreach ($matriks as $key1 => $val1) {
				//if first time through, we need a header row
				if ($first) { ?>
					<table class="table table-bordered">
						<thead>
							<tr>
								<th>Nama Alternatif</th>
								<?php
								foreach ($val1 as $key2 => $value2) {
									$nama_kriteria = mysqli_query($db, "SELECT * FROM kriteria WHERE kd_kriteria = '" . $array_kriteria[$key2] . "'");
									$row_nama = $nama_kriteria->fetch_assoc();
								?><th><?php echo $row_nama['nm_kriteria'] ?></th>
								<?php
								} ?>
							</tr>
						</thead>
					<?php
					//set control to false
					$first = false;
				}
				//echo out each object in the table
				$nama_pakan = mysqli_query($db, "SELECT * FROM pakan WHERE kd_pakan = '" . $array_pakan[$key1] . "'");
				$row_nama_pakan = $nama_pakan->fetch_assoc();
					?>
					<tr>
						<th><?php echo $row_nama_pakan['nm_pakan'] ?></th>
						<?php
						foreach ($val1 as $key2 => $value2) {
							$n		= $value2;
							if ($n == '') {
								$nn = 0;
							} else {
								$nn = $n;
							}
						?><td class='text-center'><?php echo $nn ?></td>
						<?php
						}
						?>
					</tr><?php
						} ?>
					</table>
					<br>
					<div class='box-header'>
						<h4 class='box-title'>Normalisasi</h4>
					</div>
					<table class="demo-tableMatriks">
						<?php
						$first = true;
						$total_skor = 0;
						foreach ($normalisasi as $key1 => $val1) {
							//if first time through, we need a header row
							if ($first) { ?>
								<table class="table table-bordered">
									<thead>
										<tr>
											<th>Nama Alternatif</th>
											<?php
											foreach ($val1 as $key2 => $value2) {
												$nama_kriteria = mysqli_query($db, "SELECT * FROM kriteria WHERE kd_kriteria = '" . $array_kriteria[$key2] . "'");
												$row_nama = $nama_kriteria->fetch_assoc();
											?><th><?php echo $row_nama['nm_kriteria'] ?></th>
											<?php
											} ?>
										</tr>
									</thead>
								<?php
								//set control to false
								$first = false;
							}
							//echo out each object in the table
							$nama_pakan = mysqli_query($db, "SELECT * FROM pakan WHERE kd_pakan = '" . $array_pakan[$key1] . "'");
							$row_nama_pakan = $nama_pakan->fetch_assoc();
								?>
								<tr>
									<th><?php echo $row_nama_pakan['nm_pakan'] ?></th>
									<?php
									foreach ($val1 as $key2 => $value2) {
										$n		= $value2;
										if ($n == '') {
											$nn = 0;
										} else {
											$nn = $n;
										}
									?><td class='text-center'><?php echo number_format($nn, 3) ?></td>
								<?php
									}
								} ?>
								</table>
								<br>
								<div class='box-header'>
									<h4 class='box-title'>Skor</h4>
								</div>

								<table class="demo-tableMatriks">
									<?php
									$first = true;
									$total_skor = 0;
									foreach ($skor as $key1 => $val1) {
										//if first time through, we need a header row
										if ($first) { ?>
											<table class="table table-bordered">
												<thead>
													<tr>
														<th>Nama Alternatif</th>
														<?php
														foreach ($val1 as $key2 => $value2) {
															$nama_kriteria = mysqli_query($db, "SELECT * FROM kriteria WHERE kd_kriteria = '" . $array_kriteria[$key2] . "'");
															$row_nama = $nama_kriteria->fetch_assoc();
														?><th><?php echo $row_nama['nm_kriteria'] ?></th>
														<?php
														} ?>
														<th style="background-color:#4D4D4D;color:white">Vektor</th>
													</tr>
												</thead>
											<?php
											//set control to false
											$first = false;
										}
										//echo out each object in the table
										$nama_pakan = mysqli_query($db, "SELECT * FROM pakan WHERE kd_pakan = '" . $array_pakan[$key1] . "'");
										$row_nama_pakan = $nama_pakan->fetch_assoc();
											?>
											<tr>
												<th><?php echo $row_nama_pakan['nm_pakan'] ?></th>
												<?php
												foreach ($val1 as $key2 => $value2) {
													$n		= $value2;
													if ($n == '') {
														$nn = 0;
													} else {
														$nn = $n;
													}
												?><td class='text-center'><?php echo number_format($nn, 3) ?></td>
												<?php
												}
												?><td style="background-color:#BFBFBF"><?php echo number_format($vektor[$key1], 3) ?></td>
											</tr><?php

												} ?>
											</table>
											<br>
											<div class='box-header'>
												<h4 class='box-title'>Bobot</h4>
											</div>
											<?php krsort($vektor); ?>


											<table class="table table-bordered">
												<thead>
													<th>Nama Alternatif</th>
													<th>Nilai Bobot</th>
												</thead>
												<?php
												foreach ($vektor as $rr => $nilai) { ?>
													<tr>

														<th><?php
															$nama_pakan = mysqli_query($db, "SELECT * FROM pakan WHERE kd_pakan = '" . $array_pakan[$rr] . "'");
															$row_nama_pakan = $nama_pakan->fetch_assoc();
															echo $row_nama_pakan['nm_pakan'];
															?>
														</th>
														<td><?php echo round($nilai, 3) ?></td>
													</tr>
												<?php
												}
												?>
											</table>
											<?php
											$akhir = microtime(true) - $mulai;
											?>
											<br>
											<div id="area">
												<div class='box-header'>
													<h4 class='box-title'>Rangking</h4>
												</div>

												<?php arsort($vektor); ?>
												<table class="table table-bordered" id='area'>
													<thead>
														<th>Nama Alternatif</th>
														<th>Nilai Vektor</th>
														<th>Rangking</th>
													</thead>
													<?php
													$no = 1;
													foreach ($vektor as $rr => $nilai) { ?>
														<tr>

															<th><?php
																$nama_pakan = mysqli_query($db, "SELECT * FROM pakan WHERE kd_pakan = '" . $array_pakan[$rr] . "'");
																$row_nama_pakan = $nama_pakan->fetch_assoc();
																echo $row_nama_pakan['nm_pakan'];
																?>
															</th>
															<td><?php echo round($nilai, 3) ?></td>
															<td><?php echo $no;
																$no++; ?></td>
														</tr>
													<?php
													}
													?>
												</table>
												<br>
												<div class='box-header'>
													<h4 class='box-title'>Waktu Eksekusi Program</h4>
												</div>
												<table class='table table-bordered'>
													<thead>
														<tr>
															<th><?= round($akhir, 4) ?> microdetik</th>
														</tr>
														<thead>
												</table>
												</thead>
								</table>
								<br>

	</div>
	<div class="d-flex flex-row-reverse"> <button class="btn btn-primary" onclick="ceta('area')">Cetak</button></div>
	</body>
<?php } 	
}?>

</html>
												