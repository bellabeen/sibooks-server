<?php
include_once(__DIR__."/../../lib/bukupilihan.php");
include_once(__DIR__."/../../lib/DataFormat.php");
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


$kode_buku = isset($_POST['kode_buku']) ? $_POST['kode_buku']: null;
$judul = isset($_POST['judul']) ? $_POST['judul']: null;
$penulis = isset($_POST['penulis']) ? $_POST['penulis']: null;
$cover = isset($_POST['cover']) ? $_POST['cover']: null;
$id_kategori = isset($_POST['id_kategori']) ? $_POST['id_kategori']: null;
$id_penerbit = isset($_POST['id_penerbit']) ? $_POST['id_penerbit']: null;

$bukupilihan = new BukuPilihan();
$result = $bukupilihan->update($_POST['kode_buku'], $_POST['judul'], $_POST['penulis'], $_POST['cover'], $_POST['id_kategori'],
                                $_POST['id_penerbit']);
$format= new DataFormat();
echo $format->asJSON($result);