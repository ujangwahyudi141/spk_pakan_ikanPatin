<?php
class FunctionTOPSIS
{
    public function PerhitunganTOPSIS()
    {
        $mulai = microtime(true);
        $koneksi = new koneksi;
        $conn = $koneksi->koneksi();
        $s = mysqli_query($conn, "select * from kriteria");
        $h = mysqli_num_rows($s);
        echo "<div class='container mt-3'>";
        echo " <div class='box-header'>
                <h4>Hasil Seleksi</h4>
                <hr>
             <h4 class='box-title' >Nilai Matriks</h4>
            </div>
             <table class='table table-bordered'>
              <thead>
                  <tr>
                      <th rowspan='2'><center>Nama</center></th>
                      <th colspan='$h'><center>Kriteria</center></th>
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
		                
		                <th>" . $da['nm_pakan'] . "</th>";
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
            <br>
        ";
        //Nilai Matriks Ternormalisasi
        $s = mysqli_query($conn, "select * from kriteria");
        $h = mysqli_num_rows($s);
        echo "
             <div class='box-header'>
                <h4 class='box-title'>Nilai Matriks Ternormalisasi</h4>
             </div>
    
            <table class='table table-bordered'>
            <thead>
                <tr>
                    
                    <th rowspan='2'><center>Nama</center></th>
                    <th colspan= '$h'><center>Kriteria</center></th>
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
                       
                        <th>$da[nm_pakan]</th>";
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
        <br>
        ";
        //Nilai Bobot Ternormalisasi
        $s = mysqli_query($conn, "select * from kriteria");
        $h = mysqli_num_rows($s);
        echo "
             <div class='box-header'>
                <h4 class='box-title'>Nilai Bobot Ternormalisasi</h4>
             </div>
    
            <table class='table table-bordered'>
            <thead>
                <tr>
                 
                    <th rowspan='2'><center>Nama</center></th>
                    <th colspan= '$h'><center>Kriteria</center></th>
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
                       
                        <th>$da[nm_pakan]</th>";
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
        <br>
        ";
        //Matriks Ideal Positif dan Negatif
        $s = mysqli_query($conn, "select * from kriteria");
        $h = mysqli_num_rows($s);
        echo "
        <div class='box-header'>
           <h4 class='box-title'>Matrik Ideal Positif</h4>
        </div>

       <table class='table table-bordered'>
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
                <br>
            ";

        // tabel ideal negatif
        echo "
            <div class='box-header'>
                 <h4 class='box-title' >Matriks Ideal Negatif	(A<sup>-</sup>)</h4>
            </div> 
            <table class='table table-bordered'>
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
                <br>
            ";
        //Jarak Solusi Ideal Positif dan Negatif

        $koneksi = new koneksi;
        $conn = $koneksi->koneksi();
?>
        <div class="box-header">
            <h4 class="box-title ">Jarak Solusi Ideal Positif (D<sup>+</sup>)</h4>
        </div>

        <table class="table table-bordered">
            <thead>
                <tr>

                    <th>
                        <center>Nama</center>
                    </th>
                    <th>
                        <center>D<sup>+</sup></center>
                    </th>
                </tr>

            </thead>
            <tbody>
                <?php
                $i2 = 1;
                $i3 = 0;
                $maxarray = array();
                $a2 = mysqli_query($conn, "select * from kriteria order by kd_kriteria asc;");
                echo "<tr>";
                while ($da2 = mysqli_fetch_assoc($a2)) {

                    $idalt2 = $da2['kd_kriteria'];

                    //ambil nilai

                    $n2 = mysqli_query($conn, "select * from penilaian where kd_kriteria='$idalt2'  order by id ASC");
                    $jarakp2 = 0;
                    $c2 = 0;
                    $ymax2 = array();

                    while ($dn2 = mysqli_fetch_assoc($n2)) {
                        $idk2 = $dn2['kd_kriteria'];

                        //nilai kuadrat

                        $nilai_kuadrat2 = 0;
                        $k2 = mysqli_query($conn, "select * from penilaian where kd_kriteria='$idk2' order by id ASC ");
                        while ($dkuadrat2 = mysqli_fetch_assoc($k2)) {
                            $nilai_kuadrat2 = $nilai_kuadrat2 + ($dkuadrat2['nilai'] * $dkuadrat2['nilai']);
                        }

                        //hitung jml alternatif
                        $jml_alternatif2 = mysqli_query($conn, "select * from pakan");

                        $jml_a2 = mysqli_num_rows($jml_alternatif2);
                        //nilai bobot kriteria (rata")
                        $bobot2 = 0;
                        $tnilai2 = 0;

                        $k22 = mysqli_query($conn, "select * from penilaian where kd_kriteria='$idk2'  order by id ASC ");
                        while ($dbobot2 = mysqli_fetch_assoc($k22)) {
                            $tnilai2 = $tnilai2 + $dbobot2['nilai'];
                        }
                        $bobot2 = $tnilai2 / $jml_a2;

                        //nilai bobot input
                        $b2 = mysqli_query($conn, "select * from kriteria where kd_kriteria='$idk2'");
                        $nbot2 = mysqli_fetch_assoc($b2);
                        $bot2 = $nbot2['bobot'];


                        $v2 = round(($dn2['nilai'] / sqrt($nilai_kuadrat2)) * $bot2, 4);

                        $ymax2[$c2] = $v2;
                        $c2++;

                        #cek benefit atau cost  
                        // echo $nbot2['sifat']." - ".$nbot2['nama_kriteria']."<br>";


                        if ($nbot2['tipe'] == 'Benefit') {
                            $mak2 = max($ymax2);
                        } else {
                            $mak2 = min($ymax2);
                        } #cek benefit atau cost

                    }
                    /*				
echo "<i>ini ymax2</i>";    
echo "<pre>";    
print_r($ymax2);    
echo "</pre>";  
*/

                    //echo $mak2."| ";    
                    //hitung D+			
                    foreach ($ymax2 as $nymax2) {

                        $jarakp2 = $jarakp2 + pow($nymax2 - $mak2, 2);
                    }

                    //array max
                    $maxarray[$i3] = $mak2;

                    //print_r($maxarray);
                    //print_r(max($ymax2));			
                    $i2++;
                    $i3++;
                }
                //session array ymax
                $_SESSION['ymax'] = $maxarray;

                /*    
echo "<i>ini min  max</i>";    
echo "<pre>";    
print_r($maxarray);    
echo "</pre>";    
*/

                //array baris//////////////////////////////////////////////////
                $i = 1;
                $ii = 0;
                $dpreferensi = array();

                $a = mysqli_query($conn, "select * from pakan order by kd_pakan asc;");
                echo "<tr>";
                while ($da = mysqli_fetch_assoc($a)) {

                    $idalt = $da['kd_pakan'];

                    //ambil nilai			
                    $n = mysqli_query($conn, "select * from penilaian where kd_pakan='$idalt' order by id ASC");
                    $jarakp = 0;
                    $c = 0;
                    $ymax = array();
                    $arraymaks = array();
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

                        $v = round(($dn['nilai'] / sqrt($nilai_kuadrat)) * $bot, 4);

                        $ymax[$c] = $v;
                        $c++;
                        $mak = max($ymax);
                    }

                    /*    
echo "<i>ini bobot normalisasi</i>";        
echo "<pre>";    
print_r($ymax);    
echo "</pre>";   
*/

                    //hitung D+ 
                    foreach ($ymax as $nymax => $value) {
                        $maks = $_SESSION['ymax'][$nymax];
                        //echo $maks." - ";

                        //echo $value."| ";

                        $final = sqrt($jarakp = $jarakp + pow($value - $maks, 2));
                        //echo $jarakp." || ";
                    }

                    echo "<tr>
		
		<th>$da[nm_pakan]</th>
		<td>" . round($final, 4) . "</td>
		</tr>";
                    $dpreferensi[$ii] = round($final, 4);
                    $_SESSION['dplus'] = $dpreferensi;
                    //print_r($ymax);

                    $i++;
                    $ii++;
                }

