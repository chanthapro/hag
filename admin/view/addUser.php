
<?php

// Insert User
$connect = mysqli_connect("localhost","root","","hag");
if($connect){
	echo"";
}else{
	echo"can not connect"."<br>".mysqli_connect_error();
}

if(isset($_POST['btnsave'])){

    $username = $_POST['userName'];
    $password = $_POST['passWord'];
 
   $sql= "insert into tbl_admin (admin_id,admin_name,admin_pwd) values ('null','".$username."','".$password."')";
    $quwey=mysqli_query($connect,$sql);

}

// Delete user




?>


<form class="border border-light p-5" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">

    <p class="h4 mb-4 text-center">Add User</p>


                    <input type="text" id="userName" name="userName" class="form-control" placeholder="User Name">

                    <input type="password" id="passWord" name="passWord" class="form-control" placeholder="Password">

    <button class="btn btn-info btn-block" type="submit" name="btnsave"onclick="return confirm('Please Click Ok?');"  >Save</button>
</form>

<!-- Editable table -->
<div class="card">
  <h3 class="card-header text-center font-weight-bold text-uppercase py-4">TABLE USER</h3>
  <div class="card-body">
    <div id="table" class="table-editable">
      <!-- <span class="table-add float-right mb-3 mr-2"><a href="#!" class="text-success"><i
            class="fas fa-plus fa-2x" aria-hidden="true"></i></a></span> -->
      <table class="table table-bordered table-responsive-md table-striped text-center">
        <thead>
          <tr>
            <th class="text-center">User ID</th>
            <th class="text-center">Username</th>
            <th class="text-center">Password Name</th>
            <th class="text-center">Sort</th>
            <th class="text-center">Remove / Update</th>
          </tr>
        </thead>
        <tbody>
        <?php  
				$sql="select * from tbl_admin";
				$query = mysqli_query($connect,$sql);
				while($row=mysqli_fetch_assoc($query)){
					?>
          <tr>
    

            <td class="pt-3-half" contenteditable="true" name="txtid" id="txtid" ><?php echo $row['admin_id']; ?></td>
            <td class="pt-3-half" contenteditable="true" name="txtname"  id="txtname" ><?php echo $row['admin_name']; ?></td>
            <td class="pt-3-half" contenteditable="true" name="txtpwd" id="txtpwd" ><?php echo $row['admin_pwd']; ?></td>


            <td class="pt-3-half">
              <span class="table-up"><a href="#!" class="indigo-text"><i class="fas fa-long-arrow-alt-up"
                    aria-hidden="true"></i></a></span>
              <span class="table-down"><a href="#!" class="indigo-text"><i class="fas fa-long-arrow-alt-down"
                    aria-hidden="true"></i></a></span>
            </td>
            <td>
              <span class="table-remove"><a  class="btn btn-danger btn-rounded btn-sm my-0" href="?delete&id=<?php  echo $row['admin_id']; ?>
                  " onclick="return confirm('Do u want to Delete')">Delete</a></span>
                  <span class="table-save"><a  class="btn btn-rounded btn-sm my-0" href="?update&id=<?php  echo $row['admin_id']; ?>
                  " onclick="return confirm('Do u want to Delete')">UPDATE</a></span>
            </td>
           
          </tr>
  <?php }?>
        </tbody>
      </table>
    </div>
  </div>
</div>
<!-- Editable table -->
<?php

if(isset($_GET['delete'])){
	
	$id = $_GET['id'] ?? null;
	
	$photo = mysqli_query($connect,"select * from tbl_admin where admin_id=".$id);
	$query = mysqli_query($connect,"delete from tbl_admin where admin_id=".$id);
   header("location:index.php");

}
// Update

if(isset($_GET['update'])){
	
  $id = $_GET['id'] ?? null;
  $txtid = $_GET['txtid'];
  $txtuser = $_GET['txtname'];
  $txtpwd = $_GET['txtpwd'];
$sql = mysqli_query($connect,"select * from tbl_admin where admin_id=".$id);
$quwey = mysqli_query($connect,"update tbl_admin set admin_id='".$txtid."',admin_name='".$txtname."',admin_pwd='".$txtpwd."' ");

}


?>