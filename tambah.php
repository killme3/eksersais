<?php
require_once ('core/init.php');
if(isset($_POST['submit'])){
	$admincontrolblog->controltambahblog();
}
?>
<br>

<h1>Tambah Data</h1>

<form action="" method="post">
<label for="judul">Judul</label><br>
<input type="text" name="judul" required></input><br>
<label for="isi">Isi</label><br>
<textarea name="isi" cols="21" rows="5" required></textarea><br>
<label for="tag">Tag</label><br>
<input type="text" name="tag" required></input><br>
<label></label><br>
<label style="color:red;"><?php echo $admincontrolblog->error; ?></label><br><br>
<input type="submit" name="submit" value="Tambah"></input><br>
</form>