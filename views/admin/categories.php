<?php
require_once('../layouts/Header.php');
require_once __DIR__ . '/../../models/Category.php';

$categoryModel = new Category();
$categories = $categoryModel->getAll();

?>
<div class="content-wrapper-scroll">

<!-- Main header starts -->
<div class="main-header d-flex align-items-center justify-content-between position-relative">
    <div class="d-flex align-items-center justify-content-center">
        <div class="page-icon">
            <i class="bi bi-grid"></i>
        </div>
        <div class="page-title d-none d-md-block">
            <h5>Category</h5>
        </div>
    </div>

</div>

<div class="content-wrapper">
	<div class="subscribe-header">   
   
    <section class="content m-3">
        
        <div class="container-fluid">
            
            <div class="card">
                
                <!-- /.card-header -->
                <div class="card-body p-0">
                    <div class="d-flex align-items-center m-3">
                    <i class="bi bi-search"></i>
                        <input type="text" id="searchInput" class="form-control border-0 shadow-none" placeholder="Search" aria-label="Search..." />
                    </div>
                </div>
                 <table class="table table-striped">
                        <thead>
                            <tr>
                                <th style="width: 10px">#</th>
                                <th class="">Category</th>
                                <th class="">Status</th>
                                <th class="">Created_at</th>
                                <th class="">Updated_at</th>

                         
                                <!-- <th style="width: 200px">Options</th> -->
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($categories as $key => $c) {
                            ?>
                                <tr>
                                    <td><?= ++$key ?></td>
                                    <td><?= $c['CategoryName'] ?? "";?></td>    
                                    <td>
                                        <div class="">
                                            <?php if ($c['Status'] == 1) { ?>
                                                <span class="badge shade-green">Enable</span>
                                            <?php } else { ?>
                                                <span class="badge bg-danger">Disable</span>
                                            <?php } ?>
                                        </div>
                                    </td>                                    <td> <?= $c['CreationDate'] ?? ""; ?> </td>
                                    <td> <?= $c['UpdationDate'] ?? ""; ?></td>
                                    
                                        </div>
                                    </td>
                                    
                                    <td>
                                        <div>
                                            <button class="btn btn-sm btn-info m-2 edit-category" data-id="<?= $c['id']; ?>">Edit</button>
                                            <button class="btn btn-sm btn-danger m-2 delete-category" data-id="<?= $c['id']; ?>">Delete</button>

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



<!-- Update Student Modal -->

<div class="modal fade " id="editCategoryModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="update-category-form" action="<?= url('services/ajax_functions.php') ?>" autocomplete="off" enctype="multipart/form-data">
                <input type="hidden" name="action" value="update_category">
                <input type="hidden" name="id" id="category_id">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel1">Edit Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-3">
                            <label for="CategoryName" class="form-label">Category</label>
                            <input type="text" id="CategoryName" name="CategoryName" class="form-control" placeholder="Enter Name" required />
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
    var form = $('#create-category-form')[0];
    $('#create-category-form')[0].reportValidity();

    // Check form validity
    if (form.checkValidity()) {
        // Create a FormData object
        var formData = new FormData($('#create-category-form')[0]);

        // Perform AJAX request
        $.ajax({
            url: $('#create-category-form').attr('action'),
            type: 'POST',
            data: formData,
            contentType: false, // Don't set content type
            processData: false, // Don't process the data
            dataType: 'json',
            success: function(response) {
                showAlert(response.message, response.success ? 'green' : 'danger');
                if (response.success) {
                    $('#createCategoryModal').modal('hide');
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

$('.edit-category').on('click', async function() {
    var student_id = $(this).data('id');
    await getCategoryById(category_id);
})

$('.delete-category').on('click', async function() {
            var category_id = $(this).data('id');
            var is_confirm = confirm('Are you sure,Do you want to delete?');
            if (is_confirm) await deleteById(category_id);
        })


        
// update category form
// handle update modal button click
$('#update-now').on('click', function() {
    // Get the form element
    var form = $('#update-category-form')[0];
    $('#update-category-form')[0].reportValidity();

    // Check form validity
    if (form.checkValidity()) {
        // Serialize the form data
        var formAction = $('#update-category-form').attr('action');
        var formData = new FormData($('#update-category-form')[0]);

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
                    $('#editCategoryModal').modal('hide');
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

// To create search bar
$("#searchInput").on("input", function() {
            var searchTerm = $(this).val().toLowerCase();

            // Loop through each row in the table body
            $("tbody tr").filter(function() {
                // Toggle the visibility based on the search term
                $(this).toggle($(this).text().toLowerCase().indexOf(searchTerm) > -1);
            });
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
        var formAction = $('#update-category-form').attr('action');

        // Perform AJAX request
        $.ajax({
            url: formAction,
            type: 'GET',
            data: {
                category_id: id,
                action: 'delete_category'
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