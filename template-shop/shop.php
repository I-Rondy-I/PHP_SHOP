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
$image = $row['image'];

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
<title>Sklep Gier</title>
<link rel="stylesheet" href="css/style.css" />
<link rel="stylesheet" type="text/css" href="css/slick.css"/>
<link rel='stylesheet' href='css1/style.css' type='text/css' media='all' />
</head>
<body>

<div style="width:700px; margin:50 auto;">

<h2>Sklep Gier</h2>   

<?php
if(!empty($_SESSION["shopping_cart"])) {
$cart_count = count(array_keys($_SESSION["shopping_cart"]));
?>

<div class="carousel clearfix">
<h2>Simple and Responsive jQuery Carousel Slider</h2>

<div class="carousel-view clearfix">

<?php
}

$result = mysqli_query($con,"SELECT * FROM `gra`");
while($row = mysqli_fetch_assoc($result)){
		echo "<div class='box'>
				  <form method='post' action=''>
					  <input type='hidden' name='id' value=".$row['id']." />
					  <img src='".$row['image']."' style='width:100%' />
					  <p>".$row['tytul']."</p>
					  <p class='price'>$".$row['cena']."</p>
					  <button type='submit' class='buy'>Buy Now</button>
				  </form>
		   	  </div>";
        }
mysqli_close($con);
?>

</div> <!-- carosel-view End -->


<div style="clear:both;"></div>

<div class="message_box" style="margin:10px 0px;">
<?php echo $status; ?>
</div>

<br /><br />
</div>

<script src="js/jquery.min.js"></script>
<script src="js/slick.min.js"></script>
<script>
$('.carousel-view').slick({
  dots: false,
  infinite: false,
  speed: 500,
  slidesToShow: 3,
  slidesToScroll: 1,
  responsive: [
    {
      breakpoint: 600,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 2
      }
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    }
  ]
});
</script>	

</body>
</html>