<?php

require_once 'BaseModel.php';

class Student extends BaseModel
{
    public $StudentId;
    public $Photo;
    public $FullName;
    public $EmailId;
    private $MobileNumber;
    private $Password;
    private $Status;

    
    protected function getTableName()
    {
        return "students";
    }

    protected function addNewRec()
    {
        // Hash the password before storing it
        $this->Password = password_hash($this->Password, PASSWORD_DEFAULT);

        $param = array(
            ':StudentId' => $this->StudentId,
            ':Photo' => $this->Photo,
            ':FullName' => $this->FullName,
            ':EmailId' => $this->EmailId,
            ':Password' => $this->Password,
            ':MobileNumber' => $this->MobileNumber,
            ':Status' => $this->Status
        );

        return $this->pm->run("INSERT INTO " . $this->getTableName() . "(StudentId,Photo,FullName,Password,MobileNumber,EmailId,Status) values(:StudentId,:Photo, :FullName, :Password, :MobileNumber, :EmailId, :Status)", $param);
    }

    protected function updateRec()
    {
        // Check if the new StudentId or EmailId already exists (excluding the current user's record)
        $existingStudent = $this->getStudentByStudentIdOrEmailIdWithId($this->StudentId, $this->EmailId, $this->id);
        if ($existingStudent) {
            // Handle the error (return an appropriate message or throw an exception)
            return false; // Or throw an exception with a specific error message
        }

        // Hash the password if it is being updated
        if (!empty($this->Password)) {
            $this->Password = password_hash($this->Password, PASSWORD_DEFAULT);
        }

        $param = array(
            ':StudentId' => $this->StudentId,
            ':FullName' => $this->FullName,
            ':MobileNumber' => $this->MobileNumber,
            ':EmailId' => $this->EmailId,
            ':Status' => $this->Status,
            ':id' => $this->id
        );
        return $this->pm->run(
            "UPDATE " . $this->getTableName() . " 
            SET 
                StudentId = :StudentId, 
                FullName = :FullName, 
                EmailId = :EmailId,
                MobileNumber = :MobileNumber,
                Status = :Status
            WHERE id = :id",
            $param
        );
    }

    protected function updateRecProfile()
    {
        // Check if the new StudentId or EmailId already exists (excluding the current user's record)
        $existingStudent = $this->getStudentByStudentIdOrEmailIdWithId( $this->EmailId, $this->id);
        if ($existingStudent) {
            // Handle the error (return an appropriate message or throw an exception)
            return false; // Or throw an exception with a specific error message
        }

        $param = array(
            // ':StudentId' => $this->StudentId,
            ':Photo' => $this->Photo,
            ':FullName' => $this->FullName,
            // ':Password' => $this->Password,
            ':MobileNumber' => $this->MobileNumber,
            ':EmailId' => $this->EmailId,
            ':Status' => $this->Status,
            ':id' => $this->id
        );
        return $this->pm->run(
            "UPDATE " . $this->getTableName() . " 
            SET 
                Photo = :Photo, 
                FullName = :FullName, 
                EmailId = :EmailId,
                MobileNumber = :MobileNumber,
                Status = :Status
            WHERE id = :id",
            $param
        );
    }

    public function getStudentByStudentIdOrEmailIdWithId($StudentId, $EmailId, $excludeStudentId = null)
    {
        $param = array(':StudentId' => $StudentId, ':EmailId' => $EmailId);

        $query = "SELECT * FROM " . $this->getTableName() . " 
                  WHERE (StudentId = :StudentId OR EmailId = :EmailId)";

        if ($excludeStudentId !== null) {
            $query .= " AND id != :excludeStudentId";
            $param[':excludeStudentId'] = $excludeStudentId;
        }

        $result = $this->pm->run($query, $param);

        return $result; // Return the user if found, or false if not found
    }

    function createStudent($StudentId, $Photo, $FullName, $Password, $MobileNumber, $EmailId, $Status = 1)
    {
        $studentModel = new Student();

        // Check if StudentId or EmailId already exists
        $existingStudent = $studentModel->getStudentByStudentIdOrEmailId($StudentId, $EmailId);
        if ($existingStudent) {
            // Handle the error (return an appropriate message or throw an exception)
            return false; // Or throw an exception with a specific error message
        }

        $student = new Student();
        $student->StudentId = $StudentId;
        $student->Photo = $Photo;
        $student->FullName = $FullName;
        $student->Password = $Password;
        $student->MobileNumber = $MobileNumber;
        $student->EmailId = $EmailId;
        $student->Status = $Status;
        $student->addNewRec();

        if ($student) {
            return $student; // Student created successfully
        } else {
            return false; // Student creation failed (likely due to database error)
        }
    }

    function updateStudent($id, $StudentId, $FullName, $MobileNumber, $EmailId, $Status = 1)
    {
        $studentModel = new Student();

        // Check if StudentId or EmailId already exists
        $existingStudent = $studentModel->getStudentByStudentIdOrEmailIdWithId($StudentId, $EmailId, $id);
        if ($existingStudent) {
            // Handle the error (return an appropriate message or throw an exception)
            return false; // Or throw an exception with a specific error message
        }

        $student = new Student();
        $student->id = $id;
        $student->StudentId = $StudentId;
        $student->FullName = $FullName;
        $student->MobileNumber = $MobileNumber;
        $student->EmailId = $EmailId;
        $student->Status = $Status;
        $student->updateRec();

        if ($student) {
            return true; // User udapted successfully
        } else {
            return false; // User update failed (likely due to database error)
        }
    }


    function updateStudentDetails($id, $Photo, $FullName,  $EmailId, $MobileNumber, $Status = 1)
    {
        $studentModel = new Student();

        // Check if StudentId or EmailId already exists
        $existingStudent = $studentModel->getStudentByStudentIdOrEmailIdWithId( $EmailId, $id);
        if ($existingStudent) {
            // Handle the error (return an appropriate message or throw an exception)
            return false; // Or throw an exception with a specific error message
        }

        $student = new Student();
        $student->id = $id;
        $student->Photo = $Photo;
        $student->FullName = $FullName;
        $student->MobileNumber = $MobileNumber;
        $student->EmailId = $EmailId;
        $student->Status = $Status;
        $student->updateRecProfile();

        if ($student) {
            return true; // Student udapted successfully
        } else {
            return false; // Student update failed (likely due to database error)
        }
    }

    public function getStudentByStudentIdOrEmailId($StudentId, $EmailId)
    {
        $param = array(
            ':StudentId' => $StudentId,
            ':EmailId' => $EmailId
        );

        $sql = "SELECT * FROM " . $this->getTableName() . " WHERE StudentId = :StudentId OR EmailId = :EmailId";
        $result = $this->pm->run($sql, $param);

        if (!empty($result)) {  // Check if the array is not empty
            $student = $result[0]; // Assuming the first row contains the student data
            return $student;
        } else {
            return null;
        }
    }

    function deleteStudent($id)
    {
        $student = new Student();
        $student->deleteRec($id);

        if ($student) {
            return true; // Student udapted successfully
        } else {
            return false; // Student update failed (likely due to database error)
        }
    }

    public function getLastInsertedStudentId()
    {
        $result = $this->pm->run('SELECT MAX(id) as lastInsertedId FROM stdents', null, true);
        return $result['lastInsertedId'] ?? 100;
    }
}
