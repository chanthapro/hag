a<?php
include("config.php");
// Insert
if(isset($_POST['btnsave'])){
    $txtdesc1 = $_POST['txtdesc1'];
    $txtdesc2 = $_POST['txtdesc2'];	  
    
    $sql = "insert into tbl_footer (f_left,f_right)values('".$txtdesc1."','".$txtdesc2."')";
	
	  $query = mysqli_query($conn,$sql);
	 if($query){
		header("location:footer.php");
	 }else{
		 echo $sql;
	 }
	  

}

// Delete
if(isset($_GET['delete'])){
	
	$id = $_GET['id'] ?? null;
	
	// $photo = mysqli_query($conn,"select * from tbl_footer where f_id=".$id);
	// // $prow = mysqli_fetch_assoc($photo);
	// // unlink("upload/".$prow['p_img']);
	$query = mysqli_query($conn,"delete from tbl_footer where f_id=".$id);
	if($query){
		header("location:footer.php");
	}
}
// Edit

if(isset($_GET['edit_id'])){
	$id = $_GET['id'] ?? null;
	$query = mysqli_query($conn,"select * from tbl_footer where f_id=".$id);
	while($row = mysqli_fetch_assoc($query)){
		$id = $row['f_id'];
    $rowdesc1 = $row['f_left'];
    $rowdesc2 = $row['f_right'];
	}
}else{
	  $id = '';
    $rowdesc1 ='';
    $rowdesc2 = '';
}


// Update\


if(isset($_POST['btnedit'])){
	$id = $_POST['txtid'];
    $txtdesc1 = $_POST['txtdesc1'];
    $txtdesc2 = $_POST['txtdesc2'];

$sql = "update tbl_footer set f_left='".$txtdesc1."', f_right='".$txtdesc2."' where f_id=".$id;
$query = mysqli_query($conn,$sql);
if($query){
	header("location:footer.php");
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
    <script type="text/javascript" src="js/tinymce/tinymce.min.js"></script>
    <script type="text/javascript">
        tinymce.init({
            selector: "textarea"
        });
        $(document).ready(function (e) {

        });
    </script>


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
                <!-- .....COmpany -->
                <!-- general form elements -->
                <br>
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title"> Footer </h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form role="form" method="post" action="<?php $_SERVER['PHP_SELF']; ?>"
                        enctype="multipart/form-data">
                        <div class="card-body">
                            <input type="hidden" class="form-control" id="txtid" name="txtid"
                                value="<?php echo $id; ?>">

                            <div class="form-group">
                                <label>Footer Left</label>
                                <textarea class="form-control" rows="8" id="comment" name="txtdesc1"
                                    id="txtdesc1"><?php echo $rowdesc1; ?></textarea>
                            </div>
                            <div class="form-group">
                                <label>Footer right</label>
                                <textarea class="form-control" rows="8" id="comment" name="txtdesc2"
                                    id="txtdesc2"><?php echo $rowdesc2; ?></textarea>
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
                            <button type="reset" class="btn btn-danger"
                                onclick="window.location='footer.php'">Cancel</button>
                            <!-- <button type="submit" class="btn btn-primary">Submit</button>
                  <button type="submit" class="btn btn-danger">Cancel</button> -->
                        </div>
                    </form>
                </div>
                </div>
                </div>
                <!-- /.card -->
        <!-- Main content -->
<br>
        <div class="row">
          <div class="col-md-12">

              <!-- /.card-header -->
		 <div class=" table-responsive-sm">
                <table class="table table-bordered  table-striped ">
                  <thead>
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Footer left</th>
                      <th>Footer Right</th>
                      <th style="width: 40px">Action</th>
                      <th style="width: 40px">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
						$query = mysqli_query($conn,"select * from tbl_footer order by f_id  ");
						while($row = mysqli_fetch_assoc($query)){
						?>
                    <tr>
                      <td><?php echo $row['f_id'] ?></td>
                      <td><?php echo $row['f_left'] ?></td>
                      <td><?php echo $row['f_right'] ?></td>

                      <td><a href="?delete&id=<?php  echo $row['f_id']; ?>"
                          onclick="return confirm('Do u want to Delete')">
                          <span class="badge bg-danger">Delete </span></a></td>
                      <!-- ............ -->
                      <td><a href="?edit_id&id=<?php  echo $row['f_id']; ?>">
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