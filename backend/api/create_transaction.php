<?php


require 'read.php';

// Get the posted data.
$postdata = file_get_contents("php://input");

if (isset($postdata) && !empty($postdata)) {
    // Extract the data.
    $serv_req = json_decode($postdata);

    // Sanitize.
    date_default_timezone_set('Asia/Hong_Kong');
    $trans_date = date("Y-m-d H:i:s");

    $delivery_date = mysqli_real_escape_string($conn, trim($serv_req->dd));
    $payment_amt = mysqli_real_escape_string($conn, trim($serv_req->payment_amt));
    $postal = mysqli_real_escape_string($conn, trim($serv_req->postal));
    $status = mysqli_real_escape_string($conn, trim($serv_req->status));


    $numOfOrders = mysqli_real_escape_string($conn, trim($serv_req->numOfItems));
    $subTotal = $serv_req->total;
    $change = (int)$payment_amt - (int)$subTotal;



    // Create.
    $TRANS_ID = "";
    $LATEST_ID = getLatestOrdId('transaction');
    $ORDERS = implode(",", getOrders($numOfOrders));


    if (readAll('transaction') == null) {
        $TRANS_ID = date("Y") . "00000";
    } else {
        $LAST_ORD = strval($LATEST_ID);
        $LAST_ORD_YR = substr($LAST_ORD, 0, 4);
        $LAST_ORD_NUM = substr($LAST_ORD, 4);
        if (date("Y") == $LAST_ORD_YR) {
            $INC_ID = date("Y") . $LAST_ORD_NUM;
            $TRANS_ID = (int)$INC_ID + 1;
        } else {
            $TRANS_ID = date("Y") . "00000";
        }
    }

    $sql = "INSERT INTO transaction(TRANS_ID,ORDERS,TRANS_DATE,DLVRY_DATE, CUST_NAME, EMAIL, MOBILE, ADDRESS_P, ADDRESS_S, CITY, BARANGAY, POSTAL, PAYMENT_AMT, payment_chng, SUBTOTAL, status) VALUES ('$TRANS_ID','$ORDERS','$trans_date', '$delivery_date', '$serv_req->fname', '$serv_req->email', '$serv_req->mobile', '$serv_req->address', '$serv_req->address2', '$serv_req->city', '$serv_req->barangay', '$postal', '$payment_amt', '$change', '$subTotal', '$status')";

    if ($conn->query($sql) === TRUE) {
        http_response_code(200);
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
        http_response_code(422);
    }
}
