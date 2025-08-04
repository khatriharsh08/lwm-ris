<?= $this->include('front/header') ?>

<div class="container py-5">
    <div class="row">
        <div class="col-md-10 mx-auto">
            <div class="card shadow-lg border-0 p-4">
                <img src="<?= base_url('front/assets/img/DryWaste.png') ?>" class="card-img-top img-fluid rounded" alt="Dry Waste">
                <div class="card-body">
                    <h2 class="card-title fw-bold text-primary">Mastering Waste Segregation: Dry Waste</h2>
                    <p class="text-muted mb-4">Published on: <?= date('F j, Y') ?> | Category: Waste Management</p>

                    <p>Dry waste refers to all waste materials that are not biologically decomposable. These items typically include:</p>
                    <ul class="list-group list-group-flush mb-3">
                        <li class="list-group-item">Paper and newspapers</li>
                        <li class="list-group-item">Cardboard boxes and cartons</li>
                        <li class="list-group-item">Glass bottles and jars</li>
                        <li class="list-group-item">Plastic containers, wraps, and packaging</li>
                        <li class="list-group-item">Metal cans and foil</li>
                    </ul>

                    <p>Proper segregation of dry waste ensures efficient recycling and reduces the load on landfills. Before discarding dry waste, it’s important to:</p>
                    <ul class="list-unstyled mb-3">
                        <li>✔️ Clean and dry recyclable items to prevent contamination</li>
                        <li>✔️ Avoid mixing with food waste</li>
                        <li>✔️ Use separate bins labeled “Dry Waste”</li>
                    </ul>

                    <p>By managing dry waste properly, we contribute significantly to environmental sustainability, reduce the carbon footprint, and promote a circular economy where materials are reused efficiently.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->include('front/footer') ?>