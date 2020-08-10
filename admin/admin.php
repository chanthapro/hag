<?php
include("config.php");

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Material Design for Bootstrap</title>
  <!-- MDB icon -->
  <link rel="icon" href="img/mdb-favicon.ico" type="image/x-icon">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
  <!-- Google Fonts Roboto -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
  <!-- Bootstrap core CSS -->
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <!-- Material Design Bootstrap -->
  <link rel="stylesheet" href="css/mdb.min.css">
  <!-- Your custom styles (optional) -->
  <link rel="stylesheet" href="css/style.css">
</head>
<body class="">


<div class="container-fluid">
	<div class="row">
		
		<div class="col-sm-12 col-md-12 col-lg-12 m-0 p-0 cover1">
		<?php include_once("eadmin.php"); ?>
		</div>
		
	</div>
	

	<div class="row">
	<div class="col-sm-2 col-md-2 col-lg-2 mt-1">
			<?php include_once("menu_left.php"); ?>
		</div>
		<div class="col-sm-10 col-md-10 col-lg-10">
		<?php include_once("content.php"); ?>
		</div>
		
	</div>
</div>

</div>
</body>
</html>
