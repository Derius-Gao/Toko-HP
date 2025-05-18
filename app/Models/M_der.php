<?php

namespace App\Models;

use CodeIgniter\Model;

class M_der extends Model
{
    public function tampil($table, $orderBy)
{
    return $this->db->table($table)->orderBy($orderBy, 'ASC')->get()->getResultArray();
}

    // **Ambil semua data tanpa sorting**
    public function eltampil($table)
    {
        return $this->db->table($table)
            ->get()
            ->getResult();
    }

    // **Join dua tabel**
    public function join($table, $table2, $on)
    {
        return $this->db->table($table)
            ->join($table2, $on)
            ->get()
            ->getResult();
    }

    // **Join dengan filter tambahan**
    public function filter($table, $table2, $on, $filter1, $filter2, $awal, $akhir)
    {
        return $this->db->table($table)
            ->join($table2, $on)
            ->where($filter1, $awal)
            ->where($filter2, $akhir)
            ->get()
            ->getResult();
    }

    // **Join dengan kondisi WHERE**
    public function joinw($table, $table2, $on, $w)
    {
        return $this->db->table($table)
            ->join($table2, $on)
            ->where($w)
            ->get()
            ->getRow();
    }

    // **Hapus data (hard delete)**
    public function hapus($table, $where)
    {
        return $this->db->table($table)->where($where)->delete();
    }

    // **Ambil satu baris data berdasarkan kondisi**
    public function getWhere($table, $where)
    {
        return $this->db->table($table)->getWhere($where)->getRow();
    }

    // **Update data**
    public function edit($table, $data, $where)
    {
        return $this->db->table($table)->update($data, $where);
    }

    // **Insert data baru**
    public function input($table, $data)
    {
        return $this->db->table($table)->insert($data);
    }
}
