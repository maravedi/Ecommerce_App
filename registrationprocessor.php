<?php
session_start();
include_once('config/dbconfig.php');
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$street = $_POST['street'];
$city = $_POST['city'];
$state = $_POST['state'];
$zip = $_POST['zip'];
$country = $_POST['country'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$username = $_POST['username'];
$password = $_POST['password'];

# Variables to hold POST triggers
$insertCustomer = $_POST['insertCustomer'];

if($insertCustomer == 1) {
	insertCustomer($connection, $firstname, $lastname, $street, $city, $state, $zip, $country, $phone, $email);
	insertLogin($connection, $GLOBALS['cust_id'], $username, $password);
	echo 'Registration successfull.';
	echo '<br />';
	echo 'Please login.';
}

function insertCustomer($connection, $firstname, $lastname, $street, $city, $state, $zip, $country, $phone, $email) {
	$sql = 'INSERT INTO customer (firstname, lastname, street, city, state, zip, country, phone, email) VALUES (\'' . $firstname . '\', \'' . $lastname . '\', \'' . $street . '\', \'' . $city . '\', \'' . $state . '\', \'' . $zip . '\', \'' . $country . '\', \'' . $phone . '\', \'' . $email . '\')';

	try { 
		$rows = $connection->exec($sql) or die(print_r($db->errorInfo(), true));	
	} Catch (PDOException $e) {
		echo 'Insert failed:' . $e->getMessage();
	}
	$rows = NULL;

	$getCustID = 'SELECT customer_id FROM customer WHERE firstname = \'' . $firstname . '\' AND lastname = \'' . $lastname '\'';

	try {
		$rows = $connection->query($getCustID);
		foreach ($rows as $row) {
			$GLOBALS['cust_id'] = $row[customer_id];
		}
	} Catch (PDOException $e) {
		echo 'Query failed:' . $e->getMessage();
	}
	$rows = NULL;
}

function insertLogin($connection, $customer_id, $username, $password) {
	$sql = 'INSERT INTO login (customer_id, username, password) VALUES (\'' . $customer_id . '\', \'' . $username . '\', \'' $password . '\')';

	try {
		$rows = $connection->exec($sql) or die(print_r($db->errorInfo(), true));
	} Catch (PDOException $e) {
		echo 'Insert failed:' . $e->getMessage();
	}
	$rows = NULL;
}
?>