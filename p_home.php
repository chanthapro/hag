
<!-- Products Stard -->

<div class="row" >
	 <?php
	 $query = mysqli_query($conn,"select * from tbl_product order by p_id limit 3 ");

						while($row = mysqli_fetch_assoc($query)){
	  ?>
  <div class="col-sm-4 product animated  jackInTheBox ">
	  <a href="<?php echo $row['p_name'] ?>.php">
      <img src="admin/upload/<?php echo $row['p_img'] ?>" >
      <br>
      <label><h3><?php echo $row['p_name'] ?></h3>
      <h5><?php echo $row['p_type'] ?></h5>
    </label>
</a>  </div>
	<?php }?>

</div>
<!-- row 2 -->
  <div class="row">
    <div class="col-sm-12 product">
        Fresh & healthy
      <br>
      <img src="img/footp.png" width="100%">

    </div>
  </div>
  <br>
<!-- /row2 -->

<div class="card-deck p-5">
	 <?php
	 $query = mysqli_query($conn,"select * from tbl_company order by c_id limit 3 ");

						while($row = mysqli_fetch_assoc($query)){
	  ?>
  <div class="card" >
	  <a href="<?php echo $row['c_title'] ?>.php">
    <img  src="admin/upload/<?php echo $row['c_img'] ?>" class="card-img-top" alt="..." height="300">
    <div class="card-body">
      <h5 class="card-title text-center"><?php echo $row['c_title'] ?></h5>
<!--
      <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
      <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
-->
    </div></a>
  </div>
	<?php } ?>

	
	
	
</div>




<!-- Products End -->