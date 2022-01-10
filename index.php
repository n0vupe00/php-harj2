<?php

session_start();

require 'database.php';

if( isset($_SESSION['user_id']) ){

	$records = $conn->prepare('SELECT id,email,password FROM users WHERE id = :id');
	$records->bindParam(':id', $_SESSION['user_id']);
	$records->execute();
	$results = $records->fetch(PDO::FETCH_ASSOC);

	$user = NULL;

	if( count($results) > 0){
		$user = $results;
	}

}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Tervetuloa</title>
	<link rel="stylesheet" type="text/css" href="tyylit/style.css">
	<link href='http://fonts.googleapis.com/css?family=Comfortaa' rel='stylesheet' type='text/css'>
</head>
<body>

	<div class="header">
		<a href="/">Login App</a>
	</div>

	<?php if( !empty($user) ): ?>

		<br />Tervetuloa <?= $user['email']; ?> 
		<br /><br />Success!
		<br /><br />
		<a href="logout.php">Kirjaudu ulos?</a>

	<?php else: ?>

		<h1>Kirjaudu sisään tai rekisteröidy</h1>
		<a href="login.php">Kirjaudu sisään</a> or
		<a href="register.php">Rekisteröidy</a>

	<?php endif; ?>

</body>
</html>