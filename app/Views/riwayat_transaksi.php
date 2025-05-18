
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Transaksi</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f1f2f6;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            background-color: white;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table th, table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }
        table th {
            background-color: #f4f4f4;
        }
        .bukti-link {
            color: #3498db;
            text-decoration: underline;
        }
        .status {
            font-weight: bold;
        }
        .aksi-form {
            display: inline;
        }
        .btn-sukses {
            background: #27ae60;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 5px 10px;
            cursor: pointer;
            margin-right: 5px;
        }
        .btn-batal {
            background: #e74c3c;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 5px 10px;
            cursor: pointer;
        }
        .btn-cetak {
            background: #2980b9;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 5px 10px;
            cursor: pointer;
            margin-right: 5px;
            text-decoration: none;
        }
        .btn-cetak-excel {
            background: #27ae60;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 5px 10px;
            cursor: pointer;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Riwayat Transaksi</h1>
        <?php if (empty($transaksi)): ?>
            <p>Tidak ada transaksi.</p>
        <?php else: ?>
            <table>
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Total Harga</th>
                        <th>Metode Pembayaran</th>
                        <th>Bukti Pembayaran</th>
                        <th>Status Pembayaran</th>
                        <?php if (session()->get('level') == 'superadmin' || session()->get('level') == 'admin') { ?>
                        <th>Aksi</th>
                        <?php } ?>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($transaksi as $trx): ?>
                        <tr>
                            <td><?= date('d-m-Y H:i', strtotime($trx['tanggal'])); ?></td>
                            <td>Rp<?= number_format($trx['total_harga'], 0, ',', '.'); ?></td>
                            <td><?= esc($trx['metode_pembayaran']); ?></td>
                            <td>
                                <?php if ($trx['bukti_pembayaran']): ?>
                                    <a href="<?= base_url('uploads/' . $trx['bukti_pembayaran']); ?>" target="_blank" class="bukti-link">Lihat Bukti</a>
                                <?php else: ?>
                                    -
                                <?php endif; ?>
                            </td>
                            <td class="status"><?= esc($trx['status_pembayaran']); ?></td>
                             <?php if (session()->get('level') == 'superadmin' || session()->get('level') == 'admin') { ?>
                            <td>
                                <?php if ($trx['status_pembayaran'] == 'menunggu verifikasi'): ?>
                                    <form class="aksi-form" action="<?= base_url('Transaksi/ubahStatus/' . $trx['id_transaksi']); ?>" method="post" style="display:inline;">
                                        <input type="hidden" name="status" value="sukses">
                                        <button type="submit" class="btn-sukses" onclick="return confirm('Ubah status menjadi SUKSES?')">Terima</button>
                                    </form>
                                    <form class="aksi-form" action="<?= base_url('Transaksi/ubahStatus/' . $trx['id_transaksi']); ?>" method="post" style="display:inline;">
                                        <input type="hidden" name="status" value="batal">
                                        <button type="submit" class="btn-batal" onclick="return confirm('Batalkan transaksi ini?')">Batal</button>
                                    </form>
                                <?php elseif ($trx['status_pembayaran'] == 'sukses'): ?>
                                    <a href="<?= base_url('Transaksi/cetakPdf/' . $trx['id_transaksi']); ?>" class="btn-cetak" target="_blank">Cetak PDF</a>
                                <?php else: ?>
                                    -
                                <?php endif; ?>
                            </td>
                            <?php } ?>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</body>
</html>