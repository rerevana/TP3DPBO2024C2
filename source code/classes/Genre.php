<?php

class Genre extends DB
{
    function getGenre()
    {
        $query = "SELECT * FROM genre";
        return $this->execute($query);
    }

    function getGenreById($id)
    {
        $query = "SELECT * FROM genre WHERE id_genre=$id";
        return $this->execute($query);
    }

    function addGenre($data)
    {
        $nama_genre = $data['nama_genre'];
        $query = "INSERT INTO genre VALUES('', '$nama_genre')";
        return $this->executeAffected($query);
    }

    function updateGenre($id, $data)
    {
        $nama_genre = $data['nama_genre'];
        $query = "UPDATE Genre SET nama_genre='$nama_genre' WHERE id_genre=$id";
        return $this->executeAffected($query);
    }

    function deleteGenre($id)
    {
        $query = "DELETE FROM genre WHERE id_genre=$id";
        return $this->executeAffected($query);
    }
}
