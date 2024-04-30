<?php

// Include konfigurasi database dan kelas yang diperlukan
include('config/db.php');
include('classes/DB.php');
include('classes/Negara.php');
include('classes/Template.php');

// Inisialisasi objek Divisi dengan parameter koneksi database
$negara = new Negara($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$negara->open(); // Buka koneksi database
$negara->getNegara(); // Ambil data divisi dari database

// Proses penambahan data divisi jika tidak ada parameter id yang diberikan melalui URL
if (!isset($_GET['id'])) {
    // Jika form tambah divisi disubmit
    if (isset($_POST['submit'])) {
        // Jika penambahan divisi berhasil
        if ($negara->addNegara($_POST) > 0) {
            // Tampilkan pesan sukses dan redirect ke halaman divisi.php
            echo "<script>
                alert('Data berhasil ditambah!');
                document.location.href = 'negara.php';
            </script>";
        } else {
            // Tampilkan pesan gagal dan redirect ke halaman divisi.php
            echo "<script>
                alert('Data gagal ditambah!');
                document.location.href = 'negara.php';
            </script>";
        }
    }

    $btn = 'Tambah'; // Text tombol tambah
    $title = 'Tambah'; // Judul halaman
}

// Inisialisasi objek Template untuk menampilkan tampilan
$view = new Template('templates/skintabel.html');

// Pengaturan judul utama dan header tabel
$mainTitle = 'Negara';
$header = '<tr>
<th scope="row">No.</th>
<th scope="row">Nama Negara</th>
<th scope="row">Aksi</th>
</tr>';

$data = null; // Variabel untuk menampung data divisi dalam format HTML
$no = 1; // Variabel untuk nomor urut

$formLabel = 'negara'; // Label untuk form input divisi

// Pengisian data divisi ke dalam tabel
while ($neg = $negara->getResult()) {
    $data .= '<tr>
    <th scope="row">' . $no . '</th>
    <td>' . $neg['nama_negara'] . '</td>
    <td style="font-size: 22px;">
        <a href="negara.php?id=' . $neg['id_negara'] . '" title="Edit Data"><i class="bi bi-pencil-square text-warning"></i></a>&nbsp;<a href="negara.php?hapus=' . $neg['id_negara'] . '" title="Delete Data"><i class="bi bi-trash-fill text-danger"></i></a>
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
            if ($negara->updateNegara($id, $_POST) > 0) {
                // Tampilkan pesan sukses dan redirect ke halaman divisi.php
                echo "<script>
                alert('Data berhasil diubah!');
                document.location.href = 'negara.php';
            </script>";
            } else {
                // Tampilkan pesan gagal dan redirect ke halaman divisi.php
                echo "<script>
                alert('Data gagal diubah!');
                document.location.href = 'negara.php';
            </script>";
            }
        }

        // Ambil data divisi berdasarkan id
        $negara->getNegaraById($id);
        $row = $negara->getResult();

        $dataUpdate = $row['nama_negara']; // Data divisi yang akan diubah
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
        if ($negara->deleteNegara($id) > 0) {
            // Tampilkan pesan sukses dan redirect ke halaman divisi.php
            echo "<script>
                alert('Data berhasil dihapus!');
                document.location.href = 'negara.php';
            </script>";
        } else {
            // Tampilkan pesan gagal dan redirect ke halaman divisi.php
            echo "<script>
                alert('Data gagal dihapus!');
                document.location.href = 'negara.php';
            </script>";
        }
    }
}

$negara->close(); // Tutup koneksi database

// Penggantian placeholder dengan data dinamis pada tampilan
$view->replace('DATA_MAIN_TITLE', $mainTitle);
$view->replace('DATA_TABEL_HEADER', $header);
$view->replace('DATA_TITLE', $title);
$view->replace('DATA_BUTTON', $btn);
$view->replace('DATA_FORM_LABEL', $formLabel);
$view->replace('DATA_TABEL', $data);
$view->write(); // Tampilkan tampilan
?>
