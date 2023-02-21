<?php

session_start();
$adminState = $_POST['adminState'];

echo '<div id="popupOverlay" class="w-screen z-50 h-screen absolute">';
echo '  <div id="popupElement" class="absolute h-fit beforeShowUp flex flex-col border border-slate-300 flex-shrink-0 mt-10 w-fit shadow-lg bg-slate-50 py-1">';
if ($adminState == 1) {
    echo '<div class="dashboardBtn flex flex-row gap-2 text-sm my-auto hover:bg-slate-200 py-0.5 px-2 cursor-pointer"><svg class="flex w-4 h-4 my-auto fill-gray-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M0 96C0 60.7 28.7 32 64 32H448c35.3 0 64 28.7 64 64V416c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V96zm64 64V416H224V160H64zm384 0H288V416H448V160z"/></svg>Dashboard</div>';
}
echo '<div class="logOut flex flex-row gap-2 text-red-600 my-auto hover:bg-slate-200 text-sm py-0.5 px-2 cursor-pointer"><svg class="flex w-4 h-4 my-auto fill-red-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><!--! Font Awesome Pro 6.1.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M560 448H512V113.5c0-27.25-21.5-49.5-48-49.5L352 64.01V128h96V512h112c8.875 0 16-7.125 16-15.1v-31.1C576 455.1 568.9 448 560 448zM280.3 1.007l-192 49.75C73.1 54.51 64 67.76 64 82.88V448H16c-8.875 0-16 7.125-16 15.1v31.1C0 504.9 7.125 512 16 512H320V33.13C320 11.63 300.5-4.243 280.3 1.007zM232 288c-13.25 0-24-14.37-24-31.1c0-17.62 10.75-31.1 24-31.1S256 238.4 256 256C256 273.6 245.3 288 232 288z"/></svg>Log out</div>';
echo '</div>';
echo '</div>';
