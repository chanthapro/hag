<?php
//    include ('fruit.php')
$row = ['']
?>
<form>
    <div class="row">
        <div class="col-md-7">
            <div class="row formStyle">
                <div class="col-md-12">
                    <input type="text" required name="txtname" class="form-control" id="txtname" required
                           placeholder="Fruit Name">
                </div>
            </div>
            <div class="row formStyle">
                <div class="col-md-12">
                    <select class="browser-default custom-select" id="sID" name="sID">
                        <?php
                        $sql = "select * from tbl_product";
                        $query = mysqli_query($conn, $sql);
                        while ($row = mysqli_fetch_assoc($query)) {
                            ?>
                            <option class="khshow" value="<?php echo $row['p_id']; ?>">
                                <?php echo $row['p_name']; ?>
                            </option>

                            <?php
                        }
                        ?>
                    </select>
                </div>
            </div>
        </div>
        <div class="col-md">

        </div>
    </div>
</form>



