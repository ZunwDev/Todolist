<?php
include '../TodoList/src/scripts/db/connectToDatabase.php';
include "../TodoList/src/scripts/db/getUserID.php";

/* It checks if the user is logged in. If not, it redirects to the login page. */
if (!isset($_SESSION['login_user'])) {
    header("Location: src/auth/login.php");
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
    <!-- Managers -->
    <script src="./src/class/managers/LogManager.js"></script>
    <script src="./src/class/managers/ProjectManager.js"></script>
    <script src="./src/class/managers/BoardManager.js"></script>
    <!-- Handlers -->
    <script src="./src/class/handlers/popupHandler.js"></script>
    <script src="./src/class/handlers/warningHandler.js"></script>
    <!-- Popups -->
    <script src="./src/class/popups/task/taskManagePopup.js"></script>
    <script src="./src/class/popups/column/columnManagePopup.js"></script>
    <script src="./src/class/popups/task/taskEditPopup.js"></script>
    <script src="./src/class/popups/column/columnEditPopup.js"></script>
    <script src="./src/class/popups/project/projectEditPopup.js"></script>
    <script src="./src/class/popups/board/boardFilterPopup.js"></script>
    <script src="./src/class/popups/other/priorityPopup.js"></script>
    <script src="./src/class/popups/other/activityTimelinePopup.js"></script>
    <script src="./src/class/popups/project/projectCreatePopup.js"></script>
    <!-- Popups -> Warnings -->
    <script src="./src/class/popups/warnings/column/columnDelete.js"></script>
    <script src="./src/class/popups/warnings/column/columnClear.js"></script>
    <script src="./src/class/popups/warnings/project/projectDelete.js"></script>
    <script src="./src/class/popups/warnings/task/taskDelete.js"></script>
    <!-- Other -->
    <script src="./src/js/getDbData.js"></script>
    <script src="./src/js/main_page_setup.js"></script>
    <script src="./src/js/color_menu_utils.js"></script>
    <script src="./src/js/profile_utils.js"></script>
    <script src="./src/js/project_utils.js"></script>
    <script src="./src/js/board_utils.js"></script>
    <!-- Utils -->
    <script src="./src/class/utils/Color.js"></script>
    <!-- Links -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">
</head>

<body id="body" class="flex w-screen h-screen flex-col">
    <?php
    include "./src/load/main/loadNavbar.php";
    include "./src/load/main/loadMainApp.php";
    include "./src/load/main/loadProjectContainer.php";
    ?>
</body>

</html>