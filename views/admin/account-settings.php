<?php
include("../layouts/Header.php");
require_once __DIR__ . '/../../models/Student.php';
require_once __DIR__ . '/../../models/Issuebook.php';


$studentModel = new Student();
$students = $studentModel->getAll();
$issuebookModel = new Issuebook();
$issuebooks = $issuebookModel->getAll();
$sm = AppManager::getSM();
$Photo = $sm->getAttribute("Photo");
$FullName = $sm->getAttribute("FullName");
$student_id = $sm->getAttribute("studentId");
$StudentId = $sm->getAttribute("StudentId");

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
			<section class="content m-3">

				<div class="container-fluid">
					<div class="row justify-content-center">
						<div class="col-xxl-12">
							<div class="card mb-4">
								<div class="card-body">
									<!-- Row start -->
									<div class="row align-items-center">

										<div class="col-auto">
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
												<img src="<?= asset('services/uploads/' . $currentUser['Photo']) ?>" alt="user-avatar" class="img-7xx rounded-circle" width="80" id="uploadedAvatar">
											<?php
											} else {
												// Default avatar if photo not found
											?>
												<img src="<?= asset('guest/assets/images/guestdp.png') ?>" alt="default-avatar" width="80" id="defaultAvatar">
											<?php
											}
											?>

										</div>
										<div class="col">
										</div>
										<div class="card-body">
											<?php if ($StudentId == '946172073v') : ?>
												<h5>Admin</h5>
											<?php endif; ?>
											<h5><?= $student['FullName'] ?? ""; ?> </h5>
											<h5><?= $student['StudentId'] ?? ""; ?></h5>
											<h5><span class="text-primary"><?= $student['EmailId'] ?? ""; ?></span></h5>
											<h6 class="d-flex align-items-center mb-3">
												<span class="text"><?= $student['MobileNumber'] ?? ""; ?></span>
											</h6>

										</div>
									</div>
									<!-- <div class="col-sm-6 col-12">
										<div class="form-group">
											<label for="nic">NIC Number</label>
											<input type="text" class="form-control" id="nic" placeholder="1234567890v">
										</div>
									</div> -->
									<div class="col-sm-6 col-12">
										<div class="form-group">
											<label for="fullName">Full Name</label>
											<input type="text" class="form-control" id="fullName" placeholder="Full Name">
										</div>
									</div>
									<div class="col-sm-6 col-12">
										<div class="form-group">
											<label for="eMail">Email</label>
											<input type="email" class="form-control" id="eMail" placeholder="Enter email ID">
										</div>
									</div>
									<div class="col-sm-6 col-12">
										<div class="form-group">
											<label for="phone">Phone</label>
											<input type="text" class="form-control" id="phone" placeholder="Enter phone number">
										</div>
									</div>
									<div class="col-sm-6 col-12">
										<div class="form-group">
											<label for="mobile">Mobile</label>
											<input type="tel" class="form-control" id="mobile" placeholder="1234567890">
										</div>
									</div>
								</div>
								<div class="row gutters">
									<div class="col-sm-12">
										<div class="text-right">
											<div>
												<button class="btn btn-light m-2 edit-student" data-id="<?= $student['id']; ?>">Edit</button>
											</div>
										</div>
									</div>
								</div>
								<br>
								<?php
								// Find the user's data in the $students array
								$currentUser = null;
								foreach ($issuebooks as $key => $issuebook) {
									if ($issuebook['StudentID'] == $StudentId) {
										$currentUser = $issuebook;
										break;
									}
								}

								// Display the user's photo if found
								if ($currentUser && isset($currentUser['fine']) && !empty($currentUser['fine'])) {
								?>
									<h5><span style="font-size:25px;"> &#128226; </span>&nbsp;The fine amount per overdue book stands at &nbsp;&nbsp;<span class="text-danger"><?= $issuebook['fine'] ?? ""; ?>$</span>
										<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Please ensure timely returns to avoid accumulating fines.
									</h5>
								<?php
								} else {
									// Default avatar if photo not found
								?>
								<?php
								}
								?>
							</div>
						</div>
					</div>
				</div>
			</section>
		</div>
	</div>





	<!-- Update Student Modal -->

	<div class="modal fade " id="editStudentModal" tabindex="-1" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<form id="update-student-form" action="<?= url('services/ajax_functions.php') ?>" autocomplete="off" enctype="multipart/form-data">
					<input type="hidden" name="action" value="update_studentprofile">
					<input type="hidden" name="id" id="student_id">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel1">Edit Student</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<!-- <div class="row">
						<div class="col mb-3">
							<label for="StudentId" class="form-label">Student ID</label>
							<input type="text" id="StudentId" name="StudentId" class="form-control" placeholder="Enter Name" required />
						</div>
					</div> -->
						<div class="col-12 mb-3">
							<label for="Photo" class="form-label">Photo</label>
							<input class="form-control" name="Photo" id="editPhoto" type="file" accept="image/*">
						</div>
						<div class="row">
							<div class="col mb-3">
								<label for="FullName" class="form-label">Full Name</label>
								<input type="text" id="FullName" name="FullName" class="form-control" placeholder="Enter Name" required />
							</div>
						</div>
						<div class="row g-1">
							<div class="col mb-0">
								<label for="EmailId" class="form-label">Email</label>
								<input type="email" id="EmailId" name="EmailId" class="form-control" placeholder="xxxx@xxx.xx" required />
							</div>
						</div>
						<div class="row g-2 mt-2">

							<div class="row g-1">
								<div class="col mb-0">
									<label for="MobileNumber" class="form-label">Mobile Number</label>
									<input type="tel" id="MobileNumber" name="MobileNumber" class="form-control" placeholder="123-456-7890" required />
								</div>
							</div>


							<div class="mb-3 mt-3">
								<div id="alert-container-update-form"></div>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
								Close
							</button>
							<button type="button" id="update-now" class="btn btn-primary">Save</button>
						</div>
				</form>
			</div>
		</div>
	</div>





	<?php
	require_once('../layouts/Footer.php');
	?>

	<script>
		$(document).ready(function() {



			$('.edit-student').on('click', async function() {
				var student_id = $(this).data('id');
				await getStudentById(student_id);
			})

			$('.delete-student').on('click', async function() {
				var student_id = $(this).data('id');
				var is_confirm = confirm('Are you sure,Do you want to delete?');
				if (is_confirm) await deleteById(student_id);
			})

			// update student form
			// handle update modal button click
			$('#update-now').on('click', function() {
				// Get the form element
				var form = $('#update-student-form')[0];
				$('#update-student-form')[0].reportValidity();

				// Check form validity
				if (form.checkValidity()) {
					// Serialize the form data
					var formAction = $('#update-student-form').attr('action');
					var formData = new FormData($('#update-student-form')[0]);

					// Perform AJAX request
					$.ajax({
						url: formAction,
						type: 'POST',
						data: formData, // Form data
						dataType: 'json',
						contentType: false,
						processData: false,
						success: function(response) {
							showAlert(response.message, response.success ? 'success' : 'red', 'alert-container-update-form');
							if (response.success) {
								$('#editStudentModal').modal('hide');
								setTimeout(function() {
									location.reload();
								}, 1000);
							}
						},
						error: function(error) {
							// Handle the error
							console.error('Error submitting the form:', error);
						},
						complete: function(response) {
							// This will be executed regardless of success or error
							console.log('Request complete:', response);
						}
					});
				} else {
					var message = ('Form is not valid. Please check your inputs.');
					showAlert(message, 'red');
				}
			});


			async function getStudentById(id) {
				var formAction = $('#update-student-form').attr('action');

				// Perform AJAX request
				$.ajax({
					url: formAction,
					type: 'GET',
					data: {
						student_id: id,
						action: 'get_student'
					}, // Form data
					dataType: 'json',
					success: function(response) {
						showAlert(response.message, response.success ? 'primary' : 'danger');
						if (response.success) {
							var student_id = response.data.id;
							var Photo = response.data.Photo;
							var FullName = response.data.FullName;
							var EmailId = response.data.EmailId;
							var MobileNumber = response.data.MobileNumber;
							var Status = response.data.Status;

							$('#editStudentModal #student_id').val(student_id);
							$('#editStudentModal #Photo').val(Photo);
							$('#editStudentModal #FullName').val(FullName);
							$('#editStudentModal #EmailId').val(EmailId);
							$('#editStudentModal #MobileNumber').val(MobileNumber);
							$('#editStudentModal #Status option[value="' + Status + '"]').prop('selected', true);
							$('#editStudentModal').modal('show');
						}
					},
					error: function(error) {
						// Handle the error
						console.error('Error submitting the form:', error);
					},
					complete: function(response) {
						// This will be executed regardless of success or error
						console.log('Request complete:', response);
					}
				});
			}

		});
		async function deleteById(id) {
			var formAction = $('#update-student-form').attr('action');

			// Perform AJAX request
			$.ajax({
				url: formAction,
				type: 'GET',
				data: {
					student_id: id,
					action: 'delete_student'
				}, // Form data
				dataType: 'json',
				success: function(response) {
					if (response.success) {
						setTimeout(function() {
							location.reload();
						}, 1000);
					}
				},
				error: function(error) {
					// Handle the error
					console.error('Error submitting the form:', error);
				},
				complete: function(response) {
					// This will be executed regardless of success or error
					console.log('Request complete:', response);
				}
			});
		}

		// To create search bar


		$("#searchInput").on("input", function() {
			var searchTerm = $(this).val().toLowerCase();

			// Loop through each row in the table body
			$("tbody tr").filter(function() {
				// Toggle the visibility based on the search term
				$(this).toggle($(this).text().toLowerCase().indexOf(searchTerm) > -1);
			});
		});
	</script>