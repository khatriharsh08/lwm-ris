<?= $this->include('front/header') ?>

<header class="hero-section">
    <div class="container">
        <h1 class="display-4" style="color: #1B5E20;">Join the Movement for a Cleaner Planet</h1>
        <p class="lead" style="color: #2E7D32;">Proper waste management is key to a sustainable future. Learn how you can make a difference today.</p>
        <a href="#about" class="btn btn-success btn-lg mt-3 text-white">Learn More</a>
    </div>
</header>

<main>

<section id="stats-counter" class="py-5" style="background-color: #f8f9fa;">
    <div class="container">
        <div class="row justify-content-center">

            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card border-left-secondary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-secondary text-uppercase mb-1">
                                    Active Centers</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">6</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-map-marker-alt fa-2x text-gray-400"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card border-left-secondary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-secondary text-uppercase mb-1">
                                    Different Categories</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">5</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-list-alt fa-2x text-gray-400"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card border-left-secondary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-secondary text-uppercase mb-1">
                                    Successful Events/Drives</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">6</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar-check fa-2x text-gray-400"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

    <?= $this->include('front/sections/WasteSegregation') ?>

    <section id="events" class="py-5">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="section-title">Upcoming Events & Drives</h2>
                <p class="lead text-black">Join us in making a difference. View below for an event near you!</p>
            </div>

            <div id="eventsCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="5000">
                <div class="carousel-inner">
                    <?php
                        // 1. Group the events into chunks of 3 for each slide
                        $centerChunks = array_chunk($all_upcoming_events, 3);
                        $isFirst = true;
                    ?>

                    <?php foreach ($centerChunks as $chunk): ?>
                        <div class="carousel-item <?= $isFirst ? 'active' : '' ?>">
                            <div class="row">
                                <?php foreach ($chunk as $event): ?>
                                    <div class="col-md-4 mb-3">
                                        <div class="card h-100 border-0 shadow-sm">
                                            <img src="<?= base_url('uploads/events/') . esc($event['poster_image']) ?>" class="card-img-top" alt="<?= esc($event['title']) ?>" style="height: 300px; object-fit: cover;">
                                            <div class="card-body p-4">
                                                <h5 class="card-title fw-bold"><?= esc($event['title']) ?></h5>
                                                <p class="card-text"><?= esc($event['description']) ?></p>
                                                <p class="card-text text-muted small">
                                                    <i class="fas fa-calendar-alt fa-fw me-2"></i><?= date('M d, Y', strtotime($event['date'])) ?>
                                                </p>
                                                <p class="card-text text-muted small">
                                                    <i class="fas fa-map-marker-alt fa-fw me-2"></i><?= esc($event['venue']) ?>
                                                </p>
                                            </div>
                                        </div>
                                        <!--  See More Button  -->
                                    </div>                                
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <?php $isFirst = false; ?>
                    <?php endforeach; ?>
                </div>

                <button class="carousel-control-prev" type="button" data-bs-target="#eventsCarousel" data-bs-slide="prev">
                    <span><i class="fas fa-chevron-left text-success fs-4"></i></span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#eventsCarousel" data-bs-slide="next">
                    <span><i class="fas fa-chevron-right text-success fs-4"></i></span>
                </button>

            </div>
        </div>
    </section>
x


    <section id="recyclingcenters" class="py-5 bg-light">
        <div class="container text-center">
            <!-- Heading -->
            <h2 class="section-title mb-4 fw-bold">Find a Recycling Center Near You</h2>

            <!-- Search Form -->
            <form action="<?= base_url('/home') ?>" method="get" class="mb-5">
                <div class="d-flex justify-content-center flex-wrap gap-3">
                    <select name="city" id="city" class="form-control form-control-lg" style="max-width: 250px; border: 1px solid #2E7D32; color: #1B5E20;" required>
                        <option value="">-- Select City --</option>
                        <?php foreach ($all_city as $city): ?>
                            <option value="<?= esc($city['city']) ?>"><?= esc($city['city']) ?></option>
                        <?php endforeach; ?>
                    </select>

                    <select name="state" id="state" class="form-control form-control-lg" style="max-width: 250px; border: 1px solid #2E7D32; color: #1B5E20;" required>
                        <option value="">-- Select State --</option>
                    </select>

                    <button class="btn btn-success btn-lg px-4 d-flex align-items-center text-white" type="submit">
                        <i class="fas fa-search me-2"></i>Search
                    </button>
                </div>
            </form>

            <div id="centerCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="5000">
                <div class="carousel-inner">
                    <?php $centerChunks = array_chunk($all_recycling_centers, 3); ?>
                    <?php foreach ($centerChunks as $key => $chunk): ?>
                        <div class="carousel-item <?= ($key === 0) ? 'active' : '' ?>">
                            <div class="row g-4 px-2">
                                <?php foreach ($chunk as $center): ?>
                                    <div class="col-md-4 d-flex align-items-stretch">
                                        <div class="card border-0 shadow-sm w-100 transition-hover">
                                            <div class="card-body d-flex flex-column p-4">
                                                <h5 class="fw-semibold mb-3"><?= esc($center['name']) ?></h5>
                                                <ul class="list-unstyled small text-muted mb-4 flex-grow-1">
                                                    <li class="mb-2 d-flex">
                                                        <i class="fas fa-map-marker-alt me-2 text-success pt-1"></i>
                                                        <div>
                                                            <?= esc($center['address']) ?><br>
                                                            <?= esc($center['city']) ?>, <?= esc($center['state']) ?> <?= esc($center['postal_code']) ?>
                                                        </div>
                                                    </li>
                                                    <li class="mb-2 d-flex align-items-center">
                                                        <i class="fas fa-phone-alt me-2 text-success"></i>
                                                        <?= esc($center['phone_number']) ?>
                                                    </li>
                                                    <li class="d-flex align-items-center">
                                                        <i class="fas fa-envelope me-2 text-success"></i>
                                                        <?= esc($center['email']) ?>
                                                    </li>
                                                </ul>
                                                <p class="text-muted small mt-auto mb-0">
                                                    <i class="fas fa-user-check me-1 text-success"></i>
                                                    Member since <?= date('M, Y', strtotime($center['created_at'])) ?>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <!-- Controls -->
                <button class="carousel-control-prev" type="button" data-bs-target="#centerCarousel" data-bs-slide="prev">
                    <span><i class="fas fa-chevron-left text-success fs-4"></i></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#centerCarousel" data-bs-slide="next">
                    <span><i class="fas fa-chevron-right text-success fs-4"></i></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </section>

    <script>
    $(document).ready(function () {
        $('#city').change(function () {
            const city = $(this).val();
            if (city !== '') {
                $.ajax({
                    url: "<?= site_url('/home/getStates') ?>", // Your controller route
                    method: "POST",
                    data: { city: city },
                    dataType: "json",
                    success: function (response) {
                        $('#state').empty().append('<option value="">-- Select State --</option>');
                        $.each(response, function (i, item) {
                            $('#state').append('<option value="' + item.state + '">' + item.state + '</option>');
                        });
                    },
                    error: function () {
                        alert('Error fetching states. Please try again.');
                    }
                });
            } else {
                $('#state').html('<option value="">-- Select State --</option>');
            }
        });
    });
</script>

<?= $this->include('front/sections/GetInTouch') ?>
</main>
<?= $this->include('front/footer') ?>