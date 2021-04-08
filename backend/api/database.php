<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', 'K,2\}!8}~FA');
define('DB_NAME', 'caramela');


function connect()
{
	$con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

	if (mysqli_connect_errno()) {
		die("Failed to connect" . mysqli_connect_error());
	}

	mysqli_set_charset($con, "utf8");

	return $con;
}

$conn = connect();
