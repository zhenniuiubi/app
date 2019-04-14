$('#file_upload').uploadifive({
    'uploadScript' : image_upload_url,
    'buttonText'   : '选择文件',
    'fileType'     : 'image', //允许的格式
    'fileObjName'  : 'image',
    'multi'        : false,
    'onUploadComplete': function (file, data) {//每一个文件上传完毕时执行
        var obj = JSON.parse(data);
        if (obj.status) {
            $('#upload_org_code_img').attr('src',obj.data);
            $('#file_upload_image').attr('value',obj.data);
            $('#upload_org_code_img').show();
        }
    },
    'onQueueComplete': function (uploads) {//所有文件上传完毕时执行
        // alert(uploads.successful);
    }
});