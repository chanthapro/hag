<?php
include("config.php");
$query = mysqli_query($conn,"select * from tbl_footer order by f_id desc limit 1 ");
												while($row = mysqli_fetch_assoc($query)){
	  ?>
	 
<!-- Footer -->
<footer class="page-footer font-small mdb-color pt-4 w-100">

  <!-- Footer Elements -->
  <div class="container">

    <!-- Social buttons -->
        <!-- Grid row -->
        <div class="row">

          <!-- Grid column -->
          <div class="col-md-6 mt-md-0 mt-3">
    
			<?php echo $row['f_left'] ; ?>
          </div>
          <!-- Grid column -->
    
          <hr class="clearfix w-100 d-md-none pb-3">
    
          <!-- Grid column -->
          <div class="col-md-6 mb-md-0 mb-3">
    
            <!-- Content -->

<?php echo $row['f_right'] ;} ?>
    
          </div>
          <!-- Grid column -->
    
        </div>
        <!-- Grid row -->
    <ul class="list-unstyled list-inline text-center">
      <li class="list-inline-item">
        <a class="btn-floating btn-fb mx-1" href="https://www.facebook.com/Hyundai-Agro-Cambodia-CoLTD-951081565028089">
          <i class="fab fa-facebook-f"> </i>
        </a>
      </li>
<!--
      <li class="list-inline-item">
        <a class="btn-floating btn-tw mx-1">
          <i class="fab fa-twitter"> </i>
        </a>
      </li>
      <li class="list-inline-item">
        <a class="btn-floating btn-gplus mx-1">
          <i class="fab fa-google-plus-g"> </i>
        </a>
      </li>
      <li class="list-inline-item">
        <a class="btn-floating btn-li mx-1">
          <i class="fab fa-linkedin-in"> </i>
        </a>
      </li>
      <li class="list-inline-item">
        <a class="btn-floating btn-dribbble mx-1">
          <i class="fab fa-dribbble"> </i>
        </a>
      </li>
-->
    </ul>
    <!-- Social buttons -->

  </div>
  <!-- Footer Elements -->

  <!-- Copyright -->
  <div class="footer-copyright text-center py-3">© 2020 Copyright:
    <a href="#"> hyundaiagro.com</a>
  </div>
  <!-- Copyright -->

</footer>
<!-- Footer -->