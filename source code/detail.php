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

if (isset($_POST['submit'])) 
{
    if ($film->updateData($_GET['id'], $_POST, $_FILES) > 0) {
        echo "<script>
            alert('Data berhasil diubah!');
            document.location.href = 'detail.php?id={$_GET['id']}';
        </script>";
    } else {
        echo "<script>
        alert('Data gagal diubah!');
        document.location.href = 'detail.php?id={$_GET['id']}';
        </script>";
    }
}

$data = nulL;

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if ($id > 0) {
        $film->getFilmById($id);
        $row = $film->getResult();

        $data .= '<div class="card-header text-center">
        <h3 class="my-0">Detail Film ' . $row['judul_film'] . '</h3>
        </div>
        <div class="card-body text-end">
            <div class="row mb-5">
                <div class="col-3">
                    <div class="row justify-content-center">
                        <img src="assets/images/' . $row['foto_film'] . '" class="img-thumbnail" alt="' . $row['foto_film'] . '" width="60">
                        </div>
                    </div>
                    <div class="col-9">
                        <div class="card px-3">
                            <table border="0" class="text-start">
                                <tr>
                                    <td>Judul</td>
                                    <td>:</td>
                                    <td>' . $row['judul_film'] . '</td>
                                </tr>
                                <tr>
                                    <td>Genre</td>
                                    <td>:</td>
                                    <td>' . $row['nama_genre'] . '</td>
                                </tr>
                                <tr>
                                    <td>Durasi</td>
                                    <td>:</td>
                                    <td>' . $row['durasi_film'] . ' menit</td>
                                </tr>
                                <tr>
                                    <td>Sutradara</td>
                                    <td>:</td>
                                    <td>' . $row['nama_sutradara'] . '</td>
                                </tr>
                                <tr>
                                    <td>Negara</td>
                                    <td>:</td>
                                    <td>' . $row['nama_negara'] . '</td>
                                </tr>
                                <tr>
                                    <td>Rating Usia</td>
                                    <td>:</td>
                                    <td>' . $row['rating_usia_film'] . '</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer text-end">
            <div class="row mb-2">
            <a href="editFilm.php?id=' . $id . '"><button type="button" class="btn btn-success text-white">Ubah Data</button></a>
            </div>
            <div class="row mb-2">
                <form method="post" action="index.php">
                    <input type="hidden" name="id" value="' . $id . '">
                    <button type="submit" name="hapus" class="btn btn-danger">Hapus Data</button>
                </form>
            </div>
        </div>';
    }
}

$film->close();
$detail = new Template('templates/skindetail.html');
$detail->replace('DATA_DETAIL_FILM', $data);
$detail->write();
