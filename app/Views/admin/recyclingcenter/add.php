<?php $errors = session()->get('errors'); ?>

<div class="modal fade" id="addCenterModal" tabindex="-1" role="dialog" aria-labelledby="addCenterModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <form action="<?= site_url('/recyclingcenter/store') ?>" method="post" id="addCenterForm" novalidate>
      <?= csrf_field() ?>
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="text-gray-800" id="addCenterModalLabel">Add Recycling Center</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-6 form-group mb-3">
              <label for="name">Center Name</label>
              <input type="text" name="name" id="add_center_name" required 
                     class="form-control <?= isset($errors['name']) ? 'is-invalid' : '' ?>" 
                     value="<?= old('name') ?>">
              <div class="invalid-feedback">Please enter the center name.</div>
            </div>
            <div class="col-md-6 form-group mb-3">
              <label for="waste_categories">Waste Categories</label>
              <input type="text" name="waste_categories" id="add_waste_categories" required
                     class="form-control <?= isset($errors['waste_categories']) ? 'is-invalid' : '' ?>" 
                     value="<?= old('waste_categories') ?>">
              <div class="invalid-feedback">Please enter the waste categories.</div>
            </div>
          </div>
          <div class="form-group mb-3">
            <label for="address">Address</label>
            <input type="text" name="address" id="add_address" required
                   class="form-control <?= isset($errors['address']) ? 'is-invalid' : '' ?>" 
                   value="<?= old('address') ?>">
            <div class="invalid-feedback">Please enter the address.</div>
          </div>
          <div class="row">
            <div class="col-md-6 form-group mb-3">
              <label for="city">City</label>
              <input type="text" name="city" id="add_city" required
                     class="form-control <?= isset($errors['city']) ? 'is-invalid' : '' ?>" 
                     value="<?= old('city') ?>">
              <div class="invalid-feedback">Please enter the city.</div>
            </div>
            <div class="col-md-6 form-group mb-3">
              <label for="state">State</label>
              <input type="text" name="state" id="add_state" required
                     class="form-control <?= isset($errors['state']) ? 'is-invalid' : '' ?>" 
                     value="<?= old('state') ?>">
              <div class="invalid-feedback">Please enter the state.</div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6 form-group mb-3">
              <label for="postal_code">Postal Code</label>
              <input type="text" name="postal_code" id="add_postal_code"
                     class="form-control <?= isset($errors['postal_code']) ? 'is-invalid' : '' ?>" 
                     value="<?= old('postal_code') ?>"
                     pattern="[0-9]{6}" maxlength="6" title="Please enter a 6-digit postal code">
              <div class="invalid-feedback">Please enter a valid 6-digit postal code.</div>
            </div>
            <div class="col-md-6 form-group mb-3">
              <label for="phone_number">Phone Number</label>
              <input type="tel" name="phone_number" id="add_phone_number"
                     class="form-control <?= isset($errors['phone_number']) ? 'is-invalid' : '' ?>" 
                     value="<?= old('phone_number') ?>"
                     pattern="[0-9]{10}" maxlength="10" title="Please enter a 10-digit phone number">
              <div class="invalid-feedback">Please enter a valid 10-digit phone number.</div>
            </div>
          </div>
          <div class="form-group mb-3">
            <label for="email">Email</label>
            <input type="email" name="email" id="add_center_email"
                   class="form-control <?= isset($errors['email']) ? 'is-invalid' : '' ?>" 
                   value="<?= old('email') ?>">
            <div class="invalid-feedback">Please enter a valid email address.</div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">Add Center</button>
        </div>
      </div>
    </form>
  </div>
</div>

<script type="text/javascript">
$(document).ready(function() {
    // Prevent non-numeric characters in phone and postal code fields
    $('#add_phone_number, #add_postal_code').on('keypress', function(e) {
        if (e.which < 48 || e.which > 57) {
            e.preventDefault();
        }
    });

    $('#add_phone_number, #add_postal_code').on('input', function() {
        this.value = this.value.replace(/[^0-9]/g, '');
    });

    $('#add_phone_number, #add_postal_code').on('paste', function(e) {
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
    $('#add_center_name, #add_waste_categories, #add_address, #add_city, #add_state').on('blur', function() {
        if ($(this).val().trim() === '') {
            $(this).addClass('is-invalid').removeClass('is-valid');
        } else {
            $(this).removeClass('is-invalid').addClass('is-valid');
        }
    });

    $('#add_postal_code').on('blur', function() {
        var value = $(this).val().trim();
        if (value !== '' && value.length !== 6) {
            $(this).addClass('is-invalid').removeClass('is-valid');
        } else if (value !== '') {
            $(this).removeClass('is-invalid').addClass('is-valid');
        } else {
            $(this).removeClass('is-invalid is-valid');
        }
    });

    $('#add_phone_number').on('blur', function() {
        var value = $(this).val().trim();
        if (value !== '' && value.length !== 10) {
            $(this).addClass('is-invalid').removeClass('is-valid');
        } else if (value !== '') {
            $(this).removeClass('is-invalid').addClass('is-valid');
        } else {
            $(this).removeClass('is-invalid is-valid');
        }
    });

    $('#add_center_email').on('blur', function() {
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
    $('#add_center_name, #add_waste_categories, #add_address, #add_city, #add_state, #add_postal_code, #add_phone_number, #add_center_email').on('focus', function() {
        $(this).removeClass('is-invalid is-valid');
    });

    // Form submission validation
    $('#addCenterForm').on('submit', function(e) {
        var isValid = true;

        // Required fields
        if ($('#add_center_name').val().trim() === '') {
            $('#add_center_name').addClass('is-invalid');
            isValid = false;
        }
        if ($('#add_waste_categories').val().trim() === '') {
            $('#add_waste_categories').addClass('is-invalid');
            isValid = false;
        }
        if ($('#add_address').val().trim() === '') {
            $('#add_address').addClass('is-invalid');
            isValid = false;
        }
        if ($('#add_city').val().trim() === '') {
            $('#add_city').addClass('is-invalid');
            isValid = false;
        }
        if ($('#add_state').val().trim() === '') {
            $('#add_state').addClass('is-invalid');
            isValid = false;
        }

        // Optional but validated fields
        var postal = $('#add_postal_code').val().trim();
        if (postal !== '' && postal.length !== 6) {
            $('#add_postal_code').addClass('is-invalid');
            isValid = false;
        }

        var phone = $('#add_phone_number').val().trim();
        if (phone !== '' && phone.length !== 10) {
            $('#add_phone_number').addClass('is-invalid');
            isValid = false;
        }

        var email = $('#add_center_email').val().trim();
        if (email !== '' && !validateEmail(email)) {
            $('#add_center_email').addClass('is-invalid');
            isValid = false;
        }

        if (!isValid) {
            e.preventDefault();
        }
    });
});
</script>