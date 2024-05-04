<?php

require_once 'BaseModel.php';

class Issuebook extends BaseModel
{
    public $BookId;
    public $StudentID;
    // public $IssueDate;
    public $ReturnDate;
    public $ReturnStatus;
    public $fine;



    protected function getTableName()
    {
        return "tblissuedbookdetail";
    }

    protected function addNewRec()
    {

        $param = array(
            ':BookId' => $this->BookId,
            ':StudentId' => $this->StudentID,
            // ':IssueDate' => $this->IssueDate,
            ':ReturnDate' => $this->ReturnDate,
            ':ReturnStatus' => $this->ReturnStatus,
            ':fine' => $this->fine
        );

        return $this->pm->run("INSERT INTO " . $this->getTableName() . "(BookId,StudentID,ReturnDate,ReturnStatus,fine) values(:BookId, :StudentId, :ReturnDate, :ReturnStatus, :fine)", $param);
    }

    protected function updateRec()
    {


        $param = array(
            ':BookId' => $this->BookId,
            ':StudentID' => $this->StudentID,
            ':ReturnDate' => $this->ReturnDate,
            ':ReturnStatus' => $this->ReturnStatus,
            ':fine' => $this->fine,
            ':id' => $this->id
        );
        return $this->pm->run(
            "UPDATE " . $this->getTableName() . " 
            SET 
                BookId = :BookId, 
                StudentID = :StudentID, 
                ReturnDate = :ReturnDate,
                ReturnStatus = :ReturnStatus,
                fine = :fine
            WHERE id = :id",
            $param
        );
    }

    function createIssuebook($BookId, $StudentID, $ReturnStatus = 0)
    {

        $issuebook = new Issuebook();
        $issuebook->BookId = $BookId;
        $issuebook->StudentID = $StudentID;
        $issuebook->ReturnStatus = $ReturnStatus;
        $issuebook->addNewRec();

        if ($issuebook) {
            return $issuebook; // Issue book created successfully
        } else {
            return false; // issue book creation failed (likely due to database error)
        }
    }

    function updateIssuebook($id, $BookId, $StudentID, $ReturnDate, $ReturnStatus=0, $fine)
    {

        $issuebook = new Issuebook();
        $issuebook->id = $id;
        $issuebook->BookId = $BookId;
        $issuebook->StudentID = $StudentID;
        $issuebook->ReturnDate = $ReturnDate;
        $issuebook->ReturnStatus = $ReturnStatus;
        $issuebook->fine = $fine;
        $issuebook->updateRec();

        if ($issuebook) {
            return true; // Issued Book udapted successfully
        } else {
            return false; // Issued Book update failed (likely due to database error)
        }
    }


    function deleteIssuebook($id)
    {
        $issuebook = new Issuebook();
        $issuebook->deleteRec($id);

        if ($issuebook) {
            return true; // Issued book udapted successfully
        } else {
            return false; // Issued book update failed (likely due to database error)
        }
    }

    public function getLastInsertedIssuedbookId()
    {
        $result = $this->pm->run('SELECT MAX(id) as lastInsertedId FROM tblissuedbookdetails', null, true);
        return $result['lastInsertedId'] ?? 100;
    }
}
