<!DOCTYPE html>
<?php
session_start();
include_once('inserprocessor.php');
###############################
#		AUTHENTICATED ADMIN
###############################
if (isset($_SESSION["username"]) && $_SESSION["type"] == 1) {
	?>
	<link href="style/elements.css" rel="stylesheet" type="text/css" media="all">
	<div class="header">
		<strong>Add New Product</strong>
	</div>
	<div class="insert_form">
		<table>
			<form action="inserprocessor.php" method="post">
				<tr>
					<?php
					listCategory($connection);
					?>
				</tr>
				<tr>
					<td>
						<input type="hidden" name="insertProduct" value="1" />
						<label for="product_name">Product Name:</label>
					</td>
					<td>
						<input type="text" name="product_name" /><br />
					</td>
				</tr>
				<tr>
					<td>
						<label for="product_description">Product Description:</label>
					</td>
					<td>
						<input type="text" name="product_description" /><br />
					</td>
				</tr>
				<tr>
					<td>
						<label for="price">Price:</label>
					</td>
					<td>
						<input type="text" name="price" /><br />
					</td>
				</tr>
				<tr>
					<td>
						<label for="quantity">Quantity:</label>
					</td>
					<td>
						<input type="text" name="quantity" /><br />
					</td>
				</tr>
				<td></td>
				<td style="text-align:right;">
					<input type="submit" value="Submit" />
				</td>
			</tr>
		</form>
	</table>
</div>
<br />
<div class="header">
	<strong class="header">Update Prodduct</strong>
</div>
<div class="insert_form">
	<table>
		<form action="inserprocessor.php" method="post">
			<tr>
				<?php
				listProduct($connection);
				?>
			</tr>
			<tr>
				<td>
					<input type="hidden" name="updateProduct" value="1" />
					<label for="product_description">Product Description:</label>
				</td>
				<td>
					<input type="text" name="product_description" /><br />
				</td>
				<tr>
					<td>
						<label for="price">Price:</label>
					</td>
					<td>
						<input type="text" name="price" /><br />
					</td>
				</tr>
				<tr>
					<td>
						<label for="quantity">Quantity:</label>
					</td>
					<td>
						<input type="text" name="quantity" /><br />
					</td>
				</tr>
				<td></td>
				<td style="text-alignL right;">
					<input type="submit" value="Submit" />
				</td>
			</tr>
		</form>
	</table>
</div>
<br />
<div class="header">
	<strong class="header">Add New Category</strong>
</div>
<div class="insert_form">
	<table>
		<form action="insertprocessor.php" method="post">
			<tr>
				<td>
					<input type="hidden" name="insertCategory" value="1" />
					<label>Category Name:</label>
				</td>
				<td>
					<input type="text" name="category_name" /><br />
				</td>
			</tr>
			<tr>
				<td></td>
				<td style="text-align: right;">
					<input type="submit" value="Submit" />
				</td>
			</tr>
		</form>
	</table>
</div>
<br />
<div class="header">
	<strong>Add New Customer</strong>
</div>
<div class="insert_form">
	<table>
		<form action="registrationprocessor.php" method="post">
			<tr>
				<td>
					<input type="hidden" name="insertCustomer" value="1" />
					<label>First Name:</label>
				</td>
				<td>
					<input type="text" name="firstname" /><br />
				</td>
			</tr>
			<tr>
				<td>
					<label>Last Name:</label>
				</td>
				<td>
					<input type="text" name="lastname" /><br />
				</td>
			</tr>
			<tr>
				<td>
					<label>Street:</label>
				</td>
				<td>
					<input type="text" name="street" /><br />
				</td>
			</tr>
			<tr>
				<td>
					<label>City:</label>
				</td>
				<td>
					<input type="text" name="city" /><br />
				</td>
			</tr>
			<tr>
				<td>
					<label>State:</label>
				</td>
				<td>
					<input type="text" name="state" /><br />
				</td>
			</tr>
			<tr>
				<td>
					<label>Zip:</label>
				</td>
				<td>
					<input type="text" name="zip" /><br />
				</td>
			</tr>
			<tr>
				<td>
					<label>Country:</label>
				</td>
				<td>
					<input type="text" name="country" /><br />
				</td>
			</tr>
			<tr>
				<td>
					<label>Phone:</label>
				</td>
				<td>
					<input type="text" name="phone" /><br />
				</td>
			</tr>
			<tr>
				<td>
					<label>Email:</label>
				</td>
				<td>
					<input type="text" name="email" /><br />
				</td>
			</tr>
			<tr>
				<td>
					<label>Username:</label>
				</td>
				<td>
					<input type="text" name="username" /><br />
				</td>
			</tr>
			<tr>
				<td>
					<label>Password:</label>
				</td>
				<td>
					<input type="password" name="password" /><br />
				</td>
			</tr>
			<tr>
				<td></td>
				<td style="text-align: right;">
					<input type="submit" value="Submit" />
				</td>
			</tr>
		</form>
	</table>
</div>
<br />
<div class="header">
	<strong class="header">Add New Order</strong>
</div>
<div class="insert_form">
	<table>
		<form action="insertprocessor.php" method="post">
			<tr>
				<?php
				listProduct($connection);
				?>
			</tr>
			<tr>
				<td>
					<input type="hidden" name="insertOrder" value="1" />
					<label>Quantity:</label>
				</td>
				<td>
					<input type="text" name="quantity" /><br />
				</td>
			</tr>
			<tr>
				<td>
					<label>Customer ID:</label>
				</td>
				<td>
					<input type="text" name="customer_id" /><br />
				</td>
			</tr>
			<tr>
				<td></td>
				<td style="text-align: right;">
					<input type="submit" value="Submit" />
				</td>
			</tr>
		</form>
		</table>
	</div>
	<br />
	<div class="header">
		<strong class="header">Add New Customer Login</strong>
	</div>
	<div class="insert_form">
		<table>
			<tr>
				<?php
				listCustomer($connection);
				?>
			</tr>
			<tr>
				<td>
					<input type="hidden" name="insertCustomerLogin" value="1" />
					<label>Username:</label>
				</td>
				<td>
					<input type="text" name="username" /><br />
				</td>
			</tr>
			<tr>
				<td>
					<label>Password:</label>
				</td>
				<td>
					<input type="password" name="password" /><br />
				</td>
			</tr>
			<tr>
				<td></td>
				<td style="text-align: right;">
					<input type="submit" value="Submit" />
				</td>
			</tr>
		</form>
	</table>
</div>
<br />
<?php
}
###############################
#		UNAUTHENTICATED USER
###############################
else {
	echo 'Admin page -- UNAUTHENTICATED USER!';
}
?>
</pre>