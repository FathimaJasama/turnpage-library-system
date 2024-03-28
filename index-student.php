<?php

include __DIR__ . '/config.php';
include __DIR__ . '/helpers/AppManager.php';

$sm = AppManager::getSM();
$FullName = $sm->getAttribute("FullName");

if (isset($FullName)) {
    header('location: views/admin/dashboard.php');
} else {
    header('location: views/auth/login-student.php');
}
