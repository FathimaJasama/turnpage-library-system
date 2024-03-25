<?php
include __DIR__ . '/../config.php';
include __DIR__ . '/../helpers/AppManager.php';

$pm = AppManager::getPM();
$sm = AppManager::getSM();

$EmailId = $_POST['EmailId'];
$Password = $_POST['Password'];

if (empty($EmailId) || empty($Password)) {
    $sm->setAttribute("error", 'Please fill all required fields!');
    header("Location: " . $_SERVER['HTTP_REFERER']);
} else {
    $param = array(':EmailId' => $EmailId);
    $student = $pm->run("SELECT * FROM students WHERE EmailId = :EmailId", $param, true);
    if ($student != null) {
        $correct = Password_verify($Password, $student['Password']);
        if ($correct) {

            $sm->setAttribute("studentId", $student['id']);
            $sm->setAttribute("StudentId", $student['StudentId']);
            $sm->setAttribute("FullName", $student['FullName']);
            $sm->setAttribute("MobileNumber", $student['MobileNumber']);

            header('location: ../index-student.php');
            exit;
        } else {
            $sm->setAttribute("error", 'Invalid email or password!');
        }
    } else {
        $sm->setAttribute("error", 'Invalid email or password!');
    }
    header("Location: " . $_SERVER['HTTP_REFERER']);
}
exit;
