<?php
class koneksi
{
    function koneksi()
    {

        return   $koneksi = mysqli_connect("localhost", "root", "", "dbpakan");
    }
    function DoLogin()
    {
        // ob_start();
        // session_start();

        $username = $_POST['username'];
        $password = $_POST['password'];
        $conn = $this->koneksi();
        $query = mysqli_query($conn, "select * from pengguna where username='$username'");
        $user = mysqli_fetch_array($query);
        $cek = mysqli_num_rows($query);
        if ($cek > 0) {
            if ($username == $user['username'] && $password == $user['password']) {
                //jika username dan password salah
                // echo 'bERHASIL';

                session_start();
                $_SESSION['level'] = $user['level'];
                Header('Location:../index1.php?page=dashboard');
            } else {
                echo "<script>alert('Password Salah!');history.go(-1);</script>";
            }
        } else {
            echo "
                    <script> alert('Username Tidak Terdaftar'); history.go(-1);</script>
                ";
        }
    }

    function Registrasi()
    {
        global $conn;

        $username = $_POST['username'];
        $password = $_POST['password1'];
        $password = $_POST['password2'];
        $conn = $this->koneksi();
        $query = mysqli_query($conn, "select * from pengguna where username='$username'");
        $user = mysqli_fetch_array($query);
        $cek = mysqli_num_rows($query);
        if ($cek > 0) {
            if ($username == $user['username'] && $password == $user['password']) {

                Header('Location:../index.php');
            }
        }
    }
}
