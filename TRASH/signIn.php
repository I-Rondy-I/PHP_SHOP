<?php
  require "db.php";

$data = $_POST;
if ( isset($data['do_signIn']) )
{
	if ( ($data['Password'] == 'admin') && ($data['login'] == 'admin') )
	{header('Location: /PHP/template-admin/admin.php');}
	
	$errors = array();
	$user = R::findOne('users', 'login = ?', array($data['login']));
	if ( $user )
	{
		// Login is On
		if ( password_verify($data['Password'], $user->Password))
		{
			//Login is On - loged in progress..
			$_SESSION['logged_user'] = $user;
			echo '<div style = "color: green;">Autorization Is Done!!!<br/>
			<a href = "/PHP">Main</a> page;)</div><hr>';
		}
		else
		{
			$errors[] = 'Password not match';
		}
	}
	else
	{
		$errors[] = 'User not Found';
	}

	if ( ! empty($errors) )
	{
		//all bad - errors
		echo '<div style = "color: red;">' .array_shift($errors). '</div><hr>';
	}
}
?>

<form action="/PHP/signIn.php" method="POST">
	
	<p>
		<p><strong>Login</strong>:</p>
		<input type="text" name="login" value = "<?php echo @$data['login']; ?>">
	</p>

	<p>
		<p><strong>Password</strong>:</p>
		<input type="Password" name="Password">
	</p>	

	<p>
		<BUTTON type = "signUp" name = "do_signIn">Enter</BUTTON>
	</p>

</form>