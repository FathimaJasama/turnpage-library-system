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
                    <div class="table-responsive">
                        <table class="table table-bordered m-0">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Book Name</th>
                                    <th>CatId</th>
                                    <th>AuthorId</th>
                                    <th>ISBNNumber</th>
                                    <th>BookPrice</th>
                                    <th>bookImage</th>
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
                                            <td><?= $row['BookName'] ?? ""; ?></td>
                                            <td><?= $row['CatId'] ?? ""; ?></td>
                                            <td><?= $row['AuthorId'] ?? ""; ?></td>
                                            <td><?= $row['ISBNNumber'] ?? ""; ?></td>
                                            <td><?= $row['BookPrice'] ?? ""; ?></td>
                                            <td><div class="col-sm-4 col-12">
			                                        <div class="card">
				                                        <div class="card-img">
					                                        <img src="<?=("book/" .$row['bookImage']) ?? ""?>" class="card-img-top img-fluid" alt="Google Admin" />
				                                        </div>
			                                        </div>
		                                        </div>
                                            </td>
                                            <td>
                                                <div class="">
                                                 <?php if ($row['isIssued'] == 1) { ?>
                                            <span class="badge shade-green">yes</span>
                                            <?php } else { ?>
                                            <span class="badge shade-red">No</span>
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
<?php require_once('../layouts/Footer.php');
?>