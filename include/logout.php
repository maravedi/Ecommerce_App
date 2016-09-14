<?php
session_start();
unset($_SESSION['username']);
unset($_SESSION['loggedin']);
unset($_SESSION['type']);
unset($_SESSION['update']);
unset($_SESSION['customer_id']);
session_write_close();
header('Location: index.php');
?>