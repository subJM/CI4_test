<?= $this->extend('backend/layout/pages-layout'); ?>
<?= $this->section('content') ?>


<div class="page-header">
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="title">
                <h4>Categories</h4>
            </div>
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="<?= route_to('categories')?>">Home</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Categories
                    </li>
                </ol>
            </nav>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12 mb-4">
        <div class="card card-box">
            <div class="card-header">
                <div class="clearfix">
                    <div class="pull-left">
                        Categories
                    </div>
                    <div class="pull-right">
                        <a href="" class="btn btn-default btn-sm p-0" role="botton" id="add_category_btn">
                            <i class="fa fa-plus-circle">Add category</i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-sm table-borderless table-hover table-striped" id="categories-table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Category name</th>
                            <th scope="col">N. of sub categories</th>
                            <th scope="col">Action</th>
                            <th scope="col">Ordering</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-12 mb-4">
        <div class="card card-box">
            <div class="card-header">
                <div class="clearfix">
                    <div class="pull-left">
                        Sub categories
                    </div>
                    <div class="pull-right">
                        <a href="" class="btn btn-default btn-sm p-0" role="botton" id="add_sub_category_btn">
                            <i class="fa fa-plus-circle">Add sub category</i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-sm table-borderless table-hover table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Sub categories name</th>
                            <th scope="col">Parent category</th>
                            <th scope="col">N. of post(s)</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td scope="col">1</td>
                            <td>-----</td>
                            <td>-----</td>
                            <td>-----</td>
                            <td>-----</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

<?php include('modals/category-modal-form.php')?>
<?php include('modals/edit-category-modal-form.php')?>

<?= $this->endSection() ?>
<?= $this->section('stylesheets')?>
    <link rel="stylesheet" href="/backend/src/plugins/datatables/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="/backend/src/plugins/datatables/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="/extra-assets/jquery-ui-1.13.2/jquery-ui.min.css">
    <link rel="stylesheet" href="/extra-assets/jquery-ui-1.13.2/jquery-ui.structure.min.css">
    <link rel="stylesheet" href="/extra-assets/jquery-ui-1.13.2/jquery-ui.theme.min.css">
<?= $this->endSection()?>
<?= $this->section('scripts')?>
<script src="/backend/src/plugins/datatables/js/jquery.dataTables.min.js"></script>
<script src="/backend/src/plugins/datatables/js/dataTables.bootstrap4.min.js"></script>
<script src="/backend/src/plugins/datatables/js/dataTables.responsive.min.js"></script>
<script src="/backend/src/plugins/datatables/js/responsive.bootstrap4.min.js"></script>
<script src="/extra-assets/jquery-ui-1.13.2/jquery-ui.min.js"></script>

