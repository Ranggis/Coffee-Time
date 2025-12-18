<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $allowedFields = ['username', 'email', 'password', 'role'];


public function getCustomersWithStats()
    {
        return $this->db->table('users as u')
            ->select('u.id, u.username, u.created_at')
            ->select('COUNT(DISTINCT o.order_date) as total_kunjungan') // Hitung berapa kali checkout
            ->select('COALESCE(SUM(o.price * o.quantity), 0) as total_spent') // Hitung total uang keluar
            ->join('orders as o', 'o.user_id = u.id', 'left')
            ->where('u.role', 'user') // Hanya ambil user biasa, bukan admin
            ->groupBy('u.id')
            ->orderBy('total_spent', 'DESC') // Urutkan dari yang paling banyak jajan (Sultan)
            ->get()
            ->getResultArray();
    }
}