<script>
    function showAlert(url) {
        navigator.clipboard.writeText("http://localhost/hag/" + url)
    }
</script>
<?php
$limit = 30;
if (isset($_GET["page"])) {
    $page = $_GET["page"];
} else {
    $page = 1;
};
$start_from = ($page - 1) * $limit;
$query = mysqli_query($conn, "select * from tbl_addimg order by m_id LIMIT $start_from, $limit  ");

while ($row = mysqli_fetch_assoc($query)) {
//							 $count = $row[0];
    ?>
    <table class="border float-left m-1">
        <tr>
            <td>
                <?php

                $url = "upload/" . $row['m_img'];
                ?>
                <img src="../<?php echo $url ?>" width=117px height=90px
                     class=" m-1 border">

        <tr>
            <td>
                <button id=<?php echo $row["m_id"]?> class="badge bg-danger" id="copy-img-btn" onclick="showAlert('<?php echo $url ?> ')"
                        data-dismiss="modal">Copy link
                </button>
                <a href="?delete&id=<?php echo $row['m_id']; ?>"
                   onclick="return confirm('Do u want to Delete')">
                    <span class="badge bg-danger">Delete </span></a>
            <td>
        </tr>
    </table>

    <?php
}
?>