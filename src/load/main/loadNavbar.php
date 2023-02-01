<?php
echo '<nav class="h-fit shadow-bottom shadow-lg flex w-screen relative z-30">';
echo '<div class="flex flex-grow mx-12 justify-between w-screen">';
echo '<div class="flex flex-shrink my-auto gap-3 justify-start">';
echo '<button id="opensidebar" title="Open/close" type="button" class="p-1 hover:bg-slate-100 transition ease-out duration-200 rounded-lg" onclick="expandSidebar()">';
echo '<svg class="w-4 h-4 mx-auto fill-black" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">';
echo '<path d="M0 96C0 78.33 14.33 64 32 64H416C433.7 64 448 78.33 448 96C448 113.7 433.7 128 416 128H32C14.33 128 0 113.7 0 96zM0 256C0 238.3 14.33 224 32 224H416C433.7 224 448 238.3 448 256C448 273.7 433.7 288 416 288H32C14.33 288 0 273.7 0 256zM416 448H32C14.33 448 0 433.7 0 416C0 398.3 14.33 384 32 384H416C433.7 384 448 398.3 448 416C448 433.7 433.7 448 416 448z" />';
echo '</svg>';
echo '</button>';
echo '</div>';
echo '<div class="flex flex-shrink my-auto gap-3 text-xl justify-end">';
if (!isset($_SESSION['login_user'])) {
    echo '<a href="auth/login.php" type="button" class="h-fit w-fit px-2 py-2 hover:bg-slate-100 transition ease-out duration-200 rounded-lg break-normal font-bold">Log in</a>';
    echo '<a href="auth/signup.php" type="button" class="h-fit w-fit px-2 py-2 min-w-16 bg-blue-500 hover:bg-blue-400 transition ease-out duration-200 rounded-lg break-normal font-bold text-white">Sign Up</a>';
} else {
    echo '<div class="flex h-fit w-fit px-1 py-1 text-sm hover:bg-slate-100 transition ease-out duration-200 rounded-lg break-normal font-bold cursor-pointer" onclick="showProfileMenu()">';
    echo '' . $_SESSION['login_user'] . '';
    echo '</div>';
    echo '<ul id="profile_dropdown" class="absolute flex flex-col bg-slate-50 py-1 w-48 h-fit mt-[3.3rem] border border-gray-300 shadow-lg" style="display: none">';
    if ($adminState == 1) {
        echo '<li onclick="openDashboard()" class="flex text-gray-600 hover:bg-slate-200 py-2 cursor-pointer"><svg class="w-6 h-6 my-auto fill-gray-600 mr-2 ml-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M0 96C0 60.7 28.7 32 64 32H448c35.3 0 64 28.7 64 64V416c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V96zm64 64V416H224V160H64zm384 0H288V416H448V160z"/></svg>Dashboard</li>';
    }
    echo '<li onclick="userLogOut()" class="flex text-red-600 hover:bg-slate-200 py-2 cursor-pointer"><svg class="w-6 h-6 my-auto fill-red-600 mr-2 ml-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><!--! Font Awesome Pro 6.1.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M560 448H512V113.5c0-27.25-21.5-49.5-48-49.5L352 64.01V128h96V512h112c8.875 0 16-7.125 16-15.1v-31.1C576 455.1 568.9 448 560 448zM280.3 1.007l-192 49.75C73.1 54.51 64 67.76 64 82.88V448H16c-8.875 0-16 7.125-16 15.1v31.1C0 504.9 7.125 512 16 512H320V33.13C320 11.63 300.5-4.243 280.3 1.007zM232 288c-13.25 0-24-14.37-24-31.1c0-17.62 10.75-31.1 24-31.1S256 238.4 256 256C256 273.6 245.3 288 232 288z"/></svg>Log out</li>';
    echo '</ul>';
}
echo '</div>';
echo '</div>';
echo '</nav>';
