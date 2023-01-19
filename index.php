<?php
include '../TodoList/utils/scripts/db/connectToDatabase.php';
include "../TodoList/utils/scripts/db/getUserID.php";

/* It checks if the user is logged in. If not, it redirects to the login page. */
if (!isset($_SESSION['login_user'])) {
    header("Location: auth/login.php");
}
/* Checking if the user is an admin or not. */
if (isset($_SESSION['login_user'])) {
    $username = $_SESSION['login_user'];
    $q = "SELECT roleID FROM user WHERE username = '$username'";
    $f = mysqli_fetch_assoc(mysqli_query($conn, $q));
    $adminState = $f['roleID'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>TodoList</title>
    <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1.0">
    <LINK REL=StyleSheet HREF="stylesheet.css" TYPE="text/css" MEDIA=screen>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="./utils/class/popups/popupHandler.js"></script>
    <script src="./utils/class/popups/taskManagePopup.js"></script>
    <script src="./utils/js/getDbData.js"></script>
    <script src="./utils/js/main_page_setup.js"></script>
    <script src="./utils/js/color_menu_utils.js"></script>
    <script src="./utils/js/profile_utils.js"></script>
    <script src="./utils/js/project_utils.js"></script>
    <script src="./utils/js/sidebar_utils.js"></script>
    <script src="./utils/js/board_utils.js"></script>
    <script src="./utils/class/Color.js"></script>
    <script src="./utils/class/Log.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">
</head>

<body id="body" class="flex w-screen h-screen flex-col">
    <?php
    include "./utils/load/main/loadNavbar.php";
    include "./utils/load/main/loadMainApp.php";
    include "./utils/load/main/loadProjectContainer.php";
    ?>

    <script>
        localStorage.clear();
    </script>
</body>
</html>