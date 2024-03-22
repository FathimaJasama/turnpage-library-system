<?php
require_once '../config.php';
require_once '../helpers/AppManager.php';
require_once '../models/Treatment.php';

require_once '../models/User.php';

// Define target directory
$target_dir = "../assets/uploads/";

//create user
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'create_user') {

    try {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $permission = $_POST['permission'];

        $doctor_name = $_POST['doctor_name'] ?? null;
        $about_doctor = $_POST['about_doctor'] ?? null;

        // Get file information
        $image = $_FILES["image"] ?? null;
        $imageFileName = null;

        // Check if file is uploaded
        if (isset($image) && !empty($image)) {
            // Check if there are errors
            if ($image["error"] > 0) {
                echo "Error uploading file: " . $image["error"];
            } else {
                // Check if file is an image
                if (getimagesize($image["tmp_name"]) !== false) {
                    // Check file size (optional)
                    if ($image["size"] < 500000) { // 500kb limit
                        // Generate unique filename
                        $new_filename = uniqid() . "." . pathinfo($image["name"])["extension"];

                        // Move uploaded file to target directory
                        if (move_uploaded_file($image["tmp_name"], $target_dir . $new_filename)) {
                            $imageFileName = $new_filename;
                        } else {
                            echo json_encode(['success' => false, 'message' => "Error moving uploaded file."]);
                            exit;
                        }
                    } else {
                        echo json_encode(['success' => false, 'message' => "File size is too large."]);
                        exit;
                    }
                } else {
                    echo json_encode(['success' => false, 'message' => "Uploaded file is not an image."]);
                    exit;
                }
            }
        }

        $userModel = new User();
        $created =  $userModel->createUser($username, $password, $permission, $email);
        if ($created) {

            if ($permission == 'doctor') {
                $user_id = $userModel->getLastInsertedUserId();
                $doctorModel = new Doctor();
                $doctorCreated =  $doctorModel->createDoctor($doctor_name,  $about_doctor, $user_id, $imageFileName);
            }

            echo json_encode(['success' => true, 'message' => "User created successfully!"]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to create user. May be user already exist!']);
        }
    } catch (PDOException $e) {
        // Handle database connection errors
        echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
    }
    exit;
}

//Get user by id
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['user_id']) && isset($_GET['action']) &&  $_GET['action'] == 'get_user') {

    try {
        $user_id = $_GET['user_id'];
        $userModel = new User();
        $user = $userModel->getById($user_id);
        if ($user) {
            echo json_encode(['success' => true, 'message' => "User created successfully!", 'data' => $user]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to create user. May be user already exist!']);
        }
    } catch (PDOException $e) {
        // Handle database connection errors
        echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
    }
    exit;
}

//Delete by user id
if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['user_id']) && isset($_GET['action']) &&  $_GET['action'] == 'delete_user') {

    try {
        $user_id = $_GET['user_id'];
        $userModel = new User();
        $deleted = $userModel->deleteUser($user_id);

        if ($deleted) {
            echo json_encode(['success' => true, 'message' => "User deleted successfully!", 'data' => $deleted]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to delete user.']);
        }
    } catch (PDOException $e) {
        // Handle database connection errors
        echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
    }
    exit;
}

//update user
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'update_user') {
    try {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $permission = $_POST['permission'];
        $is_active = $_POST['is_active'] == 1 ? 1 : 0;
        $id = $_POST['id'];

        // Validate inputs
        if (empty($username) || empty($email)) {
            echo json_encode(['success' => false, 'message' => 'Required fields are missing!']);
            exit;
        }

        // Validate email format
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo json_encode(['success' => false, 'message' => 'Invalid email address']);
            exit;
        }

        $userModel = new User();
        $updated =  $userModel->updateUser($id, $username, $password, $permission, $email, $is_active);
        if ($updated) {
            echo json_encode(['success' => true, 'message' => "User updated successfully!"]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to update user. May be user already exist!']);
        }
    } catch (PDOException $e) {
        // Handle database connection errors
        echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
    }
    exit;
}

