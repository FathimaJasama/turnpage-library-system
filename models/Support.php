<?php

require_once 'BaseModel.php';

class Support extends BaseModel
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
            ':Message' => $this->Message,

        );

        return $this->pm->run(
            "INSERT INTO " . $this->getTableName() . "(Name,EmailId,Message) values(:Name,:EmailId,:Message)", $param);
    }

    protected function updateRec()
    {
        // Check if the new StudentId or EmailId already exists (excluding the current user's record)
        $existingMessage = $this->getMessageByMessageInfo($this->Message);
        if ($existingMessage) {
            // Handle the error (return an appropriate message or throw an exception)
            return false; // Or throw an exception with a specific error message
        }

        

        $param = array(
            ':Name' => $this->Name,
            ':id' => $this->id
        );
        return $this->pm->run(
            "UPDATE " . $this->getTableName() . " 
            SET 
                Name = :Name
            WHERE id = :id",
            $param
        );
    }

    public function getMessageByMessageInfo($Message)
    {
        $param = array(':Message' => $Message);
        
        $query = "SELECT * FROM " . $this->getTableName() . " 
                  WHERE (Message = :Message)";

        $result = $this->pm->run($query, $param);

        return $result; // Return the category if found, or false if not found
    }

    function createMessage($Message)
    {
        $messageModel = new Message();

        // Check if StudentId or EmailId already exists
        $existingMessage = $messageModel->getMessageByMessageInfo($Message);
        if ($existingMessage) {
            // Handle the error (return an appropriate message or throw an exception)
            return false; // Or throw an exception with a specific error message
        }

        $message = new Message();
        $message->Name = $Message;
        $message->addNewRec();

        if ($message) {
            return $message; // Author created successfully
        } else {
            return false; // Author creation failed (likely due to database error)
        }
    }

    function updateMessage($id, $Name)
    {
        $messageModel = new Message();

        // Check if Category Name already exists
        $existingMessage = $messageModel->getMessageByMessageInfo($Name, $id);
        if ($existingMessage) {
            // Handle the error (return an appropriate message or throw an exception)
            return false; // Or throw an exception with a specific error message
        }

        $message = new Message();
        $message->id = $id;
        $message->Name = $Name;
        $message->updateRec();

        if ($message) {
            return true; // Author udapted successfully
        } else {
            return false; // Author update failed (likely due to database error)
        }
    }

    public function getMessageByMessageInfo($Message)
    {
        $param = array(
            ':Message' => $Message
        );

        $sql = "SELECT * FROM " . $this->getTableName() . " WHERE Name = :Name";
        $result = $this->pm->run($sql, $param);

        if (!empty($result)) {  // Check if the array is not empty
            $author = $result[0]; // Assuming the first row contains the author data
            return $message;
        } else {
            return null;
        }
    }

    function deleteAuthor($id)
    {
        $author = new Author();
        $author->deleteRec($id);

        if ($author) {
            return true; // Author udapted successfully
        } else {
            return false; // Author update failed (likely due to database error)
        }
    }

    public function getLastInsertedAuthorId()
    {
        $result = $this->pm->run('SELECT MAX(id) as lastInsertedId FROM tblauthors', null, true);
        return $result['lastInsertedId'] ?? 100;
    }
}
