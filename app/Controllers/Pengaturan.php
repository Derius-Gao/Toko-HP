<?php
namespace App\Controllers;
use App\Models\ActivityLogModel;
use App\Models\UserModel;
class Pengaturan extends BaseController
{

public function pengaturan()
{
    $this->logActivity("User mengakses Pengaturan");
    $db = db_connect();
    $pengaturan = $db->table('pengaturan_app')->get()->getRow();

    echo view('surga');
    echo view('menu');
    echo view('pengaturan', ['pengaturan' => $pengaturan]);
    echo view('neraka');
}
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
public function simpan_pengaturan()
{
    $this->logActivity("User mengganti pengaturan");
    $db = db_connect();

    $fileLogo = $this->request->getFile('logo');
    $fileLogoWeb = $this->request->getFile('logo_web');

    // Cek apakah data pengaturan sudah ada
    $pengaturan = $db->table('pengaturan_app')->get()->getRow();

    $logoName = $pengaturan->logo ?? null;
    $logoWebName = $pengaturan->logo_web ?? null;

    // Validasi dan proses upload logo
    if ($fileLogo && $fileLogo->isValid() && !$fileLogo->hasMoved()) {
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        if (!in_array($fileLogo->getMimeType(), $allowedTypes)) {
            return redirect()->back()->with('error', 'Hanya gambar JPG, PNG, atau GIF yang diperbolehkan untuk logo header.');
        }
        $logoName = $fileLogo->getRandomName();
        $fileLogo->move(FCPATH . 'uploads', $logoName);
        // Hapus logo lama
        if (!empty($pengaturan->logo) && file_exists(FCPATH . 'uploads/' . $pengaturan->logo)) {
            unlink(FCPATH . 'uploads/' . $pengaturan->logo);
        }
    }

    if ($fileLogoWeb && $fileLogoWeb->isValid() && !$fileLogoWeb->hasMoved()) {
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/x-icon'];
        if (!in_array($fileLogoWeb->getMimeType(), $allowedTypes)) {
            return redirect()->back()->with('error', 'Hanya gambar JPG, PNG, GIF, atau ICO yang diperbolehkan untuk favicon.');
        }
        $logoWebName = $fileLogoWeb->getRandomName();
        $fileLogoWeb->move(FCPATH . 'uploads', $logoWebName);
        // Hapus favicon lama
        if (!empty($pengaturan->logo_web) && file_exists(FCPATH . 'uploads/' . $pengaturan->logo_web)) {
            unlink(FCPATH . 'uploads/' . $pengaturan->logo_web);
        }
    }

    $data = [
        'judul' => $this->request->getPost('judul'),
        'logo' => $logoName,
        'logo_web' => $logoWebName,
        'updated_at' => date('Y-m-d H:i:s')
    ];

    if ($pengaturan) {
        // Update
        $db->table('pengaturan_app')->where('id_pengaturan', $pengaturan->id_pengaturan)->update($data);
    } else {
        // Insert jika belum ada
        $data['created_at'] = date('Y-m-d H:i:s');
        $db->table('pengaturan_app')->insert($data);
    }

    return redirect()->to('/home/dashboard')->with('success', 'Pengaturan berhasil diperbarui!');
}
}