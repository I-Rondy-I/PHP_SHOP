<?php 
	require 'db.php';
	
	$data = $_POST;
	$user = R::findOne('users', 'login = ?', array($_SESSION['logged_user']->login));

    if( password_verify($data['oldPassword'], $user->password) ){
		$user->password = password_hash($data['newPassword'], PASSWORD_DEFAULT);
		R::store($user);
		
		echo "Your password has been updated.";
        ?>
        <meta http-equiv="refresh" content="3;url=template-shop/shop.php" />
        <?php
    }else{
        ?>
        <script>
            window.alert("Wrong password!!");
        </script>
        <meta http-equiv="refresh" content="1;url=settings.php" />
        <?php

    }
?>