<?php
namespace App\Controllers;
use App\Models\M_der;
use App\Models\UserModel;
use App\Models\ActivityLogModel;
class User extends BaseController
{

public function deleteuser($id)
{
    $id_user = session()->get('id_user'); // Ambil ID user yang sedang login (eksekutor)
    $userModel = new UserModel();

    // Jalankan hard delete
    if ($userModel->deleteUserPermanently($id, $id_user)) {
        return redirect()->back()->with('success', 'User berhasil dihapus secara permanen.');
    } else {
        return redirect()->back()->with('error', 'Gagal menghapus user secara permanen.');
    }
}

public function deletedUsers()
{
     if (session()->get('id_user')>0){
    $userModel = new UserModel();

    // Ambil data pengguna yang dihapus (delete_status = 1)
    $data['deleted_users'] = $userModel->where('delete_status', 1)->findAll();
        $this->logActivity("User mengakses tabel user yang kena delete");
    echo view('surga');
           echo view('menu.php');
    echo view('tabeluserdeleted', $data);
    echo view('neraka');
}
}
public function edituser($id_user)
{
    if (session()->get('level') !== 'admin' && session()->get('level') !== 'superadmin') {
        return redirect()->to('/User/usr')->with('error', 'Anda tidak memiliki izin untuk mengedit pengguna.');
    }

    $userModel = new UserModel();

    // Cek apakah user ada
    $user = $userModel->find($id_user);
    if (!$user) {
        return redirect()->to('/User/usr')->with('error', 'User tidak ditemukan.');
    }

    // Kirim data user ke view
    $data['user'] = $user;
    $this->logActivity("User mengakses halaman edit user");
    echo view('surga.php');
           echo view('menu.php');
    echo view('edituser', $data);
    echo view('neraka.php');
}
public function simpan_user()
{
    // Pastikan hanya admin atau superadmin yang dapat mengakses
    if (session()->get('level') !== 'admin' && session()->get('level') !== 'superadmin') {
        return redirect()->to('/User/usr')->with('error', 'Anda tidak memiliki izin untuk menyimpan perubahan.');
    }

    $userModel = new UserModel();

    // Ambil username dari session
    $username = session()->get('username');

    // Ambil data dari form
    $id_user = $this->request->getPost('idd');
    $data = [
        'username' => $this->request->getPost('username'),
        'nama_user' => $this->request->getPost('nama_user'),
        'email' => $this->request->getPost('email'),
        'password' => md5($this->request->getPost('password')),
        'level' => $this->request->getPost('level'),
        'delete_status' => $this->request->getPost('delete_status'),
        'updated_by' => session()->get('username'), // Tambahkan username yang mengedit
        'updated_at' => date('Y-m-d H:i:s'), // Tambahkan waktu pengeditan
    ];

    // Update data user
    $userModel->update($id_user, $data);

    // Log aktivitas
    $this->logActivity("Admin mengedit data user dengan ID $id_user");

    return redirect()->to('/User/usr')->with('success', 'Data user berhasil diperbarui.');
}
  public function inputuser()
    {
       if (session()->get('level')=='admin' || session()->get('level')=='superadmin') {
        $this->logActivity("User menginput data user");
        $Joyce= new M_der;
        $where=('id_user');
        $wendy['marah']=$Joyce->tampil('user',$where);
        echo view ('surga.php');
               echo view('menu.php');
        echo view ('inputuser.php',$wendy);
        echo view ('neraka.php');
      }else{
        return redirect()->to('home/dashboard');
    }
  }
  public function softDeleteUser($id)
{
    $id_user = session()->get('id_user'); // Ambil ID user dari session
    $userModel = new UserModel();

    if ($userModel->softDeleteUser($id, $id_user)) {
        return redirect()->back()->with('success', 'User berhasil dihapus.');
    } else {
        return redirect()->back()->with('error', 'Gagal menghapus user.');
    }
}

public function restoreUser($id)
{
    $id_user = session()->get('id_user'); // Ambil ID user dari session
    $userModel = new UserModel();

    if ($userModel->restoreUser($id, $id_user)) {
        return redirect()->back()->with('success', 'User berhasil direstore.');
    } else {
        return redirect()->back()->with('error', 'Gagal merestore user.');
    }
}
public function restoreAllUsers()
{
    $id_user = session()->get('id_user'); // Ambil ID user dari session
    $userModel = new UserModel();

    if ($userModel->restoreAllUsers($id_user)) {
        return redirect()->back()->with('success', 'Semua user berhasil direstore.');
    } else {
        return redirect()->back()->with('error', 'Gagal merestore semua user.');
    }
}
public function input_user1()
{
    $userModel = new UserModel();
    
    // Ambil ID user yang sedang login
    $id_user = session()->get('id_user'); 

    $data = [
        'id_user'    => $this->request->getPost('id_user'),
        'nama_user'  => $this->request->getPost('nama_user'),
        'username'   => $this->request->getPost('username'),
        'email'      => $this->request->getPost('email'),
        'password'   => md5($this->request->getPost('password')), // Hash password
        'level'      => $this->request->getPost('level'),
        'created_by' => $id_user, // Simpan siapa yang membuat
        'created_at' => date('Y-m-d H:i:s'), // Simpan waktu pembuatan
    ];

    $userModel->insertUser($data); // Gunakan model untuk menyimpan data

    return redirect()->to('/User/usr')->with('success', 'User berhasil ditambahkan.');
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
public function logActivitytab()
{
    if (!session()->has('id_user')) {
        return redirect()->to('Login/login')->with('error', 'Anda harus login terlebih dahulu.');
    }

    $logModel = new ActivityLogModel();
    $level = session()->get('level');
    $userId = session()->get('id_user');
    $selectedUsername = $this->request->getGet('username'); // Ambil dari dropdown (jika admin/superadmin)

    // Ambil daftar username unik untuk dropdown filter
    $users = $logModel->select('username')->distinct()->findAll();

    // Aturan akses:
    // - Superadmin/Admin: Bisa lihat semua log atau filter by username
    // - Operator/User: Hanya bisa lihat log milik sendiri
    if (in_array($level, ['admin', 'superadmin'])) {
        // Jika ada filter username
        if (!empty($selectedUsername)) {
            $logs = $logModel->where('username', $selectedUsername)->findAll();
        } else {
            $logs = $logModel->findAll();
        }
    } else {
        // Hanya tampilkan log milik user/ operator
        $logs = $logModel->where('id_user', $userId)->findAll();
    }

    // Catat bahwa user melihat halaman log
    $this->logActivity("User melihat Logs");

    $data = [
    'logs' => $logs,
    'users' => $users,
    'selectedUsername' => $selectedUsername,
    'level' => $level 
];


    echo view('surga', $data);
    echo view('menu.php', $data);
    echo view('activity_logs', $data);
    echo view('neraka', $data);
}
    public function usr()
    {
         if (session()->get('id_user')>0){
    $userModel = new UserModel();
    $data['user'] = $userModel->getActiveUsers(); // Panggil metode yang baru
    $this->logActivity("User mengakses tabel user");
    
        echo view('surga.php');
        echo view('menu.php');
        echo view('tabeluser', $data);
        echo view('neraka.php');
    }
}
}