<?php

// Include konfigurasi database dan kelas yang diperlukan
include('config/db.php');
include('classes/DB.php');
include('classes/Genre.php');
include('classes/Template.php');

// Inisialisasi objek Divisi dengan parameter koneksi database
$genre = new Genre($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$genre->open(); // Buka koneksi database
$genre->getGenre(); // Ambil data divisi dari database

// Proses penambahan data divisi jika tidak ada parameter id yang diberikan melalui URL
if (!isset($_GET['id'])) {
    // Jika form tambah divisi disubmit
    if (isset($_POST['submit'])) {
        // Jika penambahan divisi berhasil
        if ($genre->addGenre($_POST) > 0) {
            // Tampilkan pesan sukses dan redirect ke halaman divisi.php
            echo "<script>
                alert('Data berhasil ditambah!');
                document.location.href = 'genre.php';
            </script>";
        } else {
            // Tampilkan pesan gagal dan redirect ke halaman divisi.php
            echo "<script>
                alert('Data gagal ditambah!');
                document.location.href = 'genre.php';
            </script>";
        }
    }

    $btn = 'Tambah'; // Text tombol tambah
    $title = 'Tambah'; // Judul halaman
}

// Inisialisasi objek Template untuk menampilkan tampilan
$view = new Template('templates/skintabel.html');

// Pengaturan judul utama dan header tabel
$mainTitle = 'Genre';
$header = '<tr>
<th scope="row">No.</th>
<th scope="row">Nama Genre</th>
<th scope="row">Aksi</th>
</tr>';

$data = null; // Variabel untuk menampung data divisi dalam format HTML
$no = 1; // Variabel untuk nomor urut

$formLabel = 'genre'; // Label untuk form input divisi

// Pengisian data divisi ke dalam tabel
while ($gen = $genre->getResult()) {
    $data .= '<tr>
    <th scope="row">' . $no . '</th>
    <td>' . $gen['nama_genre'] . '</td>
    <td style="font-size: 22px;">
        <a href="editGenre.php?id=' . $gen['id_genre'] . '" title="Edit Data"><i class="bi bi-pencil-square text-warning"></i></a>&nbsp;
        <a href="genre.php?hapus=' . $gen['id_genre'] . '" title="Delete Data"><i class="bi bi-trash-fill text-danger"></i></a>
        </td>
    </tr>';
    $no++;
}

// Proses jika parameter id diberikan melalui URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if ($id > 0) {
        // Jika form edit divisi disubmit
        if (isset($_POST['submit'])) {
            // Jika pengubahan divisi berhasil
            if ($genre->updateGenre($id, $_POST) > 0) {
                // Tampilkan pesan sukses dan redirect ke halaman divisi.php
                echo "<script>
                alert('Data berhasil diubah!');
                document.location.href = 'genre.php';
            </script>";
            } else {
                // Tampilkan pesan gagal dan redirect ke halaman divisi.php
                echo "<script>
                alert('Data gagal diubah!');
                document.location.href = 'genre.php';
            </script>";
            }
        }

        // Ambil data divisi berdasarkan id
        $genre->getGenreById($id);
        $row = $genre->getResult();

        $dataUpdate = $row['nama_genre']; // Data divisi yang akan diubah
        $btn = 'Simpan'; // Text tombol simpan
        $title = 'Ubah'; // Judul halaman

        // Ganti placeholder dengan data yang akan diubah
        $view->replace('DATA_VAL_UPDATE', $dataUpdate);
    }
}

// Proses penghapusan data divisi jika parameter hapus diberikan melalui URL
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    if ($id > 0) {
        // Jika penghapusan divisi berhasil
        if ($genre->deleteGenre($id) > 0) {
            // Tampilkan pesan sukses dan redirect ke halaman divisi.php
            echo "<script>
                alert('Data berhasil dihapus!');
                document.location.href = 'genre.php';
            </script>";
        } else {
            // Tampilkan pesan gagal dan redirect ke halaman divisi.php
            echo "<script>
                alert('Data gagal dihapus!');
                document.location.href = 'genre.php';
            </script>";
        }
    }
}

$genre->close(); // Tutup koneksi database

// Penggantian placeholder dengan data dinamis pada tampilan
$view->replace('DATA_MAIN_TITLE', $mainTitle);
$view->replace('DATA_TABEL_HEADER', $header);
$view->replace('DATA_TITLE', $title);
$view->replace('DATA_BUTTON', $btn);
$view->replace('DATA_FORM_LABEL', $formLabel);
$view->replace('DATA_TABEL', $data);
$view->replace('DATA_LINK_CREATE', 'tambahGenre.php');
$view->write(); // Tampilkan tampilan
?>
