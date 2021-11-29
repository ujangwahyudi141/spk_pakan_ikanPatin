<?php
class Pengguna
{
    function buat($data)
    {
        $koneksi = new koneksi;
        $conn = $koneksi->koneksi();
        $nama_lengkap = $data['nama_lengkap'];
        $jenis_kelamin = $data['jenis_kelamin'];
        $alamat_email = $data['alamat_email'];
        $username = $data['username'];
        $password = $data['password'];
        $level = $data['level'];
        return $queryinsert = mysqli_query($conn, "insert into pengguna (nama_lengkap,jenis_kelamin,alamat_email,username, password, level) values ('$nama_lengkap','$jenis_kelamin','$alamat_email','$username','$password','$level')");
    }
    function ubah($data)
    {
        $koneksi = new koneksi;
        $conn = $koneksi->koneksi();
        $nama_lengkap = $data['nama_lengkap'];
        $jenis_kelamin = $data['jenis_kelamin'];
        $alamat_email = $data['alamat_email'];
        $username = $data['username'];
        $password = $data['password'];
        $level = $data['level'];
        $iduser   = $data['iduser'];
        $queryupdate = mysqli_query($conn, "update pengguna set nama_lengkap='$nama_lengkap', jenis_kelamin='$jenis_kelamin', alamat_email='$alamat_email', username='$username', password='$password' where iduser='$iduser'");
    }
    function hapus($iduser)
    {
        $koneksi = new koneksi;
        $conn = $koneksi->koneksi();
        $querydelete = mysqli_query($conn, "delete from pengguna where iduser='$iduser'");
    }
}
