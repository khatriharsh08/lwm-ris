<div class="modal fade" id="addCenterModal" tabindex="-1" role="dialog" aria-labelledby="addCenterModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <form action="<?= site_url('/recyclingcenter/store') ?>" method="post" id="addCenterForm">
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
              <input type="text" name="name" class="form-control" id="name" required>
            </div>
            <div class="col-md-6 form-group mb-3">
              <label for="waste_categories">Waste Categories</label>
              <input type="text" name="waste_categories" class="form-control" id="waste_categories" required>
            </div>
          </div>
          <div class="form-group mb-3">
            <label for="address">Address</label>
            <input type="text" name="address" class="form-control" id="address" required>
          </div>
          <div class="row">
            <div class="col-md-6 form-group mb-3">
              <label for="city">City</label>
              <input type="text" name="city" class="form-control" id="city" required>
            </div>
            <div class="col-md-6 form-group mb-3">
              <label for="state">State</label>
              <input type="text" name="state" class="form-control" id="state" required>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6 form-group mb-3">
              <label for="postal_code">Postal Code</label>
              <input type="text" name="postal_code" class="form-control" id="postal_code">
            </div>
            <div class="col-md-6 form-group mb-3">
              <label for="phone_number">Phone Number</label>
              <input type="text" name="phone_number" class="form-control" id="phone_number">
            </div>
          </div>
          <div class="form-group mb-3">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control" id="email">
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
