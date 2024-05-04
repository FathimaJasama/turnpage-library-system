<?php
require_once '../config.php';
require_once '../helpers/AppManager.php';
require_once '../models/Message.php';

// Define target directory
$target_dir = "../assets/uploads/";

//create message
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'create_message') {
    try {
        $Name = $_POST['Name'];
        $EmailId = $_POST['EmailId'];
        $Message = $_POST['Message'];


        // Create an instance of the Book model
        $messageModel = new Message();

        // Call the createStudent method with correct parameters
        $created =  $messageModel->createMessage($Name, $EmailId, $Message);

        if ($created) {
            echo json_encode(['success' => true, 'message' => "Message has been sent successfully! We will Reach you soon"]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to send message. There is error in server']);
        }
    } catch (PDOException $e) {
        // Handle database connection errors
        echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
    }
    exit;
}

