<?php

require 'database.php';

// Extract, validate and sanitize the id.
$TRANS_ID = ($_GET['id'] !== null && (int)$_GET['id'] > 0) ? mysqli_real_escape_string($conn, (int)$_GET['id']) : false;

if (!$TRANS_ID) {
    return http_response_code(400);
}

// Delete.
$sql = "DELETE FROM transaction WHERE TRANS_ID = $TRANS_ID";

if (mysqli_query($conn, $sql)) {
    http_response_code(204);
} else {
    return http_response_code(422);
}