                echo "</tr>";

                ?>

            </tbody>
        </table>
        <br>

        <!-- tabel min ------------------------------------------------->

        <div class="box-header">
            <h4 class="box-title ">Jarak Solusi Ideal Negatif (D<sup>-</sup>)</h4>
        </div>

        <table class="table table-bordered">
            <thead>
                <tr>

                    <th>
                        <center>Nama</center>
                    </th>
                    <th>
                        <center>D<sup>-</sup></center>
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php
                //buat array kolom

                $i2 = 1;
                $i3 = 0;
                $minarray = array();
                $a2 = mysqli_query($conn, "select * from kriteria order by kd_kriteria asc;");
                echo "<tr>";
                while ($da2 = mysqli_fetch_assoc($a2)) {

                    $idalt2 = $da2['kd_kriteria'];

                    //ambil nilai

                    $n2 = mysqli_query($conn, "select * from penilaian where kd_kriteria='$idalt2' order by id ASC");
                    $jarakp2 = 0;
                    $c2 = 0;
                    $ymin2 = array();

                    while ($dn2 = mysqli_fetch_assoc($n2)) {
                        $idk2 = $dn2['kd_kriteria'];

                        //nilai kuadrat

                        $nilai_kuadrat2 = 0;
                        $k2 = mysqli_query($conn, "select * from penilaian where kd_kriteria='$idk2' order by id ASC ");
                        while ($dkuadrat2 = mysqli_fetch_assoc($k2)) {
                            $nilai_kuadrat2 = $nilai_kuadrat2 + ($dkuadrat2['nilai'] * $dkuadrat2['nilai']);
                        }

                        //hitung jml alternatif
                        $jml_alternatif2 = mysqli_query($conn, "select * from pakan order by kd_pakan asc;");

                        $jml_a2 = mysqli_num_rows($jml_alternatif2);
                        //nilai bobot kriteria (rata")
                        $bobot2 = 0;
                        $tnilai2 = 0;

                        $k22 = mysqli_query($conn, "select * from penilaian where kd_kriteria='$idk2' order by id ASC ");
                        while ($dbobot2 = mysqli_fetch_assoc($k22)) {
                            $tnilai2 = $tnilai2 + $dbobot2['nilai'];
                        }
                        $bobot2 = $tnilai2 / $jml_a2;

                        //nilai bobot input
                        $b2 = mysqli_query($conn, "select * from kriteria where kd_kriteria='$idk2'");
                        $nbot2 = mysqli_fetch_assoc($b2);
                        $bot2 = $nbot2['bobot'];

                        $v2 = round(($dn2['nilai'] / sqrt($nilai_kuadrat2)) * $bot2, 4);

                        $ymin2[$c2] = $v2;
                        $c2++;

                        #cek benefit atau cost
                        if ($nbot2['tipe'] == 'Cost') {
                            $min2 = max($ymin2);
                        } else {
                            $min2 = min($ymin2);
                        } #cek benefit atau cost

                        //$min2=min($ymin2);

                    }

                    //hitung D+

                    foreach ($ymin2 as $nymin2) {

                        $jarakp2 = $jarakp2 + pow($nymin2 - $min2, 2);
                        //echo "--".$mak."---";
                    }

                    //array max
                    $minarray[$i3] = $min2;

                    //print_r($maxarray);
                    //print_r(max($ymax2));

                    $i2++;
                    $i3++;
                }
                //session array ymax
                $_SESSION['ymin'] = $minarray;

