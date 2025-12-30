<?= $this->extend('admin/layout') ?>
<?= $this->section('content') ?>

<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Profile</h6>
  </div>
  <div class="card-body">
    <form action="<?= site_url('user/update/' . $user['id']) ?>" method="post" enctype="multipart/form-data" id="profileForm" novalidate>
      <?= csrf_field() ?>
      <div class="form-group">
        <?php if (!empty($user['profile_photo'])): ?>
          <img src="<?= base_url('uploads/users/' . $user['profile_photo']) ?>" alt="Profile" width="100" class="mb-2">
        <?php endif; ?>
        <input type="file" name="profile_photo" class="form-control-file" id="profile_photo" accept="image/*">
        <small class="form-text text-muted">Max file size: 5MB. Allowed: JPG, PNG, GIF</small>
        <div class="invalid-feedback">Please select a valid image file (max 5MB).</div>
      </div>

      <div class="form-group">
        <label for="role"><strong>Role</strong></label>
        <label>: <?= esc($user['role']) ?></label>
      </div>

      <div class="form-group">
        <label for="name"><strong>Full Name</strong></label>
        <input type="text" name="name" class="form-control" id="name" value="<?= esc($user['name']) ?>" required>
        <div class="invalid-feedback">Please enter your full name.</div>
      </div>

      <div class="form-group">
        <label for="email"><strong>Email Address</strong></label>
        <input type="email" name="email" class="form-control" id="email" value="<?= esc($user['email']) ?>" required>
        <div class="invalid-feedback">Please enter a valid email address.</div>
      </div>

      <div class="form-group">
        <label for="password"><strong>New Password (Plain Text)</strong></label>
        <input type="text" name="password" class="form-control" id="password" placeholder="Leave blank to keep existing" minlength="6">
        <div class="invalid-feedback">Password must be at least 6 characters.</div>
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

<script type="text/javascript">
$(document).ready(function() {
    function validateEmail(email) {
        var regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return regex.test(email);
    }

    // File validation
    $('#profile_photo').on('change', function() {
        var file = this.files[0];
        if (file) {
            var maxSize = 5 * 1024 * 1024; // 5MB
            var allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
            
            if (file.size > maxSize) {
                $(this).addClass('is-invalid');
                $(this).next('.form-text').after('<div class="invalid-feedback d-block">File size must be less than 5MB.</div>');
                this.value = '';
            } else if (!allowedTypes.includes(file.type)) {
                $(this).addClass('is-invalid');
                this.value = '';
            } else {
                $(this).removeClass('is-invalid').addClass('is-valid');
                $(this).siblings('.invalid-feedback.d-block').remove();
            }
        }
    });

    // Real-time validation on blur
    $('#name').on('blur', function() {
        var value = $(this).val().trim();
        if (value === '') {
            $(this).addClass('is-invalid').removeClass('is-valid');
        } else {
            $(this).removeClass('is-invalid').addClass('is-valid');
        }
    });

    $('#email').on('blur', function() {
        var value = $(this).val().trim();
        if (value === '' || !validateEmail(value)) {
            $(this).addClass('is-invalid').removeClass('is-valid');
        } else {
            $(this).removeClass('is-invalid').addClass('is-valid');
        }
    });

    $('#password').on('blur', function() {
        var value = $(this).val();
        if (value !== '' && value.length < 6) {
            $(this).addClass('is-invalid').removeClass('is-valid');
        } else if (value !== '') {
            $(this).removeClass('is-invalid').addClass('is-valid');
        } else {
            $(this).removeClass('is-invalid is-valid');
        }
    });

    // Clear validation on focus
    $('#name, #email, #password').on('focus', function() {
        $(this).removeClass('is-invalid is-valid');
    });

    // Form submission validation
    $('#profileForm').on('submit', function(e) {
        var name = $('#name').val().trim();
        var email = $('#email').val().trim();
        var password = $('#password').val();
        var isValid = true;

        if (name === '') {
            $('#name').addClass('is-invalid');
            isValid = false;
        }

        if (email === '' || !validateEmail(email)) {
            $('#email').addClass('is-invalid');
            isValid = false;
        }

        if (password !== '' && password.length < 6) {
            $('#password').addClass('is-invalid');
            isValid = false;
        }

        if (!isValid) {
            e.preventDefault();
        }
    });
});
</script>

<?= $this->endSection() ?>