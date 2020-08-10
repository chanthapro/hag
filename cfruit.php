
<div class="p-5 row" >
	<div class="col-12">
<?php

$id=$_GET["id"];
      include("config.php");
	 $query = mysqli_query($conn,"select * from tbl_fruit where f_id = '$id'");

						if($row = mysqli_fetch_assoc($query)){
							?>
<h1><a href="fruit.php" class="text-info d-flex justify-content-center "> Fruit > <?php echo $row['f_name'];?> </a><h1>
	<?php
							
							
							?>
	<div class="text-center">
  <img class=" " src="admin/upload/<?php echo $row['f_img']  ?>"  alt="Card image cap">
</div
		<td>
<?php
						echo $row['f_desc'];		
		?></td>
	<?php 
						}

	



?><br></div>
	</div>
<br>
	<div class="clear"></div>
