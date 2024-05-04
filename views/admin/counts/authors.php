
<?php
// require_once('./../../config.php');
// include __DIR__ . '/../../helpers/AppManager.php';
// require_once('../layouts/Header.php');
$conn = new mysqli('localhost', 'root', "", 'library');


// SQL query to get the count of books
$sql = "SELECT COUNT(id) AS authors FROM tblauthors";


$result = $conn->query($sql);

if ($result) {
    $row = $result->fetch_assoc();

     echo $row['authors'];
} else {
    echo "Error: " . $conn->error;
}

// Close the connection
$conn->close();
?>

