<?php
require_once ('core/init.php');
require_once "view/header.php";

if(isset($_SESSION['user'])){

  header('location:index.php');
}else{
$admincontroluser->controlregisteruser();
}
?>

<form action="" method="post">
  	
  <label for="nama">nama</label><br>
  <input type="text" name="username" value="" required><br><br>

  <label for="status">status</label><br>
  <input type="text" name="status" value="" required><br><br>


  <label for="password">password</label><br>
  <input type="password" name="password" value="" required><br><br>

  <label style="color:red;"><?php echo $admincontroluser->error; ?></label><br><br>
  <input type="submit" name="submit" value="daftar">
</form>

<?php
require_once ('view/footer.php');
?>

