<?php
  require "db.php";
?>

<?php if ( isset($_SESSION['logged_user']) ) : ?>
	Autorizated:)
	<br>
	Hello, <?php echo $_SESSION['logged_user'] -> login; ?>!
	<hr>
	<a href = "logOut.php">Log Out</a>
<?php else : ?>
	Not Autorizated:(
	<br>
	<a href = "template-login/signIn.php">Sign In</a><br>
	<a href = "template-register/signUp.php">Sign Up</a>
<?php endif; ?>