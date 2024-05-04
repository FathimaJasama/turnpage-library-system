<?php
// Connect to your MySQL database
// $servername = "localhost";
// $username = "username";
// $password = "password";
// $dbname = "database_name";

$conn = new mysqli('localhost', 'root', '', 'library');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Execute the SQL query
$sql = "SELECT students.*, tblissuedbookdetail.fine
        FROM students
        JOIN tblissuedbookdetail ON students.StudentId = tblissuedbookdetail.StudentID";

$result = $conn->query($sql);

// Fetch and display the data
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<p>Name: " . $row["FullName"]. "</p>";
        echo "<p>Email: " . $row["EmailId"]. "</p>";
        echo "<p>Fine: " . $row["fine"]. "</p>";
        // Add more fields as needed
    }
} else {
    echo "0 results";
}
$conn->close();
?>