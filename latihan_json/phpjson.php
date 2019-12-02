<?php
// $con = mysqli_connect("localhost","root","", "db_ajax");

$koneksi =  new PDO("mysql:dbname=db_ajax;host=localhost", "root", "");

$json = '{"message": {';
$query = $koneksi->query( "select * from message");
$query->execute();
$json .= '"pesan": [ ';
while ($x = $query->fetch(PDO::FETCH_ASSOC)) {
    $json .= '{';
    $json .= '"id": "' . $x['message_id'] . '",
    "user": "' . htmlspecialchars($x['username']) . '",
    "text": "' . htmlspecialchars($x['message']) . '",
    "time": "' . $x['post_time'] . '"
    },';

}
    // menghilangkan koma di akhir
$json = substr($json,0,strlen($json)-1);
// var_dump($json);

// lengkapi penutup format json
$json .= ']';
$json .= '}}';

echo $json;

?>