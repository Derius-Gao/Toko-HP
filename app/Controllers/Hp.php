<?php
namespace App\Controllers;

use App\Models\HpModel;
use App\Models\ActivityLogModel;
use App\Models\UserModel;
class Hp extends BaseController
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

    public function menuHp()
    {
        $this->logActivity("User mengakses menu HP");
        $hpModel = new HpModel(); // Inisialisasi model
        $hpList = $hpModel->findAll(); // Mengambil semua data dari tabel hp

        echo view('surga');
         echo view('menu');
        echo view('menuhp', ['hpList' => $hpList]);
         echo view('neraka');
    }

public function editHp($id_hp)
{
    $this->logActivity("User mengakses form edit hp");
    $hpModel = new HpModel();
    $hp = $hpModel->find($id_hp); // Ambil data HP berdasarkan ID

    if (!$hp) {
        return redirect()->to(base_url('Hp/menuHp'))->with('error', 'Data HP tidak ditemukan.');
    }

    echo view('edithp', ['hp' => $hp]);
}

public function updateHp($id_hp)
{
    $hpModel = new HpModel();

    // Validasi file upload
    $foto = $this->request->getFile('foto_hp');
    $fotoName = null;

    if ($foto && $foto->isValid() && !$foto->hasMoved()) {
        $fotoName = $foto->getRandomName();
        $foto->move('uploads', $fotoName);
    }

    // Update data HP
    $hpModel->update($id_hp, [
        'merk' => $this->request->getPost('merk'),
        'tahun' => $this->request->getPost('tahun'),
        'kondisi' => $this->request->getPost('kondisi'),
        'harga' => str_replace('.', '', $this->request->getPost('harga')),
        'deskripsi' => $this->request->getPost('deskripsi'),
        'foto_hp' => $fotoName ?? $this->request->getPost('foto_hp'), // Gunakan foto lama jika tidak ada upload baru
    ]);

    return redirect()->to(base_url('/Hp/menuHp'))->with('message', 'HP berhasil diperbarui.');
}
public function hapusHpDb($id_hp)
{
    $this->logActivity("User menghapus hp nomor $id_hp");
    $hpModel = new HpModel();
    $hp = $hpModel->find($id_hp);

    if ($hp) {
        // Hapus file foto jika ada
        if (!empty($hp['foto_hp']) && file_exists('uploads/' . $hp['foto_hp'])) {
            unlink('uploads/' . $hp['foto_hp']);
        }

        $hpModel->delete($id_hp); // Hapus data HP
        return redirect()->to(base_url('home/dashboard'))->with('message', 'HP berhasil dihapus.');
    }

    return redirect()->to(base_url('/home/dashboard'))->with('error', 'Data HP tidak ditemukan.');
}
public function hapusHp($id_hp)
{
    $this->logActivity("User menghapus hp nomor $id_hp");
    $hpModel = new HpModel();
    $hp = $hpModel->find($id_hp);

    if ($hp) {
        // Hapus file foto jika ada
        if (!empty($hp['foto_hp']) && file_exists('uploads/' . $hp['foto_hp'])) {
            unlink('uploads/' . $hp['foto_hp']);
        }

        $hpModel->delete($id_hp); // Hapus data HP
        return redirect()->to(base_url('Hp/menuHp'))->with('message', 'HP berhasil dihapus.');
    }

    return redirect()->to(base_url('/Hp/menuHp'))->with('error', 'Data HP tidak ditemukan.');
}
public function tambahHp()
{
    $this->logActivity("User mengakses form tambah hp");
    // Tampilkan form tambah HP
    echo view('surga');
         echo view('menu');
    echo view('tambahhp');
    echo view('neraka');
}

public function simpanHp()
{
    $hpModel = new HpModel();

    // Validasi file upload
    $foto = $this->request->getFile('foto_hp');
    if ($foto->isValid() && !$foto->hasMoved()) {
        // Pindahkan file ke folder uploads
        $fotoName = $foto->getRandomName();
        $foto->move('uploads', $fotoName);

        // Simpan data ke database
        $hpModel->save([
            'merk' => $this->request->getPost('merk'),
            'tahun' => $this->request->getPost('tahun'),
            'kondisi' => $this->request->getPost('kondisi'),
            'harga'=> str_replace('.', '', $this->request->getPost('harga')),
            'deskripsi' => $this->request->getPost('deskripsi'),
            'foto_hp' => $fotoName, // Simpan nama file foto
        ]);

        return redirect()->to(base_url('Hp/menuHp'))->with('message', 'HP berhasil ditambahkan.');
    }

    return redirect()->back()->with('error', 'Gagal mengunggah foto.');
}
}