<?php
session_start();
include_once('config/dbconfig.php');

# Variables to hold POST triggers 
$SHOWProduct = $_GET['showProduct'];

function allProduct($connection, $SHOWProduct) {
	$sql = 'SELECT product_id, product_name, description, price, quantity FROM product WHERE cat_id = \'' . $SHOWProduct . '\'';
	$tr_style_header = 'style="border-bottom: 1px solid;"';
	$td_style_header = 'style="border-bottom: 1px solid; text-align: center;"';
	echo '<pre><center><table border="0px">';
	echo '<tr ' . $tr_style_header . '><td ' . $td_style_header . '>';
	echo '<b>Product</b>';
	echo '</td><td ' . $td_style_header . '>';
	echo '<b>Description</b>';
	echo '</td><td ' . $td_style_header . '>';
	echo '<b>Price</b>';
	echo '</td><td ' . $td_style_header . '>';
	echo '<b>Qty in Stock</b>';
	echo '</td><td ' . $td_style_header . '>';
	echo '<b>Quantity</b>';
	echo '</td><td ' . $td_style_header . '>';
	echo '<b>Purchase</b>';
	echo '</td></tr>';
	try {
		# Execute the query
		$rows = $connection->query($sql);
		# Count the rows selected by the query
		$num_rows = $rows->rowCount();

		$num = 0;
		foreach($rows as $row) {
			$i = 0;
			$width = strPixels($row[$i]);
			$i++;
			$close = '</td>';
			$open = '<td style="border-right= 1px dotted; text-align: center;" width="' .$width . 'px">';
			$add = '<input type="hidden" name="add" value="add">';
			$product_id = '<input type="hidden" name="product_id" value="' . $row['product_id'] . '">';
			echo '<tr>';
			echo $open . ucwords(str_replace("_", " ", $row['product_name'])) . $close;
			echo $open . ucwords($row['description']) . $close;
			echo $open . '$' . ucwords($row['price']) . $close;
			echo $open . ucwords($row['quantity']) . $close;
			echo '<td>';
			echo '<form id="purchase" method="POST" action="purchase.php">';
			echo '<input type="text name="item' . $num . '_quantity" />';
			echo '</td><td style="text-align: center; vertical-align: middle;">';
			echo '<input type="checkbox" name="item' . $num . '" value="item' . $num . '_add_' . $row['product_id'] . '_' . $row['quantity'] . '_' . $row['product_name'] . '">';
			echo '</td></tr>';
			$num++;
		}
	} Catch (PDOException $e) {
		echo 'Query failed:' . $e->getMessage();
	}
	echo '<tr style="border-color: transparent;"><td></td><td></td><td></td><td></td><td></td><td>';
	echo '<input style="text-align: right;" type="submit" value="Purchase"></td></tr></table></center></pre>';
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