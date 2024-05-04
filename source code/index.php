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

// cari film
if (isset($_POST['btn-cari'])) {
    $listFilm->searchFilm($_POST['cari']);
} 
else {
    $sortBy = isset($_POST['sort-by']) ? $_POST['sort-by'] : 'id_film';
    $sortOrder = isset($_POST['sort-order']) ? $_POST['sort-order'] : 'asc';

    $listFilm->getFilmJoin($sortBy, $sortOrder);

}

$data = null; 

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

// if (isset($_POST['btn-cari'])) {
//     // Cek apakah ada query pencarian yang dikirimkan
//     if (!empty($_POST['cari'])) {
//         // Lakukan pencarian menggunakan metode searchFilm()
//         $listFilm->searchFilm($_POST['cari']);
//     } else {
//         // Tampilkan pesan jika input pencarian kosong
//         echo "<script>alert('Masukkan kata kunci pencarian!');</script>";
//     }
// } else {
//     // Jika tidak ada pencarian, tampilkan semua film
//     $listFilm->getFilmJoin();
// }

// // Buat variabel untuk menyimpan hasil pencarian atau semua film
// $data = '';

// // Loop untuk mengambil data film yang sesuai dengan hasil pencarian
// while ($row = $listFilm->getResult()) {
//     // Konstruksi tampilan film seperti sebelumnya
// }

// ambil data pengurus
// gabungkan dgn tag html
// untuk di passing ke skin/template
$listFilm->getFilmJoin();
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
