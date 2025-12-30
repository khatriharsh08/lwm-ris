<div class="modal fade" id="learnDryWasteManagementModal" tabindex="-1" role="dialog" aria-labelledby="learnDryWasteManagementModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="text-gray-800" id="learnDryWasteManagementModalLabel">learn Dry Waste Management</h5>
        <button type="button" class="close" id="cancelButtonD" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row mt-5">
          <div class="col-lg-8 offset-lg-2">
            <div id="dryWasteCarousel" class="carousel slide" data-bs-ride="carousel">
              <div class="carousel-inner">
                <div class="carousel-item active">
                  <img src="front/assets/img/wastepage/dry-waste-1.jpg" class="d-block w-100 rounded" alt="Dry-Waste-1">
                </div>
                <div class="carousel-item">
                  <img src="front/assets/img/wastepage/dry-waste-2.jpg" class="d-block w-100 rounded" alt="Dry-Waste-2">
                </div>
                <div class="carousel-item">
                  <img src="front/assets/img/wastepage/dry-waste-3.jpg" class="d-block w-100 rounded" alt="Dry-Waste-3">
                </div>
                <div class="carousel-item">
                  <img src="front/assets/img/wastepage/dry-waste-4.jpg" class="d-block w-100 rounded" alt="Dry-Waste-4">
                </div>
              </div>
              <button class="carousel-control-prev" type="button" data-bs-target="#dryWasteCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
              </button>
              <button class="carousel-control-next" type="button" data-bs-target="#dryWasteCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
              </button>
            </div>
          </div>
        </div>

        <div class="row mt-5">
          <div class="col-lg-8 offset-lg-2">
            <h2 class="text-success mb-3">What is Dry Waste?</h2>
            <p>Dry waste includes recyclable materials such as paper, cardboard, plastics, metals, and glass. These should be clean and free from food residue before disposal to facilitate recycling and reduce contamination. Proper segregation of dry waste is crucial for successful recycling efforts.</p>

            <h2 class="text-success mt-4 mb-3">How to Recycle Dry Waste:</h2>
            <ul>
              <li><strong>Paper and Cardboard:</strong> Flatten cardboard boxes, keep paper dry, and avoid shredding too finely if possible. Remove any plastic or metal components.</li>
              <li><strong>Plastics:</strong> Rinse plastic containers (bottles, jugs) to remove food residue. Check for recycling symbols (usually a number inside a triangle) and local recycling guidelines as not all plastics are recyclable everywhere.</li>
              <li><strong>Metals:</strong> Rinse aluminum cans and tin cans. Crush them to save space if desired. Avoid placing sharp metal objects in recycling.</li>
              <li><strong>Glass:</strong> Rinse glass bottles and jars. Remove lids (these may or may not be recyclable depending on local rules). Different colored glass might need to be separated.</li>
            </ul>
            <p><strong>Remember:</strong> Always check your local municipality's specific recycling guidelines, as rules can vary.</p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
    $('#cancelButtonD').on('click', function() {
      $('#learnDryWasteManagementModal').modal('hide');
      $('#addCenterForm')[0].reset();
    });
  </script>