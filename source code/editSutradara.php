<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Sutradara.php');
include('classes/Template.php');

$sutradara = new Sutradara($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$sutradara->open();

$data = null;

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if ($id > 0) {
        $sutradara->getSutradaraById($id);
        $row = $sutradara->getResult();

        // Dapatkan nilai ENUM dari basis data
        $jenis_kelamin_options = ["Laki-Laki", "Perempuan"];

        $data .= '<div class="card-header text-center">
            <h3 class="my-0">Edit ' . $row['nama_sutradara'] . '</h3>
        </div>
        <div class="card-body">
            <form action="sutradara.php?id=' . $id . '" enctype="multipart/form-data" method="post">
                <input type="hidden" name="sutradara" value="' . $row['id_sutradara'] . '">
                <div class="form-group">
                    <label for="sutradara" class="form-label">Nama Sutradara</label>
                    <input type="text" class="form-control" id="nama" name="nama" value="' . $row['nama_sutradara'] . '" required>
                    <label for="jenis_kelamin_sutradara" class="form-label">Jenis Kelamin</label>
                    <select class="form-select" id="jenis_kelamin" name="jenis_kelamin" required>';

        // Loop melalui opsi jenis kelamin
        foreach ($jenis_kelamin_options as $option) {
            // Bandingkan dengan nilai ENUM yang ada di basis data
            $selected = ($row['jenis_kelamin_sutradara'] == $option) ? 'selected' : '';
            $data .= '<option value="' . $option . '" ' . $selected . '>' . $option . '</option>';
        }

        $data .= '</select>
                </div>
                <div class="card-footer text>
                    <a href="sutradara.php?id=' . $id . '"><button type="submit" name="submit" class="btn btn-success text-white">Simpan Perubahan</button>
                </div>
            </form>
        </div>';
    }
}

$sutradara->close();
$edit = new Template('templates/skinform.html');
$edit->replace('DATA_EDIT_SUTRADARA', $data);
$edit->write();
?>
