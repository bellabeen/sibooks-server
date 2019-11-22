<?php
include_once(__DIR__."/lib/kategori.php");
include_once(__DIR__."/lib/DataFormat.php");
header("Access-Control-Allow-Origin:*");


$kategoripilihan = new KategoriPilihan();
$id_kategori = isset($_POST['id_kategori']) ? $_POST['id_kategori']: null;
$genre = isset($_POST['kategori']) ? $_POST['kategori']: null;


$result = $kategoripilihan->update($_POST['id_kategori'], $_POST['kategori']);
$format= new DataFormat();
echo $format->asJSON($result);  