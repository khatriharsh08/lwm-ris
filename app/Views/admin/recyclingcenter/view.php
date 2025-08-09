<?= $this->extend('admin/layout') ?>
<?= $this->section('content') ?>
<?= $this->include('admin/messages') ?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Recycling Centers</h1>
    <div>
        <a href="javascript:void(0);" id="searchToggleBtn" class="btn btn-sm btn-primary shadow-sm mr-2">
            <i class="fas fa-search fa-sm text-white-50"></i> Search
        </a>
        <button type="button" id="openAddCenterModal" class="btn btn-sm btn-success shadow-sm">
            <i class="fas fa-plus fa-sm text-white-50"></i> Add Center
        </button>
    </div>
</div>

<div class="card mb-4" id="searchFormContainer" style="display: none;">
    <div class="card-body">
        <form method="post" action="<?= base_url('/recyclingcenter') ?>">
            <div class="form-row align-items-center">
    
                <div class="col-md-3 mb-2">
                    <div class="text-xs font-weight-bold text-uppercase mb-1">Center Name</div>
                   <input type="text" name="name" class="form-control" placeholder="Center Name" value="<?= esc($name ?? '') ?>">                
                </div>

                <div class="col-md-3 mb-2">
                    <div class="text-xs font-weight-bold text-uppercase mb-1">City</div>
                    <input type="text" name="city" class="form-control" placeholder="City" value="<?= esc($city?? '') ?>">
                </div>
                
                <div class="col-md-3 mb-2">
                    <div class="text-xs font-weight-bold text-uppercase mb-1">Postal Code</div>
                    <input type="text" inputmode="numeric" pattern="[0-9]*" name="postal_code" class="form-control" placeholder="Postal Code" value="<?= esc($postal_code ?? '') ?>">
                </div>
                
                <div class="col-md-3 mb-2 text-right">
                    <button type="submit" class="btn btn-primary">Search</button>
                    <a href="<?= base_url('/recyclingcenter') ?>" class="btn btn-danger">Cancel</a>
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
                        <th>City</th>
                        <th>State</th>
                        <th>Postal Code</th>
                        <th>Phone</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($centers)): ?>
                        <?php $i = 1; foreach($centers as $center): ?>
                        <tr>
                            <td><?= $i++ ?></td>
                            <td><?= esc($center['name']) ?></td>
                            <td><?= esc($center['city']) ?></td>
                            <td><?= esc($center['state']) ?></td>
                            <td><?= esc($center['postal_code']) ?></td>
                            <td><?= esc($center['phone_number']) ?></td>
                            <td>
                                <a href="<?= base_url('recyclingcenter/edit/'.$center['id'])?>" class="btn btn-sm btn-primary">Edit</a>
                                <a href="<?= base_url('recyclingcenter/delete/'.$center['id'])?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this center?');">Delete</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="text-center">No recycling centers found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="<?= base_url('admin/assets/vendor/jquery/jquery.min.js') ?>"></script>
<script src="<?= base_url('admin/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>


<script>
    $(document).ready(function() {
        $('#searchToggleBtn').click(function() {
            $('#searchFormContainer').slideToggle();
        });
    });

    $(document).ready(function() {
        $('#openAddCenterModal').click(function() {
            $.ajax({
                url: '<?= site_url('/recyclingcenter/create') ?>',
                method: 'GET',
                success: function(response) {
                    if ($('#addCenterModal').length === 0) {
                        $('body').append(response);
                    }
                    $('#addCenterModal').modal('show');
                }
            });
        });
    });

</script>
<?= $this->endSection() ?>
