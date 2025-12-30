<?= $this->extend('admin/layout') ?>
<?= $this->section('content') ?>
<?= $this->include('admin/messages') ?>

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?= $page_title ?? 'Activity Logs' ?></h1>
</div>

<!-- Filters Card -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Filter Logs</h6>
    </div>
    <div class="card-body">
        <form method="GET" action="<?= site_url('activitylog') ?>">
            <div class="row">
                <div class="col-md-2 mb-2">
                    <label class="small text-muted">Module</label>
                    <select name="module" class="form-control form-control-sm">
                        <option value="">All Modules</option>
                        <?php foreach ($modules as $m): ?>
                            <option value="<?= esc($m['module']) ?>" <?= ($filters['module'] == $m['module']) ? 'selected' : '' ?>>
                                <?= ucfirst(esc($m['module'])) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-2 mb-2">
                    <label class="small text-muted">Action</label>
                    <select name="action" class="form-control form-control-sm">
                        <option value="">All Actions</option>
                        <option value="create" <?= ($filters['action'] == 'create') ? 'selected' : '' ?>>Create</option>
                        <option value="update" <?= ($filters['action'] == 'update') ? 'selected' : '' ?>>Update</option>
                        <option value="delete" <?= ($filters['action'] == 'delete') ? 'selected' : '' ?>>Delete</option>
                        <option value="status_change" <?= ($filters['action'] == 'status_change') ? 'selected' : '' ?>>Status Change</option>
                    </select>
                </div>
                <div class="col-md-2 mb-2">
                    <label class="small text-muted">User</label>
                    <select name="user_id" class="form-control form-control-sm">
                        <option value="">All Users</option>
                        <?php foreach ($users as $u): ?>
                            <option value="<?= $u['id'] ?>" <?= ($filters['user_id'] == $u['id']) ? 'selected' : '' ?>>
                                <?= esc($u['name']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-2 mb-2">
                    <label class="small text-muted">From Date</label>
                    <input type="date" name="start_date" class="form-control form-control-sm" value="<?= esc($filters['start_date']) ?>">
                </div>
                <div class="col-md-2 mb-2">
                    <label class="small text-muted">To Date</label>
                    <input type="date" name="end_date" class="form-control form-control-sm" value="<?= esc($filters['end_date']) ?>">
                </div>
                <div class="col-md-2 mb-2 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary btn-sm mr-2">
                        <i class="fas fa-filter"></i> Filter
                    </button>
                    <a href="<?= site_url('activitylog') ?>" class="btn btn-secondary btn-sm">
                        <i class="fas fa-times"></i> Clear
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Results Info -->
<div class="mb-3">
    <small class="text-muted">Showing <?= count($logs) ?> of <?= $total ?> logs</small>
</div>

<!-- Activity Logs Table -->
<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-sm" width="100%" cellspacing="0">
                <thead class="thead-light">
                    <tr>
                        <th width="150">Date/Time</th>
                        <th width="120">User</th>
                        <th width="100">Action</th>
                        <th width="120">Module</th>
                        <th>Record</th>
                        <th width="120">IP Address</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($logs)): ?>
                        <?php foreach ($logs as $log): ?>
                            <tr>
                                <td class="small">
                                    <?= date('d M Y', strtotime($log['created_at'])) ?><br>
                                    <span class="text-muted"><?= date('h:i A', strtotime($log['created_at'])) ?></span>
                                </td>
                                <td>
                                    <strong><?= esc($log['user_name']) ?></strong>
                                </td>
                                <td class="text-center">
                                    <?php
                                    $actionBadge = [
                                        'create' => 'success',
                                        'update' => 'primary',
                                        'delete' => 'danger',
                                        'status_change' => 'warning'
                                    ];
                                    $badge = $actionBadge[$log['action']] ?? 'secondary';
                                    ?>
                                    <span class="badge badge-<?= $badge ?>">
                                        <?= ucfirst(str_replace('_', ' ', $log['action'])) ?>
                                    </span>
                                </td>
                                <td>
                                    <span class="badge badge-info"><?= ucfirst(esc($log['module'])) ?></span>
                                </td>
                                <td>
                                    <strong><?= esc($log['record_title']) ?></strong>
                                    <small class="text-muted d-block">ID: <?= $log['record_id'] ?></small>
                                </td>
                                <td class="small text-muted">
                                    <?= esc($log['ip_address']) ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="text-center text-muted py-4">
                                <i class="fas fa-history fa-2x mb-2"></i><br>
                                No activity logs found.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        <?php if ($pages > 1): ?>
            <nav aria-label="Page navigation" class="mt-3">
                <ul class="pagination pagination-sm justify-content-center">
                    <?php for ($i = 1; $i <= $pages; $i++): ?>
                        <?php
                        $queryParams = $filters;
                        $queryParams['page'] = $i;
                        $queryString = http_build_query(array_filter($queryParams));
                        ?>
                        <li class="page-item <?= ($i == $currentPage) ? 'active' : '' ?>">
                            <a class="page-link" href="<?= site_url('activitylog') ?>?<?= $queryString ?>">
                                <?= $i ?>
                            </a>
                        </li>
                    <?php endfor; ?>
                </ul>
            </nav>
        <?php endif; ?>
    </div>
</div>

<?= $this->endSection() ?>
