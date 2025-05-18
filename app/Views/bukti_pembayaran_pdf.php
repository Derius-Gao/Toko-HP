
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Bukti Pembayaran - Toko HP</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 14px; }
        .nota-container { width: 100%; max-width: 600px; margin: 0 auto; border: 1px solid #333; padding: 24px; }
        .nota-title { text-align: center; font-size: 22px; font-weight: bold; margin-bottom: 8px; }
        .nota-header { margin-bottom: 16px; }
        .nota-header-table td { padding: 2px 8px; }
        .nota-table { width: 100%; border-collapse: collapse; margin-bottom: 16px; }
        .nota-table th, .nota-table td { border: 1px solid #333; padding: 6px 8px; text-align: left; }
        .nota-table th { background: #f4f4f4; }
        .nota-footer { margin-top: 24px; }
        .terbilang { font-style: italic; }
    </style>
</head>
<body>
<div class="nota-container">
    <div class="nota-title">TOKO HP</div>
    <div class="nota-header">
        <table class="nota-header-table">
            <tr>
                <td>Batam, <?= date('d-m-Y'); ?></td> <!-- Tanggal cetak -->
            </tr>
            <tr>
                <td>Kepada Yth.</td>
            </tr>
            <tr>
                <td><?= esc($user['username']); ?></td> <!-- Nama user transaksi -->
            </tr>
        </table>
        <br>
        <table class="nota-header-table">
            <tr>
                <td>No. Nota</td>
                <td>: <?= $no_nota; ?></td>
            </tr>
            <tr>
                <td>Metode Pembayaran</td>
                <td>: <?= esc($transaksi['metode_pembayaran']); ?></td>
            </tr>
            <tr>
                <td>Status</td>
                <td>: <?= esc($transaksi['status_pembayaran']); ?></td>
            </tr>
        </table>
    </div>
    <table class="nota-table">
        <tr>
            <th>Nomor Transaksi</th>
            <td><?= $transaksi['id_transaksi']; ?></td>
        </tr>
        <tr>
            <th>Nomor Pembeli</th>
            <td><?= $transaksi['id_user']; ?></td>
        </tr>
        <tr>
            <th>Tanggal</th>
            <td><?= date('d-m-Y H:i', strtotime($transaksi['tanggal'])); ?></td>
        </tr>
        <tr>
            <th>Total Harga</th>
            <td>Rp<?= number_format($transaksi['total_harga'], 0, ',', '.'); ?></td>
        </tr>
        <tr>
            <th>Metode Pembayaran</th>
            <td><?= esc($transaksi['metode_pembayaran']); ?></td>
        </tr>
        <tr>
            <th>Status Pembayaran</th>
            <td><?= esc($transaksi['status_pembayaran']); ?></td>
        </tr>
    </table>
    <div class="nota-footer"></div>
        <br>
        <div>
            <small>Catatan: Simpan bukti pembayaran ini sebagai arsip Anda.</small>
        </div>
    </div>
</div>
</body>
</html>

<?php
function terbilang($angka) {
    $angka = abs($angka);
    $baca = array('', 'satu', 'dua', 'tiga', 'empat', 'lima', 'enam', 'tujuh', 'delapan', 'sembilan', 'sepuluh', 'sebelas');
    $hasil = '';
    if ($angka < 12) {
        $hasil = ' ' . $baca[$angka];
    } else if ($angka < 20) {
        $hasil = terbilang($angka - 10) . ' belas';
    } else if ($angka < 100) {
        $hasil = terbilang($angka / 10) . ' puluh' . terbilang($angka % 10);
    } else if ($angka < 200) {
        $hasil = ' seratus' . terbilang($angka - 100);
    } else if ($angka < 1000) {
        $hasil = terbilang($angka / 100) . ' ratus' . terbilang($angka % 100);
    } else if ($angka < 2000) {
        $hasil = ' seribu' . terbilang($angka - 1000);
    } else if ($angka < 1000000) {
        $hasil = terbilang($angka / 1000) . ' ribu' . terbilang($angka % 1000);
    } else if ($angka < 1000000000) {
        $hasil = terbilang($angka / 1000000) . ' juta' . terbilang($angka % 1000000);
    }
    return trim($hasil);
}
?>