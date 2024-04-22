<?php

require_once 'BaseModel.php';

class Author extends BaseModel
{
    public $AuthorName;



    protected function getTableName()
    {
        return "tblauthors";
    }

    protected function addNewRec()
    {
        $param = array(
            ':AuthorName' => $this->AuthorName,
        );

        return $this->pm->run(
            "INSERT INTO " . $this->getTableName() . "(AuthorName) values(:AuthorName)", $param);
    }

    protected function updateRec()
    {
        // Check if the new StudentId or EmailId already exists (excluding the current user's record)
        $existingAuthor = $this->getAuthorByAuthorNameWithId($this->AuthorName,$this->id);
        if ($existingAuthor) {
            // Handle the error (return an appropriate message or throw an exception)
            return false; // Or throw an exception with a specific error message
        }

        

        $param = array(
            ':AuthorName' => $this->AuthorName,
            ':id' => $this->id
        );
        return $this->pm->run(
            "UPDATE " . $this->getTableName() . " 
            SET 
                AuthorName = :AuthorName
            WHERE id = :id",
            $param
        );
    }

    public function getAuthorByAuthorNameWithId($AuthorName)
    {
        $param = array(':AuthorName' => $AuthorName);
        
        $query = "SELECT * FROM " . $this->getTableName() . " 
                  WHERE (AuthorName = :AuthorName)";

        $result = $this->pm->run($query, $param);

        return $result; // Return the category if found, or false if not found
    }

    function createAuthor($AuthorName)
    {
        $authorModel = new Author();

        // Check if StudentId or EmailId already exists
        $existingAuthor = $authorModel->getAuthorByAuthorName($AuthorName);
        if ($existingAuthor) {
            // Handle the error (return an appropriate message or throw an exception)
            return false; // Or throw an exception with a specific error message
        }

        $author = new Author();
        $author->AuthorName = $AuthorName;
        $author->addNewRec();

        if ($author) {
            return $author; // Author created successfully
        } else {
            return false; // Author creation failed (likely due to database error)
        }
    }

    function updateAuthor($id, $AuthorName)
    {
        $authorModel = new Author();

        // Check if Category Name already exists
        $existingAuthor = $authorModel->getAuthorByAuthorNameWithId($AuthorName, $id);
        if ($existingAuthor) {
            // Handle the error (return an appropriate message or throw an exception)
            return false; // Or throw an exception with a specific error message
        }

        $author = new Author();
        $author->id = $id;
        $author->AuthorName = $AuthorName;
        $author->updateRec();

        if ($author) {
            return true; // Author udapted successfully
        } else {
            return false; // Author update failed (likely due to database error)
        }
    }

    public function getAuthorByAuthorName($AuthorName)
    {
        $param = array(
            ':AuthorName' => $AuthorName
        );

        $sql = "SELECT * FROM " . $this->getTableName() . " WHERE AuthorName = :AuthorName";
        $result = $this->pm->run($sql, $param);

        if (!empty($result)) {  // Check if the array is not empty
            $author = $result[0]; // Assuming the first row contains the author data
            return $author;
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
