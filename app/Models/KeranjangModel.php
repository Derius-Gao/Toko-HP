<?php
namespace App\Models;

use CodeIgniter\Model;

class KeranjangModel extends Model
{
    protected $table = 'keranjang'; // Nama tabel di database
    protected $primaryKey = 'id_keranjang'; // Primary key tabel
    protected $allowedFields = ['id_user', 'id_hp', 'jumlah', 'created_at', 'updated_at']; // Kolom yang dapat diisi
}