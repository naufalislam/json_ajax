<?php
    try {
        $koneksi = new PDO("mysql:host=localhost;dbname=db_ajax","root","");

        $koneksi->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // $result = $koneksi->query("SELECT * FROM mahasiswa ORDER BY nama ASC");

        // while($row = $result->fetch()){
        //     echo "Nama : " .$row[1]."<br/>";
        //     echo "NIM : " .$row[2]."<br/>";
        //     echo "<br/>";
        // }

        // $koneksi = null;
    } catch (PDOException $e) {
        print "Koneksi atau query bermasalah : ".$e->getMessage()."<br/>";
        die();
    }
    
?>
