<?php
require_once('../layouts/Header.php');
require_once __DIR__ . '/../../models/Booktable.php';

$bookModel = new Book();
$books = $bookModel->getAll();

?>
<div class="content-wrapper-scroll">

<!-- Main header starts -->
<div class="main-header d-flex align-items-center justify-content-between position-relative">
    <div class="d-flex align-items-center justify-content-center">
        <div class="page-icon">
            <i class="bi bi-file-person-fill"></i>
        </div>
        <div class="page-title d-none d-md-block">
            <h5>Book Table</h5>
        </div>
    </div>

</div>
<!-- Main header ends -->

<div class="content-wrapper">
						<div class="subscribe-header">
    <section class="content m-3">
        
        <div class="container-fluid">
            
            <div class="card">
                
                <!-- /.card-header -->
                <div class="card-body p-0">
                <button type="button" class="btn btn-primary float-end m-3" data-bs-toggle="modal" data-bs-target="#createBookModal">
            Add Books
        </button>
                 <table class="table table-striped">
                        <thead>
                            <tr>
                                <th style="width: 10px">#</th>
                                <th style="">StudentId</th>
                                <th class="">BookName</th>
                                <th class="">AuthorName</th>
                                <th class="">ISBNNumber</th>
                                <th class="">BookPrice</th>
                                <th class="">BookImage</th>
                                <th class="">Status</th>
                                <th class="">category</th>
                                <th class="">Reg.Date</th>
                                <th class="">Updated Date</th>
                                <!-- <th style="width: 200px">Options</th> -->
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($books as $key => $c) {
                            ?>
                                <tr>
                                    <td><?= ++$key ?></td>
                                    <td><?= $c['StudentId'] ?? "";?></td>
                                    <td> <?= $c['BookName'] ?? ""; ?> </td>
                                    <td> <?= $c['AuthorName'] ?? ""; ?> </td>
                                    <td> <?= $c['ISBNNumber'] ?? ""; ?> </td>
                                    <td> <?= $c['BookPrice'] ?? ""; ?> </td>
                                    <td><img src="<?=asset("services/uploads/" .$c['bookImage']) ?? ""?>" class="rounded" width="100" alt="Google Admin" />
                                    </td>
                                    <td>
                                        <div class="">
                                            <?php if ($c['isIssued'] == 1) { ?>
                                                <span class="badge shade-red">Yes</span>
                                            <?php } else { ?>
                                                <span class="badge bg-success">No</span>
                                            <?php } ?>
                                        </div>
                                    </td>
                                        </div>
                                    </td>
                                    <td> <?= $c['category'] ?? ""; ?></td>
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
<div class="modal fade " id="createBookModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="create-book-form" action="<?= url('services/ajax_functions.php') ?>" enctype="multipart/form-data">
                <input type="hidden" name="action" value="create_book">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel1">Create Books</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                <div class="row">
                        <div class="col mb-3">
                            <label for="StudentId" class="form-label">Student ID</label>
                            <input type="text" id="StudentId" name="StudentId" class="form-control" placeholder="Book Name" required />
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
                showAlert(message, 'danger');
            }
        });

        
        });
    

    

</script>