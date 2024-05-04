<!-- Saya Revana Faliha Salma NIM 2202869 mengerjakan Soal TP3
dalam mata kuliah DPBO untuk keberkahanNya maka saya tidak melakukan 
kecurangan seperti yang telah dispesifikasikan. Aamiin. -->

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

$cari = false;
if (isset($_POST['btn-cari'])) {
    $keyword = $_POST['cari'];
    $listFilm->searchFilm($keyword);
    if ($listFilm->getAffected() < 1) {
        $cari = false;
        echo "<script>
        alert('Data film tidak ditemukan!');
            document.location.href = 'index.php';
        </script>";
    } 
    else{
        $cari = true;
    }
}

if (isset($_GET['sort_submit'])) {
    $sortBy = $_GET['sort_by'];
    $sortOrder = $_GET['sort_order'];
    $listFilm->getFilmJoin($sortBy, $sortOrder);
} else if ($cari === false) {
    
    $listFilm->getFilmJoin(); // Jika tidak ada pengurutan, ambil data tanpa pengurutan
}

if (isset($_POST['hapus'])) 
{
    if ($listFilm->deleteData($_POST['id']) > 0) {
        echo "<script>
            alert('Data berhasil dihapus!');
            document.location.href = 'index.php';
        </script>";
    } else {
        echo "<script>
        alert('Data gagal dihapus!');
        document.location.href = 'index.php';
        </script>";
    }
}

if (isset($_POST['submit'])) 
{
    if ($listFilm->addData($_POST, $_FILES) > 0) {
        echo "<script>
            alert('Data berhasil dibuat!');
            document.location.href = 'index.php';
        </script>";
    } else {
        echo "<script>
        alert('Data gagal dibuat!');
        document.location.href = 'index.php';
        </script>";
    }
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
            <div class="card-body text-center">
                <p class="card-text judul-film my-0">' . $row['judul_film'] . '</p>
                <p class="card-text nama-genre my-0">' . $row['nama_genre'] . '</p>
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
