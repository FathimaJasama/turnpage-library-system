<?php
include("../layouts/Header.php");

?>
			<!-- Content wrapper scroll start -->
				<div class="content-wrapper-scroll">

					<!-- Main header starts -->
					<div class="main-header d-flex align-items-center justify-content-between position-relative">
						<div class="d-flex align-items-center justify-content-center">
							<div class="page-icon">
								<i class="bi bi-file-person-fill"></i>
							</div>
							<div class="page-title d-none d-md-block">
								<h5>Account Settings</h5>
							</div>
						</div>
				
					</div>
					<!-- Main header ends -->

					<!-- Content wrapper start -->
					<div class="content-wrapper">
						<div class="subscribe-header">
							<img src="<?=asset('assets/images/rifdha1.PNG')?>" class="img-fluid w-100" alt="Header" />
							
						</div>
						<div class="subscriber-body">
							<!-- Row start -->
							<div class="row justify-content-center mt-4">
								<div class="col-lg-12">
									<!-- Row start -->
									<div class="row align-items-end">
										<div class="col-auto">
										<img src="<?= asset("services/uploads/66053b74106dd_jesala.jpg")?>" class="img-7xx rounded-circle" alt="Google Admin" />
									</div>
										<div class="col">
											<h6>Admin</h6>  
											<h4 class="m-0"><?= $FullName?></h4>
										</div>
										
									</div>
									<!-- Row end -->
								</div>
							</div>
							<!-- Row end -->

							<!-- Row start -->
							<div class="row justify-content-center mt-4">
								<div class="col-lg-12">
									<div class="card light">
										<div class="card-body">
											<div class="custom-tabs-container">
												<ul class="nav nav-tabs" id="customTab2" role="tablist">
													<li class="nav-item" role="presentation">
														<a class="nav-link active" id="tab-oneA" data-bs-toggle="tab" href="#oneA" role="tab"
															aria-controls="oneA" aria-selected="true">My Profile
														</a>
												
												</ul>
												<div class="tab-content h-350">
													<div class="tab-pane fade show active" id="oneA" role="tabpanel">
														<!-- Row start -->
														<div class="row gx-3">
															<div class="col-sm-4 col-12">
																<div id="update-profile" class="mb-3">
																	<form action="/upload" class="dropzone sm needsclick dz-clickable"
																		id="update-profile-pic">
																		<div class="dz-message needsclick">
																			<button type="button" class="dz-button">
																				Update Image.
																			</button>
																		</div>
																	</form>
																</div>
															</div>
															<div class="col-sm-8 col-12">
																<div class="row gx-3">
																	<div class="col-6">
																		<!-- Form Field Start -->
																		<div class="mb-3">
																			<label for="fullName" class="form-label">Full Name</label>
																			<input type="text" class="form-control" id="fullName" placeholder="Full Name" />
																		</div>

																		<!-- Form Field Start -->
																		<div class="mb-3">
																			<label for="contactNumber" class="form-label">Contact</label>
																			<input type="text" class="form-control" id="contactNumber"
																				placeholder="Contact" />
																		</div>
																	</div>
																	<div class="col-6">
																		<!-- Form Field Start -->
																		<div class="mb-3">
																			<label for="emailId" class="form-label">Email</label>
																			<input type="email" class="form-control" id="emailId" placeholder="Email ID" />
																		</div>

																		<!-- Form Field Start -->
																		<div class="mb-3">
																			<label for="birthDay" class="form-label">Birthday</label>
																			<div class="input-group">
																				<input type="text" class="form-control datepicker-opens-left" id="birthDay"
																					placeholder="" />
																				<span class="input-group-text">
																					<i class="bi bi-calendar4"></i>
																				</span>
																			</div>
																		</div>
																	</div>
																	<div class="col-12">
																		<!-- Form Field Start -->
																		<div class="mb-3">
																			<label class="form-label">About</label>
																			<textarea class="form-control" rows="3"></textarea>
																		</div>
																	</div>
																</div>
															</div>
														</div>
														<!-- Row end -->
													</div>
													</div>
												<div class="d-flex gap-2 justify-content-end">
													<button type="button" class="btn btn-outline-secondary">
														Cancel
													</button>
													<button type="button" class="btn btn-success">
														Update
													</button>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<!-- Row end -->
						</div>
					</div>
					<!-- Content wrapper end -->

				

										
				
<?php
require_once('../layouts/Footer.php');
?>