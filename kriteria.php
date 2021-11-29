<div class="container-fluid">
    <div class="mt-2">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index1.php?page=dashboard">Beranda</a></li>
                <li class="breadcrumb-item active" aria-current="page">Kriteria</li>
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
                            <th>Kode Kriteria</th>
                            <th>Nama Kriteria</th>
                            <th>Tipe</th>
                            <th>Bobot</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        $ambildatakriteria = mysqli_query($conn, "select * from kriteria");
                        $i = 1;
                        while ($data = mysqli_fetch_array($ambildatakriteria)) {
                            $kd_kriteria = $data['kd_kriteria'];
                            $nm_kriteria = $data['nm_kriteria'];
                            $tipe = $data['tipe'];
                            $bobot = $data['bobot'];
                        ?>
                            <tr>
                                <td><?= $i++; ?></td>
                                <td><?= $kd_kriteria; ?></td>
                                <td><?= $nm_kriteria; ?></td>
                                <td><?= $tipe; ?></td>
                                <td><?= $bobot; ?></td>
                                <td>
                                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#ubah<?= $kd_kriteria; ?>">
                                        <i class="far fa-edit"></i> Ubah
                                    </button>
                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#hapus<?= $kd_kriteria; ?>">
                                        <i class="fas fa-trash"></i> Hapus
                                    </button>
                                </td>
                            </tr>

                            <!-- Ubah Modal -->
                            <div class="modal fade" id="ubah<?= $kd_kriteria; ?>">
                                <div class="modal-dialog">
                                    <div class="modal-content">

                                        <!-- Modal Header -->
                                        <div class="modal-header">
                                            <h4 class="modal-title">Ubah Data Kriteria</h4>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>

                                        <!-- Modal body -->
                                        <form method="post">
                                            <div class="modal-body">
                                                <input type="text" name="kd_kriteria" value="<?= $kd_kriteria; ?>" class="form-control" required>
                                                <br>
                                                <input type="text" name="nm_kriteria" value="<?= $nm_kriteria; ?>" class="form-control" required>
                                                <br>
                                                <input type="text" name="tipe" value="<?= $tipe; ?>" class="form-control" required>
                                                <br>
                                                <input type="number" name="bobot" value="<?= $bobot; ?>" class="form-control" required>
                                                <br>
                                                <input type="hidden" name="kd_kriteria" value="<?= $kd_kriteria; ?>">
                                                <button type="submit" class="btn btn-primary" name="updatekriteria">Simpan</button>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>

                            <!-- Hapus Modal -->
                            <div class="modal fade" id="hapus<?= $kd_kriteria; ?>">
                                <div class="modal-dialog">
                                    <div class="modal-content">

                                        <!-- Modal Header -->
                                        <div class="modal-header">
                                            <h4 class="modal-title">Hapus Data Kriteria</h4>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>

                                        <!-- Modal body -->
                                        <form method="post">
                                            <div class="modal-body">
                                                Anda Yakin ?
                                                <input type="hidden" name="kd_kriteria" value="<?= $kd_kriteria; ?>">
                                                <br>
                                                <br>
                                                <button type="submit" class="btn btn-danger" name="hapuskriteria">Hapus</button>
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
<!-- The Modal  tambah kriteria-->
<div class="modal fade" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Tambah Data Kriteria</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <form method="post">
                <div class="modal-body">
                    <input type="text" name="kd_kriteria" placeholder="Kode Kriteria" class="form-control" required>
                    <br>
                    <input type="text" name="nm_kriteria" placeholder="Nama Kriteria" class="form-control" required>
                    <br>
                    <input type="text" name="tipe" placeholder="Tipe" class="form-control" required>
                    <br>
                    <input type="number" name="bobot" placeholder="Bobot %" class="form-control" required>
                    <br>
                    <button type="submit" class="btn btn-primary" name="addnewkriteria">Submit</button>
                </div>
            </form>

        </div>
    </div>
</div>