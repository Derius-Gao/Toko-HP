<?php

namespace App\Models;

use CodeIgniter\Model;

class HpModel extends Model
{
    protected $table = 'hp'; // Nama tabel di database
    protected $primaryKey = 'id_hp'; // Primary key tabel
    protected $allowedFields = ['merk', 'tahun', 'kondisi', 'harga', 'deskripsi', 'foto_hp', 'created_at']; // Kolom yang dapat diisi
}