<?php
include "./class/class_koneksi.php";
include "./class/class_pengguna.php";
include "./class/class_kriteria.php";
include "./class/class_pakan.php";
$pengguna = new Pengguna;
$kriteria = new Kriteria;
$pakan = new Pakan;
//Membuat koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "dbpakan");

//Menambah data kriteria
if (isset($_POST['addnewkriteria'])) {
    $data['kd_kriteria'] = $_POST['kd_kriteria'];
    $data['nm_kriteria'] = $_POST['nm_kriteria'];
    $data['tipe'] = $_POST['tipe'];
    $data['bobot'] = $_POST['bobot'];

    $addtotable = $kriteria->buat($data);
    if ($addtotable) {
        header('index1.php?page=form-kriteria');
    } else {
        echo 'Gagal!';
        header('index1.php?page=form-kriteria');
    }
}

//Menambah data pakan
if (isset($_POST['addnewpakan'])) {
    $data['kd_pakan'] = $_POST['kd_pakan'];
    $data['nm_pakan'] = $_POST['nm_pakan'];

    $addtotable = $pakan->buat($data);
    if ($addtotable) {
        header('index1.php?page=form-pakan');
    } else {
        echo 'Gagal!';
        header('index1.php?page=form-pakan');
    }
}

//Update Ubah Data Kriteria
if (isset($_POST['updatekriteria'])) {
    $data['kd_kriteria'] = $_POST['kd_kriteria'];
    $data['nm_kriteria'] = $_POST['nm_kriteria'];
    $data['tipe'] = $_POST['tipe'];
    $data['bobot'] = $_POST['bobot'];

    $update = $kriteria->ubah($data);
    if ($update) {
        header('index1.php?page=form-kriteria');
    } else {
        echo 'Gagal!';
        header('index1.php?page=form-kriteria');
    }
}

//Hapus Data Kriteria
if (isset($_POST['hapuskriteria'])) {
    $kd_kriteria = $_POST['kd_kriteria'];

    $hapus = mysqli_query($conn, "delete from kriteria where kd_kriteria='$kd_kriteria'");
    if ($hapus) {
        header('index1.php?page=form-kriteria');
    } else {
        echo 'Gagal!';
        header('index1.php?page=form-kriteria');
    }
}

//Update Ubah Data Pakan
if (isset($_POST['updatepakan'])) {
    $data['kd_pakan'] = $_POST['kd_pakan'];
    $data['nm_pakan'] = $_POST['nm_pakan'];

    $update = $pakan->ubah($data);
    if ($update) {
        header('index1.php?page=form-pakan');
    } else {
        echo 'Gagal!';
        header('index1.php?page=form-pakan');
    }
}

//Hapus Data Pakan
if (isset($_POST['hapuspakan'])) {
    $kd_pakan = $_POST['kd_pakan'];

    $hapus = $pakan->hapus($kd_pakan);
    if ($hapus) {
        header('index1.php?page=form-pakan');
    } else {
        echo 'Gagal!';
        header('index1.php?page=form-pakan');
    }
}

//Menambah Data Pengguna
if (isset($_POST['addnewpengguna'])) {
    $data['nama_lengkap'] = $_POST['nama_lengkap'];
    $data['jenis_kelamin'] = $_POST['jenis_kelamin'];
    $data['alamat_email'] = $_POST['alamat_email'];
    $data['username'] = $_POST['username'];
    $data['password'] = $_POST['password'];
    $data['level'] = $_POST['level'];

    $query = mysqli_query($conn, "SELECT * FROM pengguna WHERE username = '$data[username]'");
    $jmlh = mysqli_num_rows($query);
    if ($jmlh == 0) {

        $queryinsert = $pengguna->buat($data);
        if ($queryinsert) {
            header('location:index1.php?page=form-pengguna');
        } else {
            header('location:index1.php?page=form-pengguna');
        }
    } else {
        echo "
            <script> alert('Username Telah Terdaftar'); history.go(-1); </script>
        ";
    }
}

//Ubah Data Pengguna
if (isset($_POST['updatepengguna'])) {
    $data['nama_lengkap'] = $_POST['nama_lengkap'];
    $data['jenis_kelamin'] = $_POST['jenis_kelamin'];
    $data['alamat_email'] = $_POST['alamat_email'];
    $data['username'] = $_POST['username'];
    $data['password'] = $_POST['password'];
    $data['level'] = $_POST['level'];
    $data['iduser'] = $_POST['iduser'];
    $queryupdate = $pengguna->ubah($data);

    if ($queryupdate) {
        header('location:index1.php?page=form-pengguna');
    } else {
        header('location:index1.php?page=form-pengguna');
    }
}

//Hapus Data Pengguna
if (isset($_POST['hapuspengguna'])) {
    $iduser = $_POST['iduser'];
    $querydelete = $pengguna->hapus($iduser);
    if ($querydelete) {
        header('location:index1.php?page=form-pengguna');
    } else {
        header('location:index1.php?page=form-pengguna');
    }
}

//Menambah Data Pengguna
if (isset($_POST['registrasi'])) {
    $data['nama_lengkap'] = $_POST['nama_lengkap'];
    $data['jenis_kelamin'] = $_POST['jenis_kelamin'];
    $data['alamat_email'] = $_POST['alamat_email'];
    $data['username'] = $_POST['username'];
    $data['password'] = $_POST['password'];
    $data['level'] = $_POST['level'];

    if($_POST['jenis_kelamin']==""){

        echo"
        <script>
            alert('Jenis Kelamin Belum di Pilih !');
            history.go(-1); 
        </script>
        ";
    }
    else{

        $query = mysqli_query($conn, "SELECT * FROM pengguna WHERE username = '$data[username]'");
        $jmlh = mysqli_num_rows($query);
        if ($jmlh == 0) {
    
            $queryinsert = $pengguna->buat($data);
            if ($queryinsert) {
                header('location:index.php');
            } else {
                header('location:registrasi.php');
            }
        } else {
            echo "
                <script> alert('Username Telah Terdaftar'); history.go(-1); </script>
            ";
        }

    }

}
