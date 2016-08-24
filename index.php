<!DOCTYPE html>
<html>
	<head>
		<link href="style/style.css" rel="stylesheet" type="text/css" media="all">
		<like href="style/elements.css" rel="stylesheet" type="text/css" media="all">
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<script type="text/javascript" language="javascript" src="scripts/javascript.js"></script>
		<title>David Frazer - ECommerce</title>
	</head>
	<body>
		<?php
		session_start();

		// Variables to hold includes
		$main = 'include/main.php';
		$admin = 'admin.php';
		$customer = 'customer.php';
		$navbar = 'include/navbar.php';
		$catnavbar = 'include/catnavbar.php';

		include_once($navbar);
		?>
		<br /><br /><br />
		<div align="center">
			<?php
###############################
#		AUTHENTICATED ADMIN
###############################
			if (isset($_SESSION["username"]) && $_SESSION["type"] == 1) {
				echo '<div style="text-align: left;">Logged-in as ' . $_SESSION["username"] . '</div>';
				echo '<br>';
				echo '<iframe src="' . $catnavbar . '" id="left_frame" onload="setIframeHeight(this.id)" marginwidth="0" marginheight="0" scrolling="no" frameborder="0" class="left" width="15%"></iframe>';
				echo '<iframe src="' . $admin . '" id="center_frame" onload="setIframeHeight(this.id)" marginwidth="0" marginheight="0" scrolling="no" frameborder="0" name="main" class="main" width="65%"></iframe>';
				echo '<iframe id="right_frame" onload="setIframeHeight(this.id)" marginwidth="0" marginheight="0" scrolling="no" frameborder="0" class="right" height="400" width="15%"></iframe>';
			}

###############################
#		AUTHENTICATED CUSTOMER
###############################
			else if (isset($_SESSION["username"]) && $_SESSION["type"] == 0) {
				echo '<div style="text-align: left;">Logged-in as ' . $_SESSION["username"] . '</div>';
				echo '<br>';
				echo '<iframe src="' . $catnavbar . '" id="left_frame" onload="setIframeHeight(this.id)" marginwidth="0" marginheight="0" scrolling="no" frameborder="0" class="left" width="15%"></iframe>';
				echo '<iframe src="' . $customer . '" id="center_frame" onload="setIframeHeight(this.id)" marginwidth="0" marginheight="0" scrolling="no" frameborder="0" name="main" class="main" width="65%"></iframe>';
				echo '<iframe id="right_frame" onload="setIframeHeight(this.id)" marginwidth="0" marginheight="0" scrolling="no" frameborder="0" class="right" height="400" width="15%"></iframe>';
			}

###############################
#		UNAUTHENTICATED USER
###############################
			else {
				echo '<iframe src="' . $catnavbar . '" id="left_frame" onload="setIframeHeight(this.id)" marginwidth="0" marginheight="0" scrolling="no" frameborder="0" class="left" width="15%"></iframe>';
				echo '<iframe src="' . $main . '" id="center_frame" onload="setIframeHeight(this.id)" marginwidth="0" marginheight="0" scrolling="no" frameborder="0" name="main" class="main" width="65%"></iframe>';
				echo '<iframe id="right_frame" onload="setIframeHeight(this.id)" marginwidth="0" marginheight="0" scrolling="no" frameborder="0" class="right" height="400" width="15%"></iframe>';
			}
			?>
		</div>
	</body>
</html>