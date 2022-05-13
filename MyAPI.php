<?php
    //selama berhubungan dengan data pada tabel, selalu dipanggil file koneksi.php
    require_once "koneksi.php";

    if($_GET['function']){   //jika parameter function dikirim
        $_GET['function'](); //jalankan parameter
    }

    function get_penerbit(){
        global $connection;

        $data = array();
        $query = $connection->query("SELECT * FROM tb_penerbit");
        
        while($row = mysqli_fetch_object($query)){
            $data[] = $row;
        }

        $response = $data;
        header('Content-Type: application/json');
        echo json_encode($response);
    }

    function insert_penerbit(){
        global $connection;

        //buat parameter form-data array key pada postman
        $datArr = array('nama_penerbit' => '', 'alamat_penerbit' => '');

        //periksa apakah semua parameter sudah sesuai lakukan insert data
        //dan menggunakan method post
        $check_match = count(array_intersect_key($_POST, $datArr));

        //buat parameter nama penerbit doank
        $dataNamaPenerbit = array('nama_penerbit' => '');
        $check_nama_penerbit = count(array_intersect_key($_POST, $dataNamaPenerbit));
        
        $nama = $_POST['nama_penerbit'];
        //jika semua parameter sudah sesuai lakukan insert data
        if($check_match == count($datArr)){
            $alamat = $_POST['alamat_penerbit'];
            $result = mysqli_query($connection, "INSERT INTO tb_penerbit(nama_penerbit, alamat_penerbit) VALUES ('$nama', '$alamat')");

            if($result){
                $response = array(
                    'status' => 1,
                    'message' => 'Insert success'
                );
            }else{
                $response = array(
                    'status' => 0,
                    'message' => 'Insert failed'
                );
            }
        }else if($check_nama_penerbit == count($dataNamaPenerbit)){
            $result = mysqli_query($connection, "INSERT INTO tb_penerbit(nama_penerbit) VALUES ('$nama')");

            if($result){
                $response = array(
                    'status' => 1,
                    'message' => 'Insert success'
                );
            }else{
                $response = array(
                    'status' => 0,
                    'message' => 'Insert failed'
                );
            }
        }else{
            $response = array(
                'status' => 0,
                'message' => 'Wrong parameter'
            );
        }

        header('Content-Type: application/json');
        echo json_encode($response);
    }

    function delete_penerbit(){
        global $connection;

        $id = $_GET['id'];

        $result = mysqli_query($connection, "DELETE FROM tb_penerbit WHERE kode_penerbit = '$id'");

        if($result){
            $response = array(
                'status' => 1,
                'message' => 'Delete success'
            );
        }else{
            $response = array(
                'status' => 0,
                'message' => 'Delete failed'
            );
        }

        header('Content-Type: application/json');
        echo json_encode($response);
    }

    function update_penerbit(){
        global $connection;

        //buat parameter form-data array key pada postman
        $datArr = array('nama_penerbit' => '', 'alamat_penerbit' => '');

        //periksa apakah semua parameter sudah sesuai lakukan insert data
        //dan menggunakan method post
        $check_match = count(array_intersect_key($_POST, $datArr));
        
        //jika semua parameter sudah sesuai lakukan insert data
        if($check_match == count($datArr)){
            $nama_penerbit = $_POST['nama_penerbit'];
            $alamat_penerbit = $_POST['alamat_penerbit'];

            $id = $_GET['id'];
            $result = mysqli_query($connection, "UPDATE tb_penerbit SET nama_penerbit = '$nama_penerbit',
                                                                    alamat_penerbit = '$alamat_penerbit'
                                                WHERE kode_penerbit= '$id'");

            if($result){
                $response = array(
                    'status' => 1,
                    'message' => 'Update success'
                );
            }else{
                $response = array(
                    'status' => 0,
                    'message' => 'Update failed'
                );
            }
        }else{
            $response = array(
                'status' => 0,
                'message' => 'Wrong parameter'
            );
        }

        header('Content-Type: application/json');
        echo json_encode($response);
    }

    // BATAS ANTARA SCRIPT PENERBIT DAN BUKU //
    //                                       //

    function get_buku(){
        global $connection;

        $data = array();
        $query = $connection->query("SELECT * FROM tb_buku");
        
        while($row = mysqli_fetch_object($query)){
            $data[] = $row;
        }

        $response = $data;
        header('Content-Type: application/json');
        echo json_encode($response);
    }

    function insert_buku(){
        global $connection;

        //buat parameter form-data array key pada postman
        $datArr = array('judul_buku' => '', 'tahun_terbit' => '', 'kode_penerbit' => '');

        //periksa apakah semua parameter sudah sesuai lakukan insert data
        //dan menggunakan method post
        $check_match = count(array_intersect_key($_POST, $datArr));
        
        //jika semua parameter sudah sesuai lakukan insert data
        if($check_match == count($datArr)){
            $judul = $_POST['judul_buku'];
            $tahun_terbit = $_POST['tahun_terbit'];
            $kode_penerbit = $_POST['kode_penerbit'];
            $result = mysqli_query($connection, "INSERT INTO tb_buku(judul_buku, tahun_terbit, kode_penerbit) VALUES ('$judul', '$tahun_terbit', '$kode_penerbit')");

            if($result){
                $response = array(
                    'status' => 1,
                    'message' => 'Insert success'
                );
            }else{
                $response = array(
                    'status' => 0,
                    'message' => 'Insert failed'
                );
            }
        }else{
            $response = array(
                'status' => 0,
                'message' => 'Wrong parameter'
            );
        }

        header('Content-Type: application/json');
        echo json_encode($response);
    }

    function delete_buku(){
        global $connection;

        $id = $_GET['id'];

        $result = mysqli_query($connection, "DELETE FROM tb_buku WHERE kode_buku = '$id'");

        if($result){
            $response = array(
                'status' => 1,
                'message' => 'Delete success'
            );
        }else{
            $response = array(
                'status' => 0,
                'message' => 'Delete failed'
            );
        }

        header('Content-Type: application/json');
        echo json_encode($response);
    }

    function update_buku(){
        global $connection;

        //buat parameter form-data array key pada postman
        $datArr = array('judul_buku' => '', 'tahun_terbit' => '', 'kode_penerbit' => '');

        //periksa apakah semua parameter sudah sesuai lakukan insert data
        //dan menggunakan method post
        $check_match = count(array_intersect_key($_POST, $datArr));
        
        //jika semua parameter sudah sesuai lakukan insert data
        if($check_match == count($datArr)){
            $judul = $_POST['judul_buku'];
            $tahun_terbit = $_POST['tahun_terbit'];
            $kode_penerbit = $_POST['kode_penerbit'];

            $id = $_GET['id'];
            $result = mysqli_query($connection, "UPDATE tb_buku SET judul_buku = '$judul',
                                                                    tahun_terbit = '$tahun_terbit',
                                                                    kode_penerbit = '$kode_penerbit'
                                                WHERE kode_buku = '$id'");

            if($result){
                $response = array(
                    'status' => 1,
                    'message' => 'Update success'
                );
            }else{
                $response = array(
                    'status' => 0,
                    'message' => 'Update failed'
                );
            }
        }else{
            $response = array(
                'status' => 0,
                'message' => 'Wrong parameter'
            );
        }

        header('Content-Type: application/json');
        echo json_encode($response);
    }

    

?>