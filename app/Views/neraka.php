
<footer>
</footer>
    <!-- ================> Footer section end here <================== -->

	
	<!-- All Needed JS -->
	<script>
    var timeout = 10 * 60 * 1000; // 15 menit dalam milidetik
    var logoutUrl = "<?= base_url('home/logout') ?>"; // URL logout

    var logoutTimer = setTimeout(logoutUser, timeout);

    function resetTimer() {
        clearTimeout(logoutTimer);
        logoutTimer = setTimeout(logoutUser, timeout);
    }

    function logoutUser() {
        alert("Anda telah logout karena tidak ada aktivitas.");
        window.location.href = logoutUrl;
    }

    // Deteksi aktivitas pengguna
    document.addEventListener("mousemove", resetTimer);
    document.addEventListener("keypress", resetTimer);
    document.addEventListener("scroll", resetTimer);
    document.addEventListener("click", resetTimer);
</script>
	<script src="<?= base_url('assets/js/vendor/jquery-3.6.0.min.js')?>"></script>
	<script src="<?= base_url('assets/js/vendor/modernizr-3.11.2.min.js')?>"></script>
	<script src="<?= base_url('assets/js/isotope.pkgd.min.js')?>"></script>
	<script src="<?= base_url('assets/js/swiper.min.js')?>"></script>
	<script src="<?= base_url('assets/js/all.min.js')?>"></script> 
	<script src="<?= base_url('assets/js/wow.js')?>"></script>
	<script src="<?= base_url('assets/js/counterup.js')?>"></script>
	<script src="<?= base_url('assets/js/jquery.countdown.min.js')?>"></script>
	<script src="<?= base_url('assets/js/lightcase.js')?>"></script>
	<script src="<?= base_url('assets/js/waypoints.min.js')?>"></script>
	<script src="<?= base_url('assets/js/vendor/bootstrap.bundle.min.js')?>"></script>
	<script src="<?= base_url('assets/js/plugins.js')?>"></script>
	<script src="<?= base_url('assets/js/main.js')?>"></script>
</body>
</html>
