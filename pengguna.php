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
                <i class="fas fa-plus-square"></i> Tambah Data
            </button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Lengkap</th>
                            <th>Jenis Kelamin</th>
                            <th>Alamat Email</th>
                            <th>Username</th>
                            <th>Password</th>
                            <th>Level</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        $ambildatapengguna = mysqli_query($conn, "select * from pengguna");
                        $i = 1;
                        while ($data = mysqli_fetch_array($ambildatapengguna)) {
                            $nama_lengkap = $data['nama_lengkap'];
                            $jenis_kelamin = $data['jenis_kelamin'];
                            $alamat_email = $data['alamat_email'];
                            $username = $data['username'];
                            $iduser = $data['iduser'];
                            $password = $data['password'];
                            $level = $data['level'];

                        ?>

                            <tr>
                                <td><?= $i++; ?></td>
                                <td><?= $nama_lengkap; ?></td>
                                <td><?= $jenis_kelamin; ?></td>
                                <td><?= $alamat_email; ?></td>
                                <td><?= $username; ?></td>
                                <td><?= $password; ?></td>
                                <td><?= $level; ?></td>
                                <td>
                                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#ubah<?= $iduser; ?>">
                                        <i class="far fa-edit"></i> Ubah
                                    </button>
                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#hapus<?= $iduser; ?>">
                                        <i class="fas fa-trash"></i> Hapus
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
                                        <!--  -->
                                        <!-- Modal body -->
                                        <form method="post">
                                            <div class="modal-body">
                                                <input type="text" name="nama_lengkap" value="<?= $nama_lengkap; ?>" class="form-control" placeholder="Nama Lengkap" required>
                                                <br>
                                                <select name="jenis_kelamin" value="<?= $jenis_kelamin; ?>" class="form-control" placeholder="Jenis Kelamin" required>
                                                    <option>--Jenis Kelamin--</option>
                                                    <option value="Laki-Laki">Laki-Laki</option>
                                                    <option value="Perempuan">Perempuan</option>
                                                </select>
                                                <br>
                                                <input type="email" name="alamat_email" value="<?= $alamat_email; ?>" class="form-control" placeholder="Alamat Email" required>
                                                <br>
                                                <input type="username" name="username" value="<?= $username; ?>" class="form-control" placeholder="Username" required>
                                                <br>
                                                <input type="password" name="password" class="form-control" value="<?= $password; ?>" placeholder="Password">
                                                <br>
                                                <select name="level" value="<?= $level; ?>" class="form-control" placeholder="Level Pengguna" required>
                                                    <option value="2">--Pilih Level Pengguna--</option>
                                                    <option value="1">Admin</option>
                                                    <option value="2">User</option>
                                                </select>
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
    <!-- The Modal tambah data -->
    <div class="modal fade" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Data Pengguna</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <form method="post">
                    <div class="modal-body">
                        <input type="text" name="nama_lengkap" placeholder="Nama Lengkap" class="form-control" required>
                        <br>
                        <select name="jenis_kelamin" class="form-control">
                            <option>--Jenis Kelamin--</option>
                            <option value="Laki-Laki">Laki-Laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                        <br>
                        <input type="text" name="alamat_email" placeholder="Alamat Email" class="form-control" required>
                        <br>
                        <input type="username" name="username" placeholder="Username" class="form-control" required>
                        <br>
                        <input type="password" name="password" placeholder="Password" class="form-control" required>
                        <br>
                        <select name="level" class="form-control">
                            <option value="2">--Pilih Level Pengguna--</option>
                            <option value="1">Admin</option>
                            <option value="2">User</option>
                        </select>
                        <br>
                        <button type="submit" name="addnewpengguna" class="btn btn-primary">Simpan</button>
                        <br>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>