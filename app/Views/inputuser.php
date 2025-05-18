<div class="container mt-3">
  <h2>Edit User</h2>
  <form action="<?= base_url('/User/input_user1') ?>" method="post">
    <div class="mb-3">
      <label for="nama">Username:</label>
      <input type="text" class="form-control" id="nama" placeholder="Enter username" name="username" required>
    </div>
    <div class="mb-3">
      <label for="nama_user">Nama User:</label>
      <input type="text" class="form-control" id="nama_user" placeholder="Enter nama" name="nama_user" required>
    </div>
    <div class="mb-3">
      <label for="email">Email:</label>
      <input type="email" class="form-control" id="email" placeholder="Enter email" name="email" required>
    </div>
     <div class="mb-3">
        <label for="level" class="form-label">Level: </label>
        <select class="form-control" name="level">
            <option value="pembeli">Pembeli</option>
            <option value="admin">Admin</option>
        </select>
    </div>
    <div class="mb-3">
      <label for="password">Password:</label>
      <input type="password" class="form-control" id="password" placeholder="Enter password" name="password" required>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
</div>