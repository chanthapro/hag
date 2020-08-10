<?php include("config.php")?>
<!-- Slider Stard -->
<div id="carouselExampleFade" class="carousel slide carousel-fade top1    " data-ride="carousel" style="cursor: pointer;" >
  <div class="carousel-inner">
	  <?php
	 $query = mysqli_query($conn,"select * from tbl_slide order by s_id desc limit 3 ");

						while($row = mysqli_fetch_assoc($query)){
	  ?>
    <div class="carousel-item ">
      <img class="d-block w-100" src="admin/upload/<?php echo $row['s_img'] ?>"  height=500px
        alt="First slide">
        <div class="carousel-caption">
          <h3 class="h3-responsive"><?php echo $row['s_title'] ?></h3>

        </div>
    </div>
	  <?php 
																}
?>
    <div class="carousel-item active">
      <img class="d-block w-100" src="img/slide2.jpg"
        alt="Second slide" height=500px >
        <div class="carousel-caption ">
          <h3 class="h3-responsive ">Fresh Vegetables From CAMBODIA</h3>
          <p>Fresh & Healthy</p>
        </div>
    </div>
<!--
    <div class="carousel-item">
      <img class="d-block w-100" src="img/slide3.jpg"
        alt="Third slide">
        <div class="carousel-caption">
          <h3 class="h3-responsive">ដំណាំលូតលាស់ឆាប់រហ័ស</h3>
          <p>Good Product</p>
        </div>
    </div>
-->
  </div>
  <a class="carousel-control-prev" href="#carouselExampleFade" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleFade" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>

<!-- Slider End -->

