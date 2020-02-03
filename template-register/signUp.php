<?php
  require "../db.php";

$data = $_POST;
if ( isset($data['do_signUp']) )
{
	//Registration in here
    $errors = array();
    
	if ( trim($data['login']) == '' )
	{
		$errors[] = 'Input Login';
	}
	if ( trim($data['E-mail']) == '' )
	{
		$errors[] = 'Input E-mail';
	}
	if ( $data['Password'] == '' )
	{
		$errors[] = 'Input Password';
	}

	if ( $data['Password_2'] != $data['Password'] )
	{
		$errors[] = 'Passwords are not Identify!!';
	}
	if ( R::count('users', "login = ?", array($data['login'])) > 0)
	{
		$errors[] = 'User with this Login - Already exists';
	}
	if ( R::count('users', "E-mail = ?", array($data['E-mail'])) > 0)
	{
		$errors[] = 'User with this E-mail - Already exists';
	}

	if ( empty($errors) )
	{
		//all good - registration in progress..

		$user = R::dispense('users');
		$user->login = $data['login'];
		$user->email = $data['E-mail'];
		$user->password = password_hash($data['Password'], PASSWORD_DEFAULT);
		R::store($user);
		echo '<div style = "color: green; text-align: center; font-weight: 666;">Registration Is Done!!!</div>';
	}
	else
	{
		echo '<div style = "color: red; text-align: center; font-weight: 500;">' .array_shift($errors). '</div><hr>';
	}
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
	
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Colorlib Templates">
    <meta name="author" content="Colorlib">
    <meta name="keywords" content="Colorlib Templates">

    <!-- Title Page-->
    <title>Rejestracja</title>
	
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
	
    <!-- Icons font CSS-->
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <!-- Font special for pages-->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet">

    <!-- Vendor CSS-->
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="vendor/datepicker/daterangepicker.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="css/main.css" rel="stylesheet" media="all">
</head>

<body>
	<?php
        require '../header-template.php';
    ?>
    <div class="page-wrapper bg-gra-03 p-t-45 p-b-50">
        <div class="wrapper wrapper--w790">
            <div class="card card-5">
                <div class="card-heading">
                    <h2 class="title">Registration</h2>
                </div>
                <div class="card-body">
                    <form action="../template-register/signUp.php" method="POST" >
                        <div class="form-row">
                            <div class="name">Login</div>
                            <div class="value">
                                <div class="input-group">
                                    <input class="input--style-5" type="text" name="login" value = "<?php echo @$data['login']; ?>">
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="name">E-mail</div>
                            <div class="value">
                                <div class="input-group">
                                    <input class="input--style-5" type="E-mail" name="E-mail" value = "<?php echo @$data['E-mail']; ?>">
                                </div>
                            </div>
                        </div>
						<div class="form-row">
                            <div class="name">Password</div>
                            <div class="value">
                                <div class="input-group">
                                    <input class="input--style-5" type="Password" name="Password">
                                </div>
                            </div>
                        </div>
						<div class="form-row">
                            <div class="name">Repeat Password</div>
                            <div class="value">
                                <div class="input-group">
                                    <input class="input--style-5" type="Password" name="Password_2">
                                </div>
                            </div>
                        </div>
                        <div>
                            <button class="btn btn--radius-2 btn--red" type="signUp" name="do_signUp">Register</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
		<footer class="footer"> 
               <div class="container">
				   <center>
					   <p>Tu może być - Reklama;)</p>
				   </center>
               </div>
        </footer>
    </div>

    <!-- Jquery JS-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <!-- Vendor JS-->
    <script src="vendor/select2/select2.min.js"></script>
    <script src="vendor/datepicker/moment.min.js"></script>
    <script src="vendor/datepicker/daterangepicker.js"></script>

    <!-- Main JS-->
    <script src="js/global.js"></script>

</body><!-- This templates was made by Colorlib (https://colorlib.com) -->

</html>
<!-- end document-->