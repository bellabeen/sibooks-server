<?php
include_once(__DIR__."/../../lib/DataPilihan.php");
include_once(__DIR__."/../../lib/DataFormat.php");
header('Access-Control-Allow-Origin:*');
$penerbitpilihan = new PenerbitPilihan();
if(isset($_GET['id'])){
    $data=$penerbitpilihan->getPenerbit($_GET['id']);
} else {
    $data=$penerbitpilihan->getAll();
}
$format=new DataFormat();


$view = isset($_GET['view']) ? $_GET['view']: null;

// if($_GET['view']=='html') {
//     echo $format->asTable($data["data"]);
// } else {
//     echo $format->asJSON($data);
// }

if($_GET['view']=='json') {
    echo $format->asJSON($data);
} else {
    echo $format->asTable($data["data"]);
}