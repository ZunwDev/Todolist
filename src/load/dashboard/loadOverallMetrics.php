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
    echo '<div class="flex h-fit w-48 px-4 py-2 shadow-2xl ' . $colors[$dataType] . ' items-center justify-center flex-shrink-0">';
    echo '<div class="flex flex-col justify-center items-center text-center">';
    if ($dataType != 4) echo '    <span class="flex text-xs sm:text-2xl md:text-3xl lg:text-4xl xl:text-5xl 2xl:text-6xl">' . $v . '</span>';
    else echo '    <span class="flex text-xs sm:text-2xl md:text-3xl lg:text-4xl xl:text-5xl 2xl:text-6xl">' . $data1 . "/" . $data2 . '</span>';
    echo '    <span class="flex">' . $texts[$dataType] . '</span>';
    echo '</div>';
    echo '</div>';
}
?>

<div class="flex flex-col gap-8 py-8 px-4 w-full">
    <div class="flex-1 overallMetrics flex flex-col gap-4 mx-auto">
        <div class="flex font-bold text-md text-gray-500 uppercase">Overall Metrics</div>
        <div class="overallWrap flex-row flex gap-2">
            <?php
            $dataList = [1, 2, 3, 4, 5];
            foreach ($dataList as $data) {
                loadData($data, $conn);
            }
            ?>
        </div>
    </div>
    <div class="flex-1 userList flex flex-col gap-4 mx-auto w-1/2 flex-shrink-0">
        <div class="flex font-bold text-md text-gray-500 uppercase">Manage Users</div>
        <div class="userWrap flex flex-col gap-4">
            <div class="overflow-auto bg-white shadow-md rounded-lg">
                <table class="table-auto text-sm leading-normal w-full">
                    <thead class="bg-gray-100 border-b border-gray-300">
                        <tr>
                            <th class="py-3 px-6 text-gray-700 uppercase text-xs font-medium text-left">user_ID</th>
                            <th class="py-3 px-6 text-gray-700 uppercase text-xs font-medium text-left">Username</th>
                            <th class="py-3 px-6 text-gray-700 uppercase text-xs font-medium text-left">role_ID</th>
                            <th class="py-3 px-6 text-gray-700 uppercase text-xs font-medium text-left">Created at</th>
                            <th class="py-3 px-6 text-gray-700 uppercase text-xs font-medium text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $q = "select * from user";
                        $r = mysqli_query($conn, $q);
                        while ($row = mysqli_fetch_assoc($r)) {
                            $rowBgColor = ($row['userID'] % 2 === 0) ? 'bg-gray-100' : '';
                            echo '<tr class="text-gray-700 ' . $rowBgColor . '">';
                            echo '<td class="py-2 px-6 border-b border-gray-300">' . $row["userID"] . '</td>';
                            echo '<td class="py-2 px-6 border-b border-gray-300">' . $row["username"] . '</td>';
                            echo '<td class="py-2 px-6 border-b border-gray-300">' . $row["roleID"] . '</td>';
                            echo '<td class="py-2 px-6 border-b border-gray-300">' . $row["createdAt"] . '</td>';
                            echo '<td class="py-2 px-6 border-b border-gray-300 text-center"><button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-4 rounded">Edit</button> <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-4 rounded">Delete</button></td>';
                            echo '</tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>