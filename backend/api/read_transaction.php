<?php

/**
 * Returns the list of policies.
 */
require 'database.php';

$transactions = [];

$inputs = file_get_contents("php://input");



function readArray()
{
    global $conn;

    $sql = "SELECT * FROM transaction ORDER BY TRANS_ID DESC";
    $i = 0;
    if ($result = mysqli_query($conn, $sql)) {
        while ($row = mysqli_fetch_assoc($result)) {
            $transactions[$i]['TRANS_ID'] = $row['TRANS_ID'];
            $transactions[$i]['TRANS_DATE'] = $row['TRANS_DATE'];
            $transactions[$i]['ORDERS'] = $row['ORDERS'];
            $transactions[$i]['status'] = $row['status'];
            $transactions[$i]['SUBTOTAL'] = $row['SUBTOTAL'];
            $transactions[$i]['DLVRY_DATE'] = $row['DLVRY_DATE'];
            $transactions[$i]['time_dlvred'] = $row['time_dlvred'];
            $transactions[$i]['CUST_NAME'] = $row['CUST_NAME'];
            $transactions[$i]['MOBILE'] = $row['MOBILE'];
            $transactions[$i]['EMAIL'] = $row['EMAIL'];
            $transactions[$i]['ADDRESS_P'] = $row['ADDRESS_P'];
            $transactions[$i]['ADDRESS_S'] = $row['ADDRESS_S'];
            $transactions[$i]['CITY'] = $row['CITY'];
            $transactions[$i]['BARANGAY'] = $row['BARANGAY'];
            $transactions[$i]['POSTAL'] = $row['POSTAL'];
            $transactions[$i]['PAYMENT_AMT'] = $row['PAYMENT_AMT'];
            $transactions[$i]['payment_chng'] = $row['payment_chng'];
            ++$i;
        }
        echo json_encode($transactions);
    } else {
        http_response_code(404);
    }
}

readArray();
