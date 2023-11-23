<?= $this->extend('backend/layout/pages-layout'); ?>
<?= $this->section('content') ?>

<div class="page-header">
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="title">
                <h4><?= $pageTitle?></h4>
            </div>
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="index.html">Home</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        <?= $pageTitle?>
                    </li>
                </ol>
            </nav>
        </div>
    </div>
</div>

<div class="pd-20 card-box mb-4">
    <div class="tab">
        <ul class="nav nav-tabs customtab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#general_setting" role="tab" aria-selected="true">General setting</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#logo_favicon" role="tab" aria-selected="false">Logo & Favicon</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#social_media" role="tab" aria-selected="false">Social media</a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane fade show active" id="general_setting" role="tabpanel">
                <div class="pd-20">
                    <form action="<?= route_to('update-general-settings') ?>" method="POST" id="general_settings_form">
                        <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" class="ci_csrf_data">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Blog title</label>
                                    <input type="text" class="form-control" name="blog_title" placeholder="Enter blog title" value="<?= get_settings()->blog_title ?>">
                                    <span class="text-danger error-text blog_title_error"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Blog email</label>
                                    <input type="text" class="form-control" name="blog_email" placeholder="Enter blog email" value="<?= get_settings()->blog_email ?>">
                                    <span class="text-danger error-text blog_email_error"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Blog phone no</label>
                                    <input type="text" class="form-control" name="blog_phone" placeholder="Enter blog phone" value="<?= get_settings()->blog_phone ?>">
                                    <span class="text-danger error-text blog_phone_error"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Blog meta keywords</label>
                                    <input type="text" class="form-control" name="blog_meta_keywords" placeholder="Enter blog meta keywords" 
                                    value="<?= get_settings()->blog_meta_keywords ?>">
                                    <span class="text-danger error-text blog_meta_keywords_error"></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="">Blog meta description</label>
                            <textarea name="blog_meta_description" id="" cols="4" rows="3" class="form-control" placeholder="Write blog meta description" >
                            <?= get_settings()->blog_meta_description?>
                            </textarea>
                            <span class="text-danger error-text blog_meta_description_error"></span>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Save change</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="tab-pane fade" id="logo_favicon" role="tabpanel">
                <div class="pd-20">
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Set blog logo</h5>
                            <div class="mb2 mt-1" style="max-width:200px;">
                                <img src="" alt="" srcset="" class="img-thumbnail" id="logo-image-preview" data-ijabo-default-img="/images/blog/<?= get_settings()->blog_logo?>">
                            </div>
                            <form action="<?= route_to('update-blog-logo') ?>" method="post" enctype="multipart/form-data" id="changeBlogLogoForm">
                                <input type="hidden" name="<?= csrf_token()?>" value="<?= csrf_hash()?>" class="ci_csrf_data">
                                <div class="mb-2">
                                    <input type="file" name="blog_logo" id="blog_logo" class="form-control">
                                    <span class="text-danger error-text"></span>
                                </div>
                                <button type="submit" class="btn btn-primary">Change logo</button>
                            </form>
                        </div>
                        <div class="col-md-6">
                            <h5>Set blog favicon</h5>
                            <div class="mb-2 mb-1" style="max-width:100px;">
                                <img src="" alt="" srcset="" class="img-thumbnail" id="favicon-image-preview" data-ijabo-default-img="/images/blog/<?= get_settings()->blog_favicon ?>">
                            </div>
                            <form action="<?= route_to('update-blog-favicon') ?>" method="post" enctype="multipart/form-data" id="changeBlogFaviconForm">
                                <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" class="ci_csrf_data">
                                <div class="mb-2">
                                    <input type="file" name="blog_favicon" id="blog_favicon" class="form-control">
                                    <span class="text-danger error-text"></span>
                                </div>
                                <button type="submit" class="btn btn-primary">Change favicon</button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="social_media" role="tabpanel">
                <div class="pd-20">
                    <form action="<?= route_to('update-social-media') ?>" method="post" id="social_media_form">
                        <input type="hidden" name="<?= csrf_token()?>" value="<?= csrf_hash()?>">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Facebook URL</label>
                                    <input type="text" class="form-control" name="facebook_url" placeholder="Enter facebook page URL" value="<?= get_social_media()->facebook_url?>">
                                    <span class="text-danger error-text facebook_url_error"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Twitter URL</label>
                                    <input type="text" class="form-control" name="twitter_url" placeholder="Enter twitter page URL"value="<?= get_social_media()->twitter_url ?>">
                                    <span class="text-danger error-text twitter_url_error"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Instagram URL</label>
                                    <input type="text" class="form-control" name="instagram_url" placeholder="Enter instagram page URL" value="<?= get_social_media()->instagram_url?>">
                                    <span class="text-danger error-text instagram_url_error"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Youtube URL</label>
                                    <input type="text" class="form-control" name="youtube_url" placeholder="Enter youtube page URL" value="<?= get_social_media()->youtube_url?>">
                                    <span class="text-danger error-text youtube_url_error"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Github URL</label>
                                    <input type="text" class="form-control" name="github_url" placeholder="Enter github page URL" value="<?= get_social_media()->github_url?>">
                                    <span class="text-danger error-text github_url_error"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Linkedin URL</label>
                                    <input type="text" class="form-control" name="linkedin_url" placeholder="Enter linkedin page URL" value="<?= get_social_media()->linkedin_url?>">
                                    <span class="text-danger error-text linkedin_url_error"></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
