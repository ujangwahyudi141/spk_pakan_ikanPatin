<?php
 require './proses/function.php';

// if (isset($_POST['login'])) {
//     $username = $_POST['username'];
//     $password = $_POST['password'];

//$cekdatabase = mysqli_query($conn, "SELECT * FROM login where username='$username' and password='$password' ");
//     $hitung = mysqli_num_rows($cekdatabase);

//     if ($hitung > 0) {
//         $_SESSION['log'] = 'True';
//         header('location:index1.php');
//     } else {
//         header('location:index.php');
//     }
// }

// if (!isset($_SESSION['log'])) {
// } else {
//     header('location:index1.php');
// }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Login</title>
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
</head>

<body class="bg-primary">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-5">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header">
                                    <marquee style="font-family: times new roman; font-size:20px; color:#000000">Silahkan Login...</marquee>
                                </div>
                                <div class="card-body">
                                    <form method="post" action="proses/login.php">
                                        <div class="col-auto">
                                            <label class="sr-only" for="inlineFormInputGroup">Username</label>
                                            <div class="input-group mb-2">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text"><i class="fas fa-user"></i></div>
                                                </div>
                                                <input type="text" name="username" class="form-control" id="inlineFormInputGroup" placeholder="Username">
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <label class="sr-only" for="inlineFormInputGroup">Password</label>
                                            <div class="input-group mb-2">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text"><i class="fas fa-lock"></i></div>
                                                </div>
                                                <input type="password" name="password" class="form-control" id="inlineFormInputGroup" placeholder="Password">
                                            </div>
                                        </div>
                                        <div class="form-group d-flex align-items-center justify-content-between mt- mb-0">
                                            <button class="btn btn-primary mb-2" type="submit" name="submit"><i class="fas fa-sign-in-alt"></i> Login</button>
                                        </div>
                                        <div class="text-center">
                                            <hr>
                                            <a class="small" href="registrasi.php">Membuat Akun?</a>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
</body>

</html>