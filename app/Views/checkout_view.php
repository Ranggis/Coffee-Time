<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title><?= $title ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<!-- Style & Icons -->
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600&display=swap" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<style>
    body { background: #1b0f12; color: #f5deb3; font-family: 'Playfair Display', serif; padding: 20px; }
    .container { max-width: 800px; margin: 0 auto; background: rgba(255,255,255,0.05); padding: 40px; border-radius: 15px; border: 1px solid rgba(245,222,179,0.2); }
    h2 { text-align: center; border-bottom: 1px solid #f5deb3; padding-bottom: 20px; }
    
    /* Tabel Ringkasan */
    table { width: 100%; border-collapse: collapse; margin-top: 20px; color: #fff; }
    th, td { padding: 15px; border-bottom: 1px solid rgba(255,255,255,0.1); text-align: left; }
    th { color: #f5deb3; }
    .total-row td { font-size: 1.2rem; font-weight: bold; color: #f5deb3; border-top: 2px solid #f5deb3; }

    /* Form */
    .form-group { margin-top: 20px; }
    label { display: block; margin-bottom: 8px; }
    input, select { width: 100%; padding: 12px; background: rgba(0,0,0,0.3); border: 1px solid #555; color: #fff; border-radius: 5px; }
    
    /* Tombol */
    .btn-pay { width: 100%; padding: 15px; background: #f5deb3; color: #1b0f12; font-weight: bold; border: none; border-radius: 50px; margin-top: 30px; cursor: pointer; font-size: 1rem; transition: 0.3s; }
    .btn-pay:hover { background: #fff; }
    .btn-back { display: block; text-align: center; margin-top: 15px; color: #999; text-decoration: none; }

    /* Modal QRIS */
    .modal-overlay { display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.8); justify-content: center; align-items: center; z-index: 1000; }
    .qris-box { background: white; padding: 30px; border-radius: 15px; text-align: center; width: 320px; color: #333; }
    .qris-box img { width: 200px; margin: 15px 0; }
    .spinner { border: 4px solid #f3f3f3; border-top: 4px solid #8B4513; border-radius: 50%; width: 20px; height: 20px; animation: spin 1s linear infinite; display: inline-block; vertical-align: middle; }
    @keyframes spin { 0% { transform: rotate(0deg); } 100% { transform: rotate(360deg); } }
</style>
</head>
<body>

<div class="container">
    <h2>Checkout Confirmation</h2>

    <!-- Tempat List Item -->
    <div id="cart-summary">
        <table>
            <thead>
                <tr>
                    <th>Menu</th>
                    <th>Qty</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody id="cart-table-body">
                <!-- Diisi oleh JS -->
            </tbody>
            <tfoot>
                <tr class="total-row">
                    <td colspan="2">Total Payment</td>
                    <td id="grand-total">Rp 0</td>
                </tr>
            </tfoot>
        </table>
    </div>

    <div class="form-group">
        <label>Customer Name (on Receipt)</label>
        <input type="text" id="customerName" placeholder="Enter your name..." required>
    </div>

    <div class="form-group">
        <label>Payment Method</label>
        <select id="paymentMethod">
            <option value="qris">QRIS (Scan Barcode)</option>
            <option value="cash">Cashier (Pay at Counter)</option>
        </select>
    </div>

    <button class="btn-pay" onclick="handleCheckout()">Confirm & Pay</button>
    <a href="<?= base_url('menu') ?>" class="btn-back">Cancel & Go Back</a>
</div>

<!-- Modal QRIS Dummy -->
<div id="qrisModal" class="modal-overlay">
    <div class="qris-box">
        <h3 style="margin:0; color:#8B4513;">Scan QRIS</h3>
        <p style="font-size:0.9rem; color:#666;">Scan code below via E-Wallet</p>
        <img src="https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=CoffeeTime-Payment" alt="QRIS">
        <div id="qris-status" style="font-weight:bold; color:#d84315;">
            <div class="spinner"></div> Waiting for payment...
        </div>
    </div>
</div>

<script>
    // 1. LOAD DATA DARI LOCALSTORAGE
    let cart = JSON.parse(localStorage.getItem('coffee_cart')) || [];
    
    // Jika kosong, tendang balik
    if (cart.length === 0) {
        Swal.fire('Empty Cart', 'Please order something first.', 'info').then(() => {
            window.location.href = "<?= base_url('menu') ?>";
        });
    }

    // Render Tabel
    const tbody = document.getElementById('cart-table-body');
    let grandTotal = 0;

    cart.forEach(item => {
        let subtotal = item.price * item.qty;
        grandTotal += subtotal;
        
        tbody.innerHTML += `
            <tr>
                <td>${item.name}</td>
                <td>${item.qty}x</td>
                <td>Rp ${new Intl.NumberFormat('id-ID').format(subtotal)}</td>
            </tr>
        `;
    });
    
    document.getElementById('grand-total').innerText = "Rp " + new Intl.NumberFormat('id-ID').format(grandTotal);

    // 2. FUNGSI UTAMA CHECKOUT
    function handleCheckout() {
        const name = document.getElementById('customerName').value;
        const method = document.getElementById('paymentMethod').value;

        if (name.trim() === "") {
            Swal.fire('Name Required', 'Please enter your name for the receipt.', 'warning');
            return;
        }

        if (method === 'qris') {
            showQris();
        } else {
            // Jika Cash, langsung proses
            processOrder(name);
        }
    }

    // 3. SIMULASI QRIS (5 Detik)
    function showQris() {
        const modal = document.getElementById('qrisModal');
        const status = document.getElementById('qris-status');
        const name = document.getElementById('customerName').value;

        modal.style.display = 'flex';

        // Timer 5 detik
        setTimeout(() => {
            status.innerHTML = '<span style="color:green">✅ Payment Success!</span>';
            setTimeout(() => {
                modal.style.display = 'none';
                processOrder(name); // Lanjut ke database
            }, 1000);
        }, 5000);
    }

    // 4. KIRIM DATA KE SERVER (CONTROLLER)
    function processOrder(customerName) {
        // Data yang akan dikirim ke Checkout.php
        const payload = {
            customer_name: customerName,
            items: cart
        };

        fetch('<?= base_url("checkout/process") ?>', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: JSON.stringify(payload)
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                // Hapus Keranjang
                localStorage.removeItem('coffee_cart');
                
                Swal.fire({
                    icon: 'success',
                    title: 'Order Successful!',
                    text: 'Thank you for ordering. Please wait for your coffee.',
                    confirmButtonColor: '#f5deb3',
                    confirmButtonText: '<span style="color:#1b0f12">Back to Menu</span>'
                }).then(() => {
                    window.location.href = "<?= base_url('menu') ?>";
                });
            } else {
                Swal.fire('Failed', data.message, 'error');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            Swal.fire('Error', 'Something went wrong.', 'error');
        });
    }
</script>

</body>
</html>