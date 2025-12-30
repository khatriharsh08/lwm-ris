<div class="modal fade" id="learnHazardousWasteManagementModal" tabindex="-1" role="dialog" aria-labelledby="learnHazardousWasteManagementModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="text-gray-800" id="learnHazardousWasteManagementModalLabel">learn Hazardous Waste Management</h5>
        <button type="button" class="close" id="cancelButtonH" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row mt-5">
          <div class="col-lg-8 offset-lg-2">
            <div id="hazardousWasteCarousel" class="carousel slide" data-bs-ride="carousel">
              <div class="carousel-inner">
                <div class="carousel-item active">
                  <img src="front/assets/img/wastepage/hazardous-waste-1.jpg" class="d-block w-100 rounded" alt="Hazardous-Waste-1">
                </div>
                <div class="carousel-item">
                  <img src="front/assets/img/wastepage/hazardous-waste-2.jpg" class="d-block w-100 rounded" alt="Hazardous-Waste-2">
                </div>
                <div class="carousel-item">
                  <img src="front/assets/img/wastepage/hazardous-waste-3.jpg" class="d-block w-100 rounded" alt="Hazardous-Waste-3">
                </div>
                <div class="carousel-item">
                  <img src="front/assets/img/wastepage/hazardous-waste-4.jpg" class="d-block w-100 rounded" alt="Hazardous-Waste-4">
                </div>
              </div>
              <button class="carousel-control-prev" type="button" data-bs-target="#hazardousWasteCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
              </button>
              <button class="carousel-control-next" type="button" data-bs-target="#hazardousWasteCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
              </button>
            </div>
          </div>
        </div>

        <div class="row mt-5">
          <div class="col-lg-8 offset-lg-2">
            <h2 class="text-danger mb-3">What is Hazardous Waste?</h2>
            <p>Hazardous waste includes toxic or potentially harmful materials like batteries, e-waste (electronics), chemicals, and medical waste. These must be disposed of at designated centers to prevent environmental damage and protect human health. Improper disposal can lead to soil and water contamination, and pose risks to living organisms.</p>

            <h2 class="text-danger mt-4 mb-3">How to Dispose of Hazardous Waste:</h2>
            <ul>
              <li><strong>Batteries:</strong> Do not throw batteries in regular trash. Look for battery recycling drop-off points at electronic stores, municipal waste centers, or specialized collection events.</li>
              <li><strong>E-waste:</strong> (Computers, phones, TVs, printers) Many electronics retailers offer take-back programs. Check with your local government for designated e-waste collection sites or events.</li>
              <li><strong>Household Chemicals:</strong> (Paints, solvents, pesticides, cleaning products) Never pour these down drains or throw them in the regular trash. Contact your local waste management facility for information on household hazardous waste (HHW) collection events or permanent disposal sites.</li>
              <li><strong>Medical Waste:</strong> (Sharps, expired medications) Consult your pharmacy or local health department for safe disposal methods. Sharps should be disposed of in approved containers.</li>
            </ul>
            <p><strong>Warning:</strong> Always handle hazardous waste with care, wearing appropriate protective gear if necessary. Never mix different types of hazardous waste.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  $('#cancelButtonH').on('click', function() {
    $('#learnHazardousWasteManagementModal').modal('hide');
    $('#addCenterForm')[0].reset();
  });
</script>