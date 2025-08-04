<div class="modal fade" id="addEventModal" tabindex="-1" role="dialog" aria-labelledby="addEventModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <form action="<?= site_url('eventsseminar/store') ?>" method="post" enctype="multipart/form-data">
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
            <input type="text" name="title" class="form-control" id="title" required>
          </div>
          <div class="form-group mb-3">
            <label for="description">Description</label>
            <textarea name="description" class="form-control" id="description" rows="3"></textarea>
          </div>
          <div class="row">
            <div class="col-md-6 form-group mb-3">
              <label for="date">Date and Time</label>
              <input type="datetime-local" name="date" class="form-control" id="date" required>
            </div>
            <div class="col-md-6 form-group mb-3">
              <label for="venue">Venue</label>
              <input type="text" name="venue" class="form-control" id="venue" required>
            </div>
          </div>
          <div class="form-group mb-3">
            <label for="poster_image">Poster Image (Max 5MB)</label>
            <input type="file" name="poster_image" class="form-control" id="poster_image" required>
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
