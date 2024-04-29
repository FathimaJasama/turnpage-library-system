<?php
require_once('../layouts/Header.php');
require_once __DIR__ . '/../../models/Issuebook.php';

$issuebookModel = new Issuebook();
$issuebooks = $issuebookModel->getAll();

?>
<div class="content-wrapper-scroll">

    <!-- Main header starts -->
    <div class="main-header d-flex align-items-center justify-content-between position-relative">
        <div class="d-flex align-items-center justify-content-center">
            <div class="page-icon">
                <i class="bi bi-file-person-fill"></i>
            </div>
            <div class="page-title d-none d-md-block">
                <h5>Issue Books</h5>
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
                            <div class="d-flex align-items-center m-3">
                                <i class="bi bi-search"></i>
                                <input type="text" id="searchInput" class="form-control border-0 shadow-none" placeholder="Search" aria-label="Search..." />
                            </div>
                        </div>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th class="">Book Id</th>
                                    <th class="">NIC</th>
                                    <th class="">Issue Date</th>
                                    <th class="">Return Date</th>
                                    <th class="">Return Status</th>
                                    <th class=""></th>
                                    <th class="">BookImage</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($issuebooks as $key => $c) {
                                ?>
                                    <tr>
                                        <td><?= ++$key ?></td>
                                        <td><?= $c['BookId'] ?? ""; ?></td>
                                        <td>
                                            <h6> <?= $c['StudentID'] ?? ""; ?> </h6>
                                        </td>
                                        <td>
                                            <h6> <?= $c['IssuesDate'] ?? ""; ?> </h6>
                                        </td>
                                        <td> <?= $c['ReturnDate'] ?? ""; ?> </td>
                                        <td> <?= $c['ReturnStatus'] ?? ""; ?> </td>
                                        <td> <?= $c['fine'] ?? ""; ?></td>

                                        <td>
                                            <div>
                                                <button class="btn btn-sm btn-info m-2 edit-issuebook" data-id="<?= $c['id']; ?>">Edit</button>
                                                <button class="btn btn-sm btn-danger m-2 delete-issuebook" data-id="<?= $c['id']; ?>">Delete</button>

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



    <!-- Update User Modal -->
    <div class="modal fade " id="editIssuebookModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="update-issuebook-form" action="<?= url('services/ajax_functions.php') ?>" autocomplete="off" enctype="multipart/form-data">
                    <input type="hidden" name="action" value="update_issuebook">
                    <input type="hidden" name="id" id="issuebook_id">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel1">Edit Issued Book Deatails</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    <div class="row g-1">
                            <div class="col mb-0">
                                <label for="BookId" class="form-label">Book Id</label>
                                <input type="text" id="BookId" name="BookId" class="form-control" placeholder="Enter Book Id" required />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-3">
                                <label for="StudentId" class="form-label">Student ID</label>
                                <input type="text" id="StudentID" name="StudentID" class="form-control" placeholder="Enter Student Id" required />
                            </div>
                        </div>
                        <div class="row g-1">
                            <div class="col mb-0">
                                <label for="Returndate" class="form-label">Return Date</label>
                                <input type="text" id="ReturnDate" name="ReturnDate" class="form-control" placeholder="Enter Book Name" required />
                            </div>
                        </div>
                            <div class="row mt-3">
                                <div class="col mb-0">
                                    <label class="form-label" for="isIssued">Return Status</label>
                                    <div class="input-group">
                                        <select class="form-select" id="ReturnStatus" name="ReturnStatus" required>
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

            $('.edit-issuebook').on('click', async function() {
                var issuebook_id = $(this).data('id');
                await getIssuebookById(issuebook_id);
            });

            $('.delete-issuebook').on('click', async function() {
                var issuebook_id = $(this).data('id');
                var is_confirm = confirm('Are you sure,Do you want to delete?');
                if (is_confirm) await deleteById(issuebook_id);
            })

            // update student form
            // handle update modal button click
            $('#update-now').on('click', function() {
                // Get the form element
                var form = $('#update-issuebook-form')[0];
                $('#update-issuebook-form')[0].reportValidity();

                // Check form validity
                if (form.checkValidity()) {
                    // Serialize the form data
                    var formAction = $('#update-issuebook-form').attr('action');
                    var formData = new FormData($('#update-issuebook-form')[0]);

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
                                $('#editIssuebookModal').modal('hide');
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
                    var message = 'Form is not valid. Please check your inputs.';
                    showAlert(message, 'red');
                }
            });

            async function getIssuebookById(id) {
                var formAction = $('#update-issuebook-form').attr('action');

                $.ajax({
                    url: formAction,
                    type: 'GET',
                    data: {
                        issuebook_id: id,
                        action: 'get_issuebook'
                    }, // Form data
                    dataType: 'json',
                    success: function(response) {
                        showAlert(response.message, response.success ? 'primary' : 'danger');
                        if (response.success) {
                            var issuebook_id = response.data.id;
                            var BookId = response.data.BookId;
                            var StudentID = response.data.StudentID;
                            var ReturnDate = response.data.ReturnDate;
                            var ReturnStatus = response.data.ReturnStatus;
                            var fine = response.data.fine;

                            $('#editIssuebookModal #issuebook_id').val(issuebook_id);
                            $('#editIssuebookModal #BookId').val(BookId);
                            $('#editIssuebookModal #StudentID').val(StudentID);
                            $('#editIssuebookModal #ReturnDate').val(ReturnDate);
                            $('#editIssuebookModal #ReturnStatus option[value="' + ReturnStatus + '"]').prop('selected', true);
                            $('#editIssuebookModal #fine').val(fine);
                            $('#editIssuebookModal').modal('show');
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
                var formAction = $('#update-issuebook-form').attr('action');

                // Perform AJAX request
                $.ajax({
                    url: formAction,
                    type: 'GET',
                    data: {
                        issuebook_id: id,
                        action: 'delete_issuebook'
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

        });
    </script>