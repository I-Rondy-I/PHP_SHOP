<?php
require "../db.php";

$data = $_POST;
$Producers = R::findAll( 'Producent' );
$Gatunek = R::findAll( 'Gatunek' );
$Platforma = R::findAll( 'Platforma' );

echo '<script>console.log('.json_encode($data,JSON_HEX_TAG).');</script>';
if ( isset($data['do_add']) )
{
	//Adding products in here
    $errors = array();
	$user = R::findOne('gra', 'tytul = ?', array($data['Tytul']));
    
	if ( trim($data['Tytul']) == "" )
	{
		$errors[] = 'Input Tytul';
	}
	if ( ($_FILES["Image"]["error"] != 0) && !$user )
	{
		$errors[] = 'Not Picture';
	}

	if ( empty($errors) )
	{
		//all good - adding in progress..
		if ( $user && ($data['Tytul'] == $user->tytul) && ($data['Platforma'] == $user->id_platforma) )
		{
			$user->dostepnosc = $user->dostepnosc + $data['Count'];
			$user->cena = $data['Cena'];
			
			//echo '<script>alert("POST tytul:'.$data['Tytul'].'");</script>';
			//echo '<script>alert("product tytul:'.$user->tytul.'");</script>';
			
			R::store($user);
			
			header('Location:admin.php?add_success=true');
		}
		else
		{
			//echo '<script>alert("'.$data["Tytul"].'");</script>';
			
			$user = R::dispense('gra');
			$user->tytul = $data['Tytul'];
			
			$user->id_producent = $data['Producent'];
			$user->id_platforma = $data['Platforma'];
			$user->id_gatunek = $data['Gatunek'];
			$user->dostepnosc = $data['Count'];
			$user->cena = $data['Cena'];
			
			$path = $_FILES['Image']['tmp_name'];
			$type = pathinfo($path, PATHINFO_EXTENSION);
			$data = file_get_contents($path);
			$base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
			
			$user->img = $base64;
			
			R::store($user);
			
			header('Location:admin.php?modify_success=true');
		}
	}
	else
	{
		echo '<div style = "color: red; text-align: center; font-weight: 444;">' .array_shift($errors). '</div><hr>';
	}  
	echo "<meta http-equiv='refresh' content='2; url=admin.php' />"; 
}

if (isset($_GET['add_success']) && $_GET['add_success']=='true'){
	echo '<div style = "color: blue; text-align: center; font-weight: 666;">Modify Is Done!!!</div>';
	unset($_GET['add_success']);
	echo "<meta http-equiv='refresh' content='2; url=admin.php' />";
}
if (isset($_GET['modify_success']) && $_GET['modify_success']=='true'){
	echo '<div style = "color: green; text-align: center; font-weight: 666;">Adding Is Done!!!</div>';
	unset($_GET['modify_success']);
	echo "<meta http-equiv='refresh' content='2; url=admin.php' />";
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
	
    <!-- Title Page-->
    <title>Sklep Gier - Dodanie towaru</title>
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
                    <h2 class="title">Dodanie towaru</h2>
                </div>
                <div class="card-body">
                    <form action="../template-admin/admin.php" method="POST" enctype="multipart/form-data" action="__URL__">
                        <div class="form-row">
                            <div class="name">Tytul</div>
                            <div class="value">
                                <div class="input-group">
                                    <input class="input--style-5" type="text" name="Tytul">
                                </div>
                            </div>
                        </div>
						<div class="form-row">
                            <div class="name">Image</div>
                            <div>
                                <div class="input-group">
                                    <input class="input--style-5" type="file" name="Image" accept="image/*">							
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="name">Ilość</div>
                            <div class="value">
                                <div class="input-group">
                                    <div class="rs-select2 js-select-simple select--no-search">
                                        <select name="Count">
												<?php foreach ( range(1,100,1) as $value) : ?>
													<option value="<?php echo $value ?>">
														<?php echo $value; ?>
													</option>
												<?php endforeach; ?>
                                        </select>
                                        <div class="select-dropdown"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
						<div class="form-row">
                            <div class="name">Producent</div>
                            <div class="value">
                                <div class="input-group">
                                    <div class="rs-select2 js-select-simple select--no-search">
                                        <select name="Producent">		
											<?php foreach ( $Producers as $producer) : ?>
												<option value="<?php echo $producer->id ?>">
													<?php echo $producer->opis_producent; ?>
												</option>
											<?php endforeach; ?>
										</select>
                                        <div class="select-dropdown"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
						<div class="form-row">
                            <div class="name">Gatunek</div>
                            <div class="value">
                                <div class="input-group">
                                    <div class="rs-select2 js-select-simple select--no-search">
                                        <select name="Gatunek">		
											<?php foreach ( $Gatunek as $gatunek) : ?>
												<option value="<?php echo $gatunek->id ?>">
													<?php echo $gatunek->opis_gatunek; ?>
												</option>
											<?php endforeach; ?>
										</select>
                                        <div class="select-dropdown"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
						<div class="form-row">
                            <div class="name">Platforma</div>
                            <div class="value">
                                <div class="input-group">
                                    <div class="rs-select2 js-select-simple select--no-search">
                                        <select name="Platforma">		
											<?php foreach ( $Platforma as $platforma) : ?>
												<option value="<?php echo $platforma->id ?>">
													<?php echo $platforma->opis_platforma; ?>
												</option>
											<?php endforeach; ?>
										</select> 
                                        <div class="select-dropdown"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
						<div class="form-row">
                            <div class="name">Cena</div>
                            <div class="value">
                                <div class="input-group">
                                    <input class="input--style-5" type="number" name="Cena" min="0" value="0">
                                </div>
                            </div>
                        </div>
                            <button class="btn btn--radius-2 btn--red" type="signUp" name="do_add">Dodaj</button>
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