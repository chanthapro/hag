<div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Data Company</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table class="table table-bordered table-responsive-sm">
                                    <thead>
                                        <tr>
                                            <th style="width: 10px">#</th>
                                            <th>Name</th>
                                            <th>Type Images</th>
                                            <th>Image</th>                        
                                            
                                          
                                            <th style="width: 40px">Action</th>
                                            <th style="width: 40px">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
						$query = mysqli_query($conn,"select * from tbl_addimg order by m_id  ");
						while($row = mysqli_fetch_assoc($query)){
						?>
                                        <tr>
                                            <td><?php echo $row['m_id'] ?></td>
                                            <td><?php echo $row['m_img'] ?></td>
                                            <td><?php echo $row['m_name'] ?></td>
                                            <td> <img src="upload/<?php echo $row['m_img'] ?>" width=90px height=90px
                                                    class="">
                                            </td>
                                            <td><a href="?delete&id=<?php  echo $row['m_id']; ?>"
                                                    onclick="return confirm('Do u want to Delete')">
                                                    <span class="badge bg-danger">Delete </span></a></td>
                                            <!-- ............ -->
                                            <td><a href="?edit_id&id=<?php  echo $row['m_id']; ?>">
                                                    <span class="badge bg-danger">Edit </span></a></td>
                                        </tr>
                                        <?php
						}
					?>

                                    </tbody>
                                </table>