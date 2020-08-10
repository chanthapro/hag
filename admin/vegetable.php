<?php
include("config.php");
// Insert
if(isset($_POST['btnsave'])){
    $txtname = $_POST['txtname'];
    $txtdesc = strval($_POST['txtdesc']);
    // echo strval($_POST['txtdesc']);
    // $txtdesc = strval($_POST["des"]);
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
	  
      $sql = "insert into tbl_vegetable (f_name,f_img,f_desc,p_id)values('".$txtname."','".$img1."','".$txtdesc."','".$txtSid."')";
      echo $sql;
	  $query = mysqli_query($conn,$sql);
	//  if($query){
	// 	header("location:vegetable.php");
	//  }else{
	// 	 echo $sql;
	//  }
	  

}

// Delete
if(isset($_GET['delete'])){
	
	$id = $_GET['id'] ?? null;
	
	$photo = mysqli_query($conn,"select * from tbl_vegetable where f_id=".$id);
	$prow = mysqli_fetch_assoc($photo);
	unlink("upload/".$prow['f_img']);
    $query = mysqli_query($conn,"delete from tbl_vegetable where f_id=".$id);
	if($query){
		header("location:vegetable.php");
	}
}
// Edit

if(isset($_GET['edit_id'])){
	$id = $_GET['id'] ?? null;
	$query = mysqli_query($conn,"select * from tbl_vegetable where f_id=".$id);
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
$sql = "update tbl_vegetable set f_name='".$txtname."', f_desc='".$txtdesc."',f_img='".$img1."',p_id='".$txtpid."' where f_id=".$id;
// $sql = "update tbl_product set s_title='".$txtname."',img='".$img1."' where s_id='".$id."'";
$query = mysqli_query($conn,$sql);
if($query){
	header("location:vegetable.php");
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
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script type="text/javascript" src="https://tinymce.cachefly.net/4.2/tinymce.min.js"></script>
	

<!--   <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>-->
	<script type="text/javascript" src="js/js.js"></script>
 
    <script >
$(document).ready(function() {
  tinymce.init({
    selector: "textarea",
    theme: "modern",
    paste_data_images: true,
    plugins: [
      "advlist autolink lists link image charmap print preview hr anchor pagebreak",
      "searchreplace wordcount visualblocks visualchars code fullscreen",
      "insertdatetime media nonbreaking save table contextmenu directionality",
      "emoticons template paste textcolor colorpicker textpattern"
    ],
    toolbar1: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
    toolbar2: "print preview media | forecolor backcolor emoticons",
    image_advtab: true,
    file_picker_callback: function(callback, value, meta) {
      if (meta.filetype == 'image') {
        $('#upload').trigger('click');
        $('#upload').on('change', function() {
          var file = this.files[0];
          var reader = new FileReader();
          reader.onload = function(e) {
            callback(e.target.result, {
              alt: ''
            });
          };
          reader.readAsDataURL(file);
        });
      }
    },
    templates: [{
      title: 'Test template 1',
      content: 'Test 1'
    }, {
      title: 'Test template 2',
      content: 'Test 2'
    }]
  });
});

    </script>
<style>
	.hidden{
	display:none;
}
	</style>

</head>

<body class="">
<!--<textarea name="" id="" cols="30" rows="10"></textarea>-->

 <!-- <input name="image" type="file" id="upload" class="hidden" onchange=""> -->

    <div class="container-fluid">
        <div class="row">

            <div class="col-sm-12 col-md-12 col-lg-12 m-0 p-0 cover1">
                <?php include_once("eadmin.php"); ?>
            </div>

        </div>
<input name="image" type="file" id="upload" class="hidden" onchange="">

        <div class="row">
            <div class="col-sm-2 col-md-2 col-lg-2 mt-1">
                <?php include_once("menu_left.php"); ?>
            </div>
            <div class="col-sm-10 col-md-10 col-lg-10">
                <!-- .....COmpany -->
                <!-- general form elements --><br>
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title"> Add Vegetable </h3>
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
                                <label for="exampleInputEmail1">Name Vegetable :</label>

                                <input type="text" required name="txtname" class="form-control" id="txtname"
                                    placeholder="Title slide" value="<?php echo $rowname; ?>">
                            </div>
                            <div class="form-group">
                                <input type="file" require class="form-control-file border" name="pic1" id="pic1"
                                    value="<?php echo $rowimg; ?>">
                            </div>

                            <div class="form-group">
                            <label>Detail Vegetable & Packing :</label>
                                <textarea class="form-control" cols="30" rows="10" id="comment drive-demo" name="txtdesc"
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
                                onclick="window.location='vegetable.php'">Cancel</button>
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
                                            <th>Vegetable Name</th>
                                            <th>Detail Vegetable & Packing</th>                        
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
						$query = mysqli_query($conn,"select * from tbl_vegetable order by f_id DESC LIMIT $start_from, $limit  ");
						while($row = mysqli_fetch_assoc($query)){
						?>
                                        <tr  >
                                            <td ><?php echo $row['f_id'] ?></td>
                                            <td><?php echo $row['f_name'] ?></td>
                                            
                                            <td style="width: 40px" ><?php echo strval( $row['f_desc'])   ?></td>
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

$result_db = mysqli_query($conn,"SELECT COUNT(f_id) FROM tbl_vegetable"); 
$row_db = mysqli_fetch_row($result_db);  
$total_records = $row_db[0];  
$total_pages = ceil($total_records / $limit); 
/* echo  $total_pages; */
$pagLink = "<ul class='pagination'>";  
for ($i=1; $i<=$total_pages; $i++) {
              $pagLink .= "<li class='page-item'><a class='page-link' href='vegetable.php?page=".$i."'>".$i."</a></li>";	
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