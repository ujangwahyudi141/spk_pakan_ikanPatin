<?php
class KeputusanTOPSIS
{
    public function nilai_matriks()
    {
        $koneksi = new koneksi;
        $conn = $koneksi->koneksi();
        $s = mysqli_query($conn, "select * from kriteria");
        $h = mysqli_num_rows($s);
        echo " <div class='box-header'>
             <h3 class='box-title' >Nilai Matriks</h3>
            </div>
            <div class='table table-bordered table-responsive'>
             <table class='table table-bordered table-responsive'>
              <thead>
                  <tr>
                      <th rowspan='2'>No</th>
                      <th rowspan='2'>Nama</th>
                      <th colspan='$h'>Kriteria</th>
                 </tr>
                 <tr> ";
        for ($n = 1; $n <= $h; $n++) {
            echo "<th>C{$n}</th>";
        }
        echo "
                </tr>
              </thead>
              <tbody>";
        $i = 0;
        $a = mysqli_query($conn, "select * from pakan order by kd_pakan asc;");

        while ($da = mysqli_fetch_assoc($a)) {
            echo "<tr>
		                <td>" . (++$i) . "</td>
		                <td>" . $da['nm_pakan'] . "</td>";
            $idalt = $da['kd_pakan'];
            //ambil nilai
            $n = mysqli_query($conn, "select * from penilaian where kd_pakan ='$idalt' order by kd_pakan asc");
            while ($dn = mysqli_fetch_assoc($n)) {

                echo "<td align='center'>$dn[nilai]</td>";
            }
            echo "</tr>\n";
        }
        echo "
            </tbody>
            </table>
            </div>
        
        ";
    }
    public function normalisasi()
    {
        $koneksi = new koneksi;
        $conn = $koneksi->koneksi();
        $s = mysqli_query($conn, "select * from kriteria");
        $h = mysqli_num_rows($s);
        echo "
             <div class='box-header'>
                <h3 class='box-title'>Nilai Matriks Ternormalisasi</h3>
             </div>
    
            <table class='table table-bordered table-responsive'>
            <thead>
                <tr>
                    <th rowspan='2'>No</th>
                    <th rowspan='2'>Nama</th>
                    <th colspan= '$h'>Kriteria</th>
                </tr>
                <tr>
        ";
        for ($n = 1; $n <= $h; $n++) {
            echo "<th>C{$n}</th>";
        }

        echo "</thead>
                <tbody>";
        $i = 0;
        $a = mysqli_query($conn, "select * from pakan order by kd_pakan asc");
        while ($da = mysqli_fetch_assoc($a)) {


            echo "<tr>
                        <td>" . (++$i) . "</td>
                        <td>$da[nm_pakan]</td>";
            $idalt = $da['kd_pakan'];

            //ambil nilai

            $n = mysqli_query($conn, "select * from penilaian where kd_pakan='$idalt' order by id asc");

            while ($dn = mysqli_fetch_assoc($n)) {
                $idk = $dn['kd_kriteria'];

                //nilai kuadrat

                $nilai_kuadrat = 0;
                $k = mysqli_query($conn, "select * from penilaian where kd_kriteria='$idk' ");
                while ($dkuadrat = mysqli_fetch_assoc($k)) {
                    $nilai_kuadrat = $nilai_kuadrat + ($dkuadrat['nilai'] * $dkuadrat['nilai']);
                }

                echo "<td align='center'>" . round(($dn['nilai'] / sqrt($nilai_kuadrat)), 3) . "</td>";
            }
            echo "</tr>\n";
        }
        echo "
        </tbody>
        </table>
        ";
    }

    public function normalisasi_bobot()
    {
        $koneksi = new koneksi;
        $conn = $koneksi->koneksi();
        $s = mysqli_query($conn, "select * from kriteria");
        $h = mysqli_num_rows($s);
        echo "
             <div class='box-header'>
                <h3 class='box-title'>Nilai Bobot Ternormalisasi</h3>
             </div>
    
            <table class='table table-bordered table-responsive'>
            <thead>
                <tr>
                    <th rowspan='2'>No</th>
                    <th rowspan='2'>Nama</th>
                    <th colspan= '$h'>Kriteria</th>
                </tr>
                <tr>
        ";
        for ($n = 1; $n <= $h; $n++) {
            echo "<th>C{$n}</th>";
        }

        echo "</thead>
                <tbody>";
        $i = 0;
        $a = mysqli_query($conn, "select * from pakan order by kd_pakan asc");
        while ($da = mysqli_fetch_assoc($a)) {


            echo "<tr>
                        <td>" . (++$i) . "</td>
                        <td>$da[nm_pakan]</td>";
            $idalt = $da['kd_pakan'];

            //ambil nilai

            $n = mysqli_query($conn, "select * from penilaian where kd_pakan='$idalt' order by id asc");

            while ($dn = mysqli_fetch_assoc($n)) {
                $idk = $dn['kd_kriteria'];

                //nilai kuadrat

                $nilai_kuadrat = 0;
                $k = mysqli_query($conn, "select * from penilaian where kd_kriteria='$idk' ");
                while ($dkuadrat = mysqli_fetch_assoc($k)) {
                    $nilai_kuadrat = $nilai_kuadrat + ($dkuadrat['nilai'] * $dkuadrat['nilai']);
                }

                $jml_alternatif = mysqli_query($conn, "select * from pakan");
                $jml_a = mysqli_num_rows($jml_alternatif);

                $bobot = 0;
                $tnilai = 0;
                $k2 = mysqli_query($conn, "select * from penilaian where kd_kriteria='$idk' ");
                while ($dbobot = mysqli_fetch_assoc($k2)) {
                    $tnilai = $tnilai + $dbobot['nilai'];
                }
                $bobot = $tnilai / $jml_a;
                $b2 = mysqli_query($conn, "select * from kriteria where kd_kriteria='$idk'");
                $nbot = mysqli_fetch_assoc($b2);
                $bot = $nbot['bobot'];
                echo "<td align='center'>" . round(($dn['nilai'] / sqrt($nilai_kuadrat)) * $bot, 3) . "</td>";
            }
            echo "</tr>\n";
        }
        echo "
        </tbody>
        </table>
        ";
    }

