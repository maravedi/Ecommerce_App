<?php
session_start();
include_once('config/dbconfig.php');
$cat_id = $_POST['cat_id'];
$customer_id = $_POST['customer_id'];
$username = $_POST['username'];
$password = $_POST['password'];
$category_name = $_POST['category_name'];
$product_id = $_POST['product_id'];
$product_name = $_POST['product_name'];
$product_description = $_POST['product_description'];
$price = $_POST['price'];
$quantity = $_POST['quantity'];

# Variables to hold POST triggers
$SHOWinsertProduct = $_POST['insertProduct'];
$SHOWinsertCategory = $_POST['insertCategory'];
$SHOWupdateProduct = $_POST['updateProduct'];
$SHOWinsertOrder = $_POST['insertOrder'];
$SHOWinsertCustomerLogin = $_POST['insertCustomerLogin'];

if ($SHOWupdateProduct == 1 && $cat_id != NULL && $product_name != NULL && $product_description != NULL && $price != NULL && $quantity != NULL) {
	insertProduct($connection, $cat_id, $product_name, $product_description, $price, $quantity);
	echo 'New product entered successfully.';
} elseif ($SHOWinsertCategory == 1 && $category_name != NULL) {
	insertCategory($connection, $category_name);
	echo 'New cateogry entered successfully.';
} elseif ($SHOWupdateProduct == 1 && $product_id != NULL && $product_description != NULL && $price != NULL && $quantity != NULL) {
	updateProduct($connection, $product_id, $product_description, $price, $quantity);
	echo 'Product successfully updated.';
} elseif ($SHOWinsertOrder == 1 && $customer_id != NULL && $product_id != NULL && $quantity != NULL) {
	insertOrder($connection, $customer_id, $product_id, $quantity);	
} elseif ($SHOWinsertCustomerLogin == 1 && $customer_id != NULL && $username != NULL && $password != NULL) {
	insertCustomerLogin($connection, $customer_id, $username, $password);
} elseif (!empty($SHOWinsertProduct || !empty($SHOWinsertCategory) || !empty($SHOWupdateProduct) || !empty($SHOWinsertCustomerLogin)) {
	echo 'You did not enter any data!';
}

function insertProduct($connection, $cat_id, $product_name, $product_description, $price, $quantity) {
	$sql_insert = 'INSERT INTO product (cat_id, product_name, description, price, quantity) VALUES (\'' . $cat_id . '\', \'' . $product_name . '\', \'' . $product_description . '\', \'' . $price . '\', \'' . $quantity . '\')';

	try {
		$rows = $connection->exec($sql_insert) or die(print_r($db->errorInfo(), true));
	} Catch (PDOException $e) {
		echo 'Insert failed:' . $e->getMessage();
	}
}

function insertCategory($connection, $category_name) {
	$sql_insert = 'INSERT INTO category (category_name) VALUES (\'' . $category_name . '\')';

	try {
		$rows = $connection->exec($sql_insert) or die(print_r($db->errorInfo(), true));
	} Catch (PDOException $e) {
		echo 'Insert failed:' . $e->getMessage();
	}
}

function insertOrder($connection, $customer_id, $product_id, $quantity) {
	$sql_insert = 'INSERT INTO orders (customer_id, product_id, quantity) VALUES (\'' . $customer_id . '\', \'' . $product_id . '\', \'' . $quantity . '\')';
	$sql_select = 'SELECT product_name, quantity, FROM product WHERE product_id = \'' . $product_id . '\'';
	try {
		$rows = $connection->exec($sql_insert) or die(print_r($db->errorInfo(), true));
	} Catch (PDOException $e) {
		echo 'Insert failed:' . $e->getMessage();
	}

	foreach ($rows_quantity as $row) {
		if($row[quantity] >= $quantity) {
			try {
				$rows = $connection->exec($sql_insert) or die(print_r($db->errorInfo(), true));
				echo 'New order entered successfully.';
			} Catch (PDOException $e) {
				echo 'Query failed:' . $e->getMessage();
			}
		} else {
			echo 'There are not enough ' . $row[product_name] . \'s available to make that order.';
		}
	}
}

function insertCustomerLogin($connection, $customer_id, $username, $password) {
	$sql_insert = 'INSERT INTO login (customer_id, username, password) VALUES (\'' . $customer_id . '\', \'' . $username . '\', \'' . $password . '\')';
	$sql_select = 'SELECT customer_id FROM login WHERE customer_id = \'' . $customer_id . '\'';
	$rows_login = $connection->query($sql_select);
	if($rows_login) {
		$row_count = $rows_login->fetchColumn();
		if($row_count > 0) {
			$result = 'EXISTS';
			echo 'Customer login already exists for that customer!';
			echo $rowcount;
		}
		else {
			$result = 'DOESNOTEXIST';
		}
	}
	if($result == 'DOESNOTEXIST') {
		try {
			$rows = $connection->exec($sql_insert) or die(print_r($db->errorInfo(), true));
			echo 'Customer login successfully created.';
		} Catch (PDOException $e) {
			echo 'Insert failed:' . $e->getMessage();
		}
		$rows = NULL;
	}
}

function updateProduct($connection, $product_id, $product_description, $price, $quantity) {
	$sql_update = 'UPDATE product SET description = \'' . $product_description . '\', price = \'' . $price '\', quanity = \'' . $quantity . '\' WHERE product_id = \'' . $product_id . '\'';

	try {
		$rows = $connection->exec($sql_update) or die(print_r($db->errorInfo(), true));		
	} Catch (PDOException $e) {
		echo "Update failed:" . $e->getMessage();
	}
}

function listProduct($connection) {
	$sql_select = 'SELECT DISTINCT cat_id, product_id, product_name, description, price, quantity FROM product WHERE cat_id IS NOT NULL ORDER BY product_name';
	try {
		$rows = $connection->query($sql_select);
		foreach($rows as $row) {
			$options .='<option value="' . $row[product_id] . '">' . ucwords(str_replace("_", " ", $row[product_name])) . '</option>';
			$menu = '<td><label>Product:</label></td><td><select name="product_id" id="product_id">' . $options . '</select></td>';		
		}
		echo $menu;
	} Catch (PDOException $e) {
		echo "Query failed:" . $e->getMessage();
	}
}

function listCustomer($connection) {
	$sql_select = 'SELECT DISTINCT customer_id, firstname, lastname FROM customer WHERE customer_id IS NOT NULL ORDER BY firstname';
	try {
		$rows = $connection->query($sql_select);
		foreach($rows as $row) {
			$options .='<option value="' . $row[customer_id] . '">' . ucwords($row[firstname] . ' ' . $row[lastname]) . '</option>';
			$menu = '<td><label>Customer:</label></td><td><select name="customer_id" id="customer_id">' . $options . '</select></td>';		
		}
		echo $menu;
	} Catch (PDOException $e) {
		echo "Query failed:" . $e->getMessage();
	}
}

function listCategory($connection) {
	$sql_select = 'SELECT DISTINCT cat_id, category_name FROM category WHERE category_name IS NOT NULL ORDER BY category_name';
	try {
		$rows = $connection->query($sql_select);
		foreach($rows as $row) {
			$options .='<option value="' . $row[cat_id] . '">' . ucwords(str_replace(("_", " ", $row[category_name])) . '</option>';
			$menu = '<td><label>Category:</label></td><td><select name="cat_id" id="cat_id">' . $options . '</select></td>';		
		}
		echo $menu;
	} Catch (PDOException $e) {
		echo "Query failed:" . $e->getMessage();
	}
}