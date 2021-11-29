<?php
class Kriteria
{
  function buat($data)
  {
    $koneksi = new koneksi;
    $conn = $koneksi->koneksi();
    $kd_kriteria = $data['kd_kriteria'];
    $nm_kriteria = $data['nm_kriteria'];
    $tipe = $data['tipe'];
    $bobot = $data['bobot'];

    return  $queryinsert = mysqli_query($conn, "insert into kriteria (kd_kriteria, nm_kriteria, tipe, bobot) values('$kd_kriteria','$nm_kriteria','$tipe','$bobot')");
  }
  function ubah($data)
  {
    $koneksi = new koneksi;
    $conn = $koneksi->koneksi();
    $kd_kriteria = $data['kd_kriteria'];
    $nm_kriteria = $data['nm_kriteria'];
    $tipe  = $data['tipe'];
    $bobot = $data['bobot'];
    return $queryupdate = mysqli_query($conn, "update kriteria set kd_kriteria='$kd_kriteria', nm_kriteria='$nm_kriteria', tipe='$tipe', bobot='$bobot' where kd_kriteria = '$kd_kriteria'");
  }
  function hapus($iduser)
  {
    $koneksi = new koneksi;
    $conn = $koneksi->koneksi();
    return  $querydelete = mysqli_query($conn, "delete from login where iduser='$iduser'");
  }
}
