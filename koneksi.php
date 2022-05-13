<?php
    $db_Host = 'localhost';
    $db_Uname = 'root';
    $db_Pass = '';
    $db_Dbname = 'perpustakaan';

    $connection = mysqli_connect($db_Host, $db_Uname, $db_Pass, $db_Dbname);

    if(!$connection){
        die("Koneksi gagal !" .mysqli_connect_error());
    }
?>