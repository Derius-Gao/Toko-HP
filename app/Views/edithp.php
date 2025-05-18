
<div class="edit-hp-modal-container">
    <h2>Edit HP</h2>
    <form action="<?= base_url('Hp/updateHp/' . $hp['id_hp']); ?>" method="post" enctype="multipart/form-data">
        <label for="merk">Merk</label>
        <input type="text" id="merk" name="merk" value="<?= esc($hp['merk']); ?>" required>

        <label for="tahun">Tahun</label>
        <input type="date" id="tahun" name="tahun" value="<?= esc($hp['tahun']); ?>" required>

        <label for="kondisi">Kondisi</label>
        <select id="kondisi" name="kondisi" required>
            <option value="Baru" <?= $hp['kondisi'] === 'Baru' ? 'selected' : ''; ?>>Baru</option>
            <option value="Bekas" <?= $hp['kondisi'] === 'Bekas' ? 'selected' : ''; ?>>Bekas</option>
        </select>

        <label for="harga">Harga</label>
        <input type="text" id="harga" name="harga" value="<?= esc($hp['harga']); ?>" required>

        <label for="deskripsi">Deskripsi</label>
        <textarea id="deskripsi" name="deskripsi" rows="4" required><?= esc($hp['deskripsi']); ?></textarea>

        <label for="foto_hp">Foto HP</label>
        <input type="file" id="foto_hp" name="foto_hp" accept="image/*">
        <input type="hidden" name="foto_lama" value="<?= esc($hp['foto_hp']); ?>">

        <button type="submit" style="background:#27ae60;color:#fff;border:none;padding:10px 15px;border-radius:8px;cursor:pointer;">Simpan</button>
    </form>
</div>
<style>
.edit-hp-modal-container {
    max-width: 500px;
    margin: 0 auto;
    background: #fff;
    padding: 20px 25px;
    border-radius: 12px;
    box-shadow: 0 5px 10px rgba(0,0,0,0.08);
}
.edit-hp-modal-container h2 {
    text-align: center;
    margin-bottom: 18px;
}
.edit-hp-modal-container label {
    font-weight: bold;
    margin-top: 10px;
    display: block;
    text-align: left;
}
.edit-hp-modal-container input,
.edit-hp-modal-container textarea,
.edit-hp-modal-container select {
    width: 100%;
    margin-bottom: 10px;
    padding: 8px 10px;
    border: 1px solid #ccc;
    border-radius: 8px;
    font-size: 15px;
}
</style>