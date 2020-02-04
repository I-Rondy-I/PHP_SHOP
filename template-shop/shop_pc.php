<?php
session_start();
include('db.php');
$status="";
if (isset($_POST['id']) && $_POST['id']!=""){
	$id = $_POST['id'];
	$result = mysqli_query($con,"SELECT * FROM `gra` WHERE `id`='$id'");
	$row = mysqli_fetch_assoc($result);
	$tytul = $row['tytul'];
	$id = $row['id'];
	$cena = $row['cena'];
	$image = $row['img'];

	$cartArray = array(
		$id=>array(
			'tytul'=>$tytul,
			'id'=>$id,
			'cena'=>$cena,
			'quantity'=>1,
			'image'=>$image)
		);

if(empty($_SESSION["shopping_cart"])) {
	$_SESSION["shopping_cart"] = $cartArray;
	$status = "<div class='box'>Product is added to your cart!</div>";
}else{
		$array_keys = array_keys($_SESSION["shopping_cart"]);
		if(in_array($id,$array_keys)) {
			$status = "<div class='box' style='color:red;'>
			Product is already added to your cart!</div>";	
		} else {
			$_SESSION["shopping_cart"] = array_merge($_SESSION["shopping_cart"],$cartArray);
			$status = "<div class='box'>Product is added to your cart!</div>";
		}

	}
}
?>
<html>
	<head>
	<title>Sklep Gier - PC</title>

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
		
			<meta charset="utf-8">
			<meta name="viewport" content="width=device-width, initial-scale=1.0">
			<meta name="description" content="">
			<meta name="author" content="">
			<title>Bootstrap E-Commerce Template- DIGI Shop mini</title>
			<!-- Bootstrap core CSS -->
			<link href="assets/css/bootstrap.css" rel="stylesheet">
			<!-- Fontawesome core CSS -->
			<link href="assets/css/font-awesome.min.css" rel="stylesheet" />
			<!--GOOGLE FONT -->
			<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
			<!--Slide Show Css -->
			<link href="assets/ItemSlider/css/main-style.css" rel="stylesheet" />
			<!-- custom CSS here -->
			<link href="assets/css/style.css" rel="stylesheet" />

	<link rel="stylesheet" href="css/style.css" />
	<link rel="stylesheet" type="text/css" href="css/slick.css"/>
	<link rel='stylesheet' href='css1/style.css' type='text/css' media='all' />
	</head>
	<body>
		<?php
			require '../header-template.php';
		?>
		<div style="width:1378px; margin:50;">
		<?php
		if(!empty($_SESSION["shopping_cart"])) {
		$cart_count = count(array_keys($_SESSION["shopping_cart"]));
		}
		?>
		
		
		<div class="container1">
			<div class="row">
				<div class="col-md-9">
					<div id="mi-slider" class="mi-slider">
						<ul>
							<?php
								$query = 'SELECT * FROM gra WHERE (id_platforma LIKE "2") AND (NOT dostepnosc="0")';
								$result = mysqli_query($con, $query);
								while($row = mysqli_fetch_assoc($result)){
										echo "<li>
												  <form method='post'>
													  <input type='hidden' name='id' value=".$row['id']." />
													  <p><img src='".$row['img']."' style='max-width:none; width:98%; max-height:none; height:48%; object-fit:cover''/></p>
													  <p>".$row['tytul']."</p>
													  <p class='price'>$".$row['cena']."</p>
													  <button type='submit' class='buy'>Buy Now</button>
												  </form>
											  </li>";
								}
							?>
						</ul>
						<nav>
							<a href="#">PC</a>
						</nav>
					</div>
				</div>
			</div>
		</div>
		
			<!--Core JavaScript file  -->
			<script src="assets/js/jquery-1.10.2.js"></script>
			<!--bootstrap JavaScript file  -->
			<script src="assets/js/bootstrap.js"></script>
			<!--Slider JavaScript file  -->
			<script src="assets/ItemSlider/js/modernizr.custom.63321.js"></script>
			<script src="assets/ItemSlider/js/jquery.catslider.js"></script>
			<script>
			    $(function () {

				$('#mi-slider').catslider();

				});
			</script>
			
		<footer class="footer"> 
			<div class="container">
				<center>
					<p>Tu może być - Reklama;)</p>
				</center>
			</div>
		</footer>
	</body>
</html>