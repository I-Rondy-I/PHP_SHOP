<?php
  require "db.php";
?>

<?php if ( isset($_SESSION['logged_user']) ) : ?>
	Autorizated:)
	<br>
	Hello, <?php echo $_SESSION['logged_user'] -> login; ?>!
<?php else : ?>
	Not Autorizated:(
<?php endif; ?>


<!DOCTYPE html>
<html>
    <head>
        <link rel="shortcut icon" href="img/icon.jpg" />
        <title>Sklep Gier</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- latest compiled and minified CSS -->
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" type="text/css">
        <!-- jquery library -->
        <script type="text/javascript" src="bootstrap/js/jquery-3.2.1.min.js"></script>
        <!-- Latest compiled and minified javascript -->
        <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
        <!-- External CSS -->
        <link rel="stylesheet" href="css/style.css" type="text/css">
    </head>
    <body>
        <div>
           <?php
            require 'header.php';
           ?>
           <div id="bannerImage">
               <div class="container">
                   <center>
                   <div id="bannerContent">
                       <h1>Sklep Gier</h1>
                       <a href="template-shop/shop.php" class="btn btn-danger">Do zakupów</a>
                   </div>
                   </center>
               </div>
           </div>
           <div class="container">
               <div class="row">
                   <div class="col-xs-4">
                       <div  class="thumbnail">
                           <a href="template-shop/shop.php">
                                <img src="img/pc.jpg" alt="Camera">
                           </a>
                           <center>
                                <div class="caption">
                                        <p id="autoResize">PC</p>
                                        <p>Personal Computer</p>
                                </div>
                           </center>
                       </div>
                   </div>
                   <div class="col-xs-4">
                       <div class="thumbnail">
                           <a href="template-shop/shop.php">
                               <img src="img/ps4.jpg" alt="Watch">
                           </a>
                           <center>
                                <div class="caption">
                                    <p id="autoResize">PS4</p>
                                    <p>Playstation 4</p>
                                </div>
                           </center>
                       </div>
                   </div>
                   <div class="col-xs-4">
                       <div class="thumbnail">
                           <a href="template-shop/shop.php">
                               <img src="img/xone.jpg" alt="Shirt">
                           </a>
                           <center>
                               <div class="caption">
                                   <p id="autoResize">XOne</p>
                                   <p>Xbox One</p>
                               </div>
                           </center>
                       </div>
                   </div>
               </div>
           </div>
            <br><br> <br><br><br><br>
           <footer class="footer"> 
               <div class="container">
               <center>
                   <p>Tu może być - Reklama;)</p>
               </center>
               </div>
           </footer>
        </div>
    </body>
</html>