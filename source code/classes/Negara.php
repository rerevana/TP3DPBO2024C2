<?php

class Negara extends DB
{
    function getNegara()
    {
        $query = "SELECT * FROM negara";
        return $this->execute($query);
    }

    function getNegaraById($id)
    {
        $query = "SELECT * FROM negara WHERE id_negara=$id";
        return $this->execute($query);
    }

    function addNegara($data)
    {
        $nama = $data['nama'];
        $query = "INSERT INTO negara VALUES('', '$nama')";
        return $this->executeAffected($query);
    }

    function updateNegara($id, $data)
    {
        $nama = $data['nama'];
        $query = "UPDATE negara SET nama_negara='$nama' WHERE id_negara=$id";
        return $this->executeAffected($query);
    }

    function deleteNegara($id)
    {
        $query = "DELETE FROM negara WHERE id_negara=$id";
        return $this->executeAffected($query);
    }
}
