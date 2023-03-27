<?php
include '../scripts/db/connectToDatabase.php';
$nameInput = $_POST["nameInput"];
$passwordInput = $_POST["passwordInput"];
$password_hash = password_hash($passwordInput, PASSWORD_DEFAULT);

$q = "select username, password from user where username = '$nameInput'";
$result = mysqli_query($conn, $q);


if ((mysqli_num_rows($result) !== 0)) {
    while ($row = mysqli_fetch_assoc($result)) {
        $valid = password_verify($passwordInput, $row['password']);
        if ($valid) {
            echo "200"; //Credentials are correct - logged in
            session_start();
            $_SESSION['login_user'] = $nameInput;
        } else {
            echo "403"; //Password is invalid
        }
    }
} else {
    echo "404"; //Username is invalid/user doesn't exist
}
