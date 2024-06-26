<!-- Include Config -->
<?php
include __DIR__ . '/../../config.php';
include __DIR__ . '/../../helpers/AppManager.php';
require_once __DIR__ . '/../../models/Student.php';

$studentModel = new Student();
$students = $studentModel->getAll();
$sm = AppManager::getSM();
$Photo = $sm->getAttribute("Photo");
$FullName = $sm->getAttribute("FullName");
$student_id = $sm->getAttribute("studentId");
$StudentId = $sm->getAttribute("StudentId");




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

					<div class="header-actions d-xl-flex d-lg-none gap-4">
						<?php if ($StudentId == '946172073v') : ?>
							<div class="dropdown">
								<a href="messages.php" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="custom-tooltip-blue" data-bs-title="Messages">
									<i class="bi bi-envelope-open fs-5 lh-1"></i>
									<span class="count-label"></span>
								</a>
							</div>
						<?php else : ?>
							<a href="booktables-oop.php" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="custom-tooltip-blue" data-bs-title="Books">
								<i class="bi bi-journals fs-5 lh-1"></i>
								<span class="count-label"></span>
							</a>
						<?php endif; ?>
						<a href="account-settings.php" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="custom-tooltip-blue" data-bs-title="Settings">
							<i class="bi bi-gear fs-5"></i>
						</a>
					</div>

					<!-- Header actions start -->

					<!-- Header profile start -->
					<div class="header-profile d-flex align-items-center">
						<div class="dropdown">
							<a href="#" id="userSettings" class="user-settings" data-toggle="dropdown" aria-haspopup="true">
								<span class="user-name d-none d-md-block"><?= $FullName ?></span>
								<span class="avatar">
									<?php
									// Find the user's data in the $students array
									$currentUser = null;
									foreach ($students as $key => $student) {
										if ($student['id'] == $student_id) {
											$currentUser = $student;
											break;
										}
									}

									// Display the user's photo if found
									if ($currentUser && isset($currentUser['Photo']) && !empty($currentUser['Photo'])) {
									?>
										<img src="<?= asset('services/uploads/' . $currentUser['Photo']) ?>" alt="user-avatar" width="80" id="uploadedAvatar">
									<?php
									} else {
										// Default avatar if photo not found
									?>
										<img src="<?= asset('guest/assets/images/guestdp.png') ?>" alt="default-avatar" width="80" id="defaultAvatar">
									<?php
									}
									?>
									<span class="status online"></span>
								</span>
							</a>
							<div class="dropdown-menu dropdown-menu-end" aria-labelledby="userSettings">
								<div class="header-profile-actions">
									<a href="account-settings.php">Profile</a>
									<a class="dropdown-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout
										<form id="logout-form" action="<?= url('views/auth/logout.php') ?>" method="POST" class="d-none">
										</form>
									</a>
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
							<ul id="dashboard">
								<li>
									<a href="<?= "aboutus.php" ?>">
										<i class="bi bi-info-circle"></i>
										<span class="menu-text">About Us</span>
									</a>
								</li>
								<li>
									<a href="<?= 'account-settings.php' ?>">
										<i class="bi bi-file-person-fill"></i>
										<span class="menu-text">Account</span>
									</a>
								</li>
								<?php if ($StudentId == '946172073v') : ?>
									<li>
										<a href="<?= "dashboard.php" ?>">
											<i class="bi bi-pie-chart"></i>
											<span class="menu-text">Dashboard</span>
										</a>
									</li>
									<li class="sidebar-dropdown">
										<a href="#">
											<i class="bi bi-journals"></i>
											<span class="menu-text">Books</span>
										</a>
										<div class="sidebar-submenu">
											<ul>
												<li>
													<a href='<?= "addbooks.php" ?>'>Add Books</a>
												</li>
												<li>
													<a href='<?= "booktables-oop.php" ?>'>Manage Books</a>
												</li>
											</ul>
										</div>
									</li>
									<li class="sidebar-dropdown">
										<a href="#">
											<i class="bi bi-box-arrow-down-right"></i>
											<span class="menu-text">Issue Books</span>
										</a>
										<div class="sidebar-submenu">
											<ul>
												<li>
													<a href='<?= "addissuedbooks.php" ?>'>Issue Books</a>
												</li>
												<li>
													<a href='<?= "Issuedbooks.php" ?>'>Issued Books Details</a>
												</li>
											</ul>
										</div>
									</li>
									<li class="sidebar-dropdown">
										<a href="#">
											<i class="bi bi-person-workspace"></i>
											<span class="menu-text">Author</span>
										</a>
										<div class="sidebar-submenu">
											<ul>
												<li>
													<a href='<?= "addauthors.php" ?>'>Add Authors</a>
												</li>
												<li>
													<a href='<?= "ManageAuthor.php" ?>'>Manage Authors</a>
												</li>
											</ul>
										</div>
									</li>
									<li class="sidebar-dropdown">
										<a href="#">
											<i class="bi bi-grid"></i>
											<span class="menu-text">Categories</span>
										</a>
										<div class="sidebar-submenu">
											<ul>
												<li>
													<a href='<?= "addcategory.php" ?>'>Add Category</a>
												</li>
												<li>
													<a href='<?= "categories.php" ?>'>Manage Categories</a>
												</li>
											</ul>
										</div>
									</li>
									<li>
										<a href="<?= 'students.php' ?>">
											<i class="bi bi-people-fill"></i>
											<span class="menu-text">Students</span>
										</a>
									</li>
									<li>
										<a href="<?= 'messages.php' ?>">
											<i class="bi bi-envelope"></i>
											<span class="menu-text">Messages</span>
										</a>
									</li>
								<?php else : ?>
									<li>
										<a href='<?= "categories.php" ?>'>
											<i class="bi bi-grid"></i>
											<span class="menu-text">Categories</span>
										</a>
									</li>
									<li>
										<a href='<?= "booktables-oop.php" ?>'>
											<i class="bi bi-journals"></i>
											<span class="menu-text">Book details</span>
										</a>
									</li>
									<li>
										<a href='<?= "ManageAuthor.php" ?>'>
											<i class="bi bi-person-workspace"></i>
											<span class="menu-text">Authors</span>
										</a>
									</li>
									<li>
										<a href="<?= 'support.php' ?>">
											<i class="bi bi-code-square"></i>
											<span class="menu-text">Support</span>
										</a>
									</li>
								<?php endif; ?>
								<li>
									<a href="<?= 'forgot-password-login.php' ?>" target="_blank">
										<i class="bi bi-emoji-expressionless"></i>
										<span class="menu-text">Change Password</span>
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