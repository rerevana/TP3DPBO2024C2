<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Genre.php');
include('classes/Film.php');
include('classes/Negara.php');
include('classes/Sutradara.php');
include('classes/Template.php');

// Buat instance Pengurus
$formFilm = new Film($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);

// Buka koneksi
$formFilm->open();

// Data default untuk form
$dataValNama = '';
$optionsGenre = '';
$optionsNegara = '';
$optionsSutradara = '';

// Ambil daftar divisi dan jabatan dari database
$genre = new Genre($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$genre->open();
$genre->getGenre();
while ($rowGenre = $genre->getResult()) {
    $optionsGenre .= '<option value="' . $rowGenre['id_genre'] . '">' . $rowGenre['nama_genre'] . '</option>';
}
$genre->close();

$negara = new Negara($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$negara->open();
$negara->getNegara();
while ($rowNegara = $negara->getResult()) {
    $optionsNegara .= '<option value="' . $rowNegara['id_negara'] . '">' . $rowNegara['nama_negara'] . '</option>';
}
$negara->close();

$sutradara = new Sutradara($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$sutradara->open();
$sutradara->getSutradara();
while ($rowSutradara = $sutradara->getResult()) {
    $optionsSutradara .= '<option value="' . $rowSutradara['id_sutradara'] . '">' . $rowSutradara['nama_sutradara'] . '</option>';
}
$sutradara->close();

// Proses form pengurus (tambah atau edit)
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['submit'])) {
        // Ambil data dari form
        $data = array(
            'nama' => $_POST['nama'],
            'judul_film' => $_POST['judul_film'],
            'id_genre' => $_POST['id_genre'],
            'durasi_film' => $_POST['durasi_film'],
            'id_sutradara' => $_POST['id_sutradara'],
            'id_negara' => $_POST['id_negara'],
            'rating_usia_film' => $_POST['rating_usia_film']
        );

        // Periksa apakah sedang proses tambah atau edit
        if (isset($_GET['id'])) {
            // Jika sedang edit, panggil method updateData dengan argumen tambahan $file
            $result = $formFilm->updateData($_GET['id'], $data, null); // Argumen ketiga disertakan
        } else {
            // Jika sedang tambah, panggil method addData
            $result = $formFilm->addData($data);
        }

        // Redirect ke halaman utama setelah proses selesai
        header('Location: index.php');
        exit();
    }
}

// Jika sedang edit, ambil data pengurus berdasarkan ID
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $formFilm->getFilmById($id);
    $row = $formFilm->getResult();

    // Isi data default untuk form dengan data pengurus yang akan di-edit
    $dataValNama = $row['nama_film'];
}

// Tutup koneksi
$formFilm->close();

// Buat instance template untuk halaman form pengurus
$form = new Template('templates/skinform.html');

// Simpan data ke template
$form->replace('PAGE_TITLE', 'Form Pengisian Film');
$form->replace('FORM_TITLE', isset($_GET['id']) ? 'Edit Film' : 'Tambah Film');
$form->replace('FORM_ACTION', isset($_GET['id']) ? 'form_film.php?id=' . $_GET['id'] : 'form_film.php');
$form->replace('DATA_VAL_NAMA', $dataValNama);
$form->replace('OPTIONS_GENRE', $optionsGenre);
$form->replace('OPTIONS_NEGARA', $optionsNegara);
$form->replace('OPTIONS_SUTRADARA', $optionsSutradara);
$form->replace('SUBMIT_BUTTON_LABEL', isset($_GET['id']) ? 'Update' : 'Tambah');

// Tampilkan template
$form->write();
?>