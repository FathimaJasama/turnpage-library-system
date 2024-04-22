<?php
require_once('../layouts/Header.php');
require_once __DIR__ . '/../../models/Author.php';

$authorModel = new Author();
$authors = $authorModel->getAll();

?>
<div class="content-wrapper-scroll">

<!-- Main header starts -->
<div class="main-header d-flex align-items-center justify-content-between position-relative">
    <div class="d-flex align-items-center justify-content-center">
        <div class="page-icon">
            <i class="bi bi-person-workspace"></i>
        </div>
        <div class="page-title d-none d-md-block">
            <h5>Authors</h5>
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
                                <th class="">Author</th>
                                <th class="">Created_at</th>
                                <th class="">Updated_at</th>

                         
                                <!-- <th style="width: 200px">Options</th> -->
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($authors as $key => $c) {
                            ?>
                                <tr>
                                    <td><?= ++$key ?></td>
                                    <td><?= $c['AuthorName'] ?? "";?></td>    
                                    <td> <?= $c['creationDate'] ?? ""; ?> </td>
                                    <td> <?= $c['UpdationDate'] ?? ""; ?></td>
                                    
                                        </div>
                                    </td>
                                    
                                    <td>
                                        <div>
                                            <button class="btn btn-sm btn-info m-2 edit-author" data-id="<?= $c['id']; ?>">Edit</button>
                                            <button class="btn btn-sm btn-danger m-2 delete-author" data-id="<?= $c['id']; ?>">Delete</button>

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

<div class="modal fade " id="editAuthorModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="update-author-form" action="<?= url('services/ajax_functions.php') ?>" autocomplete="off" enctype="multipart/form-data">
                <input type="hidden" name="action" value="update_author">
                <input type="hidden" name="id" id="author_id">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel1">Edit Author</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-3">
                            <label for="AuthorName" class="form-label">Author</label>
                            <input type="text" id="AuthorName" name="AuthorName" class="form-control" placeholder="Enter Name" required />
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



$('.edit-author').on('click', async function() {
    var author_id = $(this).data('id');
    await getAuthorById(author_id);
})

$('.delete-author').on('click', async function() {
            var author_id = $(this).data('id');
            var is_confirm = confirm('Are you sure,Do you want to delete?');
            if (is_confirm) await deleteById(author_id);
        })


        
// update category form
// handle update modal button click
$('#update-now').on('click', function() {
    // Get the form element
    var form = $('#update-author-form')[0];
    $('#update-author-form')[0].reportValidity();

    // Check form validity
    if (form.checkValidity()) {
        // Serialize the form data
        var formAction = $('#update-author-form').attr('action');
        var formData = new FormData($('#update-author-form')[0]);

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
                    $('#editAuthorModal').modal('hide');
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

async function getAuthorById(id) {
    var formAction = $('#update-author-form').attr('action');

    // Perform AJAX request
    $.ajax({
        url: formAction,
        type: 'GET',
        data: {
            author_id: id,
            action: 'get_author'
        }, // Form data
        dataType: 'json',
        success: function(response) {
            showAlert(response.message, response.success ? 'primary' : 'danger');
            if (response.success) {
                var author_id = response.data.id;
                var AuthorName = response.data.AuthorName;

                $('#editAuthorModal #author_id').val(author_id);
                $('#editAuthorModal #AuthorName').val(AuthorName);
                $('#editAuthorModal').modal('show');
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
        var formAction = $('#update-author-form').attr('action');

        // Perform AJAX request
        $.ajax({
            url: formAction,
            type: 'GET',
            data: {
                author_id: id,
                action: 'delete_author'
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

    $("#searchInput").on("input", function() {
            var searchTerm = $(this).val().toLowerCase();

            // Loop through each row in the table body
            $("tbody tr").filter(function() {
                // Toggle the visibility based on the search term
                $(this).toggle($(this).text().toLowerCase().indexOf(searchTerm) > -1);
            });
        });     


</script>