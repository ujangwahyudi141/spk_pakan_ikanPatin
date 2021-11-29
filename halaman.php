<div class="container-fluid">
    <div class="mt-2">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index1.php?page=dashboard">Beranda</a></li>
                <li class="breadcrumb-item active" aria-current="page">Pengguna</li>
            </ol>
        </nav>
    </div>
    <hr>
    <div class="card mb-4">
        <div class="card-header">
            <!-- Button to Open the Modal -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                Tambah Data
            </button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Username</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        $ambildatapengguna = mysqli_query($conn, "select * from login");
                        $i = 1;
                        while ($data = mysqli_fetch_array($ambildatapengguna)) {
                            $username = $data['username'];
                            $iduser = $data['iduser'];
                            $password = $data['password'];

                        ?>

                            <tr>
                                <td><?= $i++; ?></td>
                                <td><?= $username; ?></td>
                                <td>
                                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#ubah<?= $iduser; ?>">
                                        Ubah
                                    </button>
                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#hapus<?= $iduser; ?>">
                                        Hapus
                                    </button>
                                </td>
                            </tr>
                            <!-- Ubah Modal -->
                            <div class="modal fade" id="ubah<?= $iduser; ?>">
                                <div class="modal-dialog">
                                    <div class="modal-content">

                                        <!-- Modal Header -->
                                        <div class="modal-header">
                                            <h4 class="modal-title">Ubah Data Pengguna</h4>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>

                                        <!-- Modal body -->
                                        <form method="post">
                                            <div class="modal-body">
                                                <input type="username" name="username" value="<?= $username; ?>" class="form-control" placeholder="Username" required>
                                                <br>
                                                <input type="password" name="password" class="form-control" value="<?= $password; ?>" placeholder="Password">
                                                <br>
                                                <input type="hidden" name="iduser" value="<?= $iduser; ?>">
                                                <button type="submit" class="btn btn-primary" name="updatepengguna">Simpan</button>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>
                            <!-- Hapus Modal -->
                            <div class="modal fade" id="hapus<?= $iduser; ?>">
                                <div class="modal-dialog">
                                    <div class="modal-content">

                                        <!-- Modal Header -->
                                        <div class="modal-header">
                                            <h4 class="modal-title">Hapus Data Pengguna</h4>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>

                                        <!-- Modal body -->
                                        <form method="post">
                                            <div class="modal-body">
                                                Anda Yakin ?
                                                <input type="hidden" name="iduser" value="<?= $iduser; ?>">
                                                <br>
                                                <br>
                                                <button type="submit" class="btn btn-danger" name="hapuspengguna">Hapus</button>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- The Modal -->
    <div class="modal fade" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Data Pengguna</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <form method="post" action="index.php?page=kelola-pengguna">
                    <div class="modal-body">
                        <input type="username" name="username" placeholder="Username" class="form-control" required>
                        <br>
                        <input type="password" name="password" placeholder="Password" class="form-control" required>
                        <br>
                        <button type="submit" name="submit" class="btn btn-primary" name="addnewpengguna">Simpan</button>
                    </div>
                </form>

            </div>
        </div>
    </div>