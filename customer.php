<!DOCTYPE html>
<link href="style/elements.css" rel="stylesheet" type="text/css" media="all">
<body>
	<?php
	session_start();
	if (isset($_SESSION["username"]) && $_SESSION["type"] == 0) {
		echo '<p>Welcome, ' . $_SESSION["username"] . ', to David Frazer\'s ISM672 Ecommerce Application!</p><br />';
		echo '<p>I hope you enjoy the products we have to offer!</p>';
		echo '<br />';
		echo '<a><img class="customer_image" src="style/euc.jpg"></a>';
		echo '<div class="img_text">Image from http://collegeapps.about.com/od/phototours/ss/uncg-university-of-north-carolina-greensboro-photo-tour_3.htm</div><br /><br />';
	} else {
		echo '<p>Please login!</p>';
	}
	?>
</body>