<script>
    $(document).on('click', '#add_category_btn',function(e){
        e.preventDefault();
        var modal = $('body').find('div#category-modal');
        var modal_title = 'Add Category';
        var modal_btn_text = 'ADD';
        modal.find('.modal-title').html(modal_title);
        modal.find('modal-footer > button.action').html(modal_btn_text);
        modal.find('input.error-text').html('');
        modal.find('input[type="text"]').val('');
        modal.modal('show');
    });

    $('#add_category_form').on('submit', function(e){
        e.preventDefault();
        var csrfName = $('.ci_csrf_data').attr('name');
        var csrfHash = $('.ci_csrf_data').val();
        var form = this;
        var modal = $('body').find('div#category-modal');
        var formdata = new FormData(form);
            formdata.append(csrfName, csrfHash);
            
            $.ajax({
                url:$(form).attr('action'),
                method: $(form).attr('method'),
                data:formdata,
                processData:false,
                dataType: 'json',
                contentType: false,
                cache:false,
                beforeSend:function(){
                    toastr.remove();
                    $(form).find('span.error-text').text('');
                },
                success:function(res){
                    $('.ci_csrf_data').val(res.token);
                    if($.isEmptyObject(res.error)){
                        if(res.status ==1){
                            $(form)[0].reset();
                            modal.modal('hide');
                            categories_DT.ajax.reload(null,false);
                            toastr.success(res.msg);
                        }else{
                            toastr.error(res.msg);
                        }
                    }else{
                        $.each(res.error , function(prefix,val){
                            $(form).find('span.'+prefix+'_error').text(val);
                        })
                    }

                    
                }

            });
    })
    //Retrieve categories
    var categories_DT = $('#categories-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "<?= route_to('get-categories') ?>",
        dom: "Brtip",
        info: true,
        fnCreatedRow: function(row,data,index){
            $('td',row).eq(0).html(index+1);
            // console.log(data);
            $('td', row).parent().attr('data-index',data[0]).attr('data-ordering', data[4]);
        },
        columnDefs:[
            { orderable:false, targets:[0,1,2,3]},
            { visible:false, targets:4},
        ],
        order:[[4,'aes']]
    });

    $(document).on('click', '.editCategoryBtn' , function(e){
        e.preventDefault();
        var category_id = $(this).data('id');
        var url = "<?= route_to('get-category')?>";
        $.get(url,{category_id:category_id }, function(res){
            var modal_title = 'Edit category';
            var modal_btn_text = 'Save changes';
            var modal = $('body').find('div#edit-category-modal');
            modal.find('form').find('input[type="hidden"][name="category_id"]').val(category_id);
            modal.find('modal-title').html(modal_title);
            modal.find('modal-footer > button.action').html(modal_btn_text);
            modal.find('input[type="text"]').val(res.data.name);
            modal.find('span.error-text').html('');
            modal.modal('show');
        },'json');
    });

    $('#update_category_form').on('submit',function(e){
        e.preventDefault();
        //CSRF
        var csrfName = $('.ci_csrf_data').attr('name');
        var csrfHash = $('.cicsrf_data').val();
        var form = this;
        var modal = $('body').find('div#edit-category-modal');
        var formdata = new FormData(form);
            form.append(csrfName,csrfHash);
        
        $.ajax({
            url:$(form).attr('action'),
            method:$(form).attr('method'),
            data:formdata,
            processData: false,
            dataType: 'json',
            contentType:false,
            cache: false,
            beforeSend: function(){
                toastr.remove();
                $(form).find('span.error-text').text('');
            },
            success: function(res){
                //Update CSRF Hash
                $('.ci_csrf_hash').val(res.token);

                if($.isEmptyObject(res.error)){
                    if(res.status == 1){
                        modal.modal('hide');
                        toastr.success(res.msg);
                        categories_DT.ajax.reload(null, false); //update datatable
                    }else{
                        toastr.error(res.msg);
                    }
                }else{
                    $.each(res.error, function(prefix,val){
                        $form.find('span.'+prefix+'_error').text(val);
                    })
                }

            }

        });

    })

    $(document).on('click', '.deleteCategoryBtn', function(e){
        e.preventDefault();
        var category_id = $(this).data('id');
        var url = "<?= route_to('delete-category') ?>";
        swal.fire({
            title: 'ara you sure?',
            html: 'You want to delete this category',
            showCloseButten: true,
            showCancelButton:true,
            cancelButtonText:'Cancel',
            confirmButtonText:'Yes, Delect',
            cancelButtonColor: '#d33',
            confirmButtonColor: '#3085d6',
            width:300,
            allowOutsideClick:false
        }).then(function(result){
            if(result.value){
                $.get(url,{category_id: category_id},function(res){
                    if(res.status ==1){
                        categories_DT.ajax.reload(null,false);
                        toastr.success(res.msg);
                    }else{
                        toastr.error(res.msg);
                    }
                },'json');
            }
        });
    });

    $('table#categories-table').find('tbody').sortable({
        update: function(event, ui){
            $(this).children().each(function(index){
                if($(this).attr('data-ordering') != (index+1)){
                    $(this).attr('data-ordering', (index+1)).addClass('updated');
                }
            });
            var positions = [];

            $('.updated').each(function(){
                positions.push([$(this).data('index'), $(this).data('ordering')]); 
                $(this).removeClass('updated');
            });

            var url = "<?= route_to('reorder-categories') ?>";
            $.get(url, {positions:positions}, function(res){
                if(res.status == 1){
                    categories_DT.ajax.reload(null, false);
                    toastr.success(res.msg);
                }
            },'json');
        }
    });

</script>
<?= $this->endSection()?>