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
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $recycling_center_count; ?></div>
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
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $waste_category_count; ?></div>
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
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $events_count; ?></div>
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
            <div class="swiper UpcomingEvents">
                <div class="swiper-wrapper">
                    <?php foreach ($upcoming_events as $chunk): ?>
                        <div class="swiper-slide">
                            <div class="card h-96 border-0 shadow-sm">
                                <img src="<?= base_url('uploads/events/') . esc($chunk['poster_image']) ?>"
                                     class="card-img-top"
                                     alt="<?= esc($chunk['title']) ?>"
                                     style="height: 300px; object-fit: cover;">
                                <div class="card-body p-4">
                                    <h5 class="card-title fw-bold"><?= esc($chunk['title']) ?></h5>
                                    <p class="card-text"><?= esc($chunk['description']) ?></p>
                                    <p class="card-text text-muted small">
                                        <i class="fas fa-calendar-alt fa-fw me-2"></i>
                                        <?= date('M d, Y', strtotime($chunk['date'])) ?>
                                    </p>
                                    <p class="card-text text-muted small">
                                        <i class="fas fa-map-marker-alt fa-fw me-2"></i>
                                        <?= esc($chunk['venue']) ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <!-- Swiper Navigation -->
                <div class="swiper-button-prev">
                    <span><i class="fas fa-chevron-left text-success fs-4"></i></span>
                    <span class="visually-hidden">Previous</span>
                </div>
                <div class="swiper-button-next">
                    <span><i class="fas fa-chevron-right text-success fs-4"></i></span>
                    <span class="visually-hidden">Next</span>
                </div>
                <!-- <div class="swiper-pagination"></div> -->
            </div>
        </div>
    </section>

    <section class="py-5 bg-light" id="recyclingcenters">
        <div class="container text-center">
            <!-- Heading -->
            <h2 class="section-title mb-4 fw-bold">Find a Recycling Center Near You</h2>
            <div class="d-flex justify-content-center flex-wrap gap-3">
                <select name="city" id="city" class="form-control form-control-lg" style="max-width: 250px; border: 1px solid #2E7D32; color: #6c757d;" required>
                    <option value="">-- Select City --</option>
                    <?php foreach ($cities as $city): ?>
                        <option value="<?= esc($city['city']) ?>" <?= (isset($selectedCity) && $selectedCity === $city['city']) ? 'selected' : '' ?> data-city-name="<?= esc($city['city']) ?>">
                            <?= esc($city['city']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>

                <select name="state" id="state" class="form-control form-control-lg" style="max-width: 250px; border: 1px solid #2E7D32; color: #6c757d;" required>
                    <option value="">-- Select City --</option>
                    <?php foreach ($states as $state): ?>
                        <option value="<?= esc($state['state']) ?>" <?= (isset($selectedState) && $selectedState === $state['state']) ? 'selected' : '' ?> data-state-name="<?= esc($state['state']) ?>">
                            <?= esc($state['state']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>

                <button class="btn btn-success btn-lg px-4 d-flex align-items-center text-white" id="clearbtn" type="submit">
                    <i class="fas fa-times-circle me-2"></i>
                </button>
            </div>
            <div class="container py-5">
                <div class="row g-4">
                    <div class="swiper mySwiper">
                        <div class="swiper-wrapper">
                            <?php foreach($recycling_centers as $center): ?>
                                <div class="swiper-slide">
                                    <div class="card border-0 shadow-sm h-100">
                                        <div class="card-body d-flex flex-column">
                                            <!-- Event Name -->
                                            <h5 class="fw-semibold mb-3">
                                                <?= esc($center['name']) ?>
                                            </h5>
                                            <!-- Details -->
                                            <ul class="list-unstyled small text-muted mb-4">
                                                <li class="mb-2 d-flex">
                                                    <i class="fas fa-map-marker-alt me-2 text-success pt-1"></i>
                                                    <?= esc($center['address'] ?? 'Address not available') ?>
                                                </li>
                                                <li class="mb-2 d-flex align-items-center">
                                                    <i class="fas fa-user-check me-1 text-success"></i>
                                                    &nbsp;Member since <?= date('M, Y', strtotime($center['created_at'])) ?>
                                                </li>
                                                <li class="mb-2 d-flex align-items-center">
                                                    <i class="fas fa-phone-alt me-2 text-success"></i>
                                                    <?= esc($center['phone_number'] ?? 'N/A') ?>
                                                </li>
                                                <li class="d-flex align-items-center">
                                                    <i class="fas fa-envelope me-2 text-success"></i>
                                                    <?= esc($center['email'] ?? 'N/A') ?>
                                                </li>
                                            </ul>
                                            <!-- Hosted by -->
                                            <p class="text-muted small mt-auto mb-0">
                                                <i class="fas fa-user-check me-1 text-success"></i>
                                                Hosted by <?= esc($center['host'] ?? 'Unknown') ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <!-- Navigation -->
                        <div class="swiper-button-prev">
                            <span><i class="fas fa-chevron-left text-success fs-4"></i></span>
                            <span class="visually-hidden">Previous</span>
                        </div>
                        <div class="swiper-button-next">
                            <span><i class="fas fa-chevron-right text-success fs-4"></i></span>
                            <span class="visually-hidden">Next</span>
                        </div>
                        <div class="swiper-pagination"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        $(document).ready(function() {
            function loadRecyclingCenters() {
                let cityName = $('#city').val();
                let stateName = $('#state').val();

                $.ajax({
                    url: "<?= base_url('get-category-wise-product') ?>",
                    type: "POST",
                    data: {
                        cityName: cityName,
                        stateName: stateName
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.status == 1) {
                            $('.mySwiper').html($(response.html));
                            initSwiper();
                        } else {
                            $('.mySwiper').html('<p class="text-center">No recycling centers found.</p>');
                        }
                    },
                    error: function() {
                        alert("Something went wrong. Please try again.");
                    }
                });
            }

            // Trigger on dropdown change
            $('#city, #state').on('change', function() {
                loadRecyclingCenters();
            });

            $('#clearbtn').on('click', function () {
                $('#city').val('');
                $('#state').val('');
                loadRecyclingCenters();
            });
        });

        function initSwiper() {
            new Swiper('.FiltermySwiper', {
                loop: true,
                spaceBetween: 10,
                autoplay: {
                    delay: 3000,
                    disableOnInteraction: false
                },
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev'
                },
                breakpoints: {
                    0: { slidesPerView: 1 },
                    768: { slidesPerView: 2 },
                    1024: { slidesPerView: 3 }
                }
            });
        }

        document.addEventListener('DOMContentLoaded', function () {
            const container = document.querySelector('.UpcomingEvents');
            if (!container) return;
            const swiper = new Swiper(container, {
                loop: true,
                slidesPerView: 3,
                spaceBetween: 20,
                autoplay: {
                    delay: 3000,
                    disableOnInteraction: false
                },
                pagination: {
                    el: container.querySelector('.swiper-pagination'),
                    clickable: true
                },
                navigation: {
                    nextEl: container.querySelector('.swiper-button-next'),
                    prevEl: container.querySelector('.swiper-button-prev')
                },
                breakpoints: {
                    0: { slidesPerView: 1 },
                    576: { slidesPerView: 1 },
                    768: { slidesPerView: 2 },
                    1024: { slidesPerView: 3 }
                }
            });
        });
    </script>

    <?= $this->include('front/sections/GetInTouch') ?>
</main>

<?= $this->include('front/footer') ?>