    public function matriks_ideal()
    {
        $koneksi = new koneksi;
        $conn = $koneksi->koneksi();
        $s = mysqli_query($conn, "select * from kriteria");
        $h = mysqli_num_rows($s);
        echo "
        <div class='box-header'>
           <h3 class='box-title'>Matrik Ideal Positif</h3>
        </div>

       <table class='table table-bordered table-responsive'>
       <thead>
           <tr>
               <th colspan= '$h'><center>Kriteria</center></th>
           </tr>
           <tr>
   ";
        $hk = mysqli_query($conn, "select nm_kriteria from kriteria order by kd_kriteria asc;");
        while ($dhk = mysqli_fetch_assoc($hk)) {
            echo "<th>$dhk[nm_kriteria]</th>";
        }
        echo "
            </tr>
            <tr>";
        for ($n = 1; $n <= $h; $n++) {

            echo "<th>y<sub>$n</sub><sup>+</sup></th>";
        }
        echo "
            </tr>
            </thead>
            <tbody>";
        $a = mysqli_query($conn, "select * from kriteria order by kd_kriteria asc;");
        echo "<tr>";
        while ($da = mysqli_fetch_assoc($a)) {



            $idalt = $da['kd_kriteria'];

            //ambil nilai

            $n = mysqli_query($conn, "select * from penilaian where kd_kriteria='$idalt'  order by id ASC");

            $c = 0;
            $ymax = array();
            while ($dn = mysqli_fetch_assoc($n)) {
                $idk = $dn['kd_kriteria'];


                //nilai kuadrat

                $nilai_kuadrat = 0;
                $k = mysqli_query($conn, "select * from penilaian where kd_kriteria='$idk'  order by id ASC ");
                while ($dkuadrat = mysqli_fetch_assoc($k)) {
                    $nilai_kuadrat = $nilai_kuadrat + ($dkuadrat['nilai'] * $dkuadrat['nilai']);
                }

                //hitung jml alternatif
                $jml_alternatif = mysqli_query($conn, "select * from pakan");
                $jml_a = mysqli_num_rows($jml_alternatif);
                //nilai bobot kriteria (rata")
                $bobot = 0;
                $tnilai = 0;

                $k2 = mysqli_query($conn, "select * from penilaian where kd_kriteria='$idk'  order by id ASC ");
                while ($dbobot = mysqli_fetch_assoc($k2)) {
                    $tnilai = $tnilai + $dbobot['nilai'];
                }
                $bobot = $tnilai / $jml_a;

                //nilai bobot input
                $b2 = mysqli_query($conn, "select * from kriteria where kd_kriteria='$idk'");
                $nbot = mysqli_fetch_assoc($b2);
                $bot = $nbot['bobot'];


                $v = round(($dn['nilai'] / sqrt($nilai_kuadrat)) * $bot, 4);

                $ymax[$c] = $v;
                $c++;
            }

            if ($nbot['tipe'] == 'Benefit') {
                //echo "<pre>";    
                //print_r($ymax);    
                //echo "</pre>";    

                echo "<td>" . max($ymax) . "</td>";
            } else {
                echo "<td>" . min($ymax) . "</td>";
            }
        }
        echo "</tr>
                </tbody>
                </table>
            ";

        // tabel ideal negatif
        echo "
            <div class='box-header'>
                 <h3 class='box-title' >Matriks Ideal Negatif	(A<sup>-</sup>)</h3>
            </div> 
            <table class='table table-bordered table-responsive'>
                <thead>
                <tr>
                    <th colspan=' $h'><center>Kriteria</center></th>
                </tr>
                <tr?>
            ";
        $hk = mysqli_query($conn, "select nm_kriteria from kriteria order by kd_kriteria asc;");
        while ($dhk = mysqli_fetch_assoc($hk)) {
            echo "<th>$dhk[nm_kriteria]</th>";
        }
        echo "
            </tr>
            <tr>
            ";
        for ($n = 1; $n <= $h; $n++) {

            echo "<th>y<sub>$n</sub><sup>-</sup></th>";
        }
        echo "
            </tr>
            </thead>
            <tbody>
            ";
        $i = 0;
        $a = mysqli_query($conn, "select * from kriteria order by kd_kriteria asc;");
        echo "<tr>";
        while ($da = mysqli_fetch_assoc($a)) {



            $idalt = $da['kd_kriteria'];

            //ambil nilai

            $n = mysqli_query($conn, "select * from penilaian where kd_kriteria='$idalt'  order by id ASC");

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
                $jml_alternatif = mysqli_query($conn, "select * from pakan");
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


                $v = round(($dn['nilai'] / sqrt($nilai_kuadrat)) * $bot, 4);

                $ymax[$c] = $v;
                $c++;
            }

            if ($nbot['tipe'] == 'Cost') {
                echo "<td>" . max($ymax) . "</td>";
            } else {
                echo "<td>" . min($ymax) . "</td>";
            }
        }
        echo "
                </tr>
                </tbody>
                </table>
            ";
    }
    public function jarak_solusi()
    {
        include '../jara_solusi.php';
    }
}
