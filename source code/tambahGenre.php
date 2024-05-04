<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Genre.php');
include('classes/Template.php');

$genre = new Genre($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$genre->open();

$data = null;

$data .= '<div class="card-header text-center">
            <h3 class="my-0">Tambah Genre</h3>
        </div>
        <div class="card-body">
            <form action="genre.php" enctype="multipart/form-data" method="post">
                <div class="form-group">
                    <label for="genre" class="form-label">Genre</label>
                    <input type="text" class="form-control" id="nama_genre" name="nama_genre" required>
                </div>
                <div class="card-footer text>
                    <a href="index.php><button type="submit" name="submit" class="btn btn-success text-white">Tambah Genre</button>
                </div>
            </form>
        </div>';

$genre->close();
$tambah = new Template('templates/skinform.html');
$tambah->replace('DATA_TAMBAH_GENRE', $data);
$tambah->write();
?>
