<?php
require_once '../config.php';
require_once '../helpers/AppManager.php';
require_once '../models/Booktable.php';
require_once '../models/Student.php';
require_once '../models/category.php';
require_once '../models/Author.php';
require_once '../models/Message.php';
require_once '../models/Issuebook.php';




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

//update student to my profile
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'update_studentprofile') {
    try {
        // $StudentId = $_POST['StudentId'];
        $Photo = $_FILES['Photo'];
        $FullName = $_POST['FullName'];
        $EmailId = $_POST['EmailId'];
        $MobileNumber = $_POST['MobileNumber'];
        $Status = 1;
        $id = $_POST['id'];

        // Validate inputs
        if (empty($FullName) || empty($EmailId) || empty($MobileNumber)) {
            echo json_encode(['success' => false, 'message' => 'Required fields are missing!']);
            exit;
        }

        // Validate email format
        if (!filter_var($EmailId, FILTER_VALIDATE_EMAIL)) {
            echo json_encode(['success' => false, 'message' => 'Invalid email address']);
            exit;
        }

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
                $updated =  $studentModel->updateStudentDetails($id, $fileName, $FullName, $EmailId, $MobileNumber, $Status);

                if ($updated) {
                    echo json_encode(['success' => true, 'message' => "Student updated successfully!"]);
                } else {
                    echo json_encode(['success' => false, 'message' => 'Failed to update student.!']);
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

//update student
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'update_student') {
    try {
        $StudentId = $_POST['StudentId'];
        // $Photo = $_FILES['Photo'];
        $FullName = $_POST['FullName'];
        $EmailId = $_POST['EmailId'];
        // $Password = $_POST['Password'];
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

        // Check if file was uploaded without errors
        // if ($Photo['error'] === 0) {
        //     // Specify directory where you want to store uploaded files
        //     $uploadDir = 'uploads/';

        //     // Generate a unique name for the uploaded file
        //     $fileName = uniqid() . '_' . $Photo['name'];

        //     // Move the uploaded file to the specified directory
        //     $uploadPath = $uploadDir . $fileName;
        //     if (move_uploaded_file($Photo['tmp_name'], $uploadPath)) {
                // Create an instance of the Student model
                $studentModel = new Student();

                // Call the createStudent method with correct parameters
                $updated =  $studentModel->updateStudent($id, $StudentId, $FullName, $MobileNumber, $EmailId, $Status);

                if ($updated) {
                    echo json_encode(['success' => true, 'message' => "Student updated successfully!"]);
                } else {
                    echo json_encode(['success' => false, 'message' => 'Failed to update student.!']);
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

//create book
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'create_book') {
    try {
        $Publisher = $_POST['Publisher'];
        $BookName = $_POST['BookName'];
        $AuthorName = $_POST['AuthorName'];
        $ISBNNumber = $_POST['ISBNNumber'];
        $BookPrice = $_POST['BookPrice'];
        $image = $_FILES["bookImage"];
        $category = $_POST['category'];
        $isIssued = 0;


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
                $created =  $bookModel->createBook($Publisher, $BookName, $AuthorName, $ISBNNumber, $BookPrice, $fileName, $category, $isIssued);

                if ($created) {
                    echo json_encode(['success' => true, 'message' => "Book created successfully!"]);
                } else {
                    echo json_encode(['success' => false, 'message' => 'Failed to create book. Maybe book already exists!']);
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

//Get book by id
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['book_id']) && isset($_GET['action']) &&  $_GET['action'] == 'get_book') {

    try {
        $book_id = $_GET['book_id'];
        $bookModel = new Book();
        $book = $bookModel->getById($book_id);
        if ($book) {
            echo json_encode(['success' => true, 'message' => "Book created successfully!", 'data' => $book]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to create book. May be book already exist!']);
        }
    } catch (PDOException $e) {
        // Handle database connection errors
        echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
    }
    exit;
}

//update book
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'update_book') {
    try {
        $Publisher = $_POST['Publisher'];
        $BookName = $_POST['BookName'];
        $AuthorName = $_POST['AuthorName'];
        $ISBNNumber = $_POST['ISBNNumber'];
        $BookPrice = $_POST['BookPrice'];
        $BookImage = $_FILES['bookImage'];
        $category = $_POST['category'];
        $isIssued = $_POST['isIssued'] == 1 ? 1 : 0;
        $id = $_POST['id'];

        // Validate inputs
        if (empty($Publisher) || empty($BookName) || empty($AuthorName) || empty($ISBNNumber) || empty($BookPrice) || empty($category)) {
            echo json_encode(['success' => false, 'message' => 'Required fields are missing!']);
            exit;
        }

        // Check if file was uploaded without errors
        if ($BookImage['error'] === 0) {
            // Specify directory where you want to store uploaded files
            $uploadDir = 'uploads/';

            // Generate a unique name for the uploaded file
            $fileName = uniqid() . '_' . $BookImage['name'];

            // Move the uploaded file to the specified directory
            $uploadPath = $uploadDir . $fileName;
            if (move_uploaded_file($BookImage['tmp_name'], $uploadPath)) {
                // Create an instance of the Student model
                $bookModel = new Book();

                // Call the createStudent method with correct parameters
                $updated =  $bookModel->updateBook($id, $Publisher, $BookName, $AuthorName, $ISBNNumber, $BookPrice, $fileName, $category, $isIssued);

                if ($updated) {
                    echo json_encode(['success' => true, 'message' => "Book updated successfully!"]);
                } else {
                    echo json_encode(['success' => false, 'message' => 'Failed to update book. Maybe book already exists!']);
                }
            } else {
                echo json_encode(['success' => false, 'message' => 'Failed to move uploaded file.']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'File upload error: ' . $BookImage['error']]);
        }
    } catch (PDOException $e) {
        // Handle database connection errors
        echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
    }
    exit;
}

//Delete by book id
if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['book_id']) && isset($_GET['action']) &&  $_GET['action'] == 'delete_book') {

    try {
        $book_id = $_GET['book_id'];
        $bookModel = new Book();
        $deleted = $bookModel->deleteBook($book_id);

        if ($deleted) {
            echo json_encode(['success' => true, 'message' => "Book deleted successfully!", 'data' => $deleted]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to delete book.']);
        }
    } catch (PDOException $e) {
        // Handle database connection errors
        echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
    }
    exit;
}


//create category
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'create_category') {
    try {
        $CategoryName = $_POST['CategoryName'];


        // Create an instance of the Book model
        $categoryModel = new Category();

        // Call the createStudent method with correct parameters
        $created =  $categoryModel->createCategory($CategoryName);

        if ($created) {
            echo json_encode(['success' => true, 'message' => "Category created successfully!"]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to create user. Maybe category already exists!']);
        }
    } catch (PDOException $e) {
        // Handle database connection errors
        echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
    }
    exit;
}



//update category
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'update_category') {
    try {
        $CategoryName = $_POST['CategoryName'];
        $Status = $_POST['Status'] == 1 ? 1 : 0;
        $id = $_POST['id'];

        // Validate inputs
        if (empty($CategoryName)) {
            echo json_encode(['success' => false, 'message' => 'Required fields are missing!']);
            exit;
        }

        $categoryModel = new Category();

        // Call the createStudent method with correct parameters
        $updated =  $categoryModel->updateCategory($id, $CategoryName, $Status);

        if ($updated) {
            echo json_encode(['success' => true, 'message' => "Category updated successfully!"]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to update category. Maybe category already exists!']);
        }
    } catch (PDOException $e) {
        // Handle database connection errors
        echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
    }
    exit;
}

//Delete by category id
if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['category_id']) && isset($_GET['action']) &&  $_GET['action'] == 'delete_category') {

    try {
        $category_id = $_GET['category_id'];
        $categoryModel = new Category();
        $deleted = $categoryModel->deleteCategory($category_id);

        if ($deleted) {
            echo json_encode(['success' => true, 'message' => "Category deleted successfully!", 'data' => $deleted]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to delete category.']);
        }
    } catch (PDOException $e) {
        // Handle database connection errors
        echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
    }
    exit;
}

//create author
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'create_author') {
    try {
        $AuthorName = $_POST['AuthorName'];


        // Create an instance of the Book model
        $authorModel = new Author();

        // Call the createStudent method with correct parameters
        $created =  $authorModel->createAuthor($AuthorName);

        if ($created) {
            echo json_encode(['success' => true, 'message' => "Author created successfully!"]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to create author. Maybe author already exists!']);
        }
    } catch (PDOException $e) {
        // Handle database connection errors
        echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
    }
    exit;
}

//Get author by id
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['author_id']) && isset($_GET['action']) &&  $_GET['action'] == 'get_author') {

    try {
        $author_id = $_GET['author_id'];
        $authorModel = new Author();
        $author = $authorModel->getById($author_id);
        if ($author) {
            echo json_encode(['success' => true, 'message' => "Author created successfully!", 'data' => $author]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to create author. May be author already exist!']);
        }
    } catch (PDOException $e) {
        // Handle database connection errors
        echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
    }
    exit;
}

//update author
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'update_author') {
    try {
        $AuthorName = $_POST['AuthorName'];
        $id = $_POST['id'];

        // Validate inputs
        if (empty($AuthorName)) {
            echo json_encode(['success' => false, 'message' => 'Required fields are missing!']);
            exit;
        }

        $authorModel = new Author();

        // Call the create Author method with correct parameters
        $updated =  $authorModel->updateAuthor($id, $AuthorName);

        if ($updated) {
            echo json_encode(['success' => true, 'message' => "Author updated successfully!"]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to update author. Maybe author already exists!']);
        }
    } catch (PDOException $e) {
        // Handle database connection errors
        echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
    }
    exit;
}

//Delete by author id
if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['author_id']) && isset($_GET['action']) &&  $_GET['action'] == 'delete_author') {

    try {
        $author_id = $_GET['author_id'];
        $authorModel = new Author();
        $deleted = $authorModel->deleteAuthor($author_id);

        if ($deleted) {
            echo json_encode(['success' => true, 'message' => "Author deleted successfully!", 'data' => $deleted]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to delete author.']);
        }
    } catch (PDOException $e) {
        // Handle database connection errors
        echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
    }
    exit;
}

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

//create Issuebook
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'create_issuebook') {
    try {
        // Retrieve data from the POST request
        $BookId = $_POST['BookId'];
        $StudentId = $_POST['StudentId'];
        $ReturnStatus = 0;

        // Create an instance of the Book model
        $issuebookModel = new Issuebook();

        // Call the createStudent method with correct parameters
        $created =  $issuebookModel->createIssuebook($BookId, $StudentId, $ReturnStatus);

        if ($created) {
            echo json_encode(['success' => true, 'message' => "Book Issued successfully!"]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to issue book. Maybe book already issued!']);
        }
    } catch (PDOException $e) {
        // Handle database connection errors
        echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
    }
    exit;
}

//Get issue book by id
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['issuebook_id']) && isset($_GET['action']) &&  $_GET['action'] == 'get_issuebook') {

    try {
        $issuebook_id = $_GET['issuebook_id'];
        $issuebookModel = new Issuebook();
        $issuebook = $issuebookModel->getById($issuebook_id);
        if ($issuebook) {
            echo json_encode(['success' => true, 'message' => "Issuebook created successfully!", 'data' => $issuebook]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to create issuebook. May be book already issued!']);
        }
    } catch (PDOException $e) {
        // Handle database connection errors
        echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
    }
    exit;
}

//update issue book
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'update_issuebook') {
    try {
        $id = $_POST['id'];
        $BookId = $_POST['BookId'];
        $StudentID = $_POST['StudentID'];
        $ReturnDate = $_POST['ReturnDate'];
        $ReturnStatus = $_POST['ReturnStatus'];
        // Calculate the difference in days
        $ReturnDate = date('Y-m-d H:i:s', strtotime($ReturnDate));

        $IssuesDate = date('Y-m-d H:i:s'); // Assuming IssuesDate is the current date
        $daysLate = (strtotime($ReturnDate) - strtotime($IssuesDate)) / (60 * 60 * 24);

        // To determine fine amount 
        if ($daysLate > 5 && $daysLate <= 10) {
            $fineAmount = ($daysLate - 5) * 0.1; // $0.1 per day after 5 days late
        } elseif ($daysLate > 10) {
            $fineAmount = (5 * 0.1) + (($daysLate - 10) * 0.25); // $0.1 per day for the first 5 days late, then $0.2 per day after that
        } else {
            $fineAmount = 0; // No fine if less than or equal to 5 days late
        }
    
        // Validate inputs
        if (empty($BookId || $StudentId)) {
            echo json_encode(['success' => false, 'message' => 'Required fields are missing!']);
            exit;
        }

        $issuebookModel = new Issuebook();

        // Call the create Author method with correct parameters
        $updated =  $issuebookModel->updateIssuebook($id, $BookId , $StudentID,  $ReturnDate, $ReturnStatus, $fineAmount);

        if ($updated) {
            echo json_encode(['success' => true, 'message' => "Issue book updated successfully!"]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to update issue book. Maybe data already exists!']);
        }
    } catch (PDOException $e) {
        // Handle database connection errors
        echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
    }
    exit;
}

//Delete by issue book id

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['issuebook_id']) && isset($_GET['action']) &&  $_GET['action'] == 'delete_issuebook') {

    try {
        $issuebook_id = $_GET['issuebook_id'];
        $issuebookModel = new Issuebook();
        $deleted = $issuebookModel->deleteIssuebook($issuebook_id);

        if ($deleted) {
            echo json_encode(['success' => true, 'message' => "Issued book details deleted successfully!", 'data' => $deleted]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to delete issued book details.']);
        }
    } catch (PDOException $e) {
        // Handle database connection errors
        echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
    }
    exit;
}