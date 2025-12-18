<?= $this->extend('layout_admin'); ?>

<?= $this->section('konten_admin'); ?>

<!-- Load Font & Chart.js -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>
    :root {
        --primary-dark: #3e2723;
        --primary-light: #5d4037;
        --accent: #d7ccc8;
        --bg-gray: #f8f9fa;
        --card-shadow: 0 10px 30px rgba(0,0,0,0.05);
        --hover-shadow: 0 15px 35px rgba(62, 39, 35, 0.1);
    }

    body { font-family: 'Poppins', sans-serif; background-color: var(--bg-gray); }

    /* === HEADER SECTION === */
    .dashboard-header {
        margin-bottom: 30px;
        display: flex; justify-content: space-between; align-items: center;
    }
    .dashboard-title h2 { font-weight: 700; color: var(--primary-dark); margin: 0; }
    .dashboard-title p { color: #888; font-size: 0.9rem; margin-top: 5px; }
    .date-badge {
        background: #fff; padding: 10px 20px; border-radius: 50px;
        font-size: 0.85rem; font-weight: 600; color: var(--primary-light);
        box-shadow: var(--card-shadow); display: flex; align-items: center; gap: 8px;
    }

    /* === STAT CARDS === */
    .stats-grid {
        display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
        gap: 25px; margin-bottom: 35px;
    }
    .stat-card {
        background: #fff; padding: 25px; border-radius: 20px;
        box-shadow: var(--card-shadow); position: relative; overflow: hidden;
        transition: 0.3s cubic-bezier(0.4, 0, 0.2, 1); border: 1px solid rgba(0,0,0,0.02);
    }
    .stat-card:hover { transform: translateY(-8px); box-shadow: var(--hover-shadow); }
    
    .stat-head { display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 15px; }
    .stat-title { font-size: 0.9rem; color: #999; font-weight: 500; }
    .stat-value { font-size: 2rem; font-weight: 700; color: var(--primary-dark); line-height: 1; }
    
    /* Icon Styling with Gradients */
    .icon-box {
        width: 50px; height: 50px; border-radius: 15px;
        display: flex; align-items: center; justify-content: center; font-size: 1.2rem; color: #fff;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }
    .grad-brown { background: linear-gradient(135deg, #5d4037, #8d6e63); }
    .grad-green { background: linear-gradient(135deg, #2e7d32, #66bb6a); }
    .grad-blue  { background: linear-gradient(135deg, #1565c0, #42a5f5); }
    .grad-orange{ background: linear-gradient(135deg, #f57f17, #ffb74d); }

    /* Decorative Circle inside Card */
    .stat-card::after {
        content: ''; position: absolute; bottom: -30px; right: -30px;
        width: 100px; height: 100px; border-radius: 50%;
        background: currentColor; opacity: 0.05; pointer-events: none;
    }

    /* === MAIN CONTENT GRID === */
    .main-grid {
        display: grid; grid-template-columns: 2fr 1fr; gap: 25px;
    }

    .content-card {
        background: #fff; border-radius: 20px; padding: 30px;
        box-shadow: var(--card-shadow); height: 100%;
        display: flex; flex-direction: column;
    }
    .card-head {
        display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px;
    }
    .card-head h4 { font-weight: 700; color: var(--primary-dark); font-size: 1.1rem; margin: 0; }
    .badge-soft {
        background: #efebe9; color: var(--primary-dark); padding: 5px 12px;
        border-radius: 8px; font-size: 0.75rem; font-weight: 600;
    }

    /* === CHART === */
    .chart-container { position: relative; height: 320px; width: 100%; }

    /* === TOP PRODUCTS LIST === */
    .top-products { list-style: none; padding: 0; margin: 0; }
    .prod-item {
        display: flex; align-items: center; justify-content: space-between;
        padding: 15px 0; border-bottom: 1px dashed #eee; transition: 0.2s;
    }
    .prod-item:last-child { border-bottom: none; }
    .prod-item:hover { background-color: #fafafa; padding-left: 10px; padding-right: 10px; border-radius: 10px; }
    
    .prod-info { display: flex; align-items: center; gap: 12px; }
    .rank-circle {
        width: 24px; height: 24px; background: var(--primary-dark); color: #fff;
        border-radius: 50%; font-size: 0.7rem; font-weight: bold;
        display: flex; align-items: center; justify-content: center;
    }
    .prod-name { font-weight: 600; font-size: 0.95rem; color: #333; display: block; }
    .prod-sales { font-size: 0.8rem; color: #888; }

    /* === SENTIMENT CIRCLE === */
    .sentiment-box {
        display: flex; align-items: center; justify-content: center;
        flex-direction: column; padding: 20px 0;
    }
    .circular-chart {
        width: 120px; height: 120px; border-radius: 50%;
        background: conic-gradient(#4caf50 0% 85%, #f0f0f0 85% 100%);
        display: flex; align-items: center; justify-content: center;
        position: relative; margin-bottom: 15px;
    }
    .circular-chart::before {
        content: ''; position: absolute; width: 90px; height: 90px;
        background: #fff; border-radius: 50%;
    }
    .percent-text {
        position: relative; z-index: 2; font-size: 1.5rem; font-weight: 800; color: #4caf50;
    }
    .sentiment-label { text-align: center; color: #666; font-size: 0.9rem; }

    @media (max-width: 992px) {
        .main-grid { grid-template-columns: 1fr; }
        .chart-container { height: 250px; }
    }
</style>

<!-- HEADER -->
<div class="dashboard-header">
    <div class="dashboard-title">
        <h2>Dashboard Overview</h2>
        <p>Halo Admin, inilah ringkasan kedai kopi hari ini.</p>
    </div>
    <div class="date-badge">
        <i class="bi bi-calendar-event"></i> <?= date('d M Y'); ?>
    </div>
</div>

<!-- STATS CARDS -->
<div class="stats-grid">
    <!-- Card 1 -->
    <div class="stat-card" style="color: #5d4037;">
        <div class="stat-head">
            <div>
                <span class="stat-title">Total Produk</span>
                <div class="stat-value"><?= number_format($total_produk); ?></div>
            </div>
            <div class="icon-box grad-brown"><i class="bi bi-cup-hot-fill"></i></div>
        </div>
        <small class="text-muted"><i class="bi bi-arrow-up-right text-success"></i> Data Menu Aktif</small>
    </div>

    <!-- Card 2 -->
    <div class="stat-card" style="color: #2e7d32;">
        <div class="stat-head">
            <div>
                <span class="stat-title">Total Transaksi</span>
                <div class="stat-value"><?= number_format($total_transaksi); ?></div>
            </div>
            <div class="icon-box grad-green"><i class="bi bi-wallet2"></i></div>
        </div>
        <small class="text-muted"><i class="bi bi-arrow-up-right text-success"></i> +12% dari minggu lalu</small>
    </div>

    <!-- Card 3 -->
    <div class="stat-card" style="color: #1565c0;">
        <div class="stat-head">
            <div>
                <span class="stat-title">Pelanggan</span>
                <div class="stat-value"><?= number_format($total_pelanggan); ?></div>
            </div>
            <div class="icon-box grad-blue"><i class="bi bi-people-fill"></i></div>
        </div>
        <small class="text-muted">User Terdaftar</small>
    </div>

    <!-- Card 4 -->
    <div class="stat-card" style="color: #f57f17;">
        <div class="stat-head">
            <div>
                <span class="stat-title">Rating Kedai</span>
                <div class="stat-value"><?= $avg_rating; ?></div>
            </div>
            <div class="icon-box grad-orange"><i class="bi bi-star-fill"></i></div>
        </div>
        <small class="text-muted">Kepuasan Pelanggan</small>
    </div>
</div>

<!-- MAIN CONTENT -->
<div class="main-grid">
    
    <!-- LEFT: CHART -->
    <div class="content-card">
        <div class="card-head">
            <h4><i class="bi bi-bar-chart-line-fill me-2"></i> Grafik Penjualan</h4>
            <span class="badge-soft">7 Hari Terakhir</span>
        </div>
        <div class="chart-container">
            <canvas id="salesChart"></canvas>
        </div>
    </div>

    <!-- RIGHT: INSIGHTS -->
    <div class="content-card" style="gap: 30px;">
        
        <!-- Top Products -->
        <div>
            <div class="card-head" style="margin-bottom: 15px;">
                <h4><i class="bi bi-trophy-fill me-2"></i> Menu Terlaris</h4>
            </div>
            <ul class="top-products">
                <?php $i = 1; foreach($produk_populer as $prod): ?>
                    <li class="prod-item">
                        <div class="prod-info">
                            <span class="rank-circle"><?= $i++; ?></span>
                            <div>
                                <span class="prod-name"><?= $prod; ?></span>
                                <span class="prod-sales">Best Seller Category</span>
                            </div>
                        </div>
                        <i class="bi bi-chevron-right text-muted" style="font-size: 0.8rem;"></i>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>

        <!-- Sentiment -->
        <div style="border-top: 1px dashed #eee; padding-top: 20px;">
            <div class="card-head" style="margin-bottom: 10px;">
                <h4><i class="bi bi-emoji-smile-fill me-2"></i> Kepuasan</h4>
            </div>
            <div class="sentiment-box">
                <!-- Ubah derajat conic-gradient sesuai persentase (misal 85% = 306deg) -->
                <div class="circular-chart" style="background: conic-gradient(#4caf50 0deg 306deg, #f0f0f0 306deg 360deg);">
                    <div class="percent-text">85%</div>
                </div>
                <div class="sentiment-label">
                    Respon <strong>Positif</strong> dari pelanggan<br>
                    <small style="color:#999;">Berdasarkan ulasan terbaru</small>
                </div>
            </div>
        </div>

    </div>
</div>

<!-- CHART JS CONFIGURATION -->
<script>
    const ctx = document.getElementById('salesChart').getContext('2d');

    // Gradient Fill Effect
    let gradient = ctx.createLinearGradient(0, 0, 0, 400);
    gradient.addColorStop(0, 'rgba(62, 39, 35, 0.5)'); // Coklat Pekat Transparan
    gradient.addColorStop(1, 'rgba(62, 39, 35, 0.0)'); // Fade out

    // Data PHP to JS
    const labels = <?= $chart_labels; ?>;
    const dataValues = <?= $chart_data; ?>;
    const demoLabels = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'];
    const demoData = [120000, 190000, 150000, 220000, 180000, 300000, 250000];

    const chartConfig = {
        type: 'line',
        data: {
            labels: labels.length ? labels : demoLabels,
            datasets: [{
                label: 'Revenue',
                data: dataValues.length ? dataValues : demoData,
                borderColor: '#3e2723',
                backgroundColor: gradient,
                borderWidth: 3,
                pointBackgroundColor: '#fff',
                pointBorderColor: '#3e2723',
                pointBorderWidth: 2,
                pointRadius: 6,
                pointHoverRadius: 8,
                fill: true,
                tension: 0.4 // Smooth curve
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                tooltip: {
                    backgroundColor: '#3e2723',
                    titleFont: { family: 'Poppins', size: 13 },
                    bodyFont: { family: 'Poppins', size: 14 },
                    padding: 10,
                    cornerRadius: 8,
                    displayColors: false,
                    callbacks: {
                        label: function(context) {
                            return 'Rp ' + new Intl.NumberFormat('id-ID').format(context.raw);
                        }
                    }
                }
            },
            scales: {
                x: {
                    grid: { display: false },
                    ticks: { font: { family: 'Poppins' }, color: '#888' }
                },
                y: {
                    beginAtZero: true,
                    grid: { color: '#f0f0f0', borderDash: [5, 5] },
                    ticks: { 
                        font: { family: 'Poppins' }, 
                        color: '#888',
                        callback: function(value) { return 'Rp ' + (value/1000) + 'k'; }
                    }
                }
            }
        }
    };

    new Chart(ctx, chartConfig);
</script>

<?= $this->endSection(); ?>