<?= $this->extend('admin/layout') ?>
<?= $this->section('content') ?>

<h1 class="h3 mb-4 text-gray-800">Edit Event</h1>

<div class="card shadow mb-4">
    <div class="card-body">
         <form action="<?= site_url('eventsseminar/update/' . $event['id']) ?>" method="post" enctype="multipart/form-data">
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
                <input type="text" name="title" class="form-control" id="title" value="<?= esc(old('title', $event['title'])) ?>" required>
            </div>
            <div class="form-group mb-3">
                <label for="description">Description</label>
                <textarea name="description" class="form-control" id="description" rows="3"><?= esc(old('description', $event['description'])) ?></textarea>
            </div>
            <div class="row">
                <div class="col-md-6 form-group mb-3">
                    <label for="date">Date and Time</label>
                    <input type="datetime-local" name="date" class="form-control" id="date" value="<?= esc(old('date', date('Y-m-d\TH:i', strtotime($event['date'])))) ?>" required>
                </div>
                <div class="col-md-6 form-group mb-3">
                    <label for="venue">Venue</label>
                    <input type="text" name="venue" class="form-control" id="venue" value="<?= esc(old('venue', $event['venue'])) ?>" required>
                </div>
            </div>
            <div class="form-group mb-3">
                <label for="poster_image">New Poster Image (Optional, Max 1MB)</label>
                <input type="file" name="poster_image" class="form-control" id="poster_image">
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

<?= $this->endSection() ?>
