<?php
require_once '../config.php';
require_once '../helpers/AppManager.php';
require_once '../models/Treatment.php';
require_once '../models/Booktable.php';
require_once '../models/Student.php';
require_once '../models/User.php';

// Define target directory
$target_dir = "../assets/uploads/";


//create student
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'create_student') {
    try {
        $StudentId = $_POST['StudentId'];
        $FullName = $_POST['FullName'];
        $Photo = $_FILES['Photo'];
        $EmailId = $_POST['EmailId'];
        $Password = $_POST['Password'];
        $MobileNumber = $_POST['MobileNumber']; // assuming MobileNumber is the name of the input field
        
        // Check if file was uploaded without errors
        if ($Photo['error'] === 0) {
            // Specify directory where you want to store uploaded files
            $uploadDir = 'uploads/';
            
            // Generate a unique name for the uploaded file
            $fileName = uniqid() . '_' . $Photo['name'];
            
            // Move the uploaded file to the specified directory
            $uploadPath = $uploadDir . $fileName;
            if (move_uploaded_file($Photo['tmp_name'], $uploadPath)) {
                // Create an instance of the Student model
                $studentModel = new Student();
                
                // Call the createStudent method with correct parameters
                $created =  $studentModel->createStudent($StudentId, $fileName, $FullName, $Password, $MobileNumber, $EmailId);
                
                if ($created) {
                    echo json_encode(['success' => true, 'message' => "User created successfully!"]);
                } else {
                    echo json_encode(['success' => false, 'message' => 'Failed to create user. Maybe student already exists!']);
                }
            } else {
                echo json_encode(['success' => false, 'message' => 'Failed to move uploaded file.']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'File upload error: ' . $Photo['error']]);
        }
    } catch (PDOException $e) {
        // Handle database connection errors
        echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
    }
    exit;
}

//Get student by id
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['student_id']) && isset($_GET['action']) &&  $_GET['action'] == 'get_student') {

    try {
        $student_id = $_GET['student_id'];
        $studentModel = new Student();
        $student = $studentModel->getById($student_id);
        if ($student) {
            echo json_encode(['success' => true, 'message' => "Student created successfully!", 'data' => $student]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to create student. May be student already exist!']);
        }
    } catch (PDOException $e) {
        // Handle database connection errors
        echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
    }
    exit;
}

//Delete by student id
if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['student_id']) && isset($_GET['action']) &&  $_GET['action'] == 'delete_student') {

    try {
        $student_id = $_GET['student_id'];
        $studentModel = new Student();
        $deleted = $studentModel->deleteStudent($student_id);

        if ($deleted) {
            echo json_encode(['success' => true, 'message' => "Student deleted successfully!", 'data' => $deleted]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to delete student.']);
        }
    } catch (PDOException $e) {
        // Handle database connection errors
        echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
    }
    exit;
}

//update student
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'update_student') {
    try {
        $StudentId = $_POST['StudentId'];
        $FullName = $_POST['FullName'];
        $EmailId = $_POST['EmailId'];
        $Password = $_POST['Password'];
        $MobileNumber = $_POST['MobileNumber'];
        $Status = $_POST['Status'] == 1 ? 1 : 0;
        $id = $_POST['id'];

        // Validate inputs
        if (empty($StudentId) || empty($FullName) || empty($EmailId) || empty($MobileNumber)) {
            echo json_encode(['success' => false, 'message' => 'Required fields are missing!']);
            exit;
        }

        // Validate email format
        if (!filter_var($EmailId, FILTER_VALIDATE_EMAIL)) {
            echo json_encode(['success' => false, 'message' => 'Invalid email address']);
            exit;
        }

        $studentModel = new Student();
        $updated =  $studentModel->updateStudent($id, $StudentId, $FullName, $Password, $EmailId, $MobileNumber, $Status);
        if ($updated) {
            echo json_encode(['success' => true, 'message' => "Student updated successfully!"]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to update student. May be student already exist!']);
        }
    } catch (PDOException $e) {
        // Handle database connection errors
        echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
    }
    exit;
}

//create book
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'create_book') {
    try {
        $StudentId = $_POST['StudentId'];
        $BookName = $_POST['BookName'];
        $AuthorName = $_POST['AuthorName'];
        $ISBNNumber = $_POST['ISBNNumber'];
        $BookPrice = $_POST['BookPrice'];
        $image = $_FILES["bookImage"];
        $category = $_POST['category'];

         // Check if file was uploaded without errors
        if ($image['error'] === 0) {
            // Specify directory where you want to store uploaded files
            $uploadDir = 'uploads/';
            
            // Generate a unique name for the uploaded file
            $fileName = uniqid() . '_' . $image['name'];
            
            // Move the uploaded file to the specified directory
            $uploadPath = $uploadDir . $fileName;
            if (move_uploaded_file($image['tmp_name'], $uploadPath)) {
                // Create an instance of the Book model
                $bookModel = new Book();
                
                // Call the createStudent method with correct parameters
                $created =  $bookModel->createBook($StudentId, $BookName, $AuthorName, $ISBNNumber, $BookPrice, $fileName, $category);
                
                if ($created) {
                    echo json_encode(['success' => true, 'message' => "User created successfully!"]);
                } else {
                    echo json_encode(['success' => false, 'message' => 'Failed to create user. Maybe student already exists!']);
                }
            } else {
                echo json_encode(['success' => false, 'message' => 'Failed to move uploaded file.']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'File upload error: ' . $image['error']]);
        }
    } catch (PDOException $e) {
        // Handle database connection errors
        echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
    }
    exit;
}


