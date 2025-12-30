<?= $this->extend('admin/layout') ?>
<?= $this->section('content') ?>
<?= $this->include('admin/messages') ?>

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?= $page_title ?? 'Manage Admins' ?></h1>
    <a href="<?= site_url('admins/add') ?>" class="btn btn-sm btn-success shadow-sm">
        <i class="fas fa-user-plus fa-sm text-white-50"></i> Add New Admin
    </a>
</div>

<!-- DataTables Card -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Admin Users</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Photo</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Created</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($admins)): ?>
                        <?php $i = 1; foreach ($admins as $admin): ?>
                            <tr>
                                <td><?= $i++ ?></td>
                                <td class="text-center">
                                    <?php if (!empty($admin['profile_photo'])): ?>
                                        <img src="<?= base_url('uploads/users/' . $admin['profile_photo']) ?>" 
                                             alt="<?= esc($admin['name']) ?>" 
                                             class="rounded-circle" 
                                             style="width: 40px; height: 40px; object-fit: cover;">
                                    <?php else: ?>
                                        <div class="rounded-circle bg-secondary d-inline-flex justify-content-center align-items-center" 
                                             style="width: 40px; height: 40px;">
                                            <i class="fas fa-user text-white"></i>
                                        </div>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?= esc($admin['name']) ?>
                                    <?php if ($admin['is_master'] == 1): ?>
                                        <span class="badge badge-warning ml-1">Master</span>
                                    <?php endif; ?>
                                </td>
                                <td><?= esc($admin['email']) ?></td>
                                <td><span class="badge badge-primary"><?= esc($admin['role']) ?></span></td>
                                <td><?= date('d M Y', strtotime($admin['created_at'])) ?></td>
                                <td>
                                    <a href="<?= site_url('admins/edit/' . $admin['id']) ?>" 
                                       class="btn btn-sm btn-primary" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <?php if ($admin['is_master'] != 1 && $admin['id'] != session()->get('user_id')): ?>
                                        <a href="<?= site_url('admins/delete/' . $admin['id']) ?>" 
                                           class="btn btn-sm btn-danger" 
                                           title="Delete"
                                           onclick="return confirm('Are you sure you want to delete this admin?');">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7" class="text-center">No admins found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
