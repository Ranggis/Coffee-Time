<?php

namespace App\Models;

use CodeIgniter\Model;

class OrderModel extends Model
{
    protected $table      = 'orders';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id', 'customer_name', 'item_name', 'price', 'quantity', 'order_date'];

    // Fungsi Khusus untuk Mengambil Data Transaksi yang Dikelompokkan
    public function getTransactionHistory()
    {
        // Kita gunakan Query Builder untuk meniru logika SQL "GROUP BY"
        // tujuannya menggabungkan menu yang dibeli di waktu yang sama menjadi satu baris
        return $this->db->table($this->table)
            ->select("
                customer_name, 
                order_date,
                GROUP_CONCAT(CONCAT(item_name, ' (', quantity, ')') SEPARATOR ', ') as menu_list,
                SUM(price * quantity) as total_bayar
            ")
            ->groupBy(['user_id', 'order_date']) // Kelompokkan berdasarkan User & Waktu
            ->orderBy('order_date', 'DESC')      // Urutkan dari yang terbaru
            ->get()
            ->getResultArray();
    }
}