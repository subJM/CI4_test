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
                <table class="table table-sm table-borderless table-hover table-striped">
                    <thead>
                        <tr>
                            <td scope="col">#</td>
                            <td scope="col">Category name</td>
                            <td scope="col">N. of sub categories</td>
                            <td scope="col">Action</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>


                            <td scope="row">1</td>
                            <td>-------</td>
                            <td>-------</td>
                            <td>-------</td>
                        </tr>
                    </tbody>
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
                        <a href="" class="btn btn-default btn-sm p-0" role="botton" id="sub_add_category_btn">
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

<?= $this->endSection() ?>


<?= $this->section('scripts')?>
<script>
    $(document).on('click', '#add_category_btn',function(e){
        e.preventDefault();
        var modal = $('body').find('div#category-modal');
        var modal_title = 'Add Category';
        var modal_btn_text = 'ADD';
        modal.find('.modal-title').html(modal_title);
        modal.find('modal-footer > button.action').html(modal_btn_text);
        modal.find('input.error-text').html();
        modal.find('input[type="text"]').val('');
        modal.modal('show');
    });
</script>
<?= $this->endSection()?>