<?php

namespace App\Controllers;

use App\Models\ProductModel;
use App\Models\OrderModel; // Pastikan model ini ada (kita pakai query builder manual jg bisa)

class Checkout extends BaseController
{
    public function index()
    {
        // Cek Login
        if (!session()->get('logged_in')) {
            return redirect()->to(base_url('auth/login'));
        }

        $data = [
            'title' => 'Checkout - Coffee Time',
            'username' => session()->get('username')
        ];

        return view('checkout_view', $data);
    }

    // FUNGSI PROSES BAYAR (DIPANGGIL VIA AJAX/FETCH)
    public function process()
    {
        $request = service('request');
        
        // 1. Ambil Data JSON dari JavaScript
        $json = $request->getJSON(); 
        
        if (!$json) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Data kosong']);
        }

        $userId       = session()->get('user_id');
        $customerName = $json->customer_name;
        $items        = $json->items; // Array barang
        $orderDate    = date('Y-m-d H:i:s');

        $db = \Config\Database::connect();
        $productModel = new ProductModel();
        
        // Gunakan Transaction agar aman (Rollback jika ada error di tengah jalan)
        $db->transStart();

        foreach ($items as $item) {
            $name = $item->name;
            $qty  = $item->qty;
            $price = $item->price;

            // 2. Cek Stok di Database dulu
            $product = $productModel->where('name', $name)->first();
            
            if (!$product || $product['stock'] < $qty) {
                // Jika stok habis saat mau bayar
                return $this->response->setJSON([
                    'status' => 'error', 
                    'message' => "Stok untuk {$name} tidak mencukupi!"
                ]);
            }

            // 3. Kurangi Stok
            $newStock = $product['stock'] - $qty;
            $productModel->update($product['id'], ['stock' => $newStock]);

            // 4. Masukkan ke Tabel Orders
            $db->table('orders')->insert([
                'user_id'       => $userId,
                'customer_name' => $customerName,
                'item_name'     => $name,
                'price'         => $price,
                'quantity'      => $qty,
                'order_date'    => $orderDate
            ]);
        }

        $db->transComplete();

        if ($db->transStatus() === FALSE) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Transaksi Gagal.']);
        } else {
            return $this->response->setJSON(['status' => 'success', 'message' => 'Pesanan Berhasil!']);
        }
    }
}