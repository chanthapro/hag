
<?php
  include_once('config.php');
?>
<?php
session_start();

if(isset($_POST['btnlogin'])){
  $uname = $_POST['txtuname'];
  $pwd = $_POST['txtpwd'];
  $query = mysqli_query($conn,"select * from tbl_user where user_name='".mysqli_real_escape_string($conn,$uname)."' and user_pwd='".mysqli_real_escape_string($conn,md5($pwd))."'");
  if(mysqli_num_rows($query)==0){
    echo"<script>
    alert('Sorry invalid Password or Username');
    </script>";
  }else{
    $query = mysqli_query($conn,"select * from tbl_user where user_name='".mysqli_real_escape_string($conn,$uname)."' and user_pwd='".mysqli_real_escape_string($conn,md5($pwd))."'");
    while($row=mysqli_fetch_array($query,MYSQLI_ASSOC)){
      $_SESSION["id_user"] = $row["id_user"];
      $_SESSION["txtpwd"] =$_row['user_pwd'];
    }
    $_SESSION["txtuname"] =$_POST['txtuname'];
    
    header("location:admin.php");
  }
}





// if(isset($_POST['btnlogin'])){
// $uname = $_POST['txtuname'];
// $pwd = $_POST['txtpwd'];
// $query = mysqli_query($conn,"select * from tbl_user
// where user_name='".$uname."' and user_pwd='".md5($pwd)."'");
// if(mysqli_num_rows($query)==0){
// echo"<script>
// alert('Sorry invalid Password or Username');
// </script>";
// }else{
// header("location:index.php");
// }}
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
<body class="">

<div class="container-fluid">


<!-- Default form subscription -->
<form class="text-center border border-light p-5" method="post" action="<?php echo
$_SERVER['PHP_SELF'];?>" >
<a class="navbar-brand" href="#"> <img src="img/logo.png"  class="animated bounce infinite,bounceInDown,img-fluid 
${3|rounded-top,rounded-right,rounded-bottom,rounded-left,rounded-circle,|}" alt=""></a>
    <!-- <p class="h4 mb-4">Input UserName Password</p> -->

    <p>Please Input Username Password</p>

    <p>
        <!-- <a href="" target="_blank">See the last newsletter</a> -->
    </p>

    <!-- Name -->
    <input type="text" id="user_name"  name="txtuname"  class="form-control mb-4" placeholder="Username">

    <!-- Email -->
    <input type="password" id="user_pwd" class="form-control mb-4" placeholder="Password" name="txtpwd" required>

    <!-- Sign in button -->
    <button class="btn btn-info btn-block" name="btnlogin" type="submit">Log In</button>


</form>
<!-- Default form subscription -->


</div>








  <!-- jQuery -->
  <script type="text/javascript" src="js/jquery.min.js"></script>
  <!-- Bootstrap tooltips -->
  <script type="text/javascript" src="js/popper.min.js"></script>
  <!-- Bootstrap core JavaScript -->
  <script type="text/javascript" src="js/bootstrap.min.js"></script>
  <!-- MDB core JavaScript -->
  <script type="text/javascript" src="js/mdb.min.js"></script>
  <!-- Your custom scripts (optional) -->
  <script type="text/javascript" src="js/js.js"></script>

</body>
</html>
