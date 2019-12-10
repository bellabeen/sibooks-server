<?php
include_once(__DIR__."/../../lib/kategori.php");
include_once(__DIR__."/../../lib/DataFormat.php");
header("Access-Control-Allow-Origin:*");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$kategoripilihan = new KategoriPilihan();
$kode_buku = isset($_POST['kode_buku']) ? $_POST['kode_buku']: null;
$judul = isset($_POST['judul']) ? $_POST['judul']: null;
$penulis = isset($_POST['penulis']) ? $_POST['penulis']: null;
$cover = isset($_POST['cover']) ? $_POST['cover']: null;
$kode_kategori = isset($_POST['kode_kategori']) ? $_POST['kode_kategori']: null;
$kode_penerbit = isset($_POST['kode_penerbit']) ? $_POST['kode_penerbit']: null;
$kategoripilihan->setValue($kode_buku, $judul, $penulis, $cover, $kode_kategori, $kode_penerbit);
$result = $kategoripilihan->create();
$format= new DataFormat();
echo $format->asJSON($result);