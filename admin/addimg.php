<?php
include("config.php");
// Insert
if(isset($_POST['btnsave'])){
    $txtname = $_POST['txtname'];
    $txttype = $_POST['sID'];
    $date = date("Y-m-d H:i:s");
    $tmpname = $_FILES['pic1']['tmp_name'];
    $filename = $_FILES['pic1']['name'];

	if(isset($_FILES['pic1']['name'])){
        $data =$_FILES['pic1']['name'];
        for($i=0;$i < sizeof($data);$i++){
            $file= $_FILES['pic1']['tmp_name'][$i];
            $img1=uniqid().$_FILES['pic1']['name'][$i];
            move_uploaded_file($file,"../upload/".$img1);
            $sql = "insert into tbl_addimg (m_name,m_img,p_type,date)values('".$txtname."','".$img1."','".$txttype."','".$date."')";
        $query = mysqli_query($conn,$sql);
        }
    
    }
     else{
         $img1="";
     }

    //  list($name,$ext) = explode(".",$_FILES['pic1']['name']);
	// 	$img1 = md5(uniqid()).".".$ext;
	// 	unlink("upload/".$_POST['txtimg']);
	// 	move_uploaded_file($_FILES['pic1']['tmp_name'],"upload/".$img1);  
      

	  

}

// Delete
if(isset($_GET['delete'])){
	
	$id = $_GET['id'] ?? null;
	
	$photo = mysqli_query($conn,"select * from tbl_addimg where m_id=".$id);
	$prow = mysqli_fetch_assoc($photo);
	unlink("upload/".$prow['m_img']);
    $query = mysqli_query($conn,"delete from tbl_addimg where m_id=".$id);
	if($query){
		header("location:addimg.php");
	}
}
// Edit

if(isset($_GET['edit_id'])){
	$id = $_GET['id'] ?? null;
	$query = mysqli_query($conn,"select * from tbl_addimg where m_id=".$id);
	while($row = mysqli_fetch_assoc($query)){
	$id = $row['m_id'];
    $rowname = $row['m_name'];
    // $rowdesc = $row['m_type'];
    $rowimg = $row['m_img'];
    $rowpid = $row['p_type'];
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
    // $txtdesc = $_POST['txtdesc'];
    $txtpid = $_POST['sID'];
    $img1 = $_POST['txtimg'];

    // echo "$id $txtname $img1";
  
    

if(isset($_FILES['pic1'])){
	// if($_FILES['pic1']['name'] !="" ){
	// 	list($name,$ext) = explode(".",$_FILES['pic1']['name']);
	// 	$img1 = md5(uniqid()).".".$ext;
	// 	unlink("upload/".$_POST['txtimg']);
	// 	move_uploaded_file($_FILES['pic1']['tmp_name'],"upload/".$img1);
    // }
    $file= $_FILES['pic1']['tmp_name'][0];
    $img1=uniqid().$_FILES['pic1']['name'][0];
    // unlink("upload/".$_POST['txtimg']);
    echo $img1;
    move_uploaded_file($file,"../upload/".$img1);

}else{
	$img1 = $_POST['txtimg'];
}
$sql = "update tbl_addimg set m_name='".$txtname."',m_img='".$img1."',p_type='".$txtpid."' where m_id=".$id;
// $sql = "update tbl_product set s_title='".$txtname."',img='".$img1."' where s_id='".$id."'";
$query = mysqli_query($conn,$sql);
if($query){
	header("location:addimg.php");
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
                        <h3 class="card-title"> Add Image </h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form role="form" method="post" enctype='multipart/form-data' action="<?php $_SERVER['PHP_SELF']; ?>"
                        enctype="multipart/form-data">
                        <div class="card-body">
                            <input type="hidden" class="form-control" id="txtid" name="txtid"
                                value="<?php echo $id; ?>">
                            <input type="hidden" class="form-control" id="txtimg" name="txtimg"
                                value="<?php echo $rowimg; ?>">

                            <div class="form-group">
                                <label for="exampleInputEmail1">Name Image :</label>

                                <input type="text"  required name="txtname" class="form-control" id="txtname"
                                    placeholder="Title slide" value="<?php echo $rowname; ?>">
                            </div>
                            <div class="form-group">
                                <input type="file" require class="form-control-file border" name="pic1[]" id="pic1"
                                multiple="multiple" >
                            </div>



                            <select class="browser-default custom-select" id="sID" name="sID">
                      <?php
                            $sql="select * from tbl_product";
                            $query = mysqli_query($conn,$sql);
                            while($row=mysqli_fetch_assoc($query)){
					?><option class="khshow" value="<?php echo $row['p_id']; ?>">
                    <?php  echo $row['p_type'];  ?>	
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
						<button type="submit"class="btn btn btn-primary " name="btnsave">Insert</button>
						';
				}else{
					echo '
				<button name="btnedit" class="btn btn-success " type="submit">Update</button>
						';
						
				}
                ?>
                            <button type="reset" class="btn btn-danger"
                                onclick="window.location='addimg.php'">Cancel</button>
                            <!-- <button type="submit" class="btn btn-primary">Submit</button>
                  <button type="submit" class="btn btn-danger">Cancel</button> -->
                        </div>
                    </form>
                </div>
                <!-- /.card -->
                <!-- Main content -->
                <br>
               
</div>
 </div>
<div class="row">
	<div class="col-sm-12">
		<div class=" text-center   " >

<?php
						$limit = 30;  
if (isset($_GET["page"])) {
	$page  = $_GET["page"]; 
	} 
	else{ 
	$page=1;
	};  
$start_from = ($page-1) * $limit;  
  $query = mysqli_query($conn,"select * from tbl_addimg order by m_id LIMIT $start_from, $limit  ");

						while($row = mysqli_fetch_assoc($query)){
//							 $count = $row[0];
						?>
                        <table class="border float-left m-1"> 
                        <tr>
                        <td>
                        <?php 
                        
                            $url="upload/".$row['m_img'];
                        ?>
    <img src="../<?php echo $url ?>" width=117px height=90px
                                                    class=" m-1 border" >
                       
                       <tr>
                        <td>      
                        <button class="badge bg-danger" id="copy-img-btn" onclick="showAlert('<?php echo $url?> ')">Copy link </button>
                                              <a href="?delete&id=<?php  echo $row['m_id']; ?>"
                                                    onclick="return confirm('Do u want to Delete')">
                                                    <span class="badge bg-danger">Delete </span></a>                                                   
                                                    <td> </tr></table>

<?php
						}
					?>


<script>
   function showAlert(url) {
    navigator.clipboard.writeText("http://localhost/hag/"+url)
}
</script>





<br>


             
                    </div>
		</div>
		</div>
	                            <!-- /.card-body -->


<?php  

$result_db = mysqli_query($conn,"SELECT COUNT(m_id) FROM tbl_addimg"); 
$row_db = mysqli_fetch_row($result_db);  
$total_records = $row_db[0];  
$total_pages = ceil($total_records / $limit); 
/* echo  $total_pages; */
$pagLink = "<ul class='pagination'>";  
for ($i=1; $i<=$total_pages; $i++) {
              $pagLink .= "<li class='page-item'><a class='page-link' href='addimg.php?page=".$i."'>".$i."</a></li>";	
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

	
<!--

                             <div class="card-footer clearfix">
                                <ul class="pagination pagination-sm m-0 float-right">
                                    <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
                                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                    <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
                                </ul>
                            </div> 
-->
                        <!-- /.card -->


  
</body>

</html>