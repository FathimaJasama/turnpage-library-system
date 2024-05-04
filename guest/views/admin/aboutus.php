<?php
include("../layouts/Header.php");
?>

<!-- Content wrapper scroll start -->
<div class="content-wrapper-scroll">
	<!-- Main header starts -->
	<div class="main-header d-flex align-items-center justify-content-between position-relative">
		<div class="d-flex align-items-center justify-content-center">
			<div class="page-title d-none d-md-block">
				<h5>Hi </h5>
			</div>
			<div class="page-icon">
				<i class="bi bi-exclamation-lg"></i>
			</div>
		</div>
	</div>
	<!-- Main header ends -->

	<!-- Content wrapper start -->
	<div class="content-wrapper">
        <div class="subscribe-header position-relative">
            <img src="<?= asset("assets/images/TurnPageLibrarySystem(1).png") ?>" class="img-fluid w-100" alt="Header" />
            <a href="<?= url('views/admin/createacc.php') ?>" class="btn btn-primary btn-rounded position-absolute" style="top: 80%; left: 20%; transform: translate(-50%, -50%);">Get Started</a>
		</div>
		<img src="<?= asset("assets/images/aboutthesystem.png") ?>" class="img-fluid w-100" alt="Header" />
		<img src="<?= asset("assets/images/about1.png") ?>" class="img-fluid w-100" alt="Header" />
		<img src="<?= asset("assets/images/about2.png") ?>" class="img-fluid w-100" alt="Header" />
		<img src="<?= asset("assets/images/about3.png") ?>" class="img-fluid w-100" alt="Header" />    </div>
    <!-- Content wrapper end -->


	<?php
	require_once('../layouts/Footer.php');
	?>