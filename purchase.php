<?php
session_start();
include_once('../config/dbconfig.php');

if (!empty($_POST) && isset($_SESSION['type']) && $_SESSION['type'] == 0) {
	$max = 500; // Assuming that customers won't purchase more than 500 items
	for ($i = 0; $i < $max; $i++) {
		$product['attr'][$i] = $_POST['item' . $i];
		// Iterating through the $max variable to pick-out each product from the $_POST values
	}
	for ($i = 0; $i < $max; $i++) {
		$product['qty'][$i] = $_POST['item' . $i . '_quantity'];
		// Iterating through the $max variable to pick-out each product from the $_POST values
	}

	$result['attr'] = array_filter($product['attr']); // Removing any NULL values from the array
	$result['qty'] = array_filter($product['qty']);
	$result_values['attr'] = array_values($result['attr']); // Setting the array keys to begin at 0 again
	$result_values['qty'] = array_values($result['qty']);
	$num_products = count($result_values['attr']); // Counting the number of non-NULL values in the array
	$num_quantity = count($result_values['qty']);

	if ($num_products > 0 && $num_quantity > 0) {
		for ($y = 1; $y <= $num_products; $y++) {
			$pieces['attr'][$y] = explode("_", $result_values['attr'][$y - 1]);
			// Splitting the values using the "_" as a delimiter
			$pieces['qty'][$y] = explode("_", $result_values['qty'][$y - 1]);
		}

		for ($x = 1; $x <= $num_products; $x++) {
			echo '<br />';
			$item_number[$x] = $pieces['attr'][$x][0];
			$function[$x] = $pieces['attr'][$x][1];
			$product_id[$x] = $pieces['attr'][$x][2];
			$quantity_in_stock[$x] = $pieces['attr'][$x][3];
			$product_name[$x] = $pieces['attr'][$x][4];
			$quantity_purchased[$x] = $pieces['qty'][$x][0];

			if ($quantity_in_stock[$x]) >= $quantity_purchased[$x]) {
				$new_qty[$x] = $quantity_in_stock[$x] - $quantity_purchased[$x];
				insertOrder($connection, $_SESSION['customer_id'], $product_id[$x], $quantity_purchased[$x]);
				updateProduct($connection, $product_id[$x], $new_qty[$x]);
				echo "Purchase successful.";
			} else {
				echo "We do not have enough " . $product_name[$x] . "s in stock.";
			}
		}
	} else {
		echo "You either didn't select anything or did not enter quantity.  Please go back and try again.";
	}
} elseif ($_SESSION['type'] == 1) {
	echo 'Admins cannot make purchases';
} else {
	echo 'Please login to make a purchase.';
}

function insertOrder($connection, $customer_id, $product_id, $quantity) {
	$sql_insert = 'INSERT INTO orders (customer_id, product_id, quantity) VALUES (\'' . $customer_id . '\', \'' . $product_id . '\', \'' . $quantity . '\')';

	try {
		$rows = $connection->exec($sql_insert) or die(print_r($db->errorInfo(), true));
	} Catch (PDOException $e) {
		echo "Insert failed:" . $e->getMessage();
	}
}

function updateProduct($connection, $product_id, $new_qty) {
	$sql_update = 'UPDATE product SET quantity = \'' . $new_qty . '\' WHERE product_id = \'' .  $product_id . '\'';

	try {
		$rows = $connection->exec($sql_update) or die(print_r($db->errorInfo(), true));
	} Catch (PDOException $e) {
		echo "Update failed:" . $e->getMessage();
	}
}
?>