<?php
include_once (__DIR__ . "/DB.php");
class KategoriPilihan{
    private $table_name='kategori';
    private $db = null;
    public  $id_kategori=null;
    private $kategori =null;

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
        // echo "KOneksi";

    }


    ///fungsi pennyimpanan data berhasil atau tidak
    function create(){
        $bk= $this->getKategori($this->id_kategori);
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
        $hasil= $this->getKategori($id_kategori);
        $count=count($hasil["data"]);
        // return $hasil["data"][0]["kode"];
        if ($count==0){ 
            http_response_code(503);
            return array('msg' => "Data tidak  ada, tidak dapat disimpan" );
        }
        else if ($id_kategori == null){
            http_response_code(503);
            return array('msg' => "Kode tidak boleh kosong, tidak berhasil disimpan" );
        } else {
            $this->setValue($hasil["data"][0]["id_kategori"],
                    $hasil["data"][0]["kategori"]
                    );

            if ($kategori!=null) $this->kategori=$kategori;

            $kueri = "UPDATE ".$this->table_name." SET ";
            $kueri .= "kategori='".$this->kategori."',";
            $kueri .= " WHERE id_kategori='".$this->id_kategori."'";
            $hasil = $this->db->query($kueri);
            if ($hasil){
                http_response_code(201);
                return array('msg'=>'success','kueri'=>$kueri);
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

    function getKategoriPilihan($id){
        // return "test";
        $kueri = "SELECT * FROM ".$this->table_name;
        $kueri .=" WHERE id_kategori='".$id."'";
        $hasil = $this->db->query($kueri) or die ("Error ".$this->db->connect_error);
        http_response_code(200);
        $data = array();
        while ($row = $hasil->fetch_assoc()){
            $data[]=$row;
        }
        if (count($data)==0)
            return array("msg"=>"Data tidak ada", "data"=>array());
            
        return array("msg"=>"success", "data"=>$data);
    }

    ///fungsi delete data
    function deleteKategori(){
        $kueri = "DELETE FROM ".$this->table_name." WHERE id_kategori='".$this->id_kategori."'";
        print_r($kueri);
		$hasil = $this->db->query($kueri);
		if ($hasil) {
			http_response_code(200);
			return array('msg' =>'Data Berhasil Terhapus');
		} else {
			http_response_code(503);
			return array('msg' => 'Data Gagal Terhapus '.$this->db->error);
		}


        // // return "test";
        // $data="";
        // $row = $this->getKategori($id);
        // // print_r($row);
        // if (count($row["data"])==1) {
        //     http_response_code(304);
        //     return array("msg"=>$row["msg"]."id ".$id);
        // }

        // $kueri = "DELETE FROM ".$this->table_name;
        // // $kueri .= " WHERE ".$this->table_name;
        // // $kueri .= " id_kategori='"."$id'";
        // $kueri .=" WHERE id_kategori='"."$id'";
        // echo $kueri;
        // // print_r($kueri);
        // $hasil = $this->db->query($kueri) or die ("Error ".$this->db->connect_error);
        
        // http_response_code(200);
        // return array("msg"=>"success");
    }

}


class PenerbitPilihan{
    private $table_name='penerbit';
    private $db = null;
    public  $id_penerbit=null;
    private $penerbit =null;

    function __construct(){
        if ($this->db ==  null){
            $conn = new DB();
            $this->db = $conn->db;
        }
    }

    function setValue($id_penerbit, $penerbit){
        // $this();
        $this->id_penerbit = $id_penerbit;
        $this->penerbit = $penerbit;
        // echo "KOneksi";

    }


    ///fungsi pennyimpanan data berhasil atau tidak
    function create(){
        // $count = count($this->getBukuPilihan($this->kode_buku));
        $bk= $this->getPenerbit($this->id_penerbit);
        $count = count($bk["data"]);
        if ($count>0) {
            http_response_code(503);
            return array('msg' => "Data sudah ada, tidak berhasil disimpan");
        } 
        else if ($this->id_penerbit == null){
            http_response_code(503);
            return array('msg' => "KOde tidak boleh kosong");
        } 
        else{
            $kueri = "INSERT INTO ".$this->table_name." SET ";
            $kueri .= "id_penerbit='".$this->id_penerbit ."',";
            $kueri .= "penerbit='".$this->penerbit."'";
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
    function update($id_penerbit,$penerbit=null){
        $hasil= $this->getPenerbit($id_penerbit);
        $count=count($hasil["data"]);
        // return $hasil["data"][0]["kode"];
        if ($count==0){ 
            http_response_code(503);
            return array('msg' => "Data tidak  ada, tidak dapat disimpan" );
        }
        else if ($id_penerbit == null){
            http_response_code(503);
            return array('msg' => "Kode tidak boleh kosong, tidak berhasil disimpan" );
        } else {
            $this->setValue($hasil["data"][0]["id_penerbit"],
                    $hasil["data"][0]["penerbit"]
                    );

            if ($penerbit!=null) $this->penerbit=$penerbit;

            $kueri = "UPDATE ".$this->table_name." SET ";
            $kueri .= "penerbit='".$this->penerbit."',";
            $kueri .= " WHERE id_penerbit='".$this->id_penerbit."'";
            $hasil = $this->db->query($kueri);
            if ($hasil){
                http_response_code(201);
                return array('msg'=>'success','kueri'=>$kueri);
            } else {
                http_response_code(503);
                return array('msg'=>'Data Gagal Disimpan '.$this->db->error." ".$kueri); 
            }
            // return array('msg'=>$kueri);
        }
    }
    

    function getAll(){
        // return "test";
        $kueri = "SELECT * FROM ".$this->table_name." ORDER BY id_penerbit";
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

    function getPenerbit($id){
        // return "test";
        $kueri = "SELECT * FROM ".$this->table_name;
        $kueri .=" WHERE id_penerbit='".$id."'";
        $hasil = $this->db->query($kueri) or die ("Error ".$this->db->connect_error);
        http_response_code(200);
        $data = array();
        while ($row = $hasil->fetch_assoc()){
            $data[]=$row;
        }
        if (count($data)==0)
            return array("msg"=>"Data tidak ada", "data"=>array());
        
        return array("msg"=>"success", "data"=>$data);
    }

    ///fungsi delete data
    function delete($id){
        // return "test";
        $data="";
        $row = $this->getPenerbit($id);
        if (count($row["data"])==0) {
            http_response_code(304);
            return array("msg"=>$row["msg"]."id ".$id);
        }

        $kueri = "DELETE FROM ".$this->table_name;
        $kueri .=" WHERE id_penerbit='".$id."'";
        $hasil = $this->db->query($kueri) or die ("Error ".$this->db->connect_error);

        http_response_code(200);
        return array("msg"=>"success");
    }

}


