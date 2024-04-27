<?php
require_once '../config.php';
require_once '../helpers/AppManager.php';
require_once '../models/Booktable.php';
require_once '../models/Student.php';
require_once '../models/category.php';
require_once '../models/Author.php';
require_once '../models/Message.php';



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

//update student
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'update_student') {
    try {
        $StudentId = $_POST['StudentId'];
        $Photo = $_FILES['Photo'];
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
            $updated =  $studentModel->updateStudent($id, $StudentId, $fileName, $FullName, $Password, $MobileNumber, $EmailId, $Status);
                
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

//Get book by id
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['book_id']) && isset($_GET['action']) &&  $_GET['action'] == 'get_book') {

    try {
        $book_id = $_GET['book_id'];
        $bookModel = new Book();
        $book = $bookModel->getById($book_id);
        if ($book) {
            echo json_encode(['success' => true, 'message' => "Book created successfully!", 'data' => $book]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to create student. May be student already exist!']);
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
        $StudentId = $_POST['StudentId'];
        $BookName = $_POST['BookName'];
        $AuthorName = $_POST['AuthorName'];
        $ISBNNumber = $_POST['ISBNNumber'];
        $BookPrice = $_POST['BookPrice'];
        $BookImage = $_FILES['bookImage'];
        $category = $_POST['category'];
        $isIssued = $_POST['isIssued'] == 1 ? 1 : 0;
        $id = $_POST['id'];

        // Validate inputs
        if (empty($StudentId) || empty($BookName) || empty($AuthorName) || empty($ISBNNumber) || empty($BookPrice) || empty($category)  ) {
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
            $updated =  $bookModel->updateBook($id, $StudentId,$BookName,$AuthorName, $ISBNNumber, $BookPrice, $fileName, $category, $isIssued);
                
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
                echo json_encode(['success' => true, 'message' => "Student updated successfully!"]);
            } else {
                echo json_encode(['success' => false, 'message' => 'Failed to update student. Maybe student already exists!']);
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
        $EmailId=$_POST['EmailId'];
        $Message=$_POST['Message'];

      
                // Create an instance of the Book model
                $messageModel = new Message();
                
                // Call the createStudent method with correct parameters
                $created =  $messageModel->createMessage($Name, $EmailId, $Message);
                
                if ($created) {
                    echo json_encode(['success' => true, 'message' => "Message has been sent successfully!"]);
                } else {
                    echo json_encode(['success' => false, 'message' => 'Failed to send message. There is error in server']);
                }
            
       
    } catch (PDOException $e) {
        // Handle database connection errors
        echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
    }
    exit;
}
