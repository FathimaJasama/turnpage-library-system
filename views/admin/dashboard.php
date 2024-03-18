<?php
include("../layouts/Header.php");
?>

<!-- Content wrapper scroll start -->
<div class="content-wrapper-scroll">
	<!-- Main header starts -->
	<div class="main-header d-flex align-items-center justify-content-between position-relative">
		<div class="d-flex align-items-center justify-content-center">
			<div class="page-title d-none d-md-block">
				<h5>Hi <?= $username ?></h5>
			</div>
			<div class="page-icon">
			<i class="bi bi-exclamation-lg"></i>
			</div>
		</div>
	</div>
	<!-- Main header ends -->

	<!-- Content wrapper start -->
	<div class="content-wrapper">
		<div class="subscribe-header">
		<img src="<?=asset("assets/images/librarybg3.jpg")?>" class="img-fluid w-100" alt="Header" style="width: 250px; height: 450px;"/>
		</div>
	</div>
	<!-- Content wrapper end -->


<?php
require_once('../layouts/Footer.php');
?>