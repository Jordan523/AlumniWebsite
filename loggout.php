<?php
	session_start();
	session_destroy();
	session_start();

	if(!isset($_SESSION["userID"]))
	{
		echo "Logout Successful";
		header("refresh:2;url=index.php");
	}
	else
	{
		echo "Loggout Failed";
		die();
	}

?>
