<?php

	include "credentials.php";
	$conn = mysqli_connect($host, $username, $password, $dbname);
	if(!$conn)
	{
		die('Could not connect.');
	}

//Variable for directiory to hold images on server
$target_dir = "pictureUploads/";

//Name of the path to the image
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);

//Variable for the status of the upload result
$upload_status = "";
$upload_error =  "";
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        //echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        $upload_error = "File is not an image.";
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    $upload_error = "The file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 1000000) {
    $upload_error = "Your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    $upload_error = "Only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    $upload_status = "Your file was not uploaded.";
// if everything is ok, try to upload file
} else { //NEED TO ADD SQL -------------------------------------------------------------
	
	$image = $target_file;
	$image = $conn->real_escape_string($image);
	$text = $_POST["description"];
	$text = $conn->real_escape_string($text);
	
	$sql_insert = "INSERT INTO highlights (image_path, text) VALUES ('$image', '$text')";
	$conn->query($sql_insert);



//----------------------------------------------------------------------------------------------
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
		
        $upload_status = "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
    } else {
        $upload_status = "There was an error uploading your file.";
    }
}
?>

<!DOCTYPE html>
<html>
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
	
<!-- Container for header -->
<div class="container-fluid"> <!-- container-fluid is a full width container. it scales to the screen width -->
    <div class="row header"> <!-- each row can contain up to 12 columns. no matter what, all col must add up to 12 -->
      <div class="col-sm-1">
        <div class="dropdown">
          <button type="button" class="btn" data-toggle="dropdown">
            <img src='images/burger-menu.jpg' class='img-fluid'>
          </button>
          <div class="dropdown-menu">
            <a class="dropdown-item" href="#"><h3>Home</h3></a>
	    <div class="dropdown-divider"></div>
		
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#"><h3>Admin Page</h3></a>
          </div>
        </div>
    </div> <!-- img-fluid will scaled images to the size of their parent -->
      <div class="col-sm-3"><h1 class="img-fluid">Alumni</h1></div>
      <div class="col-sm-4"></div>
	
      </div>
</div>

<div class="jumbotron main"> <!-- jumbotron acts like a big screen, and anything inside of it is fit to its dimensions -->
  <div class="container-fluid"> <!-- normally this would watch screen-width, but since it's in a jumbotron, it only matches jumbotron width -->
    <div class="row">
      <div class="col-sm-1"><h1>Submit Highlight</h1></div>
    </div>
  </div>


	<?php
	
	echo $upload_status;
	echo "<br>";
	echo $upload_error;
	
	?>
	

</div>


</body>
</html>