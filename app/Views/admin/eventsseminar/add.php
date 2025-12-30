<div class="modal fade" id="addEventModal" tabindex="-1" role="dialog" aria-labelledby="addEventModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <form action="<?= site_url('eventsseminar/store') ?>" method="post" enctype="multipart/form-data" id="addEventForm" novalidate>
      <?= csrf_field() ?>
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="text-gray-800" id="addEventModalLabel">Add New Event</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group mb-3">
            <label for="title">Event Title</label>
            <input type="text" name="title" class="form-control" id="add_title" required>
            <div class="invalid-feedback">Please enter the event title.</div>
          </div>
          <div class="form-group mb-3">
            <label for="description">Description</label>
            <textarea name="description" class="form-control" id="add_description" rows="3"></textarea>
          </div>
          <div class="row">
            <div class="col-md-6 form-group mb-3">
              <label for="date">Date and Time</label>
              <input type="datetime-local" name="date" class="form-control" id="add_date" required>
              <div class="invalid-feedback">Please select the event date and time.</div>
            </div>
            <div class="col-md-6 form-group mb-3">
              <label for="venue">Venue</label>
              <input type="text" name="venue" class="form-control" id="add_venue" required>
              <div class="invalid-feedback">Please enter the venue.</div>
            </div>
          </div>
          <div class="form-group mb-3">
            <label for="poster_image">Poster Image (Max 5MB)</label>
            <input type="file" name="poster_image" class="form-control" id="add_poster_image" required accept="image/*">
            <div class="invalid-feedback">Please select a valid image file (max 5MB).</div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">Add Event</button>
        </div>
      </div>
    </form>
  </div>
</div>

<script type="text/javascript">
$(document).ready(function() {
    // File validation for poster
    $('#add_poster_image').on('change', function() {
        var file = this.files[0];
        if (file) {
            var maxSize = 5 * 1024 * 1024; // 5MB
            var allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
            
            if (file.size > maxSize) {
                $(this).addClass('is-invalid');
                this.value = '';
            } else if (!allowedTypes.includes(file.type)) {
                $(this).addClass('is-invalid');
                this.value = '';
            } else {
                $(this).removeClass('is-invalid').addClass('is-valid');
            }
        }
    });

    // Real-time validation on blur
    $('#add_title').on('blur', function() {
        if ($(this).val().trim() === '') {
            $(this).addClass('is-invalid').removeClass('is-valid');
        } else {
            $(this).removeClass('is-invalid').addClass('is-valid');
        }
    });

    $('#add_date').on('blur', function() {
        if ($(this).val() === '') {
            $(this).addClass('is-invalid').removeClass('is-valid');
        } else {
            $(this).removeClass('is-invalid').addClass('is-valid');
        }
    });

    $('#add_venue').on('blur', function() {
        if ($(this).val().trim() === '') {
            $(this).addClass('is-invalid').removeClass('is-valid');
        } else {
            $(this).removeClass('is-invalid').addClass('is-valid');
        }
    });

    // Clear validation on focus
    $('#add_title, #add_date, #add_venue, #add_poster_image').on('focus', function() {
        $(this).removeClass('is-invalid is-valid');
    });

    // Form submission validation
    $('#addEventForm').on('submit', function(e) {
        var isValid = true;

        if ($('#add_title').val().trim() === '') {
            $('#add_title').addClass('is-invalid');
            isValid = false;
        }

        if ($('#add_date').val() === '') {
            $('#add_date').addClass('is-invalid');
            isValid = false;
        }

        if ($('#add_venue').val().trim() === '') {
            $('#add_venue').addClass('is-invalid');
            isValid = false;
        }

        if ($('#add_poster_image')[0].files.length === 0) {
            $('#add_poster_image').addClass('is-invalid');
            isValid = false;
        }

        if (!isValid) {
            e.preventDefault();
        }
    });
});
</script>
