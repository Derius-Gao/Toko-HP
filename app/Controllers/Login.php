<?php
namespace App\Controllers;
use App\Models\M_der;
use App\Models\ActivityLogModel;
use App\Models\UserModel;
class Login extends BaseController
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
public function aksi_login()
{
     $this->logActivity("User melakukan login");
    $recaptcha_response = $this->request->getPost('g-recaptcha-response');

    if (empty($recaptcha_response)) {
        // Math CAPTCHA sebagai fallback
        $math_captcha = $this->request->getPost('math_captcha');
        $math_result = $this->request->getPost('math_result');

        if ($math_captcha != $math_result) {
            return redirect()->to('/Login/login')->with('error', 'Math CAPTCHA gagal. Coba lagi.');
        }
    } else {
        // Google reCAPTCHA verifikasi
        $recaptcha_secret = "6LcTh-8qAAAAAMQY29CbLBdF2Wpg-GNTdCz-fqwZ";
        $verify_url = "https://www.google.com/recaptcha/api/siteverify";
        $verify_response = @file_get_contents($verify_url . "?secret=" . $recaptcha_secret . "&response=" . $recaptcha_response);

        if ($verify_response === false) {
            return redirect()->to('/Login')->with('error', 'Gagal terhubung ke Google reCAPTCHA.');
        }

        $response_keys = json_decode($verify_response, true);
        if (!$response_keys["success"]) {
            return redirect()->to('/Login')->with('error', 'reCAPTCHA tidak valid. Coba lagi.');
        }
    }

    // Setelah CAPTCHA valid → cek login
   $a=$this->request->getpost('email');
          $d=$this->request->getpost('password');   

    $Joyce = new M_der();
    $data = array(
            'email' => $a,
            'password' => md5($d),
          );

          $cek = $Joyce->getWhere('user',$data);

        if ($cek != null) {
    session()->set([
            'id_user' => $cek->id_user,
            'username' => $cek->username, // Pastikan username disimpan di session
            'e' => $cek->email,
            'level' => $cek->level,
        ]); 

          return redirect()->to('/home/dashboard');
         }else{
          return redirect()->to('Login/login');
         }
    } 
        public function login()
    {   
        echo view('surgauser.php');
        echo view('login.php');
                echo view('neraka.php');
    }
}