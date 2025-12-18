<?= $this->extend('layout_admin'); ?>

<?= $this->section('konten_admin'); ?>

<!-- Font & SweetAlert -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<style>
    :root {
        --primary: #3e2723;
        --secondary: #5d4037;
        --accent: #8d6e63;
        --bg-gray: #f8f9fa;
        --card-shadow: 0 10px 20px rgba(0,0,0,0.05);
        --hover-shadow: 0 15px 30px rgba(62, 39, 35, 0.15);
    }

    body { font-family: 'Poppins', sans-serif; background-color: var(--bg-gray); }

    /* HEADER */
    .page-header {
        display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;
    }
    .page-title h2 { font-weight: 700; color: var(--primary); margin: 0; }
    .page-title p { color: #888; font-size: 0.9rem; margin-top: 5px; }
    
    .btn-add-new {
        background: var(--primary); color: #fff; padding: 12px 25px; border-radius: 50px;
        text-decoration: none; font-weight: 600; font-size: 0.9rem; transition: 0.3s;
        box-shadow: 0 5px 15px rgba(62, 39, 35, 0.3); display: flex; align-items: center; gap: 8px;
    }
    .btn-add-new:hover { background: var(--secondary); transform: translateY(-3px); color: #fff; }

    /* GRID LAYOUT */
    .products-grid {
        display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 25px;
    }

    /* PRODUCT CARD */
    .prod-card {
        background: #fff; border-radius: 20px; overflow: hidden; position: relative;
        box-shadow: var(--card-shadow); transition: 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        border: 1px solid rgba(0,0,0,0.02); display: flex; flex-direction: column;
    }
    .prod-card:hover { transform: translateY(-10px); box-shadow: var(--hover-shadow); }

    /* Image Area */
    .prod-img-wrap {
        height: 180px; overflow: hidden; position: relative;
    }
    .prod-img { width: 100%; height: 100%; object-fit: cover; transition: 0.5s; }
    .prod-card:hover .prod-img { transform: scale(1.1); }

    /* Overlay Actions (Edit/Delete) */
    .card-actions {
        position: absolute; top: 15px; right: 15px; display: flex; gap: 8px;
        opacity: 0; transform: translateY(-10px); transition: 0.3s;
    }
    .prod-card:hover .card-actions { opacity: 1; transform: translateY(0); }
    
    .action-btn {
        width: 35px; height: 35px; border-radius: 50%; background: rgba(255,255,255,0.9);
        display: flex; align-items: center; justify-content: center; color: var(--primary);
        text-decoration: none; box-shadow: 0 5px 15px rgba(0,0,0,0.2); transition: 0.2s;
    }
    .action-btn:hover { background: var(--primary); color: #fff; }
    .btn-del:hover { background: #e74c3c; color: #fff; }

    /* Content Area */
    .prod-content { padding: 20px; flex: 1; display: flex; flex-direction: column; }
    
    .prod-category { 
        font-size: 0.75rem; text-transform: uppercase; color: #999; letter-spacing: 1px; font-weight: 600; margin-bottom: 5px; 
    }
    .prod-title { font-size: 1.1rem; font-weight: 700; color: #333; margin-bottom: 10px; line-height: 1.3; }
    
    .prod-price { 
        font-size: 1.1rem; font-weight: 700; color: var(--primary); margin-bottom: 15px; 
        display: flex; align-items: center; gap: 5px;
    }
    .badge-status {
        font-size: 0.7rem; padding: 3px 8px; border-radius: 6px; font-weight: 600; margin-left: auto;
    }
    .bg-ok { background: #e8f5e9; color: #2e7d32; }
    .bg-low { background: #fff3e0; color: #ef6c00; }
    .bg-out { background: #ffebee; color: #c62828; }

    /* Stock Control Area */
    .stock-area {
        margin-top: auto; padding-top: 15px; border-top: 1px dashed #eee;
    }
    .stock-label { font-size: 0.85rem; color: #666; margin-bottom: 5px; display: flex; justify-content: space-between; }
    
    /* Progress Bar Stok */
    .progress-track { width: 100%; height: 6px; background: #eee; border-radius: 10px; overflow: hidden; margin-bottom: 15px; }
    .progress-fill { height: 100%; border-radius: 10px; transition: 0.5s; }

    /* Form Stok */
    .stock-form {
        display: flex; align-items: center; justify-content: space-between;
        background: #f8f9fa; padding: 5px 8px; border-radius: 50px; border: 1px solid #eee;
    }
    .btn-qty {
        width: 28px; height: 28px; border-radius: 50%; border: none; background: #fff;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1); color: var(--primary); cursor: pointer; font-weight: bold; transition: 0.2s;
    }
    .btn-qty:hover { background: var(--accent); color: #fff; }
    
    .input-qty {
        width: 40px; text-align: center; border: none; background: transparent; font-weight: 700; font-size: 0.9rem; color: #333; outline: none;
    }
    /* Hide number arrows */
    .input-qty::-webkit-outer-spin-button, .input-qty::-webkit-inner-spin-button { -webkit-appearance: none; margin: 0; }

    .btn-save {
        background: var(--primary); color: #fff; border: none; padding: 6px 15px; border-radius: 30px;
        font-size: 0.8rem; font-weight: 600; cursor: pointer; transition: 0.3s; margin-left: 10px;
    }
    .btn-save:hover { background: #2e7d32; box-shadow: 0 4px 10px rgba(46, 125, 50, 0.3); }

</style>

<!-- HEADER -->
<div class="page-header">
    <div class="page-title">
        <h2>Katalog Menu</h2>
        <p>Kelola stok dan harga produk dengan mudah.</p>
    </div>
    
</div>

<!-- PRODUCT GRID -->
<div class="products-grid">
    
    <?php if(!empty($products)): ?>
        <?php foreach($products as $item): ?>
            <?php 
                $stok = $item['stock'];
                // Logic Status & Warna Progress Bar
                if ($stok <= 0) {
                    $statusClass = 'bg-out'; $statusText = 'Sold Out'; $barColor = '#c62828'; $barWidth = '100%';
                } elseif ($stok < 10) {
                    $statusClass = 'bg-low'; $statusText = 'Menipis'; $barColor = '#ef6c00'; $barWidth = ($stok * 10) . '%';
                } else {
                    $statusClass = 'bg-ok'; $statusText = 'Available'; $barColor = '#2e7d32'; $barWidth = min($stok, 100) . '%';
                }
            ?>

            <div class="prod-card">
                <!-- Image & Actions -->
                <div class="prod-img-wrap">
                    <img src="<?= base_url($item['image']); ?>" class="prod-img" alt="Product">
                    
                    <div class="card-actions">
                        <a href="#" class="action-btn" title="Edit"><i class="bi bi-pencil-fill"></i></a>
                        <a href="#" class="action-btn btn-del" title="Hapus" onclick="confirmDelete(<?= $item['id']; ?>)"><i class="bi bi-trash-fill"></i></a>
                    </div>
                </div>

                <!-- Details -->
                <div class="prod-content">
                    <div class="prod-category">Coffee / Main Course</div>
                    <div class="prod-title"><?= $item['name']; ?></div>
                    
                    <div class="prod-price">
                        <span>Rp <?= number_format($item['price'], 0, ',', '.'); ?></span>
                        <span class="badge-status <?= $statusClass; ?>"><?= $statusText; ?></span>
                    </div>

                    <!-- Stock Management -->
                    <div class="stock-area">
                        <div class="stock-label">
                            <span>Sisa Stok</span>
                            <strong><?= $stok; ?> unit</strong>
                        </div>
                        
                        <!-- Visual Bar -->
                        <div class="progress-track">
                            <div class="progress-fill" style="width: <?= $barWidth; ?>; background: <?= $barColor; ?>;"></div>
                        </div>

                        <!-- Update Form -->
                        <form action="<?= base_url('admin/products/update_stock'); ?>" method="post" class="stock-form">
                            <input type="hidden" name="id" value="<?= $item['id']; ?>">
                            
                            <div style="display:flex; align-items:center;">
                                <button type="button" class="btn-qty" onclick="adjustQty(this, -1)">-</button>
                                <input type="number" name="stock" class="input-qty" value="<?= $stok; ?>" min="0">
                                <button type="button" class="btn-qty" onclick="adjustQty(this, 1)">+</button>
                            </div>

                            <button type="submit" class="btn-save"><i class="bi bi-check2"></i> Simpan</button>
                        </form>
                    </div>
                </div>
            </div>

        <?php endforeach; ?>
    <?php else: ?>
        <p style="grid-column: 1/-1; text-align: center; color: #999; padding: 50px;">Belum ada data produk.</p>
    <?php endif; ?>

</div>

<!-- SCRIPT LOGIC -->
<script>
    // Logic Notifikasi
    <?php if(session()->getFlashdata('success')): ?>
        Swal.fire({
            icon: 'success', title: 'Berhasil!', text: '<?= session()->getFlashdata('success'); ?>',
            timer: 1500, showConfirmButton: false, toast: true, position: 'top-end'
        });
    <?php endif; ?>

    // Logic Adjust Quantity Input
    function adjustQty(btn, amount) {
        const input = btn.parentElement.querySelector('.input-qty');
        let val = parseInt(input.value) || 0;
        val += amount;
        if(val < 0) val = 0;
        input.value = val;
    }

    // Logic Delete Confirmation
    function confirmDelete(id) {
        Swal.fire({
            title: 'Yakin hapus?', text: "Data tidak bisa dikembalikan!", icon: 'warning',
            showCancelButton: true, confirmButtonColor: '#d33', cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, Hapus!'
        }).then((result) => {
            if (result.isConfirmed) {
                // Redirect ke URL delete (pastikan route delete sudah ada di controller)
                window.location.href = "<?= base_url('admin/products/delete/'); ?>" + id;
            }
        });
    }
</script>

<?= $this->endSection(); ?>