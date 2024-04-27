<?php
// Assuming the user is logged in and you have their user ID stored in a session variable
require_once('../layouts/Header.php');
$sm = AppManager::getSM();
$student_id = $sm->getAttribute("studentId");

// Fetch the profile picture path from the database
// Execute SQL query to fetch profile picture path for the logged-in user
// Replace 'users' with your actual table name and 'profile_picture' with the appropriate column name
$conn=new mysqli("localhost","root","","library");
$sql = "SELECT profile_picture FROM users WHERE id = $student_id";
// Execute the SQL query and fetch the result (you should use prepared statements to prevent SQL injection)
// Assuming $conn is your database connection object
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        $profilePicturePath = $row["profile_picture"];
    }
} else {
    $profilePicturePath = "default-profile-picture.jpg"; // Provide a default profile picture path if the user hasn't uploaded one
}
?>

<!-- Display the profile picture in HTML -->
<img src="<?php echo $profilePicturePath; ?>" alt="Profile Picture">


<form action="upload.php" method="post" enctype="multipart/form-data">
    Select Profile Picture: <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="Upload Image" name="submit">
</form>

<?php
// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if file was uploaded without errors
    if (isset($_FILES["fileToUpload"]) && $_FILES["fileToUpload"]["error"] == 0) {
        $targetDir = "uploads/";
        $targetFile = $targetDir . basename($_FILES["fileToUpload"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($targetFile,PATHINFO_EXTENSION));

        // Check if image file is a actual image or fake image
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if($check !== false) {
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }

        // Check file size
        if ($_FILES["fileToUpload"]["size"] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $targetFile)) {
                echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";

                // Save file path to SQL database
                $filePath = $targetFile;
                $studentId = $_SESSION['student_id']; // Assuming you have the user ID stored in a session variable
                $sql = "UPDATE users SET profile_picture = '$filePath' WHERE id = $studentId"; // Update the appropriate user's profile picture
                // Execute SQL query (you should use prepared statements to prevent SQL injection)
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    } else {
        echo "No file uploaded.";
    }
}
?>
