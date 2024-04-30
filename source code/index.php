<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Film.php');
include('classes/Genre.php');
include('classes/Negara.php');
include('classes/Sutradara.php');
include('classes/Template.php');

// buat instance pengurus
$listFilm = new Film($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);

// buka koneksi
$listFilm->open();
// tampilkan data pengurus
$listFilm->getFilmJoin();

// cari pengurus
if (isset($_POST['btn-cari'])) {
    // methode mencari data pengurus
    $listFilm->searchFilm($_POST['cari']);
} else {
    // method menampilkan data pengurus
    $listFilm->getFilmJoin();
}

$data = null; 

// ambil data pengurus
// gabungkan dgn tag html
// untuk di passing ke skin/template
while ($row = $listFilm->getResult()) {
    $data .= '<div class="col gx-2 gy-3 justify-content-center">' .
        '<div class="card pt-4 px-2 film-thumbnail">
        <a href="detail.php?id=' . $row['id_film'] . '">
            <div class="row justify-content-center">
                <img src="assets/images/' . $row['foto_film'] . '" class="card-img-top" alt="' . $row['foto_film'] . '">
            </div>
            <div class="card-body">
                <p class="card-text judul-film my-0">' . $row['judul_film'] . '</p>
                <p class="card-text nama-genre my-0">' . $row['nama_genre'] . '</p>
                <p class="card-text nama-sutradara">' . $row['nama_sutradara'] . '</p>
                <p class="card-text nama-negara">' . $row['nama_negara'] . '</p>
            </div>
        </a>
    </div>    
    </div>';
}

// tutup koneksi
$listFilm->close();

// buat instance template
$home = new Template('templates/skin.html');

// simpan data ke template
$home->replace('DATA_FILM', $data);
$home->write();
