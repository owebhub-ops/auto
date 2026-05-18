<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <div>
        <h1 class="h2 mb-1">Dashboard</h1>
        <div class="text-muted small">Vehicle and pricing overview</div>
    </div>
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group me-2">
            <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
            <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
        </div>
    </div>
</div>

<div class="row g-3 mb-4">
    <div class="col-md-6">
        <div class="card shadow-sm">
            <div class="card-body">
                <div class="text-muted small mb-1">Total Vehicles</div>
                <div class="display-6 fw-semibold"><?= esc($totalVehicles ?? 0) ?></div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card shadow-sm">
            <div class="card-body">
                <div class="text-muted small mb-1">Total Pricing Records</div>
                <div class="display-6 fw-semibold"><?= esc($totalPricings ?? 0) ?></div>
            </div>
        </div>
    </div>
</div>

<div class="card shadow-sm">
    <div class="card-header bg-white">
        <strong>Data Distribution</strong>
    </div>
    <div class="card-body">
        <canvas id="contentChart" height="120"></canvas>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const ctx = document.getElementById('contentChart');
    if (!ctx) return;

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: <?= json_encode($chartData['labels'] ?? []) ?>,
            datasets: [{
                label: 'Count',
                data: <?= json_encode($chartData['values'] ?? []) ?>,
                backgroundColor: ['rgba(13,110,253,.75)', 'rgba(25,135,84,.75)'],
                borderColor: ['rgba(13,110,253,1)', 'rgba(25,135,84,1)'],
                borderWidth: 1,
                borderRadius: 8
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: false }
            },
            scales: {
                y: { beginAtZero: true, ticks: { precision: 0 } }
            }
        }
    });
});
</script>
