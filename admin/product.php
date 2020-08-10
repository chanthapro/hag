<?php
include("config.php");
// Insert
if(isset($_POST['btnsave'])){
    $txtpname = $_POST['txtpname'];
    $txtptype = $_POST['txtptype'];
	if(isset($_FILES['pic1'])){
        if($_FILES['pic1']['name'] !="" ){
        list($name,$ext) = explode(".",$_FILES['pic1']['name']);
        $img1 = md5(uniqid()).".".$ext;
        move_uploaded_file($_FILES['pic1']['tmp_name'],"upload/".$img1);
        }
        }else{
        $img1 = "";
        }
	  
	  $sql = "insert into tbl_product (p_name,p_type,p_img)values('".$txtpname."','".$txtptype."','".$img1."')";
	
	  $query = mysqli_query($conn,$sql);
	 if($query){
		header("location:product.php");
	 }else{
		 echo $sql;
	 }
	  

}

// Delete
if(isset($_GET['delete'])){
	
	$id = $_GET['id'] ?? null;
	
	$photo = mysqli_query($conn,"select * from tbl_product where p_id=".$id);
	$prow = mysqli_fetch_assoc($photo);
	unlink("upload/".$prow['p_img']);
	$query = mysqli_query($conn,"delete from tbl_product where p_id=".$id);
	if($query){
		header("location:product.php");
	}
}

// Edit

if(isset($_GET['edit_id'])){
	$id = $_GET['id'] ?? null;
	$query = mysqli_query($conn,"select * from tbl_product where p_id=".$id);
	while($row = mysqli_fetch_assoc($query)){
		$id = $row['p_id'];
    $rowname = $row['p_name'];
    $rowtype = $row['p_type'];
		$rowimg = $row['p_img'];
	// echo "$id $rowtitle $rowimg";
	}
}else{
	  $id = '';
    $rowname = '';
    $rowtype ='';
    $rowimg = '';
}



// Update\


if(isset($_POST['btnedit'])){
	$id = $_POST['txtid'];
    $txtname = $_POST['txtpname'];
    $txttype = $_POST['txtptype'];
    $img1 = $_POST['txtimg'];

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
$sql = "update tbl_product set p_name='".$txtname."', p_type='".$txttype."',p_img='".$img1."' where p_id=".$id;
// $sql = "update tbl_product set s_title='".$txtname."',img='".$img1."' where s_id='".$id."'";
$query = mysqli_query($conn,$sql);
if($query){
	header("location:product.php");
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
            <h3 class="card-title"> Add Products </h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form role="form" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
            <div class="card-body">
              <input type="hidden" class="form-control" id="txtid" name="txtid" value="<?php 
                echo $id; 
                 ?>">
              <input type="hidden" class="form-control" id="txtimg" name="txtimg" value="<?php echo $rowimg;  ?>">

              <div class="form-group">
                <label for="exampleInputEmail1">Product Name</label>

                <input type="text" required name="txtpname" class="form-control" id="txtpname"
                  placeholder="Product Name" value="<?php echo$rowname; ?>">
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Product Type</label>

                <input type="text" name="txtptype" class="form-control" id="txtptype" placeholder="Product Type"
                  value="<?php echo $rowtype; ?>">
              </div>

              <div class="form-group">
                <input type="file" require class="form-control-file border" name="pic1" id="pic1"
                  value="<?php echo $rowimg; ?>">
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
              <button type="reset" class="btn btn-danger" onclick="window.location='product.php'">Cancel</button>
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

              <!-- /.card-header -->
  <div class=" table-responsive-sm">
                <table class="table table-bordered  table-striped ">
                  <thead>
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Product Name</th>
                      <th>Product Type</th>
                      <th>image</th>
                      <th style="width: 40px">Action</th>
                      <th style="width: 40px">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
						$query = mysqli_query($conn,"select * from tbl_product order by p_id ");
						while($row = mysqli_fetch_assoc($query)){
						?>
                    <tr>
                      <td><?php echo $row['p_id'] ?></td>
                      <td><?php echo $row['p_name'] ?></td>
                      <td style="font: 10px;" ><?php echo $row['p_type'] ?></td>
                      <td> <img src="upload/<?php echo $row['p_img'] ?>" width=90px height=90px class="">
                      </td>
                      <td><a href="?delete&id=<?php  echo $row['p_id']; ?>"
                          onclick="return confirm('Do u want to Delete')">
                          <span class="badge bg-danger">Delete </span></a></td>
                      <!-- ............ -->
                      <td><a href="?edit_id&id=<?php  echo $row['p_id']; ?>">
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

            <!-- /.card -->


            </form>
          </div>







        </div>


    </div>

  </div>
</body>

</html>