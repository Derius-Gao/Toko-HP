<main id="main" class="main">
    <div class="pagetitle">
        <h1>Pengguna Terhapus</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('/home/dashboard') ?>">Home</a></li>
                <li class="breadcrumb-item active">Pengguna Terhapus</li>
            </ol>
        </nav>
    </div>
 <button class="btn btn-success">
                            <i class="bi bi-plus-lg"></i>
                            <a href="<?= base_url('/home/restoreAllUsers/' . $user['id_user']) ?>" class="btn btn-success" onclick="return confirm('Yakin ingin merestore semua pengguna?')">♻️ Restore All</a>
                        </button>
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Daftar Pengguna yang Dihapus</h5>
                        <table class="table table-bordered table-striped" style="width: 100%">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Nama</th>
                                    <th>Username</th>
                                    <th>Level</th>
                                    <th>Dihapus Oleh</th>
                                    <th>Dihapus Pada</th>
                                    <?php if (session()->get('level') == 'superadmin'): ?>
                                        <th>Aksi</th>
                                    <?php endif; ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                if (!empty($deleted_users)) {
                                    $no = 1;
                                    foreach ($deleted_users as $user): ?>
                                        <tr>
                                            <td class="text-center"><?= $no++; ?>.</td>
                                            <td><?= $user['nama_user']; ?></td>
                                            <td><?= $user['username']; ?></td>
                                            <td><?= $user['level']; ?></td>
                                            <td><?= $user['deleted_by']; ?></td>
                                            <td><?= $user['deleted_at']; ?></td>
                                            <?php if (session()->get('level') == 'superadmin'): ?>
                                                <td>
                                                    <a href="<?= base_url('home/restoreUser/' . $user['id_user']) ?>" class="btn btn-success" onclick="return confirm('Yakin ingin merestore pengguna ini?')">♻️ Restore</a>
                                                </td>
                                            <?php endif; ?>
                                        </tr>
                                    <?php endforeach; 
                                } else { ?>
                                    <tr>
                                        <td colspan="7" class="text-center">Tidak ada pengguna yang dihapus.</td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>