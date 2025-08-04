<?= $this->extend('admin/layout') ?>
<?= $this->section('content') ?>

    <div class="card-body">
         <form action="<?= site_url('wastecategory/update/' . $category['id']) ?>" method="post" id="editCategoryForm">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="text-gray-800" id="addCategoryModalLabel">Edit Waste Category</h5>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label for="categoryName">Category Name</label>
            <input type="text" name="name" class="form-control" id="categoryName" value="<?= esc($category['name']) ?>"required>
          </div>
          <div class="form-group">
            <label for="categoryDescription">Category Description</label>
            <textarea class="form-control" id="categoryDescription" name="description" rows="3"><?= esc($category['description']) ?></textarea>
          </div>
        </div>
        <div class="modal-footer">
         <a href="<?= site_url('/wastecategory') ?>"  class="btn btn-secondary" >Cancel</a>
          <button type="submit" class="btn btn-primary">Update Category</button>
        </div>
      </div>
    </form>
    </div>


<?= $this->endSection() ?>