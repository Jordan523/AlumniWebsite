
<?php
	session_start();

	
	include "credentials.php";

	$conn = mysqli_connect($host, $username, $password, $dbname);
	if(!$conn)
	{
		die('Could not connect.');
	}
		
?>



<!DOCTYPE html>



<html lang="en">
<head>
  <meta charset="utf-8">
  <!-- Bootstrap 4; Sets initial zoom level and sets the width to the screen width of the viewing device -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <!-- jQuery library -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <!-- Popper JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <!-- Latest compiled JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <!-- Imports Google Font Open-Sans -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">
  <!-- General Stylesheet Link -->
  <link rel="stylesheet" type="text/css" href="BootstrapTemplate.css">
</head>

<body>

<!-- Container for header -->
<div class="container-fluid"> <!-- container-fluid is a full width container. it scales to the screen width -->
    <div class="row header"> <!-- each row can contain up to 12 columns. no matter what, all col must add up to 12 -->
      <div class="col-sm-1">
        <div class="dropdown">
          <button type="button" class="btn" data-toggle="dropdown">
            <img src='burger-menu.jpg' class='img-fluid'>
          </button>
          <div class="dropdown-menu">
            <a class="dropdown-item" href="#"><h3>Home</h3></a>
	    <div class="dropdown-divider"></div>
		<?php
			if(isset($_SESSION["userID"]))
			{
				echo "<a class='dropdown-item' href='loggout.php'><h3>Loggout</h3></a>";
			}
			else
				echo "<a class='dropdown-item' href='login.php'><h3>Login</h3></a>";
		?>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#"><h3>Admin Page</h3></a>
          </div>
        </div>
    </div> <!-- img-fluid will scaled images to the size of their parent -->
      <div class="col-sm-3"><h1 class="img-fluid">Alumni</h1></div>
      <div class="col-sm-4"></div>
	<?php
		if(isset($_SESSION["userID"]))
		{
			echo "<div class='col-sm-4'><h3>Hello " . $_SESSION["firstname"] . "</h3></div>";
		}
	?>
      </div>
</div>

<!-- Navbar-->


<!-- Test for topnav bar -->
	<div class="topnav">
		<a href ="#home"><img src="images/home.png" width="15" height="15"><br>Home</a>
		<a href ="#T3"><img src="images/wrench.png" width="15" height="15"><br>Tools, Tips and Tricks</a>
		<a href ="#intern"><img src="images/briefcase.png" width="15" height="15"><br>Internships</a>
		<a href ="#CTF"><img src="images/flag.png" width="15" height="15"><br>Capture the Flag</a>
		<a href ="#Research"><img src="images/books.png" width="15" height="15"><br>Research</a>

		<div class="dropdown-menu">
			<a class="dropdown-item" href="#"><h3>Home</h3></a>
		</div>
	
	</div>




<div class="jumbotron main"> <!-- jumbotron acts like a big screen, and anything inside of it is fit to its dimensions -->
  <div class="container-fluid"> <!-- normally this would watch screen-width, but since it's in a jumbotron, it only matches jumbotron width -->
    <div class="row">
      <div class="col-sm-1"><h1>Home</h1></div>
    </div>
  </div>

<?php
	$result = $conn->query("SELECT * from highlights limit 2");
?>

<table style = "width:100%">
<tr>
	<th>Highlight</th>
	<th></th>
</tr>
<tr>
	<td>Title</td>
	<td><?php
		$row = $result->fetch_assoc();
		echo $row["text"];	
	?></td>
</tr>
</table>



</div>




</body>

</html>
