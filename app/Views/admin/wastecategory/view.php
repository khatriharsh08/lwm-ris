<?= $this->extend('admin/layout') ?>
<?= $this->section('content') ?>
<?= $this->include('admin/messages') ?>


<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Waste Categories</h1>
    <div>
        <a href="javascript:void(0);" id="searchToggleBtn" class="btn btn-sm btn-primary shadow-sm mr-2">
            <i class="fas fa-search fa-sm text-white-50"></i> Search
        </a>
        <button type="button" id="openAddCategoryModal" class="btn btn-sm btn-success shadow-sm">
            <i class="fas fa-plus fa-sm text-white-50"></i> Add Category
        </button>

    </div>
</div>

<div class="card mb-4" id="searchFormContainer" style="display: none;">
    <div class="card-body">
        <form method="post" action="<?= base_url('/wastecategory') ?>">
            <div class="form-row align-items-center">
    
                <div class="col-md-3 mb-2">
                    <div class="text-xs font-weight-bold text-uppercase mb-1">Category Name</div>
                    <input type="text" name="name" class="form-control" placeholder="Category Name" value="<?= esc($name ?? '') ?>">                
                </div>

                <div class="col-md-3 mb-2">
                    <div class="text-xs font-weight-bold text-uppercase mb-1">From</div>
                    <input type="date" name="start_date" class="form-control" placeholder="From" value="<?= @$start_date ?>">
                </div>
                
                <div class="col-md-3 mb-2">
                    <div class="text-xs font-weight-bold text-uppercase mb-1">To</div>
                    <input type="date" name="end_date" class="form-control" placeholder="To" value="<?= @$end_date ?>">
                </div>
                
                <div class="col-md-3 mb-2 text-right">
                    <button type="submit" class="btn btn-primary">Search</button>
                    <a href="<?= base_url('/wastecategory') ?>" class="btn btn-danger">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</div>


<div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i= 1; foreach($wastecategory as $cate): ?>
                        <tr>
                            <td><?= $i++ ?></td>
                            <td><?= $cate['name'] ?></td>
                            <td>
                                <a href="<?= base_url('wastecategory/edit/'.$cate['id'])?>" class="btn btn-sm btn-primary">Edit</a>
                                <a href="<?= base_url('wastecategory/delete/'.$cate['id'])?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this center?');">Delete</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
</div>

<script>
    $(document).ready(function() {
        $('#searchToggleBtn').click(function() {
            $('#searchFormContainer').slideToggle();
        });
    });
    
    $(document).ready(function() {
    $('#openAddCategoryModal').click(function() {
        $.ajax({
            url: '<?= base_url('/wastecategory/add') ?>',
            method: 'GET',
            success: function(response) {
                if ($('#addCategoryModal').length === 0) {
                    $('body').append(response);
                }
                $('#addCategoryModal').modal('show');
            }
        });
    });
});

</script>
<?= $this->endSection() ?>