<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$username = $_POST['username'];
$password = $_POST['password'];
$realname = $_POST['realname'];
$userType = "Employee";
$mobile = $_POST['mobile'];
$email = $_POST['email'];
$createDate = date("Y-m-d");
$status = '1';
$image = $_POST['image'];

// Connect to the database
$link = mysqli_connect('localhost', 'root', '', 'coffee');

if (!$link) {
    die("Connection failed: " . mysqli_connect_error());
}

// Validate input data
if (empty($username) || empty($password) || empty($realname) || empty($mobile) || empty($email) || empty($image)) {
    echo "<script>alert('Please fill in all fields.');</script>";
    echo "<script>window.location='register.php';</script>";
    exit();
}

// Hash the password for security
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Prepare SQL statement
$sql = "INSERT INTO user(username, password, realname, userType, mobile, email, createDate, image, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = mysqli_prepare($link, $sql);

if ($stmt) {
    mysqli_stmt_bind_param($stmt, 'sssssssss', $username, $hashed_password, $realname, $userType, $mobile, $email, $createDate, $image, $status);
    
    if (mysqli_stmt_execute($stmt)) {
        echo "<script>alert('Registration completed successfully. You can now log in.');</script>";
        echo "<script>window.location='showprofile.php?username=" . urlencode($username) . "';</script>";
    } else {
        echo "<script>alert('Error: " . mysqli_error($link) . ". Please try again.');</script>";
        echo "<script>window.location='register.php';</script>";
    }
    
    mysqli_stmt_close($stmt);
} else {
    echo "<script>alert('SQL Prepare Error: " . mysqli_error($link) . "');</script>";
    echo "<script>window.location='register.php';</script>";
}

mysqli_close($link);
?>
