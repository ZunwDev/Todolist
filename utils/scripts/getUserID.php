<?php

session_start();
if (isset($_SESSION['login_user'])) {
    $username = $_SESSION['login_user'];
};
$userIDQuery = "select userID from user where username = '$username'";
$userIDFetch = mysqli_fetch_assoc(mysqli_query($conn, $userIDQuery));
$userID = $userIDFetch['userID'];
