<?php
include '../TodoList/utils/scripts/connectToDatabase.php';
include "../TodoList/utils/scripts/getUserID.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" name="TodoList Test Application" content="Learning new stuff">
    <title>TodoList</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <LINK REL=StyleSheet HREF="stylesheet.css" TYPE="text/css" MEDIA=screen>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="./utils/getDbData.js"></script>
    <script src="./utils/main_page_setup.js"></script>
    <script src="./utils/color_menu_utils.js"></script>
    <script src="./utils/profile_utils.js"></script>
    <script src="./utils/project_utils.js"></script>
    <script src="./utils/sidebar_utils.js"></script>
    <script src="./utils/board_utils.js"></script>
    <script src="./utils/class/Color.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">
</head>

<body id="body" class="flex w-screen h-screen flex-col">
    <?php
    include "./utils/loadNavbar.php";
    include "./utils/loadMainApp.php";
    include "./utils/loadProjectContainer.php";
    ?>
</body>

</html>