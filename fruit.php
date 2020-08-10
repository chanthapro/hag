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

//   include("slide.php");
// 	include("p_home.php");
?>







<!-- start-map -->
<br><br><br><br>
		
			 

<div class="card-deck   d-flex justify-content-center "><h1><a href="#" class="text-info"> Fruit </a><h1>
<div class="row">
<?php 
      include("config.php");
	 $query = mysqli_query($conn,"select * from tbl_fruit order by f_id  ");

						while($row = mysqli_fetch_assoc($query)){
	  ?>
<div class="col-md-3    d-flex justify-content-center p-5">
  <a class="btn-outline-light text-center p-0" href="vfruit.php?id=<?php echo $row['f_id']  ?>" name="btngo" style="width: 80% ; cursor:pointer">
    <img class="card-img-top " src="admin/upload/<?php echo $row['f_img']  ?>" style="width: 100%" alt="Card image cap">
    <div class="card-body">
      <h5 class="card-title text-dark "><?php echo $row['f_name']  ?></h5>
      <p class="card-text"><?php echo $row['f_name']  ?></p>
<!--      <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>-->
    </div></a>
  </div>



                        <?php } ?>
</div></div>
<br>
		
		
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
