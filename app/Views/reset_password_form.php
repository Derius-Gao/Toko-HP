<div class="container mt-5">
    <h3>Buat Password Baru</h3>
    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
    <?php endif; ?>

    <form action="<?= base_url('/home/aksi_reset_password_save') ?>" method="post">
        <input type="hidden" name="token" value="<?= esc($token) ?>">

        <div class="form-group">
            <label for="password">Password Baru:</label>
            <input type="password" name="password" id="password" class="form-control" required minlength="6">
        </div>

        <button type="submit" class="btn btn-success mt-3">Reset Password</button>
    </form>
</div>
