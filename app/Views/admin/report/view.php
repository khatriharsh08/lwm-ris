<?= $this->extend('admin/layout') ?>
<?= $this->section('content') ?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">
        <i class="fas fa-file-pdf text-danger mr-2"></i>Generate Reports
    </h1>
</div>

<!-- Report Options Cards -->
<div class="row">
    <!-- Full System Report -->
    <div class="col-xl-4 col-lg-6 mb-4">
        <div class="card border-0 shadow-lg h-100 report-card">
            <div class="card-body text-center p-4">
                <div class="report-icon bg-gradient-primary mb-3">
                    <i class="fas fa-chart-bar fa-2x text-white"></i>
                </div>
                <h5 class="font-weight-bold text-gray-800">Full System Report</h5>
                <p class="text-muted small mb-3">Complete system overview including all events, recycling centers, and contact messages.</p>
                <ul class="list-unstyled text-left small mb-4">
                    <li class="py-1"><i class="fas fa-check-circle text-success mr-2"></i>Dashboard Summary</li>
                    <li class="py-1"><i class="fas fa-check-circle text-success mr-2"></i>All Events & Seminars</li>
                    <li class="py-1"><i class="fas fa-check-circle text-success mr-2"></i>All Recycling Centers</li>
                    <li class="py-1"><i class="fas fa-check-circle text-success mr-2"></i>Contact Messages</li>
                </ul>
                <a href="<?= base_url('report/generate') ?>" class="btn btn-primary btn-block">
                    <i class="fas fa-download mr-2"></i>Generate PDF
                </a>
            </div>
        </div>
    </div>

    <!-- Events Report -->
    <div class="col-xl-4 col-lg-6 mb-4">
        <div class="card border-0 shadow-lg h-100 report-card">
            <div class="card-body text-center p-4">
                <div class="report-icon bg-gradient-success mb-3">
                    <i class="fas fa-calendar-alt fa-2x text-white"></i>
                </div>
                <h5 class="font-weight-bold text-gray-800">Events Report</h5>
                <p class="text-muted small mb-3">Detailed report of all events and seminars with dates, venues, and status.</p>
                <ul class="list-unstyled text-left small mb-4">
                    <li class="py-1"><i class="fas fa-check-circle text-success mr-2"></i>Event Statistics</li>
                    <li class="py-1"><i class="fas fa-check-circle text-success mr-2"></i>Upcoming Events</li>
                    <li class="py-1"><i class="fas fa-check-circle text-success mr-2"></i>Completed Events</li>
                    <li class="py-1"><i class="fas fa-check-circle text-success mr-2"></i>Event Timeline</li>
                </ul>
                <a href="<?= base_url('report/events') ?>" class="btn btn-success btn-block">
                    <i class="fas fa-download mr-2"></i>Generate PDF
                </a>
            </div>
        </div>
    </div>

    <!-- Recycling Centers Report -->
    <div class="col-xl-4 col-lg-6 mb-4">
        <div class="card border-0 shadow-lg h-100 report-card">
            <div class="card-body text-center p-4">
                <div class="report-icon bg-gradient-info mb-3">
                    <i class="fas fa-recycle fa-2x text-white"></i>
                </div>
                <h5 class="font-weight-bold text-gray-800">Centers Report</h5>
                <p class="text-muted small mb-3">Complete list of recycling centers with locations and contact information.</p>
                <ul class="list-unstyled text-left small mb-4">
                    <li class="py-1"><i class="fas fa-check-circle text-success mr-2"></i>Center Statistics</li>
                    <li class="py-1"><i class="fas fa-check-circle text-success mr-2"></i>Location Details</li>
                    <li class="py-1"><i class="fas fa-check-circle text-success mr-2"></i>Contact Information</li>
                    <li class="py-1"><i class="fas fa-check-circle text-success mr-2"></i>Waste Categories</li>
                </ul>
                <a href="<?= base_url('report/centers') ?>" class="btn btn-info btn-block">
                    <i class="fas fa-download mr-2"></i>Generate PDF
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Report Summary Stats -->
<div class="row">
    <div class="col-12">
        <div class="card shadow-lg border-0">
            <div class="card-header py-3 bg-gradient-dark text-white">
                <h6 class="m-0 font-weight-bold">
                    <i class="fas fa-chart-pie mr-2"></i>Report Data Summary
                </h6>
            </div>
            <div class="card-body">
                <div class="row text-center">
                    <div class="col-md-3 col-6 mb-3">
                        <div class="py-3">
                            <div class="h1 font-weight-bold text-primary"><?= $waste_count ?? 0 ?></div>
                            <div class="text-muted small text-uppercase">Waste Categories</div>
                        </div>
                    </div>
                    <div class="col-md-3 col-6 mb-3">
                        <div class="py-3">
                            <div class="h1 font-weight-bold text-success"><?= $center_count ?? 0 ?></div>
                            <div class="text-muted small text-uppercase">Recycling Centers</div>
                        </div>
                    </div>
                    <div class="col-md-3 col-6 mb-3">
                        <div class="py-3">
                            <div class="h1 font-weight-bold text-info"><?= $event_count ?? 0 ?></div>
                            <div class="text-muted small text-uppercase">Total Events</div>
                        </div>
                    </div>
                    <div class="col-md-3 col-6 mb-3">
                        <div class="py-3">
                            <div class="h1 font-weight-bold text-warning"><?= $message_count ?? 0 ?></div>
                            <div class="text-muted small text-uppercase">Contact Messages</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Recent Activity Preview -->
