<?php

// Include konfigurasi database dan kelas yang diperlukan
include('config/db.php');
include('classes/DB.php');
include('classes/Sutradara.php');
include('classes/Template.php');

// Inisialisasi objek Divisi dengan parameter koneksi database
$sutradara = new Sutradara($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$sutradara->open(); // Buka koneksi database
$sutradara->getSutradara(); // Ambil data divisi dari database

// Proses penambahan data divisi jika tidak ada parameter id yang diberikan melalui URL
if (!isset($_GET['id'])) {
    // Jika form tambah divisi disubmit
    if (isset($_POST['submit'])) {
        // Jika penambahan divisi berhasil
        if ($sutradara->addSutradara($_POST) > 0) {
            // Tampilkan pesan sukses dan redirect ke halaman divisi.php
            echo "<script>
                alert('Data berhasil ditambah!');
                document.location.href = 'sutradara.php';
            </script>";
        } else {
            // Tampilkan pesan gagal dan redirect ke halaman divisi.php
            echo "<script>
                alert('Data gagal ditambah!');
                document.location.href = 'sutradara.php';
            </script>";
        }
    }

    $btn = 'Tambah'; // Text tombol tambah
    $title = 'Tambah'; // Judul halaman
}

// Inisialisasi objek Template untuk menampilkan tampilan
$view = new Template('templates/skintabel.html');

// Pengaturan judul utama dan header tabel
$mainTitle = 'Sutradara';
$header = '<tr>
<th scope="row">No.</th>
<th scope="row">Nama Divisi</th>
<th scope="row">Aksi</th>
</tr>';

$data = null; // Variabel untuk menampung data divisi dalam format HTML
$no = 1; // Variabel untuk nomor urut

$formLabel = 'sutradara'; // Label untuk form input divisi

// Pengisian data divisi ke dalam tabel
while ($sut = $sutradara->getResult()) {
    $data .= '<tr>
    <th scope="row">' . $no . '</th>
    <td>' . $sut['nama_sutradara'] . '</td>
    <td style="font-size: 22px;">
        <a href="sutradara.php?id=' . $sut['id_sutradara'] . '" title="Edit Data"><i class="bi bi-pencil-square text-warning"></i></a>&nbsp;<a href="sutradara.php?hapus=' . $sut['id_sutradara'] . '" title="Delete Data"><i class="bi bi-trash-fill text-danger"></i></a>
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
            if ($sutradara->updateSutradara($id, $_POST) > 0) {
                // Tampilkan pesan sukses dan redirect ke halaman divisi.php
                echo "<script>
                alert('Data berhasil diubah!');
                document.location.href = 'sutradara.php';
            </script>";
            } else {
                // Tampilkan pesan gagal dan redirect ke halaman divisi.php
                echo "<script>
                alert('Data gagal diubah!');
                document.location.href = 'sutradara.php';
            </script>";
            }
        }

        // Ambil data divisi berdasarkan id
        $sutradara->getSutradaraById($id);
        $row = $sutradara->getResult();

        $dataUpdate = $row['nama_sutradara']; // Data divisi yang akan diubah
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
        if ($sutradara->deleteSutradara($id) > 0) {
            // Tampilkan pesan sukses dan redirect ke halaman divisi.php
            echo "<script>
                alert('Data berhasil dihapus!');
                document.location.href = 'sutradara.php';
            </script>";
        } else {
            // Tampilkan pesan gagal dan redirect ke halaman divisi.php
            echo "<script>
                alert('Data gagal dihapus!');
                document.location.href = 'sutradara.php';
            </script>";
        }
    }
}

$sutradara->close(); // Tutup koneksi database

// Penggantian placeholder dengan data dinamis pada tampilan
$view->replace('DATA_MAIN_TITLE', $mainTitle);
$view->replace('DATA_TABEL_HEADER', $header);
$view->replace('DATA_TITLE', $title);
$view->replace('DATA_BUTTON', $btn);
$view->replace('DATA_FORM_LABEL', $formLabel);
$view->replace('DATA_TABEL', $data);
$view->write(); // Tampilkan tampilan
?>
