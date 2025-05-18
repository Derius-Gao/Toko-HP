
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f1f2f6;
            margin: 0;
            padding: 0;
        }
        .welcome {
            font-size: 22px;
            font-weight: 600;
            margin: 20px 0;
            text-align: center;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            text-align: center;
        }
        .hp-list {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
        }
        .hp-card {
            background-color: white;
            border-radius: 12px;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: 300px;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }
        .hp-card img {
            max-width: 100%;
            border-radius: 8px;
        }
        .hp-card h3 {
            margin: 0;
            font-size: 20px;
            color: #333;
        }
        .hp-card p {
            margin: 0;
            font-size: 16px;
            color: #555;
        }
        .hp-card .harga {
            font-weight: bold;
            color: #27ae60;
        }
        .hp-card .actions {
            margin-top: 10px;
            display: flex;
            gap: 10px;
        }
        .hp-card .actions a,
        .hp-card .actions button {
            text-decoration: none;
            padding: 10px 15px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 14px;
        }
        .hp-card .actions .pesan {
            background-color: #27ae60;
            color: white;
        }
        .hp-card .actions .edit {
            background-color: #f39c12;
            color: white;
        }
        .hp-card .actions .hapus {
            background-color: #e74c3c;
            color: white;
        }
        /* Modal styles */
        #modal-edit-hp {
            display: none;
            position: fixed;
            top: 0; left: 0;
            width: 100vw; height: 100vh;
            background: rgba(0,0,0,0.4);
            z-index: 9999;
            align-items: center;
            justify-content: center;
        }
        #edit-hp-content {
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            min-width: 350px;
            position: relative;
            max-width: 90vw;
            max-height: 90vh;
            overflow-y: auto;
        }
        #close-modal-btn {
            position: absolute;
            top: 10px; right: 10px;
            background: #e74c3c;
            color: #fff;
            border: none;
            border-radius: 50%;
            width: 30px; height: 30px;
            font-size: 18px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="welcome">
        Selamat datang, <strong><?= session()->get('username'); ?></strong> 👋
    </div>
    <div class="container">
        <h2>HP Terbaru Bulan Ini</h2>
        <div class="hp-list">
            <?php if (empty($hpList)): ?>
                <p>Tidak ada HP yang ditambahkan bulan ini.</p>
            <?php else: ?>
                <?php foreach ($hpList as $hp): ?>
                <div class="hp-card">
                    <img src="<?= base_url('uploads/' . $hp['foto_hp']); ?>" alt="Foto <?= $hp['merk']; ?>">
                    <h3><?= $hp['merk']; ?> (<?= $hp['tahun']; ?>)</h3>
                    <p>Kondisi: <?= $hp['kondisi']; ?></p>
                    <p class="harga">Harga: Rp<?= number_format($hp['harga'], 0, ',', '.'); ?></p>
                    <p>Deskripsi: <?= $hp['deskripsi']; ?></p>
                    <div class="actions">
                        <a href="<?= base_url('/Keranjang/pesanDb/' . $hp['id_hp']); ?>" class="pesan">Pesan</a>
                        <?php if (session()->get('level') === 'superadmin' || session()->get('level') === 'admin'): ?>
                            <a href="<?= base_url('/Hp/editHp/' . $hp['id_hp']); ?>" class="edit">Edit</a>
                            <form action="<?= base_url('/Hp/hapusHpDb/' . $hp['id_hp']); ?>" method="post" style="display:inline;">
                                <button type="submit" class="hapus" onclick="return confirm('Apakah Anda yakin ingin menghapus HP ini?')">Hapus</button>
                            </form>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>

    <!-- Modal Edit HP -->
    <div id="modal-edit-hp">
        <div id="edit-hp-content">
            <button id="close-modal-btn" onclick="closeEditModal()">&times;</button>
            <!-- Form edit akan dimuat di sini -->
        </div>
    </div>
</body>
<script>
function openEditModal(id_hp) {
    // Tampilkan modal
    document.getElementById('modal-edit-hp').style.display = 'flex';
    // Bersihkan konten sebelum load baru
    document.getElementById('edit-hp-content').innerHTML = '<button id="close-modal-btn" onclick="closeEditModal()">&times;</button>';
    // Load form edit via AJAX
    fetch('<?= base_url('/Hp/editHp') ?>/' + id_hp)
        .then(res => res.text())
        .then(html => {
            document.getElementById('edit-hp-content').innerHTML += html;
        });
}

function closeEditModal() {
    document.getElementById('modal-edit-hp').style.display = 'none';
    // Bersihkan form edit
    document.getElementById('edit-hp-content').innerHTML = '<button id="close-modal-btn" onclick="closeEditModal()">&times;</button>';
}

// Ganti semua tombol Edit agar pakai AJAX
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.edit').forEach(function(btn) {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            var id_hp = this.href.split('/').pop();
            openEditModal(id_hp);
        });
    });
});
</script>
</html>