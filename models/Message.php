<?php

require_once 'BaseModel.php';

class Message extends BaseModel
{
    public $Name;
    public $EmailId;
    public $Message;
    
    protected function getTableName()
    {
        return "support";
    }

    protected function addNewRec()
    {

        $param = array(

            ':Name' => $this->Name,
            ':EmailId' => $this->EmailId,
            ':Message' => $this->Message
        );

        return $this->pm->run("INSERT INTO " . $this->getTableName() . "(Name,EmailId,Message) values(:Name, :EmailId, :Message)", $param);
    }

    protected function updateRec()
    {
        

       
        $param = array(
        ':Name' => $this->Name,
        ':EmailId' => $this->EmailId,
        ':Message' => $this->Message,
        ':id' => $this->id
        );
        return $this->pm->run(
            "UPDATE " . $this->getTableName() . "
            SET 
                Name = :Name,
                EmailId = :EmailId,
                Message = :Message 
            WHERE id = :id",
            $param
        );
    }

  

    function createMessage($Name,$EmailId,$Message)
    {
        $messageModel = new Message();

        // Check if StudentId or EmailId already exists
        $existingMessage = $messageModel->getMessageByMessageInfo($Message);
        if ($existingMessage) {
            // Handle the error (return an appropriate message or throw an exception)
            return false; // Or throw an exception with a specific error message
        }
       

        $message = new Message();
        $message->Name = $Name;
        $message->EmailId = $EmailId;
        $message->Message = $Message;
        $message->addNewRec();

        if ($message) {
            return $message; // User created successfully
        } else {
            return false; // User creation failed (likely due to database error)
        }
    }

    // function updateMessage($id,$StudentId,$BookName,$AuthorName,$ISBNNumber,$BookPrice,$BookImage,$category,$isIssued = 1)
    // {
    //     $bookModel = new Book();

       

    //     $book = new Book();
    //     $book->id = $id;
    //     $book->StudentId = $StudentId;
    //     $book->BookName = $BookName;
    //     $book->AuthorName = $AuthorName;
    //     $book->ISBNNumber = $ISBNNumber;
    //     $book->BookPrice = $BookPrice;
    //     $book->BookImage = $BookImage;
    //     $book->isIssued = $isIssued;
    //     $book->category = $category;
    //     $book->updateRec();

    //     if ($book) {
    //         return true; // Book udapted successfully
    //     } else {
    //         return false; // Book update failed (likely due to database error)
    //     }
    // }

    public function getMessageByMessageInfo($Message)
    {
        $param = array(
            ':Message' => $Message,
        );

        $sql = "SELECT * FROM " . $this->getTableName() . " WHERE Message = :Message";
        $result = $this->pm->run($sql, $param);

        if (!empty($result)) {  // Check if the array is not empty
            $message = $result[0]; // Assuming the first row contains the user data
            return $message;
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

