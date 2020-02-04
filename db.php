<?php

require "libraries/rb.php";

R::setup( 'mysql:host=localhost;dbname=sklep_gier',
          'root', '' ); //for both mysql or mariaDB

session_start();
