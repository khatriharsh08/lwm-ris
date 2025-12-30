<?= $this->extend('admin/layout') ?>
<?= $this->section('content') ?>
<?= $this->include('admin/messages') ?>

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?= $page_title ?? 'Edit Admin' ?></h1>
    <a href="<?= site_url('admins') ?>" class="btn btn-sm btn-secondary shadow-sm">
        <i class="fas fa-arrow-left fa-sm text-white-50"></i> Back to List
    </a>
</div>

<!-- Edit Admin Form -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">
            Edit Admin Details
            <?php if ($admin['is_master'] == 1): ?>
                <span class="badge badge-warning ml-2">Master Admin</span>
            <?php endif; ?>
        </h6>
    </div>
    <div class="card-body">
        <form action="<?= site_url('admins/update/' . $admin['id']) ?>" method="POST" enctype="multipart/form-data">
            <?= csrf_field() ?>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="name">Full Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="name" name="name" 
                               value="<?= old('name', $admin['name']) ?>" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="email">Email Address <span class="text-danger">*</span></label>
                        <input type="email" class="form-control" id="email" name="email" 
                               value="<?= old('email', $admin['email']) ?>" required>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password">
                        <small class="form-text text-muted">Leave blank to keep current password (min 6 characters if changing)</small>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="profile_photo">Profile Photo</label>
                        <?php if (!empty($admin['profile_photo'])): ?>
                            <div class="mb-2">
                                <img src="<?= base_url('uploads/users/' . $admin['profile_photo']) ?>" 
                                     alt="Current Photo" class="rounded" style="max-height: 80px;">
                                <small class="d-block text-muted">Current photo</small>
                            </div>
                        <?php endif; ?>
                        <input type="file" class="form-control-file" id="profile_photo" name="profile_photo" 
                               accept="image/jpeg,image/png,image/gif">
                        <small class="form-text text-muted">JPG, PNG, GIF (max 5MB). Leave empty to keep current.</small>
                    </div>
                </div>
            </div>

            <hr>
            
            <div class="form-group">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Update Admin
                </button>
                <a href="<?= site_url('admins') ?>" class="btn btn-secondary">
                    <i class="fas fa-times"></i> Cancel
                </a>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection() ?>
