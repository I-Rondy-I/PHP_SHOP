<?php
  require "db.php";
?>

<?php if ( isset($_SESSION['logged_user']) ) : ?>
	Autorizated:)
	<br>
	Hello, <?php echo $_SESSION['logged_user'] -> login; ?>!
	<hr>
	<a href = "/PHP/logOut.php">Log Out</a>
<?php else : ?>
	Not Autorizated:(
	<br>
	<a href = "/PHP/signIn.php">Sign In</a><br>
	<a href = "/PHP/signUp.php">Sign Up</a>
<?php endif; ?>