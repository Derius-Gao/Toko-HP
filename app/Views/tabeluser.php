<!-- filepath: g:\My Drive\Program Web\pernikahan\app\Views\tabeluser.php -->
<div class="pagetitle">
    <h1>Table User</h1>
</div><!-- End Page Title -->

<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">

                    <!-- Fitur Tambah User dan Tabel Soft Deleted -->
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <button class="btn btn-success">
                            <i class="bi bi-plus-lg"></i>
                            <a href="<?= base_url('/User/inputuser') ?>" class="text-white">Tambah User</a>
                        </button>
                        <button class="btn btn-secondary">
                            <i class="bi bi-trash"></i>
                            <a href="<?= base_url('/User/deletedUsers') ?>" class="text-white">Tabel Soft Deleted User</a>
                        </button>
                    </div>

                    <!-- Pagination Controls -->
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <label for="rowsPerPage">Rows per page:</label>
                            <select id="rowsPerPage" class="form-select" style="width: auto; display: inline-block;">
                                <option value="5" selected>5</option>
                                <option value="10">10</option>
                                <option value="15">15</option>
                            </select>
                        </div>
                        <div>
                            <button class="btn btn-primary" id="prevPage">Previous</button>
                            <button class="btn btn-primary" id="nextPage">Next</button>
                        </div>
                    </div>

                    <!-- Tabel User -->
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th scope="col" width="3%">#</th>
                                <th scope="col">Nomor User</th>
                                <th scope="col">Username</th>
                                <th scope="col">Nama User</th>
                                <th scope="col">Email</th>
                                <th scope="col">Actions</th>
                                <?php if (session()->get('level') == 'superadmin') { ?>
                                <th scope="col">SuperAdmin</th>
                                <?php } ?>
                            </tr>
                        </thead>
                        <tbody id="userTableBody">
                            <?php if (!empty($user)) { ?>
                                <?php 
                                $no = 1;
                                foreach ($user as $key => $users) { ?>
                                    <tr>
                                        <th scope="row"><?= $no++ ?></th>
                                        <td><?= $users['id_user'] ?></td>
                                        <td><?= $users['username'] ?></td>
                                        <td><?= $users['nama_user'] ?></td>
                                        <td><?= $users['email'] ?></td>
                                        <td>
                                            <!-- Tombol Edit -->
                                            <a href="<?= base_url('/User/edituser/' . $users['id_user']) ?>" class="btn btn-warning">
                                                Edit
                                            </a>
                                            <!-- Tombol Hapus -->
                                            <form method="post" action="<?= base_url('/User/deleteuser/' . $users['id_user']) ?>" style="display: inline-block;">
                                                <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus user ini?');">
                                                    Hapus
                                                </button>
                                            </form>
                                        </td>
                                        <td>
                                            <?php if ($users['delete_status'] == 0): ?>
                                                <a href="<?= base_url('/User/softDeleteUser/' . $users['id_user']) ?>" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus pengguna ini?')">❌ Soft Delete</a>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php } ?>
                            <?php } else { ?>
                                <tr>
                                    <td colspan="6" class="text-center">Tidak ada data user.</td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    <!-- End Table with stripped rows -->

                </div>
            </div>
        </div>
    </div>
</section>

<script>
    // Pagination Logic
    const rowsPerPageSelect = document.getElementById('rowsPerPage');
    const userTableBody = document.getElementById('userTableBody');
    const prevPageButton = document.getElementById('prevPage');
    const nextPageButton = document.getElementById('nextPage');

    if (!rowsPerPageSelect || !userTableBody || !prevPageButton || !nextPageButton) {
        console.error('Pagination elements not found.');
    } else {
        let currentPage = 1;
        let rowsPerPage = parseInt(rowsPerPageSelect.value);
        let rows = Array.from(userTableBody.querySelectorAll('tr'));

        function displayRows() {
            const start = (currentPage - 1) * rowsPerPage;
            const end = start + rowsPerPage;

            rows.forEach((row, index) => {
                row.style.display = index >= start && index < end ? '' : 'none';
            });

            prevPageButton.disabled = currentPage === 1;
            nextPageButton.disabled = end >= rows.length;
        }

        rowsPerPageSelect.addEventListener('change', () => {
            rowsPerPage = parseInt(rowsPerPageSelect.value);
            currentPage = 1;
            rows = Array.from(userTableBody.querySelectorAll('tr')); // Perbarui rows
            displayRows();
        });

        prevPageButton.addEventListener('click', () => {
            if (currentPage > 1) {
                currentPage--;
                displayRows();
            }
        });

        nextPageButton.addEventListener('click', () => {
            if ((currentPage * rowsPerPage) < rows.length) {
                currentPage++;
                displayRows();
            }
        });

        // Initialize table display
        displayRows();
    }
</script>