<?php
include_once(__DIR__."/../../lib/kategori.php");
include_once(__DIR__."/../../lib/DataFormat.php");
header("Access-Control-Allow-Origin:*");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$kategoripilihan = new KategoriPilihan();
$id_kategori = isset($_POST['id_kategori']) ? $_POST['id_kategori']: null;
$kategori = isset($_POST['kategori']) ? $_POST['kategori']: null;
$kategoripilihan->setValue($id_kategori, $kategori);
$result = $kategoripilihan->create();
$format= new DataFormat();
echo $format->asJSON($result);