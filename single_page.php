<?php
require_once ('core/init.php');
$login=false;
if(isset($_SESSION['user'])){
	$login=true;
}
	$id = $_GET['id'];
	$user = $admincontrolblog->edit($id);

	while($row = $user->fetch_assoc()){
?>

<form action="" method="get">
    <input type="text" name="cari" value="" placeholder="cari disini">
</form>

<div class="each_article">

	  <h3><a href=""><?php echo $row['judul'] ; ?></a></h3>
	  <p><?php echo $row['isi'] ; ?></p>
	  <p class="waktu"><?php echo $row['waktu'] ; ?></p>
	  <p class="tag"><?php echo $row['tag'] ; ?></p>
		 <?php if($login==true) { ?>
	   <a href="edit.php?id=<?php echo $row['id'] ; ?>">Edit</a>
	  <a onclick="return confirm('Yakin mau menghapus ? <?php echo $row['judul'] ; ?>'); " href="index.php?id=<?php echo $row['id'] ; ?>">hapus</a>
 		<?php } ?>

</div>
<?php } ?>

