<?php
class Pakan
{
    function buat($data)
    {
        $koneksi = new koneksi;
        $conn = $koneksi->koneksi();


        $kd_pakan = $data['kd_pakan'];
        $nm_pakan = $data['nm_pakan'];

        return $queryinsert = mysqli_query($conn, "insert into pakan (kd_pakan, nm_pakan) values('$kd_pakan','$nm_pakan')");
    }
    public function ubah($data)
    {
        $koneksi = new koneksi;
        $conn = $koneksi->koneksi();
        $kd_pakan = $data['kd_pakan'];
        $nm_pakan = $data['nm_pakan'];

        return $update = mysqli_query($conn, "update pakan set nm_pakan='$nm_pakan' where kd_pakan = '$kd_pakan'");
    }
    public function hapus($data)
    {
        $koneksi = new koneksi;
        $conn = $koneksi->koneksi();
        $hapus = mysqli_query($conn, "delete from pakan where kd_pakan='$data'");
        $hapus2 = mysqli_query($conn, "delete from penilaian where kd_pakan='$data'");
    }
}
