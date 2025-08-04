<?= $this->include('front/header') ?>

<div class="container py-5">
    <div class="row">
        <div class="col-md-10 mx-auto">
            <div class="card shadow-lg border-0 p-4">
                <img src="<?= base_url('front/assets/img/WetWaste.png') ?>" class="card-img-top img-fluid rounded" alt="Wet Waste">
                <div class="card-body">
                    <h2 class="card-title fw-bold text-success">Understanding Wet Waste: From Kitchen to Compost</h2>
                    <p class="text-muted mb-4">Published on: <?= date('F j, Y') ?> | Category: Organic Waste</p>

                    <p>Wet waste includes materials that decompose naturally and consist of:</p>
                    <ul class="list-group list-group-flush mb-3">
                        <li class="list-group-item">Vegetable and fruit peels</li>
                        <li class="list-group-item">Leftover food scraps</li>
                        <li class="list-group-item">Tea leaves and coffee grounds</li>
                        <li class="list-group-item">Garden clippings and wilted flowers</li>
                        <li class="list-group-item">Eggshells and food-soiled paper</li>
                    </ul>

                    <p>To manage wet waste responsibly, consider the following:</p>
                    <ul class="list-unstyled mb-3">
                        <li>♻️ Install a composting bin at home</li>
                        <li>♻️ Segregate kitchen waste daily</li>
                        <li>♻️ Avoid mixing plastic or hazardous items with organic waste</li>
                    </ul>

                    <p>When composted, wet waste produces nutrient-rich organic compost that can be used in gardens, farms, and parks. It is a crucial step toward reducing methane emissions from landfills and enriching soil health.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->include('front/footer') ?>