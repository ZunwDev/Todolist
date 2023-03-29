<?php
include '../scripts/db/connectToDatabase.php';
$nameInput = $_POST["nameInput"];
$passwordInput = $_POST["passwordInput"];
$password_hash = password_hash($passwordInput, PASSWORD_DEFAULT);

$q = "select username, password from user where username = '$nameInput'";
$result = mysqli_query($conn, $q);


if (mysqli_num_rows($result) !== 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $validUsername = ($nameInput === $row['username']);
        $validPassword = password_verify($passwordInput, $row['password']);
        if (!$validUsername && !$validPassword) {
            echo "401"; // Password and username is incorrect
        }
        if (!$validPassword) {
            echo "403"; // Password is incorrect
        }
        if (!$validUsername) {
            echo "404"; //User doesnt exist/incorrect username
        }
        if ($validUsername && $validPassword) {
            echo "200"; //Credentials are correct - logged in
            session_start();
            $_SESSION['login_user'] = $nameInput;
        }
    }
} else {
    echo "401";
}
