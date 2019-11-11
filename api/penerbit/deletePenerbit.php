<?php
include_once(__DIR__."/../../lib/DataPilihan.php");
include_once(__DIR__."/../../lib/DataFormat.php");
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods:DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$penerbitpilihan = new PenerbitPilihan();

$id = isset($_POST['id_penerbit']) ? $_POST['id_penerbit']: null;

$result = $penerbitpilihan->delete($id);
$format= new DataFormat();
echo $format->asJSON($result);
