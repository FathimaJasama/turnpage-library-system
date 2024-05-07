/*
SQLyog Community v13.1.7 (64 bit)
MySQL - 10.4.32-MariaDB : Database - library
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`library` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;

USE `library`;

/*Table structure for table `students` */

DROP TABLE IF EXISTS `students`;

CREATE TABLE `students` (
  `Photo` varchar(250) DEFAULT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `StudentId` varchar(100) DEFAULT NULL,
  `FullName` varchar(120) DEFAULT NULL,
  `EmailId` varchar(120) DEFAULT NULL,
  `MobileNumber` char(11) DEFAULT NULL,
  `Password` varchar(120) DEFAULT NULL,
  `Status` int(1) DEFAULT NULL,
  `RegDate` timestamp NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `StudentId` (`StudentId`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `students` */

insert  into `students`(`Photo`,`id`,`StudentId`,`FullName`,`EmailId`,`MobileNumber`,`Password`,`Status`,`RegDate`,`UpdationDate`) values 
('66364c254a68a_user7.png',2,'946172073v','Karthick','admin@gmail.com','0325683749','$2y$10$0.ApZWiFx4xRgsxdQQ/YcOlZJ70GUHv1KRiFUUMejxhCDTUdZx4i.',1,'2024-04-26 16:35:31','2024-05-04 20:28:46'),
('6633d45cf098e_user2.png',5,'935467890v','Fathima','fathima@gmail.com','0715683747','$2y$10$ojg7Ud9Y1443jBPsBIHQ1Osuyq6d/Q4IVLhnIdtEDMLdqUeTYfrxC',0,'2024-04-30 15:19:43','2024-05-04 16:17:42'),
('66363406a6598_user21.png',6,'98432678v','Hema ','hema@gmail.com','0776547890','$2y$10$Eslr3997diifeLTCsTNdQOfvDaO0AL0H5Aki7OYLt6N3An4vrywke',0,'2024-05-03 11:24:05','2024-05-04 20:28:23'),
('663610c7c53bb_user6.png',7,'9786789v','Pavi Rajendran','pavi@gmail.com','0714352678','$2y$10$.3P2TU4mS3xxp/QfzCvfCOic3i1X1ws232zeuDl23hy5Lejy82Duy',0,'2024-05-04 16:11:12','2024-05-04 18:40:24'),
('66363479bb987_user16.png',8,'7654231v','uventhi shivanantham','uventhi@gmail.com','0712154554','$2y$10$iIP6N0B8xKDe6/EDhba0G.66Uv11lDJmVt.ZYI08NAT2ZdtHjrwgi',1,'2024-05-04 18:43:30',NULL),
('66364db42579e_user16.png',9,'98765432v','Mega','mega@gmail.com','0765432178','$2y$10$rkfJhc/ZxlHqbd9qI0eOCOfMkGpJ2xt5.WkGV.olaAHnFupgccydq',1,'2024-05-04 20:31:08',NULL),
('66365d4bccb28_user6.png',10,'8765432v','reshma','reshma@gmail.com','0724356789','$2y$10$NxYjzUlxGjqETEbfltieY.xjKXih4TgxySi0A1zHSJUK5ME/19gpe',1,'2024-05-04 21:37:40',NULL);

/*Table structure for table `support` */

DROP TABLE IF EXISTS `support`;

CREATE TABLE `support` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(50) NOT NULL,
  `EmailId` varchar(50) NOT NULL,
  `Message` varchar(250) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `support` */

insert  into `support`(`id`,`Name`,`EmailId`,`Message`,`created_at`) values 
(13,'Hema','hema@gmail.com','Good Job','2024-05-03 11:26:22'),
(14,'pavi','pavi@gmail.com','Good Job','2024-05-04 16:13:46'),
(15,'hema','hema@gmail.com','Well done','2024-05-04 18:42:19'),
(16,'hema','hema@gmail.com','Hi','2024-05-04 20:29:59');

/*Table structure for table `tblauthors` */

DROP TABLE IF EXISTS `tblauthors`;

CREATE TABLE `tblauthors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `AuthorName` varchar(159) DEFAULT NULL,
  `creationDate` timestamp NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `tblauthors` */

insert  into `tblauthors`(`id`,`AuthorName`,`creationDate`,`UpdationDate`) values 
(2,'Steve McConnell','2024-01-25 12:53:03','2024-05-02 23:24:09'),
(3,'Marijn Haverbeken','2024-01-25 12:53:03','2024-05-03 11:19:28'),
(4,'Yukihiro Matsumoto','2024-01-25 12:53:03','2024-05-02 23:24:59'),
(5,'Kathy Sierra and Bert Bates','2024-01-25 12:53:03','2024-05-02 23:25:17'),
(9,'Martin Fowler','2024-01-25 12:53:03','2024-05-02 23:25:40'),
(10,'Robert C. Martin','2024-01-25 12:53:03','2024-05-02 23:25:58'),
(11,'Dennis M. Ritchie','2024-01-25 12:53:03','2024-05-02 23:26:17'),
(12,'Robert T. Kiyosak','2024-01-25 12:53:03','2024-02-04 12:04:26'),
(14,'Kalvin','2024-05-04 16:16:58',NULL),
(15,'Murach','2024-05-04 18:39:46',NULL),
(16,'jasala','2024-05-04 18:48:18',NULL);

/*Table structure for table `tblbooks` */

DROP TABLE IF EXISTS `tblbooks`;

CREATE TABLE `tblbooks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `BookName` varchar(255) DEFAULT NULL,
  `category` varchar(50) DEFAULT NULL,
  `AuthorName` varchar(100) DEFAULT NULL,
  `ISBNNumber` varchar(25) DEFAULT NULL,
  `BookPrice` decimal(10,2) DEFAULT NULL,
  `bookImage` varchar(250) NOT NULL,
  `isIssued` int(1) DEFAULT NULL,
  `RegDate` timestamp NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `Publisher` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `tblbooks` */

insert  into `tblbooks`(`id`,`BookName`,`category`,`AuthorName`,`ISBNNumber`,`BookPrice`,`bookImage`,`isIssued`,`RegDate`,`UpdationDate`,`Publisher`) values 
(1,'WordPress','Programming','Murach','1876',226.00,'6634f7a391351_WordPress for Beginners 2022 A Visual Step-by-Step Guide to Mastering WordPress.jpg',1,'2024-05-03 11:21:45','2024-05-03 20:11:39','WordPressPublishers'),
(5,'Murach\'s MySQL','Programming','Marijn Haverbeke','9350237695',455.00,'66338500f0cd3_Murach\'s MySQL.jpg',1,'2024-01-30 12:53:03','2024-05-02 17:50:16','Harper Collins'),
(6,'WordPress for Beginners 2022: A Visual Step-by-Step Guide to Mastering WordPress','Programming','Yukihiro Matsumoto','3467',100.00,'6633851a151d1_WordPress for Beginners 2022 A Visual Step-by-Step Guide to Mastering WordPress.jpg',1,'2024-01-30 12:53:03','2024-05-02 17:50:42','Simon and Schuster'),
(7,'WordPress Mastery Guide:','Programming','Kathy Sierra and Bert Bates','7890',53.00,'6633854b99eb3_WordPress Mastery Guide.jpg',0,'2024-01-30 12:53:03','2024-05-02 17:51:31','Macmillan Publishers'),
(9,'The Girl Who Drank the Moon','Romantic','Robert C. Martin','1848126476',200.00,'66338584c9844_The Girl Who Drank the Moon.jpg',0,'2024-01-30 12:53:03','2024-05-02 17:52:28','Scholastic '),
(10,'C++: The Complete Reference, 4th Edition','Programming','Dennis M. Ritchie','654',142.00,'663386f642cc1_C++ The Complete Reference, 4th Edition.jpg',0,'2024-01-30 12:53:03','2024-05-02 17:58:38','Houghton Mifflin Harcourt'),
(11,'ASP.NET Core 5 for Beginners','Programming','Martin Fowler','4382',422.00,'6634f92c355c2_ASP.NET Core 5 for Beginners.jpg',0,'2024-01-30 12:53:03','2024-05-03 20:18:12','Hachette Book Group'),
(15,'Strategic Management','Management','Frank T. Rothermail','2345',129.00,'6634fa24e0edd_Strategic Management.PNG',0,'2024-05-03 20:22:20',NULL,'Penguin Random House'),
(16,'Science and Technology','Technology','Ravi P.Agrahari','9807',65.00,'66364c9ab2401_Science and technology.PNG',1,'2024-05-03 21:00:46','2024-05-04 20:26:26','WordPressPublishers'),
(17,'Philosophy of Technology','Technology','Jan Hoogland','1245',98.00,'663503dd41769_Philosophy of Technology.PNG',0,'2024-05-03 21:03:49',NULL,'Harper Collins'),
(18,'Brigerton The Duck and I','Romantic','Julia Quinn','875',67.00,'663507cdc6226_Bridgerton The Duke and I.PNG',0,'2024-05-03 21:20:37',NULL,'Harper Collins'),
(21,'Basic Management Skills','Management','Murach','653',12.00,'66364c7982969_Basic management skills.PNG',0,'2024-05-04 20:25:53',NULL,'WordPressPublishers');

/*Table structure for table `tblcategory` */

DROP TABLE IF EXISTS `tblcategory`;

CREATE TABLE `tblcategory` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `CategoryName` varchar(150) DEFAULT NULL,
  `Status` int(1) DEFAULT NULL,
  `CreationDate` timestamp NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `tblcategory` */

insert  into `tblcategory`(`id`,`CategoryName`,`Status`,`CreationDate`,`UpdationDate`) values 
(4,'Romantic',1,'2024-01-31 12:53:03','2024-02-04 12:03:43'),
(5,'Technology',1,'2024-01-31 12:53:03','2024-02-04 12:03:51'),
(6,'Science',1,'2024-01-31 12:53:03','2024-02-04 12:03:51'),
(7,'Management',1,'2024-01-31 12:53:03','2024-02-04 12:03:51'),
(13,'Novels',1,'2024-05-04 20:27:58',NULL);

/*Table structure for table `tblissuedbookdetail` */

DROP TABLE IF EXISTS `tblissuedbookdetail`;

CREATE TABLE `tblissuedbookdetail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `BookId` int(11) DEFAULT NULL,
  `StudentID` varchar(150) DEFAULT NULL,
  `IssuesDate` timestamp NULL DEFAULT current_timestamp(),
  `ReturnDate` date DEFAULT NULL,
  `ReturnStatus` int(1) DEFAULT NULL,
  `fine` float(10,2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `tblissuedbookdetail` */

insert  into `tblissuedbookdetail`(`id`,`BookId`,`StudentID`,`IssuesDate`,`ReturnDate`,`ReturnStatus`,`fine`) values 
(1,254354,'253562','2024-04-29 00:00:00','2024-06-08',1,0.90),
(2,7374,'935467890v','2024-05-03 00:00:00','2024-05-07',1,NULL),
(7,634,'98432678v','2024-05-04 11:00:24','2024-06-07',0,10.00),
(8,7374,'946172073v','2024-05-04 18:39:11','2024-05-30',1,0.00),
(9,634,'947174076v','2024-05-04 20:27:04','2024-06-04',1,5.54);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
