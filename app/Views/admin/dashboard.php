<?= $this->include('admin/header') ?>

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    <a href="<?= site_url('report/generate') ?>" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
            class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
</div>

<!-- Stats Cards Row -->
<div class="row">
    <!-- Waste Category Card -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xm font-weight-bold text-primary text-uppercase mb-1">
                            Waste Category</div>
                        <div class="h3 mb-0 font-weight-bold text-gray-800"><?= $waste_category_count; ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-recycle fa-3x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recycling Center Card -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xm font-weight-bold text-success text-uppercase mb-1">
                            Recycling Centers</div>
                        <div class="h3 mb-0 font-weight-bold text-gray-800"><?= $recycling_center_count; ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-map-marker-alt fa-3x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Events/Seminars Card -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xm font-weight-bold text-info text-uppercase mb-1">Events/Seminars
                        </div>
                        <div class="h3 mb-0 font-weight-bold text-gray-800"><?= $events_count; ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-calendar-alt fa-3x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Pending Requests Card -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xm font-weight-bold text-warning text-uppercase mb-1">
                            Pending Requests</div>
                        <div class="h3 mb-0 font-weight-bold text-gray-800"><?= $get_in_touch_requests_count; ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-envelope fa-3x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Charts Row -->
                    <div class="row">

                        <!-- Monthly Events Bar Chart -->
                        <div class="col-xl-8 col-lg-7">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">
                                        <i class="fas fa-chart-bar mr-2"></i>Monthly Events Overview
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <div class="chart-area">
                                        <canvas id="monthlyEventsChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Contact Status Pie Chart -->
                        <div class="col-xl-4 col-lg-5">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">
                                        <i class="fas fa-chart-pie mr-2"></i>Contact Messages Status
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <div class="chart-pie pt-4 pb-2">
                                        <canvas id="contactStatusChart"></canvas>
                                    </div>
                                    <div class="mt-4 text-center small">
                                        <span class="mr-2">
                                            <i class="fas fa-circle text-success"></i> New
                                        </span>
                                        <span class="mr-2">
                                            <i class="fas fa-circle text-warning"></i> Pending
                                        </span>
                                        <span class="mr-2">
                                            <i class="fas fa-circle text-info"></i> Done
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Content Row - Second Chart Row -->
                    <div class="row">

                        <!-- Centers by City Doughnut Chart -->
                        <div class="col-xl-4 col-lg-5">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">
                                        <i class="fas fa-city mr-2"></i>Top Cities - Recycling Centers
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <div class="chart-pie pt-4 pb-2">
                                        <canvas id="centersByCityChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Quick Stats -->
                        <div class="col-xl-8 col-lg-7">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">
                                        <i class="fas fa-info-circle mr-2"></i>Quick Statistics
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <h4 class="small font-weight-bold">Waste Categories <span class="float-right"><?= $waste_category_count ?></span></h4>
                                    <div class="progress mb-4">
                                        <div class="progress-bar bg-danger" role="progressbar" style="width: <?= min($waste_category_count * 10, 100) ?>%"></div>
                                    </div>
                                    <h4 class="small font-weight-bold">Recycling Centers <span class="float-right"><?= $recycling_center_count ?></span></h4>
                                    <div class="progress mb-4">
                                        <div class="progress-bar bg-success" role="progressbar" style="width: <?= min($recycling_center_count * 5, 100) ?>%"></div>
                                    </div>
                                    <h4 class="small font-weight-bold">Total Events <span class="float-right"><?= $events_count ?></span></h4>
                                    <div class="progress mb-4">
                                        <div class="progress-bar bg-info" role="progressbar" style="width: <?= min($events_count * 5, 100) ?>%"></div>
                                    </div>
                                    <h4 class="small font-weight-bold">Pending Requests <span class="float-right"><?= $get_in_touch_requests_count ?></span></h4>
                                    <div class="progress">
                                        <div class="progress-bar bg-warning" role="progressbar" style="width: <?= min($get_in_touch_requests_count * 10, 100) ?>%"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

<!-- Chart.js CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>

<script>
// Prepare data from PHP
const monthlyEventsData = <?= json_encode($monthly_events) ?>;
const contactStatusData = <?= json_encode($contact_by_status) ?>;
const centersByCityData = <?= json_encode($centers_by_city) ?>;

// Chart colors
const chartColors = {
    primary: '#4e73df',
    success: '#1cc88a',
    info: '#36b9cc',
    warning: '#f6c23e',
    danger: '#e74a3b',
    secondary: '#858796'
};

// Monthly Events Bar Chart
const monthlyEventsCtx = document.getElementById('monthlyEventsChart').getContext('2d');
new Chart(monthlyEventsCtx, {
    type: 'bar',
    data: {
        labels: monthlyEventsData.map(item => item.month),
        datasets: [{
            label: 'Events',
            data: monthlyEventsData.map(item => item.count),
            backgroundColor: chartColors.primary,
            borderColor: chartColors.primary,
            borderWidth: 1,
            borderRadius: 5,
            barThickness: 30
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                display: false
            }
        },
        scales: {
            y: {
                beginAtZero: true,
                ticks: {
                    stepSize: 1
                }
            }
        }
    }
});

// Contact Status Pie Chart
const contactStatusCtx = document.getElementById('contactStatusChart').getContext('2d');
const statusColors = {
    'new': chartColors.success,
    'pending': chartColors.warning,
    'done': chartColors.info
};
new Chart(contactStatusCtx, {
    type: 'pie',
    data: {
        labels: contactStatusData.map(item => item.status.charAt(0).toUpperCase() + item.status.slice(1)),
        datasets: [{
            data: contactStatusData.map(item => item.count),
            backgroundColor: contactStatusData.map(item => statusColors[item.status] || chartColors.secondary),
            hoverOffset: 10
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                display: false
            }
        }
    }
});

// Centers by City Doughnut Chart
const centersByCityCtx = document.getElementById('centersByCityChart').getContext('2d');
const cityColors = [chartColors.primary, chartColors.success, chartColors.info, chartColors.warning, chartColors.danger];
new Chart(centersByCityCtx, {
    type: 'doughnut',
    data: {
        labels: centersByCityData.map(item => item.city || 'Unknown'),
        datasets: [{
            data: centersByCityData.map(item => item.count),
            backgroundColor: cityColors,
            hoverOffset: 10
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        cutout: '60%',
        plugins: {
            legend: {
                position: 'bottom'
            }
        }
    }
});
</script>

<style>
.chart-area {
    position: relative;
    height: 250px;
}
.chart-pie {
    position: relative;
    height: 200px;
}
@media (max-width: 768px) {
    .chart-area {
        height: 200px;
    }
    .chart-pie {
        height: 180px;
    }
}
</style>
                    
<?= $this->include('admin/footer') ?>