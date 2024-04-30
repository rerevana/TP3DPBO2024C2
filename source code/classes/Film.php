<?php

class Film extends DB
{
    function getFilmJoin()
    {
        $query = "SELECT * FROM film JOIN sutradara ON film.id_sutradara=sutradara.id_sutradara JOIN genre ON film.id_genre=genre.id_genre JOIN negara ON film.id_negara=negara.id_negara ORDER BY film.id_film";

        return $this->execute($query);
    }

    function getFilm()
    {
        $query = "SELECT * FROM film";
        return $this->execute($query);
    }

    function getFilmById($id)
    {
        $query = "SELECT * FROM film JOIN sutradara ON film.id_sutradara=sutradara.id_sutradara JOIN genre ON film.id_genre=genre.id_genre JOIN negara ON film.id_negara=negara.id_negara WHERE id_film=$id";
        return $this->execute($query);
    }

    function searchFilm($keyword)
    {
        // Query untuk pencarian pengurus berdasarkan nama atau informasi lain yang sesuai dengan keyword
        $query = "SELECT * FROM film 
                  JOIN genre ON film.id_genre = genre.id_genre 
                  JOIN sutradara ON film.id_genre = sutradara.id_sutradara 
                  JOIN negara ON film.id_genre = negara.id_negara
                  WHERE nama_film LIKE '%$keyword%'";
        return $this->execute($query); // Eksekusi query dan kembalikan hasilnya
    }

    function addData($data)
    {
        // Mendapatkan data dari parameter
        $judul = $data['judul'];
        $id_genre = $data['id_genre'];
        $durasi_film = $data['durasi_film'];
        $id_sutradara = $data['d_sutradara'];
        $id_negara = $data['id_negara'];
        $rating_usia_film = $data['rating_usia_film'];
        
        // Query untuk menambahkan data pengurus baru
        $query = "INSERT INTO film (judul_film, id_genre, drasi_film, id_sutradara, id_negara, rating_usia_film) 
                  VALUES ('$judul', '$id_genre', '$durasi_film', '$id_sutradara', '$id_negara', '$rating_usia_film')";
        
        // Eksekusi query dan kembalikan status keberhasilan
        return $this->executeAffected($query);
    }

    function updateData($id, $data, $file)
    {
        // Mendapatkan data dari parameter
        $judul = $data['judul'];
        $id_genre = $data['id_genre'];
        $durasi_film = $data['durasi_film'];
        $id_sutradara = $data['d_sutradara'];
        $id_negara = $data['id_negara'];
        $rating_usia_film = $data['rating_usia_film'];

        // Query untuk mengupdate data pengurus berdasarkan ID
        $query = "UPDATE film 
                  SET judul_film = '$judul', id_genre = '$id_genre', durasi_film = '$durasi_film' id_sutradara = '$id_sutradara', id_negara = '$id_negara', rating_usia_film = '$rating_usia_film' 
                  WHERE pengurus_id = $id";
        
        // Eksekusi query dan kembalikan status keberhasilan
        return $this->executeAffected($query);
    }

    function deleteData($id)
    {
        // Query untuk menghapus data pengurus berdasarkan ID
        $query = "DELETE FROM film WHERE id_film = $id";
        
        // Eksekusi query dan kembalikan status keberhasilan
        return $this->executeAffected($query);
    }
}
