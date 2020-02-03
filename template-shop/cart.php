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
				<meta charset="utf-8">
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

				<link rel="stylesheet" href="cart/style.css" media="screen" title="no title" charset="utf-8">
				<script src="https://code.jquery.com/jquery-2.2.4.js" charset="utf-8"></script>
				<meta name="robots" content="noindex,follow" />
		
		<link rel='stylesheet' href='css1/style.css' type='text/css' media='all' />
	</head>
	<body>
		<?php
        require '../header-template.php';
		?>	
		<h2 style="margin-top:8; text-align: center;"><strong style="text-align: center; background-color:yellow; font-size: 30;">Koszyk</strong></h2>  
		<div style="width:700px; margin:50 auto;">
			<div class="cart">
				<?php
				if(isset($_SESSION["shopping_cart"])){
					$total_price = 0;
				?>	
				<table class="table">
					<tbody>
						<tr bgcolor="purple">
							<td bgcolor="orange"></td>
							<td bgcolor="orange"></td>
							<td bgcolor="orange">Tytul</td>
							<td bgcolor="orange">Ilosc</td>
							<td bgcolor="orange">Cena</td>
							<td bgcolor="orange">Razem</td>
						</tr>	
						<?php		
						foreach ($_SESSION["shopping_cart"] as $product){
						?>
						<div class="shopping_cart">
							<tr bgcolor="white">
								<td style="text-align: center;"><div class="buttons"><span class="like-btn"></span></div></td>
							
								<td><img src='<?php echo $product["image"]; ?>' width="80" height="110" /></td>
								<td style="vertical-align: middle;"><?php echo $product["tytul"]; ?><br />
									<form method='post' action=''>
										<input type='hidden' name='id' value="<?php echo $product["id"]; ?>" />
										<input type='hidden' name='action' value="remove" />
										<button type='submit' class='remove'>Usun</button>
									</form>
								</td>
								<td style="vertical-align: middle;">
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
								<td style="vertical-align: middle;"><?php echo "$".$product["cena"]; ?></td>
								<td style="vertical-align: middle;"><?php echo "$".$product["cena"]*$product["quantity"]; ?></td>
							</tr>
						</div>
						<?php
						$total_price += ($product["cena"]*$product["quantity"]);
						}
						?>
						<tr>
							<td colspan="5" align="right" style="text-align:50px;">
								<strong style="background-color:yellow; font-size: 30">Do oplaty: <?php echo "$".$total_price; ?></strong>
							</td>
						</tr>
					</tbody>
				</table>		
				  <?php
				}else{
					echo '<h3 style = "color:red; margin-top:200; text-align:center; font-weight:666; text-size:150; font-size:60; background-color:yellow;">Your cart is empty!</h3>';
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
		<script type="text/javascript">
		  $('.minus-btn').on('click', function(e) {
				e.preventDefault();
				var $this = $(this);
				var $input = $this.closest('div').find('input');
				var value = parseInt($input.val());

				if (value > 1) {
					value = value - 1;
				} else {
					value = 0;
				}

			$input.val(value);

			});

			$('.plus-btn').on('click', function(e) {
				e.preventDefault();
				var $this = $(this);
				var $input = $this.closest('div').find('input');
				var value = parseInt($input.val());

				if (value < 100) {
				value = value + 1;
				} else {
					value =100;
				}

				$input.val(value);
			});

		  $('.like-btn').on('click', function() {
			$(this).toggleClass('is-active');
		  });
		</script>
	</body>
</html>