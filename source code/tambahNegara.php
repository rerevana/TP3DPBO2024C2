<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Negara.php');
include('classes/Template.php');

$negara = new Negara($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$negara->open();

$data = null;

$data .= '<div class="card-header text-center">
            <h3 class="my-0">Tambah Negara</h3>
        </div>
        <div class="card-body">
            <form action="negara.php" enctype="multipart/form-data" method="post">
                <div class="form-group">
                    <label for="negara" class="form-label">Negara</label>
                    <input type="text" class="form-control" id="nama_negara" name="nama_negara" required>
                </div>
                <div class="card-footer text>
                    <a href="index.php><button type="submit" name="submit" class="btn btn-success text-white">Tambah Negara</button>
                </div>
            </form>
        </div>';

$negara->close();
$tambah = new Template('templates/skinform.html');
$tambah->replace('DATA_TAMBAH_NEGARA', $data);
$tambah->write();
?>
