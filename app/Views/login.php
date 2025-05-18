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
                <a><img src="<?= base_url('assets/images/logo/tokohp.jpg') ?>" alt="logo"></a>
            </div>
            <div class="col-lg-7">
                <div class="log-reg-inner">
                    <div class="section-header inloginp">
                        <h2 class="title">Welcome To <?= $pengaturan->judul ?? 'Aplikasi Web' ?></h2>
                    </div>
                    <div class="main-content inloginp">
            <form id="login-form" action="<?= base_url('/Login/aksi_login') ?>" method="post" onsubmit="return validateCaptcha();">
                            <div class="form-group">
                                <label>Your Email</label>
                                <input type="email" class="my-form-control" name="email" placeholder="Enter Your Email" required>
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" class="my-form-control" name="password" placeholder="Enter Your Password" required>
                            </div>

                            <!-- Math CAPTCHA (Hidden by default) -->
                            <div class="col-12">
                                <div class="form-group">
                                    <label id="math-captcha-label" style="display:none; font-weight: bold;"></label>
                                   <input type="number" id="math-captcha" class="form-control" name="math_captcha"
 placeholder="Jawab pertanyaan di atas"
 style="visibility: hidden; position: absolute;" required>

                                    <input type="hidden" id="math-result" name="math_result" value="">
                                </div>
                            </div>

                            <!-- Google reCAPTCHA -->
                            <div class="g-recaptcha" data-sitekey="6LcTh-8qAAAAADT6IB3IC66iKZGTm5Un7fZzp5K9" id="g-recaptcha-box"></div>

                            <div class="text-center">
                                <button type="submit" class="default-btn"><span>Sign IN</span></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Google reCAPTCHA script -->
<script src='https://www.google.com/recaptcha/api.js'></script>
<script>
    let num1, num2;

    function generateCaptcha() {
        num1 = Math.floor(Math.random() * 10) + 1;
        num2 = Math.floor(Math.random() * 10) + 1;
        document.getElementById('math-captcha-label').innerText = `${num1} + ${num2} = ?`;
        document.getElementById('math-result').value = num1 + num2;
    }

   function validateCaptcha() {
    if (!navigator.onLine || typeof grecaptcha === 'undefined') {
        // Offline mode or reCAPTCHA belum termuat
        const userAnswer = parseInt(document.getElementById('math-captcha').value);
        const correctAnswer = parseInt(document.getElementById('math-result').value);

        if (isNaN(userAnswer)) {
            alert("Silakan isi jawaban matematika.");
            return false;
        }

        if (userAnswer !== correctAnswer) {
            alert("Jawaban matematika salah.");
            return false;
        }

        return true;
    } else {
        // Online mode
        var response = grecaptcha.getResponse();
        if (response.length === 0) {
            alert("Silakan isi reCAPTCHA Google.");
            return false;
        }
        return true; // ✅ ini yang penting agar form tetap disubmit
    }
}

    window.onload = function () {
        if (!navigator.onLine) {
            // Show math captcha
            generateCaptcha();
            document.getElementById('math-captcha-label').style.display = 'block';
            document.getElementById('math-captcha').style.display = 'block';
            document.getElementById('g-recaptcha-box').style.display = 'none';
        } else {
            // Hide math captcha if online
            document.getElementById('math-captcha-label').style.display = 'none';
            document.getElementById('math-captcha').style.display = 'none';
            document.getElementById('g-recaptcha-box').style.display = 'block';
        }
    };
    
    if (!navigator.onLine) {
    // Show math captcha & make it required
    generateCaptcha();
    document.getElementById('math-captcha-label').style.visibility = 'visible';
    document.getElementById('math-captcha').style.visibility = 'visible';
    document.getElementById('math-captcha').style.position = 'relative';
    document.getElementById('math-captcha').setAttribute('required', 'required');
    document.getElementById('g-recaptcha-box').style.display = 'none';
} else {
    // Hide math captcha & remove required
    document.getElementById('math-captcha-label').style.visibility = 'hidden';
    document.getElementById('math-captcha').style.visibility = 'hidden';
    document.getElementById('math-captcha').style.position = 'absolute';
    document.getElementById('math-captcha').removeAttribute('required');
    document.getElementById('g-recaptcha-box').style.display = 'block';
}

</script>
<!-- ================> login section end here <================== -->
