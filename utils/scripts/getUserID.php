<?php

function getUserIDFromUser()
{
    session_start();
    include "../TodoList/utils/scripts/connectToDatabase.php";
    if (isset($_SESSION['login_user'])) {
        $username = $_SESSION['login_user'];
    };
    $userIDQuery = "select userID from user where username = '$username'";
    $userIDFetch = mysqli_fetch_assoc(mysqli_query($conn, $userIDQuery));
    $userID = $userIDFetch['userID'];
    return $userID;
}
