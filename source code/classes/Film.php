<?php

class Film extends DB
{
    // function getFilmJoin()
    // {

    //     $query = "SELECT * FROM film 
    //     JOIN sutradara ON film.id_sutradara=sutradara.id_sutradara 
    //     JOIN genre ON film.id_genre=genre.id_genre 
    //     JOIN negara ON film.id_negara=negara.id_negara ORDER BY film.id_film";

    //     return $this->execute($query);
    // }

    function getFilmJoin($sortBy = 'id_film', $sortOrder = 'ASC')
    {
        $query = "SELECT * FROM film 
        JOIN sutradara ON film.id_sutradara=sutradara.id_sutradara 
        JOIN genre ON film.id_genre=genre.id_genre 
        JOIN negara ON film.id_negara=negara.id_negara 
        ORDER BY $sortBy $sortOrder";

        return $this->execute($query);
    }

    function getFilm()
    {
        $query = "SELECT * FROM film";
        return $this->execute($query);
    }

    function getFilmById($id)
    {
        $query = "SELECT * FROM film 
        JOIN sutradara ON film.id_sutradara=sutradara.id_sutradara 
        JOIN genre ON film.id_genre=genre.id_genre 
        JOIN negara ON film.id_negara=negara.id_negara WHERE id_film=$id";
        return $this->execute($query);
    }

    function searchFilm($keyword)
    {
        // Query untuk pencarian film berdasarkan judul film
        $query = "SELECT * FROM film 
                  JOIN genre ON film.id_genre = genre.id_genre 
                  JOIN sutradara ON film.id_sutradara = sutradara.id_sutradara 
                  JOIN negara ON film.id_negara = negara.id_negara
                  WHERE judul_film LIKE '%$keyword%'";

        // Eksekusi query dan tangkap hasilnya
        $result = $this->execute($query);

    }

    function addData($data, $file)
    {
        $foto_film = $file['foto_film']['name'];
        $judul = $data['judul'];
        $id_genre = $data['id_genre'];
        $durasi_film = $data['durasi_film'];
        $id_sutradara = $data['id_sutradara']; // Perbaiki nama kolom
        $id_negara = $data['id_negara'];
        $rating_usia_film = $data['rating_usia_film'];

        if($foto_film != "") {
            $x = explode('.', $foto_film); //memisahkan nama file dengan ekstensi yang diupload
            $file_tmp = $_FILES['foto_film']['tmp_name'];   
            $angka_acak     = rand(1,999);
            $nama_gambar_baru = $angka_acak.'-'.$foto_film; //menggabungkan angka acak dengan nama file sebenarnya
                    
                move_uploaded_file($file_tmp, 'assets/images/'.$nama_gambar_baru); //memindah file gambar ke folder gambar
                // jalankan query INSERT untuk menambah data ke database pastikan sesuai urutan (id tidak perlu karena dibikin otomatis)
                $query = "INSERT INTO film VALUES ('', '$nama_gambar_baru', '$judul', '$id_genre', '$durasi_film', '$id_sutradara', '$id_negara', '$rating_usia_film')";

          } 
            
        // $query = "INSERT INTO film VALUES ('', '$foto_film', '$judul', '$id_genre', '$durasi_film', '$id_sutradara', '$id_negara', '$rating_usia_film')";
        
        return $this->executeAffected($query);
    }

    function updateData($id, $data, $file)
    {
        // Perbaiki typo pada nama kolom
        $judul = $data['judul'];
        $foto_film = $file['foto_film']['name'];
        $id_genre = $data['id_genre'];
        $durasi_film = $data['durasi_film'];
        $id_sutradara = $data['id_sutradara']; 
        $id_negara = $data['id_negara'];
        $rating_usia_film = $data['rating_usia_film'];

        if($foto_film != "") {
            $x = explode('.', $foto_film); //memisahkan nama file dengan ekstensi yang diupload
            $file_tmp = $_FILES['foto_film']['tmp_name'];   
            $angka_acak     = rand(1,999);
            $nama_gambar_baru = $angka_acak.'-'.$foto_film; //menggabungkan angka acak dengan nama file sebenarnya
                    
            move_uploaded_file($file_tmp, 'assets/images/'.$nama_gambar_baru); //memindah file gambar ke folder gambar
            // jalankan query INSERT untuk menambah data ke database pastikan sesuai urutan (id tidak perlu karena dibikin otomatis)
            $query = "UPDATE film 
            SET judul_film = '$judul', foto_film = '$nama_gambar_baru', id_genre = '$id_genre', durasi_film = '$durasi_film', id_sutradara = '$id_sutradara', id_negara = '$id_negara', rating_usia_film = '$rating_usia_film' 
            WHERE id_film = $id"; 

        }else{
            $query = "UPDATE film 
            SET judul_film = '$judul', id_genre = '$id_genre', durasi_film = '$durasi_film', id_sutradara = '$id_sutradara', id_negara = '$id_negara', rating_usia_film = '$rating_usia_film' 
            WHERE id_film = $id"; 
        }

            
        // $query = "UPDATE film 
        // SET judul_film = '$judul', foto_film = '$foto_film', id_genre = '$id_genre', durasi_film = '$durasi_film', id_sutradara = '$id_sutradara', id_negara = '$id_negara', rating_usia_film = '$rating_usia_film' 
        // WHERE id_film = $id"; 

        return $this->executeAffected($query);
    }

    function deleteData($id)
    {
        // // Query untuk menghapus data pengurus berdasarkan ID
        $query = "DELETE FROM film WHERE id_film = $id";
        
        // Eksekusi query dan kembalikan status keberhasilan
        return $this->executeAffected($query);
    }

}
