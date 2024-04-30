<?php

class Sutradara extends DB
{
    function getSutradara()
    {
        $query = "SELECT * FROM sutradara";
        return $this->execute($query);
    }

    function getSutradaraById($id)
    {
        $query = "SELECT * FROM sutradara WHERE id_sutradara=$id";
        return $this->execute($query);
    }

    function addSutradara($data)
    {
        $nama = $data['nama'];
        $jenis_kelamin = $data['jenis_kelamin'];
        $query = "INSERT INTO sutradara VALUES('', '$nama', '$jenis_kelamin')";
        return $this->executeAffected($query);
    }

    function updateSutradara($id, $data)
    {
        $nama = $data['nama'];
        $jenis_kelamin = $data['jenis_kelamin'];
        $query = "UPDATE sutradara SET nama_sutradara='$nama' SET jenis_kelamin_sutradara='$jenis_kelamin' WHERE id_sutradara=$id";
        return $this->executeAffected($query);
    }

    function deleteSutradara($id)
    {
        $query = "DELETE FROM sutradara WHERE id_sutradara=$id";
        return $this->executeAffected($query);
    }
}
