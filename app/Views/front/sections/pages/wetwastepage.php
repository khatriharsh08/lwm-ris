<div class="modal fade" id="learnWetWasteManagementModal" tabindex="-1" role="dialog" aria-labelledby="learnWetWasteManagementModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="text-gray-800" id="learnWetWasteManagementModalLabel">learn Wet Waste Management</h5>
        <button type="button" class="close" id="cancelButtonW" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row mt-5">
          <div class="col-lg-8 offset-lg-2">
            <div id="wetWasteCarousel" class="carousel slide" data-bs-ride="carousel">
              <div class="carousel-inner">
                <div class="carousel-item active">
                  <img src="front/assets/img/wastepage/wet-waste-1.jpg" class="d-block w-100 rounded" alt="Wet-Waste-1">
                </div>
                <div class="carousel-item">
                  <img src="front/assets/img/wastepage/wet-waste-2.jpg" class="d-block w-100 rounded" alt="Wet-Waste-2">
                </div>
                <div class="carousel-item">
                  <img src="front/assets/img/wastepage/wet-waste-3.jpg" class="d-block w-100 rounded" alt="Wet-Waste-3">
                </div>
                <div class="carousel-item">
                  <img src="front/assets/img/wastepage/wet-waste-4.jpg" class="d-block w-100 rounded" alt="Wet-Waste-4">
                </div>
              </div>
              <button class="carousel-control-prev" type="button" data-bs-target="#wetWasteCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
              </button>
              <button class="carousel-control-next" type="button" data-bs-target="#wetWasteCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
              </button>
            </div>
          </div>
        </div>

        <div class="row mt-5">
          <div class="col-lg-8 offset-lg-2">
            <h2 class="mb-3" style="color: brown;">What is Wet Waste?</h2>
            <p>Wet waste consists of biodegradable waste such as vegetable peels, food scraps, coffee grounds, and garden waste. This waste can be composted at home or processed in municipal composting facilities to produce organic fertilizer.</p>

            <h2 class="mt-4 mb-3" style="color: brown;">How to Compost Wet Waste:</h2>
            <ul>
              <li><strong>Collect Organics:</strong> Keep a designated bin for food scraps in your kitchen (e.g., fruit and vegetable peels, coffee grounds, tea bags, eggshells).</li>
              <li><strong>Balance "Greens" and "Browns":</strong> For effective composting, you need a good mix of "greens" (nitrogen-rich, like food scraps, grass clippings) and "browns" (carbon-rich, like dry leaves, wood chips, shredded paper).</li>
              <li><strong>Choose a Composter:</strong> This can be an outdoor compost pile, a tumbler, or an indoor vermicomposting (worm composting) system.</li>
              <li><strong>Maintain Moisture and Air:</strong> Keep the compost pile moist like a damp sponge, and turn it regularly to aerate it, which speeds up decomposition.</li>
              <li><strong>Avoid Problematic Items:</strong> Do not add meat, dairy products, oily foods, diseased plants, or pet waste to home composters as they can attract pests and create odors.</li>
            </ul>
            <p>Composting reduces landfill waste, enriches soil, and reduces the need for chemical fertilizers.</p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
    $('#cancelButtonW').on('click', function() {
      $('#learnWetWasteManagementModal').modal('hide');
      $('#addCenterForm')[0].reset();
    });
  </script>