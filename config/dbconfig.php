<?php

$dsn = "mysql:dbname=ecommerce";
$username = "php";
$password = "php1234";

try {
	$connection = new PDO($dsn, $username, $password);
	$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
	echo "Connection failed:" . $e->getMessage();
}
?>