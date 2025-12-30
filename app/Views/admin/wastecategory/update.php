<?= $this->extend('admin/layout') ?>
<?= $this->section('content') ?>

    <div class="card-body">
         <form action="<?= site_url('wastecategory/update/' . $category['id']) ?>" method="post" id="editCategoryForm" novalidate>
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="text-gray-800" id="addCategoryModalLabel">Edit Waste Category</h5>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label for="categoryName">Category Name</label>
            <input type="text" name="name" class="form-control" id="editCategoryName" value="<?= esc($category['name']) ?>" required>
            <div class="invalid-feedback">Please enter a category name.</div>
          </div>
          <div class="form-group">
            <label for="categoryDescription">Category Description</label>
            <textarea class="form-control" id="editCategoryDescription" name="description" rows="3"><?= esc($category['description']) ?></textarea>
          </div>
        </div>
        <div class="modal-footer">
         <a href="<?= site_url('/wastecategory') ?>"  class="btn btn-secondary" >Cancel</a>
          <button type="submit" class="btn btn-primary">Update Category</button>
        </div>
      </div>
    </form>
    </div>

<script type="text/javascript">
$(document).ready(function() {
    // Real-time validation on blur
    $('#editCategoryName').on('blur', function() {
        if ($(this).val().trim() === '') {
            $(this).addClass('is-invalid').removeClass('is-valid');
        } else {
            $(this).removeClass('is-invalid').addClass('is-valid');
        }
    });

    // Clear validation on focus
    $('#editCategoryName').on('focus', function() {
        $(this).removeClass('is-invalid is-valid');
    });

    // Form submission validation
    $('#editCategoryForm').on('submit', function(e) {
        if ($('#editCategoryName').val().trim() === '') {
            $('#editCategoryName').addClass('is-invalid');
            e.preventDefault();
        }
    });
});
</script>

<?= $this->endSection() ?>