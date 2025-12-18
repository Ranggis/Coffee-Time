<?php

namespace App\Controllers;

// PENTING: Jangan lupa baris ini agar database terbaca
use App\Models\ProductModel; 

class Home extends BaseController
{
    // 1. FUNGSI UNTUK HALAMAN DEPAN (INDEX)
    public function index()
    {
        // Cek Login (Opsional, sesuaikan dengan logic loginmu)
        $session = session();
        $data['is_logged_in'] = $session->has('user_id');
        $data['username'] = $session->get('username');

        // Panggil View Halaman Utama
        return view('home/index', $data);
    }

    // 2. FUNGSI UNTUK HALAMAN MENU (INI YANG TADINYA HILANG/ERROR)
    public function menu()
    {
        // Panggil Model Database
        $model = new ProductModel();
        
        // Ambil semua data kopi
        $data['products'] = $model->findAll();

        // Cek Login lagi untuk navbar di halaman menu
        $session = session();
        $data['is_logged_in'] = $session->has('user_id');
        $data['username'] = $session->get('username');
        // Panggil View Menu
        return view('menu_view', $data);
    }
    // ... fungsi index dan menu yang lama biarkan saja ...

    // 3. HALAMAN SHOWCASE (Tampilan Menu Elegan Tanpa Order)
    public function showcase()
    {
        $model = new ProductModel();
        $data['products'] = $model->findAll();

        // Data Navbar (tetap butuh session untuk login/logout)
        $session = session();
        $data['is_logged_in'] = $session->has('user_id');
        $data['username'] = $session->get('username');

        return view('menu_showcase', $data);
    }
    public function about()
    {
        $session = session();
        $data['is_logged_in'] = $session->has('user_id');
        $data['username'] = $session->get('username');
        return view('about_view', $data);
    }
    public function contact()
    {
        $session = session();
        $data['is_logged_in'] = $session->has('user_id');
        $data['username'] = $session->get('username');
        return view('contact_view', $data);
    }
    public function products()
    {
        $model = new ProductModel();
        $data['products'] = $model->findAll();

        $session = session();
        $data['is_logged_in'] = $session->has('user_id');
        $data['username'] = $session->get('username');

        // Pastikan kamu sudah menyimpan file HTML products tadi dengan nama 'products.php' di folder Views
        return view('products', $data); 
    }
    public function gallery()
    {
        $session = session();
        $data = [
            'is_logged_in' => $session->has('user_id'),
            'username'     => $session->get('username')
        ];
        return view('gallery', $data);
    }
    public function blog()
    {
        $session = session();
        $data = [
            'is_logged_in' => $session->has('user_id'),
            'username'     => $session->get('username')
        ];
        return view('blog', $data);
    }
}