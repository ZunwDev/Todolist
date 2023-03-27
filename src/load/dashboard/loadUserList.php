<?php
if (!isset($conn)) {
    include  '../../scripts/db/connectToDatabase.php';
}

?>
<div class="flex-1 userList flex flex-col gap-4 lg:mx-auto w-1/2 flex-shrink-0">
    <div class="flex flex-row">
        <div class="flex font-bold text-md text-gray-500 uppercase">Manage Users</div>
        <div class="sBar flex flex-row ml-auto">
            <?php
            $searchData = isset($_POST['searchData']) ? $_POST['searchData'] : '';
            $q = $searchData != "" ? "SELECT * FROM user WHERE username LIKE '%" . $searchData . "%'" : (isset($_POST["userID"]) ? 'SELECT * FROM user WHERE userID = ' . $_POST['userID'] : 'SELECT * FROM user');
            $userCount = mysqli_num_rows(mysqli_query($conn, 'SELECT * FROM user'));
            if ($searchData == "") $q = "SELECT * FROM user";
            ?>
            <input type="text" class="search flex form-control px-2 rounded-tl-lg rounded-bl-lg border border-slate-300 text-sm focus:outline-none" placeholder="Search <?php echo $userCount;
                                                                                                                                                                        echo $userCount == 1 ? " user" : " users" ?>..."></input>
            <button class="searchBtn rounded-tr-lg rounded-br-lg bg-slate-300 hover:bg-slate-400 mx-auto px-3"><svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.3.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                    <path d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z" />
                </svg></button>
        </div>
    </div>
    <div class="userWrap flex flex-col gap-4 overflow-y-auto h-64">
        <div class="bg-white shadow-md rounded-lg flex-shrink-0">
            <table class="table-auto text-sm leading-normal w-full">
                <thead class="bg-gray-100 border-b border-gray-300">
                    <tr>
                        <?php
                        $l = ["user_ID", "Username", "role_ID", "Created at", "Action"];
                        foreach ($l as $d) echo '<th class="py-3 px-6 text-gray-700 uppercase text-xs font-medium text-left">' . $d . '</th>';
                        ?>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $r = mysqli_query($conn, $q);
                    while ($row = mysqli_fetch_assoc($r)) {
                        $rowBgColor = ($row['userID'] % 2 === 0) ? 'bg-gray-100' : '';
                        echo '<tr class="text-gray-700 ' . $rowBgColor . '">';
                        $l = [$row["userID"], $row["username"], $row["roleID"], $row["createdAt"]];
                        foreach ($l as $d) {
                            echo '<td class="py-2 px-6 border-b border-gray-300">' . $d . '</td>';
                        }
                        echo '<td class="py-2 px-6 border-b border-gray-300 text-center"><button data-user-id=' . $row["userID"] . ' title="Show users profile" class="showProfile bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"><svg class="w-4 h-4 fill-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--! Font Awesome Pro 6.3.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M304 128a80 80 0 1 0 -160 0 80 80 0 1 0 160 0zM96 128a128 128 0 1 1 256 0A128 128 0 1 1 96 128zM49.3 464H398.7c-8.9-63.3-63.3-112-129-112H178.3c-65.7 0-120.1 48.7-129 112zM0 482.3C0 383.8 79.8 304 178.3 304h91.4C368.2 304 448 383.8 448 482.3c0 16.4-13.3 29.7-29.7 29.7H29.7C13.3 512 0 498.7 0 482.3z"/></svg></button> <button title="Delete user" class="deleteUserBtn bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" data-user-id="' . $row["userID"] . '"><svg class="w-4 h-4 fill-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--! Font Awesome Pro 6.3.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M135.2 17.7C140.6 6.8 151.7 0 163.8 0H284.2c12.1 0 23.2 6.8 28.6 17.7L320 32h96c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 96 0 81.7 0 64S14.3 32 32 32h96l7.2-14.3zM32 128H416V448c0 35.3-28.7 64-64 64H96c-35.3 0-64-28.7-64-64V128zm96 64c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16z"/></svg></button></td>';
                        echo '</tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>