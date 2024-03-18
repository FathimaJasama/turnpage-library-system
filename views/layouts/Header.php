
<!-- Include Config -->
<?php
include __DIR__ . '/../../config.php';
include __DIR__ . '/../../helpers/AppManager.php';

$sm = AppManager::getSM();
$username = $sm->getAttribute("username");
$permission = $sm->getAttribute("permission");
$user_id = $sm->getAttribute("userId");



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
		<link rel="shortcut icon" href="<?=asset("assets/images/favicon.svg")?>" />

		<!-- Title -->
		<title>Library Management System</title>

		<!-- *************
			************ Common Css Files *************
		************ -->
		<!-- Bootstrap css -->
		<link rel="stylesheet" href="<?=asset("assets/css/bootstrap.min.css")?>" />

		<!-- Bootstrap font icons css -->
		<link rel="stylesheet" href="<?=asset("assets/fonts/bootstrap/bootstrap-icons.css")?>" />

		<!-- Main css -->
		<link rel="stylesheet" href="<?=asset("assets/css/main.min.css")?>" />

		<!-- *************
			************ Vendor Css Files *************
		************ -->

		<!-- Scrollbar CSS -->
		<link rel="stylesheet" href="<?=asset("assets/vendor/overlay-scroll/OverlayScrollbars.min.css")?>" />

		<!-- Date Range CSS -->
		<link rel="stylesheet" href="<?=asset("assets/vendor/daterange/daterange.css")?>" />

		<!-- Dropzone CSS -->
		<link rel="stylesheet" href="<?=asset("assets/vendor/dropzone/dropzone.min.css")?>" />

		<!-- Login css -->
		<link rel="stylesheet" href="<?=asset("assets/css/login.css")?>" />
	</head>

	<body>

		<!-- Page wrapper start -->
		<div class="page-wrapper">

			<!-- Page header starts -->
			<div class="page-header">

				<!-- Sidebar brand starts -->
				<div class="brand">
					<a href="" class="logo">
						<img src="<?=asset("assets/images/openbook3.PNG")?>" class="d-none d-md-block me-4" alt="Sapphire Admin Dashboard" />
						<div class="page-title d-none d-md-block">
							<h4 class="m-0">Library Management System</h4>
						</div>
						<img src="<?=asset("assets/images/logo-sm.svg")?>" class="d-block d-md-none me-4" alt="Sapphire Admin Dashboard" />
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
						<input type="text" class="form-control" placeholder="Search" />
						<!-- Search input group end -->

					</div>
					<!-- Search container end -->

					<!-- Header actions start -->
					<div class="header-actions d-xl-flex d-lg-none gap-4">
						<div class="dropdown">
							<a class="dropdown-toggle" href="#!" role="button" data-bs-toggle="dropdown" aria-expanded="false">
								<i class="bi bi-envelope-open fs-5 lh-1"></i>
								<span class="count-label"></span>
							</a>
							<div class="dropdown-menu dropdown-menu-end shadow-lg">
								<div class="dropdown-item">
									<div class="d-flex py-2 border-bottom">
										<img src="<?=asset("assets/images/user.png")?>" class="img-3x me-3 rounded-3" alt="Admin Dashboards" />
										<div class="m-0">
											<h6 class="mb-1 fw-semibold">Sophie Michiels</h6>
											<p class="mb-1">Membership has been ended.</p>
											<p class="small m-0 text-secondary">Today, 07:30pm</p>
										</div>
									</div>
								</div>	
								<div class="d-grid mx-3 my-1">
									<a href="javascript:void(0)" class="btn btn-primary">View all</a>
								</div>
							</div>
						</div>
						<a href="account-settings.html" data-bs-toggle="tooltip" data-bs-placement="bottom"
							data-bs-custom-class="custom-tooltip-blue" data-bs-title="Settings">
							<i class="bi bi-gear fs-5"></i>
						</a>
					</div>
					<!-- Header actions start -->

					<!-- Header profile start -->
					<div class="header-profile d-flex align-items-center">
						<div class="dropdown">
							<a href="#" id="userSettings" class="user-settings" data-toggle="dropdown" aria-haspopup="true">
								<span class="user-name d-none d-md-block">Michelle White</span>
								<span class="avatar">
									<img src="<?=asset("assets/images/user2.png")?>" alt="Admin Templates" />
									<span class="status online"></span>
								</span>
							</a>
							<div class="dropdown-menu dropdown-menu-end" aria-labelledby="userSettings">
								<div class="header-profile-actions">
									<a href="profile.html">Profile</a>
									<a href="account-settings.html">Settings</a>
									<a href="login.html">Logout</a>
								</div>
							</div>
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
							<ul>
								<li>
									<a href="<?= "dashboard.php"?>">
										<i class="bi bi-building"></i>
										<span class="menu-text">Dashboard</span>
									</a>
								</li>
								<li>
									<a href="<?= 'account-settings.php' ?>">
										<i class="bi bi-file-person-fill"></i>
										<span class="menu-text">Account</span>
									</a>
								</li>
								<li>
									<a href="<?= 'table.php' ?>">
										<i class="bi bi-journals"></i>
										<span class="menu-text">Book Details</span>
									</a>
								</li>
								<li class="sidebar-dropdown">
									<a href=<?= 'books.php'?>>
										<i class="bi bi-book"></i>
										<span class="menu-text">Books</span>
									</a>
									<div class="sidebar-submenu">
										<ul>
											<li>
												<a href="accordions.html">View Books</a>
											</li>
											<li>
												<a href="alerts.html">Books by Authors</a>
											</li>
											<li>
												<a href="buttons.html">Category</a>
											</li>
										</ul>
									</div>
								</li>
								<li>
								<a href="<?= 'users.php' ?>">
										<i class="bi bi-people-fill"></i>
										<span class="menu-text">Users</span>
									</a>
								</li>	
								<li>
									<a href="<?='forgot-password.php'?>">
										<i class="bi bi-emoji-expressionless"></i>
										<span class="menu-text">Forgot Password</span>
									</a>
								</li>
							</ul>		
						</div>
					</div>
					<!-- Sidebar menu ends -->
				</nav>
				<!-- Sidebar wrapper end -->
	
				<!-- Content wrapper scroll start -->
				
