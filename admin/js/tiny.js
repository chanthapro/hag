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