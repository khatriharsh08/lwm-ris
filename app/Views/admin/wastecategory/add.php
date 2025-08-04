<div class="modal fade" id="addCategoryModal" tabindex="-1" role="dialog" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form action="<?= site_url('/wastecategory/store') ?>" method="post" id="addCategoryForm">
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
            <input type="text" name="name" class="form-control" id="categoryName" required>
          </div>
          <div class="form-group">
            <label for="categoryDescription">Category Description</label>
            <textarea class="form-control" id="categoryDescription" name="description" rows="3"></textarea>
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
