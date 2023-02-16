<?php
include '../scripts/db/connectToDatabase.php';
$nameInput = $_POST["nameInput"];
$passwordInput = $_POST["passwordInput"];
$password_hash = password_hash($passwordInput, PASSWORD_DEFAULT);

$q = "select username from user where username = '$nameInput'";
$result = mysqli_query($conn, $q);

if ((mysqli_num_rows($result) === 0)) {
    $q = "insert into user (username, password, roleID, createdAt) values ('$nameInput', '$password_hash', 0, " . date("Y-m-d") . ")";
    $result = mysqli_query($conn, $q);
    if ($result) {
        echo "200"; //Account created
        session_start();
        $_SESSION['login_user'] = $nameInput;
    } else {
        echo "500"; //An error occured when creating new user
    }
} else {
    echo "404"; //User already exists in a database
}
