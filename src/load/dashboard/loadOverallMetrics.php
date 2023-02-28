<?php
if (!isset($conn)) {
    include  '../../scripts/db/connectToDatabase.php';
}

function get_data_count($dataType, $conn)
{
    $table_name = '';
    $search_columns = '';
    $complete_column = '';
    $incomplete_column = '';

    switch ($dataType) {
        case 1:
            $table_name = 'project';
            $search_columns = '*';
            break;
        case 2:
            $table_name = 'board';
            $search_columns = '*';
            break;
        case 3:
            $table_name = 'board_data';
            $search_columns = '*';
            break;
        case 4:
            $table_name = 'board_data';
            $complete_column = 'COUNT(IF(board_check = 1, 1, NULL)) AS complete,';
            $incomplete_column = 'COUNT(IF(board_check = 0, 1, NULL)) AS incomplete';
            break;
        case 5:
            $table_name = 'user';
            $search_columns = '*';
            break;
        default:
            return null;
    }

    if (isset($_POST["userID"])) $query = 'SELECT ' . $search_columns . $complete_column . $incomplete_column . ' FROM ' . $table_name . ' WHERE userID = ' . $_POST["userID"] . '';
    else $query = "SELECT $search_columns $complete_column $incomplete_column FROM $table_name";
    $result = mysqli_query($conn, $query);

    if ($complete_column !== '' && $incomplete_column !== '') {
        $data = mysqli_fetch_assoc($result);
        return [$data['complete'], $data['incomplete']];
    }

    return mysqli_num_rows($result);
}

function loadData($dataType, $conn)
{
    $texts = [
        "1" => "Projects",
        "2" => "Columns",
        "3" => "Tasks",
        "4" => "Tasks I/C",
        "5" => "Users"
    ];
    $colors = [
        "1" => "bg-green-500",
        "2" => "bg-orange-500",
        "3" => "bg-sky-500",
        "4" => "bg-yellow-400",
        "5" => "bg-pink-600",
    ];
    $extra = [
        "1" => "Total_projects",
        "2" => "Total_columns",
        "3" => "Total_tasks",
        "4" => "Incomplete/complete_tasks",
        "5" => "Total_users"
    ];

    $countData = get_data_count($dataType, $conn);
    echo '<div title=' . $extra[$dataType] . ' class="flex h-fit w-48 px-4 py-2 shadow-2xl ' . $colors[$dataType] . ' items-center justify-center">';
    echo '<div class="flex flex-col justify-center items-center text-center">';
    if ($dataType != 4) echo '    <span class="flex text-xs sm:text-2xl md:text-3xl lg:text-4xl xl:text-5xl 2xl:text-6xl">' . $countData . '</span>';
    else echo '    <span class="flex text-xs sm:text-2xl md:text-3xl lg:text-4xl xl:text-5xl 2xl:text-6xl">' . $countData[0] . "/" . $countData[1] . '</span>';
    echo '    <span class="flex text-sm">' . $texts[$dataType] . '</span>';
    echo '</div>';
    echo '</div>';
}
?>

<div class="overallMetrics flex flex-col gap-8 py-8 px-4 w-full">
    <div class="flex-1 flex flex-col gap-4 mx-auto">
        <?php
        echo '<div class="flex flex-row font-bold text-md text-gray-500 uppercase">';
        if (isset($_POST["userID"])) {
            $q = 'SELECT username FROM user WHERE userID = ' . $_POST['userID'] . '';
            $f = mysqli_fetch_assoc(mysqli_query($conn, $q));
            $username = $f['username'];
        }
        echo !isset($_POST["userID"]) ? "Overall Metrics" : "Overall Metrics of" . '<i><u class="text-gray-700 ml-2"> ' . $username . '</u></i>';
        if (isset($_POST["userID"])) echo '<button title="Go back to overall metrics" class="goBackBtn ml-auto px-2 text-gray-300 rounded-xl bg-red-500 hover:bg-red-600 hover:text-white transition">Go back</button>';
        echo "</div>"
        ?>
        <div class="overallWrap flex-row flex gap-2 flex-wrap">
            <?php
            $dataList = !isset($_POST["userID"]) ? [1, 2, 3, 4, 5] : [1, 2, 3, 4];
            foreach ($dataList as $data) {
                loadData($data, $conn);
            }
            ?>
        </div>
    </div>
</div>
<?php
if (isset($_POST['userID'])) return;
include "loadUserList.php";
?>