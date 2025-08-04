<?= $this->include('front/header') ?>

<div class="container py-5">
    <div class="row">
        <div class="col-md-10 mx-auto">
            <div class="card shadow-lg border-0 p-4">
                <img src="<?= base_url('front/assets/img/HazardousWaste.png') ?>" class="card-img-top img-fluid rounded" alt="Hazardous Waste">
                <div class="card-body">
                    <h2 class="card-title fw-bold text-danger">Handle With Care: Hazardous Waste Awareness</h2>
                    <p class="text-muted mb-4">Published on: <?= date('F j, Y') ?> | Category: Safety & Environment</p>

                    <p>Hazardous waste includes materials that are dangerous to human health or the environment. Common examples are:</p>
                    <ul class="list-group list-group-flush mb-3">
                        <li class="list-group-item">Used batteries and light bulbs</li>
                        <li class="list-group-item">E-waste like old mobiles, computers, and cables</li>
                        <li class="list-group-item">Expired medicines and medical waste</li>
                        <li class="list-group-item">Cleaning chemicals and paint cans</li>
                        <li class="list-group-item">Pesticides and insecticides</li>
                    </ul>

                    <p>Why is proper disposal important?</p>
                    <ul class="list-unstyled mb-3">
                        <li>⚠️ Prevents water and soil contamination</li>
                        <li>⚠️ Reduces toxic exposure to humans and animals</li>
                        <li>⚠️ Avoids fires, corrosion, and environmental damage</li>
                    </ul>

                    <p>Always deliver hazardous materials to certified collection centers. Municipal programs or special recycling drives are often organized to safely dispose of e-waste and chemicals.</p>

                    <p class="mb-0">Remember, careless disposal of hazardous waste can have long-term, irreversible effects. Let's be informed and take responsibility for a safer environment.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->include('front/footer') ?>