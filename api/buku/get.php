<?php
include_once(__DIR__."/../../lib/bukupilihan.php");
include_once(__DIR__."/../../lib/DataFormat.php");
header('Access-Control-Allow-Origin:*');
$bukupilihan = new BukuPilihan();
if(isset($_GET['kode_buku'])){
    $data=$bukupilihan->getBukuPilihan($_GET['kode_buku']);
} else {
    $data=$bukupilihan->getAll();
}
$format=new DataFormat();


$view = isset($_GET['view']) ? $_GET['view']: null;

if($_GET['view']=='json') {
    echo $format->asJSON($data);
} else {
    echo $format->asTable($data["data"]);
}