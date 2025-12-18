<?= $this->extend('layout_admin'); ?>

<?= $this->section('konten_admin'); ?>

<style>
    /* 1. Card Container yang Elegan */
    .card-table {
        background: #fff;
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
        padding: 25px;
        border: 1px solid #f0f0f0;
    }

    /* 2. Styling Header Tabel */
    .modern-table thead th {
        background-color: #5d4037; /* Warna Kopi Tua */
        color: #fff;
        font-weight: 500;
        text-transform: uppercase;
        font-size: 0.85rem;
        letter-spacing: 1px;
        padding: 15px;
        border: none;
    }
    
    /* Membulatkan sudut header */
    .modern-table thead th:first-child { border-top-left-radius: 10px; }
    .modern-table thead th:last-child { border-top-right-radius: 10px; }

    /* 3. Styling Isi Tabel */
    .modern-table tbody td {
        vertical-align: middle; /* KUNCI AGAR RAPI (Tengah Vertikal) */
        padding: 15px;
        border-bottom: 1px solid #f5f5f5;
        font-size: 0.95rem;
        color: #444;
    }

    /* Efek Hover Baris */
    .modern-table tbody tr:hover {
        background-color: #fff8e1; /* Warna Krem Tipis saat di-hover */
        transition: 0.3s;
    }

    /* 4. Styling Badge Menu (Pill) */
    .menu-pill {
        display: inline-block;
        background: #fff;
        border: 1px solid #ffe0b2;
        color: #e65100;
        padding: 4px 12px;
        border-radius: 50px;
        font-size: 0.8rem;
        font-weight: 600;
        margin: 2px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.03);
    }

    /* 5. Styling Harga */
    .price-tag {
        font-family: 'Consolas', monospace; /* Font angka biar tegas */
        font-weight: 700;
        color: #2e7d32;
        background: #e8f5e9;
        padding: 6px 12px;
        border-radius: 8px;
        white-space: nowrap; /* Agar harga tidak turun baris */
    }

    /* 6. Styling Tanggal & Nama */
    .date-main { font-weight: 600; color: #333; }
    .date-sub { font-size: 0.75rem; color: #888; }
    
    .user-name { font-weight: 700; color: #3e2723; text-transform: capitalize; }
    .user-guest { color: #999; font-style: italic; font-size: 0.9rem; }
</style>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 style="color: #3e2723; font-weight: 700;">Riwayat Transaksi</h2>
    <button onclick="window.print()" class="btn btn-outline-dark btn-sm">
        <i class="bi bi-printer"></i> Cetak Laporan
    </button>
</div>

<div class="card-table">
    <div class="table-responsive">
        <table class="table modern-table mb-0">
            <thead>
                <tr>
                    <th width="5%" class="text-center">#</th>
                    <th width="20%">Waktu Order</th>
                    <th width="20%">Nama Pemesan</th>
                    <th width="40%">Detail Menu</th>
                    <th width="15%" class="text-end">Total Bayar</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($transaksi)): ?>
                    <?php $no = 1; foreach ($transaksi as $row): ?>
                        <tr>
                            <!-- Nomor -->
                            <td class="text-center text-muted"><?= $no++; ?></td>
                            
                            <!-- Waktu (Format Cantik) -->
                            <td>
                                <div class="date-main"><?= date('d M Y', strtotime($row['order_date'])); ?></div>
                                <div class="date-sub">Pukul <?= date('H:i', strtotime($row['order_date'])); ?> WIB</div>
                            </td>

                            <!-- Nama Pemesan (Dengan Logika Fallback jika Kosong) -->
                            <td>
                                <?php if (!empty($row['customer_name'])): ?>
                                    <span class="user-name"><?= esc($row['customer_name']); ?></span>
                                <?php else: ?>
                                    <!-- Jika nama kosong (data lama), tampilkan Guest -->
                                    <span class="user-guest">Guest / User Lama</span>
                                <?php endif; ?>
                            </td>

                            <!-- Detail Menu -->
                            <td>
                                <?php 
                                    $menus = explode(', ', $row['menu_list']);
                                    foreach($menus as $menu): 
                                ?>
                                    <span class="menu-pill"><?= esc($menu); ?></span>
                                <?php endforeach; ?>
                            </td>

                            <!-- Total Bayar -->
                            <td class="text-end">
                                <span class="price-tag">
                                    Rp <?= number_format($row['total_bayar'], 0, ',', '.'); ?>
                                </span>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="text-center py-5 text-muted">
                            <i class="bi bi-inbox" style="font-size: 2rem;"></i>
                            <p class="mt-2">Belum ada data transaksi masuk.</p>
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?= $this->endSection(); ?>