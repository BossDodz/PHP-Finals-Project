<?php


require 'read.php';

// Get the posted data.
$postdata = file_get_contents("php://input");

if (isset($postdata) && !empty($postdata)) {
	// Extract the data.
	$serv_req = json_decode($postdata);

	// Sanitize.
	$quantity = mysqli_real_escape_string($conn, trim($serv_req->quantity));
	$price = mysqli_real_escape_string($conn, trim($serv_req->price));
	$total = mysqli_real_escape_string($conn, trim($serv_req->total));


	// Create.


	$sql = "INSERT INTO orders(PROD_ID,PACK,VARIANT, QUANTITY, INSTRUCTION, PRICE, total) VALUES ('$serv_req->id','$serv_req->pack', '$serv_req->variant', '$quantity', '$serv_req->inst', '$price', '$total')";

	if ($conn->query($sql) === TRUE) {
		http_response_code(200);
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
		http_response_code(422);
	}
}
