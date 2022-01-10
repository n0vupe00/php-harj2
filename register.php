<?php

session_start();

if( isset($_SESSION['user_id']) ){
	header("Location: /");
}

require 'database.php';

$message = '';

if(!empty($_POST['email']) && !empty($_POST['password'])):
	
	// Uuden käyttäjän luominen databaseen 
	$sql = "INSERT INTO users (email, password) VALUES (:email, :password)";
	$stmt = $conn->prepare($sql);

	$stmt->bindParam(':email', $_POST['email']);
	$stmt->bindParam(':password', password_hash($_POST['password'], PASSWORD_BCRYPT));

	if( $stmt->execute() ):
		$message = 'New user created';
	else:
		$message = 'Did not work!!';
	endif;

endif;

?>

<!DOCTYPE html>
<html>
<head>
	<title>Rekisteröidy tästä</title>
	<link rel="stylesheet" type="text/css" href="tyylit/style.css">
	<link href='http://fonts.googleapis.com/css?family=Comfortaa' rel='stylesheet' type='text/css'>
</head>
<body>

	<div class="header">
		<a href="/">Login App</a>
	</div>

	<?php if(!empty($message)): ?>
		<p><?= $message ?></p>
	<?php endif; ?>

	<h1>Rekisteröidy</h1>
	<span>tai <a href="login.php">Kirjaudu sisään</a></span>

	<form action="register.php" method="POST">
		
		<input type="text" placeholder="Syötä sposti" name="email">
		<input type="password" placeholder="ja salasana" name="password">
		<input type="password" placeholder="vahvista salasana" name="confirm_password">
		<input type="submit">

	</form>

</body>
</html>