                //array baris//////////////////////////////////////////////////
                $i = 1;
                $ii = 0;
                $id_alt = array();
                $a = mysqli_query($conn, "select * from pakan order by kd_pakan asc;");
                echo "<tr>";
                while ($da = mysqli_fetch_assoc($a)) {

                    $idalt = $da['kd_pakan'];

                    //ambil nilai

                    $n = mysqli_query($conn, "select * from penilaian where kd_pakan='$idalt' order by id ASC");
                    $jarakp = 0;
                    $c = 0;
                    $ymax = array();
                    $arraymin = array();
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

                        $v = round(($dn['nilai'] / sqrt($nilai_kuadrat)) * $bot, 4);

                        $ymin[$c] = $v;
                        $c++;
                        $min = max($ymin);
                    }
                    //hitung D+
                    foreach ($ymin as $nymin => $value) {
                        $mins = $_SESSION['ymin'][$nymin];
                        //	echo $mins." - ";
                        $final = sqrt($jarakp = $jarakp + pow($value - $mins, 2));
                        //	echo $jarakp." || ";

                    }

                    echo "<tr>
		
		<th>$da[nm_pakan]</th>
		<td>" . round($final, 4) . "</td>
		</tr>";
                    //session min
                    $dpreferensi[$ii] = round($final, 4);
                    $_SESSION['dmin'] = $dpreferensi;
                    // print_r($ymin);