<div class="row mt-4">
    <div class="col-lg-6 mb-4">
        <div class="card shadow-lg border-0 h-100">
            <div class="card-header py-3 bg-gradient-success text-white">
                <h6 class="m-0 font-weight-bold">
                    <i class="fas fa-calendar-check mr-2"></i>Recent Events
                </h6>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th>Event</th>
                                <th>Date</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($recent_events)): ?>
                                <?php foreach (array_slice($recent_events, 0, 5) as $event): ?>
                                <tr>
                                    <td class="font-weight-bold"><?= esc($event['title']) ?></td>
                                    <td><?= date('M d, Y', strtotime($event['date'])) ?></td>
                                    <td>
                                        <?php if (strtotime($event['date']) > time()): ?>
                                            <span class="badge badge-success">Upcoming</span>
                                        <?php else: ?>
                                            <span class="badge badge-secondary">Completed</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr><td colspan="3" class="text-center text-muted">No events found</td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-6 mb-4">
        <div class="card shadow-lg border-0 h-100">
            <div class="card-header py-3 bg-gradient-info text-white">
                <h6 class="m-0 font-weight-bold">
                    <i class="fas fa-recycle mr-2"></i>Recent Centers
                </h6>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th>Center Name</th>
                                <th>City</th>
                                <th>State</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($recent_centers)): ?>
                                <?php foreach (array_slice($recent_centers, 0, 5) as $center): ?>
                                <tr>
                                    <td class="font-weight-bold"><?= esc($center['name']) ?></td>
                                    <td><?= esc($center['city']) ?></td>
                                    <td><?= esc($center['state']) ?></td>
                                </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr><td colspan="3" class="text-center text-muted">No centers found</td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.report-card {
    transition: all 0.3s ease;
    border-radius: 15px;
    overflow: hidden;
}

.report-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 15px 40px rgba(0,0,0,0.15) !important;
}

.report-icon {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto;
}

.bg-gradient-primary {
    background: linear-gradient(135deg, #4e73df, #224abe);
}

.bg-gradient-success {
    background: linear-gradient(135deg, #1cc88a, #13855c);
}

.bg-gradient-info {
    background: linear-gradient(135deg, #36b9cc, #258391);
}

.bg-gradient-dark {
    background: linear-gradient(135deg, #5a5c69, #373840);
}

.card {
    border-radius: 15px;
}

.card-header {
    border-radius: 15px 15px 0 0 !important;
}

.btn-block {
    border-radius: 25px;
    padding: 10px 20px;
    font-weight: 600;
}

.table th {
    border-top: none;
    font-size: 0.8rem;
    text-transform: uppercase;
    color: #858796;
}

.badge {
    padding: 5px 10px;
    border-radius: 20px;
    font-weight: 500;
}
</style>

<?= $this->endSection() ?>
