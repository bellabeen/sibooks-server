<?php
include_once(__DIR__."/../../lib/DataPilihan.php");
include_once(__DIR__."/../../lib/DataFormat.php");
header("Access-Control-Allow-Origin:*");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$penerbitpilihan = new PenerbitPilihan();
$id_penerbit = isset($_POST['id_penerbit']) ? $_POST['id_penerbit']: null;
$penerbit = isset($_POST['penerbit']) ? $_POST['penerbit']: null;

$penerbitpilihan->setValue($id_penerbit, $penerbit);
$result = $penerbitpilihan->create();
$format= new DataFormat();
echo $format->asJSON($result);
