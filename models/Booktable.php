<?php

require_once 'BaseModel.php';

class Book extends BaseModel
{
    private $Publisher;
    public $BookName;
    public $AuthorName;
    public $ISBNNumber;
    public $BookPrice;
    public $BookImage;
    public $isIssued;
    public $category;

    protected function getTableName()
    {
        return "tblbooks";
    }

    protected function addNewRec()
    {

        $param = array(

        ':Publisher' => $this->Publisher,
        ':BookName' => $this->BookName,
        ':AuthorName' => $this->AuthorName,
        ':ISBNNumber' => $this->ISBNNumber,
        ':BookPrice' => $this->BookPrice,
        ':BookImage' => $this->BookImage,
        ':isIssued' => $this->isIssued,
        ':category' => $this->category     
        );

        return $this->pm->run("INSERT INTO " . $this->getTableName() . "(Publisher,BookName,AuthorName,ISBNNumber,BookPrice,BookImage,isIssued,category) values(:Publisher, :BookName, :AuthorName, :ISBNNumber, :BookPrice, :BookImage, :isIssued, :category)", $param);
    }

    protected function updateRec()
    {
        // Check if the new book or ISBN number already exists (excluding the current book's record)
        $existingBook = $this->getBookByBookNameOrISBNNumberWithId($this->BookName, $this->ISBNNumber, $this->id);
        if ($existingBook) {
            // Handle the error (return an appropriate message or throw an exception)
            return false; // Or throw an exception with a specific error message
        }

       
        $param = array(
        ':Publisher' => $this->Publisher,
        ':BookName' => $this->BookName,
        ':AuthorName' => $this->AuthorName,
        ':ISBNNumber' => $this->ISBNNumber,
        ':BookPrice' => $this->BookPrice,
        ':BookImage' => $this->BookImage,
        ':isIssued' => $this->isIssued,
        ':category' => $this->category,
        ':id' => $this->id
        );
        return $this->pm->run(
            "UPDATE " . $this->getTableName() . "
            SET 
                Publisher = :Publisher,
                BookName = :BookName,
                AuthorName = :AuthorName,
                ISBNNumber = :ISBNNumber,
                BookPrice = :BookPrice,
                BookImage = :BookImage,
                isIssued = :isIssued,
                category = :category 
            WHERE id = :id",
            $param
        );
    }

    public function getBookByBookNameOrISBNNumberWithId($BookName, $ISBNNumber, $excludeBookId = null)
    {
        $param = array(':BookName' => $BookName, ':ISBNNumber' => $ISBNNumber);

        $query = "SELECT * FROM " . $this->getTableName() . " 
                  WHERE (BookName = :BookName OR ISBNNumber = :ISBNNumber)";

        if ($excludeBookId !== null) {
            $query .= " AND id != :excludeBookId";
            $param[':excludeBookId'] = $excludeBookId;
        }

        $result = $this->pm->run($query, $param);

        return $result; // Return the Book if found, or false if not found
    }

    function createBook($Publisher,$BookName,$AuthorName,$ISBNNumber,$BookPrice,$BookImage,$category,$isIssued = 0)
    {
        $bookModel = new Book();

        // Check if Book or ISBNNumber already exists
        $existingBook = $bookModel->getBookByBookNameOrISBNNumber($BookName, $ISBNNumber);
        if ($existingBook) {
            // Handle the error (return an appropriate message or throw an exception)
            return false; // Or throw an exception with a specific error message
        }

        $book = new Book();
        $book->Publisher = $Publisher;
        $book->BookName = $BookName;
        $book->AuthorName = $AuthorName;
        $book->ISBNNumber = $ISBNNumber;
        $book->BookPrice = $BookPrice;
        $book->BookImage = $BookImage;
        $book->isIssued = $isIssued;
        $book->category = $category;
        $book->addNewRec();

        if ($book) {
            return $book; // User created successfully
        } else {
            return false; // User creation failed (likely due to database error)
        }
    }

    function updateBook($id,$Publisher,$BookName,$AuthorName,$ISBNNumber,$BookPrice,$BookImage,$category,$isIssued = 1)
    {
        $bookModel = new Book();

        // Check if Book Name or ISBN Number already exists
        $existingBook = $bookModel->getBookByBookNameOrISBNNumberWithId($BookName, $ISBNNumber, $id);
        if ($existingBook) {
            // Handle the error (return an appropriate message or throw an exception)
            return false; // Or throw an exception with a specific error message
        }

        $book = new Book();
        $book->id = $id;
        $book->Publisher = $Publisher;
        $book->BookName = $BookName;
        $book->AuthorName = $AuthorName;
        $book->ISBNNumber = $ISBNNumber;
        $book->BookPrice = $BookPrice;
        $book->BookImage = $BookImage;
        $book->isIssued = $isIssued;
        $book->category = $category;
        $book->updateRec();

        if ($book) {
            return true; // Book udapted successfully
        } else {
            return false; // Book update failed (likely due to database error)
        }
    }

    public function getBookByBookNameOrISBNNumber($BookName, $ISBNNumber)
    {
        $param = array(
            ':BookName' => $BookName,
            ':ISBNNumber' => $ISBNNumber
        );

        $sql = "SELECT * FROM " . $this->getTableName() . " WHERE BookName = :BookName OR ISBNNumber = :ISBNNumber";
        $result = $this->pm->run($sql, $param);

        if (!empty($result)) {  // Check if the array is not empty
            $book = $result[0]; // Assuming the first row contains the user data
            return $book;
        } else {
            return null;
        }
    }

    function deleteBook($id)
    {
        $book = new Book();
        $book->deleteRec($id);

        if ($book) {
            return true; // User udapted successfully
        } else {
            return false; // User update failed (likely due to database error)
        }
    }

    public function getLastInsertedBookId()
    {
        $result = $this->pm->run('SELECT MAX(id) as lastInsertedId FROM tblbooks', null, true);
        return $result['lastInsertedId'] ?? 100;
    }
}

