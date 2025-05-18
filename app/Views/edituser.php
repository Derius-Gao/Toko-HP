<div class="container mt-3">
  <h2>Edit User</h2>
  <form action="<?= base_url('/User/simpan_user') ?>" method="post">
    <div class="mb-3">
      <label for="nama">Username:</label>
      <input type="text" class="form-control" id="nama" placeholder="Enter username" name="username" value="<?= esc($user['username']) ?>">
    </div>
    <div class="mb-3">
      <label for="nama_user">Nama User:</label>
      <input type="text" class="form-control" id="nama_user" placeholder="Enter nama" name="nama_user" value="<?= esc($user['nama_user']) ?>">
    </div>
    <div class="mb-3">
      <label for="email">Email:</label>
      <input type="email" class="form-control" id="email" placeholder="Enter email" name="email" value="<?= esc($user['email']) ?>">
    </div>
    <div class="mb-3">
      <label for="level">Level:</label>
      <input type="text" class="form-control" id="level" placeholder="Enter level" name="level" value="<?= esc($user['level']) ?>">
    </div>
    <div class="mb-3">
      <label for="password">Password:</label>
      <input type="password" class="form-control" id="password" placeholder="Enter password" name="password" value="<?= esc($user['password']) ?>">
    </div>
    <div class="mb-3">
      <label for="delete_status">Delete Status:</label>
      <input type="text" class="form-control" id="delete_status" placeholder="Enter delete status" name="delete_status" value="<?= esc($user['delete_status']) ?>">
    </div>
    <input type="hidden" name="idd" value="<?= esc($user['id_user']) ?>">
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
</div>