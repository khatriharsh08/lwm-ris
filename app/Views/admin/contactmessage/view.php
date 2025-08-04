<?= $this->extend('admin/layout') ?>
<?= $this->section('content') ?>
<?= $this->include('admin/messages') ?>

                    <!-- Content Row -->
                    <div class="row">

                        <!-- New Messages Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                New Messages</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_new_messages; ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-fw fa-envelope-open fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Pending Messages Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Pending Messages</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_pending_messages; ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-fw fa-envelope-open fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Done Messages Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Done Messages</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_done_messages; ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-fw fa-envelope fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Total Messages Card Example -->
                         <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                                Total Messages</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_messages; ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-fw fa-envelope fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> 

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Contact Messages</h1>
    <div>
        <a href="javascript:void(0);" id="searchToggleBtn" class="btn btn-sm btn-primary shadow-sm mr-2">
            <i class="fas fa-search fa-sm text-white-50"></i> Search
        </a>
    </div>
</div>

<div class="card mb-4" id="searchFormContainer" style="display: none;">
    <div class="card-body">
        <form method="post" action="<?= base_url('/contactmessage') ?>">
            <div class="form-row align-items-center">
    
                <div class="col-md-3 mb-2">
                    <div class="text-xs font-weight-bold text-uppercase mb-1">Select Status</div>
                    <select name="status" class="form-control">
                        <option value="">Select Status</option>
                        <option value="new" <?= ($status ?? '') === 'new' ? 'selected' : '' ?>>New</option>
                        <option value="pending" <?= ($status ?? '') === 'pending' ? 'selected' : '' ?>>Pending</option>
                        <option value="done" <?= ($status ?? '') === 'done' ? 'selected' : '' ?>>Done</option>
                    </select>
                </div>

                <div class="col-md-3 mb-2">
                    <div class="text-xs font-weight-bold text-uppercase mb-1">From</div>
                    <input type="date" name="start_date" class="form-control" value="<?= @$start_date ?>">
                </div>
                
                <div class="col-md-3 mb-2">
                    <div class="text-xs font-weight-bold text-uppercase mb-1">To</div>
                    <input type="date" name="end_date" class="form-control" value="<?= @$end_date ?>">
                </div>
                
                <div class="col-md-3 mb-2 text-right">
                    <button type="submit" class="btn btn-primary">Search</button>
                    <a href="<?= base_url('/contactmessage') ?>" class="btn btn-danger">Cancel</a>
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
                        <th>Email</th>
                        <th>Subject</th>
                        <th>Message</th>
                        <th>Status</th>
                        <th>Submitted At</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($contactmessages)): ?>
                        <?php $i = 1; foreach($contactmessages as $message): ?>
                        <tr class="<?= $message['status'] == 'pending' || $message['status'] == 'new' ? 'font-weight-bold' : '' ?>">
                            <td><?= $i++ ?></td>
                            <td><?= esc($message['name']) ?></td>
                            <td><?= esc($message['email']) ?></td>
                            <td><?= esc($message['subject']) ?></td>
                            <td><?= esc($message['message']) ?></td>
                            <td>
                                <?php if ($message['status'] == 'new'): ?>
                                    <a href="<?= site_url('contactmessage/setStatus/' . $message['id'] . '/done') ?>" class="btn btn-success btn-sm">New</a>
                                <?php elseif ($message['status'] == 'pending'): ?>
                                    <a href="<?= site_url('contactmessage/setStatus/' . $message['id'] . '/done') ?>" class="btn btn-success btn-sm">Pending</a>
                                <?php else: ?>
                                    <a href="<?= site_url('contactmessage/setStatus/' . $message['id'] . '/pending') ?>" class="btn btn-secondary btn-sm">Done</a>
                                <?php endif; ?>
                            </td>
                            <td><?= esc(date('M d, Y h:i A', strtotime($message['submitted_at']))) ?></td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7" class="text-center">No contact messages found.</td>
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
</script>

<?= $this->endSection() ?>