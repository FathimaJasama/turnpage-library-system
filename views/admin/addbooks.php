<?php
include("../layouts/Header.php");
require_once __DIR__ . '/../../models/Booktable.php';

$bookModel = new Book();
$books = $bookModel->getAll();

$currentUrl = $_SERVER['SCRIPT_NAME'];

// Extract the last filename from the URL
$currentFilename = basename($currentUrl);  // e.g., "dashboard.php"
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
			<h5>Add Books</h5>
			</div>
		</div>
				
	</div>
	<!-- Main header ends -->

	<!-- Content wrapper start -->
	<div class="content-wrapper">
		<div class="subscribe-header">
			<img src="<?=asset('assets/images/libbg1.PNG')?>" class="img-fluid w-100" alt="Header" />
		</div>
		<div class="row justify-content-center mt-4">
			<div class="col-lg-12">
				<div class="card">
					<div class="card-header">
						<div class="card-title">
						</div>
   				<div class="modal-dialog" role="document">
        			<div class="modal-content">
           				<form id="create-book-form" action="<?= url('services/ajax_functions.php') ?>" enctype="multipart/form-data">
                			<input type="hidden" name="action" value="create_book">
								<div class="row gx-3">
									<div class="col-xxl-12">
										<div class="form-section-title p-3 mt-4 mb-3 fw-bold">
                        				Book Information						
                        				</div>
									</div>
								<div class="modal-body">
                                     <div class="row">
                                        <div class="col mb-3">
                                            <label for="StudentId" class="form-label">Student ID</label>
                                             <input type="text" id="StudentId" name="StudentId" class="form-control" placeholder="Student ID" required />
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col mb-3">
                                        <label for="BookName" class="form-label">Book Name</label>
                                        <input type="text" id="BookName" name="BookName" class="form-control" placeholder="Book Name" required />
                                    </div>
                                </div>
                                <div class="row">
                        <div class="col mb-3">
                            <label for="AuthorName" class="form-label">Author Name</label>
                            <input type="text" id="AuthorName" name="AuthorName" class="form-control" placeholder="Enter Author's Name" required />
                        </div>
                    </div>
                    <div class="row g-1">
                        <div class="col mb-0">
                            <label for="ISBNNumber" class="form-label">ISBNNumber</label>
                            <input type="number" id="ISBNNumber" name="ISBNNumber" class="form-control" placeholder="1234567890" required />
                        </div>
                    </div>
                    <div class="row g-1">
                        <div class="col mb-0">
                            <label for="BookPrice" class="form-label">Book Price</label>
                            <input type="text" id="BookPrice" name="BookPrice" class="form-control" placeholder="USD" required />
                        </div>
                    </div>
                    <div class="col-12 mb-3">
                    <label for="bookImage" class="form-label">Book Image</label>
                    <input class="form-control" name="bookImage" id="bookImage" type="file" accept="image/*">
                    </div>
                    <div class="row g-1">
                        <div class="col mb-0">
                            <label for="category" class="form-label">Category</label>
                            <input type="text" id="category" name="category" class="form-control" placeholder="Category Name" required />
                        </div>
                    </div>
                    <div id="additional-fields"></div>
                    <div class="mb-3 mt-3">
                        <div id="alert-container"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                    <button type="button" id="create-now" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
												
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

<script>
    $(document).ready(function() {
        $('#create-now').on('click', function() {
            // Get the form element
            var form = $('#create-book-form')[0];
            $('#create-book-form')[0].reportValidity();

            // Check form validity
            if (form.checkValidity()) {
                // Create a FormData object
                var formData = new FormData($('#create-book-form')[0]);

                // Perform AJAX request
                $.ajax({
                    url: $('#create-book-form').attr('action'),
                    type: 'POST',
                    data: formData,
                    contentType: false, // Don't set content type
                    processData: false, // Don't process the data
                    dataType: 'json',
                    success: function(response) {
                        showAlert(response.message, response.success ? 'green' : 'red');
                        if (response.success) {
                            $('#createBookModal').modal('hide');
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
                showAlert(message, 'light');
            }
        });

        
        });
</script>		