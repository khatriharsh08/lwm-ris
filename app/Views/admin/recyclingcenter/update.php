<?= $this->extend('admin/layout') ?>
<?= $this->section('content') ?>

<h1 class="h3 mb-4 text-gray-800">Edit Recycling Center</h1>

<div class="card shadow mb-4">
    <div class="card-body">
         <form action="<?= site_url('recyclingcenter/update/' . $center['id']) ?>" method="post" id="updateCenterForm" novalidate>
            <?= csrf_field() ?>

            <?php $errors = session()->getFlashdata('errors'); ?>
            <?php if (!empty($errors)): ?>
                <div class="alert alert-danger">
                    <ul>
                    <?php foreach ($errors as $error): ?>
                        <li><?= esc($error) ?></li>
                    <?php endforeach ?>
                    </ul>
                </div>
            <?php endif ?>

            <div class="row">
                <div class="col-md-6 form-group mb-3">
                    <label for="name">Center Name</label>
                    <input type="text" name="name" class="form-control" id="edit_center_name" value="<?= esc(old('name', $center['name'])) ?>" required>
                    <div class="invalid-feedback">Please enter the center name.</div>
                </div>
                <div class="col-md-6 form-group mb-3">
                    <label for="waste_categories">Waste Categories</label>
                    <input type="text" name="waste_categories" class="form-control" id="edit_waste_categories" value="<?= esc(old('waste_categories', $center['waste_categories'])) ?>" required>
                    <div class="invalid-feedback">Please enter the waste categories.</div>
                </div>
            </div>
            <div class="form-group mb-3">
                <label for="address">Address</label>
                <input type="text" name="address" class="form-control" id="edit_address" value="<?= esc(old('address', $center['address'])) ?>" required>
                <div class="invalid-feedback">Please enter the address.</div>
            </div>
            <div class="row">
                <div class="col-md-6 form-group mb-3">
                <label for="city">City</label>
                <input type="text" name="city" class="form-control" id="edit_city" value="<?= esc(old('city', $center['city'])) ?>" required>
                <div class="invalid-feedback">Please enter the city.</div>
                </div>
                <div class="col-md-6 form-group mb-3">
                <label for="state">State</label>
                <input type="text" name="state" class="form-control" id="edit_state" value="<?= esc(old('state', $center['state'])) ?>" required>
                <div class="invalid-feedback">Please enter the state.</div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 form-group mb-3">
                <label for="postal_code">Postal Code</label>
                <input type="text" name="postal_code" class="form-control" id="edit_postal_code" value="<?= esc(old('postal_code', $center['postal_code'])) ?>" pattern="[0-9]{6}" maxlength="6">
                <div class="invalid-feedback">Please enter a valid 6-digit postal code.</div>
                </div>
                <div class="col-md-6 form-group mb-3">
                <label for="phone_number">Phone Number</label>
                <input type="tel" name="phone_number" class="form-control" id="edit_phone_number" value="<?= esc(old('phone_number', $center['phone_number'])) ?>" pattern="[0-9]{10}" maxlength="10">
                <div class="invalid-feedback">Please enter a valid 10-digit phone number.</div>
                </div>
            </div>
            <div class="form-group mb-3">
                <label for="email">Email</label>
                <input type="email" name="email" class="form-control" id="edit_center_email" value="<?= esc(old('email', $center['email'])) ?>">
                <div class="invalid-feedback">Please enter a valid email address.</div>
            </div>

            <div class="mt-4">
                <button type="submit" class="btn btn-primary">Update Center</button>
                <a href="<?= site_url('/recyclingcenter') ?>" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>

<script type="text/javascript">
$(document).ready(function() {
    // Prevent non-numeric characters in phone and postal code fields
    $('#edit_phone_number, #edit_postal_code').on('keypress', function(e) {
        if (e.which < 48 || e.which > 57) {
            e.preventDefault();
        }
    });

    $('#edit_phone_number, #edit_postal_code').on('input', function() {
        this.value = this.value.replace(/[^0-9]/g, '');
    });

    $('#edit_phone_number, #edit_postal_code').on('paste', function(e) {
        var pastedData = e.originalEvent.clipboardData.getData('text');
        if (!/^\d+$/.test(pastedData)) {
            e.preventDefault();
        }
    });

    function validateEmail(email) {
        var regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return regex.test(email);
    }

    // Real-time validation on blur
    $('#edit_center_name, #edit_waste_categories, #edit_address, #edit_city, #edit_state').on('blur', function() {
        if ($(this).val().trim() === '') {
            $(this).addClass('is-invalid').removeClass('is-valid');
        } else {
            $(this).removeClass('is-invalid').addClass('is-valid');
        }
    });

    $('#edit_postal_code').on('blur', function() {
        var value = $(this).val().trim();
        if (value !== '' && value.length !== 6) {
            $(this).addClass('is-invalid').removeClass('is-valid');
        } else if (value !== '') {
            $(this).removeClass('is-invalid').addClass('is-valid');
        } else {
            $(this).removeClass('is-invalid is-valid');
        }
    });

    $('#edit_phone_number').on('blur', function() {
        var value = $(this).val().trim();
        if (value !== '' && value.length !== 10) {
            $(this).addClass('is-invalid').removeClass('is-valid');
        } else if (value !== '') {
            $(this).removeClass('is-invalid').addClass('is-valid');
        } else {
            $(this).removeClass('is-invalid is-valid');
        }
    });

    $('#edit_center_email').on('blur', function() {
        var value = $(this).val().trim();
        if (value !== '' && !validateEmail(value)) {
            $(this).addClass('is-invalid').removeClass('is-valid');
        } else if (value !== '') {
            $(this).removeClass('is-invalid').addClass('is-valid');
        } else {
            $(this).removeClass('is-invalid is-valid');
        }
    });

    // Clear validation on focus
    $('#edit_center_name, #edit_waste_categories, #edit_address, #edit_city, #edit_state, #edit_postal_code, #edit_phone_number, #edit_center_email').on('focus', function() {
        $(this).removeClass('is-invalid is-valid');
    });

    // Form submission validation
    $('#updateCenterForm').on('submit', function(e) {
        var isValid = true;

        // Required fields
        if ($('#edit_center_name').val().trim() === '') {
            $('#edit_center_name').addClass('is-invalid');
            isValid = false;
        }
        if ($('#edit_waste_categories').val().trim() === '') {
            $('#edit_waste_categories').addClass('is-invalid');
            isValid = false;
        }
        if ($('#edit_address').val().trim() === '') {
            $('#edit_address').addClass('is-invalid');
            isValid = false;
        }
        if ($('#edit_city').val().trim() === '') {
            $('#edit_city').addClass('is-invalid');
            isValid = false;
        }
        if ($('#edit_state').val().trim() === '') {
            $('#edit_state').addClass('is-invalid');
            isValid = false;
        }

        // Optional but validated fields
        var postal = $('#edit_postal_code').val().trim();
        if (postal !== '' && postal.length !== 6) {
            $('#edit_postal_code').addClass('is-invalid');
            isValid = false;
        }

        var phone = $('#edit_phone_number').val().trim();
        if (phone !== '' && phone.length !== 10) {
            $('#edit_phone_number').addClass('is-invalid');
            isValid = false;
        }

        var email = $('#edit_center_email').val().trim();
        if (email !== '' && !validateEmail(email)) {
            $('#edit_center_email').addClass('is-invalid');
            isValid = false;
        }

        if (!isValid) {
            e.preventDefault();
        }
    });
});
</script>

<?= $this->endSection() ?>
