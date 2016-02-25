<?php 
require_once ('core/init.php');

class controlblog extends system
{
	public $error;

	public function controltambahblog(){
		$judul = htmlspecialchars($_POST['judul'],ENT_QUOTES);
		$isi   = htmlspecialchars($_POST['isi'],ENT_QUOTES);
		$tag   = htmlspecialchars($_POST['tag'],ENT_QUOTES);
		$data  = array('judul'=>$judul, 'isi'=>$isi, 'tag'=>$tag);

		if(!empty(trim($judul)) && !empty(trim($isi)) && !empty(trim($tag))){
				if($this->tambah($data)){
					// header('location:index.php');
					echo "<script language=\"Javascript\">\n";
 			echo "confirmed = window.confirm('berhasil tambah data ! ?');";
 			echo "</script>";
				}else{
					$this->error = "gagal tambah";
				}	
	    }else{
			$this->error = "tambah jangan kosong boss !";
	    }
	} 

	public function controleditblog($id)
    {
        if(isset($_POST['submit'])){
	    	$judul  = htmlspecialchars($_POST['judul'],ENT_QUOTES);
			$isi    = htmlspecialchars($_POST['isi'],ENT_QUOTES);
			$tag    = htmlspecialchars($_POST['tag'],ENT_QUOTES);
	        $dimana = "WHERE id=";
	        $data   = array ('judul'=>$judul, 'isi'=>$isi, 'tag'=>$tag);

	   		if(!empty(trim($judul)) && !empty(trim($isi)) && !empty(trim($tag))){    
           		if($this->simpan($data, $dimana, $id)){
            		header ('location:index.php');
           		}else{
            		$this->error = "gagal edit";
           		}
       		}else{
        		$this->error = "edit jangan kosong "; 
       		}
   		}
    }

    public function controlhapusblog($id)
    {
    	$dimana = "WHERE id=";
    	if($this->hapus($dimana, $id)){
    		echo "<script language=\"Javascript\">\n";
 			echo "confirmed = window.confirm('berhasil menghapus data ! ?');";
 			echo "</script>";
	    }
    }

    public function controlcariblog($cari)
	{	
		$dimana="judul";
		$atau  =" OR tag";
		return $this->cari($cari, $dimana, $atau);
	}

}

class controluser extends system 
{
	public $error=NULL;

	public function controlloginuser()
	{
		if(isset($_SESSION['user'])){
  		header('location:index.php');
		}else{
		$error='';

			if(isset($_POST['submit'])){
				$nama     = $_POST['nama'];
				$password = $_POST['password'];

				if(!empty(trim($nama)) && !empty(trim($password))){
					if($this->cekloginuser($nama, $password)){
						$_SESSION['user'] = $nama;
						header('location:index.php');
					}else{
						$this->error = "gagal login";
					}
				}else{
					$this->error = "nama pass harus diisi";
				}			
			}
		}
	}

	public function controlregisteruser()
	{
		if(isset($_POST['submit'])){
  		$nama 	  = $_POST['username'];
  		$password = $_POST['password'];
  		$status   = $_POST['status'];
  	
	  		if(strlen($password > 6)){
	  			if(!empty(trim($nama)) && !empty(trim($password)) && !empty(trim($status))){
	  			$data = array('username'=>$nama, 'status'=>$status, 'password'=>password_hash($password,PASSWORD_DEFAULT) );

	     			if($this->cekregisternama($nama)){
	       				if($this->tambah($data)){
	        		  	$_SESSION['user']= $nama;
	        		 		header ('location:index.php');
	       			 	}else{
	         		 		$this->error = 'ada masalah saat register !!';
	       		 		}
	     		 	}else{
	        	  		$this->error = 'nama sudah ada !';
	      		  	}
	  			}else{
	  				$this->error = 'nama dan password harus di isi !';
	  			}
	  		}else{
	  			$this->error = 'password minimal 6 karakter !';
  			}
  		}
	}

	public function controllogoutuser()
	{
		unset($_SESSION['user']);
		session_destroy();
		header('location:login.php');
	}
}

class paging extends dbpagination
{
	public $batas = 5;

	public function controltampildanpagination()
	{

	     $halaman = @$_GET['halaman'];
	    if(empty($halaman)){
	      $posisi = 0;
	      $halaman = 1;
	    }else{
	      $posisi = ($halaman-1) * $this->batas;
	    } 

	    $this->views($posisi, $this->batas);

	  	for($i = 1; $i <= $this->jmlhalaman; $i++)
	      if($i != $halaman){
	         echo "<a href=$_SERVER[PHP_SELF]?halaman=$i> $i</a> ";
	      }else{
	        echo  "<b>$i </b>";
	      }
    
        if($halaman < $this->jmlhalaman){
          $halamann = $halaman+1;
           echo "<a href=$_SERVER[PHP_SELF]?halaman=$halamann>  &gt;&gt;</a> ";
        }
        if($halaman <= $this->jmlhalaman && $halaman > 1){
           $halamann = $halaman - 1;
         echo "<a href=$_SERVER[PHP_SELF]?halaman=$halamann>  &lt;&lt;</a> ";
        }

      	return $this->tampil();
	}
}

$admincontroluser = new controluser('localhost', 'root', '', 'tutorial');
$admincontroluser->settable('user');
$admincontrolblog = new controlblog('localhost', 'root', '', 'tutorial');
$admincontrolblog->settable('blog');
$admincontrolview = new paging('localhost', 'root', '', 'tutorial');
$admincontrolview->settable('blog');
?>