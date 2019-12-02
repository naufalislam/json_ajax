<?php
// $con = mysqli_connect("localhost","root","", "db_ajax");

include "koneksi.php";

date_default_timezone_set("Asia/Jakarta");

if (isset($_GET['nama'])){
    @$nama = $_GET['nama'];
}

if (isset($_GET['pesan'])){
    $pesan = $_GET['pesan'];
}

// $nama = $_GET['nama'];
// $pesan = $_GET['pesan'];
$waktu = date("H:i");
// $akhir = $_GET['akhir'];

if (isset($_GET['akhir'])){
    @$akhir = $_GET['akhir'];
}

$json = '{"messages": {';
    if(@$akhir==0){
        $nomor = $koneksi->query("SELECT nomor FROM drzchat ORDER BY nomor DESC limit 1");
        $nomor->execute();
        $n = $nomor->fetch(PDO::FETCH_ASSOC);
        // $n = mysqli_fetch_array($nomor);
        $no = $n['nomor'] + 1;
        
        $json .= '"pesan":[ {';
            $json .= '"id":"'.$no.'",
            "nama": "Admin",
            "teks": "Selamat datang di chatting room",
            "waktu": "'.$waktu.'"
        }]';
        
        $masuk = $koneksi->query("INSERT INTO drzchat VALUES(null, 'Admin', '$nama bergabung dalam chat', '$waktu')");
        // $masuk = mysqli_query($con, "insert into drzchat values(null, 'Admin', $nama . bergabung dalam chat', '$waktu')");
    } else {
        if($pesan){
            $masuk = $koneksi->query("insert into drzchat values(null, '$nama','$pesan','$waktu')");
        }

        $query = $koneksi->query("select * from drzchat where nomor > $akhir");
        $json .= '"pesan":[ ';
        while($x = $query->fetch(PDO::FETCH_ASSOC)) {
            $json .= '{';
            $json .= '"id": "' . $x['nomor'] . '",
            "nama": "' . htmlspecialchars($x['nama']) . '",
            "teks": "' . htmlspecialchars($x['pesan']) . '",
            "waktu": "' . $x['waktu'] . '"
            },';
    }
    $json = substr($json,0,strlen($json)-1);
    $json .= ']'; 
}

    $json .= '}}';
    echo $json;

?>