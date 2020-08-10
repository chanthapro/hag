<?php
include("config.php");
// Insert
if(isset($_POST['btnsave'])){
    $txtname = $_POST['txtname'];
    $txtphone = $_POST['txtphone'];
    $txtemail = $_POST['txtemail'];
    $txtaddress = $_POST['txtaddress'];
	
	  
 $sql = "insert into tbl_contact (c_name,c_phone,c_email,c_address)values('".$txtname."','".$txtphone."','".$txtemail."','".$txtaddress."')";
	
	  $query = mysqli_query($conn,$sql);
	 if($query){
		header("location:contact.php");
	 }else{
		 echo $sql;
	 }
	  

}

// Delete
if(isset($_GET['delete'])){
	
	$id = $_GET['id'] ?? null;
	
	// $photo = mysqli_query($conn,"select * from tbl_contact where c_id=".$id);
	// $prow = mysqli_fetch_assoc($photo);
	// unlink("upload/".$prow['p_img']);
	$query = mysqli_query($conn,"delete from tbl_contact where c_id=".$id);
	if($query){
		header("location:contact.php");
	}
}

// Edit

if(isset($_GET['edit_id'])){
	$id = $_GET['id'] ?? null;
	$query = mysqli_query($conn,"select * from tbl_contact where c_id=".$id);
	while($row = mysqli_fetch_assoc($query)){
	$id = $row['c_id'];
    $rowname = $row['c_name'];
    $rowphone = $row['c_phone'];
    $rowemail = $row['c_email'];
    $rowaddress = $row['c_address'];
	// echo "$id $rowtitle $rowimg";
	}
}else{
    $id = "";
    $rowname = "";
    $rowphone = "";
    $rowemail = "";
    $rowaddress = "";
}



// Update\


if(isset($_POST['btnedit'])){
	$id = $_POST['txtid'];
    $txtname = $_POST['txtname'];
    $txtphone = $_POST['txtphone'];
    $txtemail = $_POST['txtemail'];
    $txtaddress = $_POST['txtaddress'];

    // echo "$id $txtname $img1";
  
if(isset($_FILES['pic1'])){
	if($_FILES['pic1']['name'] !="" ){
		list($name,$ext) = explode(".",$_FILES['pic1']['name']);
		$img1 = md5(uniqid()).".".$ext;
		unlink("upload/".$_POST['txtimg']);
		move_uploaded_file($_FILES['pic1']['tmp_name'],"upload/".$img1);
	}
}else{
	$img1 = $_POST['txtimg'];
}
$sql = "update tbl_contact set c_name='".$txtname."', c_phone='".$txtphone."',c_email='".$txtemail."',c_address='".$txtaddress."' where c_id=".$id;
// $sql = "update tbl_product set s_title='".$txtname."',img='".$img1."' where s_id='".$id."'";
$query = mysqli_query($conn,$sql);
if($query){
	header("location:contact.php");
}else{
	echo $sql;
}
}

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

        <br>

        <!-- general form elements -->
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title"> Add Contact </h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form role="form" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
            <div class="card-body">
              <input type="hidden" class="form-control" id="txtid" name="txtid" value="<?php 
                echo $id; 
                 ?>">
              <!-- <input type="hidden" class="form-control" id="txtimg" name="txtimg" value="<?php echo $rowimg;  ?>"> -->

              <div class="form-group">
                <label for="exampleInputEmail1">Contact Name</label>

                <input type="text" required name="txtname" class="form-control" id="txtname"
                  placeholder="Product Name" value="<?php echo$rowname; ?>">
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Phone </label>

                <input type="text" name="txtphone" class="form-control" id="txtphone" placeholder="Phone Number"
                  value="<?php echo $rowphone; ?>">
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Email </label>

                <input type="text" name="txtemail" class="form-control" id="txtemail" placeholder="Email"
                  value="<?php echo $rowemail; ?>">
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Address  </label>

                <input type="text" name="txtaddress" class="form-control" id="txtaddress" placeholder="Address"
                  value="<?php echo $rowaddress; ?>">
              </div>

              
            </div>
            <!-- /.card-body -->


            <div class="card-footer">
              <?php  
				if(!isset($_GET['edit_id'])){
						echo '
						<button type="submit" class="btn btn btn-primary " name="btnsave">Insert</button>
						';
				}else{
					echo '
				<button name="btnedit" class="btn btn-success " type="submit">Update</button>
						';
						
				}
                ?>
              <button type="reset" class="btn btn-danger" onclick="window.location='contact.php'">Cancel</button>
              <!-- <button type="submit" class="btn btn-primary">Submit</button>
                  <button type="submit" class="btn btn-danger">Cancel</button> -->
            </div>
          </form>
        </div>
        </div>
        </div>
        <!-- /.card -->


        <br>

        <!-- Main content -->

        <div class="row">
          <div class="col-md-12">
               <div class=" table-responsive-sm">
                <table class="table table-bordered  table-striped ">
                  <thead>
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Name</th>
                      <th>Phone</th>
                      <th>Emial</th>
                      <th>Address</th>
                      <th style="width: 40px">Action</th>
                      <th style="width: 40px">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
						$query = mysqli_query($conn,"select * from tbl_contact order by c_id ");
						while($row = mysqli_fetch_assoc($query)){
						?>
                    <tr>
                      <td><?php echo $row['c_id'] ?></td>
                      <td><?php echo $row['c_name'] ?></td>
                      <td><?php echo $row['c_phone'] ?></td>
                      <td><?php echo $row['c_email'] ?></td>
                      <td><?php echo $row['c_address'] ?></td>
                      <td><a href="?delete&id=<?php  echo $row['c_id']; ?>"
                          onclick="return confirm('Do u want to Delete')">
                          <span class="badge bg-danger">Delete </span></a></td>
                      <!-- ............ -->
                      <td><a href="?edit_id&id=<?php  echo $row['c_id']; ?>">
                          <span class="badge bg-danger">Edit </span></a></td>
                    </tr>
                    <?php
						}
					?>

                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
              <div class="card-footer clearfix">
                <ul class="pagination pagination-sm m-0 float-right">
                  <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
                  <li class="page-item"><a class="page-link" href="#">1</a></li>
                  <li class="page-item"><a class="page-link" href="#">2</a></li>
                  <li class="page-item"><a class="page-link" href="#">3</a></li>
                  <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
                </ul>
              </div>
            </div>
            <!-- /.card -->


            </form>
          </div>







        </div>

      </div>
    </div>

  </div>
</body>

</html>