<?php
require_once('../layouts/Header.php');
?>

<div class="content-wrapper-scroll">

	<!-- Main header starts -->
	<div class="main-header d-flex align-items-center justify-content-between position-relative">
		<div class="d-flex align-items-center justify-content-center">
			<div class="page-icon">
				<i class="bi bi-pie-chart"></i>
			</div>
			<div class="page-title d-none d-md-block">
				<h5>Dashboard</h5>
			</div>
		</div>

	</div>
	<div class="content-wrapper">
		<div class="subscribe-header">

			<section class="content m-3">

				<!-- <div class="container-fluid"> -->

					<!-- <div class="card"> -->
						

					<div class="row">
						<div class="col-xxl-3 col-sm-6 col-12">
							<div class="card mb-4">
								<div class="card-body d-flex align-items-center p-0">
									<div class="p-4">
										<i class="bi bi-person-workspace fs-1 lh-1 text-primary"></i>
									</div>
									<div class="py-4">
										<h5 class="text-secondary fw-light m-0">Authors</h5>
										<h1 class="m-0"><?php include 'counts/authors.php'?></h1>
									</div>
									<span class="badge bg-info position-absolute top-0 end-0 m-3 bg-opacity-50"><i class="bi bi-caret-up-fill"></i>18%</span>
								</div>
							</div>
						</div>
						<div class="col-xxl-3 col-sm-6 col-12">
							<div class="card mb-4">
								<div class="card-body d-flex align-items-center p-0">
									<div class="p-4">
										<i class="bi bi-grid fs-1 lh-1 text-primary"></i>
									</div>
									<div class="py-4">
										<h5 class="text-secondary fw-light m-0">Categories</h5>
										<h1 class="m-0"><?php include 'counts/categories.php'?></h1>
									</div>
									<span class="badge bg-info position-absolute top-0 end-0 m-3 bg-opacity-50"><i class="bi bi-caret-up-fill"></i>15%</span>
								</div>
							</div>
						</div>
						<div class="col-xxl-3 col-sm-6 col-12">
							<div class="card mb-4">
								<div class="card-body d-flex align-items-center p-0">
									<div class="p-4">
										<i class="bi bi-envelope fs-1 lh-1 text-primary"></i>
									</div>
									<div class="py-4">
										<h5 class="text-secondary fw-light m-0">Messages</h5>
										<h1 class="m-0"><?php include 'counts/messages.php'?></h1>
									</div>
									<span class="badge bg-info position-absolute top-0 end-0 m-3 bg-opacity-50"><i class="bi bi-caret-up-fill"></i>11%</span>
								</div>
							</div>
						</div>
						<div class="col-xxl-3 col-sm-6 col-12">
							<div class="card mb-4">
								<div class="card-body d-flex align-items-center p-0">
									<div class="p-4">
										<i class="bi bi-file-person-fill fs-1 lh-1 text-danger"></i>
									</div>
									<div class="py-4">
										<h5 class="text-secondary fw-light m-0">Users</h5>
										<h1 class="m-0 text-danger"><?php include 'counts/students.php'?></h1>
									</div>
									<span class="badge bg-danger position-absolute top-0 end-0 m-3 bg-opacity-50"><i class="bi bi-caret-down-fill"></i>9%</span>
								</div>
							</div>
						</div>
					</div>
				<!-- </div>
		</div>
	</div>
</div>
</div> -->
<div class="row">
							<div class="col-xl-4 col-sm-6 col-12">
								<div class="card mb-4">
									<div class="card-header">
										<h5 class="card-title">Messages</h5>
									</div>
									<div class="card-body">
										<div class="scroll350">
											<div class="d-flex align-items-center mb-4">
												<img src="assets/images/user4.svg" class="img-5x me-3 rounded-4" alt="Admin Dashboard" />
												<div class="m-0">
													<h6 class="fw-bold">Roseann Talmai</h6>
													<p class="mb-2">
														New contract web template design and web development
														including testing and bug fixes.
													</p>
													<p class="small mb-2 text-secondary">3 day ago</p>
												</div>
												<span class="badge bg-success ms-auto">Completed</span>
											</div>
											<div class="d-flex align-items-center mb-4">
												<img src="assets/images/user3.svg" class="img-5x me-3 rounded-4" alt="Admin Dashboard" />
												<div class="m-0">
													<h6 class="fw-bold">Clyde Theodora</h6>
													<p class="mb-2">
														Quarter budget analysis planned review and approved
														by team.
													</p>
													<p class="small mb-2 text-secondary">2 days ago</p>
												</div>
												<span class="badge bg-info ms-auto">Completed</span>
											</div>
											<div class="d-flex align-items-center mb-4">
												<img src="assets/images/user1.svg" class="img-5x me-3 rounded-4" alt="Admin Themes" />
												<div class="m-0">
													<h6 class="fw-bold">Ilyana Maes</h6>
													<p class="mb-2">
														Adobe creative cloud new plan approved for Alex's
														team.
													</p>
													<p class="small mb-2 text-secondary">1 day ago</p>
												</div>
												<span class="badge bg-danger ms-auto">Completed</span>
											</div>
											<div class="d-flex align-items-center mb-4">
												<img src="assets/images/user5.svg" class="img-5x me-3 rounded-4" alt="Admin Themes" />
												<div class="m-0">
													<h6 class="fw-bold">Zahra Brigitte</h6>
													<p class="mb-2">
														Create user journey and flows for Zia's product .
													</p>
													<p class="small mb-2 text-secondary">1 day ago</p>
												</div>
												<span class="badge bg-warning ms-auto">Completed</span>
											</div>
											<div class="d-flex align-items-center mb-4">
												<img src="assets/images/user2.svg" class="img-5x me-3 rounded-4" alt="Admin Dashboard" />
												<div class="m-0">
													<h6 class="fw-bold">Mayrbek Kiana</h6>
													<p class="mb-2">Report a bug to infinity support</p>
													<p class="small mb-2 text-secondary">8 hours ago</p>
												</div>
												<span class="badge bg-info ms-auto">Completed</span>
											</div>
										</div>
									</div>
								</div>
							</div>





<?php
require_once('../layouts/Footer.php');
?>
<!-- Required jQuery first, then Bootstrap Bundle JS -->