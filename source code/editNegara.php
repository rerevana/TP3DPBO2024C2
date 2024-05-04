<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Negara.php');
include('classes/Template.php');

$negara = new Negara($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$negara->open();

$data = null;

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if ($id > 0) {
        $negara->getNegaraById($id);
        $row = $negara->getResult();

        $data .= '<div class="card-header text-center">
            <h3 class="my-0">Edit ' . $row['nama_negara'] . '</h3>
        </div>
        <div class="card-body">
            <form action="negara.php?id=' . $id . '" enctype="multipart/form-data" method="post">
                <input type="hidden" name="negara" value="' . $row['id_negara'] . '">
                <div class="form-group">
                    <label for="negara" class="form-label">negara</label>
                    <input type="text" class="form-control" id="nama" name="nama" value="' . $row['nama_negara'] . '" required>
                </div>
                <div class="card-footer text>
                    <a href="negara.php?id=' . $id . '"><button type="submit" name="submit" class="btn btn-success text-white">Simpan Perubahan</button>
                </div>
            </form>
        </div>';
    }
}

$negara->close();
$edit = new Template('templates/skinform.html');
$edit->replace('DATA_EDIT_NEGARA', $data);
$edit->write();
?>
