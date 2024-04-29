<?php
include("../layouts/Header.php");
require_once __DIR__ . '/../../models/Student.php';

$studentModel = new Student();
$students = $studentModel->getAll();
$sm = AppManager::getSM();
$Photo = $sm->getAttribute("Photo");
$FullName = $sm->getAttribute("FullName");
$student_id = $sm->getAttribute("studentId");
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
												<img src="<?= asset('default_avatar.jpg') ?>" alt="default-avatar" width="80" id="defaultAvatar">
											<?php
											}
											?>
										</div>
										<div class="col">
											<!-- <h6 class="text-primary">Student</h6> -->
										</div>
										<div class="card-body">
											<!-- <h7 class="d-flex align-items-center mb-3"> -->
												<!-- <span> -->
													<h5><?= $student['FullName'] ?? ""; ?> </h5>
												<!-- </span> -->
											<!-- </h7> -->
												<!-- <span> -->
													
													<h5></h5><span class="text-primary"><?= $student['EmailId'] ?? ""; ?></span>
											<!-- </h6> -->
											<!-- <h6 class="d-flex align-items-center mb-3"> -->
												<br>
												<span class="text"><?= $student['MobileNumber'] ?? ""; ?></span>
											<!-- </h6> -->
										</div>
									</div>
									<div class="col-sm-6 col-12">
											<div class="form-group">
												<label for="fullName">Full Name</label>
												<input type="text" class="form-control" id="fullName" placeholder="Enter full name">
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
												<label for="website">Website URL</label>
												<input type="url" class="form-control" id="website" placeholder="Website url">
											</div>
										</div>
									</div>
									
									</div>
									<div class="row gutters">
										<div class="col-sm-12">
											<div class="text-right">
												<button type="button" id="submit" name="submit" class="btn btn-secondary">Cancel</button>
												<button type="button" id="submit" name="submit" class="btn btn-primary">Update</button>
											</div>
										</div>
									<!-- Row end -->
								</div>
							</div>
						</div>
					</div>


				</div>

		</div>
		<!-- <div class="row">
			<div class="col-xxl-3 col-sm-6 col-12 order-xxl-1 order-xl-2 order-lg-2 order-md-2 order-sm-2">
				<div class="card mb-4">
					<div class="card-header">
						<h5 class="card-title">About</h5>
					</div> -->

					<!-- <?php
					// Find the user's data in the $students array
					$currentUser = null;
					foreach ($students as $key => $c) {
						if ($c['id'] == $student_id) {
							$currentUser = $c;
							break;
						}
					} ?> -->

					<!-- <div class="card-body">
						<h6 class="d-flex align-items-center mb-3">
							<i class="bi bi-file-person-fill fs-2 me-2"></i>
							<span> <?= $c['FullName'] ?? ""; ?> </span>
						</h6>
						<h6 class="d-flex align-items-center mb-3">
							<i class="bi bi-envelope fs-2 me-2"></i> <br>
							<span class="text-primary"><?= $c['EmailId'] ?? ""; ?></span>
						</h6>
						<h6 class="d-flex align-items-center mb-3">
							<i class="bi bi-file-spreadsheet fs-2 me-2"></i>
							<span class="text-primary"><?= $c['MobileNumber'] ?? ""; ?></span>
						</h6>
					</div> -->
					<!-- <div class="col-lg-9 col-sm-12 col-12"> -->
							<!-- <div class="card h-100">
								<div class="card-body"> -->
									<!-- <div class="row gutters">
										<div class="col-sm-12">
											<h6 class="mb-2 text-primary">Personal Details</h6>
										</div> -->
										<!-- <div class="col-sm-6 col-12">
											<div class="form-group">
												<label for="fullName">Full Name</label>
												<input type="text" class="form-control" id="fullName" placeholder="Enter full name">
											</div>
										</div> -->
										<!-- <div class="col-sm-6 col-12">
											<div class="form-group">
												<label for="eMail">Email</label>
												<input type="email" class="form-control" id="eMail" placeholder="Enter email ID">
											</div>
										</div> -->
										<!-- <div class="col-sm-6 col-12">
											<div class="form-group">
												<label for="phone">Phone</label>
												<input type="text" class="form-control" id="phone" placeholder="Enter phone number">
											</div>
										</div> -->
										<!-- <div class="col-sm-6 col-12">
											<div class="form-group">
												<label for="website">Website URL</label>
												<input type="url" class="form-control" id="website" placeholder="Website url">
											</div>
										</div> -->
									<!-- </div> -->
									<!-- <div class="row gutters">
										<div class="col-sm-12">
											<h6 class="mt-3 mb-2 text-primary">Address</h6>
										</div>
										<div class="col-sm-6 col-12">
											<div class="form-group">
												<label for="Street">Street</label>
												<input type="name" class="form-control" id="Street" placeholder="Enter Street">
											</div>
										</div> -->
										<!-- <div class="col-sm-6 col-12">
											<div class="form-group">
												<label for="ciTy">City</label>
												<input type="name" class="form-control" id="ciTy" placeholder="Enter City">
											</div>
										</div>
										<div class="col-sm-6 col-12">
											<div class="form-group">
												<label for="sTate">State</label>
												<input type="text" class="form-control" id="sTate" placeholder="Enter State">
											</div>
										</div>
										<div class="col-sm-6 col-12">
											<div class="form-group">
												<label for="zIp">Zip Code</label>
												<input type="text" class="form-control" id="zIp" placeholder="Zip Code">
											</div>
										</div> -->
									<!-- </div> -->
									<!-- <div class="row gutters">
										<div class="col-sm-12">
											<div class="text-right">
												<button type="button" id="submit" name="submit" class="btn btn-secondary">Cancel</button>
												<button type="button" id="submit" name="submit" class="btn btn-primary">Update</button>
											</div>
										</div>
									</div> -->
								<!-- </div>
							</div> -->
						<!-- </div> -->
					</div>
					<div>
						<button class="btn btn-sm btn-primary m-2 edit-student" data-id="<?= $c['id']; ?>">Edit</button>
					</div>
				</div>
			</div>

			<!-- /.card-body -->
		</div>
	</div>
	</section>
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
					<div class="row">
						<div class="col mb-3">
							<label for="StudentId" class="form-label">Student ID</label>
							<input type="text" id="StudentId" name="StudentId" class="form-control" placeholder="Enter Name" required />
						</div>
					</div>
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

		// Handle modal button click
		// $('#create-now').on('click', function() {
		//     // Get the form element
		//     var form = $('#create-student-form')[0];
		//     $('#create-student-form')[0].reportValidity();

		//     // Check form validity
		//     if (form.checkValidity()) {
		//         // Create a FormData object
		//         var formData = new FormData($('#create-student-form')[0]);

		//         // Perform AJAX request
		//         $.ajax({
		//             url: $('#create-student-form').attr('action'),
		//             type: 'POST',
		//             data: formData,
		//             contentType: false, // Don't set content type
		//             processData: false, // Don't process the data
		//             dataType: 'json',
		//             success: function(response) {
		//                 showAlert(response.message, response.success ? 'green' : 'red');
		//                 if (response.success) {
		//                     $('#createStudentModal').modal('hide');
		//                     setTimeout(function() {
		//                         location.reload();
		//                     }, 1000);
		//                 }
		//             },
		//             error: function(error) {
		//                 // Handle the error
		//                 console.error('Error submitting the form:', error);
		//             },
		//             complete: function(response) {
		//                 // This will be executed regardless of success or error
		//                 console.log('Request complete:', response);
		//             }
		//         });
		//     } else {
		//         var message = ('Form is not valid. Please check your inputs.');
		//         showAlert(message, 'red');
		//     }
		// });

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
						var StudentId = response.data.StudentId;
						var Photo = response.data.Photo;
						var FullName = response.data.FullName;
						var EmailId = response.data.EmailId;
						var MobileNumber = response.data.MobileNumber;
						var Status = response.data.Status;

						$('#editStudentModal #student_id').val(student_id);
						$('#editStudentModal #StudentId').val(StudentId);
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