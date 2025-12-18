<?php

namespace App\Controllers;

use App\Models\MenuModel; //tabel 'products'
use App\Models\OrderModel; //tabel model
use App\Models\UserModel; 
use App\Models\ProductModel; 

class Admin extends BaseController
{
    public function index()
    {
        $session = session();
        if (!$session->get('logged_in') || $session->get('role') != 'admin') {
            return redirect()->to(base_url('auth/login'));
        }

        $productModel = new \App\Models\ProductModel();
        $userModel = new \App\Models\UserModel();
        $orderModel = new \App\Models\OrderModel(); // Pastikan model ini ada

        // Hitung Data
        $total_produk = $productModel->countAll();
        $total_pelanggan = $userModel->where('role', 'user')->countAllResults();
        
        // Total Transaksi (Unik berdasarkan Order ID/Waktu)
        $db = \Config\Database::connect();
        $queryTx = $db->query("SELECT COUNT(DISTINCT order_date) as total FROM orders");
        $total_transaksi = $queryTx->getRow()->total;

        // Data Grafik Penjualan (7 Hari Terakhir)
        // Ini query untuk mengambil total penjualan per hari selama 7 hari terakhir
        $queryGrafik = $db->query("
            SELECT DATE(order_date) as tgl, SUM(price * quantity) as total 
            FROM orders 
            WHERE order_date >= DATE(NOW()) - INTERVAL 7 DAY 
            GROUP BY DATE(order_date)
        ")->getResultArray();

        // Format data untuk Chart.js
        $chart_labels = [];
        $chart_data = [];
        foreach($queryGrafik as $row) {
            $chart_labels[] = date('d M', strtotime($row['tgl']));
            $chart_data[] = $row['total'];
        }

        $data = [
            'username' => $session->get('username'),
            'total_produk' => $total_produk,
            'total_transaksi' => $total_transaksi,
            'total_pelanggan' => $total_pelanggan,
            'avg_rating' => 4.5, // Dummy atau hitung rata-rata rating
            'chart_labels' => json_encode($chart_labels), // Kirim ke View sbg JSON
            'chart_data'   => json_encode($chart_data),   // Kirim ke View sbg JSON
            'produk_populer' => ['Caramel Latte', 'Cappuccino', 'Vanilla Cold Brew'] // Bisa diganti query
        ];

        return view('admin/dashboard', $data); 
    }

    // 1. Menampilkan Halaman Produk
    public function products()
    {
        $menuModel = new \App\Models\MenuModel(); // Pastikan ini model yang tabelnya 'products'
        
        $data = [
            'title' => 'Kelola Produk - Coffee Time',
            'products' => $menuModel->findAll()
        ];

        return view('admin/products', $data);
    }

    // 2. Logika Update Stok (+ atau -)
      public function update_stock()
    {
        $productModel = new ProductModel();
        
        // Ambil data yang dikirim dari form view
        $id = $this->request->getPost('id');
        $new_stock = $this->request->getPost('stock');
        
        // Validasi: Stok tidak boleh minus
        if ($new_stock < 0) {
            session()->setFlashdata('error', 'Stok tidak boleh kurang dari 0!');
            return redirect()->to(base_url('admin/products'));
        }

        // Update ke Database
        $productModel->update($id, ['stock' => $new_stock]);

        // Beri notifikasi sukses dan kembalikan ke halaman produk
        session()->setFlashdata('success', 'Stok berhasil diperbarui!');
        return redirect()->to(base_url('admin/products'));
    }
     public function transaksi()
    {
        $session = session();
        
        // Cek Login Admin
        if (!$session->get('logged_in') || $session->get('role') != 'admin') {
            return redirect()->to(base_url('auth/login'));
        }

        $orderModel = new OrderModel();

        // Siapkan data untuk dikirim ke View
        $data = [
            'title'      => 'Riwayat Transaksi',
            'username'   => $session->get('username'),
            // Panggil fungsi query khusus yang kita buat di Model tadi
            'transaksi'  => $orderModel->getTransactionHistory()
        ];

        return view('admin/transaksi_view', $data);
    }
     public function pelanggan()
    {
        $session = session();
        if (!$session->get('logged_in') || $session->get('role') != 'admin') {
            return redirect()->to(base_url('auth/login'));
        }

        $userModel = new UserModel();

        $data = [
            'title'     => 'Data Pelanggan',
            'username'  => $session->get('username'),
            // Panggil fungsi yang baru kita buat di Model
            'pelanggan' => $userModel->getCustomersWithStats()
        ];

        return view('admin/pelanggan_view', $data);
    }
}