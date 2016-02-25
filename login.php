<?php
require_once ('core/init.php');
$admincontroluser->controlloginuser();
?>

<h1>Form Login</h1>
<label style="color:red;"><?php echo $admincontroluser->error; ?></label>
<form action="" method="post"><br>
<label for="nama">Nama</label>
<input type="text" name="nama"></input><br>
<label for="Password">Password</label>
<input type="password" name="password"></input><br>
<input type="submit" name="submit" value="login" ></input><br>
<label style="color:red;"></label>
</form>