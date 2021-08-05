<?php
ob_start();
session_start();
$timezone = date_default_timezone_set('Asia/Dhaka');

$con = mysqli_connect('localhost', 'root', '', 'social');

if (mysqli_connect_errno()) {
    echo 'DB connection error: ' . mysqli_connect_errno();
}
