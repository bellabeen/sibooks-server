<?php
include_once (__DIR__ . "/DB.php");
class KategoriPilihan{
    private $table_name='kategori';
    private $db = null;
    public  $id_kategori=null;
    private $kategori=null;

    function __construct(){
        if ($this->db ==  null){
            $conn = new DB();
            $this->db = $conn->db;
        }
    }

    function setValue($id_kategori, $kategori){
        // $this();
        $this->id_kategori = $id_kategori;
        $this->kategori = $kategori;

    }


    ///fungsi pennyimpanan data berhasil atau tidak
    function create(){
        // $count = count($this->getBukuPilihan($this->kode_buku));
        $bk= $this->getKategoriPilihan($this->id_kategori);
        $count = count($bk["data"]);
        if ($count>0) {
            http_response_code(503);
            return array('msg' => "Data sudah ada, tidak berhasil disimpan");
        } 
        else if ($this->id_kategori == null){
            http_response_code(503);
            return array('msg' => "KOde tidak boleh kosong");
        } 
        else{
            $kueri = "INSERT INTO ".$this->table_name." SET ";
            $kueri .= "id_kategori='".$this->id_kategori ."',";
            $kueri .= "kategori='".$this->kategori."'";
            $hasil = $this->db->query($kueri);
            if ($hasil) {
                http_response_code(201);
                return array('msg' => 'success');
            } else {
                http_response_code(503);
                return array('msg' => 'Data Gagal disimpan '.$this->db->error);
            }

        }
    }

    //fungsi update data
    function update($id_kategori,$kategori=null){
        $hasil= $this->getKategoriPilihan($id_kategori);
        $count=count($hasil["data"]);
        if ($count==0){ 
            http_response_code(503);
            return array('msg' => "Data tidak  ada, tidak dapat disimpan" );
        }
        else if ($id_kategori  == null){
            http_response_code(503);
            return array('msg' => "Kode tidak boleh kosong, tidak berhasil disimpan" );
        } else {
            $this->setValue($hasil["data"][0]["id_kategori"],
                    $hasil["data"][0]["kategori"]
                    );

            if ($kategori!=null) $this->kategori=$kategori;

            $kueri = "UPDATE ".$this->table_name." SET ";
            $kueri .= "kategori='".$this->kategori."'";
            $kueri .= " WHERE id_kategori='".$this->id_kategori."'";
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
        $kueri = "SELECT * FROM ".$this->table_name." ORDER BY id_kategori";
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

    function getKategoriPilihan($id_kategori){
        // return "test";
        $kueri = "SELECT * FROM ".$this->table_name;
        $kueri .=" WHERE id_kategori='".$id_kategori."'";
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
    function delete($id_kategori){
        // return "test";
        $data="";
        $row = $this->getKategoriPilihan($id_kategori);
        if (count($row["data"])==0) {
            http_response_code(304);
            return array("msg"=>$row["msg"]."id_kategori ".$id_kategori);
            return array('msg'=>$kueri);
        }

        $kueri = "DELETE FROM ".$this->table_name;
        $kueri .=" WHERE id_kategori='".$id_kategori."'";
        $hasil = $this->db->query($kueri) or die ("Error ".$this->db->connect_error);

        http_response_code(200);
        return array("msg"=>"success");
    }

}