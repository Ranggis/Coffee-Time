<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Coffee Time</title>

    <!-- CSS Login -->
    <link rel="stylesheet" href="<?= base_url('css/login.css') ?>">
    <!-- Boxicons -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <!-- SweetAlert2 (Untuk Notifikasi Keren) -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>

    <div class="container">
        
        <!-- Form Login -->
        <div class="form-box login">
            <!-- UPDATE ACTION DISINI -->
            <form action="<?= base_url('auth/process_login') ?>" method="post">
                <h1>Login</h1>

                <div class="input-box">
                    <input type="text" name="username" placeholder="Username" required>
                    <i class='bx bxs-user'></i>
                </div>

                <div class="input-box">
                    <input type="password" name="password" placeholder="Password" required>
                    <i class='bx bxs-lock-alt'></i>
                </div>

                <div class="forgot-link">
                    <a href="#">Forgot password?</a>
                </div>

                <button type="submit" class="btn">Login</button>
            </form>
        </div>

        <!-- Form Register -->
        <div class="form-box register">
            <!-- UPDATE ACTION DISINI -->
            <form action="<?= base_url('auth/process_register') ?>" method="post">
                <h1>Registration</h1>

                <div class="input-box">
                    <input type="text" name="username" placeholder="Username" required>
                    <i class='bx bxs-user'></i>
                </div>

                <div class="input-box">
                    <input type="email" name="email" placeholder="Email" required>
                    <i class='bx bxs-envelope'></i>
                </div>

                <div class="input-box">
                    <input type="password" name="password" placeholder="Password" required>
                    <i class='bx bxs-lock-alt'></i>
                </div>

                <button type="submit" class="btn">Register</button>
            </form>
        </div>

        <!-- Toggle Panel (Samping) -->
        <div class="toggle-box">
            <div class="toggle-panel toggle-left">
                <h1>Hello, Welcome!</h1>
                <p>Don't have an account?</p>
                <button class="btn register-btn">Register</button>
            </div>

            <div class="toggle-panel toggle-right">
                <h1>Welcome Back!</h1>
                <p>Already have an account?</p>
                <button class="btn login-btn">Login</button>
            </div>
        </div>
    </div>

    <!-- JS Login (Animasi) -->
    <script src="<?= base_url('js/login.js') ?>"></script>

    <!-- SCRIPT MENANGKAP PESAN ERROR/SUKSES DARI CONTROLLER -->
    <script>
        <?php if(session()->getFlashdata('error')): ?>
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: '<?= session()->getFlashdata('error') ?>',
                confirmButtonColor: '#b6895b'
            });
        <?php endif; ?>

        <?php if(session()->getFlashdata('success')): ?>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '<?= session()->getFlashdata('success') ?>',
                confirmButtonColor: '#b6895b'
            });
        <?php endif; ?>
    </script>

</body>
</html>