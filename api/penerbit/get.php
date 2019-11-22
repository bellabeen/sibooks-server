<?php
include_once(__DIR__."/../../lib/penerbit.php");
include_once(__DIR__."/../../lib/DataFormat.php");
header('Access-Control-Allow-Origin:*');
$penerbitpilihan = new PenerbitPilihan();
if(isset($_GET['id_penerbit'])){
    $data=$penerbitpilihan->getPenerbitPilihan($_GET['id_penerbit']);
} else {
    $data=$penerbitpilihan->getAll();
}
$format=new DataFormat();


$view = isset($_GET['view']) ? $_GET['view']: null;

if($_GET['view']=='json') {
    echo $format->asJSON($data);
} else {
    echo $format->asTable($data["data"]);
}