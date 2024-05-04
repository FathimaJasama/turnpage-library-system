<?php
require_once('../layouts/Header.php');
// Establish database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "library";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to fetch data from tblcategories table
$sql = "SELECT * FROM tblbooks WHERE category = 'Programming'";

$result = $conn->query($sql);


// Check if any rows were returned
?>
<div class="content-wrapper-scroll">

    <!-- Main header starts -->
    <div class="main-header d-flex align-items-center justify-content-between position-relative">
        <div class="d-flex align-items-center justify-content-center">
            <div class="page-icon">
                <i class="bi bi-book"></i>
            </div>
            <div class="page-title d-none d-md-block">
                <h5>Books</h5>
            </div>
        </div>

    </div>
    <!-- Main header ends -->

    <!-- Content wrapper start -->
    <div class="content-wrapper">
        <div class="col-xxl-12">
            <div class="card">
                <div class="card-body">
                    <!-- Search input group start -->
                    <div>
                        <!-- <div class="col-sm-12 col-md-6"> -->
                        <div class="d-flex align-items-center m-3">
                            <i class="bi bi-search"></i>
                            <input type="text" id="searchInput1" class="form-control border-0 shadow-none" placeholder="Search Books" aria-label="Search..." />
                        </div>
                    </div>

                    <div class="custom-tabs-container">

                        <div class="tab-content" id="customTabContent2">
                            <div class="tab-pane fade show active" id="oneA" role="tabpanel">

                                <div class="row g-2 row-cols-6">
                                    <?php
                                    if ($result->num_rows > 0) {
                                        // Output data of each row
                                        while ($row = $result->fetch_assoc()) {
                                            if ($row['bookImage'] !== null) {
                                    ?>
                                                <div class="book-row">
                                                    <img src="<?= asset("services/uploads/" . $row['bookImage']) ?>" class="rounded" width="100" alt="Admin Dashboards" />
                                                    <div class="book-row"> <!--Class of Search bar-->
                                                        <h6><?= $row['BookName'] ?></h6>
                                                    </div>
                                                    <h7><?= $row['AuthorName'] ?></h7><br>
                                                    <h6> <?= $row['category'] ?></h6><br>

                                                    <div class="">
                                                        <?php if ($row['isIssued'] == 1) { ?>
                                                            <span class="badge shade-red">Already Issued</span>
                                                        <?php } else { ?>
                                                            <span class="badge shade-green"></span>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                    <?php
                                            }
                                        }
                                    } else {
                                        echo "0 results";
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php
        // Close the connection
        $conn->close();
        ?>

        <?php require_once('../layouts/Footer.php');
        ?>
        <script>
            $(document).ready(function() {
                $("#searchInput1").on("input", function() {
                    var searchTerm = $(this).val().toLowerCase();

                    // Loop through each book row
                    $(".book-row").filter(function() {
                        // Toggle the visibility based on the search term
                        $(this).toggle($(this).text().toLowerCase().indexOf(searchTerm) > -1);
                    });
                });
            });
        </script>