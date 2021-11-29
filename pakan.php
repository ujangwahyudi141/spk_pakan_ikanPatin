<div class="container-fluid">
    <div class="mt-2">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index1.php?page=dashboard">Beranda</a></li>
                <li class="breadcrumb-item active" aria-current="page">Pakan</li>
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
                            <th>Kode Pakan</th>
                            <th>Nama Pakan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        $ambildatapakan = mysqli_query($conn, "select * from pakan");
                        $i = 1;
                        while ($data = mysqli_fetch_array($ambildatapakan)) {
                            $kd_pakan = $data['kd_pakan'];
                            $nm_pakan = $data['nm_pakan'];
                        ?>
                            <tr>
                                <td><?= $i++; ?></td>
                                <td><?= $kd_pakan; ?></td>
                                <td><?= $nm_pakan; ?></td>
                                <td>
                                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#ubah<?= $kd_pakan; ?>">
                                        <i class="far fa-edit"></i> Ubah
                                    </button>
                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#hapus<?= $kd_pakan; ?>">
                                        <i class="fas fa-trash"></i> Hapus
                                    </button>
                                </td>
                            </tr>

                            <!-- Ubah Modal -->
                            <div class="modal fade" id="ubah<?= $kd_pakan; ?>">
                                <div class="modal-dialog">
                                    <div class="modal-content">

                                        <!-- Modal Header -->
                                        <div class="modal-header">
                                            <h4 class="modal-title">Ubah Data Pakan</h4>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>

                                        <!-- Modal body -->
                                        <form method="post">
                                            <div class="modal-body">
                                                <input type="text" name="kd_pakan" value="<?= $kd_pakan; ?>" class="form-control" required>
                                                <br>
                                                <input type="text" name="nm_pakan" value="<?= $nm_pakan; ?>" class="form-control" required>
                                                <br>
                                                <input type="hidden" name="kd_pakan" value="<?= $kd_pakan; ?>">
                                                <button type="submit" class="btn btn-primary" name="updatepakan">Simpan</button>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>

                            <!-- Hapus Modal -->
                            <div class="modal fade" id="hapus<?= $kd_pakan; ?>">
                                <div class="modal-dialog">
                                    <div class="modal-content">

                                        <!-- Modal Header -->
                                        <div class="modal-header">
                                            <h4 class="modal-title">Hapus Data Pakan</h4>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>

                                        <!-- Modal body -->
                                        <form method="post">
                                            <div class="modal-body">
                                                Anda Yakin?
                                                <input type="hidden" name="kd_pakan" value="<?= $kd_pakan; ?>">
                                                <br>
                                                <br>
                                                <button type="submit" class="btn btn-danger" name="hapuspakan">Hapus</button>
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
</div>
</main>
<!-- The Modal -->
<div class="modal fade" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Tambah Data Pakan</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <form method="post">
                <div class="modal-body">
                    <input type="text" name="kd_pakan" placeholder="Kode Pakan" class="form-control" required>
                    <br>
                    <input type="text" name="nm_pakan" placeholder="Nama Pakan" class="form-control" required>
                    <br>
                    <button type="submit" class="btn btn-primary" name="addnewpakan">Submit</button>
                </div>
            </form>

        </div>
    </div>
</div>