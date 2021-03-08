<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->

    <link rel="stylesheet" href="<?= base_url('assets') ?>/css/bootstrap.min.css">

    <title>Hello, world!</title>
</head>

<body>
    <!-- navbar -->
    <nav class="navbar navbar-light bg-dark justify-content-between">
        <div class="container">
            <a class="navbar-brand text-white">List Data</a>
            <form class="form-inline">
                <a href="<?= base_url('home/logout') ?>" class="btn btn-danger" type="submit">Keluar</a>
            </form>
        </div>
    </nav>
    <!-- end navbar -->
    <!-- tabel -->
    <div class="card o-hidden border-0 shadow-lg my-5 col-lg-8 mx-auto">
        <div class="card-body p-0">
            <div class="card-body">
                <a href="<?= base_url('list_file/tambah'); ?>" class="btn btn-success mb-3 mt-2" data-toggle="modal" data-target="#tambahdokumenModal">Tambah</a>
                <?= $this->session->flashdata('message'); ?>
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>

                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama File</th>
                                <th scope="col">Lihat File</th>
                                <th scope="col">Pilihan</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php $i = 1;
                            foreach ($post as $ps) : ?>
                                <tr>
                                    <th scope="row"><?= $i++; ?></th>
                                    <td><?= $ps['nama_file']; ?></td>
                                    <td> <a href="../assets/file/<?= $ps['file'] ?>" target="_blank"> Download </a>
                                    </td>
                                    <td>

                                        <a href="<?= base_url('list_file/edit/') . $ps['id_file'] ?>" class="btn btn-success btn-sm" data-toggle="modal" data-target="#editdokumenModal<?= $ps['id_file'] ?>">Edit</a>
                                        <a href="<?= base_url('list_file/hapus/') . $ps['id_file'] ?>" class="btn btn-danger btn-sm">Hapus</a>


                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- end tabel -->


    <!-- tambah Data -->

    <div class="modal fade" id="tambahdokumenModal" tabindex="-1" aria-labelledby="tambahdokumenModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahdokumenModalLabel">Tambah Dokumen</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <?= form_open_multipart('list_file/tambah'); ?>

                    <div class="form-group">
                        <label for="dokumen">Nama Dokumen</label>
                        <input type="text" id="nama_file" name="nama_file" class="form-control" placeholder="dokumen Apa...">
                        <?= form_error('nama_file', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="input-group">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="file" id="file" aria-describedby="inputGroupFileAddon01">
                            <label class="custom-file-label" for="file">Pilih File</label>
                        </div>
                    </div>
                </div>


                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success">Tambah</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <!-- End Data -->

    <!-- edit data -->

    <?php $i = 0;
    foreach ($post as $ps) : $i ?>
        <div class="modal fade" id="editdokumenModal<?= $ps['id_file'] ?>" tabindex="-1" aria-labelledby="editdokumenModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editdokumenModalLabel">Tambah Dokumen Pendukung</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <?= form_open_multipart('list_file/edit/'); ?>
                        <input type="hidden" name="id_file" value="<?= $ps['id_file']; ?>">

                        <div class="form-group">
                            <label for="dokumen">Nama Dokumen</label>
                            <input type="text" id="nama_file" name="nama_file" class="form-control" value="<?= $ps['nama_file'] ?>">
                            <?= form_error('nama_file', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>

                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="file" id="file" aria-describedby=" inputGroupFileAddon01">
                                <label class="custom-file-label" for="file"><?= $ps['file']; ?></label>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        </div>
    <?php endforeach ?>
    <!-- end edit data -->


































</body>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="<?= base_url('assets/') ?>js/jquery-3.5.1.slim.min.js"></script>
<script src="<?= base_url('assets/') ?>js/popper.min.js"></script>
<script src="<?= base_url('assets/') ?>js/bootstrap.min.js"></script>
<script>
    $('.custom-file-input').on('change', function() {
        let fileName = $(this).val().split('\\').pop();
        $(this).next('.custom-file-label').addClass("selected").html(fileName);
    });
</script>

</html>