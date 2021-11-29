<?php
$koneksi = new koneksi;
$conn = $koneksi->koneksi();
?>

<div class="box-header">
	<h3 class="box-title ">Nilai Preferensi</h3>
</div>

<table class="table table-bordered table-responsive">
	<thead>
		<tr>
			<th>Nomor</th>
			<th>Nama</th>
			<th>V<sub>i</sub></th>
		</tr>

	</thead>
	<tbody>
		<?php
		$i = 1;
		$a = mysqli_query($conn, "select * from pakan order by kd_pakan asc;");
		echo "<tr>";
		$sortir = array();
		while ($da = mysqli_fetch_assoc($a)) {



			$idalt = $da['kd_pakan'];

			//ambil nilai

			$n = mysqli_query($conn, "select * from penilaian where kd_pakan='$idalt' order by id ASC");

			$c = 0;
			$ymax = array();
			while ($dn = mysqli_fetch_assoc($n)) {
				$idk = $dn['kd_kriteria'];


				//nilai kuadrat

				$nilai_kuadrat = 0;
				$k = mysqli_query($conn, "select * from penilaian where kd_kriteria='$idk' order by id ASC ");
				while ($dkuadrat = mysqli_fetch_assoc($k)) {
					$nilai_kuadrat = $nilai_kuadrat + ($dkuadrat['nilai'] * $dkuadrat['nilai']);
				}

				//hitung jml alternatif
				$jml_alternatif = mysqli_query($conn, "select * from pakan order by kd_pakan asc;");
				$jml_a = mysqli_num_rows($jml_alternatif);
				//nilai bobot kriteria (rata")
				$bobot = 0;
				$tnilai = 0;

				$k2 = mysqli_query($conn, "select * from penilaian where kd_kriteria='$idk' order by id ASC ");
				while ($dbobot = mysqli_fetch_assoc($k2)) {
					$tnilai = $tnilai + $dbobot['nilai'];
				}
				$bobot = $tnilai / $jml_a;

				//nilai bobot input
				$b2 = mysqli_query($conn, "select * from kriteria where kd_kriteria='$idk'");
				$nbot = mysqli_fetch_assoc($b2);
				$bot = $nbot['bobot'];

				$v = round(($dn['nilai'] / sqrt($nilai_kuadrat)) * $bot);

				$ymax[$c] = $v;
				$c;
				$mak = max($ymax);
				$min = min($ymax);
			}

			$i++;
		}




		foreach (@$_SESSION['dplus'] as $key => $dxmin) {
			#ubah ke nol hasil akhir
			$nilaid = 0;
			$nilaiPre = 0;
			$nilai = 0;

			$jarakm = $_SESSION['dmin'][$key];
			$id_alt = $_SESSION['id_alt'][$key];

			//nama alternatif
			$nama = mysqli_query($conn, "select * from pakan where kd_pakan='$id_alt'");
			$nm = mysqli_fetch_assoc($nama);

			$nilaiPre = $dxmin + $jarakm;

			$nilaid = $jarakm / $nilaiPre;


			$nilai = round($nilaid, 4);

			//$sql2=mysqli_query($conn,"insert into nilai_preferensi (nm_alternatif,nilai) values('$nm','$nilai')");
			$i = 1;
			echo "<>
           <td>" . $i++ . "</td>
           <td>$nm[nm_pakan]</td>
           <td>$nilai</td>";
		}


		//ambil data sesuai dengan nilai tertinggi


		echo "</tr>";
		?>

	</tbody>
</table>