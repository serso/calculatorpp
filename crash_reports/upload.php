<?php
    $time = isset($_POST['timestamp']) ? $_POST['timestamp'] : "";
$stackTrace = isset($_POST['stacktrace']) ? $_POST['stacktrace'] : "";
if ( /*!ereg('^[-a-zA-Z0-9_. ]+$', $filename) || */
    $stackTrace == ""
) {
    die("This script is used to log debug data. Please send the "
        . "logging message and a filename as POST variables.");
}

$filename = time() . ".stacktrace";

$i = 0;
while (file_exists(getFileName($i, $filename))) {
    $i = $i + 1;
}

$message = "Time: " . $time . "\n" . "Stack trace:\n" . $stackTrace;
file_put_contents(getFileName($i, $filename), $message . "\n", FILE_APPEND);

function getFileName($i, $filename)
{
    if ($i == 0) {
        return $filename;
    } else {
        return $filename . $i;
    }
}

?>
