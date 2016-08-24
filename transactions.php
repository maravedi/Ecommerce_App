<?php
session_start();
include_once('config/dbconfig.php');

if ($_SESSION['type'] == 1) {
	allOrders($connection);
}

function allOrders($connection) {
	$sql_select = 'SELECT orders.order_id, orders.customer_id, orders.product_id, orders.quantity, customer.firstname, customer.lastname, product.product_name, product.price FROM orders, customer, product
	 WHERE 
	 	orders.customer_id = customer.customer_id
	 	AND
	 	orders.product_id = product.product_id
	 	ORDER BY
	 	orders.order_id';

	 $tr_style_header = 'style="border-bottom: 1px solid;"';
	 $td_style_header = 'style="border-bottom: 1px solid;"';
	 echo '<pre><center><table style="border: none; border-collapse: collapse;">';
	 echo '<tr ' . $tr_style_header . '><td ' . $td_style_header . '>';
	 echo '<b>Product</b>';
	 echo '</td><td ' . $td_style_header . '>';
	 echo '<b>Customer ID</b>';
	 echo '</td><td ' . $td_style_header . '>';
	 echo '<b>First Name</b>';
	 echo '</td><td ' . $td_style_header . '>';
	 echo '<b>Last Name</b>';
	 echo '</td><td ' . $td_style_header . '>';
	 echo '<b>Price</b>';
	 echo '</td><td ' . $td_style_header . '>';
	 echo '<b>Qty Purchased</b>';
	 echo '</td><td ' . $td_style_header . '>';
	 echo '<b>Order Total</b>';
	 echo '</td></tr>';
	 try {
	 	# Execute the query
	 	$rows = $connection->query($sql_select);
	 	# Count the rows selected by the query
	 	$num_rows = $rows->rowCount();
	 	echo "Total transactions: " . $num_rows;

	 	$num = 0;
	 	foreach($rows as $row) {
	 		$i = 0;
			$width = strPixels($row[$i]);
			$i++;
			$close = '</td>';
			$open = '<td style="border-right= 1px dotted; text-align: center;" width="' .$width . 'px">';
			echo '<tr>';
			echo $open . ucwords($row[product_name]) . $close;
			echo $open . ucwords($row[customer_id]) . $close;
			echo $open . ucwords($row[firstname]) . $close;
			echo $open . ucwords($row[lastname]) . $close;
			echo $open . '$' . ucwords($row[price]) . $close;
			echo $open . ucwords($row[quantity]) . $close;
			echo $open . '<b>$' . ($row[quantity] * $row[price]) . '</b>' . $close;
			echo '</tr>';
			$num++;
	 	}
	 } Catch (PDOException $e) {
	 	echo 'Query failed:' . $e->getMessage();
	 }
	 echo '</table></center></pre>';
}

function strPixels($string) {
	$strPixelWidths = array(
		' ' => 3, '!' => 3, '"' => 4, '#' => 7, '$' => 7, '%' => 11, '&' => 8,
		'\'' => 2, '(' => 4, ')' => 4, '*' => 5, '+' => 7, ',' => 3, '-' => 4,
		'.' => 3, '/' => 3, '0' => 7, '1' => 7, '2' => 7, '3' => 7, '4' => 7,
		'5' => 7, '6' => 7, '7' => 7, '8' => 7, '9' => 7, ':' => 3, ';' => 3,
		'<' => 7, '=' => 7, '>' => 7, '?' => 7, '@' => 12, 'A' => 7, 'B' => 8,
		'C' => 9, 'D' => 9, 'E' => 8, 'F' => 7, 'G' => 9, 'H' => 9, 'I' => 3,
		'J' => 6, 'K' => 8, 'L' => 7, 'M' => 9, 'N' => 9, 'O' => 9, 'P' => 8,
		'Q' => 9, 'R' => 9, 'S' => 8, 'T' => 7, 'U' => 9, 'V' => 7, 'W' => 11,
		'X' => 7, 'Y' => 7, 'Z' => 7, '[' => 3, '\\' => 3, ']' => 3, '^' => 5,
		'_' => 7, '`' => 4, 'a' => 7, 'b' => 7, 'c' => 6, 'd' => 7, 'e' => 7,
		'f' => 3, 'g' => 7, 'h' => 7, 'i' => 3, 'j' => 3, 'k' => 6, 'l' => 3,
		'm' => 11, 'n' => 7, 'o' => 7, 'p' => 7, 'q' => 7, 'r' => 4, 's' => 7,
		't' => 3, 'u' => 7, 'v' => 5, 'w' => 9, 'x' => 5, 'y' => 5, 'z' => 5,
		'{' => 4, '|' => 3, '}' => 4, '~' => 7
		);
	$weight = 0;
	if (!empty($string)) {
		for ($i = 0; $i < strlen($string); $i++) {
			$w = $strPixelWidths[substr($string, $i, 1)];
			if ($w) {
				$weight += $w;
			}
		}
	}
	return $weight;
}
?>