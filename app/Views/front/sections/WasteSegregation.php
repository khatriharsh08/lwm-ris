<section class="py-5 bg-light">
    <div class="container">
        <h2 class="section-title">Mastering Waste Segregation</h2>        
        <div class="row text-center">
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100 p-4">
                    <div class="card-icon mb-3">
                        <img src="front/assets/img/DryWaste.png" class="img-fluid rounded" alt="Dry Waste" style="width: 200px; height: 200px;">
                    </div>
                    <h5 class="card-title fw-bold">Dry Waste</h5>
                    <p class="card-text">
                        Includes recyclable materials such as paper, cardboard, plastics, metals, and glass. 
                        These should be clean and free from food residue before disposal to facilitate recycling and reduce contamination.
                    </p>
                    <div>
                        <!-- <a id="learnDryWasteManagement"><small class="text-muted">Learn more about dry waste management.</small></a> -->
                        <button type="button" id="learnDryWasteManagement" style="border: 0; background-color: transparent;"><small class="text-muted">Learn more about dry waste management.</small></button>                      
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100 p-4">
                    <div class="card-icon mb-3">
                        <img src="front/assets/img/WetWaste.png" class="img-fluid rounded" alt="Wet Waste" style="width: 200px; height: 200px;">
                    </div>
                    <h5 class="card-title fw-bold">Wet Waste</h5>
                    <p class="card-text">
                        Consists of biodegradable waste such as vegetable peels, food scraps, coffee grounds, and garden waste. 
                        This waste can be composted at home or processed in municipal composting facilities to produce organic fertilizer.
                    </p>
                    <div>
                        <!-- <a href="<?= base_url('home/wetWaste') ?>"><small class="text-muted">Learn more about wet waste management.</small></a> -->
                        <button type="button" id="learnWetWasteManagement" style="border: 0; background-color: transparent;"><small class="text-muted">Learn more about wet waste management.</small></button>                      
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100 p-4">
                    <div class="card-icon mb-3">
                        <img src="front/assets/img/HazardousWaste.png" class="img-fluid rounded" alt="Hazardous Waste" style="width: 200px; height: 200px;">
                    </div>
                    <h5 class="card-title fw-bold">Hazardous Waste</h5>
                    <p class="card-text">
                        Includes toxic or potentially harmful materials like batteries, e-waste, chemicals, and medical waste. 
                        These must be disposed of at designated centers to prevent environmental damage and protect human health.
                    </p>
                    <div>
                        <!-- <a href="<?= base_url('home/hazardousWaste') ?>"><small class="text-muted">Learn more about hazardous waste management.</small></a> -->
                        <button type="button" id="learnHazardousWasteManagement" style="border: 0; background-color: transparent;"><small class="text-muted">Learn more about hazardous waste management.</small></button>                      
                    </div>
                </div>
            </div>            
        </div>
    </div>
</section>


<script>
    $(document).ready(function() {
        $('#learnDryWasteManagement').click(function() {
            $.ajax({
                url: '<?= site_url('/home/showdrywaste') ?>',
                method: 'GET',
                success: function(response) {
                    if ($('#learnDryWasteManagementModal').length === 0) {
                        $('body').append(response);
                    }
                    $('#learnDryWasteManagementModal').modal('show');
                }
            });
        });
    });
    $(document).ready(function() {
        $('#learnWetWasteManagement').click(function() {
            $.ajax({
                url: '<?= site_url('/home/showwetwaste') ?>',
                method: 'GET',
                success: function(response) {
                    if ($('#learnWetWasteManagementModal').length === 0) {
                        $('body').append(response);
                    }
                    $('#learnWetWasteManagementModal').modal('show');
                }
            });
        });
    });
    $(document).ready(function() {
        $('#learnHazardousWasteManagement').click(function() {
            $.ajax({
                url: '<?= site_url('/home/showhazardouswaste') ?>',
                method: 'GET',
                success: function(response) {
                    if ($('#learnHazardousWasteManagementModal').length === 0) {
                        $('body').append(response);
                    }
                    $('#learnHazardousWasteManagementModal').modal('show');
                }
            });
        });
    });
</script>