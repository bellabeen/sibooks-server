<?php
include_once (__DIR__ . "/DB.php");
class BukuPilihan{
    private $table_name1='buku';
    private $table_name2='kategori';
    private $table_name3='penerbit';
    private $db = null;
    public  $kode_buku=null;
    private $judul = null;
    private $penulis = null;
    private $cover = null;
    public  $kode_kategori = null;
    public  $kode_penerbit = null;

    function __construct(){
        if ($this->db ==  null){
            $conn = new DB();
            $this->db = $conn->db;
        }
    }

    function setValue($kode_buku, $judul, $penulis, $cover, $kode_kategori, $kode_penerbit){
        // $this();
        $this->kode_buku = $kode_buku;
        $this->judul = $judul;
        $this->penulis = $penulis;
        $this->cover = $cover;
        $this->kode_kategori = $kode_kategori;
        $this->kode_penerbit = $kode_penerbit;

    }


    ///fungsi pennyimpanan data berhasil atau tidak
    function create(){
        // $count = count($this->getBukuPilihan($this->kode_buku));
        $bk= $this->getBukuPilihan($this->kode_buku);
        $count = count($bk["data"]);
        if ($count>0) {
            http_response_code(503);
            return array('msg' => "Data sudah ada, tidak berhasil disimpan");
        } 
        else if ($this->kode_buku == null){
            http_response_code(503);
            return array('msg' => "KOde tidak boleh kosong");
        } 
        else{
            $foto = $_FILES['cover']['name'];
            $tmp = $_FILES['cover']['tmp_name'];
            $cover = date('dmYHis').$foto;

            //set path folder tempat penyimpanan foto
            $path = "upload/".$cover;
            move_uploaded_file($tmp, $path);
            $kueri = "INSERT INTO ".$this->table_name1." SET ";
            $kueri .= "kode_buku='".$this->kode_buku ."',";
            $kueri .= "judul='".$this->judul ."',";
            $kueri .= "penulis='".$this->penulis ."',";
            $kueri .= "cover='".$this->cover ."',";
            $kueri .= "kode_kategori='".$this->kode_kategori."',";
            $kueri .= "kode_penerbit='".$this->kode_penerbit ."'";
            $hasil = $this->db->query($kueri);
            if ($hasil) {
                http_response_code(200);
                return array('msg' => 'success');
            } else {
                http_response_code(503);
                return array('msg' => 'Data Gagal disimpan '.$this->db->error);
            }

        }
    }

    //fungsi update data
    function update($kode_buku,$judul=null, $penulis=null, $cover=null, $kode_kategori=null, $kode_penerbit=null){
        $hasil= $this->getBukuPilihan($kode_buku);
        $count=count($hasil["data"]);
        if ($count==0){ 
            http_response_code(503);
            return array('msg' => "Data tidak  ada, tidak dapat disimpan" );
        }
        else if ($kode_buku  == null){
            http_response_code(503);
            return array('msg' => "Kode tidak boleh kosong, tidak berhasil disimpan" );
        } else {
            $this->setValue($hasil["data"][0]["kode_buku"],
            $hasil["data"][0]["judul"],
            $hasil["data"][0]["penulis"],
            $hasil["data"][0]["cover"],
            $hasil["data"][0]["kode_kategori"],
            $hasil["data"][0]["kode_penerbit"]
            );

            if ($judul!=null) $this->judul=$judul;
            if ($penulis!=null) $this->penulis=$penulis;
            if ($cover!=null) $this->cover=$cover;
            if ($kode_kategori!=null) $this->kode_kategori=$kode_kategori;
            if ($kode_penerbit!=null) $this->kode_penerbit=$kode_penerbit;

            $kueri = "UPDATE ".$this->table_name1." SET ";
            $kueri .= "judul='".$this->judul."',";
            $kueri .= "penulis='".$this->penulis."',";
            $kueri .= "cover='".$this->cover."',";
            $kueri .= "kode_kategori='".$this->kode_kategori."',";
            $kueri .= "kode_penerbit='".$this->kode_penerbit."'";
            $kueri .= " WHERE kode_buku='".$this->kode_buku."'";
            $hasil = $this->db->query($kueri);
            if ($hasil){
                http_response_code(201);
                return array('msg'=>'success');
            } else {
                http_response_code(503);
                return array('msg'=>'Data Gagal Disimpan '.$this->db->error." ".$kueri); 
            }
            // return array('msg'=>$kueri);
        }
    }
    

    function getAll(){
        // return "test";
        $kueri = "SELECT * FROM ".$this->table_name1." ORDER BY kode_buku";
        $hasil = $this->db->query($kueri) or die ("Error ".$this->db->connect_error);
        http_response_code(200);
        $data = array();
        while ($row = $hasil->fetch_assoc()){
            $data[]=$row;
        }
        if(count($data)==0)
            return array("msg"=>"Data Tidak Ada", "data"=>array());
        
        return array("msg"=>"success", "data"=>$data);
    }

    function getBukuPilihan($kode_buku){
        // return "test";
        $kueri = "SELECT * FROM ".$this->table_name1;
        $kueri .=" WHERE kode_buku='".$kode_buku."'";
        $hasil = $this->db->query($kueri) or die ("Error ".$this->db->connect_error);
        http_response_code(200);
        $data = array();
        while ($row = $hasil->fetch_assoc()){
            $data[]=$row;
        }
        if (count($data)==0)
            return array("msg"=>"Data tidak ada ", "data"=>array());
        return array("msg"=>"success", "data"=>$data);
    }

    function getPenerbitPilihan($kode_penerbit){
        // return "test";
        $kueri = "SELECT * FROM ".$this->table_name3;
        $kueri .=" WHERE kode_penerbit='".$kode_penerbit."'";
        $hasil = $this->db->query($kueri) or die ("Error ".$this->db->connect_error);
        http_response_code(200);
        $data = array();
        while ($row = $hasil->fetch_assoc()){
            $data[]=$row;
        }
        if (count($data)==0)
            return array("msg"=>"Data tidak ada ", "data"=>array());
        return array("msg"=>"success", "data"=>$data);
    }

    function getKategoriPilihan($kode_kategori){
        // return "test";
        $kueri = "SELECT * FROM ".$this->table_name2;
        $kueri .=" WHERE kode_kategori='".$kode_kategori."'";
        $hasil = $this->db->query($kueri) or die ("Error ".$this->db->connect_error);
        http_response_code(200);
        $data = array();
        while ($row = $hasil->fetch_assoc()){
            $data[]=$row;
        }
        if (count($data)==0)
            return array("msg"=>"Data tidak ada ", "data"=>array());
        return array("msg"=>"success", "data"=>$data);
    }

    ///fungsi delete data
    function deleteAll($kode_buku){
        // return "test";
        $data="";
        $row = $this->getBukuPilihan($kode_buku);
        if (count($row["data"])==0) {
            http_response_code(304);
            return array("msg"=>$row["msg"]."kode_buku ".$kode_buku);
            return array('msg'=>$kueri);
        }

        $kueri = "DELETE FROM ".$this->table_name1;
        $kueri .=" WHERE kode_buku='".$kode_buku."'";
        $hasil = $this->db->query($kueri) or die ("Error ".$this->db->connect_error);

        http_response_code(200);
        return array("msg"=>"success");
    }
}