<!-- filepath: app/Views/activity_logs.php -->
<div class="pagetitle">
    <h1>Log Aktivitas</h1>
</div><!-- End Page Title -->

<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">

                    <!-- Filter Username -->
                <?php if (in_array($level, ['admin', 'superadmin', 'operator'])): ?>
<!-- Filter Username -->
<form method="GET" action="<?= base_url('/User/logActivitytab/') ?>" class="d-flex justify-content-between align-items-center my-3">
    <div>
        <label for="filter-username" class="form-label">Filter berdasarkan Username:</label>
        <select id="filter-username" name="username" class="form-select" style="width: auto;" onchange="this.form.submit()">
            <option value="">Semua Username</option>
            <?php foreach ($users as $user): ?>
                <option value="<?= esc($user['username']) ?>" <?= ($selectedUsername == $user['username']) ? 'selected' : '' ?>>
                    <?= esc($user['username']) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
</form>
<?php endif; ?>

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

                    <!-- Tabel Log -->
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Waktu</th>
                                <th scope="col">Username</th>
                                <th scope="col">Aksi</th>
                                <th scope="col">IP Address</th>
                            </tr>
                        </thead>
                        <tbody id="userTableBody">
                            <?php if (!empty($logs)) : ?>
                                <?php $no = 1; foreach ($logs as $log): ?>
                                    <tr>
                                        <th scope="row"><?= $no++ ?></th>
                                        <td><?= esc($log['timestamp']) ?></td>
                                        <td><?= esc($log['username']) ?></td>
                                        <td><?= esc($log['aksi']) ?></td>
                                        <td><?= esc($log['ip_address']) ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <tr>
                                    <td colspan="5" class="text-center">Tidak ada log aktivitas.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>

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