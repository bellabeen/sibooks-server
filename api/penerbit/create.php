<?php
include_once(__DIR__."/../../lib/penerbit.php");
include_once(__DIR__."/../../lib/DataFormat.php");
header("Access-Control-Allow-Origin:*");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$penerbitpilihan = new PenerbitPilihan();
$kode_penerbit = isset($_POST['kode_penerbit']) ? $_POST['kode_penerbit']: null;
$penerbit = isset($_POST['penerbit']) ? $_POST['penerbit']: null;
$penerbitpilihan->setValue($kode_penerbit, $penerbit);
$result = $penerbitpilihan->create();
$format= new DataFormat();
echo $format->asJSON($result);