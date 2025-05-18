<?php
$db = db_connect();
$pengaturan = $db->table('pengaturan_app')->get()->getRow();
?>

<section class="log-reg">
    <div class="top-menu-area">
        <div class="container"></div>
    </div>
    <div class="container">
        <div class="row">
            <div class="image">
                <a><img src="<?= base_url('assets/images/logo/logowed.jpeg') ?>" alt="logo"></a>
            </div>
            <div class="col-lg-7">
                <div class="log-reg-inner">
                    <div class="section-header inloginp">
                        <h2 class="title">Welcome To <?= $pengaturan->judul ?? 'Aplikasi Web' ?></h2>
                    </div>
                    <div class="main-content inloginp">
<form action="<?= base_url('/home/aksi_registrasi') ?>" method="post">
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                            <div class="basic-login">
                            <h3 class="text-center mb-60">Register From Here</h3>
                            <form action="#">
                                  <label for="username">Username <span>**</span></label>
                                  <input type="username" class="form-control" id="username" placeholder="Enter Username" name="username" required>
                                  <label for="nama_user">Nama User <span>**</span></label>
                                  <input type="username" class="form-control" id="nama_user" placeholder="Enter Nama" name="nama_user" required>
                                  <label for="email">Email Address <span>**</span></label>
                                  <input type="email" class="form-control" id="email" placeholder="Enter Email" name="email" required>
                                <label for="pass">Password <span>**</span></label>
                                 <input type="password" class="form-control" id="password" placeholder="Enter Password" name="password" required>
                                 <ul id="password-requirements" style="margin-top:10px; list-style: none; padding-left: 0;">
  <li id="length-check" style="color: red;">❌ Minimal 6 karakter</li>
  <li id="number-check" style="color: red;">❌ Mengandung angka</li>
</ul>

 <div class="text-center">
                                <button type="submit" class="default-btn"><span>Sign IN</span></button>
                            </div>

                                   </form>
                            </div>
                    </div>
                </div>
                </div>
            </section>
        <script>
  const passwordInput = document.getElementById('password');
  const lengthCheck = document.getElementById('length-check');
  const numberCheck = document.getElementById('number-check');
  const registerButton = document.querySelector('button[type="submit"]');

  function validatePasswordLive() {
    const value = passwordInput.value;
    let isValid = true;

    // Cek panjang
    if (value.length >= 6) {
      lengthCheck.textContent = '✅ Minimal 6 karakter';
      lengthCheck.style.color = 'green';
    } else {
      lengthCheck.textContent = '❌ Minimal 6 karakter';
      lengthCheck.style.color = 'red';
      isValid = false;
    }

    // Cek angka
    if (/\d/.test(value)) {
      numberCheck.textContent = '✅ Mengandung angka';
      numberCheck.style.color = 'green';
    } else {
      numberCheck.textContent = '❌ Mengandung angka';
      numberCheck.style.color = 'red';
      isValid = false;
    }

    // Aktif/nonaktifkan tombol Register
    registerButton.disabled = !isValid;
  }

  passwordInput.addEventListener('input', validatePasswordLive);
  document.addEventListener('DOMContentLoaded', validatePasswordLive); // Untuk disable awal
</script>
    </body>
