<?php
include_once(__DIR__."/../../lib/DataPilihan.php");
include_once(__DIR__."/../../lib/DataFormat.php");
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods:DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$kategoripilihan = new KategoriPilihan();

$id = isset($_POST['id_kategori']) ? $_POST['id_kategori']: null;

$result = $kategoripilihan->delete($id);
$format= new DataFormat();
echo $format->asJSON($result);