//create user
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'create_user') {

    try {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $permission = $_POST['permission'];

        $doctor_name = $_POST['doctor_name'] ?? null;
        $about_doctor = $_POST['about_doctor'] ?? null;

        // Get file information
        $image = $_FILES["image"] ?? null;
        $imageFileName = null;

        // Check if file is uploaded
        if (isset($image) && !empty($image)) {
            // Check if there are errors
            if ($image["error"] > 0) {
                echo "Error uploading file: " . $image["error"];
            } else {
                // Check if file is an image
                if (getimagesize($image["tmp_name"]) !== false) {
                    // Check file size (optional)
                    if ($image["size"] < 500000) { // 500kb limit
                        // Generate unique filename
                        $new_filename = uniqid() . "." . pathinfo($image["name"])["extension"];

                        // Move uploaded file to target directory
                        if (move_uploaded_file($image["tmp_name"], $target_dir . $new_filename)) {
                            $imageFileName = $new_filename;
                        } else {
                            echo json_encode(['success' => false, 'message' => "Error moving uploaded file."]);
                            exit;
                        }
                    } else {
                        echo json_encode(['success' => false, 'message' => "File size is too large."]);
                        exit;
                    }
                } else {
                    echo json_encode(['success' => false, 'message' => "Uploaded file is not an image."]);
                    exit;
                }
            }
        }

        $userModel = new User();
        $created =  $userModel->createUser($username, $password, $permission, $email);
        if ($created) {

            if ($permission == 'doctor') {
                $user_id = $userModel->getLastInsertedUserId();
                $doctorModel = new Doctor();
                $doctorCreated =  $doctorModel->createDoctor($doctor_name,  $about_doctor, $user_id, $imageFileName);
            }

            echo json_encode(['success' => true, 'message' => "User created successfully!"]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to create user. May be user already exist!']);
        }
    } catch (PDOException $e) {
        // Handle database connection errors
        echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
    }
    exit;
}

//Get user by id
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['user_id']) && isset($_GET['action']) &&  $_GET['action'] == 'get_user') {

    try {
        $user_id = $_GET['user_id'];
        $userModel = new User();
        $user = $userModel->getById($user_id);
        if ($user) {
            echo json_encode(['success' => true, 'message' => "User created successfully!", 'data' => $user]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to create user. May be user already exist!']);
        }
    } catch (PDOException $e) {
        // Handle database connection errors
        echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
    }
    exit;
}

//Delete by user id
if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['user_id']) && isset($_GET['action']) &&  $_GET['action'] == 'delete_user') {

    try {
        $user_id = $_GET['user_id'];
        $userModel = new User();
        $deleted = $userModel->deleteUser($user_id);

        if ($deleted) {
            echo json_encode(['success' => true, 'message' => "User deleted successfully!", 'data' => $deleted]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to delete user.']);
        }
    } catch (PDOException $e) {
        // Handle database connection errors
        echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
    }
    exit;
}

//update user
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'update_user') {
    try {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $permission = $_POST['permission'];
        $is_active = $_POST['is_active'] == 1 ? 1 : 0;
        $id = $_POST['id'];

        // Validate inputs
        if (empty($username) || empty($email)) {
            echo json_encode(['success' => false, 'message' => 'Required fields are missing!']);
            exit;
        }

        // Validate email format
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo json_encode(['success' => false, 'message' => 'Invalid email address']);
            exit;
        }

        $userModel = new User();
        $updated =  $userModel->updateUser($id, $username, $password, $permission, $email, $is_active);
        if ($updated) {
            echo json_encode(['success' => true, 'message' => "User updated successfully!"]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to update user. May be user already exist!']);
        }
    } catch (PDOException $e) {
        // Handle database connection errors
        echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
    }
    exit;
}





dd('Access denied..!');
