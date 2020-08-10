
<?php
include_once("config.php");
?>
<?php
session_start();

if(isset($_POST['btnlogin'])){
$uname = $_POST['txtuname'];
$pwd = $_POST['txtpwd'];
$query = mysqli_query($conn,"select * from tbl_user
where user_name='".$uname."' and user_pwd='".md5($pwd)."'");
if(mysqli_num_rows($query)==0){
echo"<script>
alert('Sorry invalid Password or Username');
</script>";
}else{
header("location:index.php");
}}
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

<!-- <div class="container-fluid"> -->


<!-- </div> -->
</body>
</html>
