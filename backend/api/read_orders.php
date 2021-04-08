<?php

require 'database.php';

$thisOrder = [];

$ordId = (int)$_GET['orderId'];

if (isset($ordId) && !empty($ordId)) {
    global $conn, $thisOrder;

    $sql = "SELECT NAME, orders.* FROM orders, product WHERE ORD_ID = $ordId and orders.PROD_ID = product.PROD_ID";
    $result = mysqli_query($conn, $sql);

    if ($result->num_rows > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $thisOrder['NAME'] = $row['NAME'];
            $thisOrder['PACK'] = $row['PACK'];
            $thisOrder['VARIANT'] = $row['VARIANT'];
            $thisOrder['QUANTITY'] = $row['QUANTITY'];
            $thisOrder['INSTRUCTION'] = $row['INSTRUCTION'];
            $thisOrder['PRICE'] = $row['PRICE'];
            $thisOrder['PROD_ID'] = $row['PROD_ID'];
            $thisOrder['total'] = $row['total'];
        }
        echo json_encode($thisOrder);
    } else {
        http_response_code(511);
    }
} else {
    http_response_code(511);
}
