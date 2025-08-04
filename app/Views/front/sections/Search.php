<section class="py-5 bg-white">
    <div class="container text-center">
        <!-- Heading -->
        <h2 class="section-title mb-4 fw-bold">Find a Recycling Center Near You</h2>

        <!-- Search Form -->
        <form action="<?= site_url('front/home') ?>" method="get" class="mb-5">
            <div class="d-flex justify-content-center flex-wrap gap-3">
                <input type="text" name="city" class="form-control form-control-lg  px-4" placeholder="Enter City" style="max-width: 250px;" required>
                <input type="text" name="state" class="form-control form-control-lg  px-4" placeholder="Enter State" style="max-width: 250px;" required>
                <button class="btn btn-success btn-lg  px-4 d-flex align-items-center" type="submit">
                    <i class="fas fa-search me-2"></i>Search
                </button>
            </div>
        </form>

        <!-- Blog Cards -->
        <div class="row">
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100 shadow-sm">
                    <img src="front/assets/img/1.png" class="card-img-top" alt="Blog Post 1">
                    <div class="card-body">
                        <h5 class="card-title fw-bold">10 Simple Ways to Reduce Waste at Home</h5>
                        <p class="card-text">Discover easy and practical tips to minimize your household waste and live more sustainably.</p>
                        <a href="#" class="text-success fw-bold">Read More <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100 shadow-sm">
                    <img src="front/assets/img/2.png" class="card-img-top" alt="Blog Post 2">
                    <div class="card-body">
                        <h5 class="card-title fw-bold">The Importance of Composting</h5>
                        <p class="card-text">Learn why composting is a powerful tool for reducing landfill waste and enriching your garden soil.</p>
                        <a href="#" class="text-success fw-bold">Read More <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100 shadow-sm">
                    <img src="front/assets/img/3.png" class="card-img-top" alt="Blog Post 3">
                    <div class="card-body">
                        <h5 class="card-title fw-bold">Understanding E-Waste and How to Dispose It</h5>
                        <p class="card-text">Electronic waste is a growing problem. Find out how to dispose of your old gadgets responsibly.</p>
                        <a href="#" class="text-success fw-bold">Read More <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>