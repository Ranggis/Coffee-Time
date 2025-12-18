<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;

class Auth extends BaseController
{
    public function login()
    {
        return view('login_view');
    }

    public function process_register()
    {
        $userModel = new UserModel();

        // 1. Ambil data (TANPA EMAIL)
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        // 2. Cek apakah username sudah ada?
        $existingUser = $userModel->where('username', $username)->first();
        if($existingUser){
            session()->setFlashdata('error', 'Username sudah terdaftar, cari yang lain!');
            return redirect()->to(base_url('auth/login'));
        }

        // 3. Hash Password (Wajib biar aman)
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        // 4. Simpan ke Database
        $userModel->save([
            'username' => $username,
            'password' => $passwordHash,
            'role'     => 'user' // Default role user
        ]);

        session()->setFlashdata('success', 'Akun berhasil dibuat! Silakan Login.');
        return redirect()->to(base_url('auth/login'));
    }

    public function process_login()
    {
        $session = session();
        $userModel = new UserModel();

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        // 1. Cari user di database
        $data = $userModel->where('username', $username)->first();

        if ($data) {
            // 2. Verifikasi Password
            $pass_db = $data['password'];
            
            // Cek Password Hash (Untuk user baru)
            $verify_pass = password_verify($password, $pass_db);

            if ($verify_pass) {
                // Buat Session
                $ses_data = [
                    'user_id'   => $data['id'],
                    'username'  => $data['username'],
                    'role'      => $data['role'],
                    'logged_in' => TRUE
                ];
                $session->set($ses_data);
            
                // Redirect sesuai Role
                if($data['role'] == 'admin'){
                    // --- TAMBAHKAN BARIS INI ---
                    session()->setFlashdata('sapa_admin', 'Selamat Datang, Administrator!');
                    // ---------------------------
                    
                    return redirect()->to(base_url('/admin')); 
                } else {
                    return redirect()->to(base_url('/')); 
                }
            
            } else {
                $session->setFlashdata('error', 'Password salah!');
                return redirect()->to(base_url('auth/login'));
            }
        } else {
            $session->setFlashdata('error', 'Username tidak ditemukan!');
            return redirect()->to(base_url('auth/login'));
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to(base_url('auth/login'));
    }
}