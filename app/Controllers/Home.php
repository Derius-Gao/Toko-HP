<?php
namespace App\Controllers;
use App\Models\M_der;
use App\Models\UserModel;
use App\Models\ActivityLogModel;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
class Home extends BaseController
{
        public function logout()
    {
      session()->destroy();
      return redirect()->to('/');
    } 
        public function register()
    {   

        echo view('surgauser.php');
        echo view('register.php');
        echo view('neraka.php');
    }
public function aksi_registrasi()
{
    $Joyce = new M_der;
    $data = array(
        'id_user'=> $this->request->getPost('id_user'),
        'username'=> $this->request->getPost('username'),
        'nama_user'=> $this->request->getPost('nama_user'),
        'email'=> $this->request->getPost('email'),
        'password'=> md5($this->request->getPost('password')), // <-- Enkripsi md5
        'level'=> "pembeli"
    );

    $Joyce->input('user', $data);
    return redirect()->to('/');
}
public function dashboard()
{
    $hpModel = new \App\Models\HpModel();
    $bulan = date('m');
    $tahun = date('Y');
    $hpList = $hpModel->where('MONTH(tahun)', $bulan)
                      ->where('YEAR(tahun)', $tahun)
                      ->findAll();
    echo view('surga');
     echo view('menu');
    echo view('dashboard', ['hpList' => $hpList]);
     echo view('neraka');
}

    public function forgot_password()
    {
        echo view ('surgauser');
        echo view ('forgot_password');
        echo view ('neraka');
    }
        public function error()
    {
        echo view ('surga');
        echo view ('menu');
        echo view ('error404');
        echo view ('neraka');
    }
    public function aksi_forgot_password()
    {
        $userModel = new UserModel();
        $email = $this->request->getPost('email');
    
        // Cek apakah email ada di database
        $user = $userModel->where('email', $email)->first();
    
        if (!$user) {
            return redirect()->back()->with('error', 'Email tidak ditemukan.');
        }
    
        // Set zona waktu
        date_default_timezone_set('Asia/Jakarta');
    
        // Generate token dan waktu kadaluwarsa
        $token = bin2hex(random_bytes(16));
        $token_hash = hash("sha256", $token);
        $expiry = date("Y-m-d H:i:s", strtotime("+20 minutes"));
    
        // Simpan token di database
        $userModel->update($user['id_user'], [
            'reset_token' => $token_hash,
            'reset_token_expiry' => $expiry
        ]);
    
        // Buat link reset password
        $resetLink = base_url("/home/aksi_reset_password?token=$token");
    
        // Isi email
        $subject = "Reset Password Anda";
        $message = "
        <html>
        <head>
            <title>Reset Password</title>
        </head>
        <body>
            <p>Halo, {$user['nama_user']}!</p>
            <p>Klik link di bawah untuk mereset password Anda:</p>
            <p><a href='$resetLink' style='color: blue;'>Reset Password</a></p>
            <p>Link ini berlaku selama 20 menit.</p>
            <p>Jika Anda tidak meminta reset password, abaikan email ini.</p>
        </body>
        </html>
        ";
    
        // Kirim email dengan PHPMailer
        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'boboysigma@gmail.com';
            $mail->Password   = 'wrmx otse xfrt vgoy';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 587;
    
            $mail->setFrom('boboysigma@gmail.com', 'Pernikahan');
            $mail->addAddress($email);
    
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body    = $message;
    
            $mail->send();
            return redirect()->back()->with('success', 'Link reset password telah dikirim ke email Anda.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', "Gagal mengirim email: {$mail->ErrorInfo}");
        }
    }
    
    public function aksi_reset_password()
    {
        $userModel = new UserModel();
        $token = $this->request->getGet('token');
        $token_hash = hash("sha256", $token);
    
        // Cari user berdasarkan token
        $user = $userModel->where('reset_token', $token_hash)->first();
    
        if (!$user) {
            return redirect()->to('/L')->with('error', 'Token tidak valid.');
        }
    
        // Cek apakah token masih berlaku
        if (strtotime($user['reset_token_expiry']) < time()) {
            return redirect()->to('/')->with('error', 'Token telah kadaluwarsa.');
        }
        echo view('surgauser.php');
        echo view('reset_password_form', ['token' => $token]);
        echo view('neraka.php');
    }
    public function aksi_reset_password_save()
{
    $userModel = new UserModel();
    $token = $this->request->getPost('token');
    $token_hash = hash("sha256", $token);
    $password = $this->request->getPost('password');

    // Validasi password minimal 6 karakter
    if (strlen($password) < 6) {
        return redirect()->back()->with('error', 'Password minimal 6 karakter.');
    }

    // Cari user berdasarkan token
    $user = $userModel->where('reset_token', $token_hash)->first();

    if (!$user) {
        return redirect()->to('/')->with('error', 'Token tidak valid.');
    }

    // Cek apakah token masih berlaku
    if (strtotime($user['reset_token_expiry']) < time()) {
        return redirect()->to('/')->with('error', 'Token telah kadaluwarsa.');
    }

    // Simpan password baru dan hapus token
    $userModel->update($user['id_user'], [
        'password' => md5($password),
        'reset_token' => null,
        'reset_token_expiry' => null
    ]);

    return redirect()->to('/')->with('success', 'Password berhasil diperbarui. Silakan login.');
}
}