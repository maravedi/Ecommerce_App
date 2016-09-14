<?php
include_once('config/dbconfig.php');
session_start();
$loggedIn = login_status($connection);

if ($loggedIn == 1) {
	header('Location: index.php');
} elseif ($loggedIn == 0) {
	echo '<link href="style/elements.css" rel="stylesheet" type="text/css" media="all"><link href="style/style.css" rel="stylesheet" type="text/css" media="all">';
	include_once('include/navbar.php');
	echo '<br /><br />';
	echo '<iframe src="include/catnavbar.php" marginwidth="0" marginheight="0" scrolling="no" frameborder="0" class="left" height="400" width="15%"></iframe>';
	echo '<iframe src="include/loginadminfailed.php" marginwidth="0" marginheight="0" scrolling="no" frameborder="0" name="main" class="main" height="400" width="65%"></iframe>';
	echo '<iframe marginwidth="0" marginheight="0" scrolling="no" frameborder="0" class="right" height="400" width="15%"></iframe>';
} else {
	echo 'Something failed.';
}

function login_status($connection) {
	#Sanitizing form data input
	$username = $_POST['username'];
	$username = preg_replace('/[^a-z0-9 ]/i', '', $username);
	$password = $_POST['password'];
	$password = preg_replace('/[^a-z0-9 ]/i', '', $password);

	$query = 'SELECT admin_id, admin_name FROM admin WHERE admin_password = \'' . $password . '\' AND admin_name = \'' . $username . '\'';

	$sql = $connection->prepare($query);
	$sql->execute();

	$result = $sql->fetchAll();
	foreach($result as $row) {
		if ($row['admin_id'] > 0) {
			$GLOBALS['admin_id'] = $row['admin_id'];
			$GLOBALS['admin_name'] = $row['admin_name'];
			$_SESSION['loggedin'] = 1;
			$_SESSION['username'] = $username;
			$_SESSION['type'] = 1; //1 is for admins, 0 for customers
		} else {
			$_SESSION['loggedin'] = 0;
		}
	}
	return $_SESSION['loggedin'];
}
?>