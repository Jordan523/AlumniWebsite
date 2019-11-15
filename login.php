<?php

	session_start();	

	include "credentials.php"



?>

<html>
<head>
<meta name="viewport" contect="width=device-width, initial-scale=1">
</head>

<body>
	<h2>Login Page</h2>
	<form action="login_check.php" method="post">
	Email <input type="text" name="email" action="login_check.php">
	<br>
	Password <input type="password" name="pass">
	<br>
	<input type="submit" name="submit">
	</form>
	<form action="index.php">
		<input type="submit" value="Home">
	</form>

</body>
</html>


