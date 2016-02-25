<?php

class CRUD{

  protected $connect;
  private $table;


  public function __construct($host, $user, $password, $database)
  {
    $this->connect = new mysqli($host, $user, $password, $database) or die($connect->connect_error);
  }

  public function settable($table)
  {
  	$this->table=$table;
  }

  public function gettable()
  {
  	return $this->table;
  }

  public function simpan($data, $dimana, $id)
  {
      $user = " UPDATE $this->table set ";

        foreach ($data as $field => $input) {
        $user .= $field .'='.  "'".$this->escape($input)."'," .' '; 
        }
      $user  =substr($user,0,-2);
      $user .=$dimana.$id;
      $users = $this->connect->query($user);
      return $users;
  }

  public function tambah($data)
  {
    $user="insert into $this->table ";
    foreach ($data as $field => $input) {
      @$row   .=',' .$field;
      @$value .=", '".$this->escape($input)."' ";
    }
      $user  .=" (".substr($row, 1).") ";
      $user  .=" values(".substr($value, 1). ") ";
      $query  = $this->connect->prepare($user) or die ($this->connect->error);
      $query->execute();
    return $query;
  }

  public function tampil()
  {
    $user = "SELECT * FROM $this->table ";
    $user = $this->connect->query($user);
   
    return $user;
  }

  public function hapus($dimana, $id)
  {
    $user = "DELETE FROM $this->table $dimana $id";
    $user = $this->connect->query($user) or die ($connect->error);

    return $user;
  }

  public function edit($id)
  {
    $user = "SELECT * FROM $this->table where id = $id";
    $user = $this->connect->query($user) or die($connect->error);

    return $user;
  }

  public function __destruct()
  {
    $this->connect->close();
  }

}

class system extends CRUD
{
  public  $error;

  public function escape($string)
  {
    return $this->connect->real_escape_string($string); 
  }

  public function excerpt($string)
  {
    $string = nl2br($string);
    $isi = substr($string, 0, 50);
    return $isi;
  }

  public function cekloginuser($nama, $password)
  {
  	$nama     = $this->escape($nama);
  	$password = $this->escape($password);
    
    $query    = "SELECT password FROM {$this->gettable()} where username='$nama'";
	  $user     = $this->connect->query($query);
    	while($row = $user->fetch_assoc()){
			$hash=$row['password'];
    	$passwordhash=password_verify($password, $hash);
    	}
	  return @$passwordhash;
  }

  public function cekregisternama($nama)
  {
    $nama=$this->escape($nama);

    $query="SELECT * FROM {$this->gettable()} where username='$nama'";
    $result=$this->connect->query($query);
   
      if($row=$result->fetch_assoc() == 0)return true;
      else return false; 
  }

  public function cekstatususer($namasession)
  {
    $query    = "SELECT status FROM {$this->gettable()} where username='$namasession'";
    $user     = $this->connect->query($query);
      while($row = $user->fetch_assoc()){
      $status=$row['status'];
      }
    return $status;
  }

  public function cari($cari, $dimana=NULL, $atau=NULL)
  {
    $cari  = $this->escape($cari);
    $user  = "SELECT * FROM {$this->gettable()} WHERE $dimana LIKE '%$cari%' $atau LIKE '%$cari%'";
    $user  = $this->connect->query($user);
      if(!$user->num_rows){
        $this->error = "data yang dicari " . str_replace(error_reporting(0),'',$user='tidak di temukan klik untuk kembali..  ') ; // ??
      }else{
        return $user;
      }
  }  
}
  class dbpagination extends CRUD
{ 
    public $jmlhalaman;
    public $jmldata;
    public $batas;
    public $hasil;

    public function views($posisi, $batas)
    {
      $view = " SELECT * FROM {$this->gettable()} LIMIT $posisi, $batas";
      $hasil = $this->connect->query($view);

      $user = $this->tampil();
      
      $this->jmldata = $user->num_rows;
      $this->jmlhalaman = ceil($this->jmldata/$this->batas);

      return $hasil;
    }
}


?>

