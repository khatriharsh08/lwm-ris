<?= $this->extend('admin/layout') ?>
<?= $this->section('content') ?>

<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Profile</h6>
  </div>
  <div class="card-body">
    <form action="<?= site_url('user/update/' . $user['id']) ?>" method="post" enctype="multipart/form-data">
      <?= csrf_field() ?>
      <div class="form-group">
        <?php if (!empty($user['profile_photo'])): ?>
          <img src="<?= base_url('uploads/users/' . $user['profile_photo']) ?>" alt="Profile" width="100" class="mb-2">
        <?php endif; ?>
        <input type="file" name="profile_photo" class="form-control-file" id="profile_photo">
      </div>

      <div class="form-group">
        <label for="role"><strong>Role</strong></label>
        <label>: <?= esc($user['role']) ?></label>
      </div>

      <div class="form-group">
        <label for="name"><strong>Full Name</strong></label>
        <input type="text" name="name" class="form-control" id="name" value="<?= esc($user['name']) ?>" required>
      </div>

      <div class="form-group">
        <label for="email"><strong>Email Address</strong></label>
        <input type="email" name="email" class="form-control" id="email" value="<?= esc($user['email']) ?>" required>
      </div>

      <div class="form-group">
        <label for="password_txt"><strong>New Password (Plain Text)</strong></label>
        <input type="text" name="password_txt" class="form-control" id="password_txt" placeholder="Leave blank to keep existing">
      </div>

      <div class="form-group">
        <label for="role"><strong>Member Since</strong></label>
        <label>: <?= date('Y-m-d', strtotime($user['created_at'])) ?></label>
      </div>

      <div class="form-group text-right">
        <a href="<?= base_url('dashboard') ?>" class="btn btn-secondary">Cancel</a>
        <button type="submit" class="btn btn-primary">Update Profile</button>
      </div>
    </form>
  </div>
</div>

<?= $this->endSection() ?>