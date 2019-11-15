<?php

	session_start();


	if(isset($_POST['submit']))
	{
		$email = $_POST["email"];
		$pass = $_POST["pass"];

		include "credentials.php";

		$conn = mysqli_connect($host, $username, $password, $dbname);


		$result = $conn->query("SELECT * FROM alumni WHERE email = '" . $email . "'");


		$row = $result->fetch_assoc();

		if($row["email"] == $email and $row["password"] == $pass)
		{
			echo "Welcome " . $row["firstname"];

			$_SESSION["userID"] = $row["userID"];
			$_SESSION["firstname"] = $row["firstname"];

			header("refresh:3;url=index.php");
		}
		else
		{
			echo "Login failed<br>";
			if($row["email"] != $email)
				echo "Email not found.";
			else if($row["password"] != $pass)
				echo "Incorrect Password";

			header("refresh:2;url=login.php");
		}
	}
	
?>
