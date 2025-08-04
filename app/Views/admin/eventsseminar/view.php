<?= $this->extend('admin/layout') ?>
<?= $this->section('content') ?>
<?= $this->include('admin/messages') ?>
<!-- Content Row -->
                    <div class="row">

                        <!-- Completed Events Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Completed Events</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_completed_events; ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-fw fa-check-circle fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Upcoming Events Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Upcoming Events</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_upcoming_events; ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-fw fa-clock fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Total Events Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                                Total Events</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_events; ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-fw fa-thumbtack fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> 

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Events</h1>
    <div>
        <a href="javascript:void(0);" id="searchToggleBtn" class="btn btn-sm btn-primary shadow-sm mr-2">
            <i class="fas fa-search fa-sm text-white-50"></i> Search
        </a>
        <button type="button" id="openAddEventModal" class="btn btn-sm btn-success shadow-sm">
            <i class="fas fa-plus fa-sm text-white-50"></i> Add Event
        </button>
    </div>
</div>

<div class="card mb-4" id="searchFormContainer" style="display: none;">
    <div class="card-body">
        <form method="post" action="<?= base_url('/eventsseminar') ?>">
            <div class="form-row align-items-center">
    
                <div class="col-md-3 mb-2">
                    <div class="text-xs font-weight-bold text-uppercase mb-1">Event Title</div>
                   <input type="text" name="title" class="form-control" placeholder="Event Title" value="<?= esc($title ?? '') ?>">                
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
                    <a href="<?= base_url('/eventsseminar') ?>" class="btn btn-danger">Cancel</a>
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
                        <th>Poster</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Date</th>
                        <th>Venue</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($events)): ?>
                        <?php $i = 1; foreach($events as $event): ?>
                        <tr>
                            <td><?= $i++ ?></td>
                            <td>
                                <?php if (!empty($event['poster_image'])): ?>
                                    <img src="<?= base_url('uploads/events/' . $event['poster_image']) ?>" alt="<?= esc($event['title']) ?>" width="100">
                                <?php endif; ?>
                            </td>
                            <td><?= esc($event['title']) ?></td>
                            <td><?= esc($event['description']) ?></td>
                            <td><?= esc(date('M d, Y h:i A', strtotime($event['date']))) ?></td>
                            <td><?= esc($event['venue']) ?></td>
                            <td>
                                <a href="<?= base_url('eventsseminar/edit/'.$event['id'])?>" class="btn btn-sm btn-primary">Edit</a>
                                <a href="<?= base_url('eventsseminar/delete/'.$event['id'])?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this event?');">Delete</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="text-center">No events found.</td>
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
        $('#openAddEventModal').click(function() {
            $.ajax({
                url: '<?= site_url('eventsseminar/create') ?>',
                method: 'GET',
                success: function(response) {
                    if ($('#addEventModal').length === 0) {
                        $('body').append(response);
                    }
                    $('#addEventModal').modal('show');
                },
            });
        });
    });

</script>
<?= $this->endSection() ?>
