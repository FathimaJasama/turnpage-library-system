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
                                <th class="">StudentId</th>
                                <th class="">BookName</th>
                                <th class="">AuthorName</th>
                                <th class="">ISBNNumber</th>
                                <th class="">BookPrice</th>
                                <th class="">BookImage</th>
                                <th class="">isIssued</th>
                                <th class="">category</th>
                                <!-- <th class="">Reg.Date</th> -->
                                <!-- <th class="">Updated Date</th> -->
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
                                    <td><h6> <?= $c['BookName'] ?? ""; ?> </h6></td>
                                    <td><h6> <?= $c['AuthorName'] ?? ""; ?> </h6></td>
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
                                    
                                    <td>
                                        <div>
                                            <button class="btn btn-sm btn-info m-2 edit-book" data-id="<?= $c['id']; ?>">Edit</button>
                                            <button class="btn btn-sm btn-danger m-2 delete-book" data-id="<?= $c['id']; ?>">Delete</button>

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
<div class="modal fade " id="editBookModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="update-book-form" action="<?= url('services/ajax_functions.php') ?>" autocomplete="off" enctype="multipart/form-data">
                <input type="hidden" name="action" value="update_book">
                <input type="hidden" name="id" id="book_id">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel1">Edit Book Deatails</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-3">
                            <label for="StudentId" class="form-label">Student ID</label>
                            <input type="text" id="StudentId" name="StudentId" class="form-control" placeholder="Enter Student Id" required />
                        </div>
                    </div>
                    <div class="row g-1">
                        <div class="col mb-0">
                            <label for="BookName" class="form-label">Book Name</label>
                            <input type="text" id="BookName" name="BookName" class="form-control" placeholder="Enter Book Name" required />
                        </div>
                    </div>
                    <div class="row g-1">
                        <div class="col mb-0">
                            <label for="AuthorName" class="form-label">Author Name</label>
                            <input type="text" id="AuthorName" name="AuthorName" class="form-control" placeholder="Enter Author Name" required />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="ISBNNumber" class="form-label">ISBN Number</label>
                            <input type="number" id="ISBNNumber" name="ISBNNumber" class="form-control" placeholder="1234567890" required />
                        </div>
                    </div>
                    <div class="row g-1">
                        <div class="col mb-0">
                            <label for="BookPrice" class="form-label">Book Price</label>
                            <input type="number" id="BookPrice" name="BookPrice" class="form-control" placeholder="Enter Book Price" required />
                        </div>
                    </div>
                    <div class="col-12 mb-3">
                    <label for="bookImage" class="form-label">Book Image</label>
                    <input class="form-control" name="bookImage" id="editbookImage" type="file" accept="image/*">
                    </div>
                    <div class="row g-1">
                        <div class="col mb-0">
                            <label for="category" class="form-label">Category</label>
                            <div class="input-group">
                            <label class="input-group-text" for="inputGroupSelect01">Options</label>
                                <select class="form-select" id="edit_category" name="category" required>
                                    <option selected="" value="">Choose...</option>
                                    <option value="5">Technology</option>
                                    <option value="4">Science</option>
                                    <option value="3">Romantic</option>
                                    <option value="2">Programming</option>
                                    <option value="1">Management</option>
                                    <option value="0">General</option>
                                </select>
                            </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col mb-0">
                            <label class="form-label" for="isIssued">isIssued</label>
                            <div class="input-group">
                                <select class="form-select" id="isIssued" name="isIssued" required>
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

$('.edit-book').on('click', async function() {
    var book_id = $(this).data('id');
    await getBookById(book_id);
});

$('.delete-book').on('click', async function() {
            var book_id = $(this).data('id');
            var is_confirm = confirm('Are you sure,Do you want to delete?');
            if (is_confirm) await deleteById(book_id);
        })

// update student form
// handle update modal button click
$('#update-now').on('click', function() {
    // Get the form element
    var form = $('#update-book-form')[0];
    $('#update-book-form')[0].reportValidity();

    // Check form validity
    if (form.checkValidity()) {
        // Serialize the form data
        var formAction = $('#update-book-form').attr('action');
        var formData = new FormData($('#update-book-form')[0]);

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
                    $('#editBookModal').modal('hide');
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

async function getBookById(id) {
    var formAction = $('#update-book-form').attr('action');    

    $.ajax({
        url: formAction,
        type: 'GET',
        data: {
            book_id: id,
            action: 'get_book'
        }, // Form data
        dataType: 'json',
        success: function(response) {
            showAlert(response.message, response.success ? 'primary' : 'danger');
            if (response.success) {
                var book_id = response.data.id;
                var StudentId = response.data.StudentId;
                var BookName = response.data.BookName;
                var AuthorName = response.data.AuthorName;
                var ISBNNumber = response.data.ISBNNumber;
                var BookPrice = response.data.BookPrice;
                var BookImage = response.data.BookImage;
                var isIssued = response.data.isIssued;
                var category = response.data.category;

                $('#editBookModal #book_id').val(book_id);
                $('#editBookModal #StudentId').val(StudentId);
                $('#editBookModal #BookName').val(BookName);
                $('#editBookModal #AuthorName').val(AuthorName);
                $('#editBookModal #ISBNNumber').val(ISBNNumber);
                $('#editBookModal #BookPrice').val(BookPrice);
                $('#editBookModal #BookImage').val(BookImage);
                $('#editBookModal #isIssued option[value="' + isIssued + '"]').prop('selected', true);
                $('#editBookModal #category').val(category) ;
                $('#editBookModal').modal('show');
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
        var formAction = $('#update-book-form').attr('action');

        // Perform AJAX request
        $.ajax({
            url: formAction,
            type: 'GET',
            data: {
                book_id: id,
                action: 'delete_book'
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

    