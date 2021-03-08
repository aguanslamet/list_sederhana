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
    <div class="card o-hidden border-0 shadow-lg my-5 col-lg-4 mx-auto">
        <div class="card-body p-0">
            <div class="col mt-3 mb-3">
                <h4 class=" text-center">Masukan Akun</h4>
                <?= $this->session->flashdata('massage') ?>
                <form action="<?= base_url('login') ?>" method="post">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" class="form-control" id="email" name="email" placeholder="masukan email">
                        <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>

                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                        <?= form_error('password', '<small class="text-danger pl-3">', '</small>'); ?>

                    </div>

                    <button type="submit" class="btn btn-success btn-block">Masuk</button>
                </form>
                <div class="text-center">
                    <a class="small ce" href="<?= base_url(); ?>login/register">Daftar</a>
                </div>


            </div>
        </div>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="<?= base_url('assets/') ?>js/jquery-3.5.1.slim.min.js"></script>
    <script src="<?= base_url('assets/') ?>js/popper.min.js"></script>
    <script src="<?= base_url('assets/') ?>js/bootstrap.min.js"></script>
</body>

</html>