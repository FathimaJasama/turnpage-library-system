<?php
require_once('../layouts/Header.php');
require_once __DIR__ . '/../../models/Student.php';

$studentModel = new Student();
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
            <h5>Students Details</h5>
        </div>
    </div>

</div>
<!-- Main header ends -->

<!-- Content wrapper start -->




        <!-- Button trigger modal -->
       
   
    <section class="content m-3">
        
        <div class="container-fluid">
            
            <div class="card">
                
                <!-- /.card-header -->
                <div class="card-body p-0">
                <button type="button" class="btn btn-primary float-end m-3" data-bs-toggle="modal" data-bs-target="#createStudentModal">
            Create User
        </button>
                 <table class="table table-striped">
                        <thead>
                            <tr>
                                <th style="width: 10px">#</th>
                                <th style="">Student ID</th>
                                <th class="">Full Name</th>
                                <th class="">Email</th>
                                <th class="">Mobile No.</th>
                                <th class="">Status</th>
                                <th class="">Reg.Date</th>
                                <th class="">Updated Date</th>
                                <!-- <th style="width: 200px">Options</th> -->
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($students as $key => $c) {
                            ?>
                                <tr>
                                    <td><?= ++$key ?></td>
                                    <td><?= $c['StudentId'] ?? "";?></td>
                                    <td> <?= $c['FullName'] ?? ""; ?> </td>
                                    <td> <?= $c['EmailId'] ?? ""; ?> </td>
                                    <td> <?= $c['MobileNumber'] ?? ""; ?></td>
                                    <td>
                                        <div class="">
                                            <?php if ($c['Status'] == 1) { ?>
                                                <span class="badge shade-green">Enable</span>
                                            <?php } else { ?>
                                                <span class="badge bg-danger">Disable</span>
                                            <?php } ?>
                                        </div>
                                    </td>
                                        </div>
                                    </td>
                                    <td> <?= $c['created_at'] ?? ""; ?></td>
                                    <td> <?= $c['updated_at'] ?? ""; ?></td>
                                    <td>
                                        <div>
                                            <button class="btn btn-sm btn-info m-2 edit-student" data-id="<?= $c['id']; ?>">Edit</button>
                                            <button class="btn btn-sm btn-danger m-2 delete-student" data-id="<?= $c['id']; ?>">Delete</button>

                                        </div>
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </section>
</div>

<!-- Modal -->
<div class="modal fade " id="createStudentModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="create-student-form" action="<?= url('services/ajax_functions.php') ?>" enctype="multipart/form-data">
                <input type="hidden" name="action" value="create_student">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel1">Create Student</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-3">
                            <label for="studentname" class="form-label">Student Name</label>
                            <input type="text" id="studentname" name="studentname" class="form-control" placeholder="Enter Name" required />
                        </div>
                    </div>
                    <div class="row g-1">
                        <div class="col mb-0">
                            <label for="Email" class="form-label">Email</label>
                            <input type="email" id="Email" name="Email" class="form-control" placeholder="xxxx@xxx.xx" required />
                        </div>
                    </div>
                    <div class="row g-2 mt-2">
                        <div class="col mb-0 form-password-toggle">
                            <label class="form-label" for="password">Password</label>
                            <div class="input-group">
                                <input type="password" name="Password" class="form-control" id="Password" placeholder="············" aria-describedby="basic-default-password2" required>
                                <span id="basic-default-Password2" class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                            </div>
                        </div>
                        <div class="col mb-0 form-password-toggle">
                            <label class="form-label" for="basic-default-password12">Confirm Password</label>
                            <div class="input-group">
                                <input type="password" name="confirm_password" class="form-control" id="basic-default-password12" placeholder="············" aria-describedby="basic-default-password2" required>
                                <span id="basic-default-password2" class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="row g-1">
                        <div class="col mb-0">
                            <label for="MobileNumber" class="form-label">Mobile Number</label>
                            <input type="tel" id="MobileNumber" name="MobileNumber" class="form-control" placeholder="123-456-7890" required />
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

<!-- Update User Modal -->
<div class="modal fade " id="editUserModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="update-user-form" action="<?= url('services/ajax_functions.php') ?>" autocomplete="off" enctype="multipart/form-data">
                <input type="hidden" name="action" value="update_user">
                <input type="hidden" name="id" id="user_id">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel1">Edit User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-3">
                            <label for="username" class="form-label">User Name</label>
                            <input type="text" id="username" name="username" class="form-control" placeholder="Enter Name" required />
                        </div>
                    </div>
                    <div class="row g-1">
                        <div class="col mb-0">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" id="email" name="email" class="form-control" placeholder="xxxx@xxx.xx" required />
                        </div>

                    </div>
                    <div class="row g-2 mt-2">
                        <div class="col mb-0 form-password-toggle">
                            <label class="form-label" for="password">Password</label>
                            <div class="input-group">
                                <input type="password" name="password" class="form-control" id="password" placeholder="············" aria-describedby="basic-default-password2" required>
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
                    </div>
                    <div class="row mt-3">
                        <div class="col mb-0">
                            <label class="form-label" for="permission">Permission</label>
                            <div class="input-group">
                                <label class="input-group-text" for="inputGroupSelect01">Options</label>
                                <select class="form-select" id="edit_permission" name="permission" required>
                                    <option selected="" value="">Choose...</option>
                                    <option value="operator">Operator</option>
                                    <option value="doctor">Doctor</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col mb-0">
                            <label class="form-label" for="is_active">Status</label>
                            <div class="input-group">
                                <select class="form-select" id="is_active" name="is_active" required>
                                    <option selected="" value="">Choose...</option>
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div id="edit-additional-fields"></div>
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
        //     var form = $('#create-user-form')[0];
        //     $('#create-user-form')[0].reportValidity();

        //     // Check form validity
        //     if (form.checkValidity()) {
        //         // Serialize the form data
        //         var formData = $('#create-user-form').serialize();
        //         var formAction = $('#create-user-form').attr('action');

        //         // Perform AJAX request
        //         $.ajax({
        //             url: formAction,
        //             type: 'POST',
        //             data: formData, // Form data
        //             dataType: 'json',
        //             success: function(response) {
        //                 showAlert(response.message, response.success ? 'primary' : 'danger');
        //                 if (response.success) {
        //                     $('#createUserModal').modal('hide');
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
        //         showAlert(message, 'danger');
        //     }
        // });

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
                showAlert(message, 'danger');
            }
        });


        $('.edit-user').on('click', async function() {
            var user_id = $(this).data('id');
            await getUserById(user_id);
        })

        $('.delete-user').on('click', async function() {
            var user_id = $(this).data('id');
            var is_confirm = confirm('Are you sure,Do you want to delete?');
            if (is_confirm) await deleteById(user_id);
        })

        $('#update-now').on('click', function() {

            // Get the form element
            var form = $('#update-user-form')[0];
            $('#update-user-form')[0].reportValidity();

            // Check form validity
            if (form.checkValidity()) {
                // Serialize the form data
                var formAction = $('#update-user-form').attr('action');
                var formData = new FormData($('#update-user-form')[0]);

                // Perform AJAX request
                $.ajax({
                    url: formAction,
                    type: 'POST',
                    data: formData, // Form data
                    dataType: 'json',
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        showAlert(response.message, response.success ? 'primary' : 'danger', 'alert-container-update-form');
                        if (response.success) {
                            $('#editUserModal').modal('hide');
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
                showAlert(message, 'danger');
            }
        });

        $('#permission').change(function() {
            var permission = $(this).val();
            if (permission === 'doctor') {
                $('#additional-fields').html(
                    '<div class="row mt-2">' +
                    '<div class="col-12 mb-3">' +
                    '<label for="name" class="form-label">Doctor Name</label>' +
                    '<input type="text" id="name" name="doctor_name" class="form-control" placeholder="Enter Name" required />' +
                    '</div>' +
                    '<div class="col-12 mb-3">' +
                    '<label for="about" class="form-label">About Doctor</label>' +
                    '<textarea id="about" name="about_doctor" class="form-control" placeholder="Enter About" required></textarea>' +
                    '</div>' +
                    '<div class="col-12 mb-3">' +
                    '<label for="formFile" class="form-label">Doctor Photo</label>' +
                    '<input class="form-control" name="image" id="image" type="file" accept="image/*">' +
                    '</div>' +
                    '</div>'
                );
            } else {
                $('#additional-fields').empty();
            }
        });

        // Trigger change event on page load if doctor permission is selected by default
        if ($('#permission, #edit_permission').val() === 'doctor') {
            $('#permission, #edit_permission').trigger('change');
        }

        $('#edit_permission').change(function() {
            var permission = $(this).val();
            if (permission === 'doctor') {
                $('#edit-additional-fields').html(
                    '<div class="row mt-2">' +
                    '<div class="col-12 mb-3">' +
                    '<label for="name" class="form-label">Doctor Name</label>' +
                    '<input type="text" id="edit_name" name="doctor_name" class="form-control" placeholder="Enter Name" required />' +
                    '</div>' +
                    '<div class="col-12 mb-3">' +
                    '<label for="about" class="form-label">About Doctor</label>' +
                    '<textarea id="edit_about" name="about_doctor" class="form-control" placeholder="Enter About" required></textarea>' +
                    '</div>' +
                    '<div class="col-12 mb-3">' +
                    '<label for="formFile" class="form-label">Doctor Photo</label>' +
                    '<input class="form-control" name="image" id="edit_image" type="file" accept="image/*">' +
                    '</div>' +
                    '</div>'
                );
            } else {
                $('#edit-additional-fields').empty();
            }
        });
    });

    async function getUserById(id) {
        var formAction = $('#update-user-form').attr('action');

        // Perform AJAX request
        $.ajax({
            url: formAction,
            type: 'GET',
            data: {
                user_id: id,
                action: 'get_user'
            }, // Form data
            dataType: 'json',
            success: function(response) {
                showAlert(response.message, response.success ? 'primary' : 'danger');
                if (response.success) {
                    var user_id = response.data.id;
                    var username = response.data.username;
                    var email = response.data.email;
                    var permission = response.data.permission;
                    var is_active = response.data.is_active;

                    $('#editUserModal #user_id').val(user_id);
                    $('#editUserModal #username').val(username);
                    $('#editUserModal #email').val(email);
                    $('#editUserModal #permission option[value="' + permission + '"]').prop('selected', true);
                    $('#editUserModal #is_active option[value="' + is_active + '"]').prop('selected', true);
                    $('#editUserModal').modal('show');
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

    async function deleteById(id) {
        var formAction = $('#update-user-form').attr('action');

        // Perform AJAX request
        $.ajax({
            url: formAction,
            type: 'GET',
            data: {
                user_id: id,
                action: 'delete_user'
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