<?php

require_once 'BaseModel.php';

class Category extends BaseModel
{
    public $CategoryName;
    private $Status;



    protected function getTableName()
    {
        return "tblcategory";
    }

    protected function addNewRec()
    {
        $param = array(
            ':CategoryName' => $this->CategoryName,
            ':Status' => $this->Status
        );

        return $this->pm->run(
            "INSERT INTO " . $this->getTableName() . "(CategoryName,Status) values(:CategoryName, :Status)", $param);
    }

    protected function updateRec()
    {
        // Check if the new StudentId or EmailId already exists (excluding the current user's record)
        $existingCategory = $this->getCategoryByCategoryNameWithId($this->CategoryName,$this->id);
        if ($existingCategory) {
            // Handle the error (return an appropriate message or throw an exception)
            return false; // Or throw an exception with a specific error message
        }

        

        $param = array(
            ':CategoryName' => $this->CategoryName,
            ':Status' => $this->Status,
            ':id' => $this->id
        );
        return $this->pm->run(
            "UPDATE " . $this->getTableName() . " 
            SET 
                CategoryName = :CategoryName, 
                Status = :Status
            WHERE id = :id",
            $param
        );
    }

    public function getCategoryByCategoryNameWithId($CategoryName)
    {
        $param = array(':CategoryName' => $CategoryName);
        
        $query = "SELECT * FROM " . $this->getTableName() . " 
                  WHERE (CategoryName = :CategoryName)";

        $result = $this->pm->run($query, $param);

        return $result; // Return the category if found, or false if not found
    }

    function createCategory($CategoryName, $Status = 1)
    {
        $categoryModel = new Category();

        // Check if StudentId or EmailId already exists
        $existingCategory = $categoryModel->getCategoryByCategoryName($CategoryName);
        if ($existingCategory) {
            // Handle the error (return an appropriate message or throw an exception)
            return false; // Or throw an exception with a specific error message
        }

        $category = new Category();
        $category->CategoryName = $CategoryName;
        $category->Status = $Status;
        $category->addNewRec();

        if ($category) {
            return $category; // Category created successfully
        } else {
            return false; // Category creation failed (likely due to database error)
        }
    }

    function updateCategory($id, $CategoryName, $Status = 1)
    {
        $categoryModel = new Category();

        // Check if Category Name already exists
        $existingCategory = $categoryModel->getCategoryByCategoryNameWithId($CategoryName, $id);
        if ($existingCategory) {
            // Handle the error (return an appropriate message or throw an exception)
            return false; // Or throw an exception with a specific error message
        }

        $category = new Category();
        $category->id = $id;
        $category->CategoryName = $CategoryName;
        $category->Status = $Status;
        $category->updateRec();

        if ($category) {
            return true; // Category udapted successfully
        } else {
            return false; // Category update failed (likely due to database error)
        }
    }

    public function getCategoryByCategoryName($CategoryName)
    {
        $param = array(
            ':CategoryName' => $CategoryName
        );

        $sql = "SELECT * FROM " . $this->getTableName() . " WHERE CategoryName = :CategoryName";
        $result = $this->pm->run($sql, $param);

        if (!empty($result)) {  // Check if the array is not empty
            $student = $result[0]; // Assuming the first row contains the category data
            return $student;
        } else {
            return null;
        }
    }

    function deleteCategory($id)
    {
        $category = new Category();
        $category->deleteRec($id);

        if ($category) {
            return true; // Category udapted successfully
        } else {
            return false; // Category update failed (likely due to database error)
        }
    }

    public function getLastInsertedCategoryId()
    {
        $result = $this->pm->run('SELECT MAX(id) as lastInsertedId FROM tblcategory', null, true);
        return $result['lastInsertedId'] ?? 100;
    }
}
