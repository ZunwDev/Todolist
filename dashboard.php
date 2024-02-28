<?php
include 'src/scripts/db/connectToDatabase.php';
include 'src/scripts/db/getUserID.php';

if (isset($_SESSION['login_user'])) {
    $username = $_SESSION['login_user'];
    $q = "SELECT roleID FROM user WHERE username = '$username'";
    $f = mysqli_fetch_assoc(mysqli_query($conn, $q));
    $adminState = $f['roleID'];
} else {
    header("Location: https://xtodolist.tode.cz/src/auth/login.php");
}

if ($adminState != 1) {
    header("Location: https://xtodolist.tode.cz/index.php");
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
    <script src="./src/class/managers/BoardManager.js"></script>
    <script src="./src/js/board_utils.js"></script>
    <script src="./src/js/main_page_setup.js"></script>
    <script src="./src/js/profile_utils.js"></script>
    <script src="./src/class/handlers/popupHandler.js"></script>
    <script src="./src/js/getDbData.js"></script>
    <script src="./src/class/handlers/warningHandler.js"></script>
    <script src="./src/class/popups/warnings/dashboard/userDelete.js"></script>
    <script src="./src/class/popups/other/profileMenuPopup.js"></script>
    <script src="./src/class/managers/DashboardManager.js"></script>
    <script src="./src/js/dashboard_utils.js"></script>
    <!-- Links -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">
</head>

<body id="body" onload="hideSidebarBtn()" class="w-screen h-screen flex flex-col">
    <?php
    include "./src/load/main/loadNavbar.php";
    include "./src/load/dashboard/loadOverallMetrics.php";
    ?>
</body>

</html>