<?= $this->section('scripts') ?>
<script>
    $('#general_settings_form').on('submit', function(e){
        e.preventDefault();
        //CSRF HASH
        var csrfName = $('.ci_csrf_data').attr('name'); // CSRF token name
        var csrfHash = $('.ci_csrf_data').val(); // CSRF HASH
        var form = this;
        var formdata = new FormData(form);
            formdata.append(csrfName, csrfHash);

        $.ajax({
            url: $(form).attr('action'),
            method: $(form).attr('method'),
            data:formdata,
            processData: false,
            dataType: 'json',
            contentType: false,
            cache:false,
            beforeSend: function(){
                toastr.remove();
                $(form).find('span.error-text').text('');
            },
            success: function(res){
                //update CSRF hash
                $('ci_csrf_data').val(res.token);
                if($.isEmptyObject(res.error)){
                    if(res.status == 1){
                        toastr.success(res.msg);
                    }else{
                        toastr.error(res.msg);
                    }
                }else{
                    $.each(res.error, function(prepix,val){
                        $(form).find('span.'+prepix+'_error').text(val);
                    })
                }
            }

        });
        // toastr.success('성공');
    });

    $('#changeBlogLogoForm').on('submit', function(e){
        e.preventDefault();
        var csrfName = $('ci_csrf_data').attr('name');
        var csrfHash = $('ci_csrf_data').val();
        var form = this;
        var formdata = new FormData(form);
            formdata.append(csrfName, csrfHash);
        
        var inputFileVal = $(form).find('input[type="file"][name="blog_logo"]').val();

        if(inputFileVal.length > 0){
            $.ajax({
                url: $(form).attr('action'),
                method: $(form).attr('method'),
                data:formdata,
                processData:false,
                dataType: 'json',
                contentType: false,
                beforeSend: function(){
                    toastr.remove();
                    $(form).find('span.error-text').text('');
                },
                success: function(res){
                    //UPdate CSRF hash
                    $('.ci_csrf_data').val(res.token);
                    if(res.status == 1){
                        toastr.success(res.msg);
                        $(form)[0].reset();
                    }else{
                        toastr.error(res.msg);
                    }
                }
            });

        }else{
            $(form).find('span.error-text').text('Please, select logo image file. PNG file type is recommended');
        }
    });

    $('#changeBlogFaviconForm').on('submit', function(e){
        e.preventDefault();
        var csrfName = $('ci_csrf_data').attr('name');
        var csrfHash = $('ci_csrf_data').val();
        var form = this;
        var formdata = new FormData(form);
            formdata.append(csrfName, csrfHash);
        
        var inputFileVal = $(form).find('input[type="file"][name="blog_favicon"]').val();

        if(inputFileVal.length > 0){
            $.ajax({
                url: $(form).attr('action'),
                method: $(form).attr('method'),
                data:formdata,
                processData:false,
                dataType: 'json',
                contentType: false,
                beforeSend: function(){
                    toastr.remove();
                    $(form).find('span.error-text').text('');
                },
                success: function(res){
                    //UPdate CSRF hash
                    $('.ci_csrf_data').val(res.token);
                    if(res.status == 1){
                        toastr.success(res.msg);
                        $(form)[0].reset();
                    }else{
                        toastr.error(res.msg);
                    }
                }
            });

        }else{
            $(form).find('span.error-text').text('Please, select logo image file. PNG file type is recommended');
        }
    });

    //소셜미디어 업데이트
    $('#social_media_form').on('submit',function(e){
        e.preventDefault();

        var csrfName = $('ci_csrf_data').attr('name');
        var csrfHash = $('ci_csrf_data').val();
        var form = this;
        var formdata = new FormData(form);
            formdata.append(csrfName, csrfHash);
        
        $.ajax({
            url: $(form).attr('action'),
            method: $(form).attr('method'),
            data:formdata,
            processData:false,
            dataType: 'json',
            contentType: false,
            cache:false,
            beforeSend: function(){
                toastr.remove();
                $(form).find('span.error-text').text('');
            },
            success: function(res){
                //UPdate CSRF hash
                $('.ci_csrf_data').val(res.token);
                
                if($.isEmptyObject(res.error)){
                    if(res.status == 1){
                        toastr.success(res.msg);
                    }else{
                        toastr.error(res.msg);
                    }
                }else{
                    $.each(res.error, function(prefix, val){
                        $(form).find('span.'+prefix+'_error').text(val);
                    });
                }
            }
        });
    });

    //미리보기
    $('input[type="file"][name="blog_logo"]').change(function(){
        preview('blog_logo','logo-image-preview');
    });
    
    //미리보기
    $('input[type="file"][name="blog_favicon"]').change(function(){
        preview('blog_favicon','favicon-image-preview');
    });

    function preview(inputId,previewId){
        var input = document.getElementById(inputId);
        var preview = document.getElementById(previewId);
        
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                preview.src = e.target.result;
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

</script>

<?= $this->endSection() ?>