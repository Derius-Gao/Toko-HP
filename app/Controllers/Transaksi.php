<?php
namespace App\Controllers;

use App\Models\KeranjangModel;
use App\Models\HpModel;
use App\Models\TransaksiModel;
use App\Models\ActivityLogModel;
use App\Models\UserModel;
use Dompdf;
class Transaksi extends BaseController
{
public function cetakPdf($id_transaksi)
{
    $transaksiModel = new TransaksiModel();
    $hpModel = new HpModel();
    $userModel = new UserModel();

    $transaksi = $transaksiModel->find($id_transaksi);
    if (!$transaksi) {
        return redirect()->to('home/transaksi')->with('error', 'Transaksi tidak ditemukan.');
    }

    $user = $userModel->find($transaksi['id_user']);
    $hpList = [];
    if (isset($transaksi['id_hp'])) {
        $hp = $hpModel->find($transaksi['id_hp']);
        if ($hp) $hpList[] = $hp;
    }

    $no_nota = str_pad($transaksi['id_transaksi'], 5, '0', STR_PAD_LEFT);

    $html = view('bukti_pembayaran_pdf', [
        'transaksi' => $transaksi,
        'user' => $user,
        'hpList' => $hpList,
        'no_nota' => $no_nota
    ]);
    $dompdf = new \Dompdf\Dompdf();
    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();
    $dompdf->stream("bukti_pembayaran_{$no_nota}.pdf");
}
public function bayar($id_keranjang)
{
    $this->logActivity("User mengakses forum pembayaran");
    $keranjangModel = new KeranjangModel();
    $hpModel = new HpModel();

    $id_user = session()->get('id_user');
    $keranjang = $keranjangModel->find($id_keranjang);

    if (!$keranjang || $keranjang['id_user'] != $id_user) {
        return redirect()->back()->with('error', 'Data keranjang tidak valid.');
    }

    $hp = $hpModel->find($keranjang['id_hp']);
    $total_harga = $hp['harga'] * $keranjang['jumlah'];

    // Tampilkan form pembayaran
    echo view('form_pembayaran', [
        'keranjang' => $keranjang,
        'hp' => $hp,
        'total_harga' => $total_harga
    ]);
}

public function prosesBayar($id_keranjang)
{
    $keranjangModel = new KeranjangModel();
    $hpModel = new HpModel();
    $transaksiModel = new TransaksiModel();

    $id_user = session()->get('id_user');
    $keranjang = $keranjangModel->find($id_keranjang);

    if (!$keranjang || $keranjang['id_user'] != $id_user) {
        return redirect()->back()->with('error', 'Data keranjang tidak valid.');
    }

    $hp = $hpModel->find($keranjang['id_hp']);
    $total_harga = $hp['harga'] * $keranjang['jumlah'];

    // Ambil data dari form
    $metode = $this->request->getPost('metode_pembayaran');
    $bukti = $this->request->getFile('bukti_pembayaran');
    $buktiName = null;

    if ($bukti && $bukti->isValid() && !$bukti->hasMoved()) {
        $buktiName = $bukti->getRandomName();
        $bukti->move('uploads', $buktiName);
    }

    // Simpan ke tabel transaksi
    $transaksiModel->insert([
        'id_user' => $id_user,
        'tanggal' => date('Y-m-d H:i:s'),
        'total_harga' => $total_harga,
        'metode_pembayaran' => $metode,
        'bukti_pembayaran' => $buktiName,
        'status_pembayaran' => ($metode == 'Transfer Bank' || $metode == 'E-Wallet' && $buktiName) ? 'menunggu verifikasi' : 'pending'
    ]);

    // Hapus dari keranjang
    $keranjangModel->delete($id_keranjang);

    return redirect()->to(base_url('Transaksi/riwayat'))->with('message', 'Transaksi berhasil, silakan tunggu konfirmasi.');
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
}public function riwayat()
{  
     $this->logActivity("User mengakses tabel Transaksi");
      $transaksiModel = new TransaksiModel();
    $id_user = session()->get('id_user');
    $level = session()->get('level');

    if ($level === 'superadmin') {
        $transaksi = $transaksiModel->findAll();
    } else {
        $transaksi = $transaksiModel->where('id_user', $id_user)->findAll();
    }

    echo view('surga');
echo view('menu');
    echo view('riwayat_transaksi', ['transaksi' => $transaksi]);
    echo view('neraka');
}
public function ubahStatus($id_transaksi)
{
    $this->logActivity("User mengakses status transaksi nomor $id_transaksi");
    $transaksiModel = new TransaksiModel();
    $status = $this->request->getPost('status');
    if (in_array($status, ['sukses', 'batal'])) {
        $transaksiModel->update($id_transaksi, ['status_pembayaran' => $status]);
    }
    return redirect()->back()->with('message', 'Status pembayaran berhasil diubah.');
}
}