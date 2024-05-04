<?php

include_once('config.php');
// SQL query to fetch data from tblcategories table
$sql = "SELECT * FROM tblbooks WHERE category = 'General'";

$result = $conn->query($sql);

include_once('book.php')
?>
