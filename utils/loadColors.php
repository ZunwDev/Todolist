<?php 

$q = "select color_name, color_code from colors";
$result = mysqli_query($conn, $q);
if (mysqli_num_rows($result) > 0) {
    while ($options = mysqli_fetch_assoc($result)) {
        echo '<li id="' . $options['color_name'] . '" class="flex w-[21rem] h-8 hover:bg-slate-200" onclick="saveColor()">';
        echo '<div class="flex w-4 h-4 my-auto ml-2 rounded-md ' . $options['color_code'] . '" value="' . $options['color_code'] . '"></div>';
        echo '<div class="flex ml-3 my-auto" value="' . $options['color_name'] . '">' . $options['color_name'] . '</div>';
        echo '</li>';
    };
}