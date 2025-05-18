
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang</title>
    <style>
        body { font-family: 'Segoe UI', sans-serif; background-color: #f1f2f6; margin: 0; padding: 20px; }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            background-color: white;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
        }
        h1 { text-align: center; margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        table th, table td { border: 1px solid #ddd; padding: 10px; text-align: left; }
        table th { background-color: #f4f4f4; }
        .actions button { padding: 5px 10px; border: none; border-radius: 5px; cursor: pointer; }
        .actions .hapus { background-color: #e74c3c; color: white; }
        .jumlah-input { width: 60px; text-align: center; }
    </style>
</head>
<body>
<div class="container">
    <h1>Keranjang</h1>
    <?php if (empty($keranjang)): ?>
        <p>Tidak ada pesanan di keranjang.</p>
    <?php else: ?>
        <table>
            <thead>
                <tr>
                    <th>Merk</th>
                    <th>Tahun</th>
                    <th>Kondisi</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Total</th>
                    <?php if (session()->get('level') == 'superadmin' || session()->get('level') == 'admin') { ?>
                    <th>Aksi</th>
                    <?php } ?>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($keranjang as $item): ?>
                <tr data-harga="<?= $item['hp']['harga']; ?>">
                    <td><?= $item['hp']['merk']; ?></td>
                    <td><?= $item['hp']['tahun']; ?></td>
                    <td><?= $item['hp']['kondisi']; ?></td>
                    <td>Rp<?= number_format($item['hp']['harga'], 0, ',', '.'); ?></td>
                    <td>
                        <input type="number" class="jumlah-input" min="1" value="<?= $item['jumlah']; ?>"
                            data-id="<?= $item['id_keranjang']; ?>">
                    </td>
                    <td class="total-harga">Rp<?= number_format($item['hp']['harga'] * $item['jumlah'], 0, ',', '.'); ?></td>
                    <?php if (session()->get('level') == 'superadmin' || session()->get('level') == 'admin') { ?>
                    <td class="actions">
                        <form action="<?= base_url('/Keranjang/hapus/' . $item['id_keranjang']); ?>" method="post" style="display:inline;">
                            <button type="submit" class="hapus" onclick="return confirm('Apakah Anda yakin ingin menghapus item ini dari keranjang?')">Hapus</button>
                        </form>
                    </td>
                    <?php } ?>
                    <td class="actions">
                        <button type="button" class="btn btn-success bayar-btn" data-id="<?= $item['id_keranjang']; ?>">Bayar</button>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>

<!-- Modal Bayar -->
<div id="modal-bayar" style="display:none; position:fixed; top:0; left:0; width:100vw; height:100vh; background:rgba(0,0,0,0.4); z-index:9999; align-items:center; justify-content:center;">
    <div id="bayar-content" style="background:#fff; padding:30px; border-radius:10px; min-width:350px; position:relative; max-width:90vw; max-height:90vh; overflow-y:auto;">
        <button onclick="closeBayarModal()" style="position:absolute; top:10px; right:10px; background:#e74c3c; color:#fff; border:none; border-radius:50%; width:30px; height:30px; font-size:18px; cursor:pointer;">&times;</button>
        <!-- Form bayar akan dimuat di sini -->
    </div>
</div>

<script>
function openBayarModal(id_keranjang) {
    document.getElementById('modal-bayar').style.display = 'flex';
    document.getElementById('bayar-content').innerHTML = '<button onclick="closeBayarModal()" style="position:absolute; top:10px; right:10px; background:#e74c3c; color:#fff; border:none; border-radius:50%; width:30px; height:30px; font-size:18px; cursor:pointer;">&times;</button>';
    fetch('<?= base_url('/Transaksi/bayar') ?>/' + id_keranjang)
        .then(res => res.text())
        .then(html => {
            document.getElementById('bayar-content').innerHTML += html;
        });
}
function closeBayarModal() {
    document.getElementById('modal-bayar').style.display = 'none';
    document.getElementById('bayar-content').innerHTML = '';
}
document.querySelectorAll('.bayar-btn').forEach(function(btn) {
    btn.addEventListener('click', function() {
        openBayarModal(this.getAttribute('data-id'));
    });
});
document.querySelectorAll('.jumlah-input').forEach(function(input) {
    input.addEventListener('input', function() {
        var jumlah = parseInt(this.value) || 1;
        if (jumlah < 1) { this.value = 1; jumlah = 1; }
        var tr = this.closest('tr');
        var harga = parseInt(tr.getAttribute('data-harga'));
        var total = harga * jumlah;
        tr.querySelector('.total-harga').textContent = 'Rp' + total.toLocaleString('id-ID');

        // Kirim update ke server via AJAX
        var id_keranjang = this.getAttribute('data-id');
        fetch('<?= base_url('/Keranjang/updateJumlah') ?>', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-Requested-With': 'XMLHttpRequest', // agar bisa dideteksi AJAX di CI4
                'X-CSRF-TOKEN': '<?= csrf_hash() ?>'
            },
            body: JSON.stringify({
                id_keranjang: id_keranjang,
                jumlah: jumlah
            })
        });
    });
});
</script>

<script>
function showRekeningInfo() {
    var metode = document.getElementById('metode_pembayaran');
    var info = document.getElementById('rekening-info');
    if (!metode || !info) return;
    var val = metode.value;
    if (val === 'Transfer Bank') {
        info.style.display = 'block';
        info.innerHTML = "<strong>Nama Bank:</strong> BCA<br><strong>Nomor Rekening:</strong> 08199219919";
    } else if (val === 'E-Wallet') {
        info.style.display = 'block';
        info.innerHTML = "<strong>Nama E-Wallet:</strong> Dana<br><strong>Nomor:</strong> 0821-3333-4444";
    } else {
        info.style.display = 'none';
        info.innerHTML = "";
    }
}
</script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Edit modal (sudah ada)
    document.querySelectorAll('.edit').forEach(function(btn) {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            var id_hp = this.href.split('/').pop();
            openEditModal(id_hp);
        });
    });

    // Pesan ke keranjang pakai AJAX
    document.querySelectorAll('.pesan').forEach(function(btn) {
        btn.addEventListener('click', function() {
            var id_hp = this.getAttribute('data-id');
            fetch('<?= base_url('/Keranjang/pesanDb') ?>/' + id_hp, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': '<?= csrf_hash() ?>'
                },
                body: JSON.stringify({ id_hp: id_hp })
            })
            .then(res => res.json())
            .then(data => {
                if (data.status === 'ok') {
                    alert('HP berhasil ditambahkan ke keranjang!');
                } else if (data.status === 'login') {
                    window.location.href = data.redirect;
                } else {
                    alert('Gagal menambah ke keranjang!');
                }
            })
            .catch(() => alert('Terjadi kesalahan!'));
        });
    });
});
</script>
</body>
</html>