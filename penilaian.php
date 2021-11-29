<div class="container-fluid">
    <div class="mt-2">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index1.php?page=dashboard">Beranda</a></li>
                <li class="breadcrumb-item active" aria-current="page">Penilaian</li>
            </ol>
        </nav>
    </div>
    <hr>
    <div class="card mb-4">
        <div class="card-header">

        </div>
        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Pakan</th>
                            <th>Tahap Penilaian</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        $ambildatapakan = mysqli_query($conn, "select * from pakan");
                        foreach ($ambildatapakan as $pakan) :
                        ?>
                            <tr>
                                <td><?= $no ?></td>
                                <td><?= $pakan['nm_pakan'] ?></td>
                                <td>

                                    <?php
                                    $kd_pakan = $pakan['kd_pakan'];
                                    $kriteria = mysqli_query($conn, "select * from kriteria");
                                    $kriteria_count = mysqli_num_rows($kriteria);
                                    $penilaian = mysqli_query($conn, "SELECT * FROM `penilaian` WHERE kd_pakan = '$kd_pakan' ");
                                    $penilaian_count = mysqli_num_rows($penilaian);
                                    if ($penilaian_count == $kriteria_count) {
                                        $col = 98;
                                        $text_penilaian = "100 %";
                                    } else if ($penilaian_count == false) {
                                        $col = 0;
                                        $text_penilaian = "0%";
                                    } else {
                                        $tot = ($penilaian_count / $kriteria_count * 100);
                                        $col = $tot - 2;
                                        $text_penilaian = round($tot, 1) . " %";
                                    }
                                    ?>
                                    <div style="width:150px;height:30px;background:none;text-align:center;padding:1px;border:1px solid #1E90FF;border-radius:3px">
                                        <div style="width:<?php echo $col ?>%;height:90%;background:#1E90FF;text-align:center;padding:1px;border:1px solid #1E90FF;border-radius:3px"></div>
                                        <h6 style="margin-top:-25px;" class="text-white"><?php echo $text_penilaian ?></h6>
                                    </div>
                                </td>
                                <td>
                                    <!-- Button to Open the Modal -->
                                    <center>
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal<?= $no ?>">
                                            Input Nilai
                                        </button>
                                        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#ubah<?= $no ?>">
                                            <i class="far fa-edit"></i> Ubah
                                        </button>
                                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#hapus<?= $no ?>">
                                            <i class="fas fa-trash"></i> Hapus
                                        </button>
                                    </center>
                                </td>
                            </tr>
                            <!-- modal input nilai -->
                            <div class="modal fade" id="myModal<?= $no ?>">
                                <div class="modal-dialog">
                                    <div class="modal-content">

                                        <!-- Modal Header -->
                                        <div class="modal-header">
                                            <h4 class="modal-title"> Input Nilai Alternatif</h4>
                                            <!-- <p>Kode Pakan <?= $pakan['kd_pakan'] ?></p> -->
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>

                                        <!-- Modal body -->
                                        <form method="post" action="simpan_nilai.php">
                                            <div class="modal-body">
                                                <?php
                                                foreach ($kriteria as $kr) :
                                                ?>
                                                    <input type="hidden" name="pakan" value="<?= $pakan['kd_pakan'] ?>">
                                                    <div class="mb-3 row">
                                                        <div class="col-sm-6">
                                                            <h5><?= $kr['nm_kriteria'] ?> :</h5>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <select name="nilai[]" class="form-control" required>
                                                                <option>--Beri Nilai--</option>
                                                                <option value="3">3</option>
                                                                <option value="4">4</option>
                                                                <option value="5">5</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                <?php endforeach ?>
                                                <button type="submit" class="btn btn-primary" name="simpannilai">Simpan</button>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>
                            <!-- akhir modal input nilai -->

                            <!-- modal edit penilaian -->
                            <div class="modal fade" id="ubah<?= $no ?>">
                                <div class="modal-dialog">
                                    <div class="modal-content">

                                        <!-- Modal Header -->
                                        <div class="modal-header">
                                            <h4 class="modal-title"> Edit Nilai Alternatif</h4>
                                            <!-- <p>Kode Pakan <?= $pakan['kd_pakan'] ?></p> -->
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>

                                        <!-- Modal body -->
                                        <form method="post" action="simpan_nilai.php">
                                            <div class="modal-body">
                                                <?php
                                                $nilain = mysqli_query($conn, "SELECT penilaian.nilai, penilaian.kd_pakan, kriteria.nm_kriteria FROM penilaian, kriteria WHERE penilaian.kd_kriteria = kriteria.kd_kriteria AND penilaian.kd_pakan = '$pakan[kd_pakan]'");
                                                foreach ($nilain as $nilai) :
                                                ?>
                                                    <input type="hidden" name="pakan" value="<?= $pakan['kd_pakan'] ?>">
                                                    <div class="mb-3 row">
                                                        <div class="col-sm-6">
                                                            <h5><?= $nilai['nm_kriteria'] ?> :</h5>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <select name="nilai[]" class="form-control" required>
                                                                <option><?= $nilai['nilai'] ?></option>
                                                                <option value="3">3</option>
                                                                <option value="4">4</option>
                                                                <option value="5">5</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                <?php
                                                endforeach ?>
                                                <button type="submit" class="btn btn-primary" name="simpannilai">Simpan</button>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>
                            <!-- akhir modal edit penilaian -->

                            <!-- modal hapus penilaian -->
                            <div class="modal fade" id="hapus<?= $no ?>">
                                <div class="modal-dialog">
                                    <div class="modal-content">

                                        <!-- Modal Header -->
                                        <div class="modal-header">
                                            <h4 class="modal-title">Hapus Data Penilaian</h4>
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
                            <!-- akhir modal hapus penilaian -->
                            <?php $no++ ?>
                        <?php endforeach ?>


                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- The Modal  tambah kriteria-->