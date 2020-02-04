<?php
  require "../db.php";

$data = $_POST;

echo '<script>console.log('.json_encode($data,JSON_HEX_TAG).');</script>';
if ( isset($data['do_signIn']) )
{
	if ( ($data['Password'] == 'admin') && ($data['login'] == 'admin') )
	{
		header('Location: ../template-admin/admin.php');
	}
	
	$errors = array();
	
	if ( trim($data['login']) == '' )
	{
		$errors[] = 'Input Login';
	}
	if ( $data['Password'] == '' )
	{
		$errors[] = 'Input Password';
	}
	
	$user = R::findOne('users', 'login = ?', array($data['login']));
	if ( $user )
	{
		// Login is On
		if ( password_verify($data['Password'], $user->password) )
		{
			//Login is On - loged in progress..
			$_SESSION['logged_user'] = $user;
			unset($_SESSION['shopping_cart']);
			echo '<div style = "color: green; text-align: center; font-weight: 666;">Autorization Is Done!!!</div>';
			header('Location: ../');
		}
		else
		{
			$errors[] = 'Password not match';
		}
	}
	else
	{
		$errors[] = 'User not Found';
	}

	if ( ! empty($errors) )
	{
		//all bad - errors
		echo '<div style = "color: red; text-align: center; font-weight: 500;">' .array_shift($errors). '</div>';
	}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Sklep Gier - Logowanie</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
		<!-- Icons font header-->
		<link rel="shortcut icon" href="../img/icon.jpg" />
		<!-- latest compiled and minified CSS -->
        <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css" type="text/css">
        <!-- jquery library -->
        <script type="text/javascript" src="../bootstrap/js/jquery-3.2.1.min.js"></script>
        <!-- Latest compiled and minified javascript -->
        <script type="text/javascript" src="../bootstrap/js/bootstrap.min.js"></script>
        <!-- External CSS -->
        <link rel="stylesheet" href="../css/style.css" type="text/css">
	
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
</head>
<body>
	<?php
            require '../header-template.php';
    ?>
	<div class="limiter">
		<div class="container-login100" style="background-image: url('images/bg-01.jpg');">
			<div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-54">
				<form class="login100-form validate-form" action="../template-login/signIn.php" method="POST">
					<span class="login100-form-title p-b-49">
						Login
					</span>

					<div class="wrap-input100 validate-input m-b-23" data-validate = "Username is reauired">
						<span class="label-input100">Nickname</span>
						<input class="input100" type="text" name="login" placeholder="Type your username">
						<span class="focus-input100" data-symbol="&#xf206;"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Password is required">
						<span class="label-input100">Password</span>
						<input class="input100" type="Password" name="Password" placeholder="Type your password">
						<span class="focus-input100" data-symbol="&#xf190;"></span>
					</div>
					
					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<BUTTON type="signUp" name="do_signIn" class="login100-form-btn">
								Login
							</BUTTON>
						</div>
					</div>

					<div class="flex-col-c p-t-155">
						<span class="txt1 p-b-17">
							Or Sign Up Using
						</span>

						<a href="../template-register/signUp.php" class="txt2">
							Sign Up
						</a>
					</div>
				</form>
			</div>
		</div>
		<footer class="footer1"> 
               <div class="container">
				   <center>
					   <p1>Tu może być - Reklama;)</p1>
				   </center>
               </div>
		</footer>
	</div>
	

	<div id="dropDownSelect1"></div>
	
<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>

</body>
</html>