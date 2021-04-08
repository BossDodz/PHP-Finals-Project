<?php

/**
 * Returns the list of policies.
 */
require 'database.php';


$orders = [];


function readAll($table_name)
{
    global $conn, $orders;
    if ($table_name == 'orders') {
        $sql = "SELECT ORD_ID FROM orders";

        if ($result = mysqli_query($conn, $sql)) {
            $i = 0;
            while ($row = mysqli_fetch_assoc($result)) {
                $orders[$i]['ORD_ID']    = $row['ORD_ID'];
                $i++;
            }

            return $orders;
        } else {
            http_response_code(404);
        }
    } else if ($table_name == 'transaction') {
        $sql = "SELECT TRANS_ID FROM transaction";

        if ($result = mysqli_query($conn, $sql)) {
            $i = 0;
            while ($row = mysqli_fetch_assoc($result)) {
                $orders[$i]['TRANS_ID']    = $row['TRANS_ID'];
                $i++;
            }

            return $orders;
        } else {
            http_response_code(404);
        }
    }
}

function getLatestOrdId($table_name)
{
    global $conn;
    $latestId = "";
    if ($table_name == 'orders') {
        $sql = "SELECT * FROM orders ORDER BY ORD_ID DESC";

        if ($result = mysqli_query($conn, $sql)) {
            while ($row = $result->fetch_assoc()) {
                return $row['ORD_ID'];
            }
        }
    } else if ($table_name == 'transaction') {
        $sql = "SELECT * FROM transaction ORDER BY TRANS_ID DESC";

        if ($result = mysqli_query($conn, $sql)) {
            while ($row = $result->fetch_assoc()) {
                return $row['TRANS_ID'];
            }
        }
    }
}


function getOrders($numOfOrders)
{
    global $conn;
    $orderId = [];
    $sql = "SELECT * FROM orders ORDER BY ORD_ID DESC LIMIT $numOfOrders";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $i = 0;
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            $orderId[$i++] = $row['ORD_ID'];
        }
        return $orderId;
    } else {
        echo "0 results";
    }
}
