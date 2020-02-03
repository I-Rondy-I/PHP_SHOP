<?php
session_start();
$status="";
if (isset($_POST['action']) && $_POST['action']=="remove"){
if(!empty($_SESSION["shopping_cart"])) {
	foreach($_SESSION["shopping_cart"] as $key => $value) {
		if($_POST["id"] == $key){
		unset($_SESSION["shopping_cart"][$key]);
		$status = "<div class='box' style='color:red;'>
		Product is removed from your cart!</div>";
		}
		if(empty($_SESSION["shopping_cart"]))
		unset($_SESSION["shopping_cart"]);
			}		
		}
}

if (isset($_POST['action']) && $_POST['action']=="change"){
  foreach($_SESSION["shopping_cart"] as &$value){
    if($value['id'] === $_POST["id"]){
        $value['quantity'] = $_POST["quantity"];
        break; // Stop the loop after we've found the product
    }
}
  	
}
?>
<html>
	<head>
		<title>Koszyk</title>
		
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
		
		<link rel='stylesheet' href='css1/style.css' type='text/css' media='all' />
	</head>
	<body>
		<?php
        require '../header-template.php';
		?>
		<div style="width:700px; margin:50 auto;">
			<h2>Koszyk</h2>   
			<?php
			if(!empty($_SESSION["shopping_cart"])) {
			$cart_count = count(array_keys($_SESSION["shopping_cart"]));
			?>
			<div class="cart_div">
				<a href="cart.php">
					<img src="cart-icon.png" /> Cart
					<span><?php echo $cart_count; ?></span>
				</a>
			</div>
			<?php
			}
			?>

			<div class="cart">
				<?php
				if(isset($_SESSION["shopping_cart"])){
					$total_price = 0;
				?>	
				<table class="table">
					<tbody>
						<tr>
							<td></td>
							<td>Tytul</td>
							<td>Ilosc</td>
							<td>Cena</td>
							<td>Produkt Razem</td>
						</tr>	
						<?php		
						foreach ($_SESSION["shopping_cart"] as $product){
						?>
						<tr>
							<td><img src='<?php echo $product["image"]; ?>' width="50" height="40" /></td>
							<td><?php echo $product["tytul"]; ?><br />
								<form method='post' action=''>
									<input type='hidden' name='id' value="<?php echo $product["id"]; ?>" />
									<input type='hidden' name='action' value="remove" />
									<button type='submit' class='remove'>Usun</button>
								</form>
							</td>
							<td>
								<form method='post' action=''>
									<input type='hidden' name='id' value="<?php echo $product["id"]; ?>" />
									<input type='hidden' name='action' value="change" />
									<select name='quantity' class='quantity' onchange="this.form.submit()">
										<option <?php if($product["quantity"]==1) echo "selected";?> value="1">1</option>
										<option <?php if($product["quantity"]==2) echo "selected";?> value="2">2</option>
										<option <?php if($product["quantity"]==3) echo "selected";?> value="3">3</option>
										<option <?php if($product["quantity"]==4) echo "selected";?> value="4">4</option>
										<option <?php if($product["quantity"]==5) echo "selected";?> value="5">5</option>
									</select>
								</form>
							</td>
							<td><?php echo "$".$product["cena"]; ?></td>
							<td><?php echo "$".$product["cena"]*$product["quantity"]; ?></td>
						</tr>
						<?php
						$total_price += ($product["cena"]*$product["quantity"]);
						}
						?>
						<tr>
							<td colspan="5" align="right">
								<strong>Razem: <?php echo "$".$total_price; ?></strong>
							</td>
						</tr>
					</tbody>
				</table>		
				  <?php
				}else{
					echo "<h3>Your cart is empty!</h3>";
					}
				?>
			</div>
			<div style="clear:both;"></div>
			<div class="message_box" style="margin:10px 0px;">
				<?php echo $status; ?>
			</div>
			<br /><br />
		</div>
		<footer class="footer"> 
               <div class="container">
               <center>
                   <p>Tu może być - Reklama;)</p>
               </center>
               </div>
        </footer>
	</body>
</html>