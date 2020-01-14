<?php
  require "db.php";


$data = $_POST;
$Producers = R::findAll( 'Producent' );
$Gatunek = R::findAll( 'Gatunek' );
$Platforma = R::findAll( 'Platforma' );
foreach ($Producers as $producer) {
	echo 'console.log('.$producer.')';
}


if ( isset($data['do_add']) )
{}
?>
<form action="/PHP/admin.php" method="POST">
	
	<p>
		<p><strong>Title</strong>:</p>
		<input type="text" name="Title">
	</p>
	<p>
		<p><strong>Count</strong>:</p>
		<input type="number" name="Count" min="1" max="100">
	</p>	
    <p>
		<p><strong>Producent</strong>:</p>
		<select name="Producent">		
			<?php foreach ( $Producers as $producer) : ?>
				<option value="<?php echo $producer->id ?>">
					<?php echo $producer->opis_producent; ?>
				</option>
		    <?php endforeach; ?>
		</select> 
	</p>
    <p>
		<p><strong>Gatunek</strong>:</p>
		<select name="Gatunek">		
			<?php foreach ( $Gatunek as $gatunek) : ?>
				<option value="<?php echo $gatunek->id ?>">
					<?php echo $gatunek->opis_gatunek; ?>
				</option>
		    <?php endforeach; ?>
		</select> 
	</p>	
    <p>
		<p><strong>Platforma</strong>:</p>
		<select name="Platforma">		
			<?php foreach ( $Platforma as $platdorma) : ?>
				<option value="<?php echo $platforma->id ?>">
					<?php echo $platdorma->opis_platforma; ?>
				</option>
		    <?php endforeach; ?>
		</select> 
	</p>		
	<p>
		<p><strong>Cena</strong>:</p>
		<input type="number" name="Cena" min="0">
	</p>	

	<p>
		<BUTTON type = "signUp" name = "do_add">Enter</BUTTON>
	</p>

</form>