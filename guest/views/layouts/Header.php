<!-- Include Config -->
<?php
include __DIR__ . '/../../config.php';
include __DIR__ . '/../../helpers/AppManager.php';
// require_once __DIR__ . '/../../models/Student.php';

// $studentModel = new Student();
// $students = $studentModel->getAll();
$sm = AppManager::getSM();
// $Photo = $sm->getAttribute("Photo");
// $FullName = $sm->getAttribute("FullName");
// $student_id = $sm->getAttribute("studentId");



$currentUrl = $_SERVER['SCRIPT_NAME'];

// Extract the last filename from the URL
$currentFilename = basename($currentUrl);  // e.g., "dashboard.php"
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

	<!-- Meta -->
	<meta name="description" content="Sapphire - Responsive Bootstrap 5 Dashboard Template" />
	<meta name="author" content="Bootstrap Gallery" />
	<link rel="canonical" href="https://www.bootstrap.gallery/">
	<meta property="og:url" content="https://www.bootstrap.gallery">
	<meta property="og:title" content="Admin Templates - Dashboard Templates | Bootstrap Gallery">
	<meta property="og:description" content="Marketplace for Bootstrap Admin Dashboards">
	<meta property="og:type" content="Website">
	<meta property="og:site_name" content="Bootstrap Gallery">
	<link rel="shortcut icon" href="<?= asset("assets/images/openbook4.png") ?>" />

	<!-- Title -->
	<title>TurnPage Library System</title>

	<!-- *************
			************ Common Css Files *************
		************ -->
	<!-- Bootstrap css -->
	<link rel="stylesheet" href="<?= asset("assets/css/bootstrap.min.css") ?>" />

	<!-- Bootstrap font icons css -->
	<link rel="stylesheet" href="<?= asset("assets/fonts/bootstrap/bootstrap-icons.css") ?>" />

	<!-- Main css -->
	<link rel="stylesheet" href="<?= asset("assets/css/main.min.css") ?>" />

	<!-- *************
			************ Vendor Css Files *************
		************ -->

	<!-- Scrollbar CSS -->
	<link rel="stylesheet" href="<?= asset("assets/vendor/overlay-scroll/OverlayScrollbars.min.css") ?>" />

	<!-- Date Range CSS -->
	<link rel="stylesheet" href="<?= asset("assets/vendor/daterange/daterange.css") ?>" />

	<!-- Dropzone CSS -->
	<link rel="stylesheet" href="<?= asset("assets/vendor/dropzone/dropzone.min.css") ?>" />

	<!-- Login css -->
	<link rel="stylesheet" href="<?= asset("assets/css/login.css") ?>" />
</head>
<stty>

	<body>

		<!-- Page wrapper start -->
		<div class="page-wrapper">

			<!-- Page header starts -->
			<div class="page-header">

				<!-- Sidebar brand starts -->
				<div class="brand">
					<a href="" class="logo">
						<img src="<?= asset("assets/images/openbook3.PNG") ?>" class="d-none d-md-block me-4" alt="Sapphire Admin Dashboard" />
						<div class="page-title d-none d-md-block">
							<h4 class="m-0">TurnPage Library System</h4>
						</div>
						<img src="<?= asset("assets/images/logo-sm.svg") ?>" class="d-block d-md-none me-4" alt="Sapphire Admin Dashboard" />
					</a>
				</div>
				<!-- Sidebar brand ends -->

				<div class="toggle-sidebar" id="toggle-sidebar">
					<i class="bi bi-list"></i>
				</div>

				<!-- Header actions ccontainer start -->
				<div class="header-actions-container">

					<!-- Search container start -->
					<div class="search-container me-4 d-xl-block d-lg-none">

						<!-- Search input group start -->
						<input type="text" id="searchInput" class="form-control" placeholder="Search" />
						<!-- Search input group end -->

					</div>
					<!-- Search container end -->

					<!-- Header actions start -->

					<!-- Header actions start -->

					<!-- Header profile start -->
					<div class="header-profile d-flex align-items-center">
						<div class="dropdown">
							<a href="#" id="userSettings" class="user-settings" data-toggle="dropdown" aria-haspopup="true">
								<span class="user-name d-none d-md-block">Guest</span>
								<span class="avatar">
									<img src="<?= asset('guest/assets/images/guestdp.png') ?>" alt="default-avatar" width="80" id="defaultAvatar">
								</span>
							</a>
						</div>
					</div>
					<!-- Header profile end -->

				</div>
				<!-- Header actions ccontainer end -->

			</div>
			<!-- Page header ends -->

			<!-- Main container start -->
			<div class="main-container">

				<!-- Sidebar wrapper start -->
				<nav class="sidebar-wrapper">

					<!-- Sidebar menu starts -->
					<div class="sidebar-menu">
						<div class="sidebarMenuScroll">
							<ul id="dashboard">
								<li>
									<a href="<?= "aboutus.php" ?>">
										<i class="bi bi-info-circle"></i>
										<span class="menu-text">About Us</span>
									</a>
								</li>
								<li class="sidebar-dropdown">
										<a href="#">
											<i class="bi bi-grid"></i>
											<span class="menu-text">Books</span>
										</a>
										<div class="sidebar-submenu">
											<ul>
												<li>
													<a href=<?= url("guest/views/admin/categories/technology.php") ?>>Technology</a>
												</li>
												<li>
													<a href=<?= url("guest/views/admin/categories/science.php") ?>>Science</a>
												</li>
												<li>
													<a href=<?= url("guest/views/admin/categories/management.php") ?>>Management</a>
												</li>
												<li>
													<a href=<?= url("guest/views/admin/categories/general.php") ?> > General</a>
												</li>
												<li>
													<a href=<?= url("guest/views/admin/categories/romantic.php") ?>>Romantic</a>
												</li>
												<li>
													<a href=<?= url("guest/views/admin/categories/programming.php") ?>>Programming</a>
												</li>
											</ul>
										</div>
									</li>
								<li>
									<a href="<?= url('views/admin/createacc.php') ?>">
										<i class="bi bi-file-person-fill"></i>
										<span class="menu-text">Sign up</span>
									</a>
								</li>
								<li>
									<a href="<?= 'support.php'?>">
										<i class="bi bi-code-square"></i>
										<span class="menu-text">Support</span>
									</a>
								</li>
							</ul>
						</div>
					</div>
					<!-- Sidebar menu ends -->
				</nav>
				<!-- Sidebar wrapper end -->

				<!-- Content wrapper scroll start -->

				<script>
					document.getElementById('searchInput').addEventListener('input', function() {
						var searchQuery = this.value.toLowerCase();
						var dashboardItems = document.querySelectorAll('#dashboard li');

						dashboardItems.forEach(function(item) {
							var text = item.textContent.toLowerCase();
							if (text.indexOf(searchQuery) !== -1) {
								item.style.display = 'block'; // Show the item
							} else {
								item.style.display = 'none'; // Hide the item
							}
						});
					});
				</script>