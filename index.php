<?php
require_once ('core/init.php');
$login     = false;
$superuser = false;
	$user = $admincontrolview->views(0,5);  //script tampil dan pagination
	$admincontrolview->controltampildanpagination();
	if(isset($_SESSION['user'])){ //script cek status user, admin, user biasa
	$login = true;
		if($admincontroluser->cekstatususer($_SESSION['user'])=='admin'){ 
		$superuser = true;
		}
	}
	if(isset($_GET['hapus'])){  //script hapus
		$id = $_GET['hapus'];
		$admincontrolblog->controlhapusblog($id);
	}
	if(isset($_GET['cari'])){  //script cari
		$cari = $_GET['cari'];
		$user = $admincontrolblog->controlcariblog($cari);
	}
	if(isset($_GET['logout'])){  //script logout
		$logout = $_GET['logout'];
		$admincontroluser->controllogoutuser();
	}
?>

<form action="" method="get">
    <input type="text" name="cari" value="" placeholder="cari disini">
    <label></label>
</form><br>
<a class="error" href=index.php><?php echo $admincontrolblog->error; ?></a>
<?php while ($row = $user->fetch_assoc()) { ?>
<div class="each_article">

	  <h3><a href="single_page.php?id=<?php echo $row['id']; ?>"><?php echo $row['judul'] ; ?></a></h3>
	  <p class="waktu"><?php echo $row['waktu'] ; ?></p>
	  <p><?php echo $admincontrolblog->excerpt($row['isi']) ; ?></p>
	  <h5><br><a href='single_page.php?id=<?php echo $row['id']; ?>'>readmore</a></h5>

	  <p class="tag"><?php echo $row['tag'] ; ?></p>

	  <?php if($login == true ) { ?>
	  <a href="edit.php?id=<?php echo $row['id'] ; ?>">Edit</a>
	  <?php } ?>
	  <?php if($superuser == true) { ?>
	  <a onclick="return confirm('Yakin mau menghapus ? <?php echo $row['judul'] ; ?>'); " href="index.php?hapus=<?php echo $row['id'] ; ?>">hapus</a>
 	  <?php } ?>
</div>

<?php } ?>
