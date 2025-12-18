<?php

namespace App\Models;

use CodeIgniter\Model;

class MenuModel extends Model
{
    protected $table = 'products'; // Sesuai nama tabel
    protected $primaryKey = 'id';
    
    // Sesuaikan dengan kolom yang ada di gambar (name, price, description, rating, image, stock)
    protected $allowedFields = ['name', 'price', 'description', 'rating', 'image', 'stock'];
}