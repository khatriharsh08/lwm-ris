<?= $this->extend('admin/layout') ?>
<?= $this->section('content') ?>

<h1 class="h3 mb-4 text-gray-800">Edit Recycling Center</h1>

<div class="card shadow mb-4">
    <div class="card-body">
         <form action="<?= site_url('recyclingcenter/update/' . $center['id']) ?>" method="post">
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
                    <input type="text" name="name" class="form-control" id="name" value="<?= esc(old('name', $center['name'])) ?>" required>
                </div>
                <div class="col-md-6 form-group mb-3">
                    <label for="waste_categories">Waste Categories</label>
                    <input type="text" name="waste_categories" class="form-control" id="waste_categories" value="<?= esc(old('waste_categories', $center['waste_categories'])) ?>" required>
                </div>
            </div>
            <div class="form-group mb-3">
                <label for="address">Address</label>
                <input type="text" name="address" class="form-control" id="address" value="<?= esc(old('address', $center['address'])) ?>" required>
            </div>
            <div class="row">
                <div class="col-md-6 form-group mb-3">
                <label for="city">City</label>
                <input type="text" name="city" class="form-control" id="city" value="<?= esc(old('city', $center['city'])) ?>" required>
                </div>
                <div class="col-md-6 form-group mb-3">
                <label for="state">State</label>
                <input type="text" name="state" class="form-control" id="state" value="<?= esc(old('state', $center['state'])) ?>" required>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 form-group mb-3">
                <label for="postal_code">Postal Code</label>
                <input type="text" name="postal_code" class="form-control" id="postal_code" value="<?= esc(old('postal_code', $center['postal_code'])) ?>">
                </div>
                <div class="col-md-6 form-group mb-3">
                <label for="phone_number">Phone Number</label>
                <input type="text" name="phone_number" class="form-control" id="phone_number" value="<?= esc(old('phone_number', $center['phone_number'])) ?>">
                </div>
            </div>
            <div class="form-group mb-3">
                <label for="email">Email</label>
                <input type="email" name="email" class="form-control" id="email" value="<?= esc(old('email', $center['email'])) ?>">
            </div>

            <div class="mt-4">
                <button type="submit" class="btn btn-primary">Update Center</button>
                <a href="<?= site_url('/recyclingcenter') ?>" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection() ?>
