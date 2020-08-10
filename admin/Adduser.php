
<?php

include("config.php");


?>
<?php

if(isset($_GET['update'])){
  $id = $_GET['id'];
  $query = mysqli_query($conn,"select * from tbl_user where id_user=".$id);
	while($row = mysqli_fetch_assoc($query)){
  $txtid = $row['id_user'];
  $txtuser = $row['user_name'];
  $txtpwd = $row['user_pwd'];
  }}
  else{
    $txtid = '';
    $txtuser = '';
    $txtpwd = '';

  }
if(isset($_POST['btnsave'])){

    $username = $_POST['userName'];
    $password = md5($_POST['passWord']);
    $sql= "insert into tbl_user (id_user,user_name,user_pwd,user_status) values ('null','".$username."','".$password."','1')";
    $quwey=mysqli_query($conn,$sql);

}

// Update

if(isset($_POST['btnupdate'])){
  $id = $_GET['id'] ?? null;
  $txtid = $_POST['userid'];
  $username = $_POST['userName'];
  $password = md5($_POST['passWord']);
  // $txtsta = $_POST['txtsta'];
// $sql = mysqli_query($conn,"select * from tbl_user where id_user=".$txtid);
$sql="update tbl_user set id_user='".$txtid."',user_name='".$username."',user_pwd='".$password."',user_status='1' WHERE id_user='" . $id. "' ";
$quwey = mysqli_query($conn,$sql);

}




?>
<!-- // Delete user -->
<?php

if(isset($_GET['delete'])){
	
	$id = $_GET['id'] ?? null;
	
	// $photo = mysqli_query($conn,"select * from tbl_user where id_user=".$id);
	$query = mysqli_query($conn,"delete from tbl_user where id_user=".$id);
    if($query){
		header("location:index.php");
    }
}?>

<form class="border border-light p-5" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">

    <p class="h4 mb-4 text-center">Add User</p>
<input type="text"  id="userid" name="userid" class="form-control" placeholder=""  value="<?php echo $txtid;  ?>" >
<input type="text" id="userName" name="userName" class="form-control" placeholder="User Name" value="<?php echo $txtuser;  ?>">

<input type="password" id="passWord" name="passWord" class="form-control" placeholder="Password"value="<?php echo $txtpwd;  ?>" >

    <?php if(!isset($_GET['update'])){
            echo '<button class="btn btn-info btn-block" type="submit" name="btnsave"onclick="return 
            confirm("Please Click Ok?");"  >Save</button>';
    }
  else{
    echo '
  <button name="btnupdate" class="btn btn-success btn-lg w-25" type="submit">Update</button>
      ';
      
  }
            
            
            
            ?>





</form>

<!-- Editable table -->

<div class="card">
  <h3 class="card-header text-center font-weight-bold text-uppercase py-4">TABLE USER</h3>
  <div class="card-body">
    <div id="table" class="table-editable">
      <!-- <span class="table-add float-right mb-3 mr-2"><a href="#!" class="text-success"><i
            class="fas fa-plus fa-2x" aria-hidden="true"></i></a></span> -->
            <form class="border border-light p-5" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
      <table class="table table-bordered table-responsive-md table-striped text-center">
        <thead>
          <tr>
            <th class="text-center">User ID</th>
            <th class="text-center">Username</th>
            <th class="text-center">Password Name</th>
            <th class="text-center">Status</th>
            <th class="text-center">Remove / Update</th>
          </tr>
        </thead>
        <tbody>
        <?php  
				$sql="select * from tbl_user";
				$query = mysqli_query($conn,$sql);
				while($row=mysqli_fetch_assoc($query)){
					?>
          <tr>
    

            <td class="pt-3-half" contenteditable="true" name="txtid"    id="txtid" ><?php echo $row['id_user']; ?></td>
            <td class="pt-3-half" contenteditable="true" name="txtname"  id="txtname" ><?php echo $row['user_name']; ?></td>
            <td class="pt-3-half" contenteditable="true" name="txtpwd"   id="txtpwd" ><?php echo $row['user_pwd']; ?></td>
            <td class="pt-3-half" contenteditable="true" name="txtsta"   id="txtsta" ><?php echo $row['user_status']; ?></td>


            
            <td>
              <span class="table-remove"><a  class="btn btn-danger btn-rounded btn-sm my-0" href="?delete&id=<?php  echo $row['id_user']; ?>
                  " onclick="return confirm('Do u want to Delete')">Delete</a></span>
                  <span class="table-save"><<button type="button" ><a  type="submit" class="btn btn-rounded btn-sm my-0" href="?update&id=<?php  echo $row['id_user']; ?>
                  " onclick="return confirm('Do u want to Delete')">UPDATE</a></button></span>

                  
            </td>
           
          </tr>
  <?php }?>
        </tbody>
      </table>
      </form >
    </div>
  </div>
</div>
<!-- Editable table -->

<?php



?>