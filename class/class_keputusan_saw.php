<?php
class KeputusanSAW
{
    function normalisasi($matriks, $tipe)
    {
        foreach ($matriks as $key1 => $val1) {
            foreach ($val1 as $key2 => $val2) {
                $x = $key2;
            }
            $y = $key1;
        }
        $hasil = array();
        for ($col = 0; $col <= $x; $col++) {
            $dt = array();
            for ($row = 0; $row <= $y; $row++) {
                $dt[] = $matriks[$row][$col];
                //array_push($dt,$isi);
            }
            for ($row = 0; $row <= $y; $row++) {
                if ($matriks[$row][$col] == '') {
                    $hasil[$row][$col] = 0;
                } else {
                    if ($tipe[$col] == 'Benefit') {
                        $hasil[$row][$col] = $matriks[$row][$col] / max($dt);
                    } else {
                        $hasil[$row][$col] = min($dt) / $matriks[$row][$col];
                    }
                }
            }
        }
        return $hasil;
    }

    function skor($matriks, $bobot)
    {
        foreach ($matriks as $key1 => $val1) {
            foreach ($val1 as $key2 => $val2) {
                $x = $key2;
            }
            $y = $key1;
        }
        $hasil = array();
        for ($row = 0; $row <= $x; $row++) {

            for ($col = 0; $col <= $y; $col++) {
                $hasil[$col][$row] = $matriks[$col][$row] * $bobot[$row];
            }
        }
        return $hasil;
    }

    function vektor($matriks)
    {
        foreach ($matriks as $key1 => $val1) {
            foreach ($val1 as $key2 => $val2) {
                $x = $key2;
            }
            $y = $key1;
        }
        $hasil = array();
        for ($col = 0; $col <= $y; $col++) {
            $vektor = 0;
            for ($row = 0; $row <= $x; $row++) {
                $vektor = $matriks[$col][$row] + $vektor;
            }
            $hasil[] = $vektor;
        }
        return $hasil;
    }
}
