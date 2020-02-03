<?php
  require "db.php";

unset($_SESSION['logged_user']);
unset($_SESSION['shopping_cart']);

header('Location: ../PHP_SHOP');

?>

