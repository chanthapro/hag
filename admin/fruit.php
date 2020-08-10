<?php
include("config.php");
// Insert
if (isset($_POST['btnsave'])) {
    $txtname = $_POST['txtname'];
    $txtdesc = $_POST['txtdesc'];
    $txtSid = $_POST['sID'];
    if (isset($_FILES['pic1'])) {
        if ($_FILES['pic1']['name'] != "") {
            list($name, $ext) = explode(".", $_FILES['pic1']['name']);
            $img1 = md5(uniqid()) . "." . $ext;
            move_uploaded_file($_FILES['pic1']['tmp_name'], "../upload/" . $img1);
        }
    } else {
        $img1 = "";
    }

    $sql = "insert into tbl_fruit (f_name,f_img,f_desc,p_id)values('" . $txtname . "','" . $img1 . "','" . $txtdesc . "','" . $txtSid . "')";

    $query = mysqli_query($conn, $sql);
    if ($query) {
        header("location:fruit.php");
    } else {
        echo $sql;
    }


}

// Delete
if (isset($_GET['delete'])) {

    $id = $_GET['id'] ?? null;

    $photo = mysqli_query($conn, "select * from tbl_fruit where f_id=" . $id);
    $prow = mysqli_fetch_assoc($photo);
    unlink("..upload/" . $prow['f_img']);
    $query = mysqli_query($conn, "delete from tbl_fruit where f_id=" . $id);
    if ($query) {
        header("location:fruit.php");
    }
}
// Edit

if (isset($_GET['edit_id'])) {
    $id = $_GET['id'] ?? null;
    $query = mysqli_query($conn, "select * from tbl_fruit where f_id=" . $id);
    while ($row = mysqli_fetch_assoc($query)) {
        $id = $row['f_id'];
        $rowname = $row['f_name'];
        $rowdesc = $row['f_desc'];
        $rowimg = $row['f_img'];
        $rowpid = $row['p_id'];
        // echo "$id $rowtitle $rowimg";
    }
} else {
    $id = '';
    $rowname = '';
    $rowdesc = '';
    $rowimg = '';
    // $rowpid = '';
}
if (isset($_POST['btnedit'])) {
    $id = $_POST['txtid'];
    $txtname = $_POST['txtname'];
    $txtdesc = $_POST['txtdesc'];
    $txtpid = $_POST['sID'];
    $img1 = $_POST['txtimg'];

    // echo "$id $txtname $img1";

    if (isset($_FILES['pic1'])) {
        if ($_FILES['pic1']['name'] != "") {
            list($name, $ext) = explode(".", $_FILES['pic1']['name']);
            $img1 = md5(uniqid()) . "." . $ext;
            unlink("upload/" . $_POST['txtimg']);
            move_uploaded_file($_FILES['pic1']['tmp_name'], "upload/" . $img1);
        }
    } else {
        $img1 = $_POST['txtimg'];
    }
    $sql = "update tbl_fruit set f_name='" . $txtname . "', f_desc='" . $txtdesc . "',f_img='" . $img1 . "',p_id='" . $txtpid . "' where f_id=" . $id;
// $sql = "update tbl_product set s_title='".$txtname."',img='".$img1."' where s_id='".$id."'";
    $query = mysqli_query($conn, $sql);
    if ($query) {
        header("location:fruit.php");
    } else {
        echo $sql;
    }
}
include('header.php');
?>


<script type="text/javascript">
    tinymce.init({
        selector: "textarea",
        theme: "modern",
        height: 400,
        paste_data_images: true,

        plugins: [
            "advlist autolink lists link image charmap print preview hr anchor pagebreak",
            "searchreplace wordcount visualblocks visualchars code fullscreen",
            "insertdatetime media nonbreaking save table contextmenu directionality",
            "emoticons template paste textcolor colorpicker textpattern"
        ],
        toolbar1: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent ",
        toolbar2: "print preview media | forecolor backcolor emoticons | image",
        image_advtab: true,
        images_upload_url: 'service/UploadFileService.php',
        images_upload_handler: function (blobInfo, success, failure) {
            console.log(blobInfo.filename())
            var xhr, formData;
            xhr = new XMLHttpRequest();
            xhr.withCredentials = false;

            xhr.open('POST', 'service/UploadFileService.php');
            xhr.onload = function () {
                var json;
                if (xhr.status != 200) {
                    failure('HTTP Error: ' + xhr.status);
                    return;
                }

                json = JSON.parse(xhr.response);
                // if (!json || typeof json.location != 'string') {
                //     failure('Invalid JSON: ' + xhr.responseText);
                //     return;
                // }
            };
            formData = new FormData();
            formData.append('file', blobInfo.blob(), blobInfo.filename());
            xhr.send(formData);
            const url = "http://localhost/hag/upload/" + blobInfo.filename();

            setTimeout(function () {
                /* no matter what you upload, we will turn it into TinyMCE logo :)*/
                success(url)
            }, 2000);
        },
        templates: [{
            title: 'Test template 1',
            content: 'Test 1'
        }, {
            title: 'Test template 2',
            content: 'Test 2'
        }]
    });
    $(document).ready(function () {
        $('#example').dataTable;
    });
