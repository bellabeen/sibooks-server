<?php
include_once(__DIR__."/../../lib/DataPilihan.php");
include_once(__DIR__."/../../lib/DataFormat.php");
header('Access-Control-Allow-Origin:*');
$kategoripilihan = new KategoriPilihan();
if(isset($_GET['id'])){
    $data=$kategoripilihan->getKategori($_GET['id']);
} else {
    $data=$kategoripilihan->getAll();
}
$format=new DataFormat();


$view = isset($_GET['view']) ? $_GET['view']: null;

if($_GET['view']=='json') {
    echo $format->asJSON($data);
} else {
    echo $format->asTable($data["data"]);
}