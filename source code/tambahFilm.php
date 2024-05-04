<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Film.php');
include('classes/Genre.php');
include('classes/Negara.php');
include('classes/Sutradara.php');
include('classes/Template.php');

$film = new Film($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$film->open();

$genre = new Genre($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$genre->open();

$negara = new Negara($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$negara->open();

$sutradara = new Sutradara($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$sutradara->open();

$genre->getGenre();
$sutradara->getSutradara();
$negara->getNegara();

$data = null;

$data .= '<div class="card-header text-center">
            <h3 class="my-0">Tambah Film Baru</h3>
        </div>
        <div class="card-body">
            <form action="index.php" enctype="multipart/form-data" method="post">
                <div class="form-group">
                    <label for="foto_film" class="form-label">Foto</label>
                    <br>
                    <input type="file" class="form-control" id="foto_film" name="foto_film">
                </div>
                <div class="form-group">
                    <label for="judul_film" class="form-label">Judul</label>
                    <input type="text" class="form-control" id="judul" name="judul">
                </div>
                <div class="form-group">
                    <label for="genre" class="form-label">Genre</label>
                    <select class="form-select" id="id_genre" name="id_genre" required>';
                        while ($rowGenre = $genre->getResult()) {
                            $data .= '<option value="' . $rowGenre['id_genre'] . '"';
                            $data .= '>' . $rowGenre['nama_genre'] . '</option>';
                        }

                        $data .= '</select>
                </div>
                <div class="form-group">
                    <label for="durasi" class="form-label">Durasi (menit)</label>
                    <input type="number" class="form-control" id="durasi_film" name="durasi_film">
                </div>
                <div class="form-group">
                    <label for="sutradara" class="form-label">Sutradara</label>
                    <select class="form-select" id="id_sutradara" name="id_sutradara" required>';
                    while ($rowSutradara = $sutradara->getResult()) {
                        $data .= '<option value="' . $rowSutradara['id_sutradara'] . '"';
                        $data .= '>' . $rowSutradara['nama_sutradara'] . '</option>';
                    }

                    $data .= '</select>
                </div>
                <div class="form-group">
                    <label for="negara" class="form-label">Negara</label>
                    <select class="form-select" id="id_negara" name="id_negara" required>';
                    while ($rowNegara = $negara->getResult()) {
                        $data .= '<option value="' . $rowNegara['id_negara'] . '"';
                        $data .= '>' . $rowNegara['nama_negara'] . '</option>';
                    }

                    $data .= '</select>
                </div>
                <div class="form-group">
                    <label for="judul" class="form-label">Rating Usia Film</label>
                    <select class="form-select" id="rating_usia_film" name="rating_usia_film" required>
                        <option value="SU">SU</option>
                        <option value="P 2+">P 2+</option>
                        <option value="A 7+">A 7+</option>
                        <option value="R 13+">R 13+</option>
                        <option value="D 17+">D 17+</option>
                    </select>
                </div>
                <div class="card-footer text>
                    <a href="index.php><button type="submit" name="submit" class="btn btn-success text-white">Tambah Film</button>
                </div>
            </form>
        </div>';

$film->close();
$tambah = new Template('templates/skinform.html');
$tambah->replace('DATA_TAMBAH_FILM', $data);
$tambah->write();
?>
