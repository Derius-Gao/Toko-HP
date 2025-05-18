<?php
namespace App\Models;

use CodeIgniter\Model;

class TransaksiModel extends Model
{
    protected $table = 'transaksi';
    protected $primaryKey = 'id_transaksi';
    protected $allowedFields = [
        'id_user', 'tanggal', 'total_harga', 'metode_pembayaran', 'bukti_pembayaran', 'status_pembayaran'
    ];
}