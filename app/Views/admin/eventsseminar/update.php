<?= $this->extend('admin/layout') ?>
<?= $this->section('content') ?>

<h1 class="h3 mb-4 text-gray-800">Edit Event</h1>

<div class="card shadow mb-4">
    <div class="card-body">
         <form action="<?= site_url('eventsseminar/update/' . $event['id']) ?>" method="post" enctype="multipart/form-data" id="updateEventForm" novalidate>
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

            <div class="form-group mb-3">
                <label for="title">Event Title</label>
                <input type="text" name="title" class="form-control" id="edit_title" value="<?= esc(old('title', $event['title'])) ?>" required>
                <div class="invalid-feedback">Please enter the event title.</div>
            </div>
            <div class="form-group mb-3">
                <label for="description">Description</label>
                <textarea name="description" class="form-control" id="edit_description" rows="3"><?= esc(old('description', $event['description'])) ?></textarea>
            </div>
            <div class="row">
                <div class="col-md-6 form-group mb-3">
                    <label for="date">Date and Time</label>
                    <input type="datetime-local" name="date" class="form-control" id="edit_date" value="<?= esc(old('date', date('Y-m-d\TH:i', strtotime($event['date'])))) ?>" required>
                    <div class="invalid-feedback">Please select the event date and time.</div>
                </div>
                <div class="col-md-6 form-group mb-3">
                    <label for="venue">Venue</label>
                    <input type="text" name="venue" class="form-control" id="edit_venue" value="<?= esc(old('venue', $event['venue'])) ?>" required>
                    <div class="invalid-feedback">Please enter the venue.</div>
                </div>
            </div>
            <div class="form-group mb-3">
                <label for="poster_image">New Poster Image (Optional, Max 1MB)</label>
                <input type="file" name="poster_image" class="form-control" id="edit_poster_image" accept="image/*">
                <div class="invalid-feedback">Please select a valid image file (max 1MB).</div>
                <?php if (!empty($event['poster_image'])): ?>
                    <small class="form-text text-muted">Current image: <a href="<?= base_url('uploads/events/' . $event['poster_image']) ?>" target="_blank"><?= esc($event['poster_image']) ?></a></small>
                <?php endif; ?>
            </div>

            <div class="mt-4">
                <button type="submit" class="btn btn-primary">Update Event</button>
                <a href="<?= site_url('eventsseminar') ?>" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>

<script type="text/javascript">
$(document).ready(function() {
    // File validation for poster (optional but max 1MB)
    $('#edit_poster_image').on('change', function() {
        var file = this.files[0];
        if (file) {
            var maxSize = 1 * 1024 * 1024; // 1MB
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
    $('#edit_title').on('blur', function() {
        if ($(this).val().trim() === '') {
            $(this).addClass('is-invalid').removeClass('is-valid');
        } else {
            $(this).removeClass('is-invalid').addClass('is-valid');
        }
    });

    $('#edit_date').on('blur', function() {
        if ($(this).val() === '') {
            $(this).addClass('is-invalid').removeClass('is-valid');
        } else {
            $(this).removeClass('is-invalid').addClass('is-valid');
        }
    });

    $('#edit_venue').on('blur', function() {
        if ($(this).val().trim() === '') {
            $(this).addClass('is-invalid').removeClass('is-valid');
        } else {
            $(this).removeClass('is-invalid').addClass('is-valid');
        }
    });

    // Clear validation on focus
    $('#edit_title, #edit_date, #edit_venue, #edit_poster_image').on('focus', function() {
        $(this).removeClass('is-invalid is-valid');
    });

    // Form submission validation
    $('#updateEventForm').on('submit', function(e) {
        var isValid = true;

        if ($('#edit_title').val().trim() === '') {
            $('#edit_title').addClass('is-invalid');
            isValid = false;
        }

        if ($('#edit_date').val() === '') {
            $('#edit_date').addClass('is-invalid');
            isValid = false;
        }

        if ($('#edit_venue').val().trim() === '') {
            $('#edit_venue').addClass('is-invalid');
            isValid = false;
        }

        if (!isValid) {
            e.preventDefault();
        }
    });
});
</script>

<?= $this->endSection() ?>
