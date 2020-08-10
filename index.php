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
<style>
  .product{
    text-align: center;
    cursor: pointer;
    color: gray;
    font-family: Pesta Stencil Demo;
    padding: 0px;
    margin: 0px;
      }
  .title-product{
   color: gray;
  }
  .product:hover{
    opacity: 0.8;
  color: black;
  }

  body{
    overflow-x: hidden;
    padding: 0px;
    margin: 0px;
  }
  .container-fluid{
    padding: 0px;
    margin: 0px;
  }
  .position-absolute{
    /* z-index: -1; */
    top: 0;
    left: 0;
    right: 0;
    z-index: 10;
  }
  
</style>

<body class=""><?php
include("menu.php") ;
?>
	<div class="container-fluid">

<?php 

  include("slide.php");
	include("p_home.php");
?>







<!-- start-map -->
<br><br><br><br>
<?php
	
	include("map.php");
	?>

</div>

</div>
<!-- End-Map-->
<?php 
	
	include("footer.php");	
	
	?>







  <!-- jQuery -->
  <script type="text/javascript" src="js/jquery.min.js"></script>
  <!-- Bootstrap tooltips -->
  <script type="text/javascript" src="js/popper.min.js"></script>
  <!-- Bootstrap core JavaScript -->
  <script type="text/javascript" src="js/bootstrap.min.js"></script>
  <!-- MDB core JavaScript -->
  <script type="text/javascript" src="js/mdb.min.js"></script>
  <!-- Your custom scripts (optional) -->
  <script type="text/javascript"></script>

</body>
</html>
