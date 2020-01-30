<?php

require "libraries/rb.php";

R::setup( 'mysql:host=localhost;dbname=sklep_gier',
          'root', '' ); //for both mysql or mariaDB


#$con=mysqli_connect("localhost","root","","sklep_gier") or die(mysqli_error($con));


session_start();
