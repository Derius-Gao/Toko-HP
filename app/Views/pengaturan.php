<form action="<?= base_url('/Pengaturan/simpan_pengaturan') ?>" method="post" enctype="multipart/form-data">
    <div class="mb-3">
        <label for="judul">Judul Aplikasi:</label>
        <input type="text" name="judul" id="judul" value="<?= esc($pengaturan->judul ?? '') ?>" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Logo Header Saat Ini:</label><br>
        <?php if (!empty($pengaturan->logo) && file_exists(FCPATH . 'uploads/' . $pengaturan->logo)): ?>
            <img src="<?= base_url('uploads/' . $pengaturan->logo) ?>" alt="Logo Header" width="100">
        <?php else: ?>
            <p><i>Tidak ada logo header</i></p>
        <?php endif; ?>
    </div>

    <div class="mb-3">
        <label for="logo">Unggah Logo Header Baru:</label>
        <input type="file" name="logo" id="logo" accept="image/*" class="form-control">
    </div>

    <div class="mb-3">
        <label>Logo Favicon Saat Ini:</label><br>
        <?php if (!empty($pengaturan->logo_web) && file_exists(FCPATH . 'uploads/' . $pengaturan->logo_web)): ?>
            <img src="<?= base_url('uploads/' . $pengaturan->logo_web) ?>" alt="Favicon" width="50">
        <?php else: ?>
            <p><i>Tidak ada favicon</i></p>
        <?php endif; ?>
    </div>

    <div class="mb-3">
        <label for="logo_web">Unggah Logo Favicon Baru:</label>
        <input type="file" name="logo_web" id="logo_web" accept="image/*" class="form-control">
    </div>

    <button type="submit" class="btn btn-primary">Simpan Pengaturan</button>
</form>
