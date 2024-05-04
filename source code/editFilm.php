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

$data = null;

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if ($id > 0) {
        $film->getFilmById($id);
        $genre->getGenre();
        $negara->getNegara();
        $sutradara->getSutradara();
        $row = $film->getResult();

        $data .= '<div class="card-header text-center">
            <h3 class="my-0">Edit ' . $row['judul_film'] . '</h3>
        </div>
        <div class="card-body">
            <form action="detail.php?id=' . $id . '" enctype="multipart/form-data" method="post">
                <input type="hidden" name="id" value="' . $row['id_film'] . '">
                <span>
                    <img src="assets/images/' .$row['foto_film'] .'" width=300px>
                </span>
                <div class="form-group">
                    <label for="judul_film" class="form-label">Foto</label>
                    <br>
                    <input type="file" class="form-control" id="foto_film" name="foto_film">
                </div>
                <div class="form-group">
                    <label for="judul_film" class="form-label">Judul</label>
                    <input type="text" class="form-control" id="judul" name="judul" value="' . $row['judul_film'] . '">
                </div>
                <div class="form-group">
                    <label for="genre" class="form-label">Genre</label>
                    <select class="form-select" id="id_genre" name="id_genre" required>';
                        while ($rowGenre = $genre->getResult()) {
                            $data .= '<option value="' . $rowGenre['id_genre'] . '"';
                            if($rowGenre['nama_genre'] == $row['nama_genre']){
                                $data .= 'selected';
                            }
                            $data .= '>' . $rowGenre['nama_genre'] . '</option>';
                        }

                        $data .= '</select>
                </div>
                <div class="form-group">
                    <label for="durasi" class="form-label">Durasi (menit)</label>
                    <input type="number" class="form-control" id="durasi_film" name="durasi_film" value="' . $row['durasi_film'] . '">
                </div>
                <div class="form-group">
                    <label for="sutradara" class="form-label">Sutradara</label>
                    <select class="form-select" id="id_sutradara" name="id_sutradara" required>';
                    while ($rowSutradara = $sutradara->getResult()) {
                        $data .= '<option value="' . $rowSutradara['id_sutradara'] . '"';
                        if($rowSutradara['nama_sutradara'] == $row['nama_sutradara']){
                            $data .= 'selected';
                        }
                        $data .= '>' . $rowSutradara['nama_sutradara'] . '</option>';
                    }

                    $data .= '</select>
                </div>
                <div class="form-group">
                    <label for="negara" class="form-label">Negara</label>
                    <select class="form-select" id="id_negara" name="id_negara" required>';
                    while ($rowNegara = $negara->getResult()) {
                        $data .= '<option value="' . $rowNegara['id_negara'] . '"';
                        if($rowNegara['nama_negara'] == $row['nama_negara']){
                            $data .= 'selected';
                        }
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
                    <a href="detail.php?id=' . $id . '"><button type="submit" name="submit" class="btn btn-success text-white">Simpan Perubahan</button>
                </div>
            </form>
        </div>';
    }
}

$film->close();
$edit = new Template('templates/skinform.html');
$edit->replace('DATA_EDIT_FILM', $data);
$edit->write();
?>
