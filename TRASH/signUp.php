<?php
  require "db.php";

$data = $_POST;
if ( isset($data['do_signUp']) )
{
	//Registration in here
    $errors = array();
    
	if ( trim($data['login']) == '' )
	{
		$errors[] = 'Input Login';
	}
	if ( trim($data['E-mail']) == '' )
	{
		$errors[] = 'Input E-mail';
	}
	if ( $data['Password'] == '' )
	{
		$errors[] = 'Input Password';
	}

	if ( $data['Password_2'] != $data['Password'] )
	{
		$errors[] = 'Passwords are not Identify!!';
	}
	if ( R::count('users', "login = ?", array($data['login'])) > 0)
	{
		$errors[] = 'User with this Login - Already exists';
	}
	if ( R::count('users', "E-mail = ?", array($data['E-mail'])) > 0)
	{
		$errors[] = 'User with this E-mail - Already exists';
	}

	if ( empty($errors) )
	{
		//all good - registration in progress..

		$user = R::dispense('users');
		$user->login = $data['login'];
		$user->Email = $data['E-mail'];
		$user->Password = password_hash($data['Password'], PASSWORD_DEFAULT);
		R::store($user);
		echo '<div style = "color: green;">Registration Is Done!!!
		<br/><a href = "/PHP/signIn.php">Sign in</a></div><hr>';
	}
	else
	{
		echo '<div style = "color: red;">' .array_shift($errors). '</div><hr>';
	}
}

?>

<form action="/PHP/signUp.php" method="POST">
	
	<p>
		<p><strong>Your login</strong>:</p>
		<input type="text" name="login" value = "<?php echo @$data['login']; ?>">
	</p>

	<p>
		<p><strong>Your E-mail</strong>:</p>
		<input type="E-mail" name="E-mail" value = "<?php echo @$data['E-mail']; ?>">
	</p>

	<p>
		<p><strong>Your Password</strong>:</p>
		<input type="Password" name="Password">
	</p>

	<p>
		<p><strong>Repeat Your Password</strong>:</p>
		<input type="Password" name="Password_2">
	</p>	

	<p>
		<BUTTON type = "signUp" name = "do_signUp">Submit</BUTTON>
	</p>

</form>