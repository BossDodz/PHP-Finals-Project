<?php
require 'database.php';

// Get the posted data.
$postdata = file_get_contents("php://input");

if (isset($postdata) && !empty($postdata)) {
    // Extract the data.
    $request = json_decode($postdata);

    // Sanitize.
    $id    = mysqli_real_escape_string($conn, $request->TRANS_ID);
    $next_status = mysqli_real_escape_string($conn, trim($request->status));

    date_default_timezone_set('Asia/Hong_Kong');
    $time_delivered = date("Y-m-d H:i:s");

    $next_status = (int)$next_status + 1;



    // Update.
    if ($next_status < 3) {
        $sql = "UPDATE transaction SET status = $next_status WHERE TRANS_ID = $id LIMIT 1";

        if (mysqli_query($conn, $sql)) {
            http_response_code(204);
        } else {
            return http_response_code(422);
        }
    } else {
        $sql = "UPDATE transaction SET status = $next_status, time_dlvred = '$time_delivered' WHERE TRANS_ID = $id LIMIT 1";

        if (mysqli_query($conn, $sql)) {
            http_response_code(204);
        } else {
            return http_response_code(422);
        }
    }
}
