<?php
require_once('../layouts/Header.php');
require_once __DIR__ . '/../../models/Student.php';

$authorModel = new Author();
$students = $studentModel->getAll();

?>
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

<div class="content-wrapper">
	<div class="subscribe-header">   
   
                <!-- /.card-body -->
            




<!-- <div class="modal fade " id="editStudentModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content"> -->
            <form id="update-student-form" action="<?= url('services/ajax_functions.php') ?>" autocomplete="off" enctype="multipart/form-data">
                <input type="hidden" name="action" value="update_student">
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
                        <div class="col mb-0 form-password-toggle">
                            <label class="form-label" for="Password">Password</label>
                            <div class="input-group">
                                <input type="password" name="Password" class="form-control" id="Password" placeholder="············" aria-describedby="basic-default-password2" required>
                                <span id="basic-default-password2" class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                            </div>
                        </div>
                        <div class="col mb-0 form-password-toggle">
                            <label class="form-label" for="basic-default-password12">Confirm Password</label>
                            <div class="input-group">
                                <input type="password" name="confirm_password" class="form-control" id="basic-default-password12" placeholder="············" aria-describedby="basic-default-password2" required>
                                <span id="basic-default-password2" class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                            </div>
                        </div>
                        <div class="row g-1">
                        <div class="col mb-0">
                            <label for="MobileNumber" class="form-label">Mobile Number</label>
                            <input type="tel" id="MobileNumber" name="MobileNumber" class="form-control" placeholder="123-456-7890" required />
                        </div>
                    </div>
                  
                    <div class="row mt-3">
                        <div class="col mb-0">
                            <label class="form-label" for="Status">Status</label>
                            <div class="input-group">
                                <select class="form-select" id="Status" name="Status" required>
                                    <option selected="" value="">Choose...</option>
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
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
$('#create-now').on('click', function() {
    // Get the form element
    var form = $('#create-student-form')[0];
    $('#create-student-form')[0].reportValidity();

    // Check form validity
    if (form.checkValidity()) {
        // Create a FormData object
        var formData = new FormData($('#create-student-form')[0]);

        // Perform AJAX request
        $.ajax({
            url: $('#create-student-form').attr('action'),
            type: 'POST',
            data: formData,
            contentType: false, // Don't set content type
            processData: false, // Don't process the data
            dataType: 'json',
            success: function(response) {
                showAlert(response.message, response.success ? 'green' : 'red');
                if (response.success) {
                    $('#createStudentModal').modal('hide');
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

    

</script>