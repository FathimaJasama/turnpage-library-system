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
$sql = "SELECT Science, Programming, Romantic FROM tblcategories";

$result = $conn->query($sql);
$result1 = $conn->query($sql);
$result2 = $conn->query($sql);



// Check if any rows were returned
?>
<div class="col-xxl-12">
    <div class="card">
        <div class="card-body">
            <div class="custom-tabs-container">
                <ul class="nav nav-tabs" id="customTab2" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" id="tab-oneA" data-bs-toggle="tab" href="#oneA" role="tab"
                            aria-controls="oneA" aria-selected="true">Tab One
                            <span class="badge rounded-pill red ms-2">9</span></a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="tab-twoA" data-bs-toggle="tab" href="#twoA" role="tab"
                            aria-controls="twoA" aria-selected="false">Tab Two<span
                                class="badge rounded-pill primary ms-2">7</span></a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="tab-threeA" data-bs-toggle="tab" href="#threeA" role="tab"
                            aria-controls="threeA" aria-selected="false">Tab Three
                            <span class="badge rounded-pill green ms-2">3</span></a>
                    </li>
                </ul>
                <div class="tab-content" id="customTabContent2">
                    <div class="tab-pane fade show active" id="oneA" role="tabpanel">
                        <div class="row gx-3">
                        <?php
                            if ($result->num_rows > 0) {
                                // Output data of each row
                                while($row = $result->fetch_assoc()) {
                            ?>
                            <div class="col">
                                <img src="<?=("book/". $row['Programming']) ?>" class="img-fluid mb-2" alt="Admin Dashboards" />
                            </div>
                            <?php
                        }
} else {
    echo "0 results";
}
?>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="twoA" role="tabpanel">
                        <div class="row gx-3">
                        <?php
                            if ($result1->num_rows > 0) {
                                // Output data of each row
                                while($row = $result1->fetch_assoc()) {
                            ?>
                            <div class="col">
                                <img src="<?=("book/". $row['Science']) ?>" class="img-fluid mb-2" alt="Admin Dashboards" />
                            </div>
                            <?php
                        }
} else {
    echo "0 results";
}
?>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="threeA" role="tabpanel">
                        <div class="row gx-3">
                        <?php
                            if ($result2->num_rows > 0) {
                                // Output data of each row
                                while($row = $result2->fetch_assoc()) {
                            ?>
                            <div class="col">
                                <img src="<?=("book/". $row['Romantic']) ?>" class="img-fluid mb-2" alt="Admin Dashboards" />
                            </div>
                            <?php
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
    </div>
</div>

<?php
// Close the connection
$conn->close();
?>

<?php require_once('../layouts/Footer.php');
?>