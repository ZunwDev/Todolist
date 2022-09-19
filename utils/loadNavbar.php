<?php
echo '<nav class="app_navbarContainer h-fit pb-2 pt-2 shadow-bottom shadow-lg flex w-screen relative z-30">';
    echo '<div class="app_mainNavContainer flex flex-grow mx-12 justify-between w-screen">';
    echo '<div class="app_mainNav flex flex-shrink my-auto gap-3 justify-start">';
    echo '<button id="opensidebar" title="Open/close - M" type="button" class="h-9 w-9 hover:bg-slate-100 transition ease-out duration-200 rounded-lg" onclick="expandSidebar()">';
    echo '<svg class="w-6 h-6 mx-auto fill-black" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">';
    echo '<path d="M0 96C0 78.33 14.33 64 32 64H416C433.7 64 448 78.33 448 96C448 113.7 433.7 128 416 128H32C14.33 128 0 113.7 0 96zM0 256C0 238.3 14.33 224 32 224H416C433.7 224 448 238.3 448 256C448 273.7 433.7 288 416 288H32C14.33 288 0 273.7 0 256zM416 448H32C14.33 448 0 433.7 0 416C0 398.3 14.33 384 32 384H416C433.7 384 448 398.3 448 416C448 433.7 433.7 448 416 448z" />';
    echo '</svg>';
    echo '</button>';
    echo '</div>';
    echo '<div class="app_authNav flex flex-shrink my-auto gap-3 text-xl justify-end select-none">';
    if (!isset($_SESSION['login_user'])) {
        echo '<a href="auth/login.php" type="button" class="h-fit w-fit px-2 py-2 hover:bg-slate-100 transition ease-out duration-200 rounded-lg break-normal font-bold">Log in</a>';
        echo '<a href="auth/signup.php" type="button" class="h-fit w-fit px-2 py-2 min-w-16 bg-blue-500 hover:bg-blue-400 transition ease-out duration-200 rounded-lg break-normal font-bold text-white">Sign Up</a>';
    } else {
        echo '<div class="flex h-fit w-fit px-2 py-2 hover:bg-slate-100 transition ease-out duration-200 rounded-lg break-normal font-bold cursor-pointer" onclick="showProfileMenu()">';
        echo '' . $_SESSION['login_user'] . '';
        echo '</div>';
        echo '<ul id="profile_dropdown" class="absolute flex flex-col bg-slate-50 w-48 h-fit mt-[3.3rem] border border-gray-300 shadow-lg rounded-lg">';
        echo '<li class="flex text-gray-600 hover:bg-slate-200 mx-1 my-1 hover:rounded-lg cursor-pointer"><svg class="w-6 h-6 my-auto fill-gray-600 mr-2 ml-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.1.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M495.9 166.6C499.2 175.2 496.4 184.9 489.6 191.2L446.3 230.6C447.4 238.9 448 247.4 448 256C448 264.6 447.4 273.1 446.3 281.4L489.6 320.8C496.4 327.1 499.2 336.8 495.9 345.4C491.5 357.3 486.2 368.8 480.2 379.7L475.5 387.8C468.9 398.8 461.5 409.2 453.4 419.1C447.4 426.2 437.7 428.7 428.9 425.9L373.2 408.1C359.8 418.4 344.1 427 329.2 433.6L316.7 490.7C314.7 499.7 307.7 506.1 298.5 508.5C284.7 510.8 270.5 512 255.1 512C241.5 512 227.3 510.8 213.5 508.5C204.3 506.1 197.3 499.7 195.3 490.7L182.8 433.6C167 427 152.2 418.4 138.8 408.1L83.14 425.9C74.3 428.7 64.55 426.2 58.63 419.1C50.52 409.2 43.12 398.8 36.52 387.8L31.84 379.7C25.77 368.8 20.49 357.3 16.06 345.4C12.82 336.8 15.55 327.1 22.41 320.8L65.67 281.4C64.57 273.1 64 264.6 64 256C64 247.4 64.57 238.9 65.67 230.6L22.41 191.2C15.55 184.9 12.82 175.3 16.06 166.6C20.49 154.7 25.78 143.2 31.84 132.3L36.51 124.2C43.12 113.2 50.52 102.8 58.63 92.95C64.55 85.8 74.3 83.32 83.14 86.14L138.8 103.9C152.2 93.56 167 84.96 182.8 78.43L195.3 21.33C197.3 12.25 204.3 5.04 213.5 3.51C227.3 1.201 241.5 0 256 0C270.5 0 284.7 1.201 298.5 3.51C307.7 5.04 314.7 12.25 316.7 21.33L329.2 78.43C344.1 84.96 359.8 93.56 373.2 103.9L428.9 86.14C437.7 83.32 447.4 85.8 453.4 92.95C461.5 102.8 468.9 113.2 475.5 124.2L480.2 132.3C486.2 143.2 491.5 154.7 495.9 166.6V166.6zM256 336C300.2 336 336 300.2 336 255.1C336 211.8 300.2 175.1 256 175.1C211.8 175.1 176 211.8 176 255.1C176 300.2 211.8 336 256 336z"/></svg>Settings</li>';
        echo '<li onclick="userLogOut()" class="flex text-gray-600 hover:bg-slate-200 mx-1 my-1 hover:rounded-lg cursor-pointer border-t border-gray-200"><svg class="w-6 h-6 my-auto fill-gray-600 mr-2 ml-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><!--! Font Awesome Pro 6.1.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M560 448H512V113.5c0-27.25-21.5-49.5-48-49.5L352 64.01V128h96V512h112c8.875 0 16-7.125 16-15.1v-31.1C576 455.1 568.9 448 560 448zM280.3 1.007l-192 49.75C73.1 54.51 64 67.76 64 82.88V448H16c-8.875 0-16 7.125-16 15.1v31.1C0 504.9 7.125 512 16 512H320V33.13C320 11.63 300.5-4.243 280.3 1.007zM232 288c-13.25 0-24-14.37-24-31.1c0-17.62 10.75-31.1 24-31.1S256 238.4 256 256C256 273.6 245.3 288 232 288z"/></svg>Log out</li>';
        echo '</ul>';
    }
    echo '</div>';
    echo '</div>';
    echo '</nav>';