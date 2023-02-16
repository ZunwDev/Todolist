<?php
echo '<nav class="h-fit shadow-bottom shadow-lg flex w-screen relative z-30 py-1">';
echo '<div class="flex mx-12 justify-between w-screen">';
echo '<div class="flex my-auto gap-3 justify-start">';
echo '<button id="opensidebar" title="Open/close" type="button" class="p-1 hover:bg-slate-100 transition ease-out duration-200 rounded-lg" onclick="expandSidebar()">';
echo '<svg class="w-4 h-4 mx-auto fill-black" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">';
echo '<path d="M0 96C0 78.33 14.33 64 32 64H416C433.7 64 448 78.33 448 96C448 113.7 433.7 128 416 128H32C14.33 128 0 113.7 0 96zM0 256C0 238.3 14.33 224 32 224H416C433.7 224 448 238.3 448 256C448 273.7 433.7 288 416 288H32C14.33 288 0 273.7 0 256zM416 448H32C14.33 448 0 433.7 0 416C0 398.3 14.33 384 32 384H416C433.7 384 448 398.3 448 416C448 433.7 433.7 448 416 448z" />';
echo '</svg>';
echo '</button>';
echo '</div>';
echo '<div class="flex flex-shrink my-auto gap-3 text-xl justify-end">';
if (!isset($_SESSION['login_user'])) {
    echo '<a href="auth/login.php" type="button" class="h-fit w-fit px-1 py-1 hover:bg-slate-100 transition ease-out duration-200 rounded-lg break-normal font-bold">Log in</a>';
    echo '<a href="auth/signup.php" type="button" class="h-fit w-fit px-1 py-1 bg-blue-500 hover:bg-blue-400 transition ease-out duration-200 rounded-lg break-normal font-bold text-white">Sign Up</a>';
} else {
    if ($adminState != null) {
        echo '<div class="profileMenu flex flex-row gap-2 h-fit w-fit px-1 py-1 text-sm hover:bg-slate-100 transition ease-out duration-200 rounded-lg break-normal font-bold cursor-pointer" data-admin="' . $adminState . '">';
    }
    echo '<div class="flex">' . $_SESSION['login_user'] . '</div>';
    echo '</div>';
}
echo '</div>';
echo '</div>';
echo '</nav>';
