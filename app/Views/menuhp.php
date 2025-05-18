<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu HP</title>
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
        }

        .add-button {
            display: inline-block;
            margin-bottom: 20px;
            padding: 10px 15px;
            background-color: #3498db;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: bold;
            text-align: center;
        }

        .add-button:hover {
            background-color: #2980b9;
        }

        .hp-card {
            background-color: white;
            border-radius: 12px;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-bottom: 20px;
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

        .hp-card .actions .tukar {
            background-color: #3498db;
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
    </style>
</head>
<body>
    <div class="container">
        <h1>Daftar HP</h1>

        <!-- Tombol Tambah HP -->
        <?php if (session()->get('level') === 'superadmin' || session()->get('level') === 'admin'): ?>
            <a href="<?= base_url('/Hp/tambahHp'); ?>" class="add-button">Tambah HP</a>
        <?php endif; ?>

        <?php foreach ($hpList as $hp): ?>
        <div class="hp-card">
            <!-- Foto HP -->
            <img src="<?= base_url('uploads/' . $hp['foto_hp']); ?>" alt="Foto <?= $hp['merk']; ?>">

            <!-- Informasi HP -->
            <h3><?= $hp['merk']; ?> (<?= $hp['tahun']; ?>)</h3>
            <p>Kondisi: <?= $hp['kondisi']; ?></p>
            <p class="harga">Harga: Rp<?= number_format($hp['harga'], 0, ',', '.'); ?></p>
            <p>Deskripsi: <?= $hp['deskripsi']; ?></p>

            <!-- Tombol Aksi -->
            <div class="actions">
                <a href="<?= base_url('/Keranjang/pesan/' . $hp['id_hp']); ?>" class="pesan">Pesan</a>

                <?php if (session()->get('level') === 'superadmin' || session()->get('level') === 'admin'): ?>
    <?php if (session()->get('level') === 'superadmin' || session()->get('level') === 'admin'): ?>
        <a href="<?= base_url('/Hp/editHp/' . $hp['id_hp']); ?>" class="edit">Edit</a>
    <?php endif; ?>
                    <form action="<?= base_url('/Hp/hapusHp/' . $hp['id_hp']); ?>" method="post" style="display:inline;">
                        <button type="submit" class="hapus" onclick="return confirm('Apakah Anda yakin ingin menghapus HP ini?')">Hapus</button>
                    </form>
                <?php endif; ?>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
<div id="modal-edit-hp" style="display:none; position:fixed; top:0; left:0; width:100vw; height:100vh; background:rgba(0,0,0,0.4); z-index:9999; align-items:center; justify-content:center;">
    <div id="edit-hp-content" style="background:#fff; padding:30px; border-radius:10px; min-width:350px; position:relative; max-width:90vw; max-height:90vh; overflow-y:auto;">
        <button id="close-modal-btn" onclick="closeEditModal()" style="position:absolute; top:10px; right:10px; background:#e74c3c; color:#fff; border:none; border-radius:50%; width:30px; height:30px; font-size:18px; cursor:pointer;">&times;</button>
        <!-- Form edit akan dimuat di sini -->
    </div>
</div>
</body>
<script>
function openEditModal(id_hp) {
    // Tampilkan modal
    document.getElementById('modal-edit-hp').style.display = 'flex';
    // Bersihkan konten sebelum load baru
    document.getElementById('edit-hp-content').innerHTML = '<button id="close-modal-btn" onclick="closeEditModal()" style="position:absolute; top:10px; right:10px; background:#e74c3c; color:#fff; border:none; border-radius:50%; width:30px; height:30px; font-size:18px; cursor:pointer;">&times;</button>';
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
    document.getElementById('edit-hp-content').innerHTML = '<button id="close-modal-btn" onclick="closeEditModal()" style="position:absolute; top:10px; right:10px; background:#e74c3c; color:#fff; border:none; border-radius:50%; width:30px; height:30px; font-size:18px; cursor:pointer;">&times;</button>';
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
  