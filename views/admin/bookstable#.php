<?php
require_once('../layouts/Header.php');
// Establish database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "library";

// Create connection
$connection = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

// SQL query to select data from tblbooks
$sql = "SELECT * FROM tblbooks";

// Execute the query
$result = mysqli_query($connection, $sql);
?>



<body>
    <div class="content-wrapper-scroll">
        <!-- Main header starts -->
        <div class="main-header d-flex align-items-center justify-content-between position-relative">
            <div class="d-flex align-items-center justify-content-center">
                <div class="page-icon">
                    <i class="bi bi-journals"></i>
                </div>
                <div class="page-title d-none d-md-block">
                    <h5>Book Details</h5>
                </div>
            </div>
        </div>
        <!-- Main header ends -->
                                <!-- Content wrapper start -->

        <div class="content-wrapper">
						
        <div class="col-sm-12 col-12">
            <div class="card">
                <div class="card-body">
                <div class="d-flex align-items-center m-3">
                            <i class="bi bi-search"></i>
                            <input type="text" id="searchInput" class="form-control border-0 shadow-none" placeholder="Search" aria-label="Search..." />
                        </div>
        </div>
                    <div class="table-responsive">
                        <table class="table table-bordered m-0">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>AuthorId</th>
                                    <th>ISBNNumber</th>
                                    <th>BookPrice</th>
                                    <th>bookImage</th>
                                    <th>Category</th>
                                    <th>isIssued</th>
                                    <th>RegDate</th>
                                    <th>UpdationDate</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (mysqli_num_rows($result) > 0) {
                                    // Fetch data and display it in a table
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        ?>
                                        <tr>
                                            <td><?= $row['id'] ?? ""; ?></td>
                                            <td><?= $row['AuthorId'] ?? ""; ?></td>
                                            <td><?= $row['ISBNNumber'] ?? ""; ?></td>
                                            <td><?= $row['BookPrice'] ?? ""; ?></td>
                                            <td>
                                            <div class="text-left">
					                            <img src="<?=("book/" .$row['bookImage']) ?? ""?>" class="rounded" width="100" alt="Google Admin" />
                                                <h6><?= $row['BookName'] ?? ""; ?></h6>
                                            </div>
                                            </td>
                                            <td><?= $row['category'] ?? ""; ?></td>
                                            <td>
                                                <div class="">
                                                 <?php if ($row['isIssued'] == 1) { ?>
                                            <span class="badge shade-red">yes</span>
                                            <?php } else { ?>
                                            <span class="badge shade-green">No</span>
                                                <?php } ?>
                                                 </div>
                                            </td>
                                            <td><?= $row['RegDate'] ?? ""; ?></td>
                                            <td><?= $row['UpdationDate'] ?? ""; ?></td>

                                        </tr>
                                <?php
                                    }
                                } else {
                                    // If no records found
                                    ?>
                                    <tr>
                                        <td colspan="10">No records found</td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- Content wrapper end -->
    </div>
    <!-- Content wrapper scroll end -->

    <!-- App Footer start -->
    <!-- Include any necessary footer content -->
    <!-- App footer end -->
</body>

</html>

<?php
// Close the database connection
mysqli_close($connection);
?>

<!-- Modal -->
<div class="modal fade " id="createUserModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="create-user-form" action="<?= url('services/ajax_functions.php') ?>" enctype="multipart/form-data">
                <input type="hidden" name="action" value="create_user">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel1">Create User</h5>
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
                                <select class="form-select" id="permission" name="permission" required>
                                    <option selected="" value="">Choose...</option>
                                    <option value="operator">Operator</option>
                                    <option value="doctor">Doctor</option>
                                </select>
                            </div>
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

<?php require_once('../layouts/Footer.php');
?>

<script>
    $(document).ready(function() {
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