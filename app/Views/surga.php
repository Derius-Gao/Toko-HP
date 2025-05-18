<?php
$db = db_connect();
$pengaturan = $db->table('pengaturan_app')->get()->getRow();
?>

<!doctype html>
<html class="no-js" lang="en">

<head>
	     <meta charset="utf-8">
      <meta charset="utf-8">
    <title><?= $pengaturan->judul ?? 'Aplikasi Web' ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <?php if (!empty($pengaturan->logo_web) && file_exists(FCPATH . 'uploads/' . $pengaturan->logo_web)): ?>
        <link rel="shortcut icon" href="<?= base_url('uploads/' . $pengaturan->logo_web) ?>" type="image/x-icon">
    <?php else: ?>
        <link rel="shortcut icon" href="<?= base_url('img/default-logo.png') ?>" type="image/x-icon">
    <?php endif; ?>

	<!-- Place favicon.ico in the root directory -->

	<!-- All stylesheet and icons css  -->
	<link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css')?>">
	<link rel="stylesheet" href="<?= base_url('assets/css/animate.css')?>">
	<link rel="stylesheet" href="<?= base_url('assets/css/all.min.css')?>">
	<link rel="stylesheet" href="<?= base_url('assets/css/swiper.min.css')?>">
	<link rel="stylesheet" href="<?= base_url('assets/css/lightcase.css')?>">
	<link rel="stylesheet" href="<?= base_url('assets/css/style.css')?>">
<div id="google_translate_element"></div>

<script type="text/javascript">
    function googleTranslateElementInit() {
        new google.translate.TranslateElement({
            pageLanguage: 'id',
            includedLanguages: 'en,id',
            layout: google.translate.TranslateElement.InlineLayout.SIMPLE
        }, 'google_translate_element');
    }
</script>
<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
</head>

<body>
	<!-- preloader start here -->
    <div class="preloader">
        <div class="preloader-inner">
            <div class="preloader-icon">
                <span></span>
                <span></span>
            </div>
        </div>
    </div>
	<!-- preloader ending here -->

	<!-- scrollToTop start here -->
    <a href="#" class="scrollToTop"><i class="fa-solid fa-angle-up"></i></a>
    <!-- scrollToTop ending here -->

    <!-- ================> header section start here <================== -->
    <header class="header" id="navbar">
		<div class="header__bottom">
			<div class="container">
				<nav class="navbar navbar-expand-lg">
				  <div class="logo">
        <?php if (!empty($pengaturan->logo) && file_exists(FCPATH . 'uploads/' . $pengaturan->logo)): ?>
            <img src="<?= base_url('uploads/' . $pengaturan->logo) ?>" alt="Logo Header" width="100">
        <?php else: ?>
            <img src="<?= base_url('img/default-logo.png') ?>" alt="Default Logo" width="100">
        <?php endif; ?>
    </div>
					<button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse"
						data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false"
						aria-label="Toggle navigation">
						<span class="navbar-toggler--icon"></span>
					</button>
					<div class="collapse navbar-collapse justify-content-end" id="navbarNavAltMarkup">
						<div class="navbar-nav mainmenu">
