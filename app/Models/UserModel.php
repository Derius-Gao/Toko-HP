<?php

namespace App\Models;

use CodeIgniter\Model;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
class UserModel extends Model
{
    protected $table      = 'user';
    protected $primaryKey = 'id_user';

    protected $allowedFields = [
        'username', 'nama_user', 'email', 'password', 'level',
        'delete_status', 'reset_token', 'reset_token_expiry',
        'created_by', 'created_at', 'updated_by', 'updated_at',
        'deleted_by', 'deleted_at'
    ];
    public function updateResetToken($id_user, $token_hash, $expiry)
{
    return $this->update($id_user, [
        'reset_token' => $token_hash,
        'reset_token_expiry' => $expiry
    ]);
}

    public function getWhere($table, $where){
        return $this->db->table($table)
        ->getWhere($where)
        ->getRow();
      }
    public function getTotalByLevel($level)
    {
        return $this->where('level', $level)->countAllResults();
    }

    // Ambil semua user (termasuk yang soft delete)
    public function getAllUsers()
    {
        return $this->findAll(); 
    }

    // Ambil user yang tidak dihapus (delete_status = 0)
    public function getActiveUsers()
    {
        return $this->where('delete_status', 0)->findAll();
    }

    // Soft Delete: ubah delete_status menjadi 1
    public function softDeleteUser($id, $id_user)
    {
        return $this->update($id, [
            'delete_status' => 1,
            'deleted_by'    => $id_user, // Catat siapa yang menghapus
            'deleted_at'    => date('Y-m-d H:i:s'), // Catat waktu penghapusan
            'updated_by'    => $id_user, // Perbarui informasi user yang terakhir mengubah
            'updated_at'    => date('Y-m-d H:i:s'), // Perbarui waktu terakhir diubah
        ]);
    }
    
    // Restore User
    public function restoreUser($id, $id_user)
    {
        return $this->update($id, [
            'delete_status' => 0,
            'updated_by'    => $id_user, // Catat siapa yang me-*restore*
            'updated_at'    => date('Y-m-d H:i:s'), // Perbarui waktu terakhir diubah
        ]);
    }
    
    // Restore Semua User
    public function restoreAllUsers($id_user)
    {
        return $this->where('delete_status', 1)->set([
            'delete_status' => 0,
            'updated_by'    => $id_user, // Catat siapa yang me-*restore* semua user
            'updated_at'    => date('Y-m-d H:i:s'), // Perbarui waktu terakhir diubah
        ])->update();
    }
    
    public function updateUser($id_user, $data)
    {
        // Cek apakah ada password baru
        if (!empty($data['password'])) {
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        } else {
            unset($data['password']); // Jangan update password jika kosong
        }

        return $this->update($id_user, $data);
    }
    public function insertUser($data)
{
    return $this->insert($data);
}
public function deleteUserPermanently($id_user_target, $id_user_executor)
{
    // Catat log penghapusan sebelum hard delete
    $this->update($id_user_target, [
        'deleted_by' => $id_user_executor,
        'deleted_at' => date('Y-m-d H:i:s'),
        'updated_by' => $id_user_executor,
        'updated_at' => date('Y-m-d H:i:s'),
    ]);

    // Lakukan hard delete
    return $this->delete($id_user_target); // true = force delete
}

}