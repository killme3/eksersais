<?php
require_once ('core/init.php');
	$id = $_GET['id'];
	$user = $admincontrolblog->edit($id);
	$admincontrolblog->controleditblog($id);

	while($row = $user->fetch_assoc()){
?>
<br>
<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="ckeditor/style.js"></script>
<h1>EDit Data</h1>

<form action="" method="post" enctype="multipart/form-data">
<label for="judul"></label><br>
<input type="text" name="judul" value="<?php echo $row['judul'] ; ?>"></input><br>


<label for="isi">Isi</label><br>
<textarea  name="isi" rows="8" cols="40"><?php echo $row['isi'] ; ?></textarea><br>


<label for="tag">Tag</label><br>
<input type="text" name="tag" value="<?php echo $row['tag'] ; ?>"></input><br>
<label style="color:red;"><?php echo $admincontrolblog->error; ?></label><br><br>
<input type="submit" name="submit" value="Edit"></input><br>


</form>
<?php } ?>
