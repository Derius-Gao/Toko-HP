<div class="container mt-5">
    <h3>Reset Password</h3>
    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
    <?php endif; ?>
    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>

    <form action="<?= base_url('home/aksi_forgot_password') ?>" method="post">
        <div class="form-group">
            <label for="email">Masukkan Email Anda:</label>
            <input type="email" name="email" id="email" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Kirim Link Reset</button>
    </form>
</div>
