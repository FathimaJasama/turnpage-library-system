<?php
require_once('../layouts/Header.php');
require_once __DIR__ . '/../../models/Student.php';

$sm = AppManager::getSM();
$student_id = $sm->getAttribute("studentId");
echo "$student_id";
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
        <section class="content m-3">
            <div class="container-fluid">
                <div class="card">
                    <form id="update-student-form" action="<?= url('services/ajax_functions.php') ?>" autocomplete="off" enctype="multipart/form-data">
                        <input type="hidden" name="action" value="update_student">
                        <input type="hidden" name="id" id="student_id">
                        <div class="mb-3">
                            <label for="StudentId" class="form-label">Student ID</label>
                            <input type="text" id="StudentId" name="StudentId" class="form-control" placeholder="Enter Name" required />
                        </div>
                        <div class="mb-3">
                            <label for="Photo" class="form-label">Photo</label>
                            <input class="form-control" name="Photo" id="editPhoto" type="file" accept="image/*">
                        </div>
                        <div class="mb-3">
                            <label for="FullName" class="form-label">Full Name</label>
                            <input type="text" id="FullName" name="FullName" class="form-control"  required />
                        </div>
                        <div class="mb-3">
                            <label for="EmailId" class="form-label">Email</label>
                            <input type="email" id="EmailId" name="EmailId" class="form-control" placeholder="xxxx@xxx.xx" required />
                        </div>
                        <div class="mb-3">
                            <label for="MobileNumber" class="form-label">Mobile Number</label>
                            <input type="tel" id="MobileNumber" name="MobileNumber" class="form-control" placeholder="123-456-7890" required />
                        </div>
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
                        <div class="mb-3">
                            <div id="alert-container-update-form"></div>
                        </div>
                        
                        <div class="mb-3">
                            <button type="button" id="edit-profile" data-id="<?= $student_id ?>" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
</div>

<?php
require_once('../layouts/Footer.php');
?>

<script>
$(document).ready(async function() {
    var student_id = <?php echo json_encode($student_id); ?>;
    await getStudentById(student_id);
});

async function getStudentById(student_id) {
    var formAction = $('#update-student-form').attr('action');

    // Perform AJAX request
    $.ajax({
        url: formAction,
        type: 'GET',
        data: {
            student_id: student_id,
            action: 'get_student'
        }, // Form data
        dataType: 'json',
        success: function(response) {
            showAlert(response.message, response.success ? 'light' : 'danger');
            if (response.success) {
                var studentData = response.data;
                populateForm(studentData);
            }
        },
        error: function(error) {
            // Handle the error
            console.error('Error fetching student data:', error);
        }
    });
}

function populateForm(studentData) {
    $('#StudentId').val(studentData.StudentId);
    // Note: You cannot set the value of a file input programmatically for security reasons
    $('#FullName').val(studentData.FullName);
    $('#EmailId').val(studentData.EmailId);
    $('#MobileNumber').val(studentData.MobileNumber);
}

$('#edit-profile').on('click', function() {
    var form = $('#update-student-form')[0];
    $('#update-student-form')[0].reportValidity();

    if (form.checkValidity()) {
        var formData = new FormData($('#update-student-form')[0]);
        var formAction = $('#update-student-form').attr('action');

        $.ajax({
            url: formAction,
            type: 'POST',
            data: formData,
            dataType: 'json',
            contentType: false,
            processData: false,
            success: function(response) {
                showAlert(response.message, response.success ? 'green' : 'danger', 'alert-container-edit-profile');
                if (response.success) {
                    setTimeout(function() {
                        location.reload();
                    }, 1000);
                }
            },
            error: function(error) {
                console.error('Error submitting the form:', error);
            },
            complete: function(response) {
                console.log('Request complete:', response);
            }
        });
    } else {
        var message = ('Form is not valid. Please check your inputs. ');
        showAlert(message, 'danger');
    }
});

//preview user image after uploaded
function previewImage(event) {
    const reader = new FileReader();
    reader.onload = function() {
        const element = document.getElementById('previewImage');
        element.src = reader.result;
    }
    reader.onerror = function() {
        const element = document.getElementById('errorMsg');
        element.value = "Couldn't load the image.";
    }
    reader.readAsDataURL(event.target.files[0]);
}

const input = document.getElementById('usr_image');
input.addEventListener('change', (event) => {
    previewImage(event)
});

</script>
