<div class="swiper FiltermySwiper">
    <div class="swiper-wrapper">
        <?php foreach($all_recycling_centers as $center): ?>
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
                                <i class="fas fa-calendar-alt me-2 text-success"></i>
                                <?= esc($center['event_date'] ?? 'Date not available') ?>
                            </li>
                            <li class="mb-2 d-flex align-items-center">
                                <i class="fas fa-phone-alt me-2 text-success"></i>
                                <?= esc($center['phone'] ?? 'N/A') ?>
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