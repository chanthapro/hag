<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>SB Admin 2 - Tables</title>

  <!-- Custom fonts for this template -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

  <!-- Custom styles for this page -->
  <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>

<body id="page-top">
            <?php
                require ('../config.php')
            ?>

          <!-- Begin Page Content -->
          <div class="container-fluid">


            <!-- DataTales Example -->
            <div class="card shadow mb-4">
              <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Fruit</h6>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Fruit Name</th>
                        <th>Product Type</th>
                        <th>Image</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = mysqli_query($conn, "select * from tbl_fruit order by p_id desc ");
                        while ($row = mysqli_fetch_assoc($query)) {
                        ?>
                              <tr>
                                <td>
                                    <?php echo $row['f_id']?>
                                </td>
                                <td>
                                    <?php echo $row['f_name']?>
                                </td>
                                <td>
                                    <?php echo $row['p_id']?>
                                </td>
                                  <td>
                                      <?php
                                            if($row['f_img']==""){
                                                $id=$row['p_id'];
                                                echo "<img src='../img/default.jpg' id='img$id' style='width: 90px;height: 90px;object-fit: cover' alt='default.jpg'
                                                        >";
                                            }
                                            else{
                                                $value=$row['f_img'];
                                                echo "<img src='../upload/$value' style='width: 90px;height: 90px;object-fit: cover' alt='default.jpg'>";
                                            }
                                      ?>
                                  </td>
                                <td
                                    style="width: 15%"
                                >
                                    <button type="button" class="btn btn-danger"
                                            onclick="onDeleteItem(<?php echo $row['f_id'] ?>)">
                                        <i class="far fa-trash-alt pr-2" aria-hidden="true"></i>
                                        Delete
                                    </button>
                                    <button type="button" class="btn btn-primary"
                                            onclick="onEditItem(<?php echo $row['f_id'] ?>)">
                                        <i class="far fa-edit pr-2" aria-hidden="true"></i>
                                        Edit
                                    </button>
                                </td>
                              </tr>
                        <?php
                            }
                        ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
  
          </div>
          <!-- /.container-fluid -->


 
  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/datatables-demo.js"></script>

</body>
<script>
    function onErrorLoadImage() {
      console.log("alert")
    }
    function onDeleteItem(id) {
        if (confirm("Do you want to delete it")) {
            location.href = location.pathname + "?delete&id=" + id
        }
    }

    function onEditItem(id) {
        location.href = location.pathname + "?edit_id&id=" + id
    }
</script>
</html>
