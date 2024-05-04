<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Genre.php');
include('classes/Template.php');

$genre = new Genre($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$genre->open();

$data = null;

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if ($id > 0) {
        $genre->getGenreById($id);
        $row = $genre->getResult();

        $data .= '<div class="card-header text-center">
            <h3 class="my-0">Edit ' . $row['nama_genre'] . '</h3>
        </div>
        <div class="card-body">
            <form action="genre.php?id=' . $id . '" enctype="multipart/form-data" method="post">
                <input type="hidden" name="genre" value="' . $row['id_genre'] . '">
                <div class="form-group">
                    <label for="genre" class="form-label">Genre</label>
                    <input type="text" class="form-control" id="nama_genre" name="nama_genre" value="' . $row['nama_genre'] . '" required>
                </div>
                <div class="card-footer text>
                    <a href="index.php?id=' . $id . '"><button type="submit" name="submit" class="btn btn-success text-white">Simpan Perubahan</button>
                </div>
            </form>
        </div>';
    }
}

$genre->close();
$edit = new Template('templates/skinform.html');
$edit->replace('DATA_EDIT_GENRE', $data);
$edit->write();
?>
