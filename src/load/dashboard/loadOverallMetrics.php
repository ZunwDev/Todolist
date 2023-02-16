<?php
function loadData($dataType, $conn)
{
    $types = [
        "1" => "project",
        "2" => "board",
        "3" => "board_data",
        "4" => "board_data",
        "5" => "user"
    ];
    $texts = [
        "1" => "Total projects",
        "2" => "Total columns",
        "3" => "Total tasks",
        "4" => "Incomplete/complete tasks",
        "5" => "Total users"
    ];
    $searchType = [
        "1" => "*",
        "2" => "*",
        "3" => "*",
        "4" => "COUNT(IF(board_check = 1, 1, NULL)) AS complete, COUNT(IF(board_check = 0, 1, NULL)) as incomplete",
        "5" => "*"
    ];
    $colors = [
        "1" => "bg-green-500",
        "2" => "bg-orange-500",
        "3" => "bg-sky-500",
        "4" => "bg-yellow-400",
        "5" => "bg-pink-600",
    ];

    $q = 'select ' . $searchType[$dataType] . ' from ' . $types[$dataType] . '';
    if ($dataType == 4) {
        $f = mysqli_fetch_assoc(mysqli_query($conn, $q));
        $data1 = $f["complete"];
        $data2 = $f["incomplete"];
    }
    $f = mysqli_query($conn, $q);
    $v = mysqli_num_rows($f);
    echo '<div class="flex h-fit w-48 px-4 py-2 shadow-2xl ' . $colors[$dataType] . ' items-center justify-center">';
    echo '<div class="flex flex-col justify-center items-center text-center">';
    if ($dataType != 4) echo '    <span class="flex text-xs sm:text-2xl md:text-3xl lg:text-4xl xl:text-5xl 2xl:text-6xl">' . $v . '</span>';
    else echo '    <span class="flex text-xs sm:text-2xl md:text-3xl lg:text-4xl xl:text-5xl 2xl:text-6xl">' . $data1 . "/" . $data2 . '</span>';
    echo '    <span class="flex">' . $texts[$dataType] . '</span>';
    echo '</div>';
    echo '</div>';
}
?>

<div class="flex flex-row gap-2 py-8 px-32">
    <div class="overallMetrics flex flex-col gap-4">
        <div class="flex font-bold text-md text-gray-500 uppercase">Overall Metrics</div>
        <div class="overallWrap flex flex-row gap-4 flex-wrap">
            <?php
            $dataList = [1, 2, 3, 4, 5];
            foreach ($dataList as $data) {
                loadData($data, $conn);
            }
            ?>
        </div>
    </div>
    <div class="userList flex flex-col gap-4">
        <div class="flex font-bold text-md text-gray-500 uppercase">Manage Users</div>
        <div class="userWrap flex flex-row">
            <?php
            $q = "select * from user";
            $r = mysqli_query($conn, $q);
            echo '<div class="overflow-auto">';
            echo '<table class="text-sm text-left text-gray-500 w-full table-auto">';
            echo '<thead><tr class="text-xs text-gray-700 uppercase bg-gray-50"><th scope="col" class="px-6 py-3">user_ID</th><th scope="col" class="px-6 py-3">Username</th><th scope="col" class="px-6 py-3">role_ID</th><th scope="col" class="px-6 py-3">Created at</th><th scope="col" class="px-6 py-3">Action</th></tr></thead>';
            echo '<tbody>';
            while ($row = mysqli_fetch_assoc($r)) {
                echo '<tr class="border-b odd:bg-white even:bg-slate-100">';
                echo '<td class="text-center px-6 py-1">' . $row["userID"] . '</td><td class="text-center px-6 py-1">' . $row["username"] . '</td><td class="text-center px-6 py-1">' . $row["roleID"] . '</td><td class="text-center px-6 py-1">' . $row["createdAt"] . '</td><td class="text-center px-6 py-1"><a class="text-sky-700 hover:text-sky-800">Del</a>/<a class="text-sky-700 hover:text-sky-800">P</a></td>';
                echo '</tr>';
            }
            echo '</tbody>';
            echo '</table>';
            echo '</div>';
            ?>
        </div>
    </div>
</div>