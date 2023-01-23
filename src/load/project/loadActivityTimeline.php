<?php 

include "../../scripts/db/connectToDatabase.php";

$projectID = $_POST['projectID'];

echo '<div id="popupOverlay" class="w-screen h-screen absolute bg-slate-50/25">';
echo '  <div id="popupElement" class="absolute flex left-0 right-0 ml-auto mr-auto pb-4 px-2 beforeShowUp top-28 flex-col h-fit w-[48rem] shadow-lg bg-slate-50 rounded-lg">';
echo '      <div class="deleteHeader flex flex-row w-full h-8 border-b border-slate-200 gap-4">';
echo '          <div class="my-1 ml-4 w-full h-full font-bold">Activity log</div>';
echo '          <div class="ml-auto mt-1 mr-1 flex h-fit w-fit px-1 py-1 rounded-lg hover:bg-slate-200 cursor-pointer" onclick="closeAnyPopup()"><svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M310.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L160 210.7 54.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L114.7 256 9.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L160 301.3 265.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L205.3 256 310.6 150.6z"/></svg></div>';
echo '      </div>';
echo '        <div class="overflow-y-auto overflow-x-hidden h-[20rem]">';
$q = "SELECT description, project_activity_types.type, activity_time FROM project_activity JOIN project_activity_types ON project_activity.typeID = project_activity_types.typeID WHERE projectID = '$projectID' ORDER BY activityID DESC";
$r = mysqli_query($conn, $q);
if (mysqli_num_rows($r) > 0) {
    echo '        <table class="mt-4 text-sm text-left text-gray-500 w-full table-auto">';
    echo '          <thead class="text-xs text-gray-700 uppercase bg-gray-50">';
    echo '              <tr>';
    echo '                  <th scope="col" class="px-6 py-3">Description</th>';
    echo '                  <th scope="col" class="px-6 py-3">Type</th>';
    echo '                  <th scope="col" class="px-6 py-3">Time</th>';
    echo '              </tr>';
    echo '          </thead>';
    echo '          <tbody>';
    while ($row = mysqli_fetch_array($r)) {
        $date = ''.$row['activity_time'].'';
        $actualTime = date("Y-m-d", strtotime($date)) == date('Y-m-d', time()) ? 'today in '.date("H:i", strtotime($date)).'' :  date("d.m.Y H:i", strtotime($date));
        echo '  <tr class="border-b odd:bg-white even:bg-slate-100">';
        echo '      <td class="py-2 px-6 break-all">'.$row['description'].'</td>';
        echo '      <td class="py-2 px-4">'.$row['type'].'</td>';
        echo '      <td class="py-2 px-4">'.$actualTime.'</td>';
        echo '  </tr>';
    }
}
else {
    echo "No data";
}
echo '          </tbody>';
echo '      </table>';
echo '      </div>';
echo '  </div>';
echo '</div>';