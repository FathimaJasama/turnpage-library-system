<?php

/**
 * Project Name: Library
 * Author: Jasama Jahankeer
 */

class PersistanceManager
{
    private $pdo;

    public function __construct()
    {
        try {
            $this->pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USERNAME, DB_PASSWORD);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

            // Create a tables if it doesn't exist
            // $this->createTables();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    // public function createTables()
    // {
// table for tblbooks

        
        // $query_users = "CREATE TABLE IF NOT EXISTS `users` (
        //     `id` INT AUTO_INCREMENT PRIMARY KEY,
        //     `username` varchar(200) NOT NULL,
        //     `email` varchar(200) NOT NULL,
        //     `password` varchar(240) NOT NULL,
        //     `permission` enum('user','operator','doctor') NOT NULL DEFAULT 'user',
        //     `is_active` tinyint(5) NOT NULL DEFAULT 0,
        //     `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        //     `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        //     ) ENGINE=InnoDB DEFAULT COLLATE=utf8mb4_unicode_520_ci;";

        // $this->pdo->exec($query_users);

        // $query_tblbooks = "CREATE TABLE IF NOT EXISTS `tblbooks` (

        //     `id` int(11) NOT NULL AUTO_INCREMENT,
        //     `BookName` varchar(255) DEFAULT NULL,
        //     `CatId` int(11) DEFAULT NULL,
        //     `AuthorId` int(11) DEFAULT NULL,
        //     `ISBNNumber` varchar(25) DEFAULT NULL,
        //     `BookPrice` decimal(10,2) DEFAULT NULL,
        //     `bookImage` varchar(250) NOT NULL,
        //     `isIssued` int(1) DEFAULT NULL,
        //     `RegDate` timestamp NULL DEFAULT current_timestamp(),
        //     `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
        //     PRIMARY KEY (`id`)
        //     ) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;";

        // $this->pdo->exec($query_tblbooks);

        // $query_admin = "CREATE TABLE IF NOT EXISTS `admin` (
        //     `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
        //     `FullName` varchar(100) DEFAULT NULL,
        //     `AdminEmail` varchar(120) DEFAULT NULL,
        //     `UserName` varchar(100) NOT NULL,
        //     `Password` varchar(100) NOT NULL,
        //     `updationDate` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp()
        //     ) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;";

        // $this->pdo->exec($query_admin);

        // $query_tblcategory = "CREATE TABLE IF NOT EXISTS `tblcategory` (
        //     `id` int(11) NOT NULL AUTO_INCREMENT,
        //     `CategoryName` varchar(150) DEFAULT NULL,
        //     `Status` int(1) DEFAULT NULL,
        //     `CreationDate` timestamp NULL DEFAULT current_timestamp(),
        //     `UpdationDate` timestamp NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp(),
        //     PRIMARY KEY (`id`)
        //     ) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;";

        // $this->pdo->exec($query_tblcategory);

        // $query_tblissuedbookdetails = "CREATE TABLE IF NOT EXISTS `tblissuedbookdetails` (
        //     `id` int(11) NOT NULL AUTO_INCREMENT,
        //     `BookId` int(11) DEFAULT NULL,
        //     `StudentID` varchar(150) DEFAULT NULL,
        //     `IssuesDate` timestamp NULL DEFAULT current_timestamp(),
        //     `ReturnDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
        //     `RetrunStatus` int(1) DEFAULT NULL,
        //      `fine` int(11) DEFAULT NULL,
        //     PRIMARY KEY (`id`)
        //     ) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;";
        
        // $this->pdo->exec($query_tblissuedbookdetails);

        
        // $query_tblstudents = "CREATE TABLE IF NOT EXISTS `tblstudents` (
        //     `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
        //     `StudentId` varchar(100) DEFAULT NULL,
        //     `FullName` varchar(120) DEFAULT NULL,
        //     `EmailId` varchar(120) DEFAULT NULL,
        //     `MobileNumber` char(11) DEFAULT NULL,
        //     `Password` varchar(120) DEFAULT NULL,
        //     `Status` int(1) DEFAULT NULL,
        //     `RegDate` timestamp NULL DEFAULT current_timestamp(),
        //     `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
        // --   key start
        //     -- UNIQUE KEY `StudentId` (`StudentId`)
        //     ) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;";

        // $this->pdo->exec($query_tblstudents);

      

    // }

    public function getCount($query, $param = null)
    {
        $result = $this->executeQuery($query, $param, true);
        return $result['c'];
    }

    public function run($query, $param = null, $fetchFirstRecOnly = false)
    {
        return $this->executeQuery($query, $param, $fetchFirstRecOnly);
    }

    public function insertAndGetLastRowId($query, $param = null)
    {
        return $this->executeQuery($query, $param, true, true);
    }

    private function executeQuery($query, $param = null, $fetchFirstRecOnly = false, $getLastInsertedId = false)
    {
        try {
            $stmt = $this->pdo->prepare($query);
            $stmt->execute($param);

            if ($getLastInsertedId) {
                return $this->pdo->lastInsertId();
            }

            if ($fetchFirstRecOnly)
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
            else
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);


            $stmt->closeCursor();
            return $result;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return -1;
        }
    }
}
