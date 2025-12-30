<div class="modal fade" id="addCategoryModal" tabindex="-1" role="dialog" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form action="<?= site_url('/wastecategory/store') ?>" method="post" id="addCategoryForm" novalidate>
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="text-gray-800" id="addCategoryModalLabel">Add Waste Category</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label for="categoryName">Category Name</label>
            <input type="text" name="name" class="form-control" id="addCategoryName" required>
            <div class="invalid-feedback">Please enter a category name.</div>
          </div>
          <div class="form-group">
            <label for="categoryDescription">Category Description</label>
            <textarea class="form-control" id="addCategoryDescription" name="description" rows="3"></textarea>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">Add Category</button>
        </div>
      </div>
    </form>
  </div>
</div>

<script type="text/javascript">
$(document).ready(function() {
    // Real-time validation on blur
    $('#addCategoryName').on('blur', function() {
        if ($(this).val().trim() === '') {
            $(this).addClass('is-invalid').removeClass('is-valid');
        } else {
            $(this).removeClass('is-invalid').addClass('is-valid');
        }
    });

    // Clear validation on focus
    $('#addCategoryName').on('focus', function() {
        $(this).removeClass('is-invalid is-valid');
    });

    // Form submission validation
    $('#addCategoryForm').on('submit', function(e) {
        if ($('#addCategoryName').val().trim() === '') {
            $('#addCategoryName').addClass('is-invalid');
            e.preventDefault();
        }
    });
});
</script>
