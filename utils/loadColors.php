<?php
include "./scripts/connectToDatabase.php";

$q = "select color_name, color_code from colors";
$result = mysqli_query($conn, $q);

while ($options = mysqli_fetch_assoc($result)) {
    echo '<div title="Save this color" id="' . $options['color_name'] . '" value="' . $options['color_name'] . '" class="flex w-8 ' . $options['color_code'] . ' rounded-xl h-8 cursor-pointer hover:opacity-90" onclick="saveColor(`' . $options['color_name'] . '`, `' . $options['color_code'] . '`)"></div>';
}
