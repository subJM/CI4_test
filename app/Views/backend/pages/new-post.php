<?= $this->extend('backend/layout/pages-layout'); ?>
<?= $this->section('content') ?>
<?php use App\Libraries\CIAuth;?>
<div class="page-header">
    <div class="row">
        <div class="col-md-6 col-sm-12">
            <div class="title">
                <h4>Add post</h4>
            </div>
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="<?= route_to('admin.home') ?>">Home</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Add post
                    </li>
                </ol>
            </nav>
        </div>
        <div class="col-md-6 col-sm-12 text-right">
            <a href="<?= route_to('all-posts') ?>" class="btn btn-primary"> View All posts </a>
        </div>
    </div>
</div>

<form action="<?= route_to('create-post')?>" method="POST" autocomplete="off" enctype="multipart/form-data" id="addPostForm" >
    <input type="hidden" name="<?= csrf_token() ?>" value="<?=csrf_hash() ?>" class="ci_csrf_data" >
    <div class="row">
        <div class="col-md-9">
            <div class="card card-box mb-2">
                <div class="card-body">
                    <div class="form-group">
                        <label for=""><b>Post title</b></label>
                        <input type="text" class="form-control" placeholder="Enter Post title" name="title">
                        <span class="text-danger error-text title_error"></span>
                    </div>
                    <div class="form-group">
                        <label for=""><b>Content</b></label>
                        <textarea name="content" id="content" cols="30" rows="10" class="form-control" placeholder="Type..."></textarea>
                        <span class="text-danger error-text content_error"></span>
                    </div>
                </div>
            </div>
            <div class="card card-box mb-2">
                <h5 class="card-header weight-500">SEO</h5>
                <div class="card-body">
                    <div class="form-group">
                        <label for=""><b>Post meta keywords</b><small>(Separeted by comma)</small></label>
                        <input type="text" name="meta_keywords" placeholder="Enter post meta keywords" id="" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for=""><b>Post meta description</b></label>
                        <textarea name="meta_description" id="" cols="30" rows="10" class="form-control" placeholder="Type meta description"></textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card card-box mb-2">
                <div class="card-body">
                    <div class="form-group">
                        <label for=""><b>Post category</b></label>
                        <select name="category" id="" class="custom-select formcontrol">
                            <option value="">Choose...</option>
                            <?php foreach($categories as $category):?>
                                <option value="<?= $category->id ?>"><?= $category->name ?></option>
                            <?php endforeach?>
                        </select>
                        <span class="text-danger error-text category_error"></span>
                    </div>
                    <div class="form-group">
                        <label for=""><b>Post featured image</b></label>
                        <input type="file" name="featured_image" class="form-control-file form-control" height="auto">
                        <span class="text-danger error-text featured_image_error"></span>
                    </div>
                    <div class="d-block mb-3" style="max-width:250px;">
                        <img src="" alt="" class="img-thumbnail" id="image-previewer" data-ijabo-default-img="">
                    </div>
                    <div class="form-group">
                        <label for=""><b>Tags</b></label>
                        <input type="text" class="form-control" placeholder="Enter tag" name="tags" data-role="tagsinput" id="tags">
                        <span class="text-danger error-text tags_error"></span>
                    </div>
                    <hr>
                    <div class="form-group">
                        <label for=""><b>Visibility</b></label>
                        <div class="custom-control custom-radio mb-5">
                            <input type="radio" name="visibility" id="customRadio1" class="custom-control-input" value="1" checked>
                            <label for="customRadio1" class="custom-control-label">Public</label>
                        </div>
                        <div class="custom-control custom-radio mb-5">
                            <input type="radio" name="visibility" id="customRadio2" class="custom-control-input" value="0">
                            <label for="customRadio2" class="custom-control-label">Private</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="mb-3">
        <button type="submit" class="btn btn-primary">Create post</button>
    </div>
</form>

<?= $this->endSection() ?>
<?= $this->section('stylesheets') ?>
<link rel="stylesheet" href="/backend/src/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css">
<?= $this->endSection() ?>
<?= $this->section('scripts') ?>
<script src="/backend/src/plugins/bootstrap-tagsinput/bootstrap-tagsinput.js"></script>
<script src="/extra-assets/ckeditor/ckeditor.js"></script>
<script>
    // $('input#tags').on('change',function(){
    //     var tags=$('input#tags').val();
    //     var changeTags =tags.replace(',' , '/n,' );
    //     $('input#tags').val(changeTags);
    // });
    // $('input[type="file"][name="featured_image"]').ijaboViewer({
    //     preview: '#image-previewer',
    //     imageShape: 'rectangular',
    //     allowedExtensions:['jpg','png','jpeg'],
    //     onErrorShape:function(msg,element){
    //         alert(msg);
    //     },
    //     onInvalidType:function(msg, element){
    //         alert(msg);
    //     }
    // });
    $(function(){
        var elfinderPath = '/extra-assets/elFinder/elfinder.src.php?integration=ckeditor&uid=<?= CIAuth::id() ?>';

        CKEDITOR.replace('content',{
            filebrowserBrowseURL:elfinderPath,
            filebrowserImageBrowseUrl:elfinderPath+'&type=image',
            removeDialogTabs: 'link:upload;image:upload'
        });
    });

    $(document).ready(function () {
        // 파일 입력란 변경 시
        $('input[name="featured_image"]').change(function (e) {
            // 선택된 파일 가져오기
            var file = e.target.files[0];

            if (file) {
                // 지원하는 파일 형식 확인
                var allowedTypes = ['image/jpeg', 'image/png', 'image/jpg'];
                if (allowedTypes.indexOf(file.type) === -1) {
                    // alert('지원하지 않는 파일 형식입니다. jpg, png, jpeg 파일을 업로드하세요.');
                    toastr.error('지원하지 않는 파일 형식입니다. jpg, png, jpeg 파일을 업로드하세요.');
                    $('input[name="featured_image"]').val('');
                    return;
                }

                // FileReader를 사용하여 이미지 읽기
                var reader = new FileReader();

                reader.onload = function (e) {
                    // 미리보기 이미지 업데이트
                    $('#image-previewer').attr('src', e.target.result);
                };

                // 이미지를 Data URL로 읽기
                reader.readAsDataURL(file);
            }
        });
    });

    $('#addPostForm').on('submit',function(e){
        e.preventDefault();
        var csrfName = $('.ci_csrf_data').attr('name');
        var csrfHash = $('.ci_csrf_data').val();
        
        var form = this;
        var content = CKEDITOR.instances.content.getData();
        var formdata = new FormData(form);
            formdata.append(csrfName,csrfHash);
            formdata.append('content',content);
        
        $.ajax({
            url: $(form).attr('action'),
            method: $(form).attr('method'),
            data:formdata,
            processData:false,
            dataType:'json',
            contentType:false,
            cache:false,
            beforeSend:function(){
                toastr.remove();
                $(form).find('span.error-text').text('');
            },
            success:function(res){
                $('.ci_csrf_data').val(res.token);

                if($.isEmptyObject(res.error)){
                    console.log(res);
                    if(res.status ==1 ){
                        $(form)[0].reset();
                        CKEDITOR.instances.content.setData('');
                        $('img#image-previewer').attr('src','');
                        $('input[name="tags"]').tagsinput('removeAll');
                        toastr.success(res.msg);
                    }else{
                        toastr.error(res.msg);
                    }
                }else{
                    $.each(res.error , function(prefix, val){
                        $(form).find('span.'+prefix+'_error').text(val);
                    });
                }

            }
        });
        
    });

</script>
<?= $this->endSection() ?>