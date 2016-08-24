<!DOCTYPE html>
<?php
session_start();
###############################
#		AUTHENTICATED ADMIN
###############################
if (isset($_SESSION['username']) && $_SESSION['type'] == 1) {
	echo 'Already registered as an administrator!';
}

###############################
#		AUTHENTICATED CUSTOMER
###############################
elseif (isset($_SESSION['username']) && $_SESSION['type'] == 0) {
	echo 'Already registered as a customer!';
}

###############################
#		UNAUTHENTICATED USER
###############################
else {
	?>
	<link href="style/elements.css" rel="stylesheet" type="text/css" media="all">
	<div class="header">
		<strong>New Customer Registration</strong>
	</div>
	<div class="registration_form">
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
	<?php
}
?>