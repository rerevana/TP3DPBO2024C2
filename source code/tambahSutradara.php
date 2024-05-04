<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Sutradara.php');
include('classes/Template.php');

$sutradara = new Sutradara($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$sutradara->open();

$data = null;

$data .= '<div class="card-header text-center">
            <h3 class="my-0">Tambah Sutradara</h3>
        </div>
        <div class="card-body">
            <form action="sutradara.php" enctype="multipart/form-data" method="post">
                <div class="form-group">
                    <label for="nama_sutradara" class="form-label">Nama Sutradara</label>
                    <input type="text" class="form-control" id="nama_sutradara" name="nama_sutradara" required>
                    <br>
                    <label for="jenis_kelamin_sutradara" class="form-label">Jenis Kelamin</label>
                    <select class="form-select" id="jenis_kelamin_sutradara" name="jenis_kelamin_sutradara" required>
                        <option value="Laki-Laki">Laki-Laki</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>
                </div>
                </div>
                <div class="card-footer text>
                    <a href="index.php><button type="submit" name="submit" class="btn btn-success text-white">Tambah Sutradara</button>
                </div>
            </form>
        </div>';

$sutradara->close();
$tambah = new Template('templates/skinform.html');
$tambah->replace('DATA_TAMBAH_SUTRADARA', $data);
$tambah->write();
?>
