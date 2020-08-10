<?php
include("config.php");
// Insert
if(isset($_POST['btnsave'])){
    $txtname = $_POST['txtname'];
    $txtdesc = $_POST['txtdesc'];
    $txtSid =   $_POST['sID'];
	if(isset($_FILES['pic1'])){
        if($_FILES['pic1']['name'] !="" ){
        list($name,$ext) = explode(".",$_FILES['pic1']['name']);
        $img1 = md5(uniqid()).".".$ext;
        move_uploaded_file($_FILES['pic1']['tmp_name'],"upload/".$img1);
        }
        }else{
        $img1 = "";
        }
	  
	  $sql = "insert into tbl_fruit_cut (f_name,f_img,f_desc,p_id)values('".$txtname."','".$img1."','".$txtdesc."','".$txtSid."')";
	
	  $query = mysqli_query($conn,$sql);
	 if($query){
		header("location:fruitcut.php");
	 }else{
		 echo $sql;
	 }
	  

}

// Delete
if(isset($_GET['delete'])){
	
	$id = $_GET['id'] ?? null;
	
	$photo = mysqli_query($conn,"select * from tbl_fruit_cut where f_id=".$id);
	$prow = mysqli_fetch_assoc($photo);
	unlink("upload/".$prow['f_img']);
    $query = mysqli_query($conn,"delete from tbl_fruit_cut where f_id=".$id);
	if($query){
		header("location:fruitcut.php");
	}
}
// Edit

if(isset($_GET['edit_id'])){
	$id = $_GET['id'] ?? null;
	$query = mysqli_query($conn,"select * from tbl_fruit_cut where f_id=".$id);
	while($row = mysqli_fetch_assoc($query)){
	$id = $row['f_id'];
    $rowname = $row['f_name'];
    $rowdesc = $row['f_desc'];
    $rowimg = $row['f_img'];
    $rowpid = $row['p_id'];
	// echo "$id $rowtitle $rowimg";
	}
}else{
	  $id = '';
    $rowname = '';
    $rowdesc ='';
    $rowimg = '';
    // $rowpid = '';
}
if(isset($_POST['btnedit'])){
	$id = $_POST['txtid'];
    $txtname = $_POST['txtname'];
    $txtdesc = $_POST['txtdesc'];
    $txtpid = $_POST['sID'];
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
$sql = "update tbl_fruit_cut set f_name='".$txtname."', f_desc='".$txtdesc."',f_img='".$img1."',p_id='".$txtpid."' where f_id=".$id;
// $sql = "update tbl_product set s_title='".$txtname."',img='".$img1."' where s_id='".$id."'";
$query = mysqli_query($conn,$sql);
if($query){
	header("location:fruitcut.php");
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
                        <h3 class="card-title"> Add Fruit Cut</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form role="form" method="post" action="<?php $_SERVER['PHP_SELF']; ?>"
                        enctype="multipart/form-data">
                        <div class="card-body">
                            <input type="hidden" class="form-control" id="txtid" name="txtid"
                                value="<?php echo $id; ?>">
                            <input type="hidden" class="form-control" id="txtimg" name="txtimg"
                                value="<?php echo $rowimg; ?>">

                            <div class="form-group">
                                <label for="exampleInputEmail1">Name Fruit Cut:</label>

                                <input type="text" required name="txtname" class="form-control" id="txtname"
                                    placeholder="Title slide" value="<?php echo $rowname; ?>">
                            </div>
                            <div class="form-group">
                                <input type="file" require class="form-control-file border" name="pic1" id="pic1"
                                    value="<?php echo $rowimg; ?>">
                            </div>

                            <div class="form-group">
                            <label>Detail Fruit Cut & Packing :</label>
                                <textarea class="form-control" rows="8" id="comment" name="txtdesc"
                                    id="txtdesc"><?php echo $rowdesc; ?></textarea>
                            </div>


                            <select class="browser-default custom-select" id="sID" name="sID">
                      <?php
                            $sql="select * from tbl_product";
                            $query = mysqli_query($conn,$sql);
                            while($row=mysqli_fetch_assoc($query)){
					?><option class="khshow" value="<?php echo $row['p_id']; ?>">
                    <?php  echo $row['p_name'];  ?>	
                        </option>      

                        <?php
                    }
                ?>
    
                            </select>



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
                                onclick="window.location='fruitcut.php'">Cancel</button>
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
                       			                <div class=" table-responsive-sm">
                <table class="table table-bordered  table-striped ">
                                    <thead>
                                        <tr>
                                            <th style="width: 10px">#</th>
                                            <th>Fruit Cut Name</th>
                                            <th>Detail Fruit Cut & Packing</th>                        
                                            <th>Product Type</th>
                                            <th>Image</th>
                                            <th style="width: 40px">Action</th>
                                            <th style="width: 40px">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
										$limit = 5;  
if (isset($_GET["page"])) {
	$page  = $_GET["page"]; 
	} 
	else{ 
	$page=1;
	};  
$start_from = ($page-1) * $limit;  
						$query = mysqli_query($conn,"select * from tbl_fruit_cut order by f_id  LIMIT $start_from, $limit  ");
						while($row = mysqli_fetch_assoc($query)){
						?>
                                        <tr>
                                            <td><?php echo $row['f_id'] ?></td>
                                            <td><?php echo $row['f_name'] ?></td>
                                            <td><?php echo $row['f_desc'] ?></td>
                                            <td><?php echo $row['p_id'] ?></td>
                                            <td> <img src="upload/<?php echo $row['f_img'] ?>" width=90px height=90px
                                                    class="">
                                            </td>
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
                        </div>
                        <!-- /.card -->


                        </form>
                    </div>







                </div>





            </div>

        </div>
    </div>


<?php  

$result_db = mysqli_query($conn,"SELECT COUNT(f_id) FROM tbl_fruit_cut"); 
$row_db = mysqli_fetch_row($result_db);  
$total_records = $row_db[0];  
$total_pages = ceil($total_records / $limit); 
/* echo  $total_pages; */
$pagLink = "<ul class='pagination'>";  
for ($i=1; $i<=$total_pages; $i++) {
              $pagLink .= "<li class='page-item'><a class='page-link' href='fruitcut.php?page=".$i."'>".$i."</a></li>";	
}?>
<div class="card-footer clearfix">
 <ul class="pagination pagination-sm m-0 float-right">
	 <li class="page-item">&laquo;</li>
	 <?php
echo $pagLink . "</ul>";  
?>
	  <li class="page-item">&raquo;</li>
                                </ul>
                            </div>

</body>

</html>