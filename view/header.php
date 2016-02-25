<?php
require_once ('core/init.php');
$login=false;
if(isset($_SESSION['user'])){
	$login = true;
}
?>

<head>
  <title>Tutorial</title>
  <link rel="stylesheet" href="view/style.css" media="screen" title="no title" charset="utf-8">
</head>

<h1>Tutorial Blog</h1>

<div id="menu">
  <a href="index.php?halaman">Home</a>
  
  <?php if($login==true) { ?>
  <a href="tambah.php">Tambah</a>
 <?php } ?>

  <?php if($login==false) { ?>
  <a href="login.php">Login</a>
  <?php } ?>

 <?php if($login==true) { ?>
  <a href="index.php?logout">Logout</a>
 <?php } ?>

 <?php if($login==false) { ?>
  <a href="register.php">Register</a>
  <?php } ?>
</div>
<?php require_once ('view/footer.php'); ?>