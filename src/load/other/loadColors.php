<?php
include "../../scripts/db/connectToDatabase.php";

$q = "select colorID, color_name, color_code from colors";
$result = mysqli_query($conn, $q);

while ($options = mysqli_fetch_assoc($result)) {
    echo '<div title="' . $options['color_name'] . '" id="' . $options['color_name'] . '" value="' . $options['color_name'] . '" class="saveColor flex w-8 ' . $options['color_code'] . ' rounded-xl h-8 cursor-pointer hover:opacity-90" data-color-name="' . $options['color_name'] . '" data-color-code="' . $options['color_code'] . '" data-color-id="' . $options['colorID'] . '"></div>';
}