</script>
<style>
    .hidden {
        display: none;
    }
</style>

</head>


<body class="">


<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-12 m-0 p-0 cover1">
            <?php include_once("eadmin.php"); ?>
        </div>
    </div>


    <div class="row">
        <div class="col-sm-2 col-md-2 col-lg-2 mt-1">
            <?php include_once("menu_left.php"); ?>
        </div>
        <div class="col-sm-10 col-md-10 col-lg-10">
            <!-- .....COmpany -->
            <!-- general form elements -->
            <br>
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title"> Add Fruit </h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form id="form-create" role="form" method="post"
                      enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="row formStyle">
                                <div class="col-md-12">
                                    <input type="text" required name="txtname" class="form-control" id="txtname"
                                           value="<?php echo $rowname ?>" placeholder="Fruit Name">
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
                            <div class="row uploadImage">
                                <div class="col-md-12 uploadStyle" id="upload-image" onclick="onUploadImage()"
                                    style="background-image: url('../upload/<?php echo "../upload/$rowimg"?>')"
                                >
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row formStyle">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Detail Fruit & Packing :</label>
                                <textarea class="form-control" rows="8" id="txtimg" name="txtdesc"
                                          id="txtdesc"><?php echo $rowdesc; ?></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-md-6">
                                <?php
                                if (!isset($_GET['edit_id'])) {
                                    echo '<button type="submit" id="btnsave" class="btn btn btn-primary " name="btnsave">Insert</button>';
                                } else {
                                    echo '   <button name="btnedit" class="btn btn-success " type="submit">Update</button>';
                                }
                                ?>
                            </div>
                            <div class="col-md-6 cancelButton">
                                <button type="reset" class="btn btn-danger"
                                        onclick="window.location='fruit.php'">Cancel
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /.card -->


    <!-- Main content -->
    <br>

    <div class="row">
        <div class="col-md-12">
            <div class=" table-responsive-sm">
                <?php require('table/tables.php') ?>
            </div>
        </div>
        <!-- /.card -->
    </div>


</div>

<div class="modal fade" id="modalSubscriptionForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h4 class="modal-title w-100 font-weight-bold">Subscribe</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body mx-3">
                <div class="md-form mb-5">
                    <i class="fas fa-user prefix grey-text"></i>
                    <input type="text" id="form3" class="form-control validate">
                    <label data-error="wrong" data-success="right" for="form3">Your name</label>
                </div>

                <div class="md-form mb-4">
                    <i class="fas fa-envelope prefix grey-text"></i>
                    <input type="email" id="form2" class="form-control validate">
                    <label data-error="wrong" data-success="right" for="form2">Your email</label>
                </div>

            </div>
            <div class="modal-footer d-flex justify-content-center">
                <button class="btn btn-indigo">Send <i class="fas fa-paper-plane-o ml-1"></i></button>
            </div>
        </div>
    </div>
</div>


</body>
</html>




<script>
    function showContent() {
        console.log(tinymce.activeEditor.getContent())
    }

    function onDeleteItem(id) {
        if (confirm("Do you want to delete it")) {
            location.href = location.pathname + "?delete&id=" + id
        }
    }

    function onEditItem(id) {
        location.href = location.pathname + "?edit_id&id=" + id
    }

    function onChangePage(page) {
        location.href = location.pathname + "?page=" + page
    }

    function getCurrentPageFromURL() {
        const search = location.search.substring(1);
        if (!search)
            return
        const json = JSON.parse('{"' + decodeURI(search).replace(/"/g, '\\"').replace(/&/g, '","').replace(/=/g, '":"') + '"}')
        return json.page === undefined ? 1 : json.page;
    }

    function onNextPage(totalPage) {
        let nextPage = getCurrentPageFromURL()
        if (nextPage >= totalPage)
            nextPage = totalPage
        else
            nextPage++
        location.href = location.pathname + "?page=" + nextPage

    }

    function onPreviousPage(currentPage, totalPage) {
        let previousPage = getCurrentPageFromURL()
        if (previousPage <= 1)
            previousPage = 1
        else
            previousPage--
        location.href = location.pathname + "?page=" + previousPage
    }

    function onUploadImage() {
        const input = document.createElement("input");
        input.id = "pic1"
        input.name = "pic1"
        input.type = "file"
        input.click()
        input.style.display = "none"
        input.addEventListener("change", () => {
            const parent = document.getElementById("upload-image")
            const form = document.getElementById("form-create")
            form.append(input)
            parent.style.backgroundImage = "url(" + URL.createObjectURL(input.files[0]) + ")";
        })
    }

    function onChangeSearch(event) {
        console.log(event.target.value)
    }



</script>