                    //ambil id alternatif
                    $id_alt[$ii] = $da['kd_pakan'];
                    $_SESSION['id_alt'] = $id_alt;

                    $i++;
                    $ii++;
                }

                echo "</tr>
                </table>
                <br>";
                //Nilai Preferensi Vi
                $koneksi = new koneksi;
                $conn = $koneksi->koneksi();
                ?>

                <div class="box-header">
                    <h4 class="box-title ">Nilai Preferensi</h4>
                </div>

                <table class="table table-bordered">
                    <thead>
                        <tr>

                            <th>
                                <center>Nama</center>
                            </th>
                            <th>
                                <center>V<sup>i</sup></center>
                            </th>
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

                        $a = 0;
                        $nilai = array();
                        $rangking = array();
                        foreach (@$_SESSION['dplus'] as $key => $dxmin) {
                            #ubah ke nol hasil akhir
                            $nilaid = 0;
                            $nilaiPre = 0;
                            $nilai[$a] = 0;

                            $jarakm = $_SESSION['dmin'][$key];
                            $id_alt = $_SESSION['id_alt'][$key];

                            //nama alternatif
                            $nama = mysqli_query($conn, "select * from pakan where kd_pakan='$id_alt'");

                            $nm = mysqli_fetch_assoc($nama);

                            $nilaiPre = $dxmin + $jarakm;

                            $nilaid = $jarakm / $nilaiPre;


                            $nilai[$a] = round($nilaid, 4);
                            $rangking[$a] = array($nilai[$a], $nm['nm_pakan']);
                            $a++;
                            //$sql2=mysqli_query($conn,"insert into nilai_preferensi (nm_alternatif,nilai) values('$nm','$nilai')");
                        }
                        $i = 1;
                        $b = 0;
                        $looping = mysqli_query($conn, "select * from pakan");
                        foreach ($looping as $nm) {
                            echo "<tr>
            
                    <th>$nm[nm_pakan]</th>
                    <td>$nilai[$b]</td>
                    </tr>";
                            $b++;
                        }
                        echo "
                </table>
                <br>
                ";


                        //ambil data sesuai dengan nilai tertinggi



                        echo " 
                <div id='area'>
                <div class='box-header'>
                <h4 class='box-title' >Perengkingan</h4>
                </div>
                <table class='table table-bordered' >
                <thead>
                <tr>
                <th>Nama Pakan</th>
                <th>Nilai Preferensi</th>
                <th>rangking</th>
                </tr>
                </thead>
                <tbody>";
                        rsort($rangking);
                        $c = 0;
                        $d = 1;
                        foreach ($rangking as $rank) {
                            $namaPakan = $rangking[$c][1];
                            $nilaiV    = $rangking[$c][0];
                            echo "
                    <tr>
                    <th>$namaPakan</th>
                    <td>$nilaiV</td>
                    <td>" . $d . "</td> 
                    </tr>
                    ";
                            $c++;
                            $d++;
                        }
                        echo "
                </tbody>
                </table>
                <br>";
                        // penutup container
                        echo "</tr>
                </table>";

                        $akhir = microtime(true) - $mulai;
                        echo " <div class='box-header'>
                <h4 class='box-title' >Waktu Eksekusi Program</h4>
               </div>
                <table class='table table-bordered'>
                 <thead>
                     <tr>
                         <th>" . round($akhir, 4) . " microdetik</th>
                    </tr>
                 <thead>
                </table>
                <br>
                ";
                        echo "
                </div>";
                        ?>
                        <div class="d-flex flex-row-reverse"><button class="btn btn-primary" onclick="ceta('area')">cetak</button></div>
                        </div>
                <?php    }
        } ?>