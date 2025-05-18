<?php
namespace App\Controllers;

use App\Models\KeranjangModel;
use App\Models\HpModel;
use App\Models\ActivityLogModel;
use App\Models\UserModel;

class Keranjang extends BaseController
{
    private function logActivity($action)
{
    $id_user = session()->get('id_user'); // Ambil id_user dari session
    $ip_address = $this->request->getIPAddress();

    if ($id_user) {
        // Ambil data user dari tabel user
        $userModel = new UserModel();
        $user = $userModel->find($id_user);

        if ($user) {
            $username = $user['username']; // Ambil username dari tabel user

            // Simpan log aktivitas
            $logModel = new ActivityLogModel();
            $logModel->insert([
                'id_user' => $id_user,
                'username' => $username,
                'aksi' => $action,
                'timestamp' => date('Y-m-d H:i:s'),
                'ip_address' => $ip_address
            ]);
        } else {
            log_message('error', 'User not found in database for id_user: ' . $id_user);
        }
    } else {
        log_message('error', 'Session id_user is missing.');
    }
}
public function updateJumlah()
{
    $data = $this->request->getJSON();
    $id_keranjang = $data->id_keranjang;
    $jumlah = $data->jumlah;

    $keranjangModel = new \App\Models\KeranjangModel();
    $keranjangModel->update($id_keranjang, ['jumlah' => $jumlah]);

    return $this->response->setJSON(['status' => 'ok']);
}
public function keranjang()
{
     $this->logActivity("User mengakses menu keranjang");
    $keranjangModel = new KeranjangModel();
    $hpModel = new HpModel();

    // Ambil ID user dari session
    $id_user = session()->get('id_user');
    $level = session()->get('level'); // Level user (superadmin atau user biasa)

    if ($level === 'superadmin') {
        // Jika superadmin, ambil semua data keranjang
        $keranjang = $keranjangModel->findAll();
    } else {
        // Jika user biasa, ambil data keranjang berdasarkan ID user
        $keranjang = $keranjangModel->where('id_user', $id_user)->findAll();
    }

    // Gabungkan data keranjang dengan data HP
    foreach ($keranjang as &$item) {
        $hp = $hpModel->find($item['id_hp']);
        $item['hp'] = $hp; // Tambahkan data HP ke item keranjang
    }
     echo view('surga');
         echo view('menu');
    echo view('keranjang', ['keranjang' => $keranjang]);
          echo view('neraka');
}
public function pesan($id_hp)
{
    if ($this->request->isAJAX()) {
        $json = $this->request->getJSON();
        if ($json && isset($json->id_hp)) {
            $id_hp = $json->id_hp;
        }
    }

    $this->logActivity("User memesan Hp nomor $id_hp");
    $keranjangModel = new KeranjangModel();
    $id_user = session()->get('id_user');

    if (!$id_user) {
        if ($this->request->isAJAX()) {
            return $this->response->setJSON(['status' => 'login', 'redirect' => base_url('/Login/login')]);
        }
        return redirect()->to(base_url('/Login/login'))->with('error', 'Silakan login terlebih dahulu.');
    }

    $existingItem = $keranjangModel->where('id_user', $id_user)->where('id_hp', $id_hp)->first();

    if ($existingItem) {
        $keranjangModel->update($existingItem['id_keranjang'], [
            'jumlah' => $existingItem['jumlah'] + 1,
        ]);
    } else {
        $keranjangModel->insert([
            'id_user' => $id_user,
            'id_hp' => $id_hp,
            'jumlah' => 1,
        ]);
    }

    if ($this->request->isAJAX()) {
        return $this->response->setJSON(['status' => 'ok']);
    }
    return redirect()->to(base_url('/Keranjang/keranjang'))->with('message', 'HP berhasil ditambahkan ke keranjang.');
}
public function hapus($id_keranjang)
{
     $this->logActivity("User menghapus item dari keranjang dengan ID $id_keranjang");
    $keranjangModel = new KeranjangModel();

    // Hapus item dari keranjang
    $keranjangModel->delete($id_keranjang);

    return redirect()->to(base_url('/Keranjang/keranjang'))->with('message', 'Item berhasil dihapus dari keranjang.');
}
 public function pesanDb($id_hp)
{
     $this->logActivity("User memesan Hp nomor $id_hp");
    $keranjangModel = new KeranjangModel();

    // Ambil ID user dari session
    $id_user = session()->get('id_user');

    // Validasi apakah user sudah login
    if (!$id_user) {
        return redirect()->to(base_url('/Login/login'))->with('error', 'Silakan login terlebih dahulu.');
    }

    // Cek apakah HP sudah ada di keranjang
    $existingItem = $keranjangModel->where('id_user', $id_user)->where('id_hp', $id_hp)->first();

    if ($existingItem) {
        // Jika sudah ada, tambahkan jumlahnya
        $keranjangModel->update($existingItem['id_keranjang'], [
            'jumlah' => $existingItem['jumlah'] + 1,
        ]);
    } else {
        // Jika belum ada, tambahkan item baru ke keranjang
        $keranjangModel->insert([
            'id_user' => $id_user,
            'id_hp' => $id_hp,
            'jumlah' => 1, // Default jumlah 1
        ]);
    }

    return redirect()->to(base_url('/home/dashboard'))->with('message', 'HP berhasil ditambahkan ke keranjang.');
}
}