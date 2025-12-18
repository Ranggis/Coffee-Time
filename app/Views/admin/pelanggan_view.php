<?= $this->extend('layout_admin'); ?>

<?= $this->section('konten_admin'); ?>

<style>
    /* --- CSS EXISTING (TABLE) --- */
    .card-table {
        background: #fff;
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
        padding: 25px;
        border: 1px solid #f0f0f0;
    }
    .modern-table thead th {
        background-color: #3e2723;
        color: #fff;
        padding: 15px;
        border: none;
        font-weight: 500;
    }
    .modern-table thead th:first-child { border-top-left-radius: 10px; }
    .modern-table thead th:last-child { border-top-right-radius: 10px; }
    .modern-table tbody td {
        vertical-align: middle;
        padding: 15px;
        border-bottom: 1px solid #f5f5f5;
        color: #444;
    }
    .modern-table tbody tr:hover { background-color: #fff8e1; transition: 0.3s; }
    .avatar-circle {
        width: 40px; height: 40px;
        background-color: #efebe9;
        color: #5d4037;
        border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
        font-weight: bold; text-transform: uppercase;
        margin-right: 10px;
    }
    .total-spent { font-weight: 700; color: #2e7d32; font-family: 'Consolas', monospace; }

    /* --- CSS BARU (LEGEND BADGES) --- */
    .legend-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 15px;
        margin-bottom: 30px;
    }
    .legend-card {
        background: white;
        padding: 15px;
        border-radius: 10px;
        border: 1px solid #eee;
        display: flex;
        align-items: center;
        gap: 15px;
        transition: 0.3s;
    }
    .legend-card:hover { transform: translateY(-3px); box-shadow: 0 5px 15px rgba(0,0,0,0.05); }
    
    .legend-icon {
        width: 40px; height: 40px;
        border-radius: 8px;
        display: flex; align-items: center; justify-content: center;
        font-size: 1.2rem;
    }
    .legend-info h4 { margin: 0; font-size: 0.9rem; font-weight: 700; text-transform: uppercase; }
    .legend-info p { margin: 0; font-size: 0.75rem; color: #777; }

    /* WARNA BADGE & LEGEND */
    .bg-newbie { background: #e0e0e0; color: #616161; }
    .bg-bronze { background: #ffe0b2; color: #e65100; border: 1px solid #ffcc80; }
    .bg-silver { background: #e3f2fd; color: #1565c0; border: 1px solid #bbdefb; }
    .bg-gold   { background: #fff9c4; color: #fbc02d; border: 1px solid #fff176; }

    /* Badge Style untuk Tabel */
    .badge-level { padding: 5px 12px; border-radius: 20px; font-size: 0.75rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; }
</style>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 style="color: #3e2723; font-weight: 700;">Data Pelanggan</h2>
    <div class="text-muted">Total Member: <strong><?= count($pelanggan); ?></strong></div>
</div>

<!-- BAGIAN BARU: KETERANGAN STATUS (LEGEND) -->
<div class="legend-grid">
    <!-- 1. Newbie -->
    <div class="legend-card">
        <div class="legend-icon bg-newbie"><i class="bi bi-person"></i></div>
        <div class="legend-info">
            <h4 style="color: #616161;">Newbie</h4>
            <p>Belum ada transaksi</p>
        </div>
    </div>

    <!-- 2. Regular -->
    <div class="legend-card">
        <div class="legend-icon bg-bronze"><i class="bi bi-award"></i></div>
        <div class="legend-info">
            <h4 style="color: #e65100;">Regular</h4>
            <p>Belanja &lt; Rp 200rb</p>
        </div>
    </div>

    <!-- 3. Silver -->
    <div class="legend-card">
        <div class="legend-icon bg-silver"><i class="bi bi-star"></i></div>
        <div class="legend-info">
            <h4 style="color: #1565c0;">Silver</h4>
            <p>Belanja > Rp 200rb</p>
        </div>
    </div>

    <!-- 4. Gold -->
    <div class="legend-card">
        <div class="legend-icon bg-gold"><i class="bi bi-trophy-fill"></i></div>
        <div class="legend-info">
            <h4 style="color: #f9a825;">VIP Gold</h4>
            <p>Belanja > Rp 500rb</p>
        </div>
    </div>
</div>

<!-- TABEL DATA -->
<div class="card-table">
    <div class="table-responsive">
        <table class="table modern-table mb-0">
            <thead>
                <tr>
                    <th width="5%" class="text-center">#</th>
                    <th width="30%">Nama Pengguna</th>
                    <th width="20%">Bergabung Sejak</th>
                    <th width="15%" class="text-center">Total Order</th>
                    <th width="20%">Total Belanja (Lifetime)</th>
                    <th width="10%" class="text-center">Status</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($pelanggan)): ?>
                    <?php $no = 1; foreach ($pelanggan as $user): ?>
                        
                        <?php 
                            // Logika Menentukan Level Member (Sesuai Keterangan di Atas)
                            $spent = $user['total_spent'];
                            
                            // Default Newbie
                            $badgeClass = 'bg-newbie'; 
                            $badgeName  = 'Newbie';

                            if ($spent > 500000) {
                                $badgeClass = 'bg-gold';
                                $badgeName  = 'VIP Gold';
                            } elseif ($spent > 200000) {
                                $badgeClass = 'bg-silver';
                                $badgeName  = 'Silver';
                            } elseif ($spent > 0) {
                                $badgeClass = 'bg-bronze';
                                $badgeName  = 'Regular';
                            }
                        ?>

                        <tr>
                            <td class="text-center text-muted"><?= $no++; ?></td>
                            
                            <!-- Nama + Avatar -->
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="avatar-circle">
                                        <?= substr($user['username'], 0, 1); ?>
                                    </div>
                                    <span style="font-weight: 600; text-transform: capitalize;">
                                        <?= esc($user['username']); ?>
                                    </span>
                                </div>
                            </td>

                            <!-- Tanggal Join -->
                            <td>
                                <i class="bi bi-calendar3 text-muted me-1"></i>
                                <?= date('d M Y', strtotime($user['created_at'])); ?>
                            </td>

                            <!-- Jumlah Order -->
                            <td class="text-center">
                                <?php if($user['total_kunjungan'] > 0): ?>
                                    <span class="badge bg-light text-dark border">
                                        <?= $user['total_kunjungan']; ?>x
                                    </span>
                                <?php else: ?>
                                    <span class="text-muted small">-</span>
                                <?php endif; ?>
                            </td>

                            <!-- Total Belanja -->
                            <td>
                                <span class="total-spent">
                                    Rp <?= number_format($user['total_spent'], 0, ',', '.'); ?>
                                </span>
                            </td>

                            <!-- Badge Status -->
                            <td class="text-center">
                                <span class="badge-level <?= $badgeClass; ?>">
                                    <?= $badgeName; ?>
                                </span>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="text-center py-5 text-muted">
                            <i class="bi bi-people" style="font-size: 2rem;"></i>
                            <p class="mt-2">Belum ada pelanggan terdaftar.</p>
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?= $this->endSection(); ?>