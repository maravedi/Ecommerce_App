<!DOCTYPE html>
<html>
	<head>
		<link href="style/elements.css" rel="stylesheet" type="text/css" media="all">
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title></title>
	</head>
	<body>
		<div id="login_form">
			<b>Admin Login</b>
			<br />
			<script type="text/javascript">
				jQuery(document).ready(fuction() {
					$("#redirectForm").submit();
				});
			</script>

			<form id="redirectForm" method="POST" action="loginadminprocessor.php" target="_parent">
				Username:
				<input type="text" name="username">
				<br />
				Password:
				<input type="password" name="password">
				<br />
				<input type="submit" value="Login">
			</form>
		</div>
	</body>